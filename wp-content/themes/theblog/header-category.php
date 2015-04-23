<?php
    //wp_reset_query();
    $category = get_category( get_query_var( 'cat' ) );
	$cat_id = $category->cat_ID;
	$archive_background = '';
	$archive_background = ot_get_option('archive_background');
	$archive_background = isset($archive_background['background-image']) ? $archive_background['background-image'] : '';
	if(function_exists('z_taxonomy_image_url') &&  z_taxonomy_image_url() != ''){ $archive_background = z_taxonomy_image_url();}
	$archive_background_height = '';
	$archive_background_height = ot_get_option('archive_background_height', '585');
	$cat_header_background_height = get_option('cat_header_background_height'.$cat_id);
	if($cat_header_background_height != ''){
		$archive_background_height = $cat_header_background_height;
	}
?>
<div class="cactus-wraper-slider-bg">

    <!--Slider V1-->
    <div class="slider cactus-slider-single background-color-2" data-auto-play="" data-pagination="0" data-transition="fade" data-full-height="0"> <!--fade, backSlide, goDown, scaleUp-->

	<?php if($archive_background != ''){?>
        <!--Slider Item-->
        <div class="slider-item is-parallax" data-bg-img="<?php echo esc_attr($archive_background) ;?>" data-div-height="<?php echo esc_attr($archive_background_height);?>px" data-background-single=""> <!-- images/slide-1.jpg -->

            <div class="thumb-overlay background-color-2"></div>

            <div class="container">
                <div class="row">

                    <div class="text-content">
                        <div class="text-2 font-3 col-md-12"><div><h1><?php echo esc_html($category->name);?></h1></div></div>
                        <div class="clearfix"></div>
                    </div>

                </div>
             </div>

             <div class="loading-img">
                 <div class="floatingCirclesG">
                     <div class="f_circleG frotateG_01"></div>
                     <div class="f_circleG frotateG_02"></div>
                     <div class="f_circleG frotateG_03"></div>
                     <div class="f_circleG frotateG_04"></div>
                     <div class="f_circleG frotateG_05"></div>
                     <div class="f_circleG frotateG_06"></div>
                     <div class="f_circleG frotateG_07"></div>
                     <div class="f_circleG frotateG_08"></div>
                 </div>
             </div>
        </div><!--Slider Item-->
	<?php } ?>
    </div>
    <!--Slider V1-->

</div>
