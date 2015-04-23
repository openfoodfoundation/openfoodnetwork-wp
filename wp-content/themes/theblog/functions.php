<?php
/**
 * cactus functions and definitions
 *
 * @package cactus
 */
if(!defined('PARENT_THEME')){
	define('PARENT_THEME','theblog');
}

global $_theme_required_plugins;

$_theme_required_plugins = array(
        array(
            'name'      => 'OptionTree',
            'slug'      => 'option-tree',
            'required'  => true
        )
    );
/**
 * Core features
 */
require get_template_directory() . '/inc/core/cactus-core.php';

/**
 * Data functions
 */
require get_template_directory() . '/inc/core/data-functions.php';

/**
 * Uncomment below line in Release mode. theme-options.php is generated using Export feature in Option Tree
 */
require get_template_directory() . '/inc/theme-options.php';

/**
 * Add metadata (meta-boxes) for all post types
 */
require get_template_directory() . '/inc/metadata.php';

/**
 * Add metadata for categories
 */
require get_template_directory() . '/inc/category-metadata.php';

/**
 * Require Megamenu
 */
require get_template_directory() . '/inc/megamenu/megamenu.php';

/**
 * Require Widgets
 */
require get_template_directory() . '/inc/widgets/widgets_theme.php';

/**
 * Import Sample Data feature
 */
require get_template_directory() . '/sample-data/cactus_importer.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'cactus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cactus_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cactus, use a find and replace
	 * to change 'cactus' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cactusthemes', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'cactus' ),
	) );
	register_nav_menu( 'secondary-menus', esc_html__( 'Secondary Menu', 'cactusthemes' ) );
	register_nav_menu( 'footer-menu', esc_html__( 'Footer Menu', 'cactusthemes' ) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'audio', 'video', 'quote', 'gallery' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cactus_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // cactus_setup
add_action( 'after_setup_theme', 'cactus_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function cactus_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar ', 'cactusthemes' ),
		'id'            => 'main_sidebar',
		'description'   => esc_html__( 'Applied for all pages', 'cactusthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title'  => '<h2 class="widget-title font-1">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Main Top Sidebar', 'cactusthemes' ),
		'id' => 'maintop_sidebar',
		'description' => esc_html__( '', 'cactusthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title font-1">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Main Bottom Sidebar', 'cactusthemes' ),
		'id' => 'mainbottom_sidebar',
		'description' => esc_html__( 'Used in Front Page templates only', 'cactusthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title font-1">',
		'after_title' => '</h2>',
	));

	register_sidebar( array(
		'name' => esc_html__( 'Footer Sidebar', 'cactusthemes' ),
		'id' => 'footer_sidebar',
		'description' => esc_html__( '', 'cactusthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title font-1">',
		'after_title' => '</h2>',
	));

}
add_action( 'widgets_init', 'cactus_widgets_init' );

/**
 * Register thumb size
 */

add_image_size('thumb_megamenu',490,327, true); //Image preview mode Megamenu
add_image_size('thumb_listing_onecolumn_big_2x',1051,526, true); //Blog One Column + left sidebar (special - Big Images) - full hd
add_image_size('thumb_listing_onecolumn_small_2x',732,366, true); //Blog One Column + left sidebar (special - Fix-50) - full hd
add_image_size('thumb_listing_onecolumn_big_1x',597,298, true); //Blog One Column + left sidebar (special - Big Images) - 1280px
add_image_size('thumb_listing_onecolumn_small_1x',412,206, true); //Blog One Column + left sidebar (special - Fix-50) - 1280px
add_image_size('thumb_listing_onecolumn_mobile',320,160, true); //Blog One Column + left sidebar - all items in mobile and tablet
add_image_size('thumb_listing_grid',360,240, true); // Grid Listing - all items
add_image_size('thumb_listing_wide_pc',800, 400, true); //Blog Wide classic - 1280px-1920px
add_image_size('thumb_listing_wide_tablet',320,160, true); //Blog Wide classic - tablet
add_image_size('thumb_listing_wide_mobile',228,114, true); //Blog Wide classic - mobile
add_image_size('thumb_listing_related_post',246, 160, true); //Images Related Post
add_image_size('thumb_carousel',640,400, true); //Top And Bottom Carousel Header
add_image_size('thumb_carousel_mobile',150, 100, true); //Top And Bottom Carousel Header in mobile
add_image_size('thumb_listing_classic',540,360, true); //Blog Normal classic
add_image_size('thumb_listing_classic_mobile',226,150, true); //Blog Normal classic in mobile
add_image_size('thumb_listing_masonry',380,253, true); // masonry
add_image_size('thumb_listing_masonry_modern',380,9999, false); // masonry
add_image_size('thumb_720x455',720,455, true); //Post tab Carousel Header
add_image_size('thumb_80x80',80,80, true); //Image Navigate Slider Gallery Layout 2
add_image_size('thumb_520x388',520,388, true); //Image Related Project
add_image_size('thumb_720x534',720,534, true); //Project Listing Feature Image.
add_image_size('thumb_640x9999',640,9999, false); // Gallery Shortcode

/**
 * Enqueue scripts and styles.
 */
