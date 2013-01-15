<div class="hr_contentpaperlogged">
<p id="HR_backbutton"><a href="<?php echo base_url(); ?>administrator/dashboard/view_job/<?php echo $job_id  ?>" >Back</a></p>
<div class="hr_content_div">
<?php foreach($records as $rec):?>
	<p class="hr_resume_fullname"><h3><?php echo $rec->fname . " " . $rec->mname . " " . $rec->lname; ?></h3></p>
	<p class="hr_resume_addr"><?php echo $rec->address; ?></p>
	<p class="hr_resume_email"><?php echo $rec->email; ?></p>
	<p class="hr_resume_phone"><?php echo $rec->phone; ?></p>

	<p class="hr_objective_header"><h3>Career Objective</h3></p>
	<p class="hr_resume_objective">
		<?php if(isset($resume)):?>
			<?php foreach($resume as $obj): ?>
				<?php echo $obj->objective; ?>
			<?php endforeach;?>
		<?php endif; ?>
	</p>

<p class="hr_resume_education_header"><h3>Education</h3></p>
	<p class="hr_resume_education">
		<?php if(isset($education)):?>
			<div class="allJobs">
			<?php echo "<table border='1'>"; ?>
			
				<?php echo "<tr><th>Year</th><th>Degree</th><th>Area of Study</th><th>School Name</th><th>Location</th><th>Action</th></tr>"; ?>
				<?php $rowAlternate = 0; ?>
				
				<?php foreach($education as $educ):?>
				
				<?php if (($rowAlternate %2) == 0): ?>
			        <?php echo "<tr class='even'><td class='hoverTD'>";   ?>
						<?php echo $educ->year_started . " - " . $educ->year_ended ?>
					<?php echo "</td><td class='hoverTD'>";   ?>
						<?php echo $educ->degree ?>
					<?php echo "</td><td class='hoverTD'>";   ?>
						<?php echo $educ->area_of_study ?>
					<?php echo "</td><td class='hoverTD'>";   ?>
						<?php echo $educ->school_name ?>
					<?php echo "</td><td class='hoverTD'>";   ?>
						<?php echo $educ->location ?>
					<?php echo "</td><td class='hoverTD'>";   ?>
						<?php echo "<a href='" . base_url() . "a/profile/delete_education/" . $rec->account_id ."/" . $rec->resume_id . "'>Delete</a>" ?>						
					<?php echo "</td></tr>";  ?>
			        <?php else: ?>
			        <?php echo "<tr class='odd'><td class='hoverTD'>";   ?>
			        <?php echo $educ->year_started . " - " . $educ->year_ended ?>
					<?php echo "</td><td class='hoverTD'>";   ?>
						<?php echo $educ->degree ?>
					<?php echo "</td><td class='hoverTD'>";   ?>
						<?php echo $educ->area_of_study ?>
					<?php echo "</td><td class='hoverTD'>";   ?>
						<?php echo $educ->school_name ?>
					<?php echo "</td><td class='hoverTD'>";   ?>
						<?php echo $educ->location ?>
					<?php echo "</td><td class='hoverTD'>";   ?>
						<?php echo "<a href='" . base_url() . "a/profile/delete_education/" . $rec->account_id ."/". $rec->resume_id . "'>Delete</a>" ?> 		
			        <?php echo "</td></tr>";  ?>
			        
			        <?php endif; ?>
			        <?php $rowAlternate++; ?>
					
				<?php endforeach;?>
				
			</table>
			</div>
		<?php endif; ?>

<?php endforeach; ?>
</div>
</div>