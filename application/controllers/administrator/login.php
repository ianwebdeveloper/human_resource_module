<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	// private variables
	private $_mUser;
	
	public function __construct() {
		parent::__construct();	
		
		$this->_mUser = null;
	
	}

	public function index() {
		
		
		$data['main_content'] = 'admin_view/log_in_view';
		$this->load->view('includes/template', $data);
		
	}
	
	public function login_validate() {
		
		$validation = $this->form_validation;
		
		// sets rules
		$validation->set_rules('email', 'Email Address', 'required');
		$validation->set_rules('pword', 'Password', 'required|min_length[5]');
		
		if($validation->run() === FALSE) {
			$this->index();
		} else {
			if($this->_isExists()) {
				$this->_setSession();
				redirect('administrator/dashboard');
			} else {
				$this->index();
			}
		}
		
	}
	
	// check the accoun in the DB
	public function _isExists() {
		
		$email = $this->input->post('email');
		$pword = md5($this->input->post('pword'));
		
		$string = "email='" . $email . "' and password='". $pword . "' and type_id='1'";
		
		$params['table'] = array(
				'name' => 'hr_accounts', 'criteria_phrase' => $string );
		
		$this->mdldata->select($params);
		
		
		if($this->mdldata->_mRowCount < 1)
			return FALSE;
		
		$this->_mUser = $this->mdldata->_mRecords;
		
		return TRUE;
	}
	
	// set session
	public function _setSession() {
		
		$currHR = array();
		
		foreach($this->_mUser as $rec ) {
			$currHR['fname'] = $rec->fname;
			$currHR['lname'] = $rec->lname;
			$currHrName = $currHR['fname'] . $currHR['lname'];
		}
		
		$params = array(
					'hr_personnel' => $this->input->post('email'),
					'hr_personnel_isLog' => TRUE,
					'hr_personnel_name' => $currHrName
				);
		
		$this->sessionbrowser->setInfo($params);
	}
	
	public function logout() {
		
		$params = array('hr_personnel', 'hr_personnel_isLog', 'hr_personnel_name');
		
		$this->sessionbrowser->destroy($params);
		
		redirect('administrator/login');
	}
}