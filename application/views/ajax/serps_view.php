<div class="all_applicants">
	<?php echo "<table class='hr_serps_applicants_table' border='1'>"; ?>
	<?php echo "<tr><th>Applicant Name</th><th> Skill</th><th>Preferred Job</th><th>Status</th><th>Action</th></tr>"; ?>
	<?php $rowAlternate = 0; ?>
	
	<?php foreach($all_applicant as $rec):?>
	
	<?php if (($rowAlternate %2) == 0): ?>
        <?php echo "<tr class='even'><td class='hoverTD'>";   ?>
        
			<?php echo $rec->fname . " " . $rec->lname; ?>  
		<?php echo "</td><td class='hoverTD'>";   ?>       		
		     <?php echo $rec->skill; ?> 
		<?php echo "</td><td class='hoverTD'>";   ?>       		
		     <?php echo $rec->cat_name; ?>   
		<?php echo "</td><td class='hoverTD'>" ?>
		<?php if($rec->hired == 1) {
					echo "Hired";
				} elseif($rec->reject == 1) {
					echo "Rejected";
				} else if($rec->fired == 1)  {
					echo "Fired";
				} else {
					echo "Pending";
				}?>
				<?php echo "</td><td class='hoverTD'>" ?>
<?php echo "<a href='". base_url() . "administrator/dashboard/send_invitation/" . $rec->account_id . "/". $rec->job_id . "'>Send Invitation</a>"; ?>  	  		
        <?php echo "</td></tr>";  ?>
       
        <?php else: ?>
        <?php echo "<tr class='odd'><td class='hoverTD'>";   ?>
        
			<?php echo $rec->fname . " " . $rec->lname; ?>       		
		<?php echo "</td><td class='hoverTD'>";   ?>       		
		     <?php echo $rec->skill; ?> 
		<?php echo "</td><td class='hoverTD'>";   ?>       		
		     <?php echo $rec->cat_name; ?>  
		<?php echo "</td><td class='hoverTD'>" ?>
		<?php if($rec->hired == 1) {
					echo "Hired";
				} elseif($rec->reject == 1) {
					echo "Rejected";
				} else if($rec->fired == 1)  {
					echo "Fired";
				} else {
					echo "Pending";
				}?>	
				<?php echo "</td><td class='hoverTD'>" ?>
		<?php echo "<a href='". base_url() . "administrator/dashboard/send_invitation/" . $rec->account_id . "/". $rec->job_id ."'>Send Invitation</a> "; ?>    	       		
        <?php echo "</td></tr>";  ?>
        
        <?php endif; ?>
        <?php $rowAlternate++; ?>
		
	<?php endforeach;?>
	</table>

</div>