<?php
defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );

add_action( 'admin_init', 'tm_importer' );
function tm_importer() {
	global $wpdb;
	
	$sample_data_folder = get_template_directory() . '/sample-data/';
	
	if ( current_user_can( 'manage_options' ) && isset($_GET['imported'])){
		add_action( 'admin_notices', 'ct_admin_notice_data_imported' );
	}
	if ( current_user_can( 'manage_options' ) && isset( $_GET['import_data'] ) ) {	
		
		if(!isset($_GET['imported'])){
			
			if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
			
			if ( ! class_exists( 'WP_Importer' ) ) { // if main importer class doesn't exist
				include ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			}

			if ( ! class_exists('WP_Import') ) { // if WP importer doesn't exist
				include get_template_directory() . '/inc/plugins/wordpress-importer/wordpress-importer.php';
			}
			
			// trying to remove old menus
			wp_delete_nav_menu('main-menu');
			wp_delete_nav_menu('footer-menu');
			
			$importer = new WP_Import();

			/* Import Menus, Posts, Pages */
			$theme_xml = $sample_data_folder . 'theblog.xml.gz';
			
			$importer->fetch_attachments = false; /* Fetch sample images */
			ob_start();
			$importer->import($theme_xml);
			ob_end_clean();
			
			/* Setting Menu Locations */
			$locations = get_theme_mod( 'nav_menu_locations' ); // registered menu locations in theme
			$menus = wp_get_nav_menus(); // registered menus

			if($menus) {
				foreach($menus as $menu) { // assign menus to theme locations
					if( $menu->name == 'Main Menu' ) {
						$locations['primary'] = $menu->term_id;
					}
					if( $menu->name == 'Footer Menu' ) {
						$locations['footer'] = $menu->term_id;
					}
				}
			}

			set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations

			$sample_data_uri = get_template_directory_uri() . '/sample-data/';
			/* Import Theme Options */
			$theme_options_txt = $sample_data_uri . 'theme-options.txt'; // theme options data file

			$theme_options_txt = wp_remote_get( $theme_options_txt );
			if(is_array($theme_options_txt)){
				$data = unserialize( base64_decode( $theme_options_txt['body'])  );
				tm_import_themeoptions($data);
			}
			
			/* Import Widget Settings */
			$widgets_json = $sample_data_uri . 'theblog-widgets.json'; // widgets data file
			$widgets_json = wp_remote_get( $widgets_json );
			if(is_array($widgets_json)){
				$widget_data = $widgets_json['body'];
				$import_widgets = tm_import_widgets( $widget_data );
			}
			
			ct_set_widget_logic();
			
			tm_set_reading_options();
			
			ct_set_mega_menu();
			
			// refresh to reset feature image
			wp_redirect( admin_url( 'themes.php?page=ot-theme-options&import_data=true&imported=feature_images' ) );
		} else {
			// try to increase timeout
			set_time_limit(300);
			
			$offset = (isset($_GET['offset']) ? $_GET['offset'] : 0);
			if(!ct_reset_feature_images($offset)){
				wp_redirect( admin_url( 'themes.php?page=ot-theme-options&import_data=true&imported=feature_images&offset=' . (intval($offset) + 20) ) );
			} else {
				// finally redirect to success page
				wp_redirect( admin_url( 'themes.php?page=ot-theme-options&imported=success' ) );
			}
		}		
	}
}

function tm_import_themeoptions($data){
	/* get settings array */
	$settings = get_option( 'option_tree_settings' );
		
	/* validate options */
	if ( is_array( $settings ) ) {
	
	  foreach( $settings['settings'] as $setting ) {
	  
		if ( isset( $data[$setting['id']] ) ) {
		  
		  $content = ot_stripslashes( $data[$setting['id']] );
		  
		  $data[$setting['id']] = ot_validate_setting( $content, $setting['type'], $setting['id'] );
		  
		}
	  
	  }
	
	}
	
	/* execute the action hook and pass the theme options to it */
	do_action( 'ot_before_theme_options_save', $data );
  
	/* update the option tree array */
	update_option( 'option_tree', $data );
}

/* Set reading options */
function tm_set_reading_options(){
	
	$homepage = get_page_by_title( 'Homepage V1' );
	$posts_page = get_page_by_title( 'Blog' );
	if($homepage->ID && $posts_page->ID) {
		update_option('show_on_front', 'page');
		update_option('page_on_front', $homepage->ID); // Front Page
		update_option('page_for_posts', $posts_page->ID); // Blog Page
		update_option('posts_per_page', 12);
	}
}

// Import Widget Settings
// Thanks to http://wordpress.org/plugins/widget-settings-importexport/
function tm_import_widgets($widget_data){
	$json_data = $widget_data;
	$json_data = json_decode( $json_data, true );

	$sidebar_data = $json_data[0];
	$widget_data = $json_data[1];
	
	foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
		$widgets[ $widget_data_title ] = '';
		foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
			if( is_int( $widget_data_key ) ) {
				$widgets[$widget_data_title][$widget_data_key] = 'on';
			}
		}
	}
	unset($widgets[""]);

	foreach ( $sidebar_data as $title => $sidebar ) {
		$count = count( $sidebar );
		for ( $i = 0; $i < $count; $i++ ) {
			$widget = array( );
			$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
			$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
			if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
				unset( $sidebar_data[$title][$i] );
			}
		}
		$sidebar_data[$title] = array_values( $sidebar_data[$title] );
	}

	foreach ( $widgets as $widget_title => $widget_value ) {
		foreach ( $widget_value as $widget_key => $widget_value ) {
			$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
		}
	}

	$sidebar_data = array( array_filter( $sidebar_data ), $widgets );

	tm_parse_import_data( $sidebar_data );
}

