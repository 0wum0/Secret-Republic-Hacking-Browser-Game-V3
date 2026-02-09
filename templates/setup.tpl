{include file="header_home.tpl"}
  <form method="post">
	<div class="row-fluid">
	<div class="col-md-3"></div>
		<div class="col-md-6 col-xs-6 nopadding">
			<input  type="text" placeholder="{$L.INSTALL_DB_HOST}" value="localhost" name="DB_HOST" required/>
			<input  type="text" placeholder="{$L.INSTALL_DB_PORT}" value="3306" name="DB_PORT" required/>
			<input  type="text" placeholder="{$L.INSTALL_DB_USER}" value="root" name="DB_USER" required/>
			<input  type="text" placeholder="{$L.INSTALL_DB_PASS}" value="" name="DB_PASS"/>
			<input  type="text" placeholder="{$L.INSTALL_DB_NAME}" value="" name="DB_NAME" required/>
			<input  type="text" placeholder="{$L.INSTALL_ADMIN_USER}" value="" name="ADMIN_USER" required/>
			<input  type="text" placeholder="{$L.INSTALL_ADMIN_PASS}" value="" name="ADMIN_PASS" required/>
			<input  type="email" placeholder="{$L.INSTALL_ADMIN_EMAIL}" value="" name="ADMIN_EMAIL" required/>
			<br/><br/>
			<button type="submit" style="border-top:0;">{$L.INSTALL_SETUP}</button>
		</div>
	</div>
</form>