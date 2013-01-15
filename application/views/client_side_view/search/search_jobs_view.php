<div id="HR_whitespace"></div>
<div class="HRFindJobContainer">
<div class="hr_search_jobs_div">
<form id="HRSearchkeyword" action="#" method="POST">
	<p id="HRSKey">Search Keyword:<input type="text" id="HRsearchinput" name="search_job" /><input id="HRsearchbutton" type="submit" value="Search"></p>
</form>
</div>
<div class="hr_list_all_jobs">
	<?php foreach($records as $job):?>
	<div class="hr_hover_job_div">
		<p id="HRjobtitle"><a href="<?php echo base_url();?>a/search_jobs/jobs/<?php echo $job->job_id; ?>"><?php echo $job->job_title; ?></a></p>
		<p id="HRpostage"><label>Posted </label><?php echo formattedDate($job->posted_date); ?></p>
		<p id="HRjobdefinition"><?php echo $job->job_description; ?></p>
		<p id="HRNum_Applicants"><label>Number of Person needed: </label><?php echo $job->number_of_employee; ?></p>
		<p id="HR_lastofpost"><label>Status: </label><?php if($job->status == 1 ) {
			echo "Open";
		} else {
			echo "Closed";
		}?>
	</div>
	<?php endforeach;?>
</div>	
<p><?php echo $pagination_links; ?></p>
</div>
<div class="hr_footboard">
<p id="HR_frontfooter">Human Resource Module<br><span>All Rights Reserved.</span></p>
</div>

