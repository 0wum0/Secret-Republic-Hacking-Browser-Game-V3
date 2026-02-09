{include file="header_home.tpl"}

{include file="error_success.tpl"}

<h2>{$L.QUEST_FEEDBACK_FOR|replace:':title':$feedback.title}</h2>
<hr/>
<div class="alert alert-warning">
	All our missions are in beta test so we'd like to receive your <strong>OPTIONAL</strong> feedback. Feel free to skip it if you so desire.
</div>
 
 <form method="post">
 
 <div class="row">
 	<div class="col-md-9">
		 <textarea name="feedback" style="height:350px">{$smarty.post.feedback}</textarea>
	</div>
	<div class="col-md-3">
		<button disabled>{$L.QUEST_DIFFICULTY}</button><br/>
		<select name="difficulty_rating">
		{for $foo=1 to 10}
			<option value="{$foo}" {if $smarty.post.difficulty_rating eq $foo}selected{/if}>{$foo}</option>
		{/for}
		</select>
		<br/><br/>
		<button disabled>{$L.QUEST_TIME}</button><br/>
		<select name="time_rating">
		{for $foo=1 to 10}
			<option value="{$foo}" {if $smarty.post.time_rating eq $foo}selected{/if}>{$foo}</option>
		{/for}
		</select>
		<br/><br/>
		<button disabled>{$L.QUEST_REPLAY_VALUE}</button><br/>
		<select name="replay_rating">
		{for $foo=1 to 10}
			<option value="{$foo}" {if $smarty.post.replay_rating eq $foo}selected{/if}>{$foo}</option>
		{/for}
		</select>
	</div>	
 </div>
 

 <br/>
 <div class="row">
 <div class="col-md-9">
 <button type="submit"><span class="glyphicon glyphicon-send"></span></button>
 </div>
 <div class="col-md-3">
 <a href="{$config.url}quests" class="button text-center"><span class="glyphicon glyphicon-remove-sign"></span></a>
 </div>
 </div>
 </form>