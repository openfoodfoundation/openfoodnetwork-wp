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
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(ot_get_option('favicon'));?>">
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
	//get css class header layout
		global $header_layout;
		$archive_background = '';
		$author_header_background = '';
		$add_class_category = '';
		$add_class_author = '';
		$archive_background = ot_get_option('archive_background');
		$archive_background = isset($archive_background['background-image']) ? $archive_background['background-image'] : '';
		if($archive_background == '')
			$add_class=" index-v1 standard-v1 background-color-2";

		if(is_author()){
			$author = get_userdata( get_query_var('author') );
			$author_header_background = get_the_author_meta('author_header_background',$author->ID);
			if($archive_background == '' && $author_header_background == ''){
				$add_class_author = " index-v1 standard-v1 background-color-2";
			}
		}

		if(is_category()){
			if(function_exists('z_taxonomy_image_url') &&  z_taxonomy_image_url() != ''){ $archive_background = z_taxonomy_image_url();}
			if($archive_background == ''){
				$add_class_category = " index-v1 standard-v1 background-color-2";
			}
		}

		$version = '';
		if((is_front_page())||(is_page_template('page-templates/front-page.php')))
		{
		    if(is_front_page())
		    {
		    	$page_on_front = get_option('page_on_front');
		    	if($page_on_front == 0 || $page_on_front == '')
		    	{
	            	$header_layout =  ot_get_option('header_layout', 'static_text_biography');
		    	}
		    	else
		    	{
	            	$header_layout =  get_post_meta($page_on_front,'header_layout',true) != '' ? get_post_meta(get_the_ID(),'header_layout',true) : 'background_slider' ;
		    	}

		    }
	        else if(is_page_template('page-templates/front-page.php'))
	            $header_layout =  get_post_meta(get_the_ID(),'header_layout',true) != '' ? get_post_meta(get_the_ID(),'header_layout',true) : 'background_slider' ;

		    $version = 'index-v1';
		    if($header_layout == 'background_slider')
		        $version = 'index-v1';
		    else if($header_layout == 'static_text_biography')
		        $version = 'index-v2';
		    else if($header_layout == 'bottom_posts_carousel')
		        $version = 'index-v3';
		    else if($header_layout == 'posts_tab')
		        $version = 'index-v4';
		    else if($header_layout == 'top_posts_carousel')
		        $version = 'index-v5';
		}
		else if(is_single())
		{
			$version = 'index-v1 standard-v1 background-color-2';
		}
		else if(is_category())
		{
			$version = 'single-category'.$add_class_category;
		}
		else if(is_author())
		{
			$version = 'author-page'.$add_class_author;
		}
		else{
			$version = 'index-v1 standard-v1 background-color-2';
		}

		global $theme_layout;

		if(is_front_page())
	    {
	    	$page_on_front = get_option('page_on_front');
	    	if($page_on_front == 0 || $page_on_front == '')
	    	{
            	$theme_layout = ot_get_option('theme_layout', 'standard');
	    	}
	    	else
	    	{
            	$theme_layout = get_post_meta(get_the_ID(),'theme_layout',true);
	    	}

	    }
        else if(is_page_template('page-templates/front-page.php'))
        	$theme_layout = get_post_meta(get_the_ID(),'theme_layout',true);
        else
        	$theme_layout = ot_get_option('theme_layout', 'standard');
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
                         <li class="buy-theme"><a href="<?php echo esc_url($cta_button_url);?>" <?php echo esc_html($cta_button_cta_target);?> class="active"><?php echo esc_html($cta_button_text);?></a></li>
                     </ul>
                 <?php endif;?>
            </nav>
        </div>
    </div><!--Menu moblie-->

	<?php if($theme_layout == 'standard'):?>
		<div id="wrap"><!--wrap-->
			<header>
				<div id="header-navigation" class="nav-default <?php echo esc_attr($version);?>">
				    <?php
				        get_template_part( 'header', 'navigation' ); // load header-navigation.php

						$paged ='';
						// $page_content = get_post_meta(get_the_ID(),'page_content',true);

						// if($page_content=='blog')
						// {
						// 	global $paged;
						// 	$paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
						// }
						if((is_front_page())||(is_page_template('page-templates/front-page.php')))
						{
				           get_template_part( 'header', 'frontpage' );
						}
						else if(is_category())
						{
							get_template_part( 'header', 'category' );
						}
						else if(is_author())
						{
							get_template_part( 'header', 'author' );
						}
						elseif(is_single())
						{
							get_template_part( 'header', 'single' );
						}
						else
						{
							get_template_part( 'header', 'heading' );
						}
				    ?>
				</div>
			</header>
			<div id="cactus-body-container"> <!-- cactus-body-container-->
		<?php else:?>
		    <div id="wrap"><!--wrap-->
		    		<div class="container-version-6">
		    	    	<div class="version-6-row">
		    	        	<?php get_template_part( 'header', 'navigation' ); // load header-navigation.php?>

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
		                                            	<?php $logo = ot_get_option('logo_image');?>
		                                            	<?php if($logo != ''):?>
		                                            	        <img src="<?php echo esc_url($logo); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
		                                            	<?php else:?>
		                                            	        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v1.png');?>"  alt="<?php wp_title( '|', true, 'right' );?>" width="141" height="60" />
		                                            	<?php endif;?>
		                                            </div><!--main logo (large)-->
		                                          </a><!--logo-->

		                                        </div>
		                                    </div>
		                                </nav>
		                            </div>
		                            <?php

	                            	    if(is_front_page())
	                            	    {
	                            	    	$page_on_front = get_option('page_on_front');
	                            	    	if($page_on_front == 0 || $page_on_front == '')
	                            	        	$header_front_page_heading = ot_get_option('front_page_heading', '');
	                            	    	else
	                            	        	$header_front_page_heading = get_post_meta(get_the_ID(),'front_page_heading',true);

	                            	    }
	                            	    else if(is_page_template('page-templates/front-page.php'))
	                            	        $header_front_page_heading = get_post_meta(get_the_ID(),'front_page_heading',true);
	                            	    else
	                            			 $header_front_page_heading = ot_get_option('front_page_heading', '');

		                            	if($header_front_page_heading != ''):
		                            ;?>
			                            <h1 class="font-1 h4">
			                            	<?php
				                            	echo esc_html($header_front_page_heading);
			                            	?>
			                            </h1>
		                        	<?php endif;?>
		                        </header> <!--Header-->
	    	        	 		<div id="cactus-body-container">
		<?php endif;?>
