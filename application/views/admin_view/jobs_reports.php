<div class="HR_contentcontainer">
<div class="HR_sidebarwrapper">
<div class="hr_admin_header_div">
		<?php if(isset($currUser['hr_personnel_name'])): ?>
		 <div class="HR_admincontainer"><a href=""><?php echo $currUser['hr_personnel_name'];  ?></a><p>+</p></div>
		 <div class="HR_signoutdropdown"><a href='<?php echo base_url(); ?>administrator/login'>Sign Out</a></div>
	<?php endif; ?>
</div>
<p id="HR_backbutton"><a href="<?php echo base_url(); ?>administrator/dashboard/reports">Back</a></p>
</div>
<div id="HR_fillupcontent">
<div class="HR_contentwrapper">
<div class="hr_jobs_report">
	<?php echo "<table border='1'>"; ?>
	<?php echo "<tr><th>Job Title</th><th>Posted By</th><th>Posted Date</th><th>Number of People</th></tr>"; ?>
	<?php $rowAlternate = 0; ?>
	
	<?php foreach($records as $rec):?>
	
	<?php if (($rowAlternate %2) == 0): ?>
        <?php echo "<tr class='even'><td class='hoverTD'>";   ?>
		<?php echo "$rec->job_title"; ?>        		
        <?php echo "</td><td class='hoverTD'>";   ?>  
		<?php echo $rec->fname . " " . $rec->lname; ?>       		
        <?php echo "</td><td class='hoverTD'>";   ?>
		<?php echo formattedDate($rec->posted_date); ?>      		
		<?php echo "</td><td class='hoverTD'>" ?>
		<?php echo $rec->number_of_employee?>
        <?php echo "</td></tr>";  ?>
        <?php else: ?>
        <?php echo "<tr class='odd'><td class='hoverTD'>";   ?>
		<?php echo "$rec->job_title"; ?>        		
        <?php echo "</td><td class='hoverTD'>";   ?>  
		<?php echo $rec->fname . " " . $rec->lname; ?>       		
        <?php echo "</td><td class='hoverTD'>";   ?>
		<?php echo formattedDate($rec->posted_date); ?>      		
		<?php echo "</td><td class='hoverTD'>" ?>
		<?php echo $rec->number_of_employee?>
        <?php echo "</td></tr>";  ?>
        
        <?php endif; ?>
        <?php $rowAlternate++; ?>
		
	<?php endforeach;?>
	</table>
</div>
</div>
</div>
</div>