<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends CI_Controller {
	
	// construtor
	public function __construct() {
		parent::__construct();
		
	}
	
	// default page
	public function apply() {
		
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
			
			
			
			$datestring = "Y-m-d g:i:s";
			$time = time();
			$currentDate = mdate($datestring, $time);
			
			$date = mysqlDate($currentDate);
			
			$params['fields'] = array(
					'applied_date' => $date,
					'job_id' => $job_id,
					'account_id' => $account_id
			);
			$params['table'] = array('name' => 'hr_job_applicant');
			
			if($this->mdldata->insert($params)) {
					
				$data['job_id'] = $job_id;
				$data['main_content'] = 'client_side_view/confirmation_view/apply_confirmation_view';
				$this->load->view('client_side_view/includes/template', $data);
					
			} else {
					
				redirect('a/search_jobs/jobs/' . $job_id  . '');
					
			}
			
		} else {
			
			redirect('a/search_jobs/jobs/' . $job_id  . '');
		}
		
		
	}
	
}