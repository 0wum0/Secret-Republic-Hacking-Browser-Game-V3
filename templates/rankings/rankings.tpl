		{include file="header_home.tpl"}
		
    {if $logged}
      <div class="alert alert-info">
        {$L.RANK_DETAILS_LINK|replace:':url':"{$config.url}rankings/details/show"}
      </div>
    {/if}
		{$rankingsGrid}
