{include file="header_home.tpl" no_sidebar=true no_menu=true}

    

      <div class="row text-center" style="margin-top:100px">
        <div class="col-md-6 text-left inline nofloat">
          {include file="error_success.tpl"}
          
           <div class="alphaGlow mb10">
     
            <form method="post">
              <button disabled class="disabled">{$L.FORGOT_ENTER_NEW}</button>
              <input type="hidden" name="process" value="true"/>
              <input style="border-top:0" type="password"  placeholder="{$L.FORGOT_PASS_PH}" name="password" required />
              <input style="border-top:0" type="password"  placeholder="{$L.FORGOT_CONFIRM_PH}" name="confirm_password" required />
              <input type="submit" value="{$L.FORGOT_CHANGE_BTN}" style="border-top:0;"/>
            </form>
          </div>
         <br/><br/><br/><br/>
          
          
      
      </div>
    	

						
	

		
  						
		
  						