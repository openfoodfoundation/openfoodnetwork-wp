<?php

/**
 * Initialize the meta boxes. See /option-tree/assets/theme-mode/demo-meta-boxes.php for reference
 *
 * @package cactus
 */
add_action( 'admin_init', 'cactus_meta_boxes' );

if ( ! function_exists( 'cactus_meta_boxes' ) ){
	function cactus_meta_boxes() {
			$page_meta_boxes_layout_settings = array(
			'id'        => 'page_meta_box_layout_settings',
			'title'     => esc_html__('Layout settings','cactusthemes'),
			'desc'      => '',
			'pages'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					  'id'          => 'page_sidebar',
					  'label'       => esc_html__('Sidebar','cactusthemes'),
					  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','cactusthemes'),
					  'std'         => 'default',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'default',
					      'label'       => esc_html__( 'Default', 'cactusthemes' ),
					      'src'         => ''
					    ),
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
					  'id'          => 'page_background',
					  'label'       => esc_html__('Page Background','cactusthemes'),
					  'desc'        => esc_html__('Choose background for this page','cactusthemes'),
					  'std'         => 'default',
					  'type'        => 'background'
				)
			 )
			);

			$page_meta_boxes_front_page_layout = array(
			'id'        => 'page_meta_box_front_page_layout',
			'title'     => esc_html__('Front Page Layout','cactusthemes'),
			'desc'      => '',
			'pages'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					  'id'          => 'theme_layout',
					  'label'       => esc_html__('Main Layout','cactusthemes'),
					  'desc'        => esc_html__('','cactusthemes'),
					  'std'         => 'standard',
					  'type'        => 'select',
					  'choices'     => array(
				            array(
				              'value'       => 'standard',
				              'label'       => esc_html__( 'Standard', 'cactusthemes' ),
				              'src'         => ''
				            ),
				            array(
				              'value'       => 'left_navigation',
				              'label'       => esc_html__( 'Left Navigation', 'cactusthemes' ),
				              'src'         => ''
				            )
						)
					  )
				)
			);

			$page_meta_boxes_front_page_header = array(
			'id'        => 'page_meta_box_front_page_header',
			'title'     => esc_html__('Front Page Header','cactusthemes'),
			'desc'      => '',
			'pages'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					  'id'          => 'front_page_heading',
					  'label'       => esc_html__('Front-page Heading ', 'cactusthemes' ),
			          'desc'        => esc_html__('Enter heading text for front-page. Leave empty if you don\'t want to show it', 'cactusthemes' ),
			          'std'         => esc_html__('', 'cactusthemes' ),
					  'type'        => 'text'
				),
				array(
					  'id'          => 'header_layout',
					  'label'       => esc_html__('Header Layout','cactusthemes'),
					  'desc'        => esc_html__('','cactusthemes'),
					  'std'         => 'background_slider',
					  'type'        => 'select',
					  'choices'     => array(
			            array(
			              'value'       => 'background_slider',
			              'label'       => esc_html__( 'Background Slider', 'cactusthemes' ),
			              'src'         => ''
			            ),
			            array(
			              'value'       => 'static_text_biography',
			              'label'       => esc_html__( 'Static Text Biography', 'cactusthemes' ),
			              'src'         => ''
			            ),
			            array(
			              'value'       => 'bottom_posts_carousel',
			              'label'       => esc_html__( 'Bottom Posts Carousel', 'cactusthemes' ),
			              'src'         => ''
			            ),
			            array(
			              'value'       => 'posts_tab',
			              'label'       => esc_html__( 'Posts Tab', 'cactusthemes' ),
			              'src'         => ''
			            ),
			            array(
			              'value'       => 'top_posts_carousel',
			              'label'       => esc_html__( 'Top Posts Carousel', 'cactusthemes' ),
			              'src'         => ''
			            )
			          )
				),
				array(
					  'id'          => 'background_slider_shortcode',
					  'label'       => esc_html__('Background slider shortcode','cactusthemes'),
					  'desc'        => esc_html__('Enter background slider shortcode','cactusthemes'),
					  'std'         => '[b-slider cats="" ids="" number_of_slides="" auto_play="" pagination="" transition="" full_height="" scroll_down_button=""]',
					  'type'        => 'textarea-simple'
				),
				array(
					  'id'          => 'header_static_text_1',
					  'label'       => esc_html__('Static Text - Line 1', 'cactusthemes' ),
			          'desc'        => esc_html__('Enter text in the first line', 'cactusthemes' ),
			          'std'         => esc_html__('Enter text in the first line', 'cactusthemes' ),
					  'type'        => 'text'
				),
				array(
					  'id'          => 'header_static_text_2',
					  'label'       => esc_html__('Static Text - Line 2', 'cactusthemes' ),
			          'desc'        => esc_html__('Enter text in the second line', 'cactusthemes' ),
			          'std'         => esc_html__('Enter text in the second line', 'cactusthemes' ),
					  'type'        => 'text'
				),
				array(
					  'id'          => 'header_static_text_3',
					  'label'       => esc_html__('Static Text - Line 3', 'cactusthemes' ),
			          'desc'        => esc_html__('Enter text in the third line', 'cactusthemes' ),
			          'std'         => esc_html__('Enter text in the third line', 'cactusthemes' ),
					  'type'        => 'text'
				),
				array(
					  'id'          => 'header_background_color',
					  'label'       => esc_html__('Header Background Color', 'cactusthemes' ),
			          'desc'        => esc_html__('choose background color for Author Biography layout', 'cactusthemes' ),
			          'std'         => '',
					  'type'        => 'colorpicker'
				),
				array(
					  'id'          => 'header_carousel_count',
					  'label'       => esc_html__('Header Posts Carousel, Posts Tab - Count', 'cactusthemes' ),
			          'desc'        => esc_html__('Enter number of items to display', 'cactusthemes' ),
					  'std'         => '6',
					  'type'        => 'text'
				),
				array(
					  'id'          => 'header_carousel_categories',
					  'label'       => esc_html__('Header Posts Carousel, Posts Tab - Category', 'cactusthemes' ),
			          'desc'        => esc_html__('Enter category Ids or slugs to get posts from, separated by a comma', 'cactusthemes' ),
					  'std'         => '',
					  'type'        => 'text'
				),
				array(
					  'id'          => 'header_carousel_tags',
					  'label'       => esc_html__('Header Posts Carousel, Posts Tab - Tags', 'cactusthemes' ),
			          'desc'        => esc_html__('Enter tags to get posts from, separated by a comma', 'cactusthemes' ),
					  'std'         => '',
					  'type'        => 'text'
				),
				array(
					  'id'          => 'header_carousel_ids',
					  'label'       => esc_html__('Header Posts Carousel, Posts Tab - IDs', 'cactusthemes' ),
			          'desc'        => esc_html__('Enter post IDs, separated by a comma', 'cactusthemes' ),
					  'std'         => '',
					  'type'        => 'text'
				),
				array(
					  'id'          => 'header_carousel_order_by',
					  'label'       => esc_html__('Header Posts Carousel, Posts Tab - Order by','cactusthemes'),
					  'desc'        => esc_html__('','cactusthemes'),
					  'std'         => 'published_date',
					  'type'        => 'select',
					  'choices'     => array(
			            array(
			              'value'       => 'published_date',
			              'label'       => esc_html__( 'Published Date', 'cactusthemes' ),
			              'src'         => ''
			            ),
			            array(
			              'value'       => 'random',
			              'label'       => esc_html__( 'Random', 'cactusthemes' ),
			              'src'         => ''
			            )
			          )
				)
			 )
			);

			$page_meta_boxes_front_page_content = array(
			'id'        => 'page_meta_box_front_page_content',
			'title'     => esc_html__('Front Page Content','cactusthemes'),
			'desc'      => '',
			'pages'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					  'id'          => 'page_content',
					  'label'       => esc_html__('Content','cactusthemes'),
					  'desc'        => esc_html__('','cactusthemes'),
					  'std'         => 'page_ct',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'page_ct',
					      'label'       => esc_html__( 'This Page Content', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'blog',
					      'label'       => esc_html__( 'Blog(latest post)', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'portfolio',
					      'label'       => esc_html__( 'Portfolio', 'cactusthemes' ),
					      'src'         => ''
					    ),
					  )
				),
				array(
					  'id'          => 'blog_layout',
					  'label'       => esc_html__('Blog Layout','cactusthemes'),
					  'desc'        => esc_html__('','cactusthemes'),
					  'std'         => 'grid',
					  'type'        => 'select',
					  'choices'     => array(
					    array(
					      'value'       => 'grid',
					      'label'       => esc_html__( 'Grid', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'masonry',
					      'label'       => esc_html__( 'Masonry', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'one_column',
					      'label'       => esc_html__( 'One Column', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'normal_classic',
					      'label'       => esc_html__( 'Normal Classic', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'wide_classic',
					      'label'       => esc_html__( 'Wide Classic', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'modern',
					      'label'       => esc_html__( 'Modern', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'masonry_modern',
					      'label'       => esc_html__( 'Masonry  Modern', 'cactusthemes' ),
					      'src'         => ''
					    ),
					  )
				),
				array(
				  'id'          => 'post_categories',
				  'label'       => esc_html__('Post categories', 'cactusthemes' ),
				  'desc'        => esc_html__('Enter category Ids or slugs to get posts from, separated by a comma', 'cactusthemes' ),
				  'std'         => '',
				  'type'        => 'text',
				),
				array(
				  'id'          => 'post_tags',
				  'label'       => esc_html__('Post tags', 'cactusthemes' ),
				  'desc'        => esc_html__('Enter tags to get posts from, separated by a comma', 'cactusthemes' ),
				  'std'         => '',
				  'type'        => 'text',
				),
				array(
				  'id'          => 'post_ids',
				  'label'       => esc_html__('Post Ids', 'cactusthemes' ),
				  'desc'        => esc_html__('Enter post IDs, separated by a comma.If this param is used, other params are ignored', 'cactusthemes' ),
				  'std'         => '',
				  'type'        => 'text',
				),
				array(
					  'id'          => 'order_by',
					  'label'       => esc_html__('Order by','cactusthemes'),
					  'desc'        => esc_html__('','cactusthemes'),
					  'std'         => 'published_date',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'published_date',
					      'label'       => esc_html__( 'Published Date', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'random',
					      'label'       => esc_html__( 'Random', 'cactusthemes' ),
					      'src'         => ''
					    )
					  )
				),
				array(
					  'id'          => 'post_count',
	  				  'label'       => esc_html__('Post Count', 'cactusthemes' ),
	  				  'desc'        => esc_html__('Enter number of posts to display', 'cactusthemes' ),
	  				  'std'         => '9',
	  				  'type'        => 'text',
				),
				array(
					  'id'          => 'portfolio_layout',
					  'label'       => esc_html__('Portfolio layout','cactusthemes'),
					  'desc'        => esc_html__('','cactusthemes'),
					  'std'         => 'prj_list_modern_spacing',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'prj_list_modern_spacing',
					      'label'       => esc_html__( 'Modern With Spacing', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'prj_list_modern_no_spacing',
					      'label'       => esc_html__( 'Modern No Spacing', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'prj_list_masonry_modern',
					      'label'       => esc_html__( 'Masonry Modern With Spacing', 'cactusthemes' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'prj_list_masonry_modern_no_spacing',
					      'label'       => esc_html__( 'Masonry Modern No Spacing', 'cactusthemes' ),
					      'src'         => ''
					    )
					  )
				),
				array(
				  'id'          => 'show_tags_filter',
				  'label'       => esc_html__('Show tags filter','cactusthemes'),
				  'desc'        => esc_html__('','cactusthemes'),
				  'std'         => 'on',
				  'type'        => 'on-off'
				)
			 )
			);


	    	$post_meta_boxes_layout_settings = array(
		  	'id'        => 'post_meta_boxes_layout_settings',
		  	'title'     => esc_html__('Layout settings','cactusthemes'),
		  	'desc'      => '',
		  	'pages'     => array( 'post' ),
		  	'context'   => 'normal',
		  	'priority'  => 'high',
		  	'fields'    => array(
		  		array(
		  			  'id'          => 'post_sidebar',
		  			  'label'       => esc_html__('Sidebar','cactusthemes'),
		  			  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','cactusthemes'),
		  			  'std'         => 'default',
		  			  'type'        => 'select',
		  			  'choices'     => array(
		  			  	array(
		  			      'value'       => 'default',
		  			      'label'       => esc_html__( 'Default', 'cactusthemes' ),
		  			      'src'         => ''
		  			    ),
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
					  'id'          => 'page_background',
					  'label'       => esc_html__('Page Background','cactusthemes'),
					  'desc'        => esc_html__('Choose background for this post','cactusthemes'),
					  'std'         => 'default',
					  'type'        => 'background'
				),
		  		array(
		  			  'id'          => 'post_show_related_post_in_archive',
		  			  'label'       => esc_html__('Show Related Posts in Archive','cactusthemes'),
		  			  'desc'        => esc_html__('Show Related Posts in Archive pages. This setting is effective in classic blog layout only','cactusthemes'),
		  			  'std'         => 'default',
		  			  'type'        => 'select',
		  			  'choices'     => array(
		  			  	array(
		  			      'value'       => 'yes',
		  			      'label'       => esc_html__( 'Yes', 'cactusthemes' ),
		  			      'src'         => ''
		  			    ),
		  			    array(
		  			      'value'       => 'no',
		  			      'label'       => esc_html__( 'No', 'cactusthemes' ),
		  			      'src'         => ''
		  			    )
		  			  )
		  		),
		  		array(
					  'id'          => 'post_standard_layout',
					  'label'       => esc_html__('Layout for Standard Posts','cactusthemes'),
					  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','cactusthemes'),
					  'std'         => 'default',
					  'type'        => 'select',
					  'choices'     => array(
					   array(
						'value'       => 'default',
						'label'       => esc_html__( 'Default', 'cactusthemes' ),
						'src'         => ''
					  ),
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
					),
				),
				array(
					  'id'          => 'post_gallery_layout',
					  'label'       => esc_html__('Layout for Gallery Posts','cactusthemes'),
					  'desc'        => esc_html__('Choose layout for gallery posts. Select "Default" to use settings in Theme Options','cactusthemes'),
					  'std'         => 'default',
					  'type'        => 'select',
					  'choices'     => array(
					   array(
						'value'       => 'default',
						'label'       => esc_html__( 'Default', 'cactusthemes' ),
						'src'         => ''
					  ),
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
					),
				),
				array(
		    	        'id'          => 'post_gallery_v1_slider_height',
		    	        'label'       => esc_html__('Slider Height for Gallery Layout 1','cactusthemes'),
		    	        'desc'        => esc_html__('Height of slider in gallery post layout 1, in pixels. For example: 800','cactusthemes'),
		    	        'std'         => '',
		    	        'type'        => 'text',
		    	        'rows'        => '',
		    	        'post_type'   => '',
		    	        'taxonomy'    => '',
		    	        'min_max_step'=> '',
		    	        'class'       => '',
		    	        'condition'   => '',
		    	        'operator'    => 'and'
		    	      ),
		  	 	),
		    );

			$post_meta_boxes_post_settings = array(
		  	'id'        => 'post_meta_boxes_post_settings',
		  	'title'     => esc_html__('Post Settings','cactusthemes'),
		  	'desc'      => '',
		  	'pages'     => array( 'post' ),
		  	'context'   => 'normal',
		  	'priority'  => 'high',
		  	'fields'    => array(
		  		array(
		  			  'id'          => 'featured_post',
		  			  'label'       => esc_html__('Featured Post','cactusthemes'),
		  			  'desc'        => esc_html__('Make this post featured. Featured posts will appear in Header Posts Carousel','cactusthemes'),
		  			  'std'         => 'no',
		  			  'type'        => 'select',
		  			  'choices'     => array(
		  			    array(
		  			      'value'       => 'no',
		  			      'label'       => esc_html__( 'No', 'cactusthemes' ),
		  			      'src'         => ''
		  			    ),
		  			  	array(
		  			      'value'       => 'yes',
		  			      'label'       => esc_html__( 'Yes', 'cactusthemes' ),
		  			      'src'         => ''
		  			    )
		  			  )
		  		),
				array(
				  'id'          => 'cactus_post_repcolor',
				  'label'       => esc_html__('Representative Color','cactusthemes'),
				  'desc'        => esc_html__('Choose a color that represents this project. It is the color of an item when hovered in a grid listing page','cactusthemes'),
				  'std'         => '',
				  'type'        => 'colorpicker',
				)
		  	 )
		    );

	  ot_register_meta_box( $page_meta_boxes_layout_settings );
	  ot_register_meta_box( $page_meta_boxes_front_page_layout );
	  ot_register_meta_box( $page_meta_boxes_front_page_header );
	  ot_register_meta_box( $page_meta_boxes_front_page_content );
	  ot_register_meta_box( $post_meta_boxes_layout_settings );
	  ot_register_meta_box( $post_meta_boxes_post_settings );
	}
}