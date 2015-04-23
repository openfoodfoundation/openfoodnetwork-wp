<?php

class The_blog_related_posts_widget extends WP_Widget
{
	function the_blog_related_posts_widget()
	{
		$options = array(
			'classname' 	=> 'related_posts',
			'description' 	=> esc_html__('Show related posts', 'cactusthemes')
			);
		$this->WP_Widget('related_posts_id', 'The Blog - Related Posts', $options);
	}

	function form($instance)
	{
		$default_value 		= array(
			'title'					=> esc_html__('Related Posts', 'cactusthemes'),
			'category' 				=> '',
			'tags' 					=> '',
			'post_ids' 				=> '',
			'number_of_posts' 		=> '4',
			);
		$instance 				= wp_parse_args((array) $instance, $default_value);
		$title 					= esc_attr($instance['title']);
		$category 				= esc_attr($instance['category']);
		$tags 					= esc_attr($instance['tags']);
		$post_ids 				= esc_attr($instance['post_ids']);
		$number_of_posts		= esc_attr($instance['number_of_posts']);

		// Create form
		$html 	= '';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Title', 'cactusthemes') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('title') . '" value="' . $title . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Category (Category ID or Slug)', 'cactusthemes') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('category') . '" value="' . $category . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Tags', 'cactusthemes') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('tags') . '" value="' . $tags . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Post IDs: (If this param is used, other params are ignored)', 'cactusthemes') . ' </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('post_ids') . '" value="' . $post_ids . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Number of posts', 'cactusthemes') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('number_of_posts') . '" value="' . $number_of_posts . '"/>';
		$html  .= '</p>';

		echo $html;
	}

	function update($new_instance, $old_instance)
	{
		$instance 							= $old_instance;
		$instance['title'] 					= strip_tags($new_instance['title']);
		$instance['category'] 				= strip_tags($new_instance['category']);
		$instance['tags'] 					= strip_tags($new_instance['tags']);
		$instance['post_ids'] 				= strip_tags($new_instance['post_ids']);
		$instance['number_of_posts'] 		= strip_tags($new_instance['number_of_posts']);
		return $instance;
	}

	function widget($args, $instance)
	{
		$direction ='';
		if(ot_get_option( 'rtl', 0)){
			$direction = 'dir="ltr"';
		}
		//extract  this array to use variable below
		extract($args);

		$title 					= $instance['title'] != '' ? $instance['title'] : esc_html__('Related Posts', 'cactusthemes');
		$cat 					= $instance['category'];
		$tags 					= $instance['tags'];
		$post_ids 				= $instance['post_ids'];
		$number_of_posts 		= $instance['number_of_posts'] != '' ? $instance['number_of_posts'] : '4';

		$options = array(
			'post_type' 			=> 'post',
			'posts_per_page' 		=> $number_of_posts,
			'orderby' 				=> 'post_date',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts' 	=> true
		);

		// if you don't setup post_ids param
		if(isset($post_ids) && $post_ids == '')
		{
			if(isset($cat) && $cat != '')
			{
				$cats = explode(",",$cat);
				if(is_numeric($cats[0]))
					$options['cat'] = $cat;
				else
					$options['category_name'] = $cat;
			}
			if(isset($tags) && $tags != '')
			{
				$options['tag'] = $tags;
			}
		}
		else
		{
			$ids = explode(",",$post_ids);
			if(is_numeric($ids[0]))
				$options['post__in'] = $ids;
		}

		$the_query = new WP_Query( $options );

		echo $before_widget;

		$html = '';
		$html .= '<div class="widget-latest-posts">' . $before_title . $title . $after_title;

    	$html .=	'<div class="related-posts-content">';
	    if($the_query->have_posts())
	    {
	    	while($the_query->have_posts())
    		{
    			$the_query->the_post();

    			//get images thumbnail and alt text
    			$img_id     = get_post_thumbnail_id();
    			$image      = wp_get_attachment_image_src($img_id, array('366', '244'));
    			$alt_text   = get_post_meta($img_id , '_wp_attachment_image_alt', true);

                $fix_no_picture_class = $image[0] == '' ? ' fix-no-picture' : '';

                $html .= '<div class="related-posts-item">';

                if($image[0] != '')
                {
					$html .=	'<div class="picture">
					                <a href="' . esc_url(get_permalink()) . '" title="' . get_the_title() . '">
					                    <img alt="' . $alt_text . '" src="' . $image[0] . '">
					                    <div class="thumb-overlay"></div>
					                </a>
					            </div>';
                }

				$html .=   	'<div class="content' . $fix_no_picture_class . '">
				                <span class="title font-1"><a href="' . esc_url(get_permalink()) . '" title="">' . get_the_title() . '</a></span>
				                <span class="time font-1">' . date_i18n(get_option('date_format') ,get_the_time('U')) . '</span>
				            </div>

				        </div>';
    		}
    		wp_reset_postdata();
	    }
        $html .='	</div>
        		</div>';
	    echo $html;

		echo $after_widget;



	}
}

add_action('widgets_init',  create_function('', 'return register_widget("The_blog_related_posts_widget");'));

?>