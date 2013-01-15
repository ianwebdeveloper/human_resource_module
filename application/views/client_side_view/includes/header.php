<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Human Resource Module</title>
<script src="<?php echo base_url(); ?>js/jquery.1.7.1.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui-1.8.24.custom.min.js"></script>
<script src="<?php echo base_url(); ?>js/ajax_utility.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>js/development-bundle/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url(); ?>js/development-bundle/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>js/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>js/development-bundle/ui/jquery.ui.datepicker.js"></script>
</head>
<body>
<div class='hr_app_header'>
<div class="HRNamelinkDropdown">
	<?php if(isset($currUser['app_fullname'])): ?>
		 <div class="HRNameLinkContainer"><a href="<?php echo base_url(); ?>a/profile/view_profile/<?php echo $currUser['app_username_id']; ?>"><?php echo $currUser['app_fullname'];  ?></a><span class="HRArrowDown">▼</span></div>
    <div class="HRdropdown ">     
		<li class="HRDropdownList"><a  href="<?php echo base_url(); ?>a/profile/edit_profile/<?php echo $currUser['app_username_id']; ?>">Edit Profile</a></li>
		<li class="HRDropdownList"><a  href='<?php echo base_url(); ?>home/logout'>Sign Out</a></li>
	<?php endif; ?>
    </div>
</div>	


<div class="HRTabsContainer">
<div class="hr_menubar_front">
	<?php $select = $this->uri->segment(2); ?>
	<?php $job = $this->uri->segment(3); ?>
	<?php if($select == "search_jobs"):?>
		<a class="HRtab HRtabSelected" href="<?php echo base_url(); ?>a/search_jobs">Find Jobs</a>
		<a class="HRtab" href="<?php echo base_url(); ?>a/profile/myjobs/<?php echo $currUser['app_username_id']; ?>">My Jobs</a>
	<?php elseif($select == "profile" && $job == "myjobs"):?>
		<a class="HRtab " href="<?php echo base_url(); ?>a/search_jobs">Find Jobs</a>
		<a class="HRtab HRtabSelected" href="<?php echo base_url(); ?>a/profile/myjobs/<?php echo $currUser['app_username_id']; ?>">My Jobs</a>
	<?php elseif($select == "profile" && $job == "view_profile"):?>
		<a class="HRtab HRtabSelected" href="<?php echo base_url(); ?>a/search_jobs">Find Jobs</a>
		<a class="HRtab " href="<?php echo base_url(); ?>a/profile/myjobs/<?php echo $currUser['app_username_id']; ?>">My Jobs</a>
	<?php elseif($select == "profile" && $job == "edit_profile"):?>
		<a class="HRtab HRtabSelected" href="<?php echo base_url(); ?>a/search_jobs">Find Jobs</a>
		<a class="HRtab " href="<?php echo base_url(); ?>a/profile/myjobs/<?php echo $currUser['app_username_id']; ?>">My Jobs</a>
	<?php elseif($select == "profile" && $job == "message"):?>
	<a class="HRtab HRtabSelected" href="<?php echo base_url(); ?>a/search_jobs">Find Jobs</a>
		<a class="HRtab " href="<?php echo base_url(); ?>a/profile/myjobs/<?php echo $currUser['app_username_id']; ?>">My Jobs</a>
	<?php endif;?>
	</div>
</div>

<?php 

$info['data'] = array(
		'table_name' => 'hr_notifications',
		'filter_string' => 'account_id="' . $currUser['app_username_id'] . '" and active="1"'
		);
counter($info);
?>


<p id="HR_usermessage"><a href="<?php echo base_url(); ?>a/profile/message/<?php echo $currUser['app_username_id']; ?>">Message(<?php echo counter($info); ?>)</a></p>

</div>