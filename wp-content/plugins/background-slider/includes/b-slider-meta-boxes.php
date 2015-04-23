<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'b_slider_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function b_slider_register_meta_boxes( $meta_boxes )
{
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'b_slider_';


	$meta_boxes[] = array(
		'title' => esc_html__( 'Data', 'cactusthemes' ),

		'pages' => array('b-slide' ),

		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Sub-heading', 'cactusthemes' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}sub_heading",
				// Field description (optional)
				'desc'  => esc_html__( 'Sub-heading for Background Slider', 'cactusthemes' ),
				'type'  => 'textarea'
			),
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Link', 'cactusthemes' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}link",
				// Field description (optional)
				'desc'  => esc_html__( 'Link for Background Slider', 'cactusthemes' ),
				'type'  => 'text'
			)
		)
	);
	return $meta_boxes;
}


