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
<p id="HR_titledesign">Manage Jobs</p>
<div class="allJobs">
	<form id="hr_search_job_form" method="POST" method="#">
	<p><label>Search Jobs</label><input type="text" id="hr_search_job_box" name="search_job"/><input id="submitpost" type="submit" value="Search" /></p>
	</form>
</div>
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
		<?php echo "<a href='". base_url() . "administrator/dashboard/view_job/" . $rec->job_id . "'>View</a> | <a href='". base_url() . "administrator/dashboard/edit_job/" . $rec->job_id . "'>Edit</a> | <a href='". base_url() . "administrator/dashboard/close_job/" . $rec->job_id . "'>Close</a>"; ?>        		
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
		<?php echo "<a href='". base_url() . "administrator/dashboard/view_job/" . $rec->job_id . "'>View</a> | <a href='". base_url() . "administrator/dashboard/edit_job/" . $rec->job_id . "'>Edit</a> | <a href='". base_url() . "administrator/dashboard/close_job/" . $rec->job_id . "'>Close</a>"; ?>           		
        <?php echo "</td></tr>";  ?>
        
        <?php endif; ?>
        <?php $rowAlternate++; ?>
		
	<?php endforeach;?>
	</table>
</div>
</div>
</div>
</div>