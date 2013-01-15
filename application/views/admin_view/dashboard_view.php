<div class="HR_contentcontainer">
<div class="HR_sidebarwrapper">
<div class="hr_admin_header_div">
		<?php if(isset($currUser['hr_personnel_name'])): ?>
		 <div class="HR_admincontainer"><a href=""><?php echo $currUser['hr_personnel_name'];  ?></a><p class=".HR_admincontainer_p_selected">+</p></div>
		 <div class="HR_signoutdropdown"><a href='<?php echo base_url(); ?>administrator/login'>Sign Out</a></div>
	<?php endif; ?>

</div>
	<ul class="HR_dashboardmenu">
		<li class="HR_menu" ><a href="#" class="HR_jobs hr_job_selected">Jobs</a>
			    <ul class="HR_submenu">
    				<li class="submenu"><a id="HR_postjobs" href="<?php echo base_url(); ?>administrator/dashboard/post_job">Post Jobs</a></li>
    				<li class="submenu"><a id="HR_managejobs" href="<?php echo base_url(); ?>administrator/dashboard/manage_jobs">Manage Jobs</a></li>
    			</ul>
		</li>
		<li class="HR_menu" ><a href="#" class="HR_reports">Reports</a>
				<ul class="HR_submenu2">
    				<li class="submenu2"><a href="<?php echo base_url(); ?>administrator/dashboard/reports">View Reports</a></li>
    			</ul>
		
		</li>
		<li class="HR_menu" ><a href="<?php echo base_url(); ?>administrator/dashboard/skill_catalog" class="HR_skills">Skill Catalog</a>
		</li>		
	</ul>
    </div>
    <div id="HR_fillupcontent">
    
	    <div id="hr_search_skill">
	    <form class="hr_search_by_skill_form" method="POST" action="#">
	    	<p><input type="text" name="search_skill" class="search_skill" value="Profession"/><input id="submitpost" type="submit" value="Search" ></p>
	    </form>
	    <div class="hr_serps_applicants">
	    </div>
	    
    </div>
</div>