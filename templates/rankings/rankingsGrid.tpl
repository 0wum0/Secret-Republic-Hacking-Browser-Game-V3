<div class="mb10">
      <div class="row mb10">
    
            <div class="col-xs-6 ">
              {if $users}
                <button  disabled class="disabled">{$L.RANK_HACKERS}</button>
              {else}
                <a href="{$config.url}rankings"><button>{$L.RANK_HACKERS_BTN}</button></a>
              {/if}
            </div>
            <div class="col-xs-6 ">
              {if $orgs}
                <button  disabled class="disabled">{$L.RANK_ORGS_BTN}</button>
              {else}
                <a href="{$config.url}rankings/type/orgs"><button>{$L.RANK_ORGS_BTN}</button></a>
              {/if}

            </div>
 
      </div>
      {if $users}
      <div class="row">
          {for $index=1 to 6}
            <div class="col-sm-2 col-xs-4 mb10">
            {if $zone eq $index}
              <button disabled class="disabled">Zone {$index|romanic_number}</button>
            {else}
              <a href="{$config.url}rankings/zone/{$index}"><button>ZONE {$index|romanic_number}</button></a>
            {/if}
            </div>
          {/for}
      </div>
      {/if}
		</div>
		
	
		{if $orgs}
		  {foreach from = $orgs item = org}
        <div class="row mb10">
   
                <div class="col-xs-1 ">
                  <button disabled>#{$org.orank}</button>
                </div>
              <div class="col-xs-8 col-md-5 ">
                <div class="well black nomargin">
                  <a href="{$config.url}organization/show/{$org.id}">{$org.name}</a>
                </div>
              </div>
              <div class="col-xs-3 hidden-xs hidden-sm">
                <button disabled class="disabled ">
                 {$org.nrm} {$L.RANK_MEMBERS}
                </button>
              </div>
              <div class="col-xs-3 ">
                <button disabled class="disabled">
                {$org.points|floatval|number_format} {$L.UI_POINTS}
                </button>
              </div>
          
        </div>
		  {/foreach}
	
		{elseif $users}
        <div class="row mb10">
          {for $i=0 to 2}

              <div class="col-md-4 mb10">
                <div class="row">
                 
                      <div class="col-xs-3 ">
                        <button disabled>{$topUsers[$i].rank|romanic_number}</button>
                      </div>
                      <div class="col-xs-9 ">

                        <a href="{$config.url}profile/hacker/{$topUsers[$i].username}" class="button text-center">
							<img src="http://www.gravatar.com/avatar/{$topUsers[$i].gavatar}?s=20" style="border-radius:50%"/>&nbsp;&nbsp;{$topUsers[$i].username}</a>
                      </div>
                    
                </div>
              </div>
           {/for}
            
        </div>
		
		
		  <div class="text-center">
		   {$pages}
		</div>
		
		  {foreach from = $users item = aUser}
		  <div class="row mb10" id="place_{$aUser.rank}">
            {if $aUser.rank lte 3}
              <div class="col-xs-{5-$aUser.rank} ">
                <button disabled>{if $aUser.rank eq 1}{$L.RANK_1ST}{elseif $aUser.rank eq 2}{$L.RANK_2ND}{else}{$L.RANK_3RD}{/if}</button>
              </div>
            {else}
              <div class="col-xs-1 ">
                <button disabled>{$aUser.rank|floatval|number_format}</button>
              </div>
            {/if}
            {if $aUser.rank lte 3}
              <div class="col-md-{$aUser.rank+5} col-xs-{$aUser.rank+3} ">
                {else}
              <div class="col-md-9 col-xs-7 ">{/if}
              <div class="well black nomargin">
                <img src="http://www.gravatar.com/avatar/{$aUser.gavatar}?s=20" style="border-radius:50%"/>&nbsp;&nbsp;{$aUser.username|profile_link} ({$aUser.level})
              </div>
            </div>
            
	
            <div class="col-md-2 col-xs-4 ">
              <button disabled class="disabled">
              {$aUser.points|floatval|number_format} {$L.UI_POINTS}
              </button>
          </div>
      </div>
      {foreachelse}
      <div class="well text-center">
        {$L.RANK_NO_HACKERS}
        </div>
		  {/foreach}
		
		{/if}
		
		<div class="text-center">
		   {$pages}
		</div>