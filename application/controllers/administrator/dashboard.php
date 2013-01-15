<?php if ( ! defined('BASEPATH')) exit();

class Dashboard extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();

		
	}
	
	public function index() {
		
		
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			// get the session variables
			$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
			$this->sessionbrowser->getInfo($params);
			$data['currUser'] = $this->sessionbrowser->mData;
			
			$data['main_content'] = 'admin_view/dashboard_view';
			$this->load->view('admin_view/includes/template', $data);
			
		} else {
			
			redirect('administrator/login');
			
		}
		
	}
	
	// post job
	public function post_job() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			// get the session variables
			$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
			$this->sessionbrowser->getInfo($params);
			$data['currUser'] = $this->sessionbrowser->mData;
			
			$params['table'] = array('name' => 'hr_job_categories');
			$this->mdldata->select($params);
			
			$data['categories'] = $this->mdldata->_mRecords;
			
			
			$data['main_content'] = 'admin_view/post_job_view';
			$this->load->view('admin_view/includes/template', $data);
			
		} else {
			
			redirect('administrator/login');
			
		}
		
	}
	
	public function validatePostedJob() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			
				
			$this->form_validation->set_rules('job_title', 'Job Title', 'required');
			$this->form_validation->set_rules('job_desc', 'Job Description', 'required');
			$this->form_validation->set_rules('no_of_emp', 'No of Employee', 'required');
 			$this->form_validation->set_rules('job_category', 'Job Category', 'required');
			$this->form_validation->set_rules('location', 'Location', 'required');
				
			if ($this->form_validation->run() == FALSE) {
				
				$this->post_job();
				
			} else {
				
				// get the session variables
				$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
				$this->sessionbrowser->getInfo($params);
				$data['currUser'] = $this->sessionbrowser->mData;
				
				$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
				
				$this->sessionbrowser->getInfo($params);
				
				$currUser = $this->sessionbrowser->mData;
				
				
				$params['table'] = array('name' => 'hr_accounts', 'criteria_phrase' => 'email="' . $currUser['hr_personnel'] . '"');
				$this->mdldata->select($params);	
				$result = $this->mdldata->_mRecords;
				
				$datestring = "Y-m-d";
				$time = time();
				$currentDate = mdate($datestring, $time);
							
				$params['fields'] = array(
						'job_title' => $this->input->post('job_title'),
						'job_description' => $this->input->post('job_desc'),
						'location' => $this->input->post('location'),
						'number_of_employee' => $this->input->post('no_of_emp'),
						'posted_date' => $currentDate,
 						'cat_id' => $this->input->post('job_category'),
						'account_id' => $result[0]->account_id
						);
				$params['table'] = array('name' => 'hr_jobs');
				
				if($this->mdldata->insert($params)) {
					
					$data['main_content'] = 'admin_view/success_page_for_adding_job';
					$this->load->view('admin_view/includes/template', $data);
					
				} else {
					
					redirect('administrator/dashboard/post_job');
					
				}
				
			}
				
		} else {
				
			redirect('administrator/login');
				
		}
		
		
	}
	
	public function manage_jobs() {
		
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			// get the session variables
			$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
			$this->sessionbrowser->getInfo($params);
			$data['currUser'] = $this->sessionbrowser->mData;
			
			$params['querystring'] = 'SELECT hr_jobs.job_id, hr_jobs.job_title, hr_jobs.posted_date, hr_jobs.status, hr_accounts.fname, hr_accounts.lname FROM `hr_jobs` left join hr_accounts on hr_jobs.account_id=hr_accounts.account_id where hr_jobs.active="1" ORDER BY hr_jobs.posted_date DESC';
			$this->mdldata->select($params);
			
			$data['records'] = $this->mdldata->_mRecords;
			
			$data['main_content'] = 'admin_view/manage_jobs_view';
			$this->load->view('admin_view/includes/template', $data);
			
		} else {
			
			redirect('administrator/login');
			
		}
		
	}
	
	public function applicant() {
		
		//call_debug($this->uri->segment(4));
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			// get the session variables
			$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
			$this->sessionbrowser->getInfo($params);
			$data['currUser'] = $this->sessionbrowser->mData;
			
			$job_id = $this->uri->segment(4);
			
			$params['querystring'] = 'SELECT hr_job_applicant.job_id, hr_job_applicant.hired, hr_job_applicant.applied_date, hr_accounts.fname, hr_accounts.lname, hr_accounts.account_id FROM `hr_job_applicant` left join hr_accounts on hr_job_applicant.account_id=hr_accounts.account_id where job_id="'. $job_id . '"';
			$this->mdldata->select($params);
				
			$data['applicants'] = $this->mdldata->_mRecords;

			$data['main_content'] = 'admin_view/applicant_job_view';
			$this->load->view('admin_view/includes/template', $data);
				
		} else {
				
			redirect('administrator/login');
				
		}
	}
	
	public function view_job() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			// get the session variables
			$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
			$this->sessionbrowser->getInfo($params);
			$data['currUser'] = $this->sessionbrowser->mData;
			
			$job_id = $this->uri->segment(4);
			
 			$params['table'] = array('name' => 'hr_jobs', 'criteria_phrase' => 'job_id="' . $job_id . '"');
			$this->mdldata->select($params);
			$data['record'] = $this->mdldata->_mRecords;
			
			$this->mdldata->reset();

			$params['querystring'] = 'SELECT hr_job_applicant.reject, hr_job_applicant.fired, hr_job_applicant.fired_date, hr_job_applicant.hired, hr_job_applicant.applied_date, hr_accounts.fname, hr_accounts.lname, hr_accounts.account_id FROM `hr_job_applicant` left join hr_accounts on hr_job_applicant.account_id=hr_accounts.account_id where job_id="'. $job_id . '"';
			$this->mdldata->select($params);
			
			$data['applicants'] = $this->mdldata->_mRecords;
			
			//call_debug($data);
			
			$data['main_content'] = 'admin_view/view_job_view';
			$this->load->view('admin_view/includes/template', $data);
			
		} else {
			
			redirect('administrator/login');
		}
		
		
	}
	
	public function edit_job() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			// get the session variables
			$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
			$this->sessionbrowser->getInfo($params);
			$data['currUser'] = $this->sessionbrowser->mData;
			
			$this->mdldata->reset();
			$params['table'] = array('name' => 'hr_job_categories');
			$this->mdldata->select($params);
			
			$data['categories'] = $this->mdldata->_mRecords;
				
			$job_id = $this->uri->segment(4);
			
			$params['querystring'] = "SELECT * FROM `hr_jobs` left join hr_job_categories on hr_jobs.cat_id=hr_job_categories.cat_id where hr_jobs.job_id='". $job_id . "'";
			$this->mdldata->select($params);
			$data['job'] = $this->mdldata->_mRecords;
			
			//call_debug($data);
			$data['main_content'] = 'admin_view/edit_job_view';
			$this->load->view('admin_view/includes/template', $data);
				
		} else {
				
			redirect('administrator/login');
		}
		
	}
	
	public function validate_edited_job() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			// get the session variables
			$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
			$this->sessionbrowser->getInfo($params);
			$data['currUser'] = $this->sessionbrowser->mData;
		
				
				$params['fields'] = array(
						'job_title' => $this->input->post('job_title'),
						'job_description' => $this->input->post('job_desc'),
						'location' => $this->input->post('location'),
						'number_of_employee' => $this->input->post('no_of_emp'),
						'posted_date' => $this->input->post('posted_date'),
						'cat_id' => $this->input->post('job_category'),
						'account_id' => $this->input->post('account_id'),
						'status'=> 1
						);
				$params['table'] = array('name' => 'hr_jobs', 'criteria' => 'job_id', 'criteria_value' => $this->input->post('job_id'));
				
				if($this->mdldata->update($params)) {
					
					redirect('administrator/dashboard/manage_jobs');
				
				} else {
					
					redirect('administrator/dashboard/edit_job/'. $this->input->post('job_id') . '');
				
				}
		
		} else {
		
			redirect('administrator/login');
		}
		
		
	}
	
	public function close_job() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			// get the session variables
			$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
			$this->sessionbrowser->getInfo($params);
			$data['currUser'] = $this->sessionbrowser->mData;
		
			$job_id = $this->uri->segment(4);
			
			
			$params['fields'] = array('status' => '0');	
			$params['table'] = array('name' => 'hr_jobs', 'criteria' => 'job_id', 'criteria_value' => $job_id );
			
			if($this->mdldata->update($params)) {
				redirect('administrator/dashboard/manage_jobs');
			} else {
				redirect('administrator/dashboard/manage_jobs');
			}
			
		} else {
		
			redirect('administrator/login');
		}
	}
	
	public function hired() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			// get the session variables
			$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
			$this->sessionbrowser->getInfo($params);
			$data['currUser'] = $this->sessionbrowser->mData;
		
			$job_id = $this->uri->segment(4);
			$account_id = $this->uri->segment(5);
			
			$datestring = "Y-m-d g:i:s";
			$time = time();
			$currentDate = mdate($datestring, $time);
			
			$date = mysqlDate($currentDate);
			
			$params['fields'] = array(
					
					'hired' => '1',
					'hired_date' => $date,
					'fired' => '0',
					'fired_date' => ''
					);
			
			$params['table'] = array('name' => 'hr_job_applicant', 'criteria_phrase' => 'job_id="' . $job_id . '" and account_id="'. $account_id . '"' );
			if($this->mdldata->update($params)) {
				
				
				$params['querystring'] = "SELECT * FROM hr_jobs WHERE job_id='" . $job_id . "'";
				$this->mdldata->select($params);
				
				$data['jobs_info'] = $this->mdldata->_mRecords;
				
				foreach($data['jobs_info'] as $data) {
					
						$job_title = $data->job_title;
						
						$message = "CONGRATULATIONS!!! You just been invited for an interview for applying  " . $job_title . " Job. Please Come in the Ecoville Office after two business hours";
						
						$this->mdldata->reset();
						$params['querystring'] = "INSERT INTO hr_notifications(message, date, account_id) VALUES('". $message ."', '". $date . "', '". $account_id ."')";
						$this->mdldata->insert($params);
						
				}
				
				redirect('administrator/dashboard/view_job/'. $job_id . '');
			} else {
				redirect('administrator/dashboard/view_job/'. $job_id . '');
			}
				
		} else {
		
			redirect('administrator/login');
		}
		
		
	}
	
	public function reject() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
		
			// get the session variables
			$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
			$this->sessionbrowser->getInfo($params);
			$data['currUser'] = $this->sessionbrowser->mData;
			
			$job_id = $this->uri->segment(4);
			$account_id = $this->uri->segment(5);
				
			$datestring = "Y-m-d g:i:s";
			$time = time();
			$currentDate = mdate($datestring, $time);
				
			$date = mysqlDate($currentDate);
				
			$params['fields'] = array(
						
					'hired' => '0',
					'hired_date' => '',
					'fired' => '0',
					'fired_date' => '',
					'reject' => 1
			);
				
			$params['table'] = array('name' => 'hr_job_applicant', 'criteria_phrase' => 'job_id="' . $job_id . '" and account_id="'. $account_id . '"' );
			if($this->mdldata->update($params)) {
				

				$params['querystring'] = "SELECT * FROM hr_jobs WHERE job_id='" . $job_id . "'";
				$this->mdldata->select($params);
				
				$data['jobs_info'] = $this->mdldata->_mRecords;
				
				foreach($data['jobs_info'] as $data) {
				
				$job_title = $data->job_title;
				
				$message = "Sorry, You just been rejected to " . $job_title . " Job. Thank you";
				
				$this->mdldata->reset();
				$params['querystring'] = "INSERT INTO hr_notifications(message, date, account_id) VALUES('". $message ."', '". $date . "', '". $account_id ."')";
				$this->mdldata->insert($params);
				
				}
				redirect('administrator/dashboard/view_job/'. $job_id . '');
			} else {
				
				redirect('administrator/dashboard/view_job/'. $job_id . '');
			}
		
		} else {
		
			redirect('administrator/login');
		}
		
	}
	
	public function fired() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
		
			// get the session variables
			$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
			$this->sessionbrowser->getInfo($params);
			$data['currUser'] = $this->sessionbrowser->mData;
				
			$job_id = $this->uri->segment(4);
			$account_id = $this->uri->segment(5);
		
			$datestring = "Y-m-d g:i:s";
			$time = time();
			$currentDate = mdate($datestring, $time);
		
			$date = mysqlDate($currentDate);
		
			$params['fields'] = array(
		
					'hired' => '0',
					'fired' => '1',
					'fired_date' => $date
			);
		

			$params['table'] = array('name' => 'hr_job_applicant', 'criteria_phrase' => 'job_id="' . $job_id . '" and account_id="'. $account_id . '"' );
			if($this->mdldata->update($params)) {
				redirect('administrator/dashboard/view_job/'. $job_id . '');
			} else {
		
				redirect('administrator/dashboard/view_job/'. $job_id . '');
			}
		
		} else {
		
			redirect('administrator/login');
		}
		
	}
	
	public function reports() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
		
		$data['main_content'] = 'admin_view/reports_view';
		$this->load->view('admin_view/includes/template', $data);
		
		} else {
		
			redirect('administrator/login');
		}
		
	}
	
	public function reports_validate() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			
			$cat = $this->input->post('category');
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			
			if($cat == "hr_jobs") {
				
				if($month == '-1') {
					
					$params['querystring'] = "SELECT * FROM hr_jobs left join hr_accounts on hr_jobs.account_id=hr_accounts.account_id";
					$this->mdldata->select($params);
					
					$data['records'] = $this->mdldata->_mRecords;
					
					
					$data['main_content'] = 'admin_view/jobs_reports';
					$this->load->view('admin_view/includes/template', $data);
					
				} else {
				
					$params['querystring'] = "SELECT *, DATE_FORMAT(posted_date,'%Y-%m') AS report FROM hr_jobs left join hr_accounts on hr_jobs.account_id=hr_accounts.account_id  WHERE MONTH(posted_date) = '". $month . "' AND YEAR(posted_date)='". $year . "'";
					
					$this->mdldata->select($params);
					
					$data['records'] = $this->mdldata->_mRecords;
					
					$data['main_content'] = 'admin_view/jobs_reports';
					$this->load->view('admin_view/includes/template', $data);
					
				}
			} else {
				
				if($year == '-1') {

					$params['querystring'] = "SELECT *, DATE_FORMAT(applied_date,'%Y-%m') AS report FROM hr_job_applicant left join hr_jobs on hr_job_applicant.job_id=hr_jobs.job_id left join hr_accounts on hr_job_applicant.account_id=hr_accounts.account_id where hired='1'";
					$this->mdldata->select($params);
						
					$data['records'] = $this->mdldata->_mRecords;
					
					$data['main_content'] = 'admin_view/job_applicants_reports';
					$this->load->view('admin_view/includes/template', $data);
						
				} else {
				
				
					$params['querystring'] = "SELECT *, DATE_FORMAT(applied_date,'%Y-%m') AS report FROM hr_job_applicant left join hr_jobs on hr_job_applicant.job_id=hr_jobs.job_id left join hr_accounts on hr_job_applicant.account_id=hr_accounts.account_id  WHERE MONTH(applied_date) = '". $month . "' AND YEAR(applied_date)='". $year . "' and hired='1'";
					$this->mdldata->select($params);
					
					$data['records'] = $this->mdldata->_mRecords;
					
					
					$data['main_content'] = 'admin_view/job_applicants_reports';
					$this->load->view('admin_view/includes/template', $data);
						
				}
				
			}
		
		} else {
		
			redirect('administrator/login');
		}

	}
	
	// skill catalog
	public function skill_catalog() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			
			$params['table'] = array('name' => 'hr_job_categories');
			$this->mdldata->select($params);
			
			$data['categories'] = $this->mdldata->_mRecords;
			
			$this->mdldata->reset();
			$params['querystring'] = "SELECT hr_skill_catalog.skill_id, hr_skill_catalog.skill, hr_job_categories.cat_name FROM `hr_skill_catalog` left join hr_job_categories on hr_skill_catalog.job_type_id=hr_job_categories.cat_id where hr_skill_catalog.active='1' ORDER BY skill ASC";
			$this->mdldata->select($params);
			
			$row_count = $this->mdldata->_mRowCount;
			
			$config['base_url'] = base_url() . 'administrator/dashboard/skill_catalog/';
			$config['total_rows'] = $row_count;
			$config['per_page'] = 5;
			$config['uri_segment'] = 4;
			$config['full_tag_open'] = '<div id="link_tag">';
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<div id="first">';
			$config['first_tag_close'] = '</div>';
			$config['full_tag_close'] = '</div>';
			
			$this->pagination->initialize($config);
			
			$uri = $this->uri->segment(4);
			
			if($uri == null)
				$uri = 0;
			
			$params['querystring'] = "SELECT hr_skill_catalog.skill_id, hr_skill_catalog.skill, hr_job_categories.cat_name FROM `hr_skill_catalog` left join hr_job_categories on hr_skill_catalog.job_type_id=hr_job_categories.cat_id where hr_skill_catalog.active='1' ORDER BY skill ASC LIMIT 5 OFFSET " . $uri  . "";
			$this->mdldata->select($params);
			$data['skills'] = $this->mdldata->_mRecords;
			
			$data['pagination_links'] = $this->pagination->create_links();
			
		
			$data['main_content'] = 'admin_view/add_skill_view';
			$this->load->view('admin_view/includes/template', $data);
			
		} else {
			redirect('administrator/login');
		}
		
	}
	
	public function add_skill_validate() {
		

		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
				
				
		
			$this->form_validation->set_rules('skill_name', 'SKill Name', 'required');
			$this->form_validation->set_rules('skill_category', 'Job Category', 'required');


			if ($this->form_validation->run() == FALSE) {
				
				echo 'FALSE';
				
			} else {
				
				$params['fields'] = array(
						'skill' => $this->input->post('skill_name'),
						'job_type_id' => $this->input->post('skill_category'),
						'active' => 1
				);
				
				$params['table'] = array('name' => 'hr_skill_catalog');
				
				if($this->mdldata->insert($params))  {
					echo "TRUE";
				} else {
					echo 'FALSE';
				}
				
			}
		} else {
			redirect('administrator/login');
		}
		
	}
	
	public function edit_skill() {
		
		$params['table'] = array('name' => 'hr_job_categories');
		$this->mdldata->select($params);
			
		$data['categories'] = $this->mdldata->_mRecords;
		
		$uri = $this->uri->segment(4);
		
		$params['querystring'] = "SELECT hr_skill_catalog.skill_id, hr_skill_catalog.skill, hr_job_categories.cat_name, hr_job_categories.cat_id FROM `hr_skill_catalog` left join hr_job_categories on hr_skill_catalog.job_type_id=hr_job_categories.cat_id where hr_skill_catalog.active='1' and hr_skill_catalog.skill_id='". $uri . "'";
		$this->mdldata->select($params);
		
		$data['skill_info'] = $this->mdldata->_mRecords;
				
		$data['main_content'] = 'admin_view/edit_skill_view';
		$this->load->view('admin_view/includes/template', $data);
	}
	
	// edit skill validate
	public function edit_skill_validate() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			$this->form_validation->set_rules('skill_name', 'SKill Name', 'required');
			$this->form_validation->set_rules('skill_category', 'Job Category', 'required');
			
			if ($this->form_validation->run() == FALSE) {
			
				$this->add_skill_validate();
			
			} else {
				
				$params['fields'] = array(
						'skill' => $this->input->post('skill_name'),
						'job_type_id' => $this->input->post('skill_category'),
						'active' => 1
				);
				
				$params['table'] = array('name' => 'hr_skill_catalog', 'criteria' => 'skill_id', 'criteria_value' => $this->input->post('skill_id'));
				
				if($this->mdldata->update($params))  {
					echo "TRUE";
				} else {
					echo 'FALSE';
				}
			
			}
			
		} else {
			redirect('administrator/login');
		}
		
	}
	
	// delete
	public function delete_skill() {
		
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			$params['fields'] = array(
					'skill' => $this->input->post('skill_name'),
					'job_type_id' => $this->input->post('skill_category'),
					'active' => 0
			);
			
			$params['table'] = array('name' => 'hr_skill_catalog', 'criteria' => 'skill_id', 'criteria_value' => $this->uri->segment(4));
			
			if($this->mdldata->update($params))  {
				redirect('administrator/dashboard/skill_catalog/');
			} else {
				redirect('administrator/dashboard/skill_catalog/');
			}
			
			
		} else {
			redirect('administrator/login');
		}
	
	}
	
	
	public function send_invitation() {
		
				$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		
		
		// checking if the HR personnel is Log in
		if($this->sentinel->goFlag($params)) {
			
			$datestring = "Y-m-d g:i:s";
			$time = time();
			$currentDate = mdate($datestring, $time);
				
			$date = mysqlDate($currentDate);
			
			$job_id = $this->uri->segment(5);
			$account_id = $this->uri->segment(4);
			
			$params['fields'] = array('job_title' => '', 'job_id' => '');
			$params['table'] = array ('name' => 'hr_jobs', 'criteria_phrase' => 'job_id="' . $job_id . '"');
			
			$this->mdldata->select($params);
			
			$job_title = $this->mdldata->_mRecords;
			
			$message = "Please Apply this Job. <a href=".base_url()."a/search_jobs/jobs/" . $job_title[0]->job_id . ">".$job_title[0]->job_title."</a>";

			$this->mdldata->reset();
			$params['querystring'] = "INSERT INTO hr_notifications(message, date, account_id) VALUES('". $message ."', '". $date . "', '". $account_id ."')";
			$this->mdldata->insert($params);
			
			redirect('administrator/dashboard');
			
		} else {
			redirect('administrator/login');
		}
	}
	
	public function resume() {
		
		
		$id = $this->uri->segment(4);
		$data['job_id'] = $this->uri->segment(5);
		
		$params['table'] = array('name' => 'hr_accounts', 'criteria_phrase'=> 'account_id="'. $id . '"');
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
		
		$data['main_content'] = 'admin_view/resume_view';
		$this->load->view('admin_view/includes/template', $data);
	}
}