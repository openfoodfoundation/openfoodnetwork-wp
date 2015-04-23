<?php
/*
Plugin Name: Background Slider
Plugin URI: http://www.cactusthemes.com/
Description: A full-screen image slider that comes with The Blog - Multi Concept Blog & Portfolio theme
Version: 1.2
Author: CactusThemes
Author URI: http://www.cactusthemes.com/
License: Commercial
*/

// check version
global $wp_version;

if( ! class_exists( 'RW_Meta_Box' ) ) {
	include plugin_dir_path( __FILE__ ) . 'includes/custom-meta-box/meta-box.php';
	include plugin_dir_path( __FILE__ ) . 'includes/b-slider-meta-boxes.php';
}

class Background_Slider
{
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'background_slider_frontend_scripts' ) );
		add_action( 'init', array( $this, 'background_slider_custom_post_type' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'background_slider_custom_columns' ) );

		add_filter( 'manage_b-slide_posts_columns', array( $this, 'background_slider_edit_columns' ) );

		add_filter( 'manage_edit-slider_cat_columns', array( $this, 'slider_cat_custom_columns') );
		add_filter( 'manage_slider_cat_custom_column', array( $this, 'slider_cat_custom_column'), 10, 3 );

		add_shortcode( 'b-slider', array( $this, 'shortcode_background_slider' ) );

	}

	/*
	 * Enqueue Styles and Scripts
	 */
	function background_slider_frontend_scripts()
	{

		//owl carousel css
		wp_enqueue_style( 'owl-carousel', plugins_url( "libraries/owl-carousel/owl.carousel.css", __FILE__ ), array(), '20141105' );
		wp_enqueue_style( 'owl-theme', plugins_url( "libraries/owl-carousel/owl.theme.css", __FILE__ ), array(), '20141105' );
		wp_enqueue_style( 'owl-transition', plugins_url( "libraries/owl-carousel/owl.transitions.css", __FILE__ ), array(), '20141105' );

		//owl carousel js
		wp_enqueue_script( 'owl-carousel', plugins_url( "libraries/owl-carousel/owl.carousel.min.js", __FILE__ ), array(), '20141105', true);

		//main css
		wp_enqueue_style( 'bg-slider', plugins_url( "css/bg-slider.css", __FILE__ ), array(), '20141105' );

		//main js
		wp_enqueue_script( 'bg-slider', plugins_url( "js/bg-slider.js", __FILE__ ), array(), '20141105', true);

		//font
		wp_enqueue_style( 'bg-slider-g-fonts', 'http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,900,900italic,100,100italic,300,300italic|Crimson+Text:400,400italic,600,600italic,700,700italic|Roboto+Slab:400,100,300,700');
	}

	function shortcode_background_slider($atts, $content = "")
	{
		$cat                    = isset($atts['cats']) && $atts['cats'] != '' ? $atts['cats'] : '';
		$slide_ids				= isset($atts['ids']) && $atts['ids'] != '' ? $atts['ids'] : '';
		$auto_play 				= isset($atts['auto_play']) && $atts['auto_play'] != '' ? $atts['auto_play'] : '5000';
		$pagination 			= isset($atts['pagination']) && $atts['pagination'] != '' ? $atts['pagination'] : '0';
		$transition 			= isset($atts['transition']) && $atts['transition'] != '' ? $atts['transition'] : 'fade';
		$full_height 			= isset($atts['full_height']) && $atts['full_height'] != '' ? $atts['full_height'] : '1';
		$number_of_slides 		= isset($atts['number_of_slides']) && $atts['number_of_slides'] != '' ? $atts['number_of_slides'] : '5';
		$scroll_down_button 	= isset($atts['scroll_down_button']) && $atts['scroll_down_button'] != '' ? $atts['scroll_down_button'] : '1';
		$type 					= isset($atts['type']) && $atts['type'] != '' ? $atts['type'] : 'b-slide';
		$orderby 				= isset($atts['orderby']) && $atts['orderby'] != '' ? $atts['orderby'] : 'date';
		$order 					= isset($atts['order']) && $atts['order'] != '' ? $atts['order'] : 'DESC';



		$options = array(
			'post_type' 			=> $type,
			'posts_per_page' 		=> $number_of_slides,
			'post_status' 			=> 'publish',
			'ignore_sticky_posts' 	=> true
		);


		// if setup slide_ids param
		if(isset($slide_ids) && $slide_ids == '')
		{
			if(isset($cat) && $cat != '')
			{
				$cats = explode(",",$cat);
				if($type == 'b-slide')
				{
					if(is_numeric($cats[0]))
					{
						$options['tax_query'] = array(
								array(
									'taxonomy' => 'slider_cat',
									'field'    => 'id',
									'terms'    => $cats,
								),
							);
					}
					else
					{
						$options['tax_query'] = array(
								array(
									'taxonomy' => 'slider_cat',
									'field'    => 'slug',
									'terms'    => $cats,
								),
							);
					}
				}
				// type is post
				else
				{
					if(isset($cat) && $cat != '')
					{
						if(is_numeric($cats[0]))
							$options['category__in'] = $cats;
						else
							$options['category_name'] = $cat;
					}
				}
			}
			$options['orderby'] = $orderby;
			$options['order'] 	= $order;
		}
		else
		{
			$ids = explode(",",$slide_ids);
			if(is_numeric($ids[0]))
				$options['post__in'] = $ids;
			$options['orderby'] = 'post__in';
		}

		$the_query = new WP_Query( $options );


		$output = '';
		$output .= '<div class="cactus-wraper-slider-bg">
					    <div class="slider cactus-slider-single cactus-background-color-2" data-auto-play="' . $auto_play . '" data-pagination="' . $pagination . '" data-transition="' . $transition . '" data-full-height="' . $full_height . '">';


		if($the_query->have_posts())
		{
			while($the_query->have_posts())
			{
				$the_query->the_post();
				//get images thumbnail and alt text
				$img_id     = get_post_thumbnail_id();
				$image      = wp_get_attachment_image_src($img_id, 'full');
				if($image[0] == '')
				    $image[0] = plugins_url( "/images/default_image.jpg", __FILE__ );
				$alt_text   = get_post_meta($img_id , '_wp_attachment_image_alt', true);

				if($type == 'b-slide')
				{
					$title 			= rwmb_meta( 'b_slider_link',array(), get_the_ID()) != '' ? '<a href="' . esc_url(rwmb_meta( 'b_slider_link',array(), get_the_ID())) . '"><span>' . get_the_title() . '</span></a>' : '<span>' . get_the_title() . '</span>';
					$content 		= '<span>' . get_the_content() . '</span>';
					$sub_heading 	= '<span>' . rwmb_meta( 'b_slider_sub_heading',array(), get_the_ID()) . '</span>';

				}
				else
				{
					$title 			= '<a href="' . esc_url(get_the_permalink()) . '"><span>' . get_the_title() . '</span></a>';
					$categories 	= get_the_category();
					$cat_html 		= '';
					if($categories)
					{
						$temp = '';
						foreach($categories as $category)
						{
							$cat_name 	= $category->cat_name;
							$cat_id 	= $category->cat_ID;
							$cat_url 	= get_category_link( $cat_id );
							if($temp == '')
							{
								$temp = ', ';
								$cat_html 	.= '<a href="'.$cat_url.'"><span>'.$cat_name.'</span></a>';
							}
							else
							{
								$cat_html 	.= $temp . '<a href="'.$cat_url.'"><span>'.$cat_name.'</span></a>';
							}
						}
					}
					$content 		= $cat_html;
					$sub_heading 	=  esc_html__('By ', 'cactusthemes') .'<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><span>' . get_the_author()  . '</span></a>';
				}


    			$output .='	<div class="slider-item is-parallax" data-bg-img="' . $image[0] . '" data-div-height="700px">

				            <div class="thumb-overlay cactus-background-color-2"></div>

				            <div class="container">
				                <div class="row">

				                    <div class="text-content">
				                        <div class="text-1">' . $content . '</div>
				                        <div class="text-2 cactus-font-3 col-md-12">' . $title . '</div>
				                        <div class="clearfix"></div>
				                        <div class="text-3 cactus-color-5b">' . $sub_heading . '</div>
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
				        </div>
				';
			}
			wp_reset_postdata();
		}

		$scroll_down_text = '';
		if(isset($slide_ids) && $slide_ids == '')
		{
			if(isset($cat) && $cat != '')
			{
				if(is_numeric($cats[0]))
				{
					$term = get_term_by( 'id', $cats[0], 'slider_cat' );
				}
				else
				{
					$term = get_term_by( 'slug', $cats[0], 'slider_cat' );
				}

				if(is_object($term)){
				$term_id = $term->term_id;
				$term_meta = get_option( "term_meta$term_id" );
				$scroll_down_text = $term_meta['channel_id'];}
			}
			else{
				$scroll_down_text = ot_get_option('background_slider_scrolldown_text', 'scroll down for more');
			}
		}
		else
		{
			$scroll_down_text = ot_get_option('background_slider_scrolldown_text', 'scroll down for more');
		}
		if($scroll_down_text == ''){$scroll_down_text = ot_get_option('background_slider_scrolldown_text', 'scroll down for more');}

		$output .='		</div>';
		if($scroll_down_button == '1')
			$output .='
				    	<div class="scroll-next-div font-1">
					       '.$scroll_down_text.'
					    </div>
					</div>';
		return $output;
	}

	public function background_slider_custom_post_type()
	{

		//$label contain text realated post's name
		$label = array(
			'menu_name'		=> __('Background Slider','cactusthemes'),
			'all_items'		=> __('All Slides','cactusthemes'),
			'name' 			=> __('Background Slides','cactusthemes'),
			'singular_name' => __('Background Slide','cactusthemes')
			);
		//args for custom post type
		$args = array(
			'labels' => $label,
			'description' => __('Post Type for Background Slider','cactusthemes'),
			'supports' => array(
	            'title',
	            'editor',
	            // 'excerpt',
	            // 'author',
	            'thumbnail',
	            // 'comments',
	            // 'trackbacks',
	            // 'revisions',
	            // 'custom-fields'
	        ), //Các tính năng được hỗ trợ trong post type
	        'taxonomies' => array(), //Các taxonomy được phép sử dụng để phân loại nội dung
	        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
	        'public' => true, //Kích hoạt post type
	        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
	        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
	        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
	        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
	        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
	        'menu_icon' => 'dashicons-format-gallery', //Đường dẫn tới icon sẽ hiển thị
	        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
	        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
	        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
	        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
	        'capability_type' => 'post' //
				);

		//register post type
		register_post_type('b-slide', $args);

		/* Register Event Categories */
		$slider_cat_labels = array(
			'name'=>__('Sliders','cactusthemes'),
			'singular_name'=>__('Slider','cactusthemes')
		);

		$slug_cat = 'slidercat';

		register_taxonomy('slider_cat', 'b-slide', array('labels'=>$slider_cat_labels,'show_admin_column'=>true,'hierarchical'=>true,'rewrite'=>array('slug'=> $slug_cat)));
	}


	/**
	*
	* start the Advs listing edit page
	*
	*/
	function background_slider_edit_columns( $columns ) {
		$columns = array(
			'cb' 			=> '<input type="checkbox" />',
			'id' 			=> esc_html__( 'ID', APP_TD ),
			'title' 		=> esc_html__( 'Title', APP_TD ),
			'content' 		=> esc_html__( 'Content', APP_TD ),
			'date' 			=> esc_html__( 'Date', APP_TD ),
			'thumb' 		=> esc_html__( 'Thumbnail', APP_TD ),
		);
		return $columns;
	}

	// return the values for each coupon column on edit.php page
	function background_slider_custom_columns( $column ) {
		global $post;
		switch ( $column ) {
			case 'content' :
				    echo $post->post_content;
				break;
			case 'thumb' :
				    echo get_the_post_thumbnail($post->ID, 'thumbnail');
				break;
		}
	}

	function slider_cat_custom_columns( $columns )
	{
	    $new_columns = array();
	    $new_columns['cb'] = $columns['cb'];
	    $new_columns['ID'] = esc_html__('ID', 'cactusthemes');

	    unset( $columns['cb'] );

	    return array_merge( $new_columns, $columns );
	}

	function slider_cat_custom_column( $columns, $column, $id )
	{
		if($column == "ID")
		    $columns = '<span>' . $id . '</span>';

		return $columns;
	}
}

