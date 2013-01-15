<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_jobs extends CI_Controller {
	
	// construtor
	public function __construct() {
		parent::__construct();
		
	}
	
	// default page
	public function index() {
		
// get the session variables
		$params = array('app_username', 'app_username_isLog', 'app_fullname', 'app_username_id');
		$this->sessionbrowser->getInfo($params);
		$data['currUser'] = $this->sessionbrowser->mData;
		
		// check if the account is log in
		authUser();
		
		$params['table'] = array('name' => 'hr_jobs', 'order_by' => 'posted_date:desc');
		$this->mdldata->select($params);
		
		
		
		$row_count = $this->mdldata->_mRowCount;
		
		$config['base_url'] = base_url() . 'a/search_jobs/index/';
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
		
		$params['querystring'] = 'select * from hr_jobs order by posted_date DESC LIMIT 5 OFFSET ' . $uri  . '';
		$this->mdldata->select($params);
		
		$data['records'] = $this->mdldata->_mRecords;
		
		$data['pagination_links'] = $this->pagination->create_links();

		$data['main_content'] = 'client_side_view/search/search_jobs_view';
		$this->load->view('client_side_view/includes/template', $data);	
	}
	
	public function jobs() {
		

		
		// get the session variables
		$params = array('app_username', 'app_username_isLog', 'app_fullname', 'app_username_id');
		$this->sessionbrowser->getInfo($params);
		$data['currUser'] = $this->sessionbrowser->mData;
		
		// check if the account is log in
		authUser();
		
		// get the job ID in the url
		$job_id = $this->uri->segment(4);
		$account_id = $data['currUser']['app_username_id'];
		
		$params['table'] = array('name' => 'hr_job_applicant', 'criteria_phrase' => 'job_id="'. $job_id . '" and account_id="'. $account_id . '"');
		$this->mdldata->select($params);
		
		if($this->mdldata->_mRowCount < 1) {
		
		$this->mdldata->reset();
 		$params['table'] = array('name' => 'hr_jobs', 'criteria_phrase' => 'job_id="' . $job_id . '"');
		$this->mdldata->select($params);
		$data['record'] = $this->mdldata->_mRecords;
			
		$this->mdldata->reset();
		$params['querystring'] = 'SELECT hr_job_applicant.hired, hr_job_applicant.applied_date, hr_accounts.fname, hr_accounts.lname, hr_accounts.account_id FROM `hr_job_applicant` left join hr_accounts on hr_job_applicant.account_id=hr_accounts.account_id where job_id="'. $job_id . '"';
		$this->mdldata->select($params);
			
		$data['applicants'] = $this->mdldata->_mRecords;
		
		$data['main_content'] = 'client_side_view/jobs/job_view';
		$this->load->view('client_side_view/includes/template', $data);
		
		} else {
				
		$this->mdldata->reset();
 		$params['table'] = array('name' => 'hr_jobs', 'criteria_phrase' => 'job_id="' . $job_id . '"');
		$this->mdldata->select($params);
		$data['record'] = $this->mdldata->_mRecords;
			
		$this->mdldata->reset();
		$params['querystring'] = 'SELECT hr_job_applicant.hired, hr_job_applicant.applied_date, hr_accounts.fname, hr_accounts.lname, hr_accounts.account_id FROM `hr_job_applicant` left join hr_accounts on hr_job_applicant.account_id=hr_accounts.account_id where job_id="'. $job_id . '"';
		$this->mdldata->select($params);
			
		$data['applicants'] = $this->mdldata->_mRecords;
		$data['applied'] = 1;
		
		$this->mdldata->reset();
		$params['querystring'] = 'SELECT * FROM hr_job_applicant WHERE ' . 'job_id="' . $job_id . '" and hired="1"';
		$this->mdldata->select($params);
		$data['hired'] = $this->mdldata->_mRowCount;
		
		$data['main_content'] = 'client_side_view/jobs/job_view';
		$this->load->view('client_side_view/includes/template', $data);
		}
		
	}
	
}