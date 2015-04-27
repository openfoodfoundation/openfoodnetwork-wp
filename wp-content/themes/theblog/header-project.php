<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cactus
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php if(ot_get_option('favicon')):?>
	<link rel="shortcut icon" type="ico" href="<?php echo esc_url(ot_get_option('favicon'));?>">
	<?php endif;?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!-- Retina Logo-->
	<?php if(ot_get_option('retina_logo')):?>
	<style type="text/css" >
		@media only screen and (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi) {
			/* Retina Logo */
			.primary-logo{background:url(<?php echo ot_get_option('retina_logo'); ?>) no-repeat center; display:inline-block !important; background-size:contain;}
			.primary-logo img{ opacity:0; visibility:hidden}
			.primary-logo *{display:inline-block}
		}
	</style>
	<?php endif;?>

	<?php if(ot_get_option('seo_meta_tags') != '' && ot_get_option('seo_meta_tags') == 'on' ) ct_meta_tags();?>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="checkHeaderLoading"></div>
	<input type="hidden" name="cactus_scroll_effect" value="<?php echo esc_attr(ot_get_option('scroll_effect', 'off'));?>"/>
<?php
		$header_layout =  ot_get_option('header_layout', 'static_text_biography');
		//$fixed_scroll_top = $header_layout == 'top_posts_carousel' ? 'auto' : '2';
		$fixed_scroll_top = '2';
	
		//sticky menu
		$sticky_menu =  ot_get_option('sticky_navigation')!= '' && ot_get_option('sticky_navigation') == 'on' ? '1' : '0' ;
		$enable_search = ot_get_option('enable_search');
	
		$cta_button_text = ot_get_option('cta_text');
		if($cta_button_text != '')
		{
			$cta_button_url         = ot_get_option('cta_url') != '' ? ot_get_option('cta_url') : '#';
			$cta_button_cta_target  = (ot_get_option('cta_target') != '' && ot_get_option('cta_target') == 'current_page') ? '' : 'target="_blank"';
		}
	
		$logo = ot_get_option('logo_image');
		
		global $project_header;
		$project_header = op_get('c_project_settings','cactus-project-listing-header');
		
		$left_layout_heading = op_get('c_project_settings','cactus-project-left-layout-heading');
		
		$header_static_text_1 = op_get('c_project_settings','cactus-project-listing-static-text-1');
		$header_static_text_2 = op_get('c_project_settings','cactus-project-listing-static-text-2');
		$header_static_text_3 = op_get('c_project_settings','cactus-project-listing-static-text-3');
		
		if($project_header == ''){$project_header = 'prj_stt_text';}
		$background_slider_shortcode = ot_get_option('background_slider_shortcode');

		$project_layout = '';
		$project_layout = op_get('c_project_settings','cactus-project-listing-layout');
		if($project_layout == ''){$project_layout = 'prj_standard';}
		$header_class = '';
		if(is_single()){
			$header_class = 'nav-default index-v1 background-color-2 cactus-header-project';
		}elseif(!is_single()){
			$header_class = 'nav-default index-v2 background-color-2 cactus-header-project';
		}
?>

