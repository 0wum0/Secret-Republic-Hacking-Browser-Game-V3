{include file="header_home.tpl" no_sidebar = true}

{include file="error_success.tpl"}

<div class="row">
  <div class="col-md-12">
    <div class="row-fluid">
      <div class="hidden-xs hidden-sm col-md-4 text-center">
        <img src="{$config.url}layout/img/characters/Irene-A.I.png" style="max-width:100%;"/>
      </div><!-etta_medium-->
      <div class="col-md-8">
        <h1 class="text-center" style="text-transform:uppercase; color:rgb(199, 199, 199);font-size:30px;">
          <span class="glyphicon glyphicon-gift" style="font-size:100px"></span><br/><br/>
          {$reward.title}</h1><br/>

	  	
      <div class="panel panel-white panel-white-card" style="text-transform:uppercase">
          {if $reward.received}
       <div class="panel-heading">{$L.REWARDS_CLAIMED_ON} {$reward.received|date_fashion}</div>
      {/if}

          <div class="panel-body">
      	  	{if $reward.alphaCoins}
      			<div class="row">
      				<div class="col-md-7">
      					{$L.REWARDS_ALPHA_COINS}
      				</div>
      				<div class="col-md-5">
      					{$reward.alphaCoins|floatval|number_format} AC
      				</div>
      			</div>
      		  {/if}
            {if $reward.dataPoints}
              <div class="row">
                <div class="col-md-7">
                  {$L.REWARDS_DATA_POINTS}
                </div>
                <div class="col-md-5">
                  {$reward.dataPoints|floatval|number_format:2}
                </div>
              </div>
            {/if}
            {if $reward.money}
              <div class="row">
         
                    <div class="col-md-7 ">
                        {$L.REWARDS_MONEY}
                    </div>
                    <div class="col-md-5 ">
                        {$reward.money|floatval|number_format}$
                    </div>
                  
               
              </div>
            {/if}
            {if $reward.exp}
              <div class="row">
               
                    <div class="col-md-7 ">
                        {$L.REWARDS_EXPERIENCE}
                    </div>
                    <div class="col-md-5 ">
                        {$reward.exp|floatval|number_format} {$L.UI_POINTS}
                    </div>
                  
                
              </div>
            {/if}
            
            {if $reward.skillPoints}
              <div class="row">
              
                    <div class="col-md-7 ">
                        {$L.REWARDS_SKILL_POINTS}
                    </div>
                    <div class="col-md-5 ">
                        {$reward.skillPoints|floatval|number_format} {$L.UI_POINTS}
                    </div>
                
              </div>
            {/if}

        
            {if $reward.energy}
              <div class="row">
            
                    <div class="col-md-7 ">
                        {$L.REWARDS_ENERGY}
                    </div>
                    <div class="col-md-5 ">
                        +{$reward.energy|floatval|number_format}
                    </div>
                  
                 
              </div>
            {/if}
            
             {if $reward.jobExp}
              <div class="row">
              
                    <div class="col-md-7 ">
                        {$L.REWARDS_JOB_EXP}
                    </div>
                    <div class="col-md-5 ">
                        {$reward.jobExp|floatval|number_format} {$L.UI_POINTS}
                    </div>
                  
             
              </div>
            {/if}

              
              {if $reward.skills and $reward.skills|count}
                <h2 class="white-holder">{$L.REWARDS_SKILLS}</h2>

                    {foreach from=$reward.skills key=skill item=amount}
                      <div class="row ">
                            <div class="col-xs-9 text-left">
                                 {$theskills[$skill].name}
                            </div>
                            <div class="col-xs-3  text-right">
                               {$amount|floatval|number_format} {$L.UI_POINTS}
                            </div>
                      </div>
                   {/foreach}

                {/if}

                {if $reward.achievements|is_array and $reward.achievements|count}
     
                <h2 class="white-holder">{$L.REWARDS_ACHIEVEMENTS}</h2>
                {include file='profile/achievements.tpl' achievements = $reward.achievements panelClass='panel-white'}
            
                
              {/if}

              {if $reward.applications && $reward.applications|is_array}
                <h2 class="white-holder">{$L.REWARDS_APPLICATIONS}</h2>

                {foreach $reward.applications as $app}
                      <div class="row ">
                            <div class="col-xs-9 text-left">
                                 {$app.name}
                            </div>
                            <div class="col-xs-3  text-right">
                               {$app.damage}% {$L.UI_DAMAGED}
                            </div>
                      </div>
                   {/foreach}

                   {if !$reward.received}
                   <div class="alert alert-info" style="text-transform:none; line-height:initial">
                     {$L.REWARDS_APP_HINT}
                   </div>
                   {/if}
              {/if}

              {if $reward.components && $reward.components|is_array}
                <h2 class="white-holder">{$L.REWARDS_COMPONENTS}</h2>

                {foreach $reward.components as $comp}

                      <div class="row ">
                            <div class="col-xs-9 text-left">
                                 {$comp.name}
                            </div>
                            <div class="col-xs-3  text-right">

                               {$comp.damage}% {$L.UI_DAMAGED}
                            </div>
                      </div>
                   {/foreach}
                   {if !$reward.received}
                   <div class="alert alert-info" style="text-transform:none; line-height:initial">
                     {$L.REWARDS_COMP_HINT}
                   </div>
                   {/if}
              {/if}

           </div>

           {if !$reward.received}
              <form method="post">
                <input type="submit" name="receive" class="button-white" value="{$L.REWARDS_CLAIM_BTN}" style="height:70px;font-size:20px; border-left:0!important; border-right:0!important;border-bottom:0!important"/>
              </form>
              
            {/if}

         </div>
	
        
        
        <!--
		
		{if $reward.components|is_array and $reward.components|count}
			{foreach $reward.components as $item}
				<div class="panel panel-glass">
					<div class="panel-heading">{$item.name}</div>
					<div class="panel-body">
						{include file="storage/item_description.tpl"}
					</div>
				</div>
			{/foreach}
		{/if}-->
        
      </div>
    </div>
  </div>
</div>
