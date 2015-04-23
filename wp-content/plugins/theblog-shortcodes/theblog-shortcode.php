<?php
/*
Plugin Name: Theblog - Shortcodes
Plugin URI: http://www.cactusthemes.com/
Description: Provide shortcodes for TheBlog - Multi Concept Blog & Portfolio theme
Version: 1.0
Author: CactusThemes
Author URI: http://www.cactusthemes.com/
License: Commercial
*/

// check version


if ( ! defined( 'CT_SHORTCODE_BASE_FILE' ) )
    define( 'CT_SHORTCODE_BASE_FILE', __FILE__ );
if ( ! defined( 'CT_SHORTCODE_BASE_DIR' ) )
    define( 'CT_SHORTCODE_BASE_DIR', dirname( CT_SHORTCODE_BASE_FILE ) );
if ( ! defined( 'CT_SHORTCODE_PLUGIN_URL' ) )
    define( 'CT_SHORTCODE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/* ================================================================
 *
 *
 * Class to register shortcode with TinyMCE editor
 *
 * Add to button to tinyMCE editor
 *
 */
class CactusThemeShortcodes{

	function __construct()
	{
		add_action('init',array(&$this, 'init'));
	}

	function init(){
		if(is_admin()){
			// CSS for button styling
			wp_enqueue_style("ct_shortcode_admin_style", CT_SHORTCODE_PLUGIN_URL . '/shortcodes/css/style-admin.css');
		}
		else
		{
			wp_enqueue_style("ct_shortcode_style", CT_SHORTCODE_PLUGIN_URL . '/shortcodes/css/shortcode.css');
		}


		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
	    	return;
		}

		if ( get_user_option('rich_editing') == 'true' ) {
			add_filter( 'mce_external_plugins', array(&$this, 'regplugins'));
			add_filter( 'mce_buttons_3', array(&$this, 'regbtns') );

			// remove a button. Used to remove a button created by another plugin
			remove_filter('mce_buttons_3', array(&$this, 'remobtns'));
		}
	}

	function remobtns($buttons){
		// add a button to remove
		// array_push($buttons, 'ct_shortcode_collapse');
		return $buttons;
	}

	function regbtns($buttons)
	{
		array_push($buttons, 'cactus_shortcode_button');
		array_push($buttons, 'cactus_dropcap');
		array_push($buttons, 'cactus_tooltip');
		array_push($buttons, 'cactus_button');
		array_push($buttons, 'cactus_alert');
		array_push($buttons, 'cactus_row_col');
		array_push($buttons, 'cactus_compare_table');
		array_push($buttons, 'cactus_image_carousel');
		array_push($buttons, 'cactus_text_block');
		array_push($buttons, 'cactus_image_column');
		array_push($buttons, 'cactus_divider');
		array_push($buttons, 'cactus_iconbox');
		return $buttons;
	}

	function regplugins($plgs)
	{
		$plgs['cactus_shortcode_button'] 	= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/shortcode-button.js';
		$plgs['cactus_dropcap'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/dropcap.js';
		$plgs['cactus_dropcap'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/dropcap.js';
		$plgs['cactus_tooltip'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/tooltip.js';
		$plgs['cactus_button'] 				= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/button.js';
		$plgs['cactus_alert'] 				= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/alert.js';
		$plgs['cactus_row_col'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/row-col.js';
		$plgs['cactus_compare_table'] 		= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/compare-table.js';
		$plgs['cactus_image_carousel'] 		= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/image-carousel.js';
		$plgs['cactus_text_block'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/text-block.js';
		$plgs['cactus_image_column'] 		= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/image-column.js';
		$plgs['cactus_divider'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/divider.js';
		$plgs['cactus_iconbox'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/icon-box.js';
		return $plgs;
	}
}

$ctshortcode = new CactusThemeShortcodes();
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); //for check plugin status
// Register element with visual composer and do shortcode

include('shortcodes/dropcap.php');
include('shortcodes/tooltip.php');
include('shortcodes/button.php');
include('shortcodes/alert.php');
include('shortcodes/row-col.php');
include('shortcodes/compare-table.php');
include('shortcodes/image-carousel.php');
include('shortcodes/text-block.php');
include('shortcodes/image-column.php');
include('shortcodes/divider.php');
include('shortcodes/icon-box.php');
include('shortcodes/gallery.php');
include('shortcodes/google-adsense-responsive.php');

//function
if(!function_exists('hex2rgb')){
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