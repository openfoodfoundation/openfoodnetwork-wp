<?php

/**
 * return number of published sticky posts
 */
function get_sticky_posts_count() {
	 global $wpdb;
	 $sticky_posts = array_map( 'absint', (array) get_option('sticky_posts') );
	 return count($sticky_posts) > 0 ? $wpdb->get_var( "SELECT COUNT( 1 ) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND ID IN (".implode(',', $sticky_posts).")" ) : 0;
}

/**
 * Get related posts
 *
 * @params $post_id (optional). If not passed, it will try to get global $post
 */
if(!function_exists('cactus_get_related_posts')){
	function cactus_get_related_posts( $post_id = null ) {
		if(!$post_id){
			global $post;
			if($post) {
				$post_id = $post->ID;
			} else {
				// return if cannot find any post
				return;
			}
		}
		
		$number = ot_get_option('single_related_post_count', 4);
		$related_posts_order_by     = ot_get_option('related_posts_order_by', 'date');
		
		$args = array(
		  	'post_status' => 'publish',
		  	'posts_per_page' => $number,
		  	'orderby' => $related_posts_order_by,
		  	'ignore_sticky_posts' => 1,
			'post__not_in' => array ($post_id)
		);
	  
		$get_related_post_by = ot_get_option('single_related_posts_by', 'categories');
		
		if ($get_related_post_by == 'categories') {
			$categories = wp_get_post_categories($post_id);
			
			$args['category__in'] = $categories;
		} else {
			$posttags = wp_get_post_tags($post_id);
			$array_tags = array();
			if ($posttags) {
				foreach($posttags as $tag) {
					$tags = $tag->term_id ;
					array_push ( $array_tags, $tags);
				}
			}
			
			$args['tag__in'] = $array_tags;
		}
		
		$related_items = new WP_Query( $args );
		
		return $related_items;
	}
}