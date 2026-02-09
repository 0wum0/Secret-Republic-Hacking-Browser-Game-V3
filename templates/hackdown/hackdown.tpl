{include file="header_home.tpl" }


{if $smarty.post.arena}

 <form method="post">
  <input type="hidden" name="arena" value="true" />      
	<div class="alert alert-info">
		<p>{$L.HACKDOWN_SELECT_SERVERS}</p>
		<p>
		{assign var="layersUrl" value="`$config.url`grid/layers/show"}
		{$L.HACKDOWN_SERVERS_INFO|replace:':url':$layersUrl}
		</p>
		<p>
		{$L.HACKDOWN_SERVERS_LOCK}
	</p></div>
	
	{include file='grid/pick_unused_servers.tpl'}
	
	<div style="padding:20px">

		<button type="submit" name="initiate" value="true"><span class="glyphicon glyphicon-screenshot"></span></button>
	</div>
</form>

{else}

	<div class=" text-center">
		<img src="{$config.url}layout/img/events/hackdown.jpg" style="width:100%"/>
	</div>
	<hr/>
	<a href="{$config.url}hackdown/rankings/gimme"><button>{$L.HACKDOWN_RANKINGS_LAST}</button></a>

<hr/>

{if $inArena}
	{include file="hackdown/hackdown_arena.tpl"}


{else}
{if $hackdownRemaining }<br/>
	<h3 class="text-center">
{assign var="hackCount" value=($hacks.nrMissions + $hacks.nrAttacks)|floatval|number_format}
{$L.HACKDOWN_STATS|replace:':count':$hackCount|replace:':missions':$hacks.nrMissions|replace:':arena':$hacks.nrAttacks}
</h3><br/>
{/if}


<div class="row">
	<div class="col-md-6">
	
		

	<div class="panel panel-glass">
		
		<div class="panel-body text-center">
			It doesn't take a hero to order men into battle. It takes a hero to be one of those men who goes into battle. 
		</div>
		<div class="panel-footer text-right">Norman Schwarzkopf</div>
	</div>
	<div class="panel panel-glass ">
			<div class="panel-heading">{$L.HACKDOWN_ABOUT}</div>
			<div class="panel-body">
				<p>{$L.HACKDOWN_ABOUT_P1}</p>
				<p>{$L.HACKDOWN_ABOUT_P2}</p>
				<p>{$L.HACKDOWN_ABOUT_P3}</p>
				<p>{$L.HACKDOWN_ABOUT_P4}</p>
				{$L.HACKDOWN_ABOUT_P5}
					
			</div>
			<div class="panel-footer text-center">
						<strong>{$L.HACKDOWN_ABOUT_FOOTER}</strong>
</div>
		</div>
		
		<div class="panel panel-glass">
			<div class="panel-heading">{$L.HDR_TUTORIAL_REWARDS}</div>
			<div class="panel-body">
				{$L.HACKDOWN_REWARDS_DESC}
			</div>
		</div>

	</div>
	<div class="col-md-6">
	
	{if $nextSaturdayRemaining}

<div class="panel panel-glass ">
	
	<div class="panel-body">
{include file="components/hackdown.tpl" countdownFrom=$nextSaturdayRemaining totalCountdown=6*24*60*60
                                              textCountdown = "true" progressBarClass = "progress-info"
                                              progressBarCountdown = "true" reloadOnFinish = "true" 
                                              textLeft=$L.HACKDOWN_NEXT_IN}
</div>
<div class="panel-footer">{$L.HACKDOWN_CHAMPION}</div>
</div>


{/if}

{if $hackdownRemaining}
<div class="panel panel-glass ">
	<div class="panel-heading">{$L.HACKDOWN_COUNTDOWN}</div>
	<div class="panel-body">
{include file="components/hackdown.tpl" countdownFrom=$hackdownRemaining totalCountdown=24*60*60
                                              textCountdown = "true" progressBarClass = "progress-info"
                                              progressBarCountdown = "true" reloadOnFinish = "true" 
                                              textLeft=$L.HACKDOWN_ENDS_IN}
</div>
</div>

	
	
	
		
	
		<div class="panel panel-glass ">
			<div class="panel-heading">{$L.HACKDOWN_MISSION}</div>
			<div class="panel-body">
				<p>{$L.HACKDOWN_MISSION_P1}</p>
				<p>{$L.HACKDOWN_MISSION_P2}</p>
				
			
			</div>
			<form method="post">
<button type="submit" name="hackdown" value="true">{$L.HACKDOWN_BEGIN_MISSION}</button>
</form>
		</div>
		<div class="panel panel-glass">
		<div class="panel-heading">{$L.HACKDOWN_ARENA}</div>
			<div class="panel-body">
				<p>{$L.HACKDOWN_ARENA_DESC_1}</p>
				<p>{$L.HACKDOWN_ARENA_DESC_2}</p>
				<p>{$L.HACKDOWN_ARENA_DESC_3}</p>
				<p>{$L.HACKDOWN_ARENA_DESC_4}</p>
				<p>{$L.HACKDOWN_ARENA_DESC_5}</p>
				
			</div>
			<form method="post">
<button type="submit" name="arena" value="true">{$L.HACKDOWN_ENTER_ARENA}</button>
</form>
		</div>
		
	
		{/if}
	</div>
</div>
{/if}
{/if}