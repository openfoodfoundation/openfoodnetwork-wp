<?php

class The_blog_social_account_widget extends WP_Widget
{
	function the_blog_social_account_widget()
	{
		$options = array(
			'classname' 	=> 'social_account',
			'description' 	=> esc_html__('Show Social Accounts at Theme Options > Social Accounts', 'cactusthemes')
			);
		$this->WP_Widget('social_account_id', 'The Blog - Social Accounts', $options);
	}

	function form($instance)
	{
		$default_value 		= array(
			'title'					=> esc_html__('Social Accounts', 'cactusthemes')
			);
		$instance 				= wp_parse_args((array) $instance, $default_value);
		$title 					= esc_attr($instance['title']);

		// Create form
		$html 	= '';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Title', 'cactusthemes') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('title') . '" value="' . $title . '"/>';
		$html  .= '</p>';

		echo $html;
	}

	function update($new_instance, $old_instance)
	{
		$instance 							= $old_instance;
		$instance['title'] 					= strip_tags($new_instance['title']);
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

		$title 						= $instance['title'] != '' ? $instance['title'] : esc_html__('Related Posts', 'cactusthemes');

        $social_account = array(
								'facebook',
								'envelope',
								'twitter',
								'linkedin',
								'tumblr',
								'google-plus',
								'pinterest',
								'youtube',
								'flickr',
							);

		$open_link_in_new_tab		= ot_get_option('open_link_in_new_tab') != '' && ot_get_option('open_link_in_new_tab')  == 'on' ? ' target = "_blank"' : '';

		$custom_social_account 		= ot_get_option('custom_social_account') != '' ? ot_get_option('custom_social_account') : array();

		echo $before_widget;

		$html = '';
		$html .= '<div class="widget-social-listing">' . $before_title . $title . $after_title;

    	$html .= '		<ul class="list-inline social-listing">';

    	foreach($social_account as $social)
    	{
    		$link = ot_get_option($social);
    		if($link != '')
    		{
    			if($social == 'envelope')
    			{
    				$html .=   '<li class="email">
	                      <div class="title font-1">' . esc_html__('Email', 'cactusthemes') . '</div>
	                      <a href="mailto:' . $link . '"' . $open_link_in_new_tab . '><i class="fa fa-envelope-o"></i></a>
	                    </li>';
    			}
    			else
    			{
    				$html .=   '<li class="' . $social . '">
	                      <div class="title font-1">' . ucfirst($social) . '</div>
	                      <a href="' . $link . '"' . $open_link_in_new_tab . '><i class="fa fa-' . $social . '"></i></a>
	                    </li>';
    			}
    		}
    	}

    	if(count($custom_social_account) > 0)
    	{
    		foreach($custom_social_account as $account)
    		{
    			$html .=   '<li class="' . sanitize_title($account['title']) . ' default">
	                      <div class="title font-1">' . $account['title'] . '</div>
	                      <a href="' . $account['link'] . '"><i class="fa ' . $account['icon'] . '"></i></a>
	                    </li>';
    		}
    	}

        $html .=		'</ul>';
        $html .='</div>';
	    echo $html;

		echo $after_widget;



	}
}

add_action('widgets_init',  create_function('', 'return register_widget("The_blog_social_account_widget");'));

?>