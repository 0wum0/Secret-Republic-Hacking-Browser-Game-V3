

{if   ($smarty.session.premium.questManager || $user.adminNav )}
  
  <div class="adminIcon" >
  <h1>
  		<span class="glyphicon glyphicon-cog cursor"></span> 
		</h1>
  
    
  </div>
  


            <ul class="sidebar-nav " id="adminNavigation">
           		

				  {if $user.userList}
					<li>  <a href="{$config.url}admin/view/registered">{$L.ADMIN_HACKERS}</a></li>
					<li>  <a href="{$config.url}admin/view/registered/online/true">{$L.ADMIN_ONLINE}</a></li>
				  {/if}
				  
				  {if $user.questManager || $smarty.session.premium.questManager}
					<li>  <a href="{$config.url}admin/view/manageQuest">{$L.ADMIN_MISSIONS}</a></li>
				  {/if}

				  {if $user.manageAchievements}
					<li><a href="{$config.url}admin/view/achievements">{$L.ADMIN_ACHIEVEMENTS}</a></li>
				  {/if}
				  {if $user.levelManager}
					<li>  <a href="{$config.url}admin/view/levelRewards">{$L.ADMIN_LEVEL_REWARDS}</a></li>
				  {/if}
				  {if $user.emailTemplatesManager}
					<li>  <a href="{$config.url}admin/view/emailTemplates">{$L.ADMIN_EMAIL_TEMPLATES}</a></li>
				  {/if}
				  {if $user.dataManager}
					<li>  <a href="{$config.url}admin/view/data">{$L.ADMIN_DATA}</a></li>
				  {/if}

				  {if $user.cardinal}

					 
					
					<li>  <a href="{$config.url}admin/view/attacks">{$L.ADMIN_ATTACKS}</a></li>
					<li>  <a href="{$config.url}admin/view/errors">{$L.ADMIN_DEBUG}</a></li>
				  {/if}

				

            
            </ul>
		

{/if}
