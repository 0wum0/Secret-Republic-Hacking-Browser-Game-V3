<?php

class ServerComponent
{
  function __construct($storage_id = false, $user_id = false, $relation_id = false)
  {
    global $db;
    if ($storage_id)
    {
      $db->join("components c", "c.component_id = s.component_id", "left outer");
      $db->where('storage_id', $storage_id);
    }
    if ($user_id)
    {
      $db->where('user_id', $user_id);
    }
    if ($storage_id)
    {
      $this->info = $db->getOne('storage s');
    }

    if (is_array($this->info) && isset($this->info["default_sell_price"], $this->info['damage']))
    {
      $this->info["default_sell_price"] -= ($this->info["default_sell_price"]/100) * $this->info['damage'];
    }

  }
}

function processComponentMount($storage_id)
{

}

function fetchComponentFromStorage($user_id, $storage_id)
{
  global $db;
  $component = $db->join("components c", "c.component_id = s.component_id", "left outer")
                ->where('storage_id', $storage_id)
                ->where('user_id', $user_id)
                ->getOne('storage s');
  return (is_array($component) && !empty($component['storage_id'])) ? $component : false;
}
function sellComponentFromStorage($user_id, $storage_id)
{
  global $db;
  $component = fetchComponentFromStorage($user_id, $storage_id);

  if (!is_array($component) || empty($component['storage_id'])) return false;
  $component["default_sell_price"] -= ($component["default_sell_price"]/100) * ($component['damage'] ?? 0);

  $db->where("storage_id", $component['storage_id'])->delete("storage", 1);

  $db->rawQuery('update users set money=money+? where id=?', array($component["default_sell_price"], $user_id));
  return $component;
}


function handlePickSlotForComponent($server, $component, $pickedSlot = false)
{
  global $db, $tVars, $load;

  if (!is_array($component) || empty($component['type'])) {
    return false;
  }

  $slots = $db->rawQuery('select sc.*, c.* from server_components sc
                          left outer join components c on c.component_id = sc.component_id
                          where sc.server_id = ? and c.type = ?',
                array($server->server_id, $component['type']));

  if (!is_array($slots)) {
    $slots = [];
  }

  $slotsAreAvailable = 0;

  if ( $component['type'] == 5)
  {
    if ($server->server['ram_slots'] > count($slots))
      $slotsAreAvailable = $server->server['ram_slots'] - count($slots);
  }
  elseif ($server->server['hdd_slots'] > count($slots))
    $slotsAreAvailable = $server->server['hdd_slots'] - count($slots);



  if (isset($pickedSlot))
  {
    $pickedSlot = intval($pickedSlot);
    $componentToReplace = null;
    if ($pickedSlot === 0 && $slotsAreAvailable)
      $componentToReplace = "freeSlot";
    else
      foreach ($slots as $slot)
        if (is_array($slot) && ($slot['relation_id'] ?? null) == $_POST['slot'])
        {
          $componentToReplace = $slot;

          if (!empty($component['ram']))
            if ($server->server['total_ram'] - ($componentToReplace['ram'] ?? 0) + $component['ram'] < $server->server['ram_usage'])
              add_alert("Current RAM usage is higher than available RAM after replace");

          if (!empty($component['hdd']))
            if ($server->server['total_hdd'] - ($componentToReplace['hdd'] ?? 0) + $component['hdd'] < $server->server['hdd_usage'])
              add_alert("Current HDD usage is higher than available HDD after replace");


          break;
        }
    if (!there_are_errors() && $componentToReplace !== null)
      return $componentToReplace;
  }

  $tVars["slots"] = $slots;
  $load = "pick_slot";
  $tVars['slotsAreAvailable'] = $slotsAreAvailable;
  return false;
}
/**
 * Replace a server component with a component from storage.
 *
 * @param Server $server          The server object.
 * @param array  $component       The new component (from storage) – array with at least 'storage_id', 'type', 'component_id', 'damage', 'name'.
 * @param array|string|null $componentToReplace  The component being replaced – array (DB row), the string "freeSlot", or falsy to auto-detect.
 * @param int    $user_id         The owner user ID.
 * @return bool  True on success, false when inputs cannot be normalised.
 */
function replaceComponentWithComponent($server, &$component, &$componentToReplace, $user_id)
{
  global $db;

  // --- guard: $component must be an array with required keys ---
  if (is_string($component)) {
    $decoded = json_decode($component, true);
    if (is_array($decoded)) {
      $component = $decoded;
    } else {
      error_log('replaceComponentWithComponent: $component is a non-array value: ' . print_r($component, true));
      return false;
    }
  }
  if (!is_array($component) || empty($component['storage_id'])) {
    error_log('replaceComponentWithComponent: $component missing required keys: ' . print_r($component, true));
    return false;
  }

  // --- normalise $componentToReplace ---
  // It may legitimately be the string "freeSlot", an array (DB row), or falsy (auto-detect).
  if (is_string($componentToReplace) && $componentToReplace !== 'freeSlot') {
    $decoded = json_decode($componentToReplace, true);
    if (is_array($decoded)) {
      $componentToReplace = $decoded;
    } else {
      error_log('replaceComponentWithComponent: $componentToReplace is an unexpected string: ' . print_r($componentToReplace, true));
      return false;
    }
  }

  if (!$componentToReplace)
  {
    $rows = $db->rawQuery('select c.*, sc.* from server_components sc
                        left outer join components c on c.component_id = sc.component_id
                        where sc.server_id = ? and c.type = ? limit 1',
                      array($server->server_id, $component['type']));
    if (!is_array($rows) || empty($rows[0])) {
      // No existing component found – treat as free slot.
      $componentToReplace = 'freeSlot';
    } else {
      $componentToReplace = $rows[0];
    }
  }


  $db->where('storage_id', $component['storage_id'])->delete('storage', 1);


  // Handle "freeSlot" string BEFORE any array-offset access to avoid
  // PHP 8.3 TypeError "Cannot access offset of type string on string".
  if ($componentToReplace === 'freeSlot')
  {
    $componentToReplace = array('name' => "Free slot");
  }
  elseif (is_array($componentToReplace) && !empty($componentToReplace['relation_id']))
  {
    $db->where('relation_id', $componentToReplace['relation_id'])
       ->delete('server_components');

    $newStorage = array(
      'component_id' => $componentToReplace['component_id'] ?? 0,
      'user_id' => $user_id,
      'damage' => $componentToReplace['damage'] ?? 0,
    );
    $db->insert('storage', $newStorage);
  }

  $insertData = array(
    'server_id' => $server->server_id,
    'component_id' => $component['component_id'],
    'damage' => $component['damage'] ?? 0,
  );
  $db->insert('server_components', $insertData);

  $server->recomputeServerResources();
  return true;
}
