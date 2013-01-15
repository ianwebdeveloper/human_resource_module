<div class="hr_contentpaperlogged">
<div class="hr_content_div">
<div class="hr_myjob_list">
	<?php echo "<table border='1'>"; ?>
	<?php echo "<tr><th>Job Title</th><th>Date Hired</th></tr>"; ?>
	<?php $rowAlternate = 0; ?>
	
	<?php foreach($my_jobs as $rec):?>
	
	<?php if (($rowAlternate %2) == 0): ?>
        <?php echo "<tr class='even'><td class='hoverTD'>";   ?>
		<?php echo "$rec->job_title"; ?>        		    		
        <?php echo "</td><td class='hoverTD'>";   ?>
		<?php echo formattedDate($rec->hired_date); ?>      		
        <?php echo "</td></tr>";  ?>
        <?php else: ?>
        <?php echo "<tr class='odd'><td class='hoverTD'>";   ?>
		<?php echo "$rec->job_title"; ?>        		    		
        <?php echo "</td><td class='hoverTD'>";   ?>
		<?php echo formattedDate($rec->hired_date); ?>      		
        <?php echo "</td></tr>";  ?>
        <?php echo "</td></tr>";  ?>
        
        <?php endif; ?>
        <?php $rowAlternate++; ?>
		
	<?php endforeach;?>
	</table>
</div>
</div>
</div>