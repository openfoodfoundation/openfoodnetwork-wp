<?php
function cactus_create_text_block($atts, $content){	
	$textBlockId =  rand(1, 9999);
	$id = isset($atts['id']) ? $atts['id'] : 'cactus-text-block-'.$textBlockId;
	$position = isset($atts['pos']) ? $atts['pos'] : '';	

	$html = 	'';	
	$html .= 	'<span class="blockquote font-1 '.$position.'" id="'.$textBlockId.'">		
				' . $content . '		
				</span>';
		
	return $html;	
}
add_shortcode( 'block', 'cactus_create_text_block' );

add_action( 'after_setup_theme', 'reg_ct_textblock' );
function reg_ct_textblock(){
    if(function_exists('wpb_map')){
		wpb_map( 	array(
				   "name" => esc_html__("Theblog Textblock", 'cactusthemes'),
				   "base" => "block",
				   "class" => "",
				   "icon" => "icon-textblock",
				   "controls" => "full",
				   "category" => esc_html__('Content', 'cactusthemes'),
				   "params" => 	array(
									array(
									"type" => "dropdown",
									"heading" => esc_html__("Position", "cactusthemes"),
									"param_name" => "pos",									
									"admin_label" => "",
									"value" => array(
										esc_html__('Center', 'cactusthemes') => '',
										esc_html__('Left', 'cactusthemes') => 'left',
										esc_html__('Right', 'cactusthemes') => 'right',
									),
									"description" => "",
								  ),
								  array(
									"type" => "textfield",
									"heading" => esc_html__("Content", "cactusthemes"),
									"param_name" => false,
									"param_name" => "content",
									"value" => "",
									"description" => "",
								  ),
								  
								)
				)
		);
    }
}