<div id="body-wrap"><!--body-wrap-->

	<!--Menu moblie-->
    <div class="canvas-ovelay"></div>
    <div id="off-canvas" class="off-canvas-default background-color-2">
        <div class="off-canvas-inner">
            <div class="close-canvas-menu">
                <div class="close-button-1"></div>
            </div>
            <nav class="off-menu font-1">
                <ul>
                    <?php
                    if(has_nav_menu( 'primary' )):
                        wp_nav_menu(array(
                            'theme_location'  => 'primary',
                            'container' => false,
                            'items_wrap' => '%3$s',
                            'walker'=> new custom_walker_nav_menu(true)
                        ));
                    ?>
                    <?php else:?>
                            <li><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home','cactusthemes') ?> <span class="menu-description"><?php esc_html_e('Home page','cactusthemes') ?></span></a></li>
                            <?php wp_list_pages('depth=1&number=4&title_li=' ); ?>
                    <?php endif; ?>

                </ul>
                <?php
                	$enable_search = ot_get_option('enable_search');
            	    if($enable_search != '' && $enable_search == 'on'):
            	?>
	                    <ul class="search-mobile-menu">
	                        <li><a href="#" class="open-mini-search-box"><i class="fa fa-search"></i></a></li>

	                        <li class="cactus-form-mobile">
	                            <div class="wrap-form">
	                                <form method="get" action="<?php echo esc_url(home_url());?>">
	                                    <input type="text" name="s" class="input-search font-1" placeholder="<?php esc_html_e('Search', 'cactusthemes');?>">
	                                    <input type="hidden" name="post_type" value="post" />
	                                </form>
	                                <div class="button-search-mobile"></div>
	                            </div>
	                        </li>
	                    </ul>
                <?php endif;?>

				<?php
					$cta_button_text = ot_get_option('cta_text');
					if($cta_button_text != '')
					{
					    $cta_button_url         = ot_get_option('cta_url') != '' ? ot_get_option('cta_url') : '#';
					    $cta_button_cta_target  = (ot_get_option('cta_target') != '' && ot_get_option('cta_target') == 'current_page') ? '' : 'target="_blank"';
					}
				?>
 				<?php if($cta_button_text != ''):?>
                     <ul class="buytheme-mobile-menu">
                         <li class="buy-theme"><a href="<?php echo esc_url($cta_button_url);?>" <?php echo $cta_button_cta_target;?> class="active"><?php echo $cta_button_text;?></a></li>
                     </ul>
                 <?php endif;?>
            </nav>
        </div>
    </div><!--Menu moblie-->

	<?php if($project_layout == 'prj_standard'):?>
		<div id="wrap"><!--wrap-->
			<header>
				<div id="header-navigation" class="<?php echo esc_attr($header_class);?>">
                <!-- header navigation -->
                <?php  if($project_layout == 'prj_standard'):?>
				 <nav class="navbar navbar-default background-color-1 preload" role="navigation" data-fixed-scroll-top="<?php echo esc_attr($fixed_scroll_top);?>" data-fixed="<?php echo esc_attr($sticky_menu);?>">
					<div class="container">
				
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle" id="open-menu-moblie">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
				
						  <button type="button" class="navbar-toggle search">
							<i class="fa fa-search"></i>
						  </button>
				
						  <a class="navbar-brand" href="<?php echo esc_url(get_home_url()); ?>">
							<div class="primary-logo">
								<?php if($logo != ''):?>
										<img src="<?php echo esc_url($logo); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
								<?php else:?>
										<img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v2.png');?>"  alt="<?php wp_title( '|', true, 'right' );?>" />
								<?php endif;?>
							</div>
							<div class="sub-logo-animate">
								<?php $logo_image_sticky = ot_get_option('logo_image_sticky');?>
								<?php if($logo_image_sticky != ''):?>
										<img src="<?php echo esc_url($logo_image_sticky); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
								<?php else:?>
										<img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v2-sub.png');?>"  alt="<?php wp_title( '|', true, 'right' );?>" />
								<?php endif;?>
							</div>
						  </a>
						</div>
				
						<div class="collapse navbar-collapse font-1">
				
							
							<?php if($cta_button_text != ''):?>
								<ul class="buy-theme nav navbar-nav navbar-right"><!--Buy Theme Button-->
									<li class="buy-theme"><a href="<?php echo esc_url($cta_button_url);?>" <?php echo $cta_button_cta_target;?> class="active"><?php echo $cta_button_text;?></a></li>
								</ul><!--Buy Theme Button-->
							<?php endif;?>
				
							<?php if($enable_search != '' && $enable_search == 'on'):?>
								<ul class="search nav navbar-nav navbar-right"><!--Search Button-->
									<li class="search"><a href="#" class="active"><i class="fa fa-search"></i></a></li>
								</ul><!--Search Button-->
							<?php endif;?>
						<!--MENU-->
								<?php   $megamenu = ot_get_option('megamenu', 'off');
											if($megamenu =='off'){ ?>
												<ul class="nav navbar-nav navbar-right"><!-- nav navbar-nav navbar-right -->
												<?php
												if(has_nav_menu( 'primary' ))
												{
													wp_nav_menu(array(
														'theme_location'  => 'primary',
														'container' => false,
														'items_wrap' => '%3$s',
														'walker'=> new custom_walker_nav_menu()
													));
												}
												else {?>
														<li><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home','cactusthemes') ?> <span class="menu-description"><?php esc_html_e('Home page','cactusthemes') ?></span></a></li>
														<?php wp_list_pages('depth=1&number=4&title_li=' ); ?>
													<?php } ?>
											</ul><!-- nav navbar-nav navbar-right END -->
											<?php }elseif($megamenu =='on') { ?>
											<?php
												/** Load Magamenu **/
												mashmenu_load();?>
											<?php }?>
						<!-- MENU END-->
				
							<?php if($enable_search != '' && $enable_search == 'on'):?>
								<ul class="search sub nav navbar-nav navbar-right"><!--Search Button-->
									<li class="search sub"><a href="#" class="active"><i class="fa fa-search"></i></a></li>
								</ul><!--Search Button-->
							<?php endif;?>
				
				
							<?php if($cta_button_text != ''):?>
								<ul class="buy-theme nav navbar-nav navbar-right buy-theme-sub"><!--Buy Theme Button-->
									<li class="buy-theme"><a href="<?php echo esc_url($cta_button_url);?>" <?php echo $cta_button_cta_target;?> class="active"><?php echo $cta_button_text;?></a></li>
								</ul><!--Buy Theme Button-->
							<?php endif;?>
				
						</div>
				
						<!--Sub Logo-->
						<div class="sub-logo">
							<div class="sub-logo-content">
								<a href="<?php echo esc_url(get_home_url()); ?>">
									<?php if($logo != ''):?>
											<img src="<?php echo esc_url($logo); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
									<?php else:?>
											<img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v3.png');?>"  alt="<?php wp_title( '|', true, 'right' );?>" />
									<?php endif;?>
								</a>
							</div>
						</div>
						<!--Sub Logo-->
				
						<?php if($enable_search != '' && $enable_search == 'on'):?>
							<!--Search Form-->
							<div class="cactus-form-header">
								<div class="search-header-top"></div>
								<form method="get" action="<?php echo esc_url(home_url()); ?>">
									<input type="text" name="s" class="input-search font-1" placeholder="<?php esc_html_e('Search', 'cactusthemes');?>">
									<input type="hidden" name="post_type" value="post" />
								</form>
								<div class="button-search-top">
								</div>
							</div>
							<!--Search Form-->
						<?php endif;?>
				
					</div>
				</nav>
				<!--Navigation-->
				<?php else:?>
				<div class="version-6-table-left">
					<div class="menu-background background-color-27"></div>
				
					<div class="menu-container">
				
						<header> <!--Header-->
							<a href="<?php echo esc_url(get_home_url()); ?>">
							<!--main logo (large)-->
							<div class="primary-logo">
								<?php if($logo != ''):?>
										<img src="<?php echo esc_url($logo); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
								<?php else:?>
										<img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v6.png');?>"  width="141" height="60" alt="<?php wp_title( '|', true, 'right' );?>" />
								<?php endif;?>
							</div><!--main logo (large)-->
							</a><!--logo-->
						</header> <!--Header-->
				
						<div class="off-canvas-inner">
							<nav class="off-menu font-1">
								<ul>
									<?php
									if(has_nav_menu( 'primary' )):
										wp_nav_menu(array(
											'theme_location'  => 'primary',
											'container' => false,
											'items_wrap' => '%3$s',
											'walker'=> new custom_walker_nav_menu(true)
										));
									?>
									<?php else:?>
											<li><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home','cactusthemes') ?> <span class="menu-description"><?php esc_html_e('Home page','cactusthemes') ?></span></a></li>
											<?php wp_list_pages('depth=1&number=4&title_li=' ); ?>
									<?php endif; ?>
				
								</ul>
				
								<?php if($enable_search != '' && $enable_search == 'on'):?>
									<ul class="search-mobile-menu">
										<li><a href="#" class="open-mini-search-box"><i class="fa fa-search"></i></a></li>
				
										<li class="cactus-form-mobile">
											<div class="wrap-form">
												<form method="get" action="<?php echo esc_url(home_url());?>">
													<input type="text" name="s" class="input-search font-1" placeholder="<?php esc_html_e('Search', 'cactusthemes');?>">
													<input type="hidden" name="post_type" value="post" />
												</form>
												<div class="button-search-mobile"></div>
											</div>
										</li>
									</ul>
								<?php endif;?>
								
								<?php if($cta_button_text != ''):?>
									<ul class="buytheme-mobile-menu">
										<li class="buy-theme"><a href="<?php echo esc_url($cta_button_url);?>" <?php echo $cta_button_cta_target;?> class="active"><?php echo $cta_button_text;?></a></li>
									</ul>
								<?php endif;?>
							</nav>
						</div>
					</div>
				
				</div>
				<?php endif;?>
                <!-- !header navigation end -->
				<?php if(is_single()):?>
                <!--Slider-->
                <div class="cactus-wraper-slider-bg">
                    <!--Slider V1-->
                    <div class="slider cactus-slider-single" data-auto-play="" data-pagination="0" data-transition="fade" data-full-height="0"> <!--fade, backSlide, goDown, scaleUp-->
                    </div>
                    <!--Slider V1--> 
                </div> 
                <!--Slider-->
                <?php endif;?>
                
                <!-- header heading -->
                <?php if(!is_single()):?>
					<?php if($project_header == 'prj_bg_slider'){ ?>
                        <?php  
							$addFullHeight = '';
							$strpos_fullheight_1=strpos($background_slider_shortcode, "full_height='1'");
							$strpos_fullheight_2=strpos($background_slider_shortcode, "full_height=''");
							$strpos_fullheight_3=strpos($background_slider_shortcode, 'full_height="1"');
							$strpos_fullheight_4=strpos($background_slider_shortcode, 'full_height=""');
				
							if(	$strpos_fullheight_1 !== false || $strpos_fullheight_2 !== false || $strpos_fullheight_3 !== false || $strpos_fullheight_4 !== false) {				
								$addFullHeight='data-full-height-wrap="1"';
							}
							
							echo '<div id="top-background-slider-0" class="cactus-background-color-2" '. $addFullHeight .'>' . do_shortcode($background_slider_shortcode) . '</div>';
						?>
                    <?php }else if ($project_header == 'prj_stt_text') {?>
                        <div class="cactus-wraper-slider-bg">
                            <div class="slider header-v2 background-color-1" data-auto-play="" data-pagination="0" data-transition="fade" data-full-height="0">
                                <div class="slider-item is-text-parallax">
                                    <div class="container">
                                        <div class="row">
                                            <div class="text-content col-md-12">
                                                <div class="text-1 font-1"><span> <?php echo esc_html($header_static_text_1); ?> </span></div>
                                                <div class="text-2 font-3"><span> <?php echo esc_html($header_static_text_2); ?> </span></div>
                                                <div class="text-3 font-1"><span> <?php echo esc_html($header_static_text_3); ?> </span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                <?php endif;//is_single()?>    
                <!-- header heading end -->
                
				</div>
			</header>
			<div id="cactus-body-container"> <!-- cactus-body-container-->
		<?php else:?>
		    <div id="wrap"><!--wrap-->
		    		<div class="container-version-6">
		    	    	<div class="version-6-row">
		    	        	
                            <!-- header navigation -->
							<?php  if($project_layout == 'prj_standard'):?>
                             <nav class="navbar navbar-default background-color-1 preload" role="navigation" data-fixed-scroll-top="<?php echo esc_attr($fixed_scroll_top);?>" data-fixed="<?php echo esc_attr($sticky_menu);?>">
                                <div class="container">
                            
                                    <div class="navbar-header">
                                      <button type="button" class="navbar-toggle" id="open-menu-moblie">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                      </button>
                            
                                      <button type="button" class="navbar-toggle search">
                                        <i class="fa fa-search"></i>
                                      </button>
                            
                                      <a class="navbar-brand" href="<?php echo esc_url(get_home_url()); ?>">
                                        <div class="primary-logo">
                                            <?php if($logo != ''):?>
                                                    <img src="<?php echo esc_url($logo); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
                                            <?php else:?>
                                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v2.png');?>"  alt="<?php wp_title( '|', true, 'right' );?>" />
                                            <?php endif;?>
                                        </div>
                                        <div class="sub-logo-animate">
                                            <?php $logo_image_sticky = ot_get_option('logo_image_sticky');?>
                                            <?php if($logo_image_sticky != ''):?>
                                                    <img src="<?php echo esc_url($logo_image_sticky); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
                                            <?php else:?>
                                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v2-sub.png');?>"  alt="<?php wp_title( '|', true, 'right' );?>" />
                                            <?php endif;?>
                                        </div>
                                      </a>
                                    </div>
                            
                                    <div class="collapse navbar-collapse font-1">
                            
                                        
                                        <?php if($cta_button_text != ''):?>
                                            <ul class="buy-theme nav navbar-nav navbar-right"><!--Buy Theme Button-->
                                                <li class="buy-theme"><a href="<?php echo esc_url($cta_button_url);?>" <?php echo $cta_button_cta_target;?> class="active"><?php echo $cta_button_text;?></a></li>
                                            </ul><!--Buy Theme Button-->
                                        <?php endif;?>
                            
                                        <?php if($enable_search != '' && $enable_search == 'on'):?>
                                            <ul class="search nav navbar-nav navbar-right"><!--Search Button-->
                                                <li class="search"><a href="#" class="active"><i class="fa fa-search"></i></a></li>
                                            </ul><!--Search Button-->
                                        <?php endif;?>
                                    <!--MENU-->
                                            <?php   $megamenu = ot_get_option('megamenu', 'off');
                                                        if($megamenu =='off'){ ?>
                                                            <ul class="nav navbar-nav navbar-right"><!-- nav navbar-nav navbar-right -->
                                                            <?php
                                                            if(has_nav_menu( 'primary' ))
                                                            {
                                                                wp_nav_menu(array(
                                                                    'theme_location'  => 'primary',
                                                                    'container' => false,
                                                                    'items_wrap' => '%3$s',
                                                                    'walker'=> new custom_walker_nav_menu()
                                                                ));
                                                            }
                                                            else {?>
                                                                    <li><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home','cactusthemes') ?> <span class="menu-description"><?php esc_html_e('Home page','cactusthemes') ?></span></a></li>
                                                                    <?php wp_list_pages('depth=1&number=4&title_li=' ); ?>
                                                                <?php } ?>
                                                        </ul><!-- nav navbar-nav navbar-right END -->
                                                        <?php }elseif($megamenu =='on') { ?>
                                                        <?php
                                                            /** Load Magamenu **/
                                                            mashmenu_load();?>
                                                        <?php }?>
                                    <!-- MENU END-->
                            
                                        <?php if($enable_search != '' && $enable_search == 'on'):?>
                                            <ul class="search sub nav navbar-nav navbar-right"><!--Search Button-->
                                                <li class="search sub"><a href="#" class="active"><i class="fa fa-search"></i></a></li>
                                            </ul><!--Search Button-->
                                        <?php endif;?>
                            
                            
                                        <?php if($cta_button_text != ''):?>
                                            <ul class="buy-theme nav navbar-nav navbar-right buy-theme-sub"><!--Buy Theme Button-->
                                                <li class="buy-theme"><a href="<?php echo esc_url($cta_button_url);?>" <?php echo $cta_button_cta_target;?> class="active"><?php echo $cta_button_text;?></a></li>
                                            </ul><!--Buy Theme Button-->
                                        <?php endif;?>
                            
                                    </div>
                            
                                    <!--Sub Logo-->
                                    <div class="sub-logo">
                                        <div class="sub-logo-content">
                                            <a href="<?php echo esc_url(get_home_url()); ?>">
                                                <?php if($logo != ''):?>
                                                        <img src="<?php echo esc_url($logo); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
                                                <?php else:?>
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v3.png');?>"  alt="<?php wp_title( '|', true, 'right' );?>" />
                                                <?php endif;?>
                                            </a>
                                        </div>
                                    </div>
                                    <!--Sub Logo-->
                            
                                    <?php if($enable_search != '' && $enable_search == 'on'):?>
                                        <!--Search Form-->
                                        <div class="cactus-form-header">
                                            <div class="search-header-top"></div>
                                            <form method="get" action="<?php echo esc_url(home_url()); ?>">
                                                <input type="text" name="s" class="input-search font-1" placeholder="<?php esc_html_e('Search', 'cactusthemes');?>">
                                                <input type="hidden" name="post_type" value="post" />
                                            </form>
                                            <div class="button-search-top">
                                            </div>
                                        </div>
                                        <!--Search Form-->
                                    <?php endif;?>
                            
                                </div>
                            </nav>
                            <!--Navigation-->
                            <?php else:?>
                            <div class="version-6-table-left">
                                <div class="menu-background background-color-27"></div>
                            
                                <div class="menu-container">
                            
                                    <header> <!--Header-->
                                        <a href="<?php echo esc_url(get_home_url()); ?>">
                                        <!--main logo (large)-->
                                        <div class="primary-logo">
                                            <?php if($logo != ''):?>
                                                    <img src="<?php echo esc_url($logo); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
                                            <?php else:?>
                                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v6.png');?>"  alt="<?php wp_title( '|', true, 'right' );?>"  width="141" height="60"/>
                                            <?php endif;?>
                                        </div><!--main logo (large)-->
                                        </a><!--logo-->
                                    </header> <!--Header-->
                            
                                    <div class="off-canvas-inner">
                                        <nav class="off-menu font-1">
                                            <ul>
                                                <?php
                                                if(has_nav_menu( 'primary' )):
                                                    wp_nav_menu(array(
                                                        'theme_location'  => 'primary',
                                                        'container' => false,
                                                        'items_wrap' => '%3$s',
                                                        'walker'=> new custom_walker_nav_menu(true)
                                                    ));
                                                ?>
                                                <?php else:?>
                                                        <li><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home','cactusthemes') ?> <span class="menu-description"><?php esc_html_e('Home page','cactusthemes') ?></span></a></li>
                                                        <?php wp_list_pages('depth=1&number=4&title_li=' ); ?>
                                                <?php endif; ?>
                            
                                            </ul>
                            
                                            <?php if($enable_search != '' && $enable_search == 'on'):?>
                                                <ul class="search-mobile-menu">
                                                    <li><a href="#" class="open-mini-search-box"><i class="fa fa-search"></i></a></li>
                            
                                                    <li class="cactus-form-mobile">
                                                        <div class="wrap-form">
                                                            <form method="get" action="<?php echo esc_url(home_url());?>">
                                                                <input type="text" name="s" class="input-search font-1" placeholder="<?php esc_html_e('Search', 'cactusthemes');?>">
                                                                <input type="hidden" name="post_type" value="post" />
                                                            </form>
                                                            <div class="button-search-mobile"></div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            <?php endif;?>
                                            
                                            <?php if($cta_button_text != ''):?>
                                                <ul class="buytheme-mobile-menu">
                                                    <li class="buy-theme"><a href="<?php echo esc_url($cta_button_url);?>" <?php echo $cta_button_cta_target;?> class="active"><?php echo $cta_button_text;?></a></li>
                                                </ul>
                                            <?php endif;?>
                                        </nav>
                                    </div>
                                </div>
                            
                            </div>
                            
                            <?php endif;?>
                            <!-- !header navigation end -->

	    	        	 	<div class="version-6-table-right">
				    	       	<header> <!--Header-->
		                        	<div id="header-navigation" class="nav-default index-v6 background-color-2">
		                                <nav class="navbar navbar-default" role="navigation">
		                                    <div class="container">
		                                        <div class="navbar-header">

		                                          <button type="button" class="navbar-toggle" id="open-menu-moblie">
		                                            <span class="sr-only">Toggle navigation</span>
		                                            <span class="icon-bar"></span>
		                                            <span class="icon-bar"></span>
		                                            <span class="icon-bar"></span>
		                                          </button>

		                                          <!--logo-->
		                                          <a class="navbar-brand" href="#">
		                                            <!--main logo (large)-->
		                                            <div class="primary-logo">
		                                                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v1.png');?>" alt="" title="The Blog" class="primary-logo">
		                                            </div><!--main logo (large)-->
		                                          </a><!--logo-->

		                                        </div>
		                                    </div>
		                                </nav>
		                            </div>
                                    <?php if($left_layout_heading != ''):?>
			                            <h1 class="font-1 h4"> <?php echo esc_html($left_layout_heading);?> </h1>
                                    <?php endif;?>
		                        </header> <!--Header-->
	    	        	 		<div id="cactus-body-container">
		<?php endif;?>