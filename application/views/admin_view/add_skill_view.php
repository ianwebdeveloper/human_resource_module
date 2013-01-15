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
<p class="hr_added_skill_confirmation">You successfully added Skill</p>

<p id="HR_titledesign">Add Skill</p>
<form class="hr_add_skill_form" method="POST" action="#">

	<p><label>Skill Name</label><input type="text" class="hr_skill_name" name="skill_name" /></p>
	<p><label>Skill Category</label>
	
	<select class="skill_category" name="skill_category">
		<?php foreach($categories as $cat):?>
		<option value="<?php echo $cat->cat_id; ?>"><?php echo $cat->cat_name; ?></option>
		<?php endforeach;?>
	</select>
	
	</p>
	<p><input id="submitpost" type="submit" value="Add" ></p>
</form>
<hr>
<div class="hr_all_skill">
	<?php echo "<table border='1'>"; ?>
	<?php echo "<tr><th>Skill Name</th><th>Job Category</th><th>Action</th></tr>"; ?>
	<?php $rowAlternate = 0; ?>
	
	<?php foreach($skills as $skill):?>
	
	<?php if (($rowAlternate %2) == 0): ?>
        <?php echo "<tr class='even'><td class='hoverTD'>";   ?>
		    		<?php echo $skill->skill; ?>      		
        <?php echo "</td><td class='hoverTD'>";   ?>  
		<?php echo $skill->cat_name; ?>       		    		
		<?php echo "</td><td class='hoverTD'>" ?>
		<?php echo "<a href='". base_url() . "administrator/dashboard/edit_skill/" . $skill->skill_id . "'>Edit</a> | <a href='". base_url() . "administrator/dashboard/delete_skill/" . $skill->skill_id . "'>Delete</a>"; ?>        		
        <?php echo "</td></tr>";  ?>
        <?php else: ?>
        <?php echo "<tr class='odd'><td class='hoverTD'>";   ?>
		    		<?php echo $skill->skill; ?>      		
        <?php echo "</td><td class='hoverTD'>";   ?>  
		<?php echo $skill->cat_name; ?>       		    		
		<?php echo "</td><td class='hoverTD'>" ?>
		<?php echo "<a href='". base_url() . "administrator/dashboard/edit_skill/" . $skill->skill_id . "'>Edit</a> | <a href='". base_url() . "administrator/dashboard/delete_skill/" . $skill->skill_id . "'>Delete</a>"; ?>        		
        <?php echo "</td></tr>";  ?>
        
        <?php endif; ?>
        <?php $rowAlternate++; ?>
		
	<?php endforeach;?>
	</table>
</div>
<p><?php echo $pagination_links; ?></p>
</div>
</div>
</div>