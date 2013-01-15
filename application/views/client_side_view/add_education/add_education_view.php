<div class="hr_contentpaperlogged">
<div class="hr_content_div">
<p class="hr_back_to_view_profile"><a href="<?php echo base_url(); ?>a/profile/view_profile/<?php echo $currUser['app_username_id']?>"><< Back to Profile</a></p>
<div id="edu_add_form" class="edit_form">

<form action="<?php echo base_url(); ?>a/profile/add_education_validate" method="POST">
    <input type="hidden" name="account_id" value="<?php echo $currUser['app_username_id']?>" />
	<p><label>Degree</label><br /><input type="text" name="degree" /><label class="errorMsg"><?php echo form_error('degree'); ?></label><br /><span class="tooltips">Ex. BA, BS, JD, PhD.</span></p>
    <p><label>Field of Study</label><br /><input type="text" name="fstudy" /><label class="errorMsg"><?php echo form_error('fstudy'); ?></label><br /><span class="tooltips">Ex. Biology, Computer Science, Intellectual Property, Nursing, Psychology.</span></p>
    <p><label>School</label><br /><input type="text" name="school" /><label class="errorMsg"><?php echo form_error('school'); ?></label></p>
	<p><label>City</label><br /><input type="text" name="schoolcity" /><label class="errorMsg"><?php echo form_error('schoolcity'); ?></label></p>
    <p><label>Time Period</label><br />	<select name="from">
    										<option value="-1">Year:</option>
                                            <?php $upper = 2019; $lower = 1955;  ?>
                                            <?php for($i = $upper; $i >= $lower; $i--): ?>
												<option value="<?php echo $i;?>" ><?php echo $i; ?></option>
											<?php endfor; ?>
    									</select> to <select name="to">
    										<option value="-1">Year:</option>
                                            <?php for($i = $upper; $i >= $lower; $i--): ?>
												<option  value="<?php echo $i;?>" ><?php echo $i; ?></option>
											<?php endfor; ?>
    									</select><br /><span class="tooltips">Current students: enter your expected graduation year. </span>
                                        </p>
	<p><input class="hr_submitBtn" class="resumesave" type="submit" value="Save" /></p>        
</form>
	</div>
</div>
</div>