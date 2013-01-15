<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	// construtor
	public function __construct() {
		parent::__construct();
	
	}
	
	public function view_profile() {
		
		// get the session variables
		$params = array('app_username', 'app_username_isLog', 'app_fullname', 'app_username_id');
		$this->sessionbrowser->getInfo($params);
		$data['currUser'] = $this->sessionbrowser->mData;
		
		// check if the account is log in
		authUser();
		
		$currUser = $this->uri->segment(4);
		
		$params['table'] = array('name' => 'hr_accounts', 'criteria_phrase'=> 'account_id="'. $currUser . '"');
		$this->mdldata->select($params);
		
		$data['records'] = $this->mdldata->_mRecords;
		
		foreach ($data['records'] as $rec) {
			
			$resume = $rec->resume_id;
			
			if(isset($resume)) {
			
				$this->mdldata->reset();
				$params['table'] = array('name' => 'hr_resume', 'criteria_phrase'=> 'resume_id="'. $rec->resume_id . '"');
				$this->mdldata->select($params);
				
				$data['resume'] = $this->mdldata->_mRecords;
				
				$this->mdldata->reset();
				$params['table'] = array('name' => 'hr_education', 'criteria_phrase'=> 'resume_id="'. $rec->resume_id . '" and active="1"');
				$this->mdldata->select($params);
				
				$data['education'] = $this->mdldata->_mRecords;
			
			}

			
		}
		
		$data['main_content'] = 'client_side_view/view_profile/view_profile_view';
		$this->load->view('client_side_view/includes/template', $data);
		
		
		
	}
	
	public function edit_profile() {
		
		// get the session variables
		$params = array('app_username', 'app_username_isLog', 'app_fullname', 'app_username_id');
		$this->sessionbrowser->getInfo($params);
		$data['currUser'] = $this->sessionbrowser->mData;
		
		// check if the account is log in
		authUser();
		
		$currUser = $this->uri->segment(4);
		
		$params['table'] = array('name' => 'hr_accounts', 'criteria_phrase' => 'account_id="'. $currUser . '"');
		$this->mdldata->select($params);
		
		$data['records'] = $this->mdldata->_mRecords;
 		
		$this->mdldata->reset();
		$params['querystring'] = "select * from hr_accounts left join hr_skill_catalog on hr_accounts.profession=hr_skill_catalog.skill_id where account_id='" . $currUser . "'";
		$this->mdldata->select($params);
		
		$data['skill_info'] = $this->mdldata->_mRecords;
		
		$this->mdldata->reset();
		$params['querystring'] = "select * from hr_skill_catalog";
		$this->mdldata->select($params);
		
		$data['skills'] = $this->mdldata->_mRecords;
		
		$data['main_content'] = 'client_side_view/edit_profile/edit_profile_view';
		$this->load->view('client_side_view/includes/template', $data);
		
	}
	
	public function edit_validate() {
		
		// check if the account is log in
		authUser();
		
		$account_id = $this->uri->segment(4);
		
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('mname', 'Middle Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('DOB', 'Date of Birth', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('address', 'Currect Address', 'required');
		$this->form_validation->set_rules('profession', 'Profession', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required');
		if ($this->form_validation->run() == FALSE) {
			redirect('a/profile/edit_profile/'. $account_id );
		} else {
				
			$params['fields'] = array(
					'fname' => $this->input->post('fname'),
					'mname' => $this->input->post('mname'),
					'lname' => $this->input->post('lname'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'address' => $this->input->post('address'),
					'profession' => $this->input->post('profession'),
					'DOB' => $this->input->post('DOB'),
					'gender' => $this->input->post('gender'),
					'password' => md5($this->input->post('pword')),
					'type_id' => '2'
			);
			
			$params['table'] = array('name'=> 'hr_accounts', 'criteria' => 'account_id', 'criteria_value' => $account_id );
				
			if($this->mdldata->update($params)) {
		
				redirect('a/profile/edit_profile/'. $account_id );
		
			} else {
				
				redirect('a/profile/edit_profile/'. $account_id );
			}
				
		}
	}
	
	public function add_objective() {
		
		// get the session variables
		$params = array('app_username', 'app_username_isLog', 'app_fullname', 'app_username_id');
		$this->sessionbrowser->getInfo($params);
		$data['currUser'] = $this->sessionbrowser->mData;
		
		// check if the account is log in
		authUser();
		
		$data['main_content'] = 'client_side_view/add_objective/add_objective_view';
		$this->load->view('client_side_view/includes/template', $data);
		
		
	}
	
	public function add_objective_validate() {
		
		// check if the account is log in
		authUser();
		
		$this->form_validation->set_rules('objective', 'Objective', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			
			$this->add_objective();
			//$redirect('a/profile/view_profile/'. $this->input->post('account_id'));
		
		} else {
			
			$params['fields'] = array(
					'objective' => $this->input->post('objective')
						);
			
			$params['table'] = array('name' => 'hr_resume', 'criteria' => 'account_id', 'criteria_value' => $this->input->post('account_id'));
			
			if($this->mdldata->update($params)) {
				
				
				$params['querystring'] = 'SELECT * FROM `hr_resume` WHERE account_id="'.  $this->input->post('account_id') .'"';
				$this->mdldata->select($params);
				
				$data['resume'] = $this->mdldata->_mRecords;
				
				foreach($data['resume'] as $res) {
					
					$resume_id = $res->resume_id;
				}
				$this->mdldata->reset();
				$params['querystring'] = 'UPDATE hr_accounts SET resume_id="'. $resume_id . '" WHERE account_id="' . $this->input->post('account_id')  . '"';
				
				if($this->mdldata->update($params))
					redirect('a/profile/view_profile/'. $this->input->post('account_id'));
				else
					redirect('a/profile/add_objective/'. $this->input->post('account_id'));
				
				
			} else {
				
			}
			
			
		}
		
	}
	
	public function add_education() {
		
		// get the session variables
		$params = array('app_username', 'app_username_isLog', 'app_fullname', 'app_username_id');
		$this->sessionbrowser->getInfo($params);
		$data['currUser'] = $this->sessionbrowser->mData;
		
		// check if the account is log in
		authUser();
		
		$data['main_content'] = 'client_side_view/add_education/add_education_view';
		$this->load->view('client_side_view/includes/template', $data);
		
	}
	
	public function edit_objective() {
		
		// get the session variables
		$params = array('app_username', 'app_username_isLog', 'app_fullname', 'app_username_id');
		$this->sessionbrowser->getInfo($params);
		$data['currUser'] = $this->sessionbrowser->mData;
		
		// check if the account is log in
		authUser();
		
		$currUser = $this->uri->segment(4);
		
		$params['table'] = array('name' => 'hr_resume', 'criteria_phrase' => 'account_id="'. $currUser . '"');
		$this->mdldata->select($params);
		
		$data['record'] = $this->mdldata->_mRecords;
		
		$data['main_content'] = 'client_side_view/edit_objective/edit_objective_view';
		$this->load->view('client_side_view/includes/template', $data);
		
	}
	
	public function edit_objective_validate() {
		
		// get the session variables
		$params = array('app_username', 'app_username_isLog', 'app_fullname', 'app_username_id');
		$this->sessionbrowser->getInfo($params);
		$data['currUser'] = $this->sessionbrowser->mData;
		
		// check if the account is log in
		authUser();
		
		$this->form_validation->set_rules('objective', 'Objective', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			
			$this->edit_objective();
			//$redirect('a/profile/view_profile/'. $this->input->post('account_id'));
		
		} else {
			
			$account_id = $this->input->post('account_id');
			
			$params['fields'] = array(
					'objective' => $this->input->post('objective')
					);
			$params['table'] = array('name' => 'hr_resume', 'criteria' => 'account_id', 'criteria_value' => $account_id );
			
			$this->mdldata->update($params);
			
			redirect('a/profile/view_profile/'. $account_id);
			
		}

		
	}
	
	public function add_education_validate() {
		
		
		// check if the account is log in
		authUser();
		
		$this->form_validation->set_rules('degree', 'Objective', 'required');
		$this->form_validation->set_rules('fstudy', 'Objective', 'required');
		$this->form_validation->set_rules('school', 'Objective', 'required');
		$this->form_validation->set_rules('schoolcity', 'Objective', 'required');

		$currUser = $this->input->post('account_id');
		
		if ($this->form_validation->run() == FALSE) {
				
			$this->add_education();
		
		
		} else {
				
			
			$params['table'] = array('name' => 'hr_resume', 'criteria_phrase' => 'account_id="'. $currUser . '"');
			$this->mdldata->select($params);
			
			$data['resume'] = $this->mdldata->_mRecords;
			
			foreach($data['resume'] as $rec) {
				
				$resume_id = $rec->resume_id;
				$this->mdldata->reset();
				$params['fields'] = array(
								'school_name' => $this->input->post('school'),
								'degree' => $this->input->post('degree'),
								'location' => $this->input->post('schoolcity'),
								'year_started' => $this->input->post('from'),
								'year_ended' => $this->input->post('to'),
								'area_of_study' => $this->input->post('fstudy'),
								'resume_id' => $resume_id								
								);
				$params['table'] = array('name' => 'hr_education');
				
				if($this->mdldata->insert($params)) {
					
					$params['querystring'] = "UPDATE hr_accounts SET resume_id='". $resume_id . "' WHERE account_id='". $currUser ."'";
					$this->mdldata->update($params);
					
					redirect('a/profile/view_profile/'. $this->input->post('account_id'));
					
				} else {
	
					redirect('a/profile/add_education/'. $this->input->post('account_id'));
				}
			 }
		
		}
		
	}
	
	public function delete_education() {
		
		// check if the account is log in
		authUser();
		
		$resume_id = $this->uri->segment(5);
		$account_id = $this->uri->segment(4);
		
		$params['fields'] = array(
					'active' => 0
				);
		
		$params['table'] = array('name' => 'hr_education', 'criteria' => 'resume_id="'. $resume_id . '"');
		$this->mdldata->update($params);
		
		redirect('a/profile/view_profile/'. $account_id); 
	}
	
	public function myjobs() {
	
		// get the session variables
		$params = array('app_username', 'app_username_isLog', 'app_fullname', 'app_username_id');
		$this->sessionbrowser->getInfo($params);
		$data['currUser'] = $this->sessionbrowser->mData;
	
		// check if the account is log in
		authUser();
	
		$account_id = $this->uri->segment(4);
	
		$params['querystring'] = "SELECT * FROM `hr_job_applicant` left join hr_jobs on hr_job_applicant.job_id=hr_jobs.job_id where hr_job_applicant.account_id='" . $account_id . "' and hr_job_applicant.hired='1'";
		$this->mdldata->select($params);
	
		$data['my_jobs'] = $this->mdldata->_mRecords;
		//call_debug($data);
		$data['main_content'] = 'client_side_view/myjobs_view/myjobs_view';
		$this->load->view('client_side_view/includes/template', $data);
	
	}
	
	public function message() {
		
		// get the session variables
		$params = array('app_username', 'app_username_isLog', 'app_fullname', 'app_username_id');
		$this->sessionbrowser->getInfo($params);
		$data['currUser'] = $this->sessionbrowser->mData;
		
		// check if the account is log in
		authUser();
		
		$currUser = $this->uri->segment(4);
		
		$params['table'] = array('name' => 'hr_notifications', 'criteria_phrase' => 'account_id="' . $currUser . '" and active="1"');
		$this->mdldata->select($params);
		
		$data['records'] = $this->mdldata->_mRecords;
		
		$data['main_content'] = 'client_side_view/notification/notification_view';
		$this->load->view('client_side_view/includes/template', $data);
	}
	
	// delete notification
	public function delete() {
	
		$account_id = $this->uri->segment(4);
		$notification_id = $this->uri->segment(5);
	
		$params['fields'] = array(
				'active' => 0
		);
		$params['table'] = array('name' => 'hr_notifications', 'criteria' => 'account_id', 'criteria_value' => ''. $account_id . "' and notification_id='". $notification_id . "");
		
		$this->mdldata->update($params);
		
		redirect('a/profile/message/'. $account_id);
	}
}