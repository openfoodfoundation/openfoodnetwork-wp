<?php
/**
 * cactus theme sample theme options file. This file is generated from Export feature in Option Tree.
 *
 * @package cactus
 */

/**
 * Initialize the custom Theme Options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function custom_theme_options() {

  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( ot_settings_id(), array() );

  /**
   * Custom settings array that will eventually be
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array(
        array(
          'id'        => 'option_types_help',
          'title'     => esc_html__( 'Option Types', 'theme-text-domain' ),
          'content'   => '<p>' . esc_html__( 'Help content goes here!', 'theme-text-domain' ) . '</p>'
        )
      ),
      'sidebar'       => '<p>' . esc_html__( 'Sidebar content goes here!', 'theme-text-domain' ) . '</p>'
    ),
    'sections'        => array(
      array(
        'id'          => 'general',
        'title'       => 'General'
      ),
      array(
        'id'          => 'color_n_fonts',
        'title'       => 'Color and Fonts'
      ),
      array(
        'id'          => 'theme_layout',
        'title'       => 'Theme Layout'
      ),
      array(
        'id'          => 'single_post',
        'title'       => 'Single Post'
      ),
	  array(
        'id'          => 'gallery_post',
        'title'       => 'Gallery Post'
      ),
      array(
        'id'          => 'single_page',
        'title'       => 'Single page'
      ),
      array(
        'id'          => 'page_not_found',
        'title'       => '404 - Page Not Found'
      ),
      array(
        'id'          => 'social_accounts',
        'title'       => esc_html__('Social Accounts','cactusthemes')
      ),
       array(
        'id'          => 'sharing_social',
        'title'       => esc_html__('Social Sharing','cactusthemes')
      ),
       array(
        'id'          => 'advertising',
        'title'       => 'Advertising'
      ),
       array(
        'id'          => 'auto_update',
        'title'       => 'Auto Update'
      )
    ),

// General Block
    'settings'        => array(
      array(
        'id'          => 'enable_search',
        'label'       => esc_html__('Enable Search','cactusthemes'),
        'desc'        => esc_html__('Enable or disable default search form in every pages','cactusthemes'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'seo_meta_tags',
        'label'       => esc_html__('SEO - Echo Meta Tags','cactusthemes'),
        'desc'        => esc_html__('By default, The Blog generates its own SEO meta tags (for example: Facebook Meta Tags). If you are using another SEO plugin like YOAST or a Facebook plugin, you can turn off this option','cactusthemes'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'copyright',
        'label'       => esc_html__('Copyright Text','cactusthemes'),
        'desc'        => esc_html__('Appear in footer','cactusthemes'),
        'std'         => 'WordPress Theme by (C) CactusThemes',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'rtl',
        'label'       => esc_html__( 'RTL Mode', 'cactusthemes' ),
        'desc'        => 'Support Right-to-Left language',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_css',
        'label'       => esc_html__( 'Custom CSS', 'cactusthemes' ),
        'desc'        => esc_html__('Enter custom CSS. Ex: .class{ font-size: 13px; }','cactusthemes'),
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '20',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_code',
        'label'       => esc_html__('Custom Code','cactusthemes'),
        'desc'        => esc_html__('Enter custom code or JS code here. For example, enter Google Analytics','cactusthemes'),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'favicon',
        'label'       => esc_html__('Favicon','cactusthemes'),
        'desc'        => esc_html__('Upload favicon (.ico)','cactusthemes'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_image',
        'label'       => esc_html__('Logo Image','cactusthemes'),
        'desc'        => esc_html__('Upload your logo image','cactusthemes'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_image_sticky',
        'label'       => esc_html__('Logo Image For Sticky Menu','cactusthemes'),
        'desc'        => esc_html__('Upload your logo image for sticky menu','cactusthemes'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'retina_logo',
        'label'       => esc_html__('Retina Logo (optional)','cactusthemes'),
        'desc'        => esc_html__('Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices.','cactusthemes'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'login_logo_image',
        'label'       => esc_html__('Login Logo Image','cactusthemes'),
        'desc'        => esc_html__('Upload your Admin Login logo image','cactusthemes'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'scroll_top_button',
        'label'       => esc_html__('Scroll Top button','cactusthemes'),
        'desc'        => esc_html__('Enable Scroll Top button','cactusthemes'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'cta_text',
        'label'       => esc_html__('CTA button Text','cactusthemes'),
        'desc'        => esc_html__('Text on Call-To-Action button. If empty, button is hidden','cactusthemes'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'cta_url',
        'label'       => esc_html__('CTA button URL','cactusthemes'),
        'desc'        => esc_html__('URL of Call-To-Action button','cactusthemes'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'cta_target',
        'label'       => esc_html__('CTA button target','cactusthemes'),
        'desc'        => esc_html__('If clicked, open URL in current page or new page','cactusthemes'),
        'std'         => 'current_page',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'choices'     => array(
          array(
            'value'       => 'current_page',
            'label'       => 'Current Page',
            'src'         => ''
          ),
          array(
            'value'       => 'new_page',
            'label'       => 'New Page',
            'src'         => ''
          )
        ),
      ),
      array(
          'id'          => 'scroll_effect',
          'label'       => __('Scroll Effect','cactusthemes'),
          'desc'        => __('Enable Page Scroll effect','cactusthemes'),
          'std'         => 'off',
          'type'        => 'on-off',
          'section'     => 'general',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'min_max_step'=> '',
          'class'       => '',
          'condition'   => '',
          'operator'    => 'and'
        ),
      // array(
      //   'id'          => 'pre-loading',
      //   'label'       => 'Pre-loading Effect',
      //   'desc'        => 'Enable Pre-loading Effect',
      //   'std'         => '2',
      //   'type'        => 'select',
      //   'section'     => 'general',
      //   'rows'        => '',
      //   'choices'     => array(
      //     array(
      //       'value'       => '-1',
      //       'label'       => 'Disable',
      //       'src'         => ''
      //     ),
      //     array(
      //       'value'       => '1',
      //       'label'       => 'Enable',
      //       'src'         => ''
      //     ),
      //     array(
      //       'value'       => '2',
      //       'label'       => 'Enable for Homepage Only',
      //       'src'         => ''
      //     )
      //   ),
      // ),

      // array(
      //   'id'          => 'sticky-menu',
      //   'label'       => 'Sticky Menu',
      //   'desc'        => 'Enable Sticky Menu',
      //   'std'         => '0',
      //   'type'        => 'select',
      //   'section'     => 'general',
      //   'rows'        => '',
      //   'choices'     => array(
      //     array(
      //       'value'       => '0',
      //       'label'       => 'Disable',
      //       'src'         => ''
      //     ),
      //     array(
      //       'value'       => '1',
      //       'label'       => 'Enable',
      //       'src'         => ''
      //     ),
      //   ),
      // ),
//End General Block

// Color and font block
      array(
        'id'          => 'main_color',
        'label'       => esc_html__('Main Color', 'cactusthemes' ),
        'desc'        => esc_html__('Choose main color of theme', 'cactusthemes' ),
        'std'         => '#25c3d8',
        'type'        => 'colorpicker',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'google_font',
        'label'       => esc_html__('Google Font','cactusthemes'),
        'desc'        => esc_html__('Use Google Fonts','cactusthemes'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'main_font_family',
        'label'       => esc_html__('Main Font Family', 'cactusthemes' ),
        'desc'        => esc_html__('Enter font-family name here. Google Fonts are supported. For example, if you choose "Source Code Pro" <a href="http://www.google.com/fonts/">Google Font</a> with font-weight 400,500,600, enter Source Code Pro: 400,500,600', 'cactusthemes' ),
        'std'         => 'Crimson+Text:400,400italic,700,700italic',
        'type'        => 'text',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font_family',
        'label'       => esc_html__('Heading Font Family', 'cactusthemes' ),
        'desc'        => esc_html__('Enter font-family name here. Google Fonts are supported. For example, if you choose "Source Code Pro" <a href="http://www.google.com/fonts/">Google Font</a> with font-weight 400,500,600, enter Source Code Pro: 400,500,600 <br/> <i>Only few  heading texts are affected</i>', 'cactusthemes' ),
        'std'         => 'Roboto:400,400italic,500,500italic,700,700italic',
        'type'        => 'text',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'main_font_size',
        'label'       => esc_html__('Main Font Size', 'cactusthemes' ),
        'desc'        => esc_html__('Select base font size', 'cactusthemes' ),
        'std'         => '18',
        'type'        => 'numeric-slider',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '16,22,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_font_1',
        'label'       => esc_html__('Custom Font 1', 'cactusthemes' ),
        'desc'        => esc_html__('Upload your own font and enter name "custom-font-1" in "Main Font Family" or "Heading Font Family" setting above', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_font_2',
        'label'       => esc_html__('Custom Font 2', 'cactusthemes' ),
        'desc'        => esc_html__('Upload your own font and enter name "custom-font-2" in "Main Font Family" or "Heading Font Family" setting above', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

//End Color and font block

// Theme layout block
      array(
        'id'          => 'theme_layout',
        'label'       => esc_html__( 'Main Layout', 'cactusthemes' ),
        'desc'        => esc_html__('Choose theme layout','cactusthemes'),
        'std'         => 'standard',
        'type'        => 'radio-image',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'standard',
            'label'       => esc_html__( 'Standard ', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/main-layout-standard.jpg'
          ),
          array(
            'value'       => 'left_navigation',
            'label'       => esc_html__( 'Left Navigation', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/main-layout-left-navigation.jpg'
          )
        )
      ),
      array(
        'id'          => 'front_page_heading',
        'label'       => esc_html__('Front-page Heading ', 'cactusthemes' ),
        'desc'        => esc_html__('Enter heading text for front-page. Leave empty if you don\'t want to show it', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
       array(
        'id'          => 'header_layout',
        'label'       => esc_html__( 'Header Layout(Standard Theme Layout only)', 'cactusthemes' ),
        'desc'        => esc_html__('Select header style','cactusthemes'),
        'std'         => 'static_text_biography',
        'type'        => 'radio-image',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'static_text_biography',
            'label'       => esc_html__( 'Static Text Biography', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/header-layout-static-text.jpg'
          ),
          array(
            'value'       => 'background_slider',
            'label'       => esc_html__( 'Background Slider', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/header-layout-background-slider.jpg'
          ),
          array(
            'value'       => 'bottom_posts_carousel',
            'label'       => esc_html__( 'Bottom Posts Carousel', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/header-layout-bottom-post-carousel.jpg'
          ),
          array(
            'value'       => 'posts_tab',
            'label'       => esc_html__( 'Posts Tab', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/header-layout-post-tab.jpg'
          ),
          array(
            'value'       => 'top_posts_carousel',
            'label'       => esc_html__( 'Top Posts Carousel', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/header-layout-top-post-carousel.jpg'
          )
        )
      ),
      array(
        'id'          => 'background_slider_shortcode',
        'label'       => esc_html__('Background slider shortcode', 'cactusthemes' ),
        'desc'        => esc_html__('Enter background slider shortcode', 'cactusthemes' ),
        'std'         => '[b-slider cats="" ids="" number_of_slides="" auto_play="" pagination="" transition="" full_height="" scroll_down_button=""]',
        'type'        => 'textarea-simple',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	   array(
        'id'          => 'background_slider_scrolldown_text',
        'label'       => esc_html__('Scroll down text', 'cactusthemes' ),
        'desc'        => esc_html__('Scroll down text for Background Slider', 'cactusthemes' ),
        'std'         => 'scroll down for more',
        'type'        => 'text',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_carousel_count',
        'label'       => esc_html__('Header Posts Carousel, Posts Tab - Count', 'cactusthemes' ),
        'desc'        => esc_html__('Number of items in header posts carousel', 'cactusthemes' ),
        'std'         => '6',
        'type'        => 'text',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_static_text_1',
        'label'       => esc_html__('Static Text - Line 1', 'cactusthemes' ),
        'desc'        => esc_html__('Enter text in the first line', 'cactusthemes' ),
        'std'         => esc_html__('Enter text in the first line', 'cactusthemes' ),
        'type'        => 'text',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_static_text_2',
        'label'       => esc_html__('Static Text - Line 2', 'cactusthemes' ),
        'desc'        => esc_html__('Enter text in the second line', 'cactusthemes' ),
        'std'         => esc_html__('Enter text in the second line', 'cactusthemes' ),
        'type'        => 'text',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_static_text_3',
        'label'       => esc_html__('Static Text - Line 3', 'cactusthemes' ),
        'desc'        => esc_html__('Enter text in the third line', 'cactusthemes' ),
        'std'         => esc_html__('Enter text in the third line', 'cactusthemes' ),
        'type'        => 'text',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
          'id'          => 'megamenu',
          'label'       => esc_html__('Mega Menu','cactusthemes'),
          'desc'        => esc_html__('Enable mega menu feature','cactusthemes'),
          'std'         => 'off',
          'type'        => 'on-off',
          'section'     => 'theme_layout',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'min_max_step'=> '',
          'class'       => '',
          'condition'   => '',
          'operator'    => 'and'
        ),
      array(
        'id'          => 'sticky_navigation',
        'label'       => esc_html__('Sticky navigation','cactusthemes'),
        'desc'        => esc_html__('Enable sticky navigation','cactusthemes'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_layout',
        'label'       => esc_html__( 'Blog Layout', 'cactusthemes' ),
        'desc'        => esc_html__('Select style for blog','cactusthemes'),
        'std'         => 'grid',
        'type'        => 'radio-image',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'grid',
            'label'       => esc_html__( 'Grid', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/blog-layout-grid.jpg'
          ),
          array(
            'value'       => 'masonry',
            'label'       => esc_html__( 'Masonry', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/blog-layout-masonry.jpg'
          ),
          array(
            'value'       => 'one_column',
            'label'       => esc_html__( 'One Column', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/blog-layout-one-column.jpg'
          ),
          array(
            'value'       => 'normal_classic',
            'label'       => esc_html__( 'Normal Classic', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/blog-layout-normal-classic.jpg'
          ),
          array(
            'value'       => 'wide_classic',
            'label'       => esc_html__( 'Wide Classic', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/blog-layout-wide-classic.jpg'
          ),
          array(
            'value'       => 'modern',
            'label'       => esc_html__( 'Modern', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/blog-layout-modern.jpg'
          ),
          array(
            'value'       => 'masonry_modern',
            'label'       => esc_html__( 'Masonry  Modern', 'cactusthemes' ),
            'src'         =>  get_stylesheet_directory_uri() . '/images/themeoptions/blog-layout-masonry-modern.jpg'
          ),
        )
      ),
      array(
        'id'          => 'sidebar',
        'label'       => esc_html__( 'Sidebar', 'cactusthemes' ),
        'desc'        => esc_html__('Select style for blog','cactusthemes'),
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'right',
            'label'       => esc_html__( 'Right', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__( 'Left', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'hidden',
            'label'       => esc_html__( 'Hidden', 'cactusthemes' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'navigation',
        'label'       => esc_html__('Pagination', 'cactusthemes' ),
        'desc'        => esc_html__('Choose type of pagination for all archives pages. If you choose WP PageNavi, make sure you have installed this plugin in advanced', 'cactusthemes' ),
        'std'         => 'def',
        'type'        => 'select',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'def',
            'label'       => esc_html__( 'Default WordPress', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'ajax',
            'label'       => esc_html__( 'Ajax', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'wp_pagenavi',
            'label'       => esc_html__( 'WP PageNavi', 'cactusthemes' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'archive_background',
        'label'       => esc_html__('Default Header Background', 'cactusthemes' ),
        'desc'        => esc_html__('Choose default header background for categories and authors pages', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'archive_background_height',
        'label'       => esc_html__('Default Header Background Height', 'cactusthemes' ),
        'desc'        => esc_html__('Height of header background for categories and authors pages. Default: 585', 'cactusthemes' ),
        'std'         => esc_html__('585', 'cactusthemes' ),
        'type'        => 'text',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    array(
        'id'          => 'page_background',
        'label'       => esc_html__('Default Page Background', 'cactusthemes' ),
        'desc'        => esc_html__('Choose default background for all pages', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

//End Theme layout block

//Single post block
      array(
        'id'          => 'single_sidebar',
        'label'       => esc_html__('Sidebar', 'cactusthemes' ),
        'desc'        => '',
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'right',
            'label'       => esc_html__( 'Right', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__( 'Left', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'hidden',
            'label'       => esc_html__( 'Hidden', 'cactusthemes' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'single_standard_layout',
        'label'       => esc_html__( 'Layout For Standard Posts', 'cactusthemes' ),
        'desc'        => esc_html__('Choose default layout for standard posts', 'cactusthemes' ),
        'std'         => 'layout_1',
        'type'        => 'select',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
		'choices'     => array(
          array(
            'value'       => 'layout_1',
            'label'       => esc_html__( 'Layout 1', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'layout_2',
            'label'       => esc_html__( 'Layout 2', 'cactusthemes' ),
            'src'         => ''
          ),
        )
      ),
      array(
        'id'          => 'single_show_author',
        'label'       => esc_html__( 'Author', 'cactusthemes' ),
        'desc'        => esc_html__('', 'cactusthemes' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_show_date',
        'label'       => esc_html__( 'Published Date', 'cactusthemes' ),
        'desc'        => esc_html__('Enable Published Date info', 'cactusthemes' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_show_categories',
        'label'       => esc_html__( 'Categories', 'cactusthemes' ),
        'desc'        => esc_html__('Enable Categories info', 'cactusthemes' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_show_tags',
        'label'       => esc_html__( 'Tags', 'cactusthemes' ),
        'desc'        => esc_html__('Enable Tags info', 'cactusthemes' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_show_sharing',
        'label'       => esc_html__( 'Social Sharing', 'cactusthemes' ),
        'desc'        => esc_html__('Enable Social Sharing', 'cactusthemes' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_show_post_navigation',
        'label'       => esc_html__( 'Post Navigation', 'cactusthemes' ),
        'desc'        => esc_html__('Enable Post Navigation', 'cactusthemes' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_show_related_posts',
        'label'       => esc_html__( 'Related Posts', 'cactusthemes' ),
        'desc'        => esc_html__('Enable Related Posts', 'cactusthemes' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'single_related_post_count',
        'label'       => esc_html__('Related Post Count', 'cactusthemes' ),
        'desc'        => esc_html__('Number of related posts', 'cactusthemes' ),
        'std'         => '4',
        'type'        => 'text',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_related_posts_by',
        'label'       => esc_html__('Related Posts by', 'cactusthemes' ),
        'desc'        => 'Get related posts by categories or tags',
        'std'         => 'categories',
        'type'        => 'select',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'categories',
            'label'       => esc_html__( 'Categories ', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'tags',
            'label'       => esc_html__( 'Tags', 'cactusthemes' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'related_posts_order_by',
        'label'       => esc_html__('Related Posts Order By', 'cactusthemes' ),
        'desc'        => '',
        'std'         => 'date',
        'type'        => 'select',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'date',
            'label'       => esc_html__( 'Date ', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'rand',
            'label'       => esc_html__( 'Random', 'cactusthemes' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'single_show_about_author',
        'label'       => esc_html__( 'About Author', 'cactusthemes' ),
        'desc'        => esc_html__('Enable About Author info', 'cactusthemes' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

//End Single post block


//Gallery Post Block

array(
        'id'          => 'single_gallery_layout',
        'label'       => esc_html__( 'Layout For Gallery Posts', 'cactusthemes' ),
        'desc'        => esc_html__('Choose default layout for gallery posts', 'cactusthemes' ),
        'std'         => 'layout_1',
        'type'        => 'select',
        'section'     => 'gallery_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
		'choices'     => array(
          array(
            'value'       => 'layout_1',
            'label'       => esc_html__( 'Layout 1', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'layout_2',
            'label'       => esc_html__( 'Layout 2', 'cactusthemes' ),
            'src'         => ''
          ),
        )
      ),
	   array(
        'id'          => 'single_gallery_slider_autoplay',
        'label'       => esc_html__( 'Gallery Slider Autoplay', 'cactusthemes' ),
        'desc'        => esc_html__('Enable autoplay for Gallery Slider', 'cactusthemes' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'gallery_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	   array(
        'id'          => 'single_gallery_slider_speed',
        'label'       => esc_html__('Gallery Slider Speed', 'cactusthemes' ),
        'desc'        => esc_html__('Set speed for Gallery Slider (in milliseconds). Default: 5000', 'cactusthemes' ),
        'std'         => '5000',
        'type'        => 'text',
        'section'     => 'gallery_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'single_gallery_v1_slider_height',
        'label'       => esc_html__('Default Slider Height in Gallery Post Layout 1', 'cactusthemes' ),
        'desc'        => esc_html__('Default Slider Height in Gallery Post Layout 1. Default: 800', 'cactusthemes' ),
        'std'         => '800',
        'type'        => 'text',
        'section'     => 'gallery_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

//End Gallery Post Block



//Single page block

      array(
        'id'          => 'page_sidebar',
        'label'       => esc_html__('Sidebar', 'cactusthemes' ),
        'desc'        => '',
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'right',
            'label'       => esc_html__( 'Right', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__( 'Left', 'cactusthemes' ),
            'src'         => ''
          ),
          array(
            'value'       => 'hidden',
            'label'       => esc_html__( 'Hidden', 'cactusthemes' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'disable_comments',
        'label'       => esc_html__( 'Disable Comments by default', 'cactusthemes' ),
        'desc'        => esc_html__('Disable comments on single pages', 'cactusthemes' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

//End single page block

//404 - Page Not Found block
      array(
        'id'          => 'page_title',
        'label'       => esc_html__( 'Page Title', 'cactusthemes' ),
        'desc'        => '',
        'std'         => '404 - Page Not Found',
        'type'        => 'text',
        'section'     => 'page_not_found',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'page_content',
        'label'       => esc_html__( 'Page Content', 'cactusthemes' ),
        'desc'        => '',
        'std'         => '404 - Page Not Found',
        'type'        => 'textarea',
        'section'     => 'page_not_found',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

//End 404 - Page Not Found block

//Social Accounts block
      array(
        'id'          => 'facebook',
        'label'       => 'Facebook',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'twitter',
        'label'       => 'Twitter',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'linkedin',
        'label'       => 'LinkedIn',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tumblr',
        'label'       => 'Tumblr',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'google-plus',
        'label'       => 'Google Plus',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pinterest',
        'label'       => 'Pinterest',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'youtube',
        'label'       => 'YouTube',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'flickr',
        'label'       => 'Flickr',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'envelope',
        'label'       => esc_html__( 'Email', 'cactusthemes' ),
        'desc'        => esc_html__('Enter email contact', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
			'id'          => 'custom_social_account',
			'label'       => esc_html__('Custom Social Account', 'cactusthemes' ),
			'desc'        => esc_html__('Add more social accounts using Font Awesome Icons','cactusthemes'),
			'type'        => 'list-item',
			'class'       => '',
			'section'     => 'social_accounts',
			'choices'     => array(),
			'settings'    => array(
				 array(
					'label'       => 'Icon Font Awesome',
					'id'          => 'icon',
					'type'        => 'text',
					'desc'        => esc_html__('Enter Font Awesome class (Ex: fa-facebook)','cactusthemes'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => ''
				 ),
				 array(
					'label'       => 'URL',
					'id'          => 'link',
					'type'        => 'text',
					'desc'        => esc_html__('Enter full link to your account (including http://)','cactusthemes'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => ''
				 ),
			)
	  ),
       array(
        'id'          => 'open_link_in_new_tab',
        'label'       => esc_html__( 'Open Social Link in new tab', 'cactusthemes' ),
        'desc'        => 'Open link in new tab?',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

//End Social Accounts block

//Social Sharing block
      array(
        'id'          => 'sharing_facebook',
        'label'       => esc_html__( 'Show FaceBook Share button', 'cactusthemes' ),
        'desc'        => 'Enable FaceBook Share button',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'sharing_twitter',
        'label'       => esc_html__( 'Show Twitter Share Button', 'cactusthemes' ),
        'desc'        => 'Enable Twitter Share button',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'sharing_linkedIn',
        'label'       => esc_html__( 'Show LinkedIn Share Button', 'cactusthemes' ),
        'desc'        => 'Enable LinkedIn Share button',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

       array(
        'id'          => 'sharing_tumblr',
        'label'       => esc_html__( 'Show Tumblr Share Button', 'cactusthemes' ),
        'desc'        => 'Enable Tumblr Share button',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

       array(
        'id'          => 'sharing_google',
        'label'       => esc_html__( 'Show Google+ Share Button', 'cactusthemes' ),
        'desc'        => 'Enable Google+ Share button',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

       array(
        'id'          => 'sharing_pinterest',
        'label'       => esc_html__( 'Show Pinterest Pin Button', 'cactusthemes' ),
        'desc'        => 'Enable Pinterest Pin button',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

       array(
        'id'          => 'sharing_email',
        'label'       => esc_html__( 'Show Email Button', 'cactusthemes' ),
        'desc'        => 'Enable Email button',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

//End social Sharing block

//Advertising block
       array(
         'id'          => 'adsense_id',
         'label'       => 'Google AdSense Publisher ID',
         'desc'        => esc_html__('Enter your Google AdSense Publisher ID', 'cactusthemes' ),
         'std'         => '',
         'type'        => 'text',
         'section'     => 'advertising',
         'rows'        => '',
         'post_type'   => '',
         'taxonomy'    => '',
         'min_max_step'=> '',
         'class'       => '',
         'condition'   => '',
         'operator'    => 'and'
       ),
         array(
         'id'          => 'adsense_slot_ads_top_archives',
         'label'       => 'Top Ads Archives - AdSense Ads Slot ID',
         'desc'        => esc_html__('If you want to display Adsense on Top of Archive pages, enter Google AdSense Ad Slot ID here. If left empty, "Top Ads Archives - Custom Code" will be used', 'cactusthemes' ),
         'std'         => '',
         'type'        => 'text',
         'section'     => 'advertising',
         'rows'        => '',
         'post_type'   => '',
         'taxonomy'    => '',
         'min_max_step'=> '',
         'class'       => '',
         'condition'   => '',
         'operator'    => 'and'
       ),
        array(
         'id'          => 'ads_top_archives',
         'label'       => 'Top Ads Archives - Custom Code',
         'desc'        => esc_html__('Enter custom code for Top Ads Archives position', 'cactusthemes' ),
         'std'         => '',
         'type'        => 'textarea-simple',
         'section'     => 'advertising',
         'rows'        => '',
         'post_type'   => '',
         'taxonomy'    => '',
         'min_max_step'=> '',
         'class'       => '',
         'condition'   => '',
         'operator'    => 'and'
       ),
       array(
         'id'          => 'adsense_slot_ads_bottom_archives',
         'label'       => 'Bottom Ads Archives - AdSense Ads Slot ID',
         'desc'        => esc_html__('If you want to display Adsense at Bottom of Archive pages, enter Google AdSense Ad Slot ID here. If left empty, "Bottom Ads Archives - Custom Code" will be used', 'cactusthemes' ),
         'std'         => '',
         'type'        => 'text',
         'section'     => 'advertising',
         'rows'        => '',
         'post_type'   => '',
         'taxonomy'    => '',
         'min_max_step'=> '',
         'class'       => '',
         'condition'   => '',
         'operator'    => 'and'
       ),
        array(
         'id'          => 'ads_bottom_archives',
         'label'       => 'Bottom Ads Archives - Custom Code',
         'desc'        => esc_html__('Enter custom code for Bottom Ads Archives position', 'cactusthemes' ),
         'std'         => '',
         'type'        => 'textarea-simple',
         'section'     => 'advertising',
         'rows'        => '',
         'post_type'   => '',
         'taxonomy'    => '',
         'min_max_step'=> '',
         'class'       => '',
         'condition'   => '',
         'operator'    => 'and'
       ),
       array(
         'id'          => 'adsense_slot_ads_top_single',
         'label'       => 'Top Ads Single - AdSense Ads Slot ID',
         'desc'        => esc_html__('If you want to display Adsense on Top of single pages, enter Google AdSense Ad Slot ID here. If left empty, "Top Ads Single - Custom Code" will be used', 'cactusthemes' ),
         'std'         => '',
         'type'        => 'text',
         'section'     => 'advertising',
         'rows'        => '',
         'post_type'   => '',
         'taxonomy'    => '',
         'min_max_step'=> '',
         'class'       => '',
         'condition'   => '',
         'operator'    => 'and'
       ),
        array(
         'id'          => 'ads_top_single',
         'label'       => 'Top Ads Single - Custom Code',
         'desc'        => esc_html__('Enter custom code for Top Ads Single position', 'cactusthemes' ),
         'std'         => '',
         'type'        => 'textarea-simple',
         'section'     => 'advertising',
         'rows'        => '',
         'post_type'   => '',
         'taxonomy'    => '',
         'min_max_step'=> '',
         'class'       => '',
         'condition'   => '',
         'operator'    => 'and'
       ),
       array(
         'id'          => 'adsense_slot_ads_bottom_single',
         'label'       => 'Bottom Ads Single - AdSense Ads Slot ID',
         'desc'        => esc_html__('If you want to display Adsense at Bottom of single pages, enter Google AdSense Ad Slot ID here. If left empty, "Bottom Ads Single - Custom Code" will be used', 'cactusthemes' ),
         'std'         => '',
         'type'        => 'text',
         'section'     => 'advertising',
         'rows'        => '',
         'post_type'   => '',
         'taxonomy'    => '',
         'min_max_step'=> '',
         'class'       => '',
         'condition'   => '',
         'operator'    => 'and'
       ),
        array(
         'id'          => 'ads_bottom_single',
         'label'       => 'Bottom Ads Single - Custom Code',
         'desc'        => esc_html__('Enter custom code for Bottom Ads Single position', 'cactusthemes' ),
         'std'         => '',
         'type'        => 'textarea-simple',
         'section'     => 'advertising',
         'rows'        => '',
         'post_type'   => '',
         'taxonomy'    => '',
         'min_max_step'=> '',
         'class'       => '',
         'condition'   => '',
         'operator'    => 'and'
       ),

//End advertising block

//Auto update block
       array(
        'id'          => 'envato_username',
        'label'       => 'Envato Username',
        'desc'        => esc_html__('Enter your Envato username', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'auto_update',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
       array(
        'id'          => 'envato_api',
        'label'       => 'Envato API',
        'desc'        => esc_html__('Enter your Envato API. You can find your API under in Profile page > My Settings > API Keys', 'cactusthemes' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'auto_update',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
       array(
        'id'          => 'envato_auto_update',
        'label'       => esc_html__( 'Allow Auto Update', 'cactusthemes' ),
        'desc'        => esc_html__('Allow Auto Update or Not. If not, you can go to Appearance > Themes and click on Update link', 'cactusthemes' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'auto_update',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );

  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings );
  }

}
