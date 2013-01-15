<p><a href="<?php echo base_url(); ?>a/search_jobs"><< Back</a></p>
<div class="hr_list_all_jobs">
	<?php foreach($records as $job):?>
		<p id="HRjobtitle"><a href="<?php echo base_url();?>a/search_jobs/jobs/<?php echo $job->job_id; ?>"><?php echo $job->job_title; ?></a></p>
		<p id="HRpostage"><label>Posted </label><?php echo formattedDate($job->posted_date); ?></p>
		<p id="HRjobdefinition"><?php echo $job->job_description; ?></p>
		<p id="HRNum_Applicants"><label>Number of Person needed: </label><?php echo $job->number_of_employee; ?></p>
		<p id="HR_lastofpost"><label>Status: </label><?php if($job->status == 1 ) {
			echo "Open";
		} else {
			echo "Closed";
		}?>
	<?php endforeach;?>
</div>