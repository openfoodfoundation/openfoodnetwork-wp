<?php

class The_blog_latest_comments_widget extends WP_Widget
{
	function the_blog_latest_comments_widget()
	{
		$options = array(
			'classname' 	=> 'latest_comments',
			'description' 	=> esc_html__('Show Latest Comments', 'cactusthemes')
			);
		$this->WP_Widget('latest_comments_id', 'The Blog - Latest Comments', $options);
	}

	function form($instance)
	{
		$default_value 		= array(
			'title'					=> esc_html__('Latest Comments', 'cactusthemes'),
			'number_of_comments' 	=> '3',
			);
		$instance 				= wp_parse_args((array) $instance, $default_value);
		$title 					= esc_attr($instance['title']);
		$number_of_comments		= esc_attr($instance['number_of_comments']);

		// Create form
		$html 	= '';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Title', 'cactusthemes') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('title') . '" value="' . $title . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Number of comments', 'cactusthemes') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('number_of_comments') . '" value="' . $number_of_comments . '"/>';
		$html  .= '</p>';

		global $allowedposttags;
		$allowattributes = array('class'=>array(),'id'=>array(),'type'=>array(),'name'=>array(),'value'=>array());
		$allowedposttags['input']=$allowattributes;

		echo wp_kses_post($html,$allowedposttags);
	}

	function update($new_instance, $old_instance)
	{
		$instance 							= $old_instance;
		$instance['title'] 					= strip_tags($new_instance['title']);
		$instance['number_of_comments'] 	= strip_tags($new_instance['number_of_comments']);
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
		$number_of_comments 	= $instance['number_of_comments'] != '' ? $instance['number_of_comments'] : '3';

		$options = array(
			'status'		=> 'approve',
			'number' 		=> $number_of_comments,
			'post_status' 	=> 'publish'
		);

		$comments = get_comments( $options );

		echo $before_widget;

		$html = '';
		$html .= '<div class="widget-latest-comments">' . $before_title . $title . $after_title;
		
    	foreach($comments as $comment)
		{
			$html .= '<div class="post-item">
				        <div class="comment-content font-1">
				            <a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . $comment->comment_content . '</a>
				        </div>
				        <div class="post-item-info font-1">
				            <span>' . esc_html__('In', 'cactusthemes') . ' <a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a></span>
				        </div>
				    </div>';
		}
        $html .='</div>';
	    echo $html;

		echo $after_widget;



	}
}

add_action('widgets_init',  create_function('', 'return register_widget("The_blog_latest_comments_widget");'));

?>