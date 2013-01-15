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
<p class="hr_added_skill_confirmation">You successfully Update Skill</p>

<p id="HR_titledesign">Edit Skill</p>
<form class="hr_edit_skill_form" method="POST" action="#">
	<?php foreach($skill_info as $info):?>
	<input type="hidden"  class="hr_skill_id" name="skill_id" value="<?php echo $info->skill_id; ?>" />
	<p><label>Skill Name</label><input type="text" class="hr_skill_name" name="skill_name" value='<?php echo $info->skill; ?>' /></p>
	<p><label>Skill Category</label>
	
	<select class="skill_category" name="skill_category">
		<option value="<?php echo $info->cat_id; ?> selected="selected"><?php echo $info->cat_name; ?></option>
		<?php foreach($categories as $cat):?>
		<option value="<?php echo $cat->cat_id; ?>"><?php echo $cat->cat_name; ?></option>
		<?php endforeach;?>
	</select>
	
	</p>
	<p><input id="submitpost" type="submit" value="Update" ></p>
	<?php endforeach;?>
</form>
</div>
</div>
</div>