{include file="header_home.tpl"}

{include file="servers/servers_header.tpl"}

	  
{include file="error_success.tpl"}	






<div class="row">
	<div class="col-xs-10">
		<div class="well mb10">
		 			{$L.SERVERS_OWN_COUNT|replace:':count':{$servers|count}|replace:':max':$maxServers}
				
					
		</div>
	</div>
	<div class="col-xs-2">
		<a  href="{$config.url}frequently-asked-questions/open/about-servers">
			<button>
				<span class="fa fa-question-circle"></span>
			</button></a>
	</div>
</div>





<br/>
{foreach from=$servers key = key item=server}
<div class="row ">

<div class="col-lg-7 col-xs-12">
<a class="button mb10" href="{$config.url}servers/server/{$server.server_id}"><!--{$server.ip} - -->{$server.hostname}</a>
</div>

<div class="col-lg-3 col-xs-6">
	{if $server.damaged > 0}
		<div class="alert alert-danger text-center nomargin">
			{$L.SERVERS_DAMAGED_PCT|replace:':amount':{$server.damaged|round:2}}
		</div>
	{else}
		<div class="alert alert-info text-center nomargin">{$L.SERVERS_UNDAMAGED}</div>
	{/if}
</div>
<div class="col-lg-2 col-xs-6">
	{if $user.server eq $server.server_id}
		
	{else}
		<form method="post">
			<button name="main" value="{$server.server_id}" type="submit" title="{$L.SERVERS_SET_MAIN}">{$L.SERVERS_MAIN_LABEL}</button>
		</form>
	{/if}
</div>

</div>

{foreachelse}
<button disabled>{$L.SERVERS_NO_SERVERS|replace:':shop_url':"{$config.url}shop"|replace:':build_url':"{$config.url}servers/build/hell"}</button>
{/foreach}

<div style="padding:20px">
	<a class="button text-center" href="{$config.url}servers/build/hell">{$L.SERVERS_BUILD_NEW}</a>
</div>