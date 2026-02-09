{include file="header_home.tpl" no_sidebar=true no_menu=true}

    

      <div class="row text-center" style="margin-top:100px">
        <div class="col-md-6 text-left inline nofloat">
          {include file="error_success.tpl"}
          
           <div class="alphaGlow mb10">
     
            <form method="post">
              <button disabled class="disabled">{$L.FORGOT_HEADING}</button>
              <input type="hidden" name="process" value="true"/>
              <input style="border-top:0" type="email"  placeholder="{$L.FORGOT_EMAIL_PH}" value="{$smarty.post.email}" name="email" required />
           
			  <button type="submit" style="border-top:0;"><span class="glyphicon glyphicon-send"></span></button>
            </form>
          </div>
          <br/>
          
          <div class="well black text-center nomargin">

            {$L.FORGOT_CONTACT_TEAM}
          </div>
          <a href="{$config.url}" class="button text-center"><span class="glyphicon glyphicon-home"></span></a>
        </div>
      
      </div>
    	

						
	

		
  						
		
  						