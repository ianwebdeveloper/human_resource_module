<div class="hr_contentpaperlogged">
<div class="hr_edit_profile_div">
<?php foreach($records as $rec): ?>
<form action="<?php echo base_url(); ?>a/profile/edit_validate/<?php echo $rec->account_id; ?>" method="POST">
	<p id="HR_titledesign">Edit Profile</p>

	<p><label>First Name</label><input type='text' name='fname' value="<?php echo $rec->fname; ?>" /><label class="errorMsg"><?php echo form_error('fname'); ?></label></p>
	<p><label>Middle Name</label><input type='text' name='mname' value="<?php echo $rec->mname; ?>"  /><label class="errorMsg"><?php echo form_error('mname'); ?></label></p>
	<p><label>Last Name</label><input type='text' name='lname' value="<?php echo $rec->lname;; ?>"  /><label class="errorMsg"><?php echo form_error('lname'); ?></label></p>
	<p><label>Date of Birth</label><input type='text' class="hr_DOB" name='DOB' value="<?php echo formattedDateMMDDYY($rec->DOB); ?>"  /><label class="errorMsg"><?php echo form_error('DOB'); ?></label></p>
	<p><label>Age</label><?php echo getAge(formattedDateMMDDYY($rec->DOB)); ?></p>
	<p><label>Gender</label>
	<?php if($rec->gender == "Male"):?>
		<select name="gender">
		<option value="Male" selected="selected">Male</option>
		<option value="Female">Female</option>
		</select><label class="errorMsg"><?php echo form_error('gender'); ?></label></p>
	<?php elseif ($rec->gender == "Female"): ?>
		<select name="gender">
		<option value="Male">Male</option>
		<option value="Female" selected="selected">Female</option>
	</select><label class="errorMsg"><?php echo form_error('gender'); ?></label></p>
	<?php endif; ?>

	<p><label>Address</label><input type='text' name='address' value="<?php echo $rec->address; ?>"  /><label class="errorMsg"><?php echo form_error('address'); ?></label></p>
	<p><label>Profession</label>
		<select name="profession">
			<?php foreach($skill_info as $info):?>
			<option value="<?php echo $info->skill_id;?>" selected="selected"><?php echo $info->skill ?></option>
			<?php endforeach;?>
			<?php foreach($skills as $in):?>
			<option value="<?php echo $in->skill_id;?>" ><?php echo $in->skill ?></option>
			<?php endforeach;?>
		</select><label class="errorMsg"><?php echo form_error('profession'); ?></label></p>
	<p><label>Phone Number</label><input type='text' name='phone'  value="<?php echo $rec->phone; ?>"  /><label class="errorMsg"><?php echo form_error('phone'); ?></label></p>
	<p><label>Email Address </label><input type='text' name='email' value="<?php echo $rec->email; ?>"  /><label class="errorMsg"><?php echo form_error('email'); ?></label></p>
	<p><label>Password </label><input type='password' name='pword' 	readonly="readonly" value="<?php echo $rec->password; ?>"  /><label class="errorMsg"><?php echo form_error('pword'); ?></label><a href="#">Change Password</a></p>
	<p><input class="hr_submitBtn" type="submit" value="Save"><a href="<?php echo base_url(); ?>a/profile/view_profile/<?php echo $rec->account_id; ?>">Cancel</a></p>
	<?php endforeach; ?>
	</form>
</div>