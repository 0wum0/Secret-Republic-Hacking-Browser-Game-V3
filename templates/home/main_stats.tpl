<br/>
	  <strong><em>{$L.VISITOR_HACKERS_GRID|replace:':count':$online|number_format}</em> </strong>
	   <br/> <br/>
	  <h4>{$L.VISITOR_NEWEST}</h4>
      {foreach from = $orgHackers item = item}
        {if $item.name}
          <a href="{$config.url}organization/show/{$item.id}">{$item.name}</a>
        {else}
          <a href="{$config.url}profile/hacker/{$item.username}">{$item.username}</a>
        {/if}
      {/foreach}
	  
	  
	  <br/>
	 
	
	  <br/>
    <p>
  {$L.VISITOR_LATEST_NEWS} | <a href="{$config.url}forum/tid/{$lastNews.tid}">{$lastNews.title}</a>
</p>
  {$L.VISITOR_LAST_ARTICLE} | <a href="{$config.url}blog/article/{$lastArticle.article_id}">{$lastArticle.title}</a>
	  
	 
	  <br/><br/>
	  <strong>{$L.VISITOR_RANDOM_REVIEW}</strong> 
	  <em>
	  
	  {$review}
		</em>