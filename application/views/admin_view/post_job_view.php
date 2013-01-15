<div class="HR_contentcontainer">
<div class="HR_sidebarwrapper">
<div class="hr_admin_header_div">
		<?php if(isset($currUser['hr_personnel_name'])): ?>
		 <div class="HR_admincontainer"><a href=""><?php echo $currUser['hr_personnel_name'];  ?></a><p>+</p></div>
		 <div class="HR_signoutdropdown"><a href='<?php echo base_url(); ?>administrator/login'>Sign Out</a></div>
	<?php endif; ?>

</div>
<p id="HR_backbutton"><a href="<?php echo base_url(); ?>administrator/dashboard">Back</a></p>
</div>
<div id="HR_fillupcontent">
<div class="HR_contentwrap">
<form method="POST" action="<?php echo base_url(); ?>administrator/dashboard/validatePostedJob">

	<p><label id="jobtitle">Job Title: </label><input name="job_title" type="text" value="<?php echo set_value('job_title'); ?>" size="40"/><label class="errorMsg"><?php echo form_error('job_title'); ?></label></p>
	<p><label id="posteddate">Posted Date: </label>
	<span class='currDate'> 				
		<?php 	$datestring = "Y-m-d";
 				$time = time();
 				$currentDate = mdate($datestring, $time);
 
 				echo formattedDate($currentDate);
 		?>
 	</span></label></p>
 	<p><label>Job Category</label><select name="job_category">
 	<?php foreach($categories as $cat):?>
 		<option value="<?php echo $cat->cat_id?>"><?php echo $cat->cat_name; ?></option>
 	<?php endforeach;?>
 	
 	</select></p>
<!--  	<p><label id="plannned_start">Planned Start: </label><input class="plannned_start" type="text" name="plannned_start" /></p> -->
	<p><label>Job Description:</label><br>
		<textarea name="job_desc" rows="9" cols="88"><?php echo set_value('job_desc') ?></textarea>
		<label class="errorMsg"><?php echo form_error('job_desc'); ?></label>
	</p>
	<p><label id="numemp">Number of Employee:</label> <input name="no_of_emp" type="text" value="<?php echo set_value('no_of_emp'); ?>" size="4"/><label class="errorMsg"><?php echo form_error('no_of_emp'); ?></label></p>
	<p><label id="location">Location: </label><input name="location" type="text" value="<?php echo set_value('location'); ?>" size="67"/><label class="errorMsg"><?php echo form_error('location'); ?></label></p>
<!--  	<p><label id="contractstart">Contract Start Date:</label> <input name="contract_sDate" type="text" value="<?php echo set_value('contract_sDate'); ?>" size="10"/><label class="errorMsg"><?php echo form_error('contract_sDate'); ?></label></p>-->
<!-- 	<p><label id="contractend">Contract End Date:</label><input name="contract_eDate" type="text" value="<?php echo set_value('contract_eDate'); ?>" size="10"/><label class="errorMsg"><?php echo form_error('contract_eDate'); ?></label></p>-->
	<p><input id="submitpost" type="submit" value="Post Job"></p>
	
</form>

</div>
</div>
</div>