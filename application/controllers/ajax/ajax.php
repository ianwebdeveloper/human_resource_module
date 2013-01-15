<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	

	
	// construtor
	public function __construct() {
		parent::__construct();
		
	}
	
	// default page
	public function search_job() {
		
		$job_title = $this->input->post('job_title');
		
		$params['querystring'] = 'SELECT hr_jobs.job_id, hr_jobs.job_title, hr_jobs.posted_date, hr_jobs.status, hr_accounts.fname, hr_accounts.lname FROM `hr_jobs` left join hr_accounts on hr_jobs.account_id=hr_accounts.account_id where hr_jobs.active="1" and hr_jobs.job_title LIKE "%' . $job_title . '%" ORDER BY hr_jobs.posted_date DESC';
		$this->mdldata->select($params);
			
		$data['records'] = $this->mdldata->_mRecords;
	
		$this->load->view('ajax/search_result_view', $data); 
	}
	
	public function search() {
	
		$job_title = $this->input->post('job_title');
		
		$params['querystring'] = 'SELECT hr_jobs.job_description,hr_jobs.number_of_employee, hr_jobs.job_id, hr_jobs.job_title, hr_jobs.posted_date, hr_jobs.status, hr_accounts.fname, hr_accounts.lname FROM `hr_jobs` left join hr_accounts on hr_jobs.account_id=hr_accounts.account_id where hr_jobs.active="1" and hr_jobs.job_title LIKE "%' . $job_title . '%" ORDER BY hr_jobs.posted_date DESC';
		$this->mdldata->select($params);
			
		$data['records'] = $this->mdldata->_mRecords;
		
		//call_debug($data);
		
		$this->load->view('ajax/search_result', $data); 
	
	
	}
	
	// ajax calculate age from birth date
	public function calculate_age() {
		
		$day = $this->input->post('day');
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		
		$date = $month . "/" . $day . "/" . $year;
		
		$myAge = getAge($date);
		
		echo $myAge;
	}
	
	// autocomplete search job
	public function ajax_search_job() {
		
		$title = $this->input->get('title');
		
		$params['table'] = array('name' => 'hr_jobs', 'criteria_phrase' => 'job_title REGEXP "^' . $title . '"');
		$this->mdldata->select($params);
		$data = $this->mdldata->_mRecords;
		
		// callback
		$item = $this->input->get('callback') . "(" . json_encode($data) . ")";
		echo $item;
		
	}
	
	

	public function search_profession() {
	
		$skill_name = $this->input->post('search_skill');
	
		$params['table'] = array('name' => 'hr_skill_catalog', 'criteria_phrase' => 'skill REGEXP "^' . $skill_name . '"');
		$this->mdldata->select($params);
		$data = $this->mdldata->_mRecords;
	
				// callback
		$item = $this->input->get('callback') . "(" . json_encode($data) . ")";
		echo $item;
	}
	
	public function search_applicant_by_profession() {
		
		$skill_name = $this->input->post('skill_name');
		

		
		$params['querystring'] = "SELECT * from hr_skill_catalog where skill='" . $skill_name . "'";
		$this->mdldata->select($params);
		
		$data['skill_info'] = $this->mdldata->_mRecords;
		
		foreach($data['skill_info'] as $rec) {
			$skill_id = $rec->skill_id;
			
			$this->mdldata->reset();
			$params['querystring'] = "SELECT hr_accounts.account_id, hr_accounts.fname, hr_accounts.lname, hr_skill_catalog.skill, hr_job_categories.cat_name, hr_job_applicant.hired, hr_job_applicant.fired, hr_job_applicant.reject, hr_job_applicant.job_id from hr_accounts left join hr_skill_catalog on hr_accounts.profession=hr_skill_catalog.skill_id left join hr_job_categories on hr_skill_catalog.job_type_id= hr_job_categories.cat_id left join hr_job_applicant on hr_accounts.account_id=hr_job_applicant.account_id where hr_accounts.profession='" . $skill_id . "'";
			
			$this->mdldata->select($params);
			
			if($this->mdldata->_mRowCount < 1) {
				
				echo '<p>zero result</p>';
				
			} else {
				
				
				$data['all_applicant'] = $this->mdldata->_mRecords;

				$this->load->view('ajax/serps_view', $data);
			}
				
			
 			

		}
		
		
	}
	
	
	
}