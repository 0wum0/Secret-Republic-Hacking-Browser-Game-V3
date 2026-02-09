

	<div class=" button-stack mb10" >
	<Button disabled><span class="glyphicon glyphicon-console"></span></button>
	{if $dailies|count}
	{foreach $dailies as $daily}

<a href="{$config.url}quests/group/{$daily.qgroup_id}/{$daily.id}" class="text-center button  cut-text" title="{$L.QUEST_DAILY_MISSION}">
[D] {$daily.title} 
</a>


{/foreach}
	
	
{/if}

{foreach from = $groups item = group}
<a href="{$config.url}quests/group/{$group.qgroup_id}" class="text-center button  cut-text" title="{$group.nrQuests - $group.questsDone} uncompleted missions">
{$group.name} ({$group.questsDone}/{$group.nrQuests})
</a>

{foreachelse}
<button class="disabled mb10" disabled>{$L.QUEST_NO_INCOMPLETE}</button>
{/foreach}
	

</div>

<br/>
<div class="button-stack mb10">
{if $can_train}
	<a href="{$config.url}train" class="button text-center">
	{$L.QUEST_TRAIN}
	
	</a>
	{/if}
	{if $can_work}
	<a href="{$config.url}job" class="button text-center">
	{$L.QUEST_WORK}
	
	</a>
	{/if}
	</div>
