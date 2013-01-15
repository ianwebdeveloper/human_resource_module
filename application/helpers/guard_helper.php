<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * Prevents unauthorized access to the restricted section of the site. And redirects to the specified url
 * @author Kenneth "digiArtist_ph" P. Vallejos
 * @param array $params
 * @package application/helper
 * @version 1.1.1
 * @sample	authUser(array( 'section' => 'login', 'sessvar' => array('advr_uname', 'advr_islog', 'advr_fullname')));
 * 
 * 		PREREQUISITE:
 * 			application/libraries
 * 				sessionbrowser.php
 * 				sentinel.php
 * 
 * 		SAMPLE:
 * 			{CONTROLLER}
 * 
 * 				authUser(array('section' => 'login', 'sessvar' => array('advr_uname', 'advr_islog', 'advr_fullname')));
 * 					// OR
 * 				authUser(array('section' => 'login'));
 * 					// OR
 * 				authUser(array('sessvar' => array('advr_uname', 'advr_islog', 'advr_fullname')));
 * 					// OR
 * 				authUser();
 *
 */
 function authUser($params = array()) {
 	$CI =& get_instance();
	
 	// preps some data of the array
 	if(empty($params)) {
 		$params = array('section' => '', 'sessvar' => array());
 	} else {
 		if(!array_key_exists('section', $params))
 			$params = array_merge($params, array('section' => ''));
 		
 		if(!array_key_exists('sessvar', $params))
 			$params = array_merge($params, array('sessvar' => array()));
 	}
 	
 	// temp array
 	$sessionVar = (array)$params['sessvar'];
 	$sectionURL = $params['section'];
 	
 	// sentinel. default values
 	// PLEASE PROVIDE YOUR DEFAULT SESSION VARIALBE/S  & PATH HERE...
 	// e.g: $params = array('my_sessionvar_1', 'my_sessionvar_2', 'my_sessionvar_N');
 	//             OR
 	//      $params = array();
 	// e.g: $path = 'MY_PATH_OWN_HERE';
 	$params = array('app_username', 'app_username_isLog');
 	$path = 'home';
	
 	// merges and filters the unique values of the array
 	$sessionVar = array_merge($params, $sessionVar);
 	$sessionVar = array_unique($sessionVar);
 	
 	//call_debug($sessionVar);
 	
 	$path = ($sectionURL == "") ? $path : $sectionURL;
 	
 	if( ! $CI->sentinel->goFlag($params, FALSE))
 		redirect($path);
  	
 }
 
 
 ?>