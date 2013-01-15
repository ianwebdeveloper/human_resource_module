<div class="hr_contentpaperlogged">
<div class="hr_content_div">
<div class="hr_list_all_jobs">
	<?php foreach($records as $job):?>
		<p><a href="<?php echo base_url();?>a/search_jobs/jobs/<?php echo $job->job_id; ?>"><?php echo $job->job_title; ?></a></p>
		<p><label>Posted </label><?php echo formattedDate($job->posted_date); ?></p>
		<p><?php echo $job->job_description; ?></p>
		<p><label>Number of Person needed: </label><?php echo $job->number_of_employee; ?></p>
		<p><label>Status: </label><?php if($job->status == 1 ) {
			echo "Open";
		} else {
			echo "Closed";
		}?>
	<?php endforeach;?>
</div>
</div>
</div>