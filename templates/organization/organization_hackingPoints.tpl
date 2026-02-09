<div class="panel panel-glass">
	
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						
						<button disabled>{$L.ORG_LEVEL_LABEL|replace:':level':$org.level|replace:':exp':{$org.exp|floatval|number_format}|replace:':expNext':{$org.expNext|floatval|number_format}}</button>
						
					</div>
					<div class="col-md-8">
						<button  disabled class=" nopadding" style="width:{$org.exp/($org.expNext/100)}%;"> </button>
					</div>
				</div>
			</div>
		
		</div>	
<div class="panel panel-glass">
	<div class="panel-heading">
		{$L.ORG_HP_DAILY_TITLE}
	</div>
	{if $lastHack.created}
			<div class="panel-body">
				{include file="components/hackdown.tpl" countdownFrom=$lastHack.created + 24*60*60 - time() totalCountdown=24*60*60
                                              textCountdown = "true" progressBarClass = "progress-info"
                                              progressBarCountdown = "true" reloadOnFinish = "true" 
                                              textLeft=$L.ORG_HP_FIELD_AGAIN}
				
				
			</div>
		{else}
		<form method="post">
			<button type="submit" name="hack" value="true"><span class="glyphicon glyphicon-play"></span></button>
		</form>
		{/if}
		</div>	
		
		
		
		<div class="row mb10">
  <div class="col-md-3 text-center">
    <button disabled class="disabled">{$L.ORG_HP_LABEL}</button>
    <h1>{$org.hacking_points|floatval|number_format}</h1>
  </div>
  <div class="col-md-9">
  <div class="well">
  <p>
  {$L.ORG_HP_DESC}
  </p>
  {$L.ORG_HP_EXP_DESC}
  <hr/>
  {$L.ORG_HP_USE_CREDITS|replace:':name':$org.name}
  </div>
  {if $access.manageHackingPoints}
  <form method="post">
    <input type="submit" name="upgradeNRM" value="{$L.ORG_HP_UPGRADE_NRM|replace:':cost':$nrmUpgradeCost}"/>
  </form>
  {/if}
  </div>
</div>
<br/>
<div class="row mb10" id="showFrame">
	<div class="col-xs-6">
		<a href="{$config.url}organization/show/{$org.id}/view/hackingPoints/rankings/go#showFrame">
			<button {if $GET.rankings}disabled{/if}>{$L.ORG_HP_RANKINGS}</button>
		</a>
	</div>
	<div class="col-xs-6">
		<a href="{$config.url}organization/show/{$org.id}/view/hackingPoints/history/go#showFrame">
			<button {if $GET.history}disabled{/if}>{$L.ORG_HP_HISTORY}</button>
		</a>
	</div>
</div>
<br/>
{if $GET.rankings}

{foreach $rankings as $key => $member}
<div class="row mb10">
	<div class="col-xs-2">
		<button disabled>
			#{$key+1}
		</button>
	</div>
	<div class="col-xs-6">
		
		<a href="{$config.url}profile/hacker/{$member.username}"><button class="text-left">{$member.username}</button></a>
		

	</div>
	<div class="col-xs-4">
		<button disabled >
			{$member.hackingPoints|floatval|number_format} HP's
		</button>
	</div>
</div>
{/foreach}

{elseif $GET.history}

<div class="alert alert-info">
{$L.ORG_HP_ANCIENT}
</div>
{foreach $history as $entry}
<div class="row mb10">
	<div class="col-md-5 col-xs-12">
		{if $entry.source_type eq 1}
		<a href="{$config.url}profile/hacker/{$entry.username}"><button class="text-left">{$entry.username}</button></a>
		{elseif $entry.source_type eq 2}
			<button disabled class="text-left">HACKDOWN</button>
		{/if}
	</div>
	<div class="col-xs-6 col-md-2">
		<button disabled>{$entry.hackingPoints|floatval|number_format} HP</button>
	</div>
	<div class="col-xs-6 col-md-5 ">
		<button disabled class="cut-text text-right">{$entry.created|date_fashion}
	</div>
</div>
{foreachelse}
<div class="well">
{$L.ORG_HP_NO_LOGS}
</div>
{/foreach}
{/if}

<div class="text-center">
{$pages}
</div>