$(document).ready(function(){
	
	$('.HRdropdown').hide();
	$('.HR_signoutdropdown').hide();
	$('.submenu').hide();
	$('.submenu2').hide();
	$('.hr_added_skill_confirmation').hide();
	

	var l = window.location;
	var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1] + "/";
	
	$('#hr_search_job_form').submit(function(){
		//alert("hit me");
		$.post(base_url + "ajax/ajax/search_job", {job_title: $("#hr_search_job_box").attr('value')})
		.success(function(data) {
			if(data == null) {
				
				
			} else {
				$('.HR_contentcontainer').empty();
				$('.HR_contentcontainer').append(data);
			}

					
		});
	return false;
	});	
	
	
	
	$("#HRSearchkeyword").submit(function() {
		
		$.post(base_url + "ajax/ajax/search/calculate_age/", {job_title: $("#HRsearchinput").attr('value')})
		.success(function(data) {
			if(data == null) {
				
				
			} else {
				$('.hr_list_all_jobs').empty();
				$('.hr_list_all_jobs').append(data);
			}

					
		});
	return false;
		
	});
	
	$(".HRArrowDown").hover(
			  function () {
				  $('.HRdropdown').show();
			  },
			  function(){
				  $('.HRdropdown').hide();
			});
	
	$('.HRdropdown').hover(
			function () {
				
				$('.HRArrowDown').addClass('arrowDownSelected');
				
				  $('.HRdropdown').show();
			  },
			  function(){
				  $('.HRArrowDown').removeClass('arrowDownSelected');
				  $('.HRdropdown').hide();
			});
	
	
	$('.HRtab').click(function() {
		
		$('.HRtab').removeClass('HRtabSelected');
		$('.HRtab').addClass('HRtabSelected');
		
		
	});
	
	$(".HR_admincontainer p").hover(
			function () {
				
				  $('.HR_signoutdropdown').show();
			  },
			  function(){

				  $('.HR_signoutdropdown').hide();
			});
	
	$('.HR_signoutdropdown').hover(
			function () {
				
				
				$('.HR_admincontainer p').addClass('HR_admincontainer_p_selected');
				$('.HR_signoutdropdown').show();
			  },
			  function(){
				  $('.HR_admincontainer p').removeClass('HR_admincontainer_p_selected');
				  $('.HR_signoutdropdown').hide();
			});
	
	// hover icons
	$('.HR_dashboardmenu .HR_menu a.HR_jobs').hover(
			function () {
			
				$('.submenu').show();
			  },
			  function(){

				  $('.submenu').hide();
			});
	
	// hover submenu
	$('.submenu').hover(
			function () {
				
				;
				$('.submenu').show();
			  },
			  function(){
				 
				  $('.submenu').hide();
			});
	
	
	$('.HR_dashboardmenu .HR_menu a.HR_reports ').hover(
			function () {
				
				$('.submenu2').show();
			  },
			  function(){

				  $('.submenu2').hide();
			});
	
	$('.submenu2 ').hover(
			function () {
				
				$('.submenu2').show();
			  },
			  function(){

				  $('.submenu2').hide();
			});
	
	// calculate Age
	$('.hr_year').blur(function(){
		
		$.post(base_url + "ajax/ajax/calculate_age/", {month: $('.hr_month').attr('value'),year: $('.hr_year').attr('value'),day: $('.hr_day').attr('value') })
		.success(function(data) {
				
				$('.hr_age_span').empty();
				$('.hr_age_span').append(data);
				$('.hr_age').val(data);
					
		});
		
	});	
	
	
	// search item code
	$( "#hr_search_job_box" ).autocomplete({
		source: function(req, add){
			$.ajax({
				url			:	base_url + "ajax/ajax/ajax_search_job/",
				dataType	:	"jsonp",							
				data		:	{title: req.term},
				success		: 	function(data) {
									add( $.map( data, function( item ) {
											return {
												label: item.job_title,
												value: item.job_title
											}
										}));
								}
			});
			
		},
		
		focus: function( event, ui ) {
			$( "#hr_search_job_box" ).val( ui.item.label );
			return true;
		}
		
		
	});
	
	// search item code
	$( ".search_skill" ).autocomplete({
		source: function(req, add){
			$.ajax({
				url			:	base_url + "ajax/ajax/search_profession/",
				dataType	:	"jsonp",							
				data		:	{skill_name: req.term},
				success		: 	function(data) {
									add( $.map( data, function( item ) {
											return {
												label: item.skill,
												value: item.skill
											}
										}));
								}
			});
			
		},
		
		focus: function( event, ui ) {
			$( ".search_skill" ).val( ui.item.label );
			return true;
		}
		
		
	});
	
	// submit add skill
	$(".hr_add_skill_form").submit(function() {
		
		$.post(base_url + "administrator/dashboard/add_skill_validate/", {skill_category: $('.skill_category').attr('value'),skill_name: $('.hr_skill_name').attr('value')})
		.success(function(data) {
			if(data == "FALSE") {
				
				var url  = base_url + "administrator/dashboard/skill_catalog";   
				$(location).attr('href',url);
				
			} else {
				
				$('.hr_added_skill_confirmation').show();
			}

					
		});
	return false;
		
	});
	
	//edit
	// submit add skill
	$(".hr_edit_skill_form").submit(function() {
		
		$.post(base_url + "administrator/dashboard/edit_skill_validate/", {skill_category: $('.skill_category').attr('value'),skill_name: $('.hr_skill_name').attr('value'), skill_id: $('.hr_skill_id').attr('value')})
		.success(function(data) {
			if(data == "FALSE") {
				
				var url  = base_url + "administrator/dashboard/skill_catalog";   
				$(location).attr('href',url);
				
			} else {

				$('.hr_added_skill_confirmation').show();
				location.reload(); 
			}

					
		});
	return false;
		
	});
	
	$('.search_skill').focus(function() {
		
		$('.search_skill').val('');
		
	});
	
	$(".hr_search_by_skill_form").submit(function() {
		
		$.post(base_url + "ajax/ajax/search_applicant_by_profession/", {skill_name: $('.search_skill').attr('value')})
		.success(function(data) {
			
			if(data == null) {
				
				$('.hr_serps_applicants').empty.append(data);
				
			} else {
					
				$('.hr_serps_applicants').empty().append(data);
				

			}

					
		});
	return false;
		
	});

	
});