<div class="hr_headboard"></div>
<div class="hr_contentpaper">
<div class="HR_contentwrap">
<div class="hr_registration_box">
<form action="<?php echo base_url(); ?>home/register_validate/" method="POST">
	<p id="HR_titledesign">Registration</p>
	<p><label>First Name</label><input type='text' name='fname' value="<?php echo set_value('fname'); ?>" /><label class="errorMsg"><?php echo form_error('fname'); ?></label></p>
	<p><label>Middle Name</label><input type='text' name='mname' value="<?php echo set_value('mname'); ?>"  /><label class="errorMsg"><?php echo form_error('mname'); ?></label></p>
	<p><label>Last Name</label><input type='text' name='lname' value="<?php echo set_value('lname'); ?>"  /><label class="errorMsg"><?php echo form_error('lname'); ?></label></p>
	<p><label>Date of Birth</label>
		<select class="hr_year" name="year">
		
			<option value="-1">Year:</option>
			<?php $upper = 2030; $lower = 1930;  ?>
			<?php for($i = $upper; $i >= $lower; $i--): ?>
			<option value="<?php echo $i;?>" ><?php echo $i; ?></option>
			<?php endfor; ?>
		
		</select>

		<select class="hr_day" name="day">
		
			<option value="-1">Day:</option>
			<?php $upper = 31; $lower = 1;  ?>
			<?php for($i = $upper; $i >= $lower; $i--): ?>
			<option value="<?php echo $i;?>" ><?php echo $i; ?></option>
			<?php endfor; ?>
		
		</select>
		<select class="hr_month" name="month">
			<option value="-1">Month:</option>
			<?php $upper = 12; $lower = 1;  ?>
			<?php for($i = $upper; $i >= $lower; $i--): ?>
			<option value="<?php echo $i;?>" ><?php echo $i; ?></option>
			<?php endfor; ?>
		</select>

	</p>
	<p><label>Age</label><span class="hr_age_span"></span></p>
	<p><input type="hidden" class="hr_age" name="age" /></p>
	<p><label>Gender</label><select name="gender"><option value="Male">Male</option><option value="Female">Female</option></select><label class="errorMsg"><?php echo form_error('gender'); ?></label></p>
	<p><label>Address</label><input type='text' name='address' value="<?php echo set_value('address'); ?>"  /><label class="errorMsg"><?php echo form_error('address'); ?></label></p>
	<p><label>Profession</label>
	<select name="profession">
		<?php foreach($job_categories as $cat):?>
			<?php echo "<option value=" . $cat->cat_name . ">" . $cat->cat_name . "</option>"?>
		<?php endforeach;?>
	</select>
	</p>
	<p><label>Phone Number</label><input type='text' name='phone'  value="<?php echo set_value('phone'); ?>"  /><label class="errorMsg"><?php echo form_error('phone'); ?></label></p>
	<p><label>Email Address </label><input type='text' name='email' value="<?php echo set_value('email'); ?>"  /><label class="errorMsg"><?php echo form_error('email'); ?></label></p>
	<p><label>Password </label><input type='password' name='pword' value="<?php echo set_value('pword'); ?>"  /><label class="errorMsg"><?php echo form_error('pword'); ?></label></p>
	<p><input class="hr_submitBtn" type="submit" value="Register"><a href="<?php echo base_url(); ?>home">Cancel</a></p>
</form>
</div>

</div>
</div>