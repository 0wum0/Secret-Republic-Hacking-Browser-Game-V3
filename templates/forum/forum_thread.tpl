<div class="Mary-AI">
<div class="futureNav middle ">
 <ul>
    <li><a href="{$furl}" ><div>{$L.FORUM_NAV}</div></a></li>
    <li><a href="{$furl}fid/{$forum.id}" ><div>{$forum.name}</div></a></li>
    <li><a href="{$url}"  ><div>{$thread.title}</div></a></li> 
  </ul>
</div>

<div class="row">
	<div class="col-md-7">
		<h3>{$thread.title}</h3>
		<h5>{$L.FORUM_STARTED_BY|replace:':user':{$thread.user|profile_link}|replace:':url':"{$furl}fid/{$forum.id}"|replace:':forum':$forum.name|replace:':date':{$thread.created|date_fashion}}</h5>
	</div>
	
</div>
<br/>

<div class="row">
	<div class="col-md-12">
		<div class="row-fluid">
		<div class="col-md-2 col-xs-6 nopadding">
				 {if $thread.closed && !$forumAccess.forumManager} 
				  <a><button>CLOSED</button></a>
				 {else} 
				  <a href="#quick_reply" class="button text-center">{$L.UI_ADD_REPLY}</a>
				{/if}
			</div>
		{if $forumAccess.forumManager}
			<div class="col-md-2 nopadding">
				 
				<form method="post">
					<button type="submit" name="stick" value="true">{if $thread.stick}UNPIN{else}<span class="glyphicon glyphicon-pushpin"></span>{/if}</button>
				
				</form>
				 
			</div>
			{/if}
			{if $forumAccess.forumManager}
			<div class="col-md-2 nopadding">
				 
				<form method="post">
				    <button type="submit" name="close" value="true">{if $thread.closed}Open{else}<span class="glyphicon glyphicon-lock"></span>{/if}</button>
				
				</form>
				 
			</div>
			{/if}
			
		</div>
	</div>
</div>
<br/>
</div>
 {include file="error_success.tpl"} 
 {foreach from=$posts key=k item=p} 
 	{include file="forum/post_bit.tpl"} 
 {foreachelse} <hr/>
<div class="well text-center">
	 {$L.UI_NO_REPLIES_YET}
</div>
 {/foreach} 
 
 <div class="text-center">
 {$pages} 
 </div>
 
 {if $logged} 
 
    {if !$thread.closed || $forumAccess.forumManager }
    {if $thread.closed}
      <div class="alert alert-danger">
        {$L.UI_CLOSED_THREAD_REPLY}
      </div>
    {/if}
    <form method="post" id="quick_reply">
      <textarea name="reply" maxlength="{$config.forum_post_size}">{$smarty.post.reply}</textarea><br/>
      <div class="row">
        <div class="col-md-12">
          <div class="row-fluid">
            <div class="col-md-7 nopadding">
             
			  <button type="submit"><span class="glyphicon glyphicon-send"></span></button>
            </div>
            <div class="col-md-5 nopadding">
              {include file="text_decorations.tpl"}
            </div>
          </div>
        </div>
      </div>
    </form>
     {else}
    <div class="alert alert-danger text-center">
       Thread closed
    </div>
     {/if} 
     
 {else}
<div class="well text-center">
	 {$L.UI_MUST_CONNECT_REPLY}
</div>
				{/if}
				<br/>