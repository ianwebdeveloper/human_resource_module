<div class="hr_contentpaperlogged">
<div class="hr_content_div">

<p><a href="<?php echo base_url(); ?>a/search_jobs"><< Back</a></p>
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

<?php if($rec->status == 1 ) {
			echo "<p>Status :<i class='italize_text'> Open</i></p>";
		} else {
			echo "<p> Status :  <i class='italize_text'>Closed</i></p>";
		}?>
<?php endforeach;?>
</div>
</fieldset>
<p>Applicants</p>
<div class="hr_front_job_applicants">
	<?php echo "<table border='1'>"; ?>
	<?php echo "<tr><th>Name</th><th>Applied Date</th><th>Status</th></tr>"; ?>
	<?php $rowAlternate = 0; ?>
	
	<?php foreach($applicants as $app):?>
	<?php if (($rowAlternate %2) == 0): ?>
	<?php echo "<tr class='even'><td class='hoverTD'>";   ?>
	<?php echo "<a href='' /> " . $app->fname . "" . $app->lname . "</a>"; ?> 
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php echo formattedDate($app->applied_date); ?>
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php if($app->hired == 1) {
				echo "Hired";
			} else {
				echo "Pending";
			}
	?>
	<?php echo "</td></tr>"; ?>
	<?php else: ?>
	<?php echo "<tr class='odd'><td class='hoverTD'>";   ?>
	<?php echo "<a href='' /> " . $app->fname . "" . $app->lname . "</a>"; ?>
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php echo formattedDate($app->applied_date); ?>
	<?php echo "</td><td class='hoverTD'>" ?>
	<?php if($app->hired == 1) {
				echo "Hired";
			} else {
				echo "Pending";
			}
	?>
	<?php echo "</td></tr>"?>
	<?php endif; ?>
    <?php $rowAlternate++; ?>
	<?php endforeach; ?>
	</table>
</div>
<div class=''>
	<?php if(!isset($applied)): ?>
		<?php foreach($record as $rec):?>
		<p><a href="<?php echo base_url(); ?>a/jobs/apply/<?php echo $rec->job_id; ?>">Apply to this Job</a></p>
		<?php endforeach; ?>
	<?php endif;?>
</div>
</div>

</div>