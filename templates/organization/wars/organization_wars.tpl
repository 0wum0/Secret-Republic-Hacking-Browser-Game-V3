  
  
  {if $user.organization eq $org.id}
	
		<div class="futureNav middle"> 
      <ul> 
        <li><a href="{$config.url}organization/view/wars/"><span class="glyphicon glyphicon-fire"></span></a></li> 
        {if $access.manageWars}
          <li><a href="{$config.url}organization/view/wars/requests/emilia">{$L.ORG_REQUESTS}</a></li> 
          <li><a href="{$config.url}organization/view/wars/requests/emilia/start/true"><em>{$L.ORG_START_WAR}</em></a></li> 
        {/if}
         
      </ul> 
		</div>
    {/if}
		{if !$loadd}
			
			{include file="organization/wars/wars.tpl"}
		{elseif $loadd eq 'requests'}
		  {include file="organization/wars/war_requests.tpl"}
		{elseif $loadd eq "send_request"}
		
		  <h3 class="text-center">
		    Without the fear of our enemies, our bravery is meaningless
		  </h3>
			<div class="alert alert-danger">
			  
				The war will begin 3 days from midnight after the day the request is accepted and will last for 48 hours.
			</div>
			<div class="alert alert-danger">
				If the request is not granted a response within 72 hours it will be purged from the system.
				</div>
			<div class="alert alert-danger">You can send a <strong>forced request</strong> and push war onto an organization for <strong>{$forced_request_hp_cost} hacking points</strong>. The war will still start 3 days after midnight from today, but the other organization cannot refuse to participate. 
			
			</div>
				
				<h3 class="text-center">
				  Type exact name of enemy organization
				</h3>
				<form method="post">
				  <div class="row">
				    <div class="col-md-7">
					    <input type="text" maxlength=200 name="organization" class="text-center"/>
					  </div>
					  <div class="col-md-5">
					    <select name="type">
					      <option value = "1">{$L.ORG_NORMAL_WAR}</option>
					      <option {if $org.hacking_points gte $forced_request_hp_cost}value = "2"{else}disabled{/if}>{$L.ORG_FORCED_WAR|replace:':cost':$forced_request_hp_cost}</option>
					    </select>
					  </div>
					</div><br/>
					<input type="submit" class="btn" value="{$L.ORG_SEND_WAR_REQ}"/>
				
				</form>
				<hr/>
				<div class="alert alert-warning">
				
          Once you've sent a war request you cannot back down.
        </div>
   
    {/if}
		
		
		
	