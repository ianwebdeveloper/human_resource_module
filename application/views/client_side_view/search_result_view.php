<div class="HR_contentcontainer">
<div class="HR_managejob_container">
<p><a href="<?php echo base_url(); ?>administrator/dashboard/manage_jobs">Back to Find Jobs</a></p>
<p id="managejobs">Manage Jobs</p>
<div class="hr_search_job_div">
	<form id="hr_search_job_form" method="POST" method="#">
	<p><label>Search</label><input id="hr_search_job_box" type="text" name="search_job"/><input id="hr_search_job_btn" type="submit" value="Search" /></p>
	</form>
</div>
<div class="hr_serps_search"></div>
<div class="allJobs">
	<?php echo "<table border='1'>"; ?>
	<?php echo "<tr><th>Job Title</th><th>Posted By</th><th>Posted Date</th><th>Status</th><th>Action</th></tr>"; ?>
	<?php $rowAlternate = 0; ?>
	
	<?php foreach($records as $rec):?>
	
	<?php if (($rowAlternate %2) == 0): ?>
        <?php echo "<tr class='even'><td class='hoverTD'>";   ?>
		<?php echo "<a href='". base_url() . "administrator/dashboard/view_job/" . $rec->job_id . "' /> " . $rec->job_title . "</a>"; ?>        		
        <?php echo "</td><td class='hoverTD'>";   ?>  
		<?php echo $rec->fname . " " . $rec->lname; ?>       		
        <?php echo "</td><td class='hoverTD'>";   ?>
		<?php echo formattedDate($rec->posted_date); ?>      		
		<?php echo "</td><td class='hoverTD'>" ?>
		<?php if($rec->status == 1) {
					echo "Open";
				} else {
					echo "Closed";
				} ?>
		<?php echo "</td><td class='hoverTD'>" ?>
		<?php echo "<a href='". base_url() . "administrator/dashboard/view_job/" . $rec->job_id . "'>View</a> | <a href='". base_url() . "administrator/dashboard/edit_job/" . $rec->job_id . "'>Edit</a> | <a href='". base_url() . "administrator/dashboard/delete_job/" . $rec->job_id . "'>Delete</a>"; ?>        		
        <?php echo "</td></tr>";  ?>
        <?php else: ?>
        <?php echo "<tr class='odd'><td class='hoverTD'>";   ?>
		<?php echo "<a href='". base_url() . "administrator/dashboard/view_job/" . $rec->job_id . "' /> " . $rec->job_title . "</a>"; ?>        		
        <?php echo "</td><td class='hoverTD'>";   ?>  
		<?php echo $rec->fname . " " . $rec->lname; ?>       		
        <?php echo "</td><td class='hoverTD'>";   ?>
		<?php echo formattedDate($rec->posted_date); ?>     		
		<?php echo "</td><td class='hoverTD'>" ?>
		<?php if($rec->status == 1) {
					echo "Open";
				} else {
					echo "Closed";
				} ?>
        <?php echo "</td><td class='hoverTD'>";   ?>
		<?php echo "<a href='". base_url() . "administrator/dashboard/view_job/" . $rec->job_id . "'>View</a> | <a href='". base_url() . "administrator/dashboard/edit_job/" . $rec->job_id . "'>Edit</a> | <a href='". base_url() . "administrator/dashboard/delete_job/" . $rec->job_id . "'>Delete</a>"; ?>           		
        <?php echo "</td></tr>";  ?>
        
        <?php endif; ?>
        <?php $rowAlternate++; ?>
		
	<?php endforeach;?>
	</table>
</div>
</div>
</div>