<?php
function cactus_create_iconbox($atts, $content){
	$main_color = ot_get_option('main_color', '#25c3d8');	
	$iconboxID =  'rnd-icon-box-'.rand(1, 9999);	
	$icon = isset($atts['icon']) ? $atts['icon'] : '';	
	$title = isset($atts['title']) ? $atts['title'] : '';	
	$color = isset($atts['icon_color']) ? $atts['icon_color'] : $main_color;
	$titleHoverColor = isset($atts['title_hover_color']) ? $atts['title_hover_color'] : $main_color;
	$url = isset($atts['url']) ? $atts['url'] : '#';	
	
	$html = 	'';
	$html .= 	'<div class="cactus-iconbox col-md-4" id="'.$iconboxID.'">
					<div class="icon"><a class="icon-url" href="'.$url.'"><i class="fa '.$icon.'"></i></a></div>
					<div class="title font-1"><a class="icon-title-url title font-1" href="'.$url.'">'.$title.'</a></div>
					<div class="content">'.$content.'</div>';
	if( (isset($color) && $color!='') || (isset($titleHoverColor) && $titleHoverColor!='') ){
		$html.=		'<style type="text/css" scoped >';
		$html.=		'#'.$iconboxID.' .icon-title-url {text-decoration:initial;}';
		if( isset($color) && $color!=''){
			$html.=			'#'.$iconboxID.' .icon .icon-url {color:'.$color.';}';
		};
		if( isset($titleHoverColor) && $titleHoverColor!=''){
			$html.=			'#'.$iconboxID.':hover .icon-title-url{color:'.$titleHoverColor.';}';
		};
		$html.=		'</style>';
	};				
	$html .=	'</div>';
	
		
	return $html;	
}
add_shortcode( 'icon-box', 'cactus_create_iconbox' );

add_action( 'after_setup_theme', 'reg_ct_iconbox' );
function reg_ct_iconbox(){
    if(function_exists('wpb_map')){
    wpb_map( 	array(
			   "name" => esc_html__("Theblog Iconbox",'cactusthemes'),
			   "base" => "icon-box",
			   "class" => "",
			   "icon" => "icon-iconbox",
			   "controls" => "full",
			   "category" => esc_html__('Content', 'cactusthemes'),
			   "params" => 	array(								
							  	array(
									"type" => "textfield",
									"heading" => esc_html__("Icon", "cactusthemes"),
									"param_name" => false,
									"param_name" => "icon",
									"value" => "",
									"description" => __('Exp: fa-anchor. Find more icons in <a href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome</a>', 'cactusthemes' ),
								),	
								array(
									"type" => "colorpicker",
					 				"holder" => "div",
									"heading" => esc_html__("Color", "cactusthemes"),
									"param_name" => false,
									"param_name" => "icon_color",
									"value" => "",
									"description" => "",
								),	
								array(
									"type" => "textfield",
									"heading" => esc_html__("Title", "cactusthemes"),
									"param_name" => false,
									"param_name" => "title",
									"value" => "",
									"description" => "",
								),
								array(
									"type" => "colorpicker",
					 				"holder" => "div",
									"heading" => esc_html__("Title Hover Color", "cactusthemes"),
									"param_name" => false,
									"param_name" => "title_hover_color",
									"value" => "",
									"description" => "",
								),
								array(
									"type" => "textfield",
									"heading" => esc_html__("Title Link", "cactusthemes"),
									"param_name" => false,
									"param_name" => "url",
									"value" => "",
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
			));
    }
}