<?php
    //wp_reset_query();
    $author = get_userdata( get_query_var('author') );
	$position   = get_the_author_meta('positon',$author->ID);
	$author_header_background = get_the_author_meta('author_header_background',$author->ID);
	$author_background_height = get_the_author_meta('author_background_height',$author->ID);
	$archive_background = '';
	$archive_background = ot_get_option('archive_background');
	$archive_background = isset($archive_background['background-image']) ? $archive_background['background-image'] : '';
	if($author_header_background != ''){
		$archive_background = $author_header_background;
	}
	$archive_background_height = '';
	$archive_background_height = ot_get_option('archive_background_height', '585');
	if($author_background_height != ''){
		$archive_background_height = $author_background_height;
	}
?>
<!--Slider V1-->
<div class="cactus-wraper-slider-bg">

    <div class="slider cactus-slider-single background-color-2" data-auto-play="" data-pagination="0" data-transition="fade" data-full-height="0"> <!--fade, backSlide, goDown, scaleUp-->
	<?php if($archive_background != ''){?>
        <!--Slider Item-->
        <div class="slider-item is-parallax" data-bg-img="<?php echo esc_attr($archive_background);?>" data-div-height="<?php echo esc_attr($archive_background_height);?>px" data-background-single=""> <!-- images/slide-1.jpg -->

            <div class="thumb-overlay background-color-2"></div>

            <div class="container">
                <div class="row">

                    <div class="text-content" data-margin-top="">

                        <div class="text-1">
                            <div class="picture"><span>
                                <?php
                                if(isset($_is_retina_)&&$_is_retina_){
                                        echo get_avatar( get_the_author_meta('email'), 260, esc_url(get_template_directory_uri() . '/images/avatar-2x-retina.jpg' ));
                                }else{
                                        echo get_avatar( get_the_author_meta('email'), 130, esc_url(get_template_directory_uri() . '/images/avatar-2x.jpg' ));
                                }?>
                            </span></div>
                        </div>
                        <div class="text-2 font-3 col-md-12"><div><h2><?php echo esc_html($author->display_name);?></h2></div></div>

                        <div class="clearfix"></div>
                        <div class="text-3 font-1">
                            <span><?php echo esc_html($position);?></span>
                            <div class="social-details">

                                <ul class="list-inline social-listing">
									<?php 
                                    if($facebook = get_the_author_meta('facebook',$author->ID)){ ?>
                                        <li class="facebook"><a rel="nofollow" href="<?php echo esc_url($facebook); ?>" title="<?php esc_html_e('Facebook', 'cactusthemes');?>"><i class="fa fa-facebook"></i></a></li>
                                    <?php }
                                    if($twitter = get_the_author_meta('twitter',$author->ID)){ ?>
                                        <li class="twitter"><a rel="nofollow" href="<?php echo esc_url($twitter); ?>" title="<?php esc_html_e('Twitter', 'cactusthemes');?>"><i class="fa fa-twitter"></i></a></li>
                                    <?php }
                                    if($google = get_the_author_meta('google',$author->ID)){ ?>
                                       <li class="google-plus"> <a rel="nofollow" href="<?php echo esc_url($google); ?>" title="<?php esc_html_e('Google Plus', 'cactusthemes');?>"><i class="fa fa-google-plus"></i></a></li>
                                    <?php }
                                    if($email = get_the_author_meta('email',$author->ID)){ ?>
                                        <li class="email"><a rel="nofollow" href="mailto:<?php echo esc_url($email); ?>" title="<?php esc_html_e('Email', 'cactusthemes');?>"><i class="fa fa-envelope-o"></i></a></li>
                                    <?php } ?>
                                </ul>

                            </div>
                        </div>

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
	<?php }?>
    </div>

</div>
<!--Slider V1-->