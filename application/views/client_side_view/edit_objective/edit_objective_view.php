<div class="hr_contentpaperlogged">
<div class="hr_content_div">
<p class="hr_back_to_view_profile"><a href="<?php echo base_url(); ?>a/profile/view_profile/<?php echo $currUser['app_username_id']?>"><< Back to Profile</a></p>
<div class="hr_add_objective_div">
	<form action="<?php echo base_url(); ?>a/profile/edit_objective_validate" method="POST">
		<h4>Add Objective</h4>
		<?php foreach($record as $rec):?>
		<input type="hidden" name="account_id" value="<?php echo $rec->account_id ?>"/>
		<p><label>Objective</label></p><textarea name="objective" rows="9" cols="88"><?php echo $rec->objective ?></textarea><label class="errorMsg"><?php echo form_error('objective'); ?></label>
		<p><input class="hr_submitBtn" type="submit" value="Add Objective"></p>
		<?php endforeach;?>
	</form>
</div>
</div>
</div>
