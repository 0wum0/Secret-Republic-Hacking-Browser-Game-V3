
{include file="header_home.tpl" no_sidebar=$no_side}

      {include file="job/job_header.tpl"}

		
	
	
  {if !$trainTask}
 
  <div class="well text-center">
        
        <p>{$L.TRAIN_INTRO_1}</p>
		<p>{$L.TRAIN_INTRO_2}</p>
		<p>{$L.TRAIN_PATTERN_HINT}
		</p>
		{$L.TRAIN_INTRO_3}
      </div>
	   {include file="error_success.tpl"}
        {if !$trainLog.log_id}
        <form method="post">
        	<div class="row">
				<div class="col-xs-4">
					<button type="submit" name="train" value="low">{$L.TRAIN_LOW}</button>
				</div>
				<div class="col-xs-4">
					<button type="submit" name="train" value="mid">{$L.TRAIN_MID}</button>
				</div>
				<div class="col-xs-4">
					<button type="submit" name="train" value="high">{$L.TRAIN_HIGH}</button>
				</div>
			</div>
        </form>
        {else}
		
			<div class="panel panel-glass">
				
				<div class="panel-body">
					{include file="components/hackdown.tpl" countdownFrom=$trainLog.remaining totalCountdown=$trainEvery
                                              textCountdown = "true" progressBarClass = "progress-info"
                                              progressBarCountdown = "true" reloadOnFinish = "true" 
                                              textLeft=$L.TRAIN_AGAIN_IN}
				</div>
				<div class="panel-footer">{$L.TRAIN_ONCE_EVERY|replace:':time':$trainEvery|sec2hms}</div>
				
			</div>
        {/if}
  
  	<br/><br/>
	<h1 class="nomargin">{$L.TRAIN_HISTORY}</h1>
	<small><em>{$L.TRAIN_HISTORY_LAST}</em></small>
	<hr/>
	<div class="well black">
	{foreach from = $history item = train}
		<div class="row mb10">
			<div class="col-xs-2">
				{if $train.success}
					<div class="alert alert-success text-center nomargin">{$L.TRAIN_DONE}</div>
				{else}
					<div class="alert alert-danger text-center nomargin">{$L.TRAIN_FAILED}</div>
				{/if}
			</div>
			<div class="col-xs-7">
				<div class="well black nomargin">
					{$train.created|date_fashion}
				</div>
			</div>
			<div class="col-xs-3">
				{if $train.reward_id}
					<a href="{$config.url}rewards/myReward/{$train.reward_id}" title="{$L.REWARDS_TITLE}"><button><span class="glyphicon glyphicon-gift"></span></button></a>
				{/if}
			</div>
		</div>
	{foreachelse}
		<div class="alert alert-info text-center">
			{$L.TRAIN_NO_RECORDS}
		</div>
	{/foreach}
  </div>
    
  {else}
  <div class="row">

        <div class="col-xs-3 nopadding">
          <img src="{$config.url}layout/img/characters/rainless.png" class="" style="border:1px solid rgba(70, 120, 185, 0.4);max-width:100%" />
            
        </div>
        <div class="col-xs-9">
          <div class="well mb10">
           {include file="components/hackdown.tpl" countdownFrom=$trainTask.remainingSeconds totalCountdown=$trainTask.totalSeconds
                                              textCountdown = "true" progressBarClass = "progress-info"
                                              progressBarCountdown = "true" reloadOnFinish = "true" 
                                              textLeft=$L.TRAIN_COMPLETE_TASKS}

            </div>
            {include file="error_success.tpl"}
  	{if $trainTask.dataid eq 1}

             <form method="post">
			 	
            	<div class="panel panel-glass">
					<div class="panel-heading">{$L.TRAIN_MATCH}</div>
					<div class="panel-body text-center">
             		 {$captcha}
					 </div>
					  {assign var="stepsFormatted" value=$trainTask.steps|default:0|floatval|number_format}
				  <input type="submit" name="answer" value="{$L.TRAIN_DECRYPT|replace:':count':$stepsFormatted}"/>
            </div>
           
            </form>
          
  	{elseif $trainTask.dataid eq 2}
	
	<form method="post">
		<div class="panel panel-glass">
					<div class="panel-heading">{$L.TRAIN_FIND_X}</div>
					<div class="panel-body text-center">
             		 <div class="alert alert-warning">
				<strong>TIPS</strong> {$L.TRAIN_TIPS}
			</div>
		<h1 class="text-center" style="font-size:60px">
		{foreach $trainTask.step.numbers as $key => $number}
			{if $trainTask.step.answer_missing ne $key}
				{$number}
			{else }
				X
			{/if}
		{/foreach}
		</h1>
		
		
					 </div>
					 <div class="row-fluid">
					 	<div class="col-md-12">
							<div class="row">
								<div class="col-md-7 nopadding">
					 <input type="text" name="answer" placeholder="{$L.TRAIN_ANSWER_PH}" class="text-center" autocomplete="off" autofocus="autofocus"/>
					 			</div>
								<div class="col-md-5 nopadding">
					  {assign var="stepsFormatted" value=$trainTask.steps|default:0|floatval|number_format}
				  <input type="submit" value="{$L.TRAIN_FEELING_LUCKY|replace:':count':$stepsFormatted}"/>
					 			</div>
							</div>
						</div>
					</div>
            </div>
			</form>
			
			
	{/if}
	</div>
      
    </div>
	
  {/if}



	
	
		