function tm_parse_import_data( $import_array ) {
	$sidebars_data = $import_array[0];
	$widget_data = $import_array[1];
	$current_sidebars = get_option( 'sidebars_widgets' );
	$new_widgets = array( );
	foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :
		$current_sidebars[$import_sidebar] = array(); // clear current widgets in sidebar
		
		foreach ( $import_widgets as $import_widget ) :
			//if the sidebar exists
			if ( isset( $current_sidebars[$import_sidebar] ) ) :
				
				$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
				$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
				$current_widget_data = get_option( 'widget_' . $title );
				$new_widget_name = ct_get_new_widget_name( $title, $index );
				$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

				if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
					while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
						$new_index++;
					}
				}
				$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
				if ( array_key_exists( $title, $new_widgets ) ) {
					$new_widgets[$title][$new_index] = $widget_data[$title][$index];
					$multiwidget = $new_widgets[$title]['_multiwidget'];
					unset( $new_widgets[$title]['_multiwidget'] );
					$new_widgets[$title]['_multiwidget'] = $multiwidget;
				} else {
					$current_widget_data[$new_index] = $widget_data[$title][$index];
					$current_multiwidget = $current_widget_data['_multiwidget'];
					$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
					$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
					unset( $current_widget_data['_multiwidget'] );
					$current_widget_data['_multiwidget'] = $multiwidget;
					$new_widgets[$title] = $current_widget_data;
				}

			endif;
		endforeach;
	endforeach;

	if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
		update_option( 'sidebars_widgets', $current_sidebars );

		foreach ( $new_widgets as $title => $content )
			update_option( 'widget_' . $title, $content );

		return true;
	}

	return false;
}

function ct_get_new_widget_name( $widget_name, $widget_index ) {
	$current_sidebars = get_option( 'sidebars_widgets' );
	$all_widget_array = array( );
	foreach ( $current_sidebars as $sidebar => $widgets ) {
		if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
			foreach ( $widgets as $widget ) {
				$all_widget_array[] = $widget;
			}
		}
	}
	while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
		$widget_index++;
	}
	$new_widget_name = $widget_name . '-' . $widget_index;
	return $new_widget_name;
}

/* Run through all posts and reset feature images to the dummy image */
function ct_reset_feature_images($offset){
	$posts = query_posts(array('posts_per_page'=>20,'offset'=>$offset));
	
	if(have_posts()){
	while ( have_posts() ) : the_post();
		if(has_post_thumbnail()){
			if(file_exists(get_attached_file(get_post_thumbnail_id()))) {
				continue;
			}
		}
		
		// download feature image
		$upload_dir = wp_upload_dir();
		$file_name = uniqid('feature_') . '.png';
		copy(dirname(__FILE__) . '/dummy.png', $upload_dir['path'] . '/'. $file_name);
		
		ct_set_featured_image(get_the_ID(), $upload_dir['path'] . '/' . $file_name);
	endwhile;

	wp_reset_query();
		
		return false;
	} else {
		return true;
	}
}

/*
 * $post_id: ID of post which attachment image is set to
 * $filename: absolute path of image on server (in /uploads directory)
 */
function ct_set_featured_image($post_id,$filename) {
	$wp_filetype = wp_check_filetype(basename($filename), null );
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
		'post_content' => '',
		'post_status' => 'inherit'
	);

	$attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
	// you must first include the image.php file
	// for the function wp_generate_attachment_metadata() to work
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	if (wp_update_attachment_metadata( $attach_id,  $attach_data )) {
		set_post_thumbnail($post_id, $attach_id);
	}
}

function ct_set_widget_logic(){
	/*
	global $wp_registered_widgets, $wp_registered_widget_controls, $wl_options;

	// IMPORT ALL OPTIONS
	$import=split("\n",file_get_contents(dirname(__FILE__) . '/widget_logic_options.txt', false));
	if (array_shift($import)=="[START=WIDGET LOGIC OPTIONS]" && array_pop($import)=="[STOP=WIDGET LOGIC OPTIONS]")
	{	foreach ($import as $import_option)
		{	list($key, $value)=split("\t",$import_option);
			$wl_options[$key]=json_decode($value);
		}
		
		$wl_options['msg']= esc_html__('Success! Options file imported','widget-logic');
	}
	else
	{	
		$wl_options['msg']= esc_html__('Invalid options file','widget-logic'); // should never happen here
	}
		
	update_option('widget_logic', $wl_options);
	*/
}

function ct_set_mega_menu(){
	// get menu item with label 'FEATURES' and 'MEGA MENU';
	$items = wp_get_nav_menu_items('main-menu');
	foreach ( (array) $items as $key => $menu_item ) {
		$title = $menu_item->title;
		if($title == 'Mega Menu'){
			$options =  array ( 'menu-item-isMega' => 'off',
										'menu-item-menu_style' => 'preview',
										'menu-item-addSidebar' => 0,
										'menu-item-displayLogic' => 'both' 
									);
			
			delete_post_meta($menu_item->ID, '_mashmenu_options');
			update_post_meta( $menu_item->ID, '_mashmenu_options', $options);
		} else {
			$options =  array ( 'menu-item-isMega' => 'off',
										'menu-item-menu_style' => 'list',
										'menu-item-addSidebar' => 0,
										'menu-item-displayLogic' => 'both' 
									);
			
			delete_post_meta($menu_item->ID, '_mashmenu_options');
			update_post_meta( $menu_item->ID, '_mashmenu_options', $options);
		}
	}
}

function ct_admin_notice_data_imported(){
	?>
	<div class="updated">
        <p><?php esc_html_e( 'Sample data imported!', 'cactus' ); ?></p>
    </div>
	<?php
}