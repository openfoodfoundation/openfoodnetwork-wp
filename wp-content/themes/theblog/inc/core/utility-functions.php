<?php
/* 
 * Utility functions 
 * 
 * @package cactus
 * 
 */

if(!function_exists('get_current_url')){
	/* Get current page URL */
	function get_current_url() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}

if(!function_exists('hex2rgb')){
	/* Convert Hexa to RGB */
	function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
}

if(!function_exists('rgb2hexa')){
	/* Convert RGB to HEXA
	 *
	 * return hexa color without '#' at beginning
	 * $rgb: array of RGB values
	 */
	function rgb2hexa($rgb) {
	   if(count($rgb) == 3) {
			if($rgb[0] < 10) $hex1 = '0'.$rgb[0];
			else $hex1 = dechex($rgb[0]);
			if($rgb[1] < 10) $hex2 = '0'.$rgb[1];
			else $hex2 = dechex($rgb[1]);
			if($rgb[2] < 10) $hex3 = '0'.$rgb[2];
			else $hex3 = dechex($rgb[2]);
		
		    return $hex1 . $hex2 . $hex3;
		}
		 
		return '000';
	}
}

if(!function_exists('get_gradientized_color')){
	/* 
	 * generate gradient color from a source color
	 *
	 * @return: gradient color in hexa, without '#'
	 * @params:
	 *		$basic_hexa: basic color, in hexa value
	 * 		$step_hexa: difference between 2 colors, in rgb values (array)
	 */
	function get_gradientized_color($basic_hexa,$step_rgb){
		$basic_rbg = hex2rgb($basic_hexa);
		$r = $basic_rbg[0] - $step_rgb[0];
		if($r < 0) $r = 0;
		$g = $basic_rbg[1] - $step_rgb[1];
		if($g < 0) $g = 0;
		$b = $basic_rbg[2] - $step_rgb[2];
		if($b < 0) $b = 0;
		
		return rgb2hexa(array($r,$g,$b));
	}
}

/* Add opacity to a Hexa color */
if(!function_exists('hex2rgba')){
	function hex2rgba($hex,$opacity) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $opacity = $opacity/100;
	   $rgba = array($r, $g, $b, $opacity);
	   return implode(",", $rgba); // returns the rgb values separated by commas
	}
}

/*
 * Return formatted string of a number
 *
 */
if(!function_exists('get_formatted_string_number')) {
	function get_formatted_string_number($n, $decimals = 2, $suffix = '') {
		if(!$suffix)
			$suffix = 'K,M,B';
		$suffix = explode(',', $suffix);
	
		if ($n < 1000) { // any number less than a Thousand
			$shorted = number_format($n);
		} elseif ($n < 1000000) { // any number less than a million
			$shorted = number_format($n/1000, $decimals).$suffix[0];
		} elseif ($n < 1000000000) { // any number less than a billion
			$shorted = number_format($n/1000000, $decimals).$suffix[1];
		} else { // at least a billion
			$shorted = number_format($n/1000000000, $decimals).$suffix[2];
		}
	
		return $shorted;
	}
}

/* Check if a string ($haystack) starts with another string ($needle) */
if(!function_exists('startsWith')){
	function startsWith($haystack, $needle)
	{
		return !strncmp($haystack, $needle, strlen($needle));
	}
}

/* 
 * Get Google Font name from a full family_name
 *
 * @family_name			get from google fonts. For example: Playfair+Display:900 or http://fonts.googleapis.com/css?family=Roboto:400,500,500italic
 * @out_put				for example: "Playfair Display"
 */
if(!function_exists('get_google_font_name')){
	function get_google_font_name($family_name){
		$name = $family_name;
		if(startsWith($family_name, 'http') || startsWith($family_name, '//') ){
			// $family_name is a full link, so first, we need to cut off the link
			$idx = strpos($name,'=');
			if($idx > -1){
				$name = substr($name, $idx);
			}
		}
		$idx = strpos($name,':');
		if($idx > -1){
			$name = substr($name, 0, $idx);
			$name = str_replace('+',' ', $name);
		}
		return $name;
	}
}

function remove_google_font_subset($font_family){
	$name = $font_family;
	$vals = explode('&',$font_family);
	if(count($vals) > 1) return $vals[0];
	else return $vals[0];
}

function get_google_font_subset($font_family){
	$vals = explode('&',$font_family);
	if(count($vals) > 1) return $vals[1];
	else return '';
}