<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * To generate different Date format
 * @author Ian Paul F. Kionisala
 * @param array $params
 * @package application/helper
 * @version 1.0.0
 * 
 * 
 * 
 * 		SAMPLE:
 * 			{CONTROLLER}
 * 
 * 			1. Get the Current Date [ 0000-00-00 hr:min:sec ]
 *
 *				$datestring = "Y-m-d g:i:s";
 *				$time = time();
 *				$currentDate = mdate($datestring, $time);
 *
 *			2. MySQL Date Format [ 0000-00-00 ]
 *
 *				$datestring = "Y-m-d g:i:s";
 *				$time = time();
 *				$currentDate = mdate($datestring, $time);
 *
 *				$date = $mysqlDate($currentDate);
 *
 *			{VIEWS}
 *	
 *			3. Formatted Date [ Wednesday, October 03, 2012 ]
 *			
 *				formattedDate($params);
 *				
 *
 *
 */
 
 if ( ! function_exists('now'))
{
	function now()
	{
		$CI =& get_instance();

		if (strtolower($CI->config->item('time_reference')) == 'gmt')
		{
			$now = time();
			$system_time = date("w Y m, d, g:i a");  // date function
			
			if (strlen($system_time) < 10)
			{
				$system_time = time();
				log_message('error', 'The Date class could not set a proper GMT timestamp so the local time() value was used.');
			}

			return $system_time;
		}
		else
		{
			return time();
		}
	}
}

if ( ! function_exists('mdate'))
{
	function mdate($datestr = '', $time = '')
	{
		
		$timezone = "Asia/Manila";
		date_default_timezone_set($timezone);
		
		if ($datestr == '')
			return '';

		if ($time == '')
			$time = now();

		$datestr = str_replace('%\\', '', preg_replace("/(\w+) (\d+), (\d+)/i", "\\\\\\1", $datestr));
		return date($datestr, $time);
	}
}

if ( ! function_exists('getDateArr'))
{
	function getDateArr($arrDate)
	{
		

		$arrDate = preg_split('/ /', $arrDate);
		
		list($arrDate, $arrTime)= $arrDate;
		
		call_debug($arrDate);

		$arrDate = preg_split('/-/', $arrDate);
		list($year, $month, $day)= $arrDate;
		
		
		$arrDate = date("l, F d, Y ",mktime(0,0,0,$month, $day, $year));

		return $arrDate;
	}
	
}

if ( ! function_exists('formattedDate'))
{
	function formattedDate($arrDate)
	{


		$arrDate = preg_split('/-/', $arrDate);
		
		
		list($year, $month, $day)= $arrDate;

		
		$arrDate = date("D, F d, Y ",mktime(0,0,0,$month, $day, $year));
		
		return $arrDate;
	}

}

if ( ! function_exists('formattedDateMMDDYY'))
{
	function formattedDateMMDDYY($arrDate)
	{

		$arrDate = preg_split('/-/', $arrDate);


		list($year, $month, $day)= $arrDate;

		
		$arrDate = date("m/d/Y",mktime(0,0,0,$month, $day, $year));
		
		return $arrDate;
	}

}

if ( ! function_exists('getTimeArr'))
{
	function getTimeArr($arrDate)
	{

		$arrDate = preg_split('/ /', $arrDate);
		list($arrDate, $arrTime , $var)= $arrDate;

		return $arrTime . " " . $var ;
	}

}

// mysql date format
if ( ! function_exists('mysqlDate'))
{
	function mysqlDate($arrDate)
	{
			
		$arrDate = preg_split('/ /', $arrDate);
		$arrDate = $arrDate[0];
		
		$arrDate = preg_split('/\//', $arrDate);
		
		
		
		$formatDate = implode('-', $arrDate);
		
		return $formatDate;
	}

}


