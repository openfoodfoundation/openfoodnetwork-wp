<?php
//[image]
function cactus_image_carousel($atts, $content){
	$id =  rand(1, 999);
	$content = preg_replace('/<br class="cactus_br".\/>/', '', $content);	
	$height = isset($atts['height']) ? $atts['height'] : '550';	
	$autoplay = isset($atts['autoplay']) ? $atts['autoplay'] : '0';
	$speed = isset($atts['speed']) ? $atts['speed'] : '4000';
	$delay_time = '';
	$delay_time = $speed;
	if($autoplay == '0'){
		$delay_time = '';
	}
	//start
	ob_start(); 
	?>
    <!--Shortcode Image Carousel-->
    <div id="image-crousel-<?php echo $id;?>" class="sc-slider-post">
        <div class="fix-width-full-row">
            <div class="cactus-silder-multi-post" data-auto-play="<?php echo $delay_time;?>" data-pagination="0" data-auto-height="<?php echo $height;?>" data-id="<?php echo $id;?>">
            	<?php echo do_shortcode(strip_tags($content)); ?>
    		</div><!--cactus-silder-multi-post-->
    	</div><!--fix-width-full-row-->
        
        <!-- Carousel Navigation Button -->
    	<div class="prev c-<?php echo $id;?>"><i class="fa fa-angle-left"></i></div>
        <div class="next c-<?php echo $id;?>"><i class="fa fa-angle-right"></i></div> 
        <!-- Carousel Navigation Button -->
        
    </div><!--sc-slider-post-->
    <!--Shortcode Image Carousel-->
    <?php
	//end
	$output=ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode( 'image_carousel', 'cactus_image_carousel' );

//[img]
function cactus_image_carousel_item($atts, $content){
	$id =  rand(1, 999);	
	$img_source = isset($atts['src']) ? $atts['src'] : '#';
	if(is_numeric($img_source)){
		$image      = wp_get_attachment_image_src($img_source, "full");
		$img_source = $image[0];
	}
	//start
	ob_start(); 
	?>
    	<!-- Is Numeric-->
		<?php if(is_numeric($img_source)){//Is Not Number?>
            <?php if($img_source != '' && $img_source != '#'){?>
                <!--Slider Item-->
                <div id="image-item-<?php echo $id;?>" class="slider-item">
                    <div class="picture-content">
                        <img src="<?php echo $img_source;?>" alt="" title="">
                    </div>                                                            
                </div>
                <!--Slider Item-->
            <?php }?>
        <?php }//Is Not Number?>
        <!-- Is Numeric-->

    	<!-- Is Not Numeric-->
		<?php if(!is_numeric($img_source)){//Is Not Numeric?>
            <?php if($img_source != '' && $img_source != '#'){?>
                <!--Slider Item-->
                <div id="image-item-<?php echo $id;?>" class="slider-item">
                    <div class="picture-content">
                        <img src="<?php echo $img_source;?>" alt="" title="">
                    </div>                                                            
                </div>
                <!--Slider Item-->
            <?php }?>
        <?php }//Is Not Numeric?>
    	<!-- Is Not Numeric-->
	<?php
	//end
	$output=ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode( 'img', 'cactus_image_carousel_item' );

//add shortcode to Visual Composer
add_action( 'after_setup_theme', 'reg_ct_image_carousel' );
function reg_ct_image_carousel(){
	if(function_exists('wpb_map')){
	vc_map( array(
			"name" => esc_html__("Theblog Image Carousel", "cactusthemes"),
			"base" => "image_carousel",
			"content_element" => true,
			"as_parent" => array('only' => 'img'),
			"icon" => "icon-image-carousel",
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Height of carousel", "cactusthemes"),
					"param_name" => "height",
					"value" => "550",
					"description" => esc_html__("Height of carousel (in pixels). Default is 550 (px)", "cactusthemes"),
					"admin_label" => true
				  ),
				array(
				 "type" => "dropdown",
				 //"holder" => "div",
				 //"class" => "",
				 "heading" => esc_html__("Enable autoplay", 'cactusthemes'),
				 "param_name" => "autoplay",
				 "value" => array(
					esc_html__('False', 'cactusthemes') => "0",
					esc_html__('True', 'cactusthemes') => "1",
				 ),
				 "description" => ''
			  ),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Speed of carousel", "cactusthemes"),
					"param_name" => "speed",
					"value" => "4000",
					"description" => esc_html__("speed of carousel animation (in milliseconds).","cactusthemes"),
				  ),
			),
			"js_view" => 'VcColumnView'
		) );
		vc_map( array(
			"name" => esc_html__("Carousel Image", "cactusthemes"),
			"base" => "img",
			"content_element" => true,
			"as_child" => array('only' => 'image_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "icon-image-carousel-img",
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
		) );
	}
	if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer')){
		class WPBakeryShortCode_image_carousel extends WPBakeryShortCodesContainer{}
		class WPBakeryShortCode_img extends WPBakeryShortCodesContainer{}
	}
}


