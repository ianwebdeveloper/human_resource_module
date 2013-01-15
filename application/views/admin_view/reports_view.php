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
<div class="HR_contentwrapper">
<form class="hr_view_reportBtn" method="POST" action="<?php echo base_url(); ?>administrator/dashboard/reports_validate" >
	<p>
		<label>Report for</label>
			<select class="category" name="category">
				<option value ="hr_jobs">Jobs</option>
				<option value ="hr_job_applicant">Hired Persons</option>
			</select>
		<label>Select Month</label>
			<select class="month" name="month">
				<option value="-1">Month:</option>
					<?php $upper = 12; $lower = 1;  ?>
					<?php for($i = $upper; $i >= $lower; $i--): ?>
				<option value="<?php echo $i;?>" ><?php echo $i; ?></option>
					<?php endfor; ?>
		</select>
		<label>Select Year</label>
			<select class="year" name="year">
				<option value="-1">Year:</option>
					<?php $upper = 2030; $lower = 2011;  ?>
					<?php for($i = $upper; $i >= $lower; $i--): ?>
				<option value="<?php echo $i;?>" ><?php echo $i; ?></option>
					<?php endfor; ?>
		</select>
		<input type='submit' value="View" />
	</p>
</form>
</div>
</div>
</div>