// custom field taxonomy
function b_slider_taxonomy_custom_fields($tag) {
   // Check for existing taxonomy meta for the term you're editing
	if(is_object($tag)){
		$t_id = $tag->term_id; // Get the ID of the term you're editing
    	$term_meta = get_option( "term_meta$t_id" ); // Do the check
	}else{
		$term_meta = array();
	}
?>

<tr class="form-field">
    <th scope="row" valign="top">
        <label for="channel_id"><?php _e('Scroll Down Text', 'cactusthemes'); ?></label>
    </th>
    <td>
        <input type="text" name="term_meta[channel_id]" id="term_meta[channel_id]" size="25" style="width:60%;" value="<?php echo isset($term_meta['channel_id']) ? $term_meta['channel_id'] : ''; ?>"><br />
    </td>
</tr>

<?php
}
// A callback function to save our extra taxonomy field(s)
function save_b_slider_taxonomy_custom_fields( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "term_meta$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ){
            if ( isset( $_POST['term_meta'][$key] ) ){
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        //save the option array
        update_option( "term_meta$t_id", $term_meta );
    }
}
add_action( 'slider_cat_add_form_fields', 'b_slider_taxonomy_custom_fields', 10, 2 );
add_action( 'slider_cat_edit_form_fields', 'b_slider_taxonomy_custom_fields', 10, 2 );

add_action ( 'edited_slider_cat', 'save_b_slider_taxonomy_custom_fields');
add_action( 'created_slider_cat', 'save_b_slider_taxonomy_custom_fields', 10, 2 );

$background_slider = new Background_Slider();


?>
