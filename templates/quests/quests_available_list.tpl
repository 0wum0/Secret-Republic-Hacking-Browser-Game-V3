<h3 style="margin-bottom:0">{$L.QUEST_DAILIES}</h3>
<small>{$L.QUEST_DAILY_DESC}</small>
<hr/>
{assign var = found value = false}
{foreach from=$quests item=quest} 
{if $quest.type eq 1}
{assign var = found value = true}

<div class="row "  style="margin-bottom:40px">
   <div class="col-md-12">
      <div class="row-fluid">
     	<div class="col-xs-2 nopadding">
			<button disabled style="border-bottom:0; border-right:0">
            {if $quest.party}
            {$L.QUEST_PARTY}
            {else}
            {$L.QUEST_SOLO}
            {/if}
			</button>
         </div>
         <div class="col-xs-10 nopadding">
            <div class="well black nomargin">
               {$quest.title}
            </div>
         </div>
 			
		<div class="col-xs-12 nopadding">
			<div class="well black nomargin">
				{$quest.summary}
				
				
			</div>
			
			{if $quest.done}
			<div class="well  nomargin">
					{include file="components/hackdown.tpl" countdownFrom=$quest.done + 24*60*60 - time() totalCountdown=24*60*60
                                              textCountdown = "true" progressBarClass = "progress-info"
                                              progressBarCountdown = "true" reloadOnFinish = "true"
											  id=$quest.id
                                              textLeft=$L.QUEST_AVAIL_AGAIN}
											  </div>
				{/if}
		</div>
         {if !$quest.done}
         <div class="col-xs-12 nopadding">
            <a href="{$config.url}quests/group/{$quest.qgroup_id}/mission/{$quest.id}">
            <button><span class="glyphicon glyphicon-chevron-right"></span></button>
            </a>
         </div>
		 {/if}
      </div>
   </div>
</div>
{/if}
{/foreach}
{if !$found} 
	<div class="alert alert-warning">
		{$L.QUEST_NO_DAILY} 
	</div>
{/if}

<h3 style="margin-bottom:0">{$L.QUEST_NORMAL_REPEAT}</h3>
<small>{$L.QUEST_NORMAL_DESC}</small>
<hr/>
{assign var = found value = false}
{foreach from=$quests item=quest} 
{if $quest.type ne 1}
{assign var = found value = true}
<div class="row " style="margin-bottom:40px">
   <div class="col-md-12">
      <div class="row-fluid">
         <div class="col-xs-2 nopadding">
		 	<button disabled style="border-right:0;border-bottom:0">
            {if $quest.type eq 2}
            {if $quest.done}
            {$L.QUEST_REPEATABLE}
            {else}
            {$L.QUEST_NOT_DONE}
            {/if}
            {else}
            {if $quest.done}
            {$L.QUEST_DONE_LABEL}
            {else}
            {$L.QUEST_NOT_DONE}
            {/if}
            {/if}</button>
         </div>
         <div class="col-xs-10 nopadding">
            <div class="well black nomargin" >
               {$quest.title|strtoupper}
            </div>
         </div>
 		<div class="col-xs-12 nopadding">
			<div class="well black nomargin">
				{$quest.summary}
			</div>
		</div>
         <div class="col-xs-4 nopadding"><button disabled style="border-right:0" >
            {if $quest.party}
            {$L.QUEST_PARTY}
            {else}
            {$L.QUEST_SOLO}
            {/if}</button>
         </div>
         <div class="col-xs-8 nopadding">
            <a href="{$config.url}quests/group/{$quest.qgroup_id}/mission/{$quest.id}">
            <button><span class="glyphicon glyphicon-chevron-right"></span></button>
            </a>
         </div>
      </div>
   </div>
</div>
{/if}
{/foreach}

{if !$found} 
	<div class="alert alert-warning">
		{$L.QUEST_NO_NORMAL} 
	</div>
{/if}



