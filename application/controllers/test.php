<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	// construtor
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('age_calculator');
	}

	public function index() {
		
		echo "testing sandbox";
	
		$date = "10/30/1989";
		
		$myAge = getAge($date);
		
		call_debug($myAge);
	 
	}
}