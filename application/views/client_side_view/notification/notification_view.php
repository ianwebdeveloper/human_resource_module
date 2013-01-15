<div class="hr_contentpaperlogged">
<div class="hr_content_div">
<p class="HR_message_header">Message Center</p>
<div class="hr_notification_div">
	<?php foreach($records as $rec):?>
	<?php echo "<table border='1'>"; ?>
	<?php $rowAlternate = 0; ?>
	<?php if (($rowAlternate %2) == 0): ?>
        <?php echo "<tr class='even'><td class='hoverTD'>";   ?>
        <?php echo "<a href='" . base_url() .  "a/profile/delete/". $rec->account_id . "/". $rec->notification_id . "'>X</a>"?>
        <?php echo "</td><td class='hoverTD'>";   ?> 
		<?php echo "$rec->message"; ?>        		
        <?php echo "</td><td class='hoverTD'>";   ?>  
		<?php echo formattedDate($rec->date); ?>      		
        <?php echo "</td></tr>";  ?>
        <?php else: ?>
        <?php echo "<tr class='odd'><td class='hoverTD'>";   ?>
        <?php echo "<a href='" . base_url() .  "a/profile/delete/". $rec->account_id . "/". $rec->notification_id . "'>X</a>"?>
        <?php echo "</td><td class='hoverTD'>";   ?> 
		<?php echo "$rec->message"; ?>        		
        <?php echo "</td><td class='hoverTD'>";   ?>  
		<?php echo formattedDate($rec->date); ?>   
        <?php echo "</td></tr>";  ?>
        
        <?php endif; ?>
        <?php $rowAlternate++; ?>
		
	<?php endforeach;?>
	</table>
</div>
</div>
</div>