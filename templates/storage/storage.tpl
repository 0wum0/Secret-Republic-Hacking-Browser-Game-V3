{include file="header_home.tpl"}
{include file="servers/servers_header.tpl"}


{include file="error_success.tpl"}	

{if $load eq "mount_component"}


{include file="storage/mount_component.tpl"}	

{else}

<div class="panel panel-glass">
	<div class="panel-heading">
		{$L.STORAGE_AREA}
	</div>
	<div class="panel-body text-center">
		<p>{$L.STORAGE_SLOTS_INFO}</p>
		{if  !$smarty.session.removeAds}<p><a href="{$config.url}alpha_coins/option/extraStorage1">{$L.STORAGE_MORE_SLOTS}</a>.</p>{/if}
		{$L.STORAGE_SELL_INFO}
		
	</div>
	<div class="panel-footer text-right">
		{$L.STORAGE_SLOTS_STATUS|replace:':available':$availableSlots|replace:':used':($storage|count)}
	</div>
</div>	
<br/>
 
<div id="accordion" role="tablist" aria-multiselectable="true">
<div class="row">
<div class="col-md-6">
{foreach from = $storage key = k item = s}
	{if $k%2 == 0}
	 {include file="storage/storageBit.tpl"}
	
	{/if}
{/foreach}
</div>

<div class="col-md-6">
{foreach from = $storage key = k item = s}
	{if $k%2 != 0}
	 {include file="storage/storageBit.tpl"}
	
	{/if}
{/foreach}
</div>

</div>
{/if}


 
 
</div>