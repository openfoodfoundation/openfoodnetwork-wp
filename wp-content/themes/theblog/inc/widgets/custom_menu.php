<?php

class The_blog_custom_menu_widget extends WP_Widget
{
	function the_blog_custom_menu_widget()
	{
		$options = array(
			'classname' 	=> 'custom_menu',
			'description' 	=> esc_html__('Add a custom menu to your sidebar.', 'cactusthemes')
			);
		$this->WP_Widget('custom_menu_id', 'The Blog - Custom Menu', $options);
	}

	/*Copy from default widgets and edit*/
	public function form( $instance )
	{
		$title 			= isset( $instance['title'] ) ? $instance['title'] : 'Menu';
		$nav_menu 		= isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
		$animation 		= isset( $instance['animation'] ) ? $instance['animation'] : 'click';

		// Get menus
		$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'cactusthemes'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>"><?php esc_html_e('Select Menu:', 'cactusthemes'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>" name="<?php echo esc_attr($this->get_field_name('nav_menu')); ?>">
				<option value="0"><?php esc_html_e( '&mdash; Select &mdash;', 'cactusthemes' ); ?></option>
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu, $menu->term_id, false )
					. '>'. esc_html( $menu->name ) . '</option>';
			}
		?>
			</select>
		</p>
		<p>
			<label><?php esc_html_e('Animation:', 'cactusthemes'); ?></label>
			<?php
				$check_click 	= $animation == 'click' ? 'selected="selected"' : '';
				$check_hover 	= $animation == 'hover' ? 'selected="selected"' : '';
			?>
			<select name="<?php echo esc_attr($this->get_field_name('animation')); ?>">
				<option value="click"<?php echo $check_click;?>><?php esc_html_e('Click', 'cactusthemes');?></option>
				<option value="hover"<?php echo $check_hover;?>><?php esc_html_e('Hover', 'cactusthemes');?></option>
			</select>
		</p>
		<?php
		}

	/*Copy from default widgets and edit*/
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		if ( ! empty( $new_instance['animation'] ) ) {
			$instance['animation'] = $new_instance['animation'];
		}
		return $instance;
	}


	/*Copy from default widgets*/
	public function widget($args, $instance) 
	{
		// Get menu
		$nav_menu 	= ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
		$animation 	= $instance['animation'] != '' ? $instance['animation'] : 'click';;

		if ( !$nav_menu )
			return;

		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		echo '<div class="widget-listing-menu">';
		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		// wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu ) );

		$defaults = array(
			'theme_location'  => '',
			'menu'            => $nav_menu,
			'container'       => '',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'listing-sc-content menu font-1 ' . $animation,
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => '',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 2,
			'walker'          => ''
		);
		wp_nav_menu( $defaults );
		echo '</div>';

		echo $args['after_widget'];
	}
}

add_action('widgets_init',  create_function('', 'return register_widget("The_blog_custom_menu_widget");'));

?>