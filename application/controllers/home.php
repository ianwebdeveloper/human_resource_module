<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	private	$_mUser;
	
	// construtor
	public function __construct() {
		parent::__construct();
		
		$this->_mUser = null;
		
	}
	
	// default page
	public function index() {
		
	 
	$data['main_content'] = 'client_side_view/homepage_view';
	$this->load->view('includes/template', $data);	
	}
	
	// validate log in data
	public function login_validate() {
		
		$data = array(
				'username' => $this->input->post('email'),
				'pword' => md5($this->input->post('pword'))
				);

		$params['table'] = array('name' => 'hr_accounts', 'criteria_phrase' => 'email="' . $this->input->post('email') . '" and password="' . md5($this->input->post('pword')) . '" and type_id="2"');
		$this->mdldata->select($params);
		
		$this->_mUser = $this->mdldata->_mRecords;
		
		$result = $this->mdldata->_mRowCount;
		
		if($result > 0) {
			
			$this->Exist();
			
			redirect('a/search_jobs');
			
		} else {
			
			$this->index();
		}
	}
	
	// checking if account is exist
	public function Exist() {
		

			$curUser = array();
		
			foreach($this->_mUser as $user):
			
				$curUser['fname'] = $user->fname;
				$curUser['lname'] = $user->lname;
				$currUser['account_id'] = $user->account_id;
				
			endforeach;
		
			$params = array(
					'app_username' => $this->input->post('username'),
					'app_username_isLog' => TRUE,
					'app_fullname' => $curUser['fname'] . ' ' . $curUser['lname'],
					'app_username_id' => $currUser['account_id']
			);
			
			$this->sessionbrowser->setInfo($params); // returns TRUE if successful, otherwise FALSE
			
	}
	
	
	public function logout() {
		
		$params = array('app_username', 'app_username_isLog', 'app_fullname', 'app_username_id');
		
		$this->sessionbrowser->destroy($params);
		
		redirect('home');
	}
	
	public function registration() {
		
		
		$params['table'] = array('name' => 'hr_job_categories');
		$this->mdldata->select($params);
		
		$data['job_categories'] = $this->mdldata->_mRecords;
		
		$data['main_content'] = 'client_side_view/registration/registration_view';
		$this->load->view('includes/template', $data);
	}
	
	public function register_validate() {
		
		
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('mname', 'Middle Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
	
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('address', 'Currect Address', 'required');
		$this->form_validation->set_rules('profession', 'Profession', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required');
		$this->form_validation->set_rules('pword', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->registration();
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
			
			$params['table'] = array('name'=> 'hr_accounts');
			$this->mdldata->SQLText(TRUE);
			$this->mdldata->insert($params);
			$insertAccount = $this->mdldata->buildQueryString();
			
			$params['transact'] = array(
					$insertAccount,
					"INSERT INTO hr_resume(account_id) VALUES(LAST_INSERT_ID())"
			);
			
			if($this->mdldata->executeTransact($params)) {
				
				$data['main_content'] = 'client_side_view/confirmation_view/registration_confirmation_view';
				$this->load->view('includes/template', $data);
				
			} else {
				echo "yess";
				$this->registration();
			}
			
		}
		
	}
}