function cactus_scripts() {
	//wp_enqueue_style( 'cactus-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', esc_url(get_template_directory_uri() . '/css/bootstrap.min.css'));
	wp_enqueue_style( 'font-awesome', esc_url(get_template_directory_uri() . '/css/fonts/css/font-awesome.min.css'));

	//owl carousel css
	wp_enqueue_style( 'owl-carousel', esc_url(get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css'), array(), '20141105' );
	wp_enqueue_style( 'owl-theme', esc_url(get_template_directory_uri() . '/js/owl-carousel/owl.theme.css'), array(), '20141105' );
	wp_enqueue_style( 'owl-transition', esc_url(get_template_directory_uri() . '/js/owl-carousel/owl.transitions.css'), array(), '20141105' );

	//bg-slider css
	wp_enqueue_style( 'bg-slider', esc_url(get_template_directory_uri() . '/js/bg-slider/bg-slider.css'), array(), '20141105' );

    if(is_front_page())
    {
    	$page_on_front = get_option('page_on_front');
    	if($page_on_front == 0 || $page_on_front == '')
    	{
        	$theme_layout = ot_get_option('theme_layout', 'standard');
        	$header_layout =  ot_get_option('header_layout', 'static_text_biography');
    	}
    	else
    	{
        	$theme_layout = get_post_meta(get_the_ID(),'theme_layout',true) != '' ? get_post_meta(get_the_ID(),'theme_layout',true) : 'standard';
        	$header_layout =  get_post_meta(get_the_ID(),'header_layout',true) != '' ? get_post_meta(get_the_ID(),'header_layout',true) : 'static_text_biography' ;
    	}

    }
    else if(is_page_template('page-templates/front-page.php'))
    {
        $theme_layout = get_post_meta(get_the_ID(),'theme_layout',true) != '' ? get_post_meta(get_the_ID(),'theme_layout',true) : 'standard';
        $header_layout =  get_post_meta(get_the_ID(),'header_layout',true) != '' ? get_post_meta(get_the_ID(),'header_layout',true) : 'static_text_biography' ;
    }
    else
    {
		 $theme_layout = ot_get_option('theme_layout', 'standard');
		 $header_layout = '';
    }

    if(!function_exists('op_get'))
		$project_layout = '';
	else
		$project_layout = op_get('c_project_settings','cactus-project-listing-layout');
 	if($header_layout == 'posts_tab' || $theme_layout == 'left_navigation' || $project_layout=='prj_left')
    {
		 //scroll css - listing index v4 slider
		 wp_enqueue_style( 'custom-scroll-bar', esc_url(get_template_directory_uri() . '/js/malihu-scroll/jquery.mCustomScrollbar.min.css'), array(), '20141105' );

		 //scroll js - listing index v4 slider
		 wp_enqueue_script( 'custom-scroll-bar', esc_url(get_template_directory_uri() . '/js/malihu-scroll/jquery.mCustomScrollbar.concat.min.js'), array(), '20141105', true );
    }

	//load images js when use ajax pagination
	wp_enqueue_script( 'images-load', esc_url(get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js'), array(), '20141105', true );

	/**
	 * Register Google Font
	 */
	$g_fonts = array('Roboto+Slab:400,100,300,700');

	$google_font = ot_get_option('google_font');
	$font_subset = '';
	if($google_font == 'on')
	{
		$body_font = ot_get_option('main_font_family',''); // for example, Playfair+Display:900
		if($body_font != '')
		{
			$font_subset = get_google_font_subset($body_font);
			array_push($g_fonts, remove_google_font_subset($body_font));
		}
		else
		{
			array_push($g_fonts, 'Crimson+Text:400,400italic,700,700italic');
		}

		$heading_font = ot_get_option('heading_font_family',''); // for example, Playfair+Display:900
		if($heading_font != '')
		{
			$font_subset = get_google_font_subset($heading_font);
			array_push($g_fonts, remove_google_font_subset($heading_font));
		}
		else
		{
			array_push($g_fonts, 'Roboto:400,400italic,500,500italic,700,700italic');
		}
	}
	//google font off
	else
	{
		array_push($g_fonts, 'Crimson+Text:400,400italic,700,700italic');
		array_push($g_fonts, 'Roboto:400,400italic,500,500italic,700,700italic');
	}
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=' . implode('|',$g_fonts) . ($font_subset != '' ? '&'.$font_subset : ''));

	/**
	 * Right To Left CSS
	 */
	wp_enqueue_style( 'style', esc_url(get_template_directory_uri() . '/style.css'));
	if(ot_get_option('rtl') == 'on'){
		wp_enqueue_style( 'rtl', esc_url(get_template_directory_uri() . '/rtl.css'));
	}

	wp_enqueue_script( 'jquery'); // use default jQuery packed inside WordPress. If newer version is needed, this should be dequeue and enqueue again

	wp_enqueue_script( 'bootstrap', esc_url(get_template_directory_uri() . '/js/bootstrap.min.js'), array( 'jquery' ), '3.1.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//owl carousel js
	wp_enqueue_script( 'owl-carousel', esc_url(get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js'), array( 'jquery' ), '20141105', true);

	//carouFredSel js - single post
	wp_enqueue_script( 'carouFredSel', esc_url(get_template_directory_uri() . '/js/carouFredSel/jquery.carouFredSel-6.2.1-packed.js'), array( 'jquery' ), '20141105', true);

	//touch-swipe js - single post
	wp_enqueue_script( 'touch-swipe', esc_url(get_template_directory_uri() . '/js/touch-swipe/jquery.touchSwipe.min.js'), array( 'jquery' ), '20141105', true);

	//bg-slider js
	wp_enqueue_script( 'bg-slider', esc_url(get_template_directory_uri() . '/js/bg-slider/bg-slider.js'), array( 'jquery' ), '20141105', true );

	//isotope js
	wp_enqueue_script( 'isotope', esc_url(get_template_directory_uri() . '/js/isotope/isotope.pkgd.min.js'), array( 'jquery' ), '20141105', true);

	// code to embed the java script file that makes the Ajax request
	wp_enqueue_script( 'ajax-request', esc_url(get_template_directory_uri() . '/js/ajax.js'), array( 'jquery' ));

	// main theme javascript code
	wp_enqueue_script( 'theme-js', esc_url(get_template_directory_uri() . '/js/template.js'), array( 'jquery' ), '20141105', true);

	// code to declare the URL to the file handling the AJAX request <p></p>
	$js_params = array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) );
	global $wp_query, $wp;
	$js_params['query_vars'] = $wp_query->query_vars;
	$js_params['current_url'] =  home_url($wp->request);

	wp_localize_script( 'ajax-request', 'cactus', $js_params  );

}
add_action( 'wp_enqueue_scripts', 'cactus_scripts' );


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom WP Footer
 */
add_action('wp_footer','cactus_wp_foot',100);
if(!function_exists('cactus_wp_foot')){
	function cactus_wp_foot(){
		// write out custom code
		$custom_code = ot_get_option('custom_code','');
		echo balancetags($custom_code);
	}
}

add_action('wp_head','cactus_wp_head',100);
if(!function_exists('cactus_wp_head')){
	function cactus_wp_head(){
		echo '<!-- custom css -->
				<style type="text/css">';

		require get_template_directory() . '/css/custom.css.php';

		echo '</style>
			<!-- end custom css -->';
	}
}

// Custom background
add_action('wp_head','cactus_wp_head_change_bg',100);
if(!function_exists('cactus_wp_head_change_bg')){
	function cactus_wp_head_change_bg(){
		// theme options background
		$background 	= array();
		$background 	= ot_get_option('page_background', array());
		if(is_single() || is_page())
		{
			$background 	= get_post_meta(get_the_ID(),'page_background',true);
			$background 	= $background != '' ? $background : array();
			if(count($background) == 0 || (count($background) > 0 && ($background['background-color'] == '' && $background['background-image'] == '')))
			{
				$background 	= ot_get_option('page_background', array());
			}
		}
		else if(is_category())
		{
			$category 							= get_category( get_query_var( 'cat' ) );
			$cat_id 							= $category->cat_ID;
			$background['background-color'] 	=	get_option('cat_background_color_' . $cat_id) != '' ? '#' . get_option('cat_background_color_' . $cat_id) : '';
			$background['background-repeat'] 	=	get_option('cat_background_repeat_' . $cat_id);
			$background['background-attachment']=	get_option('cat_background_attachment_' . $cat_id);
			$background['background-position'] 	=	get_option('cat_background_position_' . $cat_id);
			$background['background-size'] 		=	get_option('cat_background_size_' . $cat_id);
			$background['background-image']		=	get_option('category_background_' . $cat_id);
			if(($background['background-color'] == '#EDEDED' || $background['background-color'] == '') && $background['background-image'] == '')
			{
				$background 	= ot_get_option('page_background', array());
			}

		}
		else if(is_author())
		{
			$author 							= get_userdata( get_query_var('author') );
			$author_id 							= $author->ID;
			$background['background-color'] 	=	get_the_author_meta('author_background_color') != '' ? '#' . get_the_author_meta('author_background_color') : '';
			$background['background-repeat'] 	=	get_the_author_meta('author_background_repeat');
			$background['background-attachment']=	get_the_author_meta('author_background_attachment');
			$background['background-position'] 	=	get_the_author_meta('author_background_position');
			$background['background-size'] 		=	get_the_author_meta('author_background_size');
			$background['background-image']		=	get_the_author_meta('page_background');
			if(($background['background-color'] == '#EDEDED' || $background['background-color'] == '') && $background['background-image'] == '')
			{
				$background 	= ot_get_option('page_background', array());
			}
		}

		if(isset($background) && count($background) > 0 && ($background['background-color'] != '' || $background['background-image'] != ''))
		{
			echo '<!-- custom background css -->
				<style type="text/css">';

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
		    {
		        $header_layout =  get_post_meta(get_the_ID(),'header_layout',true) != '' ? get_post_meta(get_the_ID(),'header_layout',true) : 'static_text_biography' ;
		    }
		    else
		    {
				 $header_layout = '';
		    }

		    if($header_layout != 'background_slider')
				echo '.background-color-5c, #cactus-body-container {background-color: transparent;background: transparent;}';
			echo '#body-wrap {';
				if($background['background-color'] != '') { echo 'background-color:' . esc_html($background['background-color']) . ';';}
				if($background['background-repeat'] != '') { echo 'background-repeat:' . esc_html($background['background-repeat']) . ';';}
				if($background['background-attachment'] != '') { echo 'background-attachment:' . esc_html($background['background-attachment']) . ';';}
				if($background['background-position'] != '') { echo 'background-position:' . esc_html($background['background-position']) . ';';}
				if($background['background-size'] != '') { echo 'background-size:' . esc_html($background['background-size']) . ';';}
				if($background['background-image'] != '') { echo 'background-image:url("' . esc_html($background['background-image']) . '")';}
			echo '}';

			echo '</style>
			<!-- end custom background css -->';
		}
	}

}

/*
 * Get label of an option in Option Tree / Theme Options
 */
function get_setting_label_by_id( $id ) {
  if ( empty( $id ) )
    return false;
  $settings = get_option( 'option_tree_settings' );
  if ( empty( $settings['settings'] ) )
    return false;
  foreach( $settings['settings'] as $setting ) {
    if ( $setting['id'] == $id && isset( $setting['label'] ) ) {
      return $setting['label'];
    }
  }
}

/**
 * Print out social accounts link.
 */
if(!function_exists('cactus_print_social_accounts')){
	function cactus_print_social_accounts(){
		/* below are default supported social networks. To support more, add the name of theme option in the array */
		$accounts = array('facebook','youtube','twitter','linkedin','tumblr','google-plus','pinterest','flickr','envelope','rss');
		/* this HTML uses Font Awesome icons */
		?>
		<ul class='social-accounts'>
		<?php
		foreach($accounts as $account){
			$url = ot_get_option($account,'');
			$label = get_setting_label_by_id($account);
			if($url){
				if($account == 'envelope'){
					// this is email account, so use mailto protocol
					$url = 'mailto:' . $url;
				}
			?>
				<li><a <?php echo ($account == 'envelope' ? '' : "target='_blank'");?> href="<?php echo esc_url($url);?>" title='<?php echo esc_attr($label);?>'><i class="fa fa-<?php echo esc_attr($account);?>"></i></a></li>
			<?php }?>
			<?php
		}
		?>
		</ul>
		<?php
	}
}


/**
 * Display Social Share buttons for FaceBook, Twitter, LinkedIn, Google+, Thumblr, Pinterest, Email
 */
if(!function_exists('cactus_print_social_share')){
function cactus_print_social_share($id = false){
	if(!$id){
		$id = get_the_ID();
	}
?>
  		<?php if(ot_get_option('sharing_facebook')=='on'){ ?>
	  		<li class="facebook">
            	<div class="title font-1"><?php esc_html_e('Facebook','cactusthemes');?></div>
	  		 	<a class="trasition-all" title="<?php esc_html_e('Share on Facebook','cactusthemes');?>" href="#" target="_blank" rel="nofollow" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+'<?php echo urlencode(get_permalink($id)); ?>','facebook-share-dialog','width=626,height=436');return false;"><i class="fa fa-facebook"></i>
	  		 	</a>
	  		</li>
    	<?php }

		if(ot_get_option('sharing_twitter')=='on'){ ?>
	    	<li  class="twitter">
            	<div class="title font-1"><?php esc_html_e('Twitter','cactusthemes');?></div>
		    	<a class="trasition-all" href="#" title="<?php esc_html_e('Share on Twitter','cactusthemes');?>" rel="nofollow" target="_blank" onclick="window.open('http://twitter.com/share?text=<?php echo urlencode(get_the_title($id)); ?>                url=<?php echo urlencode(get_permalink($id)); ?>','twitter-share-dialog','width=626,height=436');return false;"><i class="fa fa-twitter"></i>
		    	</a>
	    	</li>
    	<?php }

		if(ot_get_option('sharing_linkedIn')=='on'){ ?>
			   	<li class="linkedin">
                	<div class="title font-1"><?php esc_html_e('LinkedIn','cactusthemes');?></div>
			   	 	<a class="trasition-all" href="#" title="<?php esc_html_e('Share on LinkedIn','cactusthemes');?>" rel="nofollow" target="_blank" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink($id)); ?>&amp;title=<?php echo urlencode(get_the_title($id)); ?>&amp;source=<?php echo urlencode(get_bloginfo('name')); ?>','linkedin-share-dialog','width=626,height=436');return false;"><i class="fa fa-linkedin"></i>
			   	 	</a>
			   	</li>
	   	<?php }

		if(ot_get_option('sharing_tumblr')=='on'){ ?>
		   	<li class="tumblr">
                <div class="title font-1"><?php esc_html_e('Tumblr','cactusthemes');?></div>
		   		<a class="trasition-all" href="#" title="<?php esc_html_e('Share on Tumblr','cactusthemes');?>" rel="nofollow" target="_blank" onclick="window.open('http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink($id)); ?>&amp;name=<?php echo urlencode(get_the_title($id)); ?>','tumblr-share-dialog','width=626,height=436');return false;"><i class="fa fa-tumblr"></i>
		   	   </a>
		   	</li>
    	<?php }

		if(ot_get_option('sharing_google')=='on'){ ?>
	    	 <li class="google-plus">
             	<div class="title font-1"><?php esc_html_e('Google +','cactusthemes');?></div>
	    	 	<a class="trasition-all" href="#" title="<?php esc_html_e('Share on Google Plus','cactusthemes');?>" rel="nofollow" target="_blank" onclick="window.open('https://plus.google.com/share?url=<?php echo urlencode(get_permalink($id)); ?>','googleplus-share-dialog','width=626,height=436');return false;"><i class="fa fa-google-plus"></i>
	    	 	</a>
	    	 </li>
    	 <?php }

		 if(ot_get_option('sharing_pinterest')=='on'){ ?>
	    	 <li class="pinterest">
             	<div class="title font-1"><?php esc_html_e('Pinterest','cactusthemes');?></div>
	    	 	<a class="trasition-all" href="#" title="<?php esc_html_e('Pin this','cactusthemes');?>" rel="nofollow" target="_blank" onclick="window.open('//pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($id)) ?>&amp;media=<?php echo urlencode(wp_get_attachment_url( get_post_thumbnail_id($id))); ?>&amp;description=<?php echo urlencode(get_the_title($id)) ?>','pin-share-dialog','width=626,height=436');return false;"><i class="fa fa-pinterest"></i>
	    	 	</a>
	    	 </li>
    	 <?php }

		 if(ot_get_option('sharing_email')=='on'){ ?>
	    	<li class="email">
            	<div class="title font-1"><?php esc_html_e('Email','cactusthemes');?></div>
		    	<a class="trasition-all" href="mailto:?subject=<?php echo urlencode(get_the_title($id)); ?>&amp;body=<?php echo urlencode(get_permalink($id)); ?>" title="<?php esc_html_e('Email','cactusthemes');?>"><i class="fa fa-envelope-o"></i>
		    	</a>
		   	</li>
	   	<?php }
	}
}


/**
 * Ajax page navigation
 */

// when the request action is 'load_more', the cactus_ajax_load_next_page() will be called
add_action( 'wp_ajax_load_more', 'cactus_ajax_load_next_page' );
add_action( 'wp_ajax_nopriv_load_more', 'cactus_ajax_load_next_page' );

function cactus_ajax_load_next_page() {
	//get blog listing style
	global $blog_layout;

	$blog_layout = isset($_POST['blog_layout']) ? esc_html($_POST['blog_layout']) : '';
	if($blog_layout == '') $blog_layout = ot_get_option('blog_layout','grid');

	//last_index_blog_listing
	global $is_index_blog_listing_ajax;
	$is_index_blog_listing_ajax = true;

    // Get current page
	$page = intval($_POST['page']);

	// number of published sticky posts
	$sticky_posts = get_sticky_posts_count();

	// current query vars
	$vars = $_POST['vars'];

	//last_index_blog_listing
	$last_index_blog_listing = isset($_POST['last_index_blog_listing']) ? intval($_POST['last_index_blog_listing']) : 0;


	// convert string value into corresponding data types
	foreach($vars as $key=>$value){
		if(is_numeric($value)) $vars[$key] = intval($value);
		if($value == 'false') $vars[$key] = false;
		if($value == 'true') $vars[$key] = true;
	}

	// item template file
	$template = esc_html($_POST['template']);

	// Return next page
	$page = intval($page) + 1;

	$posts_per_page = isset($_POST['post_per_page']) ? intval($_POST['post_per_page']) : intval(get_option('posts_per_page'));

	if($page == 0) $page = 1;
	$offset = ($page - 1) * $posts_per_page;
	/*
	 * This is confusing. Just leave it here to later reference
	 *

	if(!$vars['ignore_sticky_posts']){
		$offset += $sticky_posts;
	}
	 *
	 */


	// get more posts per page than necessary to detect if there are more posts
	$args = array('post_status'=>'publish','posts_per_page' => $posts_per_page + 1,'offset' => $offset);
	$args = array_merge($vars,$args);

	// remove unnecessary variables
	unset($args['paged']);
	unset($args['p']);
	unset($args['page']);
	unset($args['pagename']); // this is neccessary in case Posts Page is set to a static page

	$query = new WP_Query($args);

	$idx = 0;
	if ( $query->have_posts() ) {

		while ( $query->have_posts() ) {
			$query->the_post();

			global $index_blog_listing;
			$index_blog_listing     = $query->current_post + $last_index_blog_listing + 1;

			// echo $index_blog_listing;

			$idx = $idx + 1;

			if($idx < $posts_per_page + 1)
				get_template_part( $template, get_post_format() );
		}

		if($query->post_count <= $posts_per_page){
			// there are no more posts
			// print a flag to detect
			echo '<div class="invi no-posts"><!-- --></div>';
		}
	} else {
		// no posts found
	}

	/* Restore original Post Data */
	wp_reset_postdata();

	die('');
}
/* Functions, Hooks, Filters and Registers in Admin */
require_once 'inc/functions-admin.php';

add_action( 'show_user_profile', 'cactus_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'cactus_show_extra_profile_fields' );
function cactus_show_extra_profile_fields( $user ) { ?>
	<h3><?php esc_html_e('Position','cactusthemes') ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="positon"><?php esc_html_e('Position','cactusthemes') ?></label></th>
			<td>
				<input type="text" name="positon" id="positon" value="<?php echo esc_attr( get_the_author_meta( 'positon', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your Position.','cactusthemes')?></span>
			</td>
		</tr>
	</table>

    <h3><?php esc_html_e('Social informations','cactusthemes') ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="twitter"><?php esc_html_e('Twitter','cactusthemes') ?></label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your Twitter profile url.','cactusthemes')?></span>
			</td>
		</tr>
        <tr>
			<th><label for="facebook"><?php esc_html_e('Facebook','cactusthemes') ?></label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your Facebook profile url.','cactusthemes')?></span>
			</td>
		</tr>
        <tr>
			<th><label for="google-plus"><?php esc_html_e('Google+','cactusthemes') ?></label></th>
			<td>
				<input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your Google+ profile url.','cactusthemes')?></span>
			</td>
		</tr>
        <tr>
			<th><label for="email"><?php esc_html_e('Email','cactusthemes') ?></label></th>
			<td>
				<input type="text" name="email" id="email" value="<?php echo esc_attr( get_the_author_meta( 'email', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your Email.','cactusthemes')?></span>
			</td>
		</tr>
	</table>

    <h3><?php esc_html_e('Author Pages Settings','cactusthemes') ?></h3>
   <table class="form-table">
		<tr>
			<th><label for="author_header_background"><?php esc_html_e('Header Background','cactusthemes') ?></label></th>
			<td>
            	<label for="author_header_background">
                    <input id="author_header_background" type="text" size="40" name="author_header_background" value="<?php echo esc_attr( get_the_author_meta( 'author_header_background', $user->ID ) ); ?>" />
                    <input id="upload_image_button" class="button" type="button" value="Upload/Add image" />
                    <input id="remove_image_button" class="button" type="button" value="Remove image" /></br>
                </label>
                <span class="description"><?php esc_html_e('Choose header background for this author page. If empty, default background image in Theme Options will be used (Theme Options > General > Default Background).','cactusthemes')?></span>
			</td>
		</tr>
        <?php
			$img_url = esc_attr( get_the_author_meta( 'author_header_background', $user->ID ) );
			if($img_url !=''){
		?>
        <tr>
        	<th></th>
            <td>
            	<div id="img-upload-wrap">
                    <div id="img-preview">
                        <img src="<?php echo esc_attr( get_the_author_meta( 'author_header_background', $user->ID ) ); ?>" style="width:300px; height:auto;">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
        <?php }?>
            <th><label for="positon"><?php esc_html_e('Header Background Height','cactusthemes') ?></label></th>
            <td>
                <input type="text" name="author_background_height" id="author_background_height" value="<?php echo esc_attr( get_the_author_meta( 'author_background_height', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Enter Header Background Height. If put blank, value taken from theme options (Theme Options > General > Default Background Height). ','cactusthemes')?></span>
            </td>
        </tr>

        <tr>
			<th><label for="page_background"><?php esc_html_e('Page Background','cactusthemes') ?></label></th>
			<td>
            	<label for="page_background">
                    <input id="page_background" type="text" size="40" name="page_background" value="<?php echo esc_attr( get_the_author_meta( 'page_background', $user->ID ) ); ?>" />
                    <input id="upload_image_button1" class="button" type="button" value="Upload/Add image" />
                    <input id="remove_image_button1" class="button" type="button" value="Remove image" /></br>
                </label>
                <span class="description"><?php esc_html_e('Choose background for this author page','cactusthemes')?></span>
			</td>
		</tr>
		<?php
			$page_background = esc_attr( get_the_author_meta( 'page_background', $user->ID ) );
			if($page_background !=''):
		?>
		<tr>
        	<th></th>
            <td>
            	<div id="img-upload-wrap">
                    <div id="img-preview">
                        <img src="<?php echo esc_attr( get_the_author_meta( 'page_background', $user->ID ) ); ?>" style="width:300px; height:auto;">
                    </div>
                </div>
            </td>
        </tr>
    	<?php endif;?>

		<tr>
			<th scope="row" valign="top">
				<label for="author_background_color"><?php esc_html_e('Author Background Color','cactus'); ?></label>
			</th>
			<td>
				<?php
					$author_background_color 		= esc_attr( get_the_author_meta( 'author_background_color', $user->ID ));
					$author_background_color_value 	= $author_background_color == '' ? 'ededed' : $author_background_color;
				?>
	            <input type="text" class="colorpicker" value="<?php echo esc_attr($author_background_color_value); ?>" name="author_background_color"/><br />
				<span class="description"><?php esc_html_e('Choose author background color','cactus'); ?></span>
			</td>
		</tr>

		<tr>
			<th scope="row" valign="top">
				<label for="author_background_repeat"><?php esc_html_e('Author Background Repeat','cactusthemes'); ?></label>
			</th>
			<td>
				<?php $author_background_repeat = esc_attr( get_the_author_meta( 'author_background_repeat', $user->ID ) );?>
				<select name="author_background_repeat">
					<option value="" <?php echo  $author_background_repeat == '' ? 'selected="selected"' : '';?>><?php esc_html_e('background-repeat','cactusthemes'); ?></option>
					<option value="no-repeat" <?php echo  $author_background_repeat == 'no-repeat' ? 'selected="selected"' : '';?>><?php esc_html_e('No Repeat','cactusthemes'); ?></option>
					<option value="repeat" <?php echo  $author_background_repeat == 'repeat' ? 'selected="selected"' : '';?>><?php esc_html_e('Repeat All','cactusthemes'); ?></option>
					<option value="repeat-x" <?php echo  $author_background_repeat == 'repeat-x' ? 'selected="selected"' : '';?>><?php esc_html_e('Repeat Horizontally','cactusthemes'); ?></option>
					<option value="repeat-y" <?php echo  $author_background_repeat == 'repeat-y' ? 'selected="selected"' : '';?>><?php esc_html_e('Repeat Vertically','cactusthemes'); ?></option>
					<option value="inherit" <?php echo  $author_background_repeat == 'inherit' ? 'selected="selected"' : '';?>><?php esc_html_e('Inherit','cactusthemes'); ?></option>
				</select>
				<br />
				<span class="description"><?php esc_html_e('Choose Author background repeat','cactusthemes'); ?></span>
			</td>
		</tr>

		<tr>
			<th scope="row" valign="top">
				<label for="author_background_attachment"><?php esc_html_e('Author Background Attachment','cactusthemes'); ?></label>
			</th>
			<td>
				<?php $author_background_attachment = esc_attr( get_the_author_meta( 'author_background_attachment', $user->ID ) );?>
				<select name="author_background_attachment">
					<option value="" <?php echo  $author_background_attachment == '' ? 'selected="selected"' : '';?>><?php esc_html_e('background-attachment','cactusthemes'); ?></option>
					<option value="fixed" <?php echo  $author_background_attachment == 'fixed' ? 'selected="selected"' : '';?>><?php esc_html_e('Fixed','cactusthemes'); ?></option>
					<option value="scroll" <?php echo  $author_background_attachment == 'scroll' ? 'selected="selected"' : '';?>><?php esc_html_e('Scroll','cactusthemes'); ?></option>
					<option value="inherit" <?php echo  $author_background_attachment == 'inherit' ? 'selected="selected"' : '';?>><?php esc_html_e('Inherit','cactusthemes'); ?></option>
				</select>
				<br />
				<span class="description"><?php esc_html_e('Choose author background attchment','cactusthemes'); ?></span>
			</td>
		</tr>

		<tr>
			<th scope="row" valign="top">
				<label for="author_background_position"><?php esc_html_e('Author Background Position','cactusthemes'); ?></label>
			</th>
			<td>
				<?php $author_background_position = esc_attr( get_the_author_meta( 'author_background_position', $user->ID ) );?>
				<select name="author_background_position">
					<option value="" <?php echo  $author_background_position == '' ? 'selected="selected"' : '';?>><?php esc_html_e('background-position','cactusthemes'); ?></option>
					<option value="left top" <?php echo  $author_background_position == 'left top' ? 'selected="selected"' : '';?>><?php esc_html_e('Left Top','cactusthemes'); ?></option>
					<option value="left center" <?php echo  $author_background_position == 'left center' ? 'selected="selected"' : '';?>><?php esc_html_e('Left Center','cactusthemes'); ?></option>
					<option value="left bottom" <?php echo  $author_background_position == 'left bottom' ? 'selected="selected"' : '';?>><?php esc_html_e('Left Bottom','cactusthemes'); ?></option>
					<option value="center top" <?php echo  $author_background_position == 'center top' ? 'selected="selected"' : '';?>><?php esc_html_e('Center Top','cactusthemes'); ?></option>
					<option value="center center" <?php echo  $author_background_position == 'center center' ? 'selected="selected"' : '';?>><?php esc_html_e('Center Center','cactusthemes'); ?></option>
					<option value="center bottom" <?php echo  $author_background_position == 'center bottom' ? 'selected="selected"' : '';?>><?php esc_html_e('Center Bottom','cactusthemes'); ?></option>
					<option value="right top" <?php echo  $author_background_position == 'right top' ? 'selected="selected"' : '';?>><?php esc_html_e('Right Top','cactusthemes'); ?></option>
					<option value="right center" <?php echo  $author_background_position == 'right center' ? 'selected="selected"' : '';?>><?php esc_html_e('Right Center','cactusthemes'); ?></option>
					<option value="right bottom" <?php echo  $author_background_position == 'right bottom' ? 'selected="selected"' : '';?>><?php esc_html_e('Right Bottom','cactusthemes'); ?></option>
				</select>
				<br />
				<span class="description"><?php esc_html_e('Choose author background position','cactusthemes'); ?></span>
			</td>
		</tr>

		<tr>
			<th scope="row" valign="top">
				<label for="author_background_size"><?php esc_html_e('Author Background Size','cactusthemes'); ?></label>
			</th>
			<td>
	            <input type="text" name="author_background_size" value="<?php echo esc_attr( get_the_author_meta( 'author_background_size', $user->ID ) ); ?>" /><br />
				<span class="description"><?php esc_html_e('Choose author background size','cactusthemes'); ?></span>
			</td>
		</tr>

	</table>

<?php }
add_action( 'personal_options_update', 'cactus_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'cactus_save_extra_profile_fields' );
function cactus_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_user_meta( $user_id, 'positon', sanitize_text_field( $_POST['positon'] ));
	update_user_meta( $user_id, 'twitter', sanitize_text_field( $_POST['twitter'] ));
	update_user_meta( $user_id, 'facebook', sanitize_text_field( $_POST['facebook'] ));
	update_user_meta( $user_id, 'google', sanitize_text_field( $_POST['google'] ));
	update_user_meta( $user_id, 'flickr', sanitize_text_field( $_POST['flickr'] ));
	update_user_meta( $user_id, 'author_header_background', $_POST['author_header_background'] );
	update_user_meta( $user_id, 'author_background_height', $_POST['author_background_height'] );
	update_user_meta( $user_id, 'page_background', $_POST['page_background'] );
	update_user_meta( $user_id, 'author_background_color', $_POST['author_background_color'] );
	update_user_meta( $user_id, 'author_background_repeat', $_POST['author_background_repeat'] );
	update_user_meta( $user_id, 'author_background_attachment', $_POST['author_background_attachment'] );
	update_user_meta( $user_id, 'author_background_position', $_POST['author_background_position'] );
	update_user_meta( $user_id, 'author_background_size', $_POST['author_background_size'] );
	//update_user_meta( $user_id, 'upload_image', $_POST['upload_image'] );
}

/* Custom Upload Image in Author Page*/
add_action('admin_enqueue_scripts', 'cactus_admin_upload');

function cactus_admin_upload() {
        wp_enqueue_media();
}

/*Add Theme Support Menu*/
add_action( 'admin_menu', 'theme_support_menu' );

function theme_support_menu() {
	global $submenu;
    $submenu['tools.php'][] = array('<div id="ct_support_forum">' . esc_html__('CactusThemes - Support Forum', 'cactusthemes') . '</div>', 'manage_options', 'http://ticket.cactusthemes.com/');
    $submenu['tools.php'][] = array('<div id="ct_documentaion">' . esc_html__('CactusThemes - Documentation', 'cactusthemes') . '</div>', 'manage_options', 'http://doc.cactusthemes.com/theblog/');
}

add_action( 'admin_notices', 'print_current_version_msg' );
function print_current_version_msg()
{
	$current_theme = wp_get_theme(PARENT_THEME);
	$current_version =  $current_theme->get('Version');
	echo '<div style="display:none" id="current_version">' . $current_version . '</div>';
}

add_action( 'admin_footer', 'import_sample_data_comfirm' );
function import_sample_data_comfirm()
{
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#ct_support_forum').parent().attr('target','_blank');
        $('#ct_documentaion').parent().attr('target','_blank');
        $('#option-tree-sub-header').append('<span class="option-tree-ui-button left image"></span><span class="option-tree-ui-button left vesion ">ver. ' + $('#current_version').text() + '</span>');

        var import_data_button = $('#import_data_button');

        import_data_button.click(function(event) {
        	/* Act on the event */
     		var import_data_comfirm = $('#import_data_form input[name="import_data_comfirm"]').val();
     		if(import_data_comfirm != '' && import_data_comfirm == 'ok')
     		{

     			var site_url = $('#import_data_form input[name="site_url"]').val();
     			location.href = site_url + '/wp-admin/themes.php?page=ot-theme-options&import_data=true';
     		}
     		else
     			alert('Invalid confirmation word. Please type the word \' ok \' in the confirmation field');
        });

    });
    </script>
    <?php
}

add_action('admin_menu', 'register_import_sample_data_page');

function register_import_sample_data_page() {
	add_submenu_page( 'tools.php', 'CactusThemes - Import Sample Data', 'CactusThemes - Import Sample Data', 'manage_options', 'import-sample-data-page', 'import_sample_data_page_callback' );
}

function import_sample_data_page_callback()
{
	if ( !current_user_can( 'manage_options' ) )
	{
	    global $current_user;
	    $msg = "I'm sorry, " . $current_user->display_name . " I'm afraid I can't do that.";
	    echo '<div class="wrap">' . $msg . '</div>';
	    return false;
	}

	if(isset($_POST['is_submit_import_data_form']) && $_POST['is_submit_import_data_form'] == 'Y')
	{
	    $import_data_comfirm = $_POST['import_data_comfirm'];
	    echo esc_html($import_data_comfirm);
	}

?>
		<div class="wrap"><div id="icon-tools" class="icon32"></div>
			<h2>CactusThemes - Import Sample Data</h2>
		</div>
		<p>Type <strong>'ok'</strong> in the confirmation field and then click the import button:</p>
		<form method="post" id="import_data_form">
			<input type="hidden" name="is_submit_import_data_form" value="Y">
			<input type="hidden" name="site_url" value="<?php echo esc_attr(site_url());?>">
			<input type="text" value="" name="import_data_comfirm" id="import_data_comfirm">
			<p class="submit">
				<input type="button" value="Import" class="button-primary" name="Submit" style="width: 80px;" id="import_data_button">
			</p>
		</form>

<?php
}
/*End Add Theme Support Menu*/

/*Add notice Check update theme*/
	if(ct_check_for_update(PARENT_THEME) == 1){
		add_action( 'admin_notices', 'print_check_update_theme_msg' );
		function print_check_update_theme_msg()
		{
			$current_theme = wp_get_theme(PARENT_THEME);
			$current_version =  $current_theme->get('Version');
			echo '<div class="update-nag">' . esc_html__('TheBlog version ', 'cactusthemes') . $current_version . esc_html__(' is available !', 'cactusthemes') . '
					<a href="/wp-admin/themes.php?page=ot-theme-options&ct_update_theme=true">' . esc_html__('Please update now', 'cactusthemes') . '</a>.</div>';
		}
	}
/*End Add notice Check update theme*/


function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if(!is_plugin_active('option-tree/ot-loader.php'))
{
	if ( ! function_exists( 'ot_get_option' ) )
	{
		function ot_get_option($id, $default_value=null)
		{
			return $default_value;
		}
	}

	if ( ! function_exists( 'ot_settings_id' ) )
	{
		function ot_settings_id()
		{
			return null;
		}
	}

	if ( ! function_exists( 'ot_register_meta_box' ) )
	{
		function ot_register_meta_box()
		{
			return null;
		}
	}
}

if(!is_plugin_active('theblog-shortcode/theblog-shortcode.php'))
{
	if ( ! function_exists( 'cactus_display_ads' ) )
	{
		function cactus_display_ads()
		{
			return null;
		}
	}
}
