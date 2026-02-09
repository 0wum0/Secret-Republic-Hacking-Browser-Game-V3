		{include file="header_home.tpl"}
		
    {if $logged}
      <div class="alert alert-info">
        {assign var="rankUrl" value="`$config.url`rankings/details/show"}
        {$L.RANK_DETAILS_LINK|replace:':url':$rankUrl}
      </div>
    {/if}
		{$rankingsGrid}
