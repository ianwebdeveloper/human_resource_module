<div class="HR_contentcontainer">
<div class="HR_applicant_container">
<div class="HR_sidebarwrapper">
<div class="hr_admin_header_div">
		<?php if(isset($currUser['hr_personnel_name'])): ?>
		 <div class="HR_admincontainer"><a href=""><?php echo $currUser['hr_personnel_name'];  ?></a><p>+</p></div>
		 <div class="HR_signoutdropdown"><a href='<?php echo base_url(); ?>administrator/login'>Sign Out</a></div>
	<?php endif; ?>
</div>
<p id="HR_backbutton"><a href="<?php echo base_url(); ?>administrator/dashboard">Back</a></p>
</div>
<p id="listapplicants">List of Applicants</p>

<div class="applicants">
	<?php echo "<table border='1'>"; ?>
	<?php echo "<tr><th>Name</th><th>Applied Date</th><th>Status</th><th>Action</th></tr>"; ?>
	<?php $rowAlternate = 0; ?>
	
	<?php foreach($applicants as $app):?>
	<?php if (($rowAlternate %2) == 0): ?>
	<?php echo "<tr class='even'><td class='hoverTD'>";   ?>
	<?php echo "<a href='". base_url() . "administrator/dashboard/view_job/" . $app->account_id . "' /> " . $app->fname . "" . $app->lname . "</a>"; ?> 
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php echo formattedDate($app->applied_date); ?>
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php if($app->hired == 1) {
				echo "Hired";
			} else {
				echo "Pending";
			} ?>
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php echo "<a href='" . base_url() . "administrator/dashboard/hired/". $app->job_id . "/". $app->account_id . "'/>Hired</a> | <a href='" . base_url() . "administrator/dashboard/reject/". $app->job_id . "/" . $app->account_id . "'>Reject</a>"; ?>
	<?php echo "</td></tr>"; ?>
	<?php else: ?>
	<?php echo "<tr class='odd'><td class='hoverTD'>";   ?>
	<?php echo "<a href='". base_url() . "administrator/dashboard/view_job/" . $app->account_id . "' /> " . $app->fname . "" . $app->lname . "</a>"; ?>
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php echo formattedDate($app->applied_date); ?>
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php if($app->hired == 1) {
				echo "Hired";
			} else {
				echo "Pending";
			} ?>
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php echo "<a href='" . base_url() . "administrator/dashboard/hired/". $app->job_id . "/". $app->account_id . "'/>Hired</a> | <a href='" . base_url() . "administrator/dashboard/reject/". $app->job_id . "/" . $app->account_id . "'>Reject</a>"; ?>
	<?php echo "</td></tr>"?>
	<?php endif; ?>
    <?php $rowAlternate++; ?>
	<?php endforeach; ?>
	
	</table>
</div>
</div>
</div>