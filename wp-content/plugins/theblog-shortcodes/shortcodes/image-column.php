<?php
function cactus_create_image_column($atts, $content){	
	$content = preg_replace('/<br class="cactus_br".\/>/', '', $content);
	$imageClassName = isset($atts['class_img_column']) ? $atts['class_img_column'] : '';

	$html ='';	
	$html .= 	'<div class="sc-images-list ' . $imageClassName . '">
					<div class="img-content">
						'.do_shortcode(strip_tags($content)).'
					</div>
				</div>';
		
	return $html;	
}

function cactus_create_image_column_imgItem($atts, $content){
	$image_item = isset($atts['src']) ? $atts['src'] : '';
	$size_image = '';
	global $_is_retina_;
	if(isset($_is_retina_)&&$_is_retina_){
			$size_image = 'full';
	}else{
			$size_image = 'thumb_640x9999';
	}
	if(is_numeric($image_item)){
		$image      = wp_get_attachment_image_src($image_item, $size_image);
		$image_item = $image[0];
	}
	
	$content = preg_replace('/<br class="cactus_br".\/>/', '', $content);
	$html ='';	
	$html .= 	'<div class="img-item">	
					<a href="#" title="">				
						<img src="'.$image_item.'" alt="" title="">		
						<div class="thumb-overlay"></div>
                    </a>				
				</div> ';
	return $html;				
}

add_shortcode( 'image_column', 'cactus_create_image_column' );
add_shortcode( 'img_column', 'cactus_create_image_column_imgItem' );

add_action( 'after_setup_theme', 'reg_ct_image_column' );
function reg_ct_image_column(){
    if(function_exists('wpb_map')){
		vc_map( 	array(
				   "name" => esc_html__("Theblog Image Column", 'cactusthemes'),
				   "base" => "image_column",
				   "content_element" => true,
				   "as_parent" => array('only' => 'img_column'),
				   "icon" => "icon-image-column",
				   "category" => esc_html__('Content', 'cactusthemes'),
				   "params" => 	array(
				   					array(
										"type" => "textfield",
										"heading" => esc_html__("Class Name", "cactusthemes"),
										"param_name" => "class_img_column",
										"value" => "",
										"description" => "",
									  ),
				   ),
				   "js_view" => 'VcColumnView'
				)
		);
		vc_map( 	array(
					"name" => esc_html__("Column Image", "cactusthemes"),
					"base" => "img_column",
					"content_element" => true,
					"as_child" => array('only' => 'image_column'), // Use only|except attributes to limit parent (separate multiple values with comma)
					"icon" => "icon-img-column",
					"params" => array(
									array(
										"type" => "attach_image",
										"heading" => esc_html__("Upload/Add Image", "cactusthemes"),
										"param_name" => "src",
										"value" => "",
										"description" => "",
									  ),
					),
					 "js_view" => 'VcColumnView'
				)
		);
    }
	if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer')){
		class WPBakeryShortCode_image_column extends WPBakeryShortCodesContainer{}
		class WPBakeryShortCode_img_column extends WPBakeryShortCodesContainer{}
	}

}

