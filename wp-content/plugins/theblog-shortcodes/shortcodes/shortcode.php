<?php
require_once locate_template('/inc/shortcodes/dropcap.php');
require_once locate_template('/inc/shortcodes/tooltip.php');
require_once locate_template('/inc/shortcodes/button.php');
require_once locate_template('/inc/shortcodes/alert.php');
require_once locate_template('/inc/shortcodes/row-col.php');
require_once locate_template('/inc/shortcodes/compare-table.php');
require_once locate_template('/inc/shortcodes/image-carousel.php');
require_once locate_template('/inc/shortcodes/text-block.php');
require_once locate_template('/inc/shortcodes/image-column.php');
require_once locate_template('/inc/shortcodes/divider.php');
require_once locate_template('/inc/shortcodes/icon-box.php');
require_once locate_template('/inc/shortcodes/gallery.php');

if ( get_user_option('rich_editing') == 'true' ) {
	add_filter( 'mce_external_plugins', 'regplugins');
	add_filter( 'mce_buttons_3', 'regbtns' );
}
function regbtns($buttons){
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
	
function regplugins($plgs){
	$plgs['cactus_shortcode_button'] 	= get_template_directory_uri().'/inc/shortcodes/js/shortcode-button.js';
	$plgs['cactus_dropcap'] 			= get_template_directory_uri().'/inc/shortcodes/js/dropcap.js';
	$plgs['cactus_dropcap'] 			= get_template_directory_uri().'/inc/shortcodes/js/dropcap.js';
	$plgs['cactus_tooltip'] 			= get_template_directory_uri().'/inc/shortcodes/js/tooltip.js';
	$plgs['cactus_button'] 				= get_template_directory_uri().'/inc/shortcodes/js/button.js';
	$plgs['cactus_alert'] 				= get_template_directory_uri().'/inc/shortcodes/js/alert.js';
	$plgs['cactus_row_col'] 			= get_template_directory_uri().'/inc/shortcodes/js/row-col.js';
	$plgs['cactus_compare_table'] 		= get_template_directory_uri().'/inc/shortcodes/js/compare-table.js';
	$plgs['cactus_image_carousel'] 		= get_template_directory_uri().'/inc/shortcodes/js/image-carousel.js';
	$plgs['cactus_text_block'] 			= get_template_directory_uri().'/inc/shortcodes/js/text-block.js';
	$plgs['cactus_image_column'] 		= get_template_directory_uri().'/inc/shortcodes/js/image-column.js';
	$plgs['cactus_divider'] 			= get_template_directory_uri().'/inc/shortcodes/js/divider.js';
	$plgs['cactus_iconbox'] 			= get_template_directory_uri().'/inc/shortcodes/js/icon-box.js';
	return $plgs;
}