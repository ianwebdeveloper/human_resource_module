<div class="HR_admin_login">
<p id="HR_welcome">Welcome Admin</p>
<p id="HR_subtitle">Human Resource Module</p>
<div class="HR_logincontainer">
	<form id="HR_login" action="<?php echo base_url(); ?>administrator/login/login_validate" method="POST">
		<p><label >Username</label><br><input class="HR_username" value="" type="text" name="email"></p>
		<p><label >Password</label><br><input class="HR_password" value="" type="password" name="pword"></p>
		<p><input id="HR_signin_button" type="submit" value="Submit"></p>
	</form>
</div>
</div>

