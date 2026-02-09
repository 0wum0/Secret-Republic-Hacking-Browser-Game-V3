<div class="panel panel-glass ">
	<div class="panel-heading">{$L.HACKDOWN_COUNTDOWN}</div>
	<div class="panel-body">
{include file="components/hackdown.tpl" countdownFrom=$hackdownRemaining totalCountdown=24*60*60
                                              textCountdown = "true" progressBarClass = "progress-info"
                                              progressBarCountdown = "true" reloadOnFinish = "true" 
                                              textLeft=$L.HACKDOWN_ENDS_IN}
</div>
</div>


		<div class="alert alert-warning">
			<p>
			{$L.HACKDOWN_TRAPPED}
			</p>
			<br/>
			<strong>{$L.HACKDOWN_KICK_20}</strong>
		</div>
		