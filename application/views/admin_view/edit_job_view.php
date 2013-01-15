<div class="HR_contentcontainer">
<div class="HR_sidebarwrapper">
<div class="hr_admin_header_div">
		<?php if(isset($currUser['hr_personnel_name'])): ?>
		 <div class="HR_admincontainer"><a href=""><?php echo $currUser['hr_personnel_name'];  ?></a><p>+</p></div>
		 <div class="HR_signoutdropdown"><a href='<?php echo base_url(); ?>administrator/login'>Sign Out</a></div>
	<?php endif; ?>
</div>
<p id="HR_backbutton"><a href="<?php echo base_url(); ?>administrator/dashboard/manage_jobs">Back</a></p>
</div>
<div id="HR_fillupcontent">
<div class="HR_contentwrapper">
<form method="POST" action="<?php echo base_url(); ?>administrator/dashboard/validate_edited_job">
	<?php foreach($job as $rec):?>
	<p><input type="hidden" name="job_id" value="<?php echo $rec->job_id; ?>" /></p>
	<p><input type="hidden" name="account_id" value="<?php echo $rec->account_id; ?>" /></p>
	<p><label id="jobtitle">Job Title: </label><input name="job_title" type="text" value="<?php echo $rec->job_title; ?>" size="40"/><label class="errorMsg"><?php echo form_error('job_title'); ?></label></p>
	<p><label id="posteddate">Posted Date: </label><input name="posted_date" type="text" value="<?php echo $rec->posted_date; ?>" size="10"/><label class="errorMsg"><?php echo form_error('posted_date'); ?></label></p>
	 <p><label>Job Category</label><select name="job_category">
 	<option value="<?php echo $rec->cat_id?>"><?php echo $rec->cat_name; ?></option>
 	<?php foreach($categories as $cat):?>
 		<option value="<?php echo $cat->cat_id?>"><?php echo $cat->cat_name; ?></option>
 	<?php endforeach;?>
 	
 	</select></p>
	<p><label>Job Description:</label><br>
		<textarea name="job_desc" rows="9" cols="88"><?php echo $rec->job_description; ?></textarea>
		<label class="errorMsg"><?php echo form_error('job_desc'); ?></label>
	</p>
	<p><label id="numemp">Number of Employee:</label> <input name="no_of_emp" type="text" value="<?php echo $rec->number_of_employee; ?>" size="4"/><label class="errorMsg"><?php echo form_error('no_of_emp'); ?></label></p>
	<p><label id="location">Location: </label><input name="location" type="text" value="<?php echo $rec->location; ?>" size="67"/><label class="errorMsg"><?php echo form_error('location'); ?></label></p>
	<p><input id="submitpost" type="submit" value="Update Job"></p>
	<?php endforeach;?>
</form>
</div>
</div>
</div>
