<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cactus
 */

if ( ! function_exists( 'cactus_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @params $content_div & $template are passed to Ajax pagination
 */
function cactus_paging_nav($content_div = '#main', $template = 'html/loop/content') {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	
	$nav_type = ot_get_option('navigation','def');
	switch($nav_type){
		case 'def':
			cacus_paging_nav_default();
			break;
		case 'ajax':
			cacus_paging_nav_ajax($content_div, $template);
			break;
		case 'wp_pagenavi':
			if( ! function_exists( 'wp_pagenavi' ) ) {	
				// fall back to default navigation style
				cacus_paging_nav_default(); 
			} else {
				wp_pagenavi();
			}
			break;
	}
}
endif;

if ( ! function_exists( 'cacus_paging_nav_default' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable. Default WordPress style
 */
function cacus_paging_nav_default() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	
	?>
	<div class='wp-pagenavi'>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'cactusthemes' ); ?></h1>
			<div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'cactusthemes' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'cactusthemes' ) ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
	</div>
	<?php
}
endif;

if ( ! function_exists( 'cacus_paging_nav_ajax' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable. Ajax loading
 *
 * @params $content_div (string) - ID of the DIV which contains items
 * @params $template (string) - name of the template file that hold HTML for a single item. It will look for specific post-format template files
			For example, if $template = 'content'
				it will look for content-$post_format.php first (i.e content-video.php, content-audio.php...)
				then it will look for content.php if no post-format template is found
*/
function cacus_paging_nav_ajax($content_div = '#main', $template = 'content') {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	
	?>
	<nav class="navigation-ajax" role="navigation">
		<div class="wp-pagenavi">
			<a href="javascript:void(0)" data-target="<?php echo esc_attr($content_div);?>" data-template="<?php echo esc_attr($template); ?>" id="navigation-ajax" class="load-more btn btn-default font-1">
				<div class="load-title"><?php echo esc_html__('Load more articles','cactusthemes');?></div>
				<i class="fa fa-refresh hide" id="load-spin"></i>
			</a>
		</div>
	</nav>
	
	<?php
}
endif;

if ( ! function_exists( 'cactus_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function cactus_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$checkClassFix = false;

	if ( ! $next && ! $previous ) {
		return;
	}
	if (!$next || !$previous) {
		$checkClassFix=true;
	}
	?>
	<div class="n-p-posts <?php if($checkClassFix) { echo 'fixonecolumn';} ?>">
                <?php
                    previous_post_link( ' <div class="p-post">%link</div> ', __( ' <span class="nav-bt font-1">Previous</span> <span class="nav-title font-1"> %title </span> ','cactusthemes' ) );
                    next_post_link(	' <div class="n-post">%link</div> ',     __( ' <span class="nav-bt font-1">Next</span> <span class="nav-title font-1"> %title </span> ','cactusthemes' ) );
                ?>
    </div><!-- .n-p-posts -->
	<?php
}
endif;

if ( ! function_exists( 'cactus_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function cactus_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">%1$s</span><span class="byline"> by %2$s</span>', 'cactusthemes' ),
		sprintf( '%2$s',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function cactus_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'cactus_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'cactus_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so cactus_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so cactus_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in cactus_categorized_blog.
 */
function cactus_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'cactus_categories' );
}
add_action( 'edit_category', 'cactus_category_transient_flusher' );
add_action( 'save_post',     'cactus_category_transient_flusher' );
