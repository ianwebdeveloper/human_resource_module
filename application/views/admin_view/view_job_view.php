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
<fieldset class="hr_view_job_box">
<?php foreach($record as $rec):?>
<p class="hr_view_job_title"  ><?php echo $rec->job_title; ?></p>
<p><?php echo $rec->job_description; ?></p>
<div class="hr_job_details">
<p><?php echo "Location : <i class='italize_text'>" .$rec->location; ?></i></p>
<p><label>Number of People needed:</label><i class='italize_text'>	<?php if(isset($hired)) {
		echo $hired;
	}	else {
		echo "0";
	}?>/<?php echo $rec->number_of_employee; ?></i></p>
<p><?php echo " Posted Date : <i class='italize_text'>". $rec->posted_date;?></i></p>
<p><?php echo " Planned Start : <i class='italize_text'>". $rec->plannned_start; ?></i></p>
<?php if($rec->status == 1 ) {
			echo "<p>Status :<i class='italize_text'> Open</i></p>";
		} else {
			echo "<p> Status :  <i class='italize_text'>Closed</i></p>";
		}?>

</div>
</fieldset>
<p class="hr_view_applicant_header">Applicants</p>
<div class="job_applicants">
	<?php echo "<table border='1'>"; ?>
	<?php echo "<tr><th>Name</th><th>Applied Date</th><th>Status</th><th>Action</th></tr>"; ?>
	<?php $rowAlternate = 0; ?>
	
	<?php foreach($applicants as $app):?>
	<?php if (($rowAlternate %2) == 0): ?>
	<?php echo "<tr class='even'><td class='hoverTD'>";   ?>
	<?php echo "<a href='". base_url() . "administrator/dashboard/resume/" . $app->account_id . "/" .$rec->job_id ."' /> " . $app->fname . "" . $app->lname . "</a>"; ?> 
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php echo formattedDate($app->applied_date); ?>
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php if($app->hired == 1 && $app->fired == 0) {
				echo "Hired";
			} elseif($app->hired == 0 && $app->fired == 0 && $app->reject == 0 ) {
				echo "Pending";
			} elseif ($app->fired == 1 && $app->hired == 0 && $app->reject == 0) {
				echo "Fired";
			} elseif ($app->reject == 1 && $app->fired == 1 && $app->hired == 0) {
				echo "Rejected";
			} else {
				echo "Pending";
			
			}
	?>
	<?php echo "</td><td class='hoverTD'>" ?>
	
	<?php if($app->fired == 0 && $app->hired == 0) :?>
		<?php echo "<a href='" . base_url() . "administrator/dashboard/hired/". $rec->job_id . "/". $app->account_id . "'/>Hire</a> | <a href='" . base_url() . "administrator/dashboard/reject/". $rec->job_id . "/" . $app->account_id . "'>Reject</a>"; ?>
	<?php elseif ($app->fired == 0 && $app->hired == 1):?>
		<?php echo "<a href='" . base_url() . "administrator/dashboard/hired/". $rec->job_id . "/". $app->account_id . "'/>Hire</a> | <a href='" . base_url() . "administrator/dashboard/fired/". $rec->job_id . "/" . $app->account_id . "'>Fire</a>"; ?>
	<?php else: ?>
		<?php echo "<a href='" . base_url() . "administrator/dashboard/hired/". $rec->job_id . "/". $app->account_id . "'/>Hire</a> | <a href='" . base_url() . "administrator/dashboard/reject/". $rec->job_id . "/" . $app->account_id . "'>Reject</a>"; ?>
	<?php endif;?>
	
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
			}
	?>
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php if($app->fired == 0 && $app->hired == 0) :?>
		<?php echo "<a href='" . base_url() . "administrator/dashboard/hired/". $rec->job_id . "/". $app->account_id . "'/>Hire</a> | <a href='" . base_url() . "administrator/dashboard/reject/". $rec->job_id . "/" . $app->account_id . "'>Reject</a>"; ?>
	<?php elseif ($app->fired == 0 && $app->hired == 1):?>
		<?php echo "<a href='" . base_url() . "administrator/dashboard/hired/". $rec->job_id . "/". $app->account_id . "'/>Hire</a> | <a href='" . base_url() . "administrator/dashboard/fired/". $rec->job_id . "/" . $app->account_id . "'>Fire</a>"; ?>
	<?php else: ?>
		<?php echo "<a href='" . base_url() . "administrator/dashboard/hired/". $rec->job_id . "/". $app->account_id . "'/>Hire</a> | <a href='" . base_url() . "administrator/dashboard/reject/". $rec->job_id . "/" . $app->account_id . "'>Reject</a>"; ?>
	<?php endif;?>
	<?php echo "</td></tr>"?>
	<?php endif; ?>
    <?php $rowAlternate++; ?>
	<?php endforeach; ?>
<?php endforeach;?>
	</table>
</div>
</div>
</div>
</div>