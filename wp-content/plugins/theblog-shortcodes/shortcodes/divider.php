<?php
function cactus_create_divider($atts, $content){	
	$position = isset($atts['position']) ? $atts['position'] : '';	
	$html = 	'';
	$html .= 	'<div class="cactus-divider single '.$position.'"></div>';
	$js_fix					= '<script>
									jQuery(document).ready(function() {
										jQuery(".cactus-divider.single").each(function(index, element) {
											if(!jQuery(this).parents(".vc_row.wpb_row.vc_row-fluid").hasClass("cactus-divider-vc")) {
												jQuery(this).parents(".vc_row.wpb_row.vc_row-fluid").addClass("cactus-divider-vc");
											};
										});
									});
							   </script>';
		
	return $html.$js_fix;	
}
add_shortcode( 'divider', 'cactus_create_divider' );

add_action( 'after_setup_theme', 'reg_ct_divider' );
function reg_ct_divider(){
    if(function_exists('wpb_map')){
    wpb_map( 	array(
			   "name" => esc_html__("Theblog Divider",'cactusthemes'),
			   "base" => "divider",
			   "class" => "",
			   "icon" => "icon-divider",
			   "controls" => "full",
			   "category" => esc_html__('Content', 'cactusthemes'),
			   "params" => 	array()
			));
    }
}