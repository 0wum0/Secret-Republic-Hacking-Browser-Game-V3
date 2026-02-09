
      </div> <!-- span -->
      </div> <!-- row -->
	  
	  {if $user.rewardsToReceive}
	  	<a href="{$config.url}rewards" >
	  	<button class="rewards-icon"  title="{$user.rewardsToReceive} {$L.REWARDS_TITLE}">
		
		
		<span class="glyphicon glyphicon-gift" id="rewards2"></span>
		
		</button></a>
	  {/if}
	  
	   {if $user.newMsg}
	  	<a href="{$config.url}conversations" >
	  	<button class="messages-icon"  title="{$user.newMsg} {$L.NAV_MESSAGES}">
		<span class="glyphicon glyphicon-envelope" id="newMsg2"></span>

		</button></a>
	  {/if}

	{if $myModals and $myModals|count}	  
	  {foreach $myModals as $myModal}
	  {if $myModal.title}
		{include file="dialogs/osx_dialog_box.tpl" id='modalPopup{$myModal.id}' title=$myModal.title content=$myModal.content}

	  {/if}

	  {/foreach}
	  
	   
 	<script type="text/javascript">$(window).load(function(){
 	{foreach $myModals as $myModal}
		{if $myModal.show}
		$('#myModalmodalPopup{$myModal.id}').modal('show'); 
		{/if}
	{/foreach}
	
	});
	</script>

{/if}
 
   

  
      {if !$no_footer && !$detectDevice.mobile}
	
		
        {if !$no_footer_bar}
        <div class="row-fluid mb10">
   				<div class="col-md-12">
				<div style="height:111px"></div>
				</div>
              <div class="col-md-10  ">
              
                <div class="well black ">
				

							<small>&copy; {"Y"|date} the secret republic</small>

                </div>
              </div>
              <div class="col-md-2  visible-md visible-lg">
                {if $logged}
                  <a href="{$config.url}logout" class="button text-center"><span class="glyphicon glyphicon-off"></span></a>
                {else}
                  <a href="{$config.url}" class="text-center button">{$L.FOOTER_GUEST}</a>
                {/if}
              </div>
          
        </div>
       
		
        {/if}
      
			<div class="row-fluid  ">
			  <div class="col-md-12 text-center footer">
			  <br/>
			  <p>
			  
			  
			  <a href="{$config.url}theWorld" title="{$L.FOOTER_WORLD_STATS}"> {$L.FOOTER_WORLD_STATS}</a>
				<a href="{$config.url}rankings" title="{$L.FOOTER_RANKINGS}">{$L.FOOTER_RANKINGS}</a>
				
        <a href="{$config.url}blogs/" title="{$L.FOOTER_BLOGS}">{$L.FOOTER_BLOGS}</a>
        <a href="{$config.url}blogs/latestArticles/eve" title="{$L.FOOTER_ARTICLES}">{$L.FOOTER_ARTICLES}</a>
        <a href="{$config.url}frequently-asked-questions" title="{$L.FAQ_TITLE}">{$L.FOOTER_FAQ}</a>
        <a href="{$config.url}pages/page/beginner-tutorial">{$L.FOOTER_BEGINNER_INTRO}</a>

				
				</p>
        <p>
          <a href="{$config.url}pages/page/about">{$L.FOOTER_ABOUT}</a>
        <a href="{$config.url}forum" title="{$L.FOOTER_FORUMS}">{$L.FOOTER_FORUMS}</a>
          <a href="{$config.url}pages/page/media">{$L.FOOTER_ARTWORK}</a>
          <a href="{$config.url}pages/page/terms-of-service">{$L.FOOTER_TOS}</a>
        <a href="{$config.url}support">{$L.FOOTER_SUPPORT}</a>

        </p>
			
				<a onclick="scrollToElement('#body');"><span class="glyphicon glyphicon-chevron-up"></span></a>



			  </div>
			</div>
			<div class="row-fluid">
			<div class="col-md-12">
			<div style="height:20px">
			</div>
			</div></div>
		{else}
		<div class="row-fluid">
			<div class="col-md-12">
			<div style="height:100px">
			</div>
			</div></div>
       {/if}
       	{if $user.cardinal}
	  <h3>{$L.FOOTER_DEBUG_QUERIES}</h3>
		<p style="white-space:break-spaces;">
			{$queries|var_export}
			</p>
		{/if}

	 	</div>

	
	</div>
	

	

	
    
    <script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
	  



    <script type="text/javascript" src="{$config.url}layout/js/global.js?cache=3ffsf44ff"></script>
  
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    

{if $messenger and ($messenger|count or $GET.currentPage eq "quests/quests")}
		<!-- MESSENGER -->
		<script type="text/javascript" src="{$config.url}layout/messenger/js/messenger.min.js"></script>
		<script type="text/javascript" src="{$config.url}layout/messenger/js/messenger-theme-future.js"></script>
		  <link rel="stylesheet" href="{$config.url}layout/messenger/css/messenger.min.css" type="text/css"/>


		  <script type="text/javascript">

			Messenger.options = {}

			{foreach from=$messenger item=message}
			  Messenger().post({
			  message: "{$message.message}",
			  {if isset($message.type)}
			  type: '{$message.type}',
			  {/if}
			});
			{/foreach}

		  </script>
		  {/if}
		  
  
</body>
</html>
