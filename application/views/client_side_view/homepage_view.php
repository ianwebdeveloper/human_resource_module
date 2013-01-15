<div class="hr_headboard">
<p id="HR_frontwelcome">Xavier Ecoville</p>
<p id="HR_frontsubtitle">Human Resource Module</p>

</div>
<div class="hr_front_login_div">
	<form id="HR_frontlogin" action="<?php echo base_url(); ?>home/login_validate" method="POST">
		<p><label>Email</label><br><input class="HR_frontusername" type="text" name="email"></p>
		<p><label>Password</label><br><input class="HR_frontpassword" type="password" name="pword"></p>
		<p class="hr_loginBtn_p"><input class="hr_loginBtn" type="submit" value="Log In"></p>	
		<p class="hr_front_register_p" ><a href="<?php echo base_url(); ?>home/registration/" >Register</a></p>	
	</form>
</div>
<div class="hr_footboard">
<p id="HR_frontfooter">Human Resource Module<br><span>All Rights Reserved.</span></p>
</div>