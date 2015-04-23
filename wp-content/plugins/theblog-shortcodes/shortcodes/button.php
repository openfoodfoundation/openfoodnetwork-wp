<?php
function cactus_create_button($atts, $content){	
	$btnID =  rand(1, 9990);
	$id = isset($atts['id']) ? $atts['id'] : 'cactus-btn-'.$btnID;
	$size = isset($atts['size']) ? $atts['size'] : '';	
	$href = isset($atts['href']) ? $atts['href'] : '';
	$icon = isset($atts['icon']) ? $atts['icon'] : '';	
	$bg_color = isset($atts['bg_color']) ? $atts['bg_color'] : '';
	$html = '';
	$html .= '<a href="'.esc_url($href).'" title="' . $content . '"'. ' id="'.$id.'" class="btn btn-default font-1 btn-'.$size.'"' .">" .$content.'</a>';
	if(isset($bg_color) && $bg_color!=''){
		$html.=		'<style type="text/css" scoped>';
		$html.=			'#'.$id.' {background-color:'.$bg_color.';}';
		$html.=			'#'.$id.':hover {background-color:rgba(45,49,52,1.0);}';
		$html.=		'</style>';
	};		
		
	return $html;	
}
add_shortcode( 'button', 'cactus_create_button' );

add_action( 'after_setup_theme', 'reg_ct_button' );
function reg_ct_button(){
    if(function_exists('wpb_map')){
    wpb_map( 	array(
			   "name" => esc_html__("Theblog Button",'cactusthemes'),
			   "base" => "button",
			   "class" => "",
			   "icon" => "icon-button",
			   "controls" => "full",
			   "category" => esc_html__('Content', 'cactusthemes'),
			   "params" => 	array(
								array(
								"type" => "textfield",
								"heading" => esc_html__("Button Text", "cactusthemes"),
								"param_name" => "content",
								"value" => "",
								"description" => "",
							  ),
							  array(
								"type" => "textfield",
								"heading" => esc_html__("Button Link", "cactusthemes"),
								"param_name" => "link",
								"value" => "#",
								"description" => "",
							  ),
							  array(
								 "type" => "dropdown",
								 "holder" => "div",
								 "class" => "",
								 "heading" => esc_html__("Button Size", "cactusthemes"),
								 "param_name" => "size",
								 "value" => array(
											esc_html__('Small', 'cactusthemes') => 'small',
											esc_html__('Large', 'cactusthemes') => 'large',
											),
								 "description" => "",
							  ),
							  array(
								 "type" => "colorpicker",
								 "holder" => "div",
								 "class" => "",
								 "heading" => esc_html__("Button Color", 'cactusthemes'),
								 "param_name" => "bg_color",
								 "value" => '',
								 "description" => '',
							  )
							)
			));
    }
}