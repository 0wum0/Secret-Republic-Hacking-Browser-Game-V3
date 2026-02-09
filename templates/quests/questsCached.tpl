<div class="row">
  <div class="col-md-3">
    {if $group}
    <div class="panel panel-future">
      <div class="panel-heading">
        {$group.name|strtoupper}
      </div>
      <div class="panel-body text-center">
        {if $myQuest}
        {if $myQuest.type eq 1 or $myQuest.type eq 2}
        {assign var="timesFormatted" value=$myQuest.times|default:0|floatval|number_format}
        {$L.QUEST_FINISHED_TIMES|replace:':title':$myQuest.title|replace:':times':$timesFormatted}
        {else}
        {$myQuest.title}
        {/if}
        {else}
        {if !$user.in_party}
        {assign var="doneFormatted" value=$group.questsDone|default:0|floatval|number_format}
        {$L.QUEST_DONE_FROM|replace:':done':$doneFormatted|replace:':avail':$quests|count|replace:':total':$group.nrQuests|replace:':name':$group.name}
        {else}
        <div class="text-center">{$L.NAV_PARTY}</div>
        {/if}
        {/if}
      </div>
      <a href="{$config.url}quests{if $myQuest}/group/{$group.qgroup_id}{/if}" class="button text-center">
      <span class="glyphicon glyphicon-arrow-left"></span>
      </a>
    </div>
    {else}
    <div class="button-stack mb10">
      {foreach from = $groups item = g} 
      {if $g.story}
      <a href="{$config.url}quests/group/{$g.qgroup_id}" class="button cut-text text-center">
      {$g.name|strtoupper} ({$g.questsDone}/{$g.nrQuests})
      </a>
      {/if}
      {/foreach}
    </div>
    <br/>
    <div class="button-stack mb10">
      {foreach from = $groups item = g} 
      {if !$g.story && !$g.premium}
      <a href="{$config.url}quests/group/{$g.qgroup_id}" class="button cut-text text-center">
      {$g.name|strtoupper} ({$g.questsDone}/{$g.nrQuests})
      </a>
      {/if}
      {/foreach}
    </div>
    <br/>
    <div class="button-stack">
      {foreach from = $groups item = g} 
      {if $g.premium}
      <a href="{$config.url}quests/group/{$g.qgroup_id}" class="button cut-text text-center">
      {$g.name|strtoupper} ({$g.questsDone}/{$g.nrQuests})
      </a>
      {/if}
      {/foreach}
    </div>
    {/if}
  </div>
  <div class="col-md-9">
    <div class="missions-container">
      {if $myQuest}
      {include file="quests/quest_available.tpl"}    
      {elseif $quests}
      {include file="quests/quests_available_list.tpl"}
      {elseif $group}
      <div class="alert alert-warning">
        {$L.QUEST_NO_REQUIREMENTS|replace:':name':$group.name}
      </div>
      {else}
      <div class=" well black">
        <p>
          {$L.QUEST_GROUPS_INFO}
        </p>
        <p>
          {$L.QUEST_PARTY_INFO}
        </p>
        <p>
          {$L.QUEST_DAILY_INFO}
        </p>
        <p>
          {$L.QUEST_REWARD_INFO|replace:':url':"`$config.url`rewards"}
        </p>
        {$L.QUEST_HACK_POINTS_INFO|replace:':hp_url':"`$config.url`organization/view/hackingPoints"|replace:':org_url':"`$config.url`organization"}
      </div>
      <div class="panel panel-glass" id="program">
        <a href="{$config.url}referrals">
        <img src="http://secretrepublic.net/layout/img/modules/referrals.jpg" style="width:100%" class="imageOpacity"/>
        </a>
        <div class="panel-body">
          <div class="well">
            <p>{$L.QUEST_COMMUNITY_INFO}</p>
            <p>{$L.QUEST_100_HACKERS}
            </p>
            <p>{$L.QUEST_EXTRA_REWARD}</p>
            <p>{$L.QUEST_REFERRAL_LINK|replace:':url':"`$config.url`referrals"}</p>
            <p>{$L.QUEST_INTERN_TEAM|replace:':url':"`$config.url`alpha_coins/option/questManager"}</p>
            <p>{$L.QUEST_SUPPORT_NEEDED}</p>
          </div>
          <br/>
          <div class="panel panel-glass nomargin">
            <div class="panel-body">
              <p>{$L.QUEST_LEVEL5_PROGRESS}</p>
              <div class="progress progress-well">
                <div class="progress-bar" role="progressbar" style="width: {($usersCount/(100/100))|intval}%;">
                </div>
              </div>
            </div>
            <div class="panel-footer text-right">
              [{$usersCount} / 100]
            </div>
          </div>
        </div>
      </div>
    </div>
    {/if}
  </div>
</div>
