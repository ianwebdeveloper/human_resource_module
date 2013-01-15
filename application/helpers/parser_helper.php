<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('parseLocation')) {
	function parseLocation($value, $code = TRUE) {
		
		$CI =& get_instance();
		
		if($code){
			$str = "SELECT * FROM cn_locations WHERE loc_id=$value";
			
			$records = $CI->db->query($str)->result();
			
			foreach($records as $rec) {
				if(strtolower($rec->type) == 'country')
					return ucwords($rec->name);
				elseif(strtolower($rec->type) == 'state')
					return strtoupper($rec->name);
			}
			
		} else { 
			$str = "SELECT * FROM cn_locations WHERE name='" . $value . "'";
			//on_watch($str, true);
			$records = $CI->db->query($str)->result();
			
			
			foreach($records as $rec) {
				return $rec->loc_id;
			}
		}
	}	
}
