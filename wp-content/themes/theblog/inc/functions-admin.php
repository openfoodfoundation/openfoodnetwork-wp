<?php
function cactusthemes_admin_scripts() {	
	wp_register_script('admin_template', esc_url(get_template_directory_uri().'/admin/assets/js/admin_template.js'), array('jquery'));
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('admin_template');
}

function cactusthemes_admin_styles() {	
	wp_enqueue_style( 'style-admin', esc_url(get_template_directory_uri().'/admin/assets/css/style.css'));	
}
if(is_admin()){
	add_action('admin_enqueue_scripts', 'cactusthemes_admin_scripts');
	add_action('admin_enqueue_scripts', 'cactusthemes_admin_styles');
	
	/* Add ID and Thumbnail Column to admin listing post n page */
	add_filter('manage_edit-post_columns' , 'ct_add_posts_columns');
	add_filter('manage_edit-page_columns' , 'ct_add_pages_columns');
	add_filter( 'manage_edit-category_columns', 'ct_add_pages_columns' );

	function ct_add_posts_columns($columns) {
		$cols = array_merge(array('id' => esc_html__('ID','cactusthemes')),$columns);
		$cols = array_merge($cols,array('thumbnail'=>esc_html__('Thumbnail')));
		
		return $cols;
	}
	
	function ct_add_pages_columns($columns) {
		$cols = array_merge(array('id' => esc_html__('ID','cactusthemes')),$columns);
		
		return $cols;
	}

	add_action( 'manage_posts_custom_column' , 'ct_set_posts_columns_value', 10, 2 );
	add_action( 'manage_pages_custom_column' , 'ct_set_posts_columns_value', 10, 2 );
	add_filter( 'manage_category_custom_column', 'ct_set_cats_columns_value', 10, 3 );
	function ct_set_posts_columns_value( $column, $post_id ) {
		if ($column == 'id'){
			echo $post_id;
		} else if($column == 'thumbnail'){
			echo get_the_post_thumbnail($post_id,'thumbnail');
		} else if($column == 'startdate'){
			// for event
			$date_str = get_post_meta($post_id,'start_day',true);
			if($date_str != ''){
				$date = date_create_from_format('m/d/Y H:i', $date_str);
				echo $date->format(get_option('date_format'));
			}
		}
	}
	
	function ct_set_cats_columns_value( $value, $name, $cat_id )
	{
		if( 'id' == $name ) 
			echo $cat_id;
	}

	add_action('admin_head', 'custom_admin_styling');
	function custom_admin_styling() {
		echo '<style type="text/css">';
		echo 'th#id{width:30px;}';
		echo '</style>';
	}	
	
	function ct_image_custom_sizes( $sizes ) {
		global $_wp_additional_image_sizes;

		// make the names human friendly by removing dashes and capitalising
		foreach( $_wp_additional_image_sizes as $key => $value ) {
			$custom[ $key ] = ucwords( str_replace( '-', ' ', $key ) );
		}

		return array_merge( $sizes, $custom );
	}
	add_filter( 'image_size_names_choose', 'ct_image_custom_sizes' );/* Add Image Sizes to Media Chooser */
	
	/* Allow to upload custom fonts */
	// add mime types and custom icons!
	function tm_addUploadMimes($mimes) {
		$mimes = array_merge($mimes, array(
		// Fonts Extensions
		'ttf' => 'application/octet-stream',
		'otf' => 'application/octet-stream',
		'eot' => 'application/octet-stream',
		'svg' => 'application/octet-stream',
		'woff' => 'application/octet-stream',
		));
		return $mimes;
    }
    add_filter('upload_mimes', 'tm_addUploadMimes');
}

function ct_login_logo() {
	if($img = ot_get_option('login_logo_image')){
	?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo $img ?>);
			width: 320px;
			height: 120px;
			background-size:auto;
			background-position:center;
        }
    </style>
<?php }
}
add_action( 'login_enqueue_scripts', 'ct_login_logo' );