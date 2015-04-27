<?php

/**
 * Core features for all themes
 *
 * @package cactus
 * @version 1.0 - 2014/13/05
 */

/**
 * Mobile Detector
 *
 */
require get_template_directory() . '/inc/core/classes/mobile-detect.php';

$mobile_detector = new Mobile_Detect;
global $_device_, $_device_name_, $_is_retina_;
$_device_ = $mobile_detector->isMobile() ? ($mobile_detector->isTablet() ? 'tablet' : 'mobile') : 'pc';
$_device_name_ = $mobile_detector->mobileGrade();
$_is_retina_ = $mobile_detector->isRetina();

/**
 * plugin-activation
 */
require_once locate_template('/inc/plugins/plugin-activation/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'tm_acplugins' );
function tm_acplugins($plugins) {

	global $_theme_required_plugins;

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => 'cactusthemes',           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => esc_html__( 'Install Required &amp; Recommended Plugins', 'cactusthemes' ),
            'menu_title'                                => esc_html__( 'Install Plugins', 'cactusthemes' ),
            'installing'                                => esc_html__( 'Installing Plugin: %s', 'cactusthemes' ), // %1$s = plugin name
            'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'cactusthemes' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'cactusthemes' ),
            'plugin_activated'                          => esc_html__( 'Plugin activated successfully.', 'cactusthemes' ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'cactusthemes' ) // %1$s = dashboard link
        )
    );

    tgmpa( $_theme_required_plugins, $config);
}
 /**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_true' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
//add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree Framework.
 */
//load_template( trailingslashit( get_template_directory() ) . '/option-tree/ot-loader.php' );

/**
 * end Option Tree integration
 * To get options, use this code
 * $test_input = ot_get_option( 'test_input', 'default value');
 * $test_array = ot_get_option( 'test_array', array('value 1','value 2')); or
 * $test_array = ot_get_option( 'test_array', array());
 */

require get_template_directory() . '/inc/core/utility-functions.php';
/* Custom Menu Walker */
require_once locate_template('/inc/custom-menu-walker.php');
/* Enable oEmbed in Text/HTML Widgets */
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );

function cactusthemes_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'cactusthemes' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'cactusthemes_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 */
function cactusthemes_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'cactusthemes_page_menu_args' );

if ( ! function_exists( 'cactusthemes_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function cactusthemes_content_nav( $html_id, $custom_query=false ) {
	global $wp_query;
	$current_query = $wp_query;
	if($custom_query){
		$current_query = $custom_query;
	}
	$html_id = esc_attr( $html_id );

	if ( $current_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr($html_id); ?>" class="navigation" role="navigation">
			<div class="nav-previous alignleft"><?php next_posts_link( esc_html__( 'Older posts <span class="meta-nav">&rarr;</span>', 'cactusthemes' ),$current_query->max_num_pages ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( esc_html__( '<span class="meta-nav">&larr;</span> Newer posts', 'cactusthemes' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

add_filter('get_avatar','ct_filter_avatar', 5, 5);
if(!function_exists('ct_filter_avatar')){
	function ct_filter_avatar($avatar, $id_or_email, $size = 66, $default, $alt = false){
		global $_is_retina_;

		if ( ! get_option('show_avatars') )
			return false;

		if ( false === $alt)
			$safe_alt = '';
		else
			$safe_alt = esc_attr( $alt );

		if ( !is_numeric($size) )
			$size = '96';

		$email = '';
		if ( is_numeric($id_or_email) ) {
			$id = (int) $id_or_email;
			$user = get_userdata($id);
			if ( $user )
				$email = $user->user_email;
		} elseif ( is_object($id_or_email) ) {
			// No avatar for pingbacks or trackbacks
			$allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
			if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
				return false;

			if ( !empty($id_or_email->user_id) ) {
				$id = (int) $id_or_email->user_id;
				$user = get_userdata($id);
				if ( $user)
					$email = $user->user_email;
			} elseif ( !empty($id_or_email->comment_author_email) ) {
				$email = $id_or_email->comment_author_email;
			}
		} else {
			$email = $id_or_email;
		}

		if ( empty($default) ) {
			$avatar_default = get_option('avatar_default');
			if ( empty($avatar_default) )
				$default = 'mystery';
			else
				$default = $avatar_default;
		}

		if ( !empty($email) )
			$email_hash = md5( strtolower( trim( $email ) ) );

		if ( is_ssl() ) {
			$host = 'https://secure.gravatar.com';
		} else {
			if ( !empty($email) )
				$host = sprintf( "http://%d.gravatar.com", ( hexdec( $email_hash[0] ) % 2 ) );
			else
				$host = 'http://0.gravatar.com';
		}

		if(strpos($avatar,'avatar-default') > -1){
			if($_is_retina_){
				$default = esc_url(get_template_directory_uri() . '/images/avatar-2x.png');// default avatar in theme
			} else {
				$default = esc_url(get_template_directory_uri() . '/images/avatar.png');// default avatar in theme
			}
		}
		elseif ( 'mystery' == $default ){
			if($_is_retina_){
				$default = esc_url(get_template_directory_uri() . '/images/avatar-2x.png');// default avatar in theme
			} else {
				$default = esc_url(get_template_directory_uri() . '/images/avatar.png');// default avatar in theme
			}
		}
		elseif ( 'blank' == $default )
			$default = $email ? 'blank' : includes_url( 'images/blank.gif' );
		elseif ( !empty($email) && 'gravatar_default' == $default )
			$default = '';
		elseif ( 'gravatar_default' == $default )
			$default = "$host/avatar/?s={$size}";
		elseif ( empty($email) )
			$default = "$host/avatar/?d=$default&amp;s={$size}";
		elseif ( strpos($default, 'http://') === 0 )
			$default = esc_url_raw(add_query_arg( 's', $size, $default ));

		if ( !empty($email) ) {
			$out = "$host/avatar/";
			$out .= $email_hash;
			$out .= '?s='.$size;
			$out .= '&amp;d=' . urlencode( $default );

			$rating = get_option('avatar_rating');
			if ( !empty( $rating ) )
				$out .= "&amp;r={$rating}";

			$out = str_replace( '&#038;', '&amp;', esc_url( $out ) );
			$avatar = "<img alt='{$safe_alt}' src='{$out}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
		} else {
			$avatar = "<img alt='{$safe_alt}' src='{$default}' class='avatar avatar-{$size} photo avatar-default' height='{$size}' width='{$size}' />";
		}
		
		return $avatar;
	}
}

if ( ! function_exists( 'cactusthemes_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own cactusthemes_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function cactusthemes_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
	?>

   <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $args['has_children'] ? 'parent' : '' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<?php printf( __( '%s <span class="says">says:</span>' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'cactusthemes' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'cactusthemes' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'cactusthemes' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
			comment_reply_link( array_merge( $args, array(
				'add_below' => 'div-comment',
				'depth'     => $depth,
				'max_depth' => $args['max_depth'],
				'before'    => '<div class="reply">',
				'after'     => '</div>'
			) ) );
			?>
		</article><!-- .comment-body -->
<?php
}
endif;

if(!function_exists('alter_comment_form_fields')){
	function alter_comment_form_fields($fields){
		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields['author'] = '<div class="cm-form-info"><div class="comment-author-field"><div class="auhthor login"><p class="comment-form-author"><input id="author" name="author" type="text" placeholder="'.($req ? '' : '').esc_html__('Your Name *','cactusthemes').'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="100"' . $aria_req . ' /></p></div>';
		$fields['email'] = '<div class="email login"><p class="comment-form-email"><input id="email" placeholder="'.($req ? '' : '').esc_html__('Your Email *','cactusthemes').'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="100"' . $aria_req . ' /></p></div>';  //removes email field
		$fields['url'] = '<div class="url login"><p class="comment-form-url"><input id="url" placeholder="'.esc_html__('Your Website','cactusthemes').'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="100" /></p></div></div></div>';

		return $fields;
	}

	add_filter('comment_form_default_fields','alter_comment_form_fields');
}

//change comment form
if(!function_exists('comment_form_tm')){
function comment_form_tm( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name','cactusthemes' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email','cactusthemes'  ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website','cactusthemes'  ) . '</label> ' .
		            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s','cactusthemes' ), '<span class="required">*</span>' );

	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	 */
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'cactusthemes' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'cactusthemes' ), wp_login_url( apply_filters( 'the_permalink', esc_url(get_permalink( $post_id ) )) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','cactusthemes'), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', esc_url(get_permalink( $post_id ) )) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.','cactusthemes' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => esc_html__( 'Your comment','cactusthemes' ),
		'title_reply_to'       => esc_html__( 'Leave a Reply to %s','cactusthemes'  ),
		'cancel_reply_link'    => esc_html__( 'Cancel reply','cactusthemes'  ),
		'label_submit'         => esc_html__( 'Post Comment' ,'cactusthemes'),
		'format'               => 'xhtml',
	);

	/**
	 * Filter the comment form default arguments.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php
			/**
			 * Fires before the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_before' );
			?>

			<div id="respond" class="comment-respond">
				<h3 id="reply-title" class="comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php
					/**
					 * Fires after the HTML-formatted 'must log in after' message in the comment form.
					 *
					 * @since 3.0.0
					 */
					do_action( 'comment_form_must_log_in_after' );
					?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
						<?php
						/**
						 * Fires at the top of the comment form, inside the <form> tag.
						 *
						 * @since 3.0.0
						 */
						do_action( 'comment_form_top' );
						?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php
							/**
							 * Filter the 'logged in' message for the comment form for display.
							 *
							 * @since 3.0.0
							 *
							 * @param string $args['logged_in_as'] The logged-in-as HTML-formatted message.
							 * @param array  $commenter            An array containing the comment author's username, email, and URL.
							 * @param string $user_identity        If the commenter is a registered user, the display name, blank otherwise.
							 */
							echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
							?>
							<?php
							/**
							 * Fires after the is_user_logged_in() check in the comment form.
							 *
							 * @since 3.0.0
							 *
							 * @param array  $commenter     An array containing the comment author's username, email, and URL.
							 * @param string $user_identity If the commenter is a registered user, the display name, blank otherwise.
							 */
							do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
							?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							/**
							 * Fires before the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_before_fields' );
							/**
							 * Fires after the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php
						/**
						 * Filter the content of the comment textarea field for display.
						 *
						 * @since 3.0.0
						 *
						 * @param string $args['comment_field'] The content of the comment textarea field.
						 */
						echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
						?>
						<?php echo $args['comment_notes_after'];
						if (!is_user_logged_in() ) :
						foreach ( (array) $args['fields'] as $name => $field ) {
							/**
							 * Filter a comment form field for display.
							 *
							 * The dynamic portion of the filter hook, $name, refers to the name
							 * of the comment form field. Such as 'author', 'email', or 'url'.
							 *
							 * @since 3.0.0
							 *
							 * @param string $field The HTML-formatted output of the comment form field.
							 */
							echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
						}
						endif;


						?>

						<p class="form-submit" style="clear:both">
							<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php
						/**
						 * Fires at the bottom of the comment form, inside the closing </form> tag.
						 *
						 * @since 1.5.2
						 *
						 * @param int $post_id The post ID.
						 */
						do_action( 'comment_form', $post_id );
						?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php
			/**
			 * Fires after the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_after' );
		else :
			/**
			 * Fires after the comment form if comments are closed.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_comments_closed' );
		endif;
}


}
//end

if ( ! function_exists( 'cactusthemes_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own cactusthemes_entry_meta() to override in a child theme.
 */
function cactusthemes_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'cactusthemes' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'cactusthemes' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( date_i18n(get_option('date_format') ,get_the_time('U')) )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'cactusthemes' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'cactusthemes' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'cactusthemes' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'cactusthemes' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function cactusthemes_body_class( $classes ) {
	$background_color = get_background_color();

	if ( ! is_active_sidebar( 'sidebar-1' ) || get_post_meta(get_the_ID(),'header_content_posttype',true)=='full' )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'cactusthemes-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'cactusthemes_body_class' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function cactusthemes_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'cactusthemes_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Twenty Twelve 1.0
 */
function cactusthemes_customize_preview_js() {
	wp_enqueue_script( 'cactusthemes-customizer', esc_url(get_template_directory_uri() . '/js/theme-customizer.js'), array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'cactusthemes_customize_preview_js' );

if(!function_exists('get_dynamic_sidebar')){
	function get_dynamic_sidebar($index = 1){
		$sidebar_contents = "";
		ob_start();
		dynamic_sidebar($index);
		$sidebar_contents = ob_get_clean();
		return $sidebar_contents;
	}
}

// Get custom options for widget
global $wl_cl_options;
if((!$wl_cl_options = get_option('cactusthemes')) || !is_array($wl_cl_options) ) $wl_cl_options = array();

/**
 * Add custom properties to every widget ===================
 *
 * Add: custom-variation textbox for adding CSS classes
 *
 **/

add_action( 'sidebar_admin_setup', 'cactusthemes_expand_control');
// adds in the admin control per widget, but also processes import/export
function cactusthemes_expand_control(){
	global $wp_registered_widgets, $wp_registered_widget_controls, $wl_cl_options;

	// ADD EXTRA CUSTOM FIELDS TO EACH WIDGET CONTROL
	// pop the widget id on the params array (as it's not in the main params so not provided to the callback)
	foreach ( $wp_registered_widgets as $id => $widget )
	{	// controll-less widgets need an empty function so the callback function is called.
		if (!$wp_registered_widget_controls[$id])
			wp_register_widget_control($id,$widget['name'], 'cactusthemes_empty_control');

		$wp_registered_widget_controls[$id]['callback_ct_redirect']=$wp_registered_widget_controls[$id]['callback'];
		$wp_registered_widget_controls[$id]['callback']='ct_widget_add_custom_fields';
		array_push($wp_registered_widget_controls[$id]['params'],$id);
	}

	// UPDATE CUSTOM FIELDS OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-cactusthemes']))
				$wl_cl_options[$widget_id]=trim($_POST[$widget_id.'-cactusthemes']);
	}

	update_option('cactusthemes', $wl_cl_options);
}

/* Empty function for callback - DO NOT DELETE!!! */
function cactusthemes_empty_control() {}

function ct_widget_add_custom_fields() {
	global $wp_registered_widget_controls, $wl_cl_options;

	$params=func_get_args();

	$id=array_pop($params);
	// go to the original control function
	$callback=$wp_registered_widget_controls[$id]['callback_ct_redirect'];
	if (is_callable($callback))
		call_user_func_array($callback, $params);
	$value = !empty( $wl_cl_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_cl_options[$id ] ),ENT_QUOTES ) : '';
	//var_dump(get_option('cactusthemes'));

	// dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	$number=$params[0]['number'];
	if ($number==-1) {$number="__i__"; $value="";}
	$id_disp=$id;
	if (isset($number)) $id_disp=$wp_registered_widget_controls[$id]['id_base'].'-'.$number;

	// output our extra widget logic field
	echo "<p><label for='".$id_disp."-cactusthemes'>".esc_html__('Custom Variation', 'cactusthemes').": <input class='widefat' type='text' name='".$id_disp."-cactusthemes' id='".$id_disp."-cactusthemes' value='".$value."' /></label></p>";
}
/**
 * =================== End Add custom properties to every widget  <<<
 */
/**
 * Hook before widget
 */
if(!is_admin()){
	add_filter('dynamic_sidebar_params', 'cactusthemes_hook_before_widget');
	function cactusthemes_hook_before_widget($params){
		/* Add custom variation classs to widgets */
		global $wl_cl_options;
		$id=$params[0]['widget_id'];
		$classe_to_add = !empty( $wl_cl_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_cl_options[$id ] ),ENT_QUOTES ) : '';

		if(preg_match('/icon-\w+\s*/',$classe_to_add,$matches)){
			if(ot_get_option_core( 'righttoleft', 0)){
				$params[0]['after_title'] = '<i class="'.$matches[0].'"></i>' . $params[0]['after_title'];
			} else {
				$params[0]['before_title'] .= '<i class="'.$matches[0].'"></i>';
			}
			$classe_to_add = str_replace('icon-','wicon-',$classe_to_add); // replace "icon-xxx" class to not add Awesome Icon before div.widget
		};

		if ($params[0]['before_widget'] != ""){
			$classe_to_add = 'class="'.$classe_to_add.' ';
			$params[0]['before_widget'] = str_replace('class="',$classe_to_add,$params[0]['before_widget']);
		}else{
			$classe_to_add = $classe_to_add;
			$params[0]['before_widget'] = '<div class="'.$classe_to_add.'">';
			$params[0]['after_widget'] = '</div>';
		}

		return $params;
	}
}
/*Add custom fields 2*/
// Get custom options for widget
global $wl_options_width;
if((!$wl_options_width = get_option('cactusthemes_width')) || !is_array($wl_options_width) ) $wl_options_width = array();

if ( is_admin() )
{
    add_action( 'sidebar_admin_setup', 'widget_width_expand_control' );
}

// CALLED VIA 'sidebar_admin_setup' ACTION
// adds in the admin control per widget, but also processes import/export
function widget_width_expand_control()
{
    global $wp_registered_widgets, $wp_registered_widget_controls, $wl_options_width;

    // ADD EXTRA WIDGET LOGIC FIELD TO EACH WIDGET CONTROL
    // pop the widget id on the params array (as it's not in the main params so not provided to the callback)
    foreach ( $wp_registered_widgets as $id => $widget )
    {   // controll-less widgets need an empty function so the callback function is called.
        if (!$wp_registered_widget_controls[$id])
            wp_register_widget_control($id,$widget['name'], 'widget_width_empty_control');
        $wp_registered_widget_controls[$id]['callback_width_redirect'] = $wp_registered_widget_controls[$id]['callback'];
        $wp_registered_widget_controls[$id]['callback'] = 'widget_width_extra_control';
        array_push( $wp_registered_widget_controls[$id]['params'], $id );
    }
	// UPDATE CUSTOM FIELDS OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-cactusthemes_width']))
				$wl_options_width[$widget_id]=trim($_POST[$widget_id.'-cactusthemes_width']);
	}

	update_option('cactusthemes_width', $wl_options_width);
}

// added to widget functionality in 'widget_width_expand_control' (above)
function widget_width_empty_control() {}

// added to widget functionality in 'widget_width_expand_control' (above)
function widget_width_extra_control()
{
    global $wp_registered_widget_controls, $wl_options_width;

    $params = func_get_args();
    $id = array_pop($params);

    // go to the original control function
    $callback = $wp_registered_widget_controls[$id]['callback_width_redirect'];
    if ( is_callable($callback) )
        call_user_func_array($callback, $params);

    $value = !empty( $wl_options_width[$id] ) ? htmlspecialchars( stripslashes( $wl_options_width[$id ] ),ENT_QUOTES ) : '';

    // dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	if(isset($params[0]['number']))
		$number = $params[0]['number'];
    if ($number == -1) {
        $number = "%i%";
        $value = "";
    }
    $id_disp=$id;
    if ( isset($number) )
        $id_disp = $wp_registered_widget_controls[$id]['id_base'].'-'.$number;
    // output our extra widget logic field
    echo "
	<p class='uni-footer-width' id='uni-".$id_disp."'><label for='".$id_disp."-cactusthemes_width'>".esc_html__('Widget width', 'cactusthemes').":
	<select name='".$id_disp."-cactusthemes_width' id='".$id_disp."-cactusthemes_width'>
	  <option value='col-md-12' ".($value=='col-md-12'?'selected="selected"':'').">col-md-12</option>
	  <option value='col-md-11' ".($value=='col-md-11'?'selected="selected"':'').">col-md-11</option>
	  <option value='col-md-10' ".($value=='col-md-10'?'selected="selected"':'').">col-md-10</option>
	  <option value='col-md-9' ".($value=='col-md-9'?'selected="selected"':'').">col-md-9</option>
	  <option value='col-md-8' ".($value=='col-md-8'?'selected="selected"':'').">col-md-8</option>
	  <option value='col-md-7' ".($value=='col-md-7'?'selected="selected"':'').">col-md-7</option>
	  <option value='col-md-6' ".($value=='col-md-6'?'selected="selected"':'').">col-md-6</option>
	  <option value='col-md-5' ".($value=='col-md-5'?'selected="selected"':'').">col-md-5</option>
	  <option value='col-md-4' ".($value=='col-md-4'?'selected="selected"':'').">col-md-4</option>
	  <option value='col-md-3' ".($value=='col-md-3'?'selected="selected"':'').">col-md-3</option>
	  <option value='col-md-2' ".($value=='col-md-2'?'selected="selected"':'').">col-md-2</option>
	  <option value='col-md-1' ".($value=='col-md-1'?'selected="selected"':'').">col-md-1</option>
	</select>
	</label></p>";
}
/**
 * Hook before widget
 */
//if(!is_admin()){
	add_filter('dynamic_sidebar_params', 'cactusthemes_hook_before_width_widget');
	function cactusthemes_hook_before_width_widget($params){
		/* Add custom variation classs to widgets */
		global $wl_options_width;
		$id=$params[0]['widget_id'];
		$classe_to_add = !empty( $wl_options_width[$id ] ) ? htmlspecialchars( stripslashes( $wl_options_width[$id ] ),ENT_QUOTES ) : '';

		if(preg_match('/icon-\w+\s*/',$classe_to_add,$matches)){
			if(ot_get_option_core( 'righttoleft', 0)){
				$params[0]['after_title'] = '<i class="'.$matches[0].'"></i>' . $params[0]['after_title'];
			} else {
				$params[0]['before_title'] .= '<i class="'.$matches[0].'"></i>';
			}
			$classe_to_add = str_replace('icon-','wicon-',$classe_to_add); // replace "icon-xxx" class to not add Awesome Icon before div.widget
		};

		if ($params[0]['before_widget'] != ""){
			if($classe_to_add ==''){
				global $wid_def;
				if($wid_def==1){
					$classe_to_add ='col-md-4';
				}else{
					$classe_to_add ='col-md-12';
				}
			}
			$classe_to_add = 'class="'.$classe_to_add.' ';
			//$params[0]['before_widget'] = str_replace('class="',$classe_to_add,$params[0]['before_widget']);
			$params[0]['before_widget'] = implode($classe_to_add, explode('class="', $params[0]['before_widget'], 2)); //replace only 1st class="
		}else{
			$classe_to_add = $classe_to_add;
			$params[0]['before_widget'] = '<div class="'.$classe_to_add.'">';
			$params[0]['after_widget'] = '</div>';
		}

		return $params;
	}
//}

/* Envato Theme Update Toolkit */
add_action('admin_init', 'ct_on_admin_init');
function ct_on_admin_init()
{
	// if there is a submit to update theme
	if(isset($_GET['ct_update_theme'])){

		$envato_username = ot_get_option_core('envato_username','');
		$envato_api = ot_get_option_core('envato_api','');


		// if user has entered username and api
		if($envato_username != '' && $envato_api != ''){
			// include the library
			require_once locate_template('/inc/plugins/envato-wordpress-toolkit/class-envato-wordpress-theme-upgrader.php');

			$upgrader = new Envato_WordPress_Theme_Upgrader( $envato_username , $envato_api );

			$upgrader->upgrade_theme(PARENT_THEME);
			add_action( 'admin_notices', 'ct_admin_notice_theme_updated' );
		}

		//add_action( 'admin_notices', 'ct_admin_notice_theme_updated' );
	} else {
		// if Auto Update is set
		if(ot_get_option_core('envato_auto_update') == 'on'){
			if(ct_check_for_update(PARENT_THEME) == 1){
				$envato_username = ot_get_option_core('envato_username','');
				$envato_api = ot_get_option_core('envato_api','');

				if($envato_username != '' && $envato_api != ''){
					require_once locate_template('/inc/plugins/envato-wordpress-toolkit/class-envato-wordpress-theme-upgrader.php');
					$upgrader = new Envato_WordPress_Theme_Upgrader( $envato_username , $envato_api );

					$upgrader->upgrade_theme(PARENT_THEME);
					add_action( 'admin_notices', 'ct_admin_notice_theme_updated' );
				}
			}
		}
	}
}

function ct_check_for_update($theme){

	$envato_username = ot_get_option_core('envato_username','');
	$envato_api = ot_get_option_core('envato_api','');


	// if user has entered username and api
	if($envato_username != '' && $envato_api != ''){
		// include the library
		require_once locate_template('/inc/plugins/envato-wordpress-toolkit/class-envato-wordpress-theme-upgrader.php');

		$upgrader = new Envato_WordPress_Theme_Upgrader( $envato_username , $envato_api );


		$update = $upgrader->check_for_theme_update($theme);  // we enter theme name here to make sure if users are using child theme

		// found an update
		if(isset($update->updated_themes_count))
		{
			return $update->updated_themes_count;
		}
		return false;
	}
}

function ct_admin_notice_theme_updated() {
    ?>
    <div class="updated">
        <p><?php esc_html_e( 'Theme Updated!', 'cactusthemes' ); ?></p>
    </div>
    <?php
}

/* Clone from ot-functions.php*/
function ot_get_option_core( $option_id, $default = '' ) {

  /* get the saved options */
  $options = get_option( ot_options_id() );

  /* look for the saved value */
  if ( isset( $options[$option_id] ) && '' != $options[$option_id] ) {

    return ot_wpml_filter( $options, $option_id );

  }

  return $default;

}

if ( ! function_exists( 'ot_options_id' ) ) {

  function ot_options_id() {

    return apply_filters( 'ot_options_id', 'option_tree' );

  }

}

if ( ! function_exists( 'ot_settings_id' ) ) {

  function ot_settings_id() {

    return apply_filters( 'ot_settings_id', 'option_tree_settings' );

  }

}

if ( ! function_exists( 'ot_wpml_filter' ) ) {

  function ot_wpml_filter( $options, $option_id ) {

    // Return translated strings using WMPL
    if ( function_exists('icl_t') ) {

      $settings = get_option( ot_settings_id() );

      if ( isset( $settings['settings'] ) ) {

        foreach( $settings['settings'] as $setting ) {

          // List Item & Slider
          if ( $option_id == $setting['id'] && in_array( $setting['type'], array( 'list-item', 'slider' ) ) ) {

            foreach( $options[$option_id] as $key => $value ) {

              foreach( $value as $ckey => $cvalue ) {

                $id = $option_id . '_' . $ckey . '_' . $key;
                $_string = icl_t( 'Theme Options', $id, $cvalue );

                if ( ! empty( $_string ) ) {

                  $options[$option_id][$key][$ckey] = $_string;

                }

              }

            }

          // List Item & Slider
          } else if ( $option_id == $setting['id'] && $setting['type'] == 'social-links' ) {

            foreach( $options[$option_id] as $key => $value ) {

              foreach( $value as $ckey => $cvalue ) {

                $id = $option_id . '_' . $ckey . '_' . $key;
                $_string = icl_t( 'Theme Options', $id, $cvalue );

                if ( ! empty( $_string ) ) {

                  $options[$option_id][$key][$ckey] = $_string;

                }

              }

            }

          // All other acceptable option types
          } else if ( $option_id == $setting['id'] && in_array( $setting['type'], apply_filters( 'ot_wpml_option_types', array( 'text', 'textarea', 'textarea-simple' ) ) ) ) {

            $_string = icl_t( 'Theme Options', $option_id, $options[$option_id] );

            if ( ! empty( $_string ) ) {

              $options[$option_id] = $_string;

            }

          }

        }

      }

    }

    return $options[$option_id];

  }

}
/* End Clone from ot-functions.php*/

/* Echo meta data tags */
function ct_meta_tags(){
	$description = get_bloginfo('description');
	if(is_single()){
		global $post;

		$description = $post->post_excerpt;
?>
	<meta property="og:image" content="<?php echo esc_attr(wp_get_attachment_url(get_post_thumbnail_id($post->ID))); ?>"/>
	<meta property="og:title" content="<?php echo esc_attr(get_the_title($post->ID));?>"/>
	<meta property="og:url" content="<?php echo esc_url(get_permalink($post->ID));?>"/>
	<meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name'));?>"/>
	<meta property="og:type" content=""/>
	<meta property="og:description" content="<?php echo esc_attr($description);?>"/>
<?php
	}
	?>
	<meta property="description" content="<?php echo esc_attr($description);?>"/>
	<?php
}

if(!function_exists('cactus_get_responsive_featured_image')){
	/**
	 * get HTML for calling responsive featured image, using noscript technique
	 * Example: 
	 * 
		<noscript data-src-small="img-small.jpg" 
			data-src-medium="img-medium.jpg" 
			data-src-high="img-high" 
			data-src-x-high="img-x-high.jpg">
				<img src="img-small.jpg">
		</noscript>
	 *
	 * $id - integer - Post Id
	 * $args - array - Properties of image
	 * $all_sizes - array - array of all available sizes. Currently 4 sizes are required. First element will be used as default size (smallest size/mobile size)
	 */
	function cactus_get_responsive_featured_image($id, $args, $all_sizes){
		if(is_array($all_sizes) && count($all_sizes) == 4){
			$post_thumbnail_id = get_post_thumbnail_id($id);
			
			$small =  wp_get_attachment_image_src($post_thumbnail_id, $all_sizes[0]);$small = $small[0];
			$medium = wp_get_attachment_image_src($post_thumbnail_id, $all_sizes[1]);$medium = $medium[0];
			$high = wp_get_attachment_image_src($post_thumbnail_id, $all_sizes[2]);$high = $high[0];
			$xhigh = wp_get_attachment_image_src($post_thumbnail_id, $all_sizes[3]);$xhigh = $xhigh[0];
			$properties = '';
			if(!isset($args['alt'])){
				$properties = 'alt="" ';
			}
			foreach($args as $k=>$p){
				$properties .= $k . '="' . $p . '" ';
			}
			
			$html = '<noscript data-src-small="'.$small.'" 
							data-src-medium="'.$medium.'" 
							data-src-high="'.$high.'" 
							data-src-x-high="'.$xhigh.'">
								<img src="'.$small.'" '.$properties.'>
						</noscript>';
						
			return $html;
		} else {
			return get_the_post_thumbnail($id, $all_sizes, $args);
		}
	}
}

if(!function_exists('cactus_get_responsive_attachment_image')){
	/**
	 * get HTML for calling responsive featured image, using noscript technique
	 * Example: 
	 * 
		<noscript data-src-small="img-small.jpg" 
			data-src-medium="img-medium.jpg" 
			data-src-high="img-high" 
			data-src-x-high="img-x-high.jpg">
				<img src="img-small.jpg">
		</noscript>
	 *
	 * $id - integer - ID of attachment
	 * $all_sizes - array - array of all available sizes. Currently 4 sizes are required. First element will be used as default size (smallest size/mobile size)
	 */
	function cactus_get_responsive_attachment_image($id, $all_sizes){
		if(is_array($all_sizes) && count($all_sizes) == 4){
			$small =  wp_get_attachment_image_src($id, $all_sizes[0]);$def_w = $small[1];$def_h = $small[2];$small = $small[0];
			$medium = wp_get_attachment_image_src($id, $all_sizes[1]);$medium = $medium[0];
			$high = wp_get_attachment_image_src($id, $all_sizes[2]);$high = $high[0];
			$xhigh = wp_get_attachment_image_src($id, $all_sizes[3]);$xhigh = $xhigh[0];
			
			$html = '<noscript data-src-small="'.$small.'" 
							data-src-medium="'.$medium.'" 
							data-src-high="'.$high.'" 
							data-src-x-high="'.$xhigh.'">
								<img src="'.$small.'" alt="" width="'.$def_w.'" height="'.$def_h.'">
						</noscript>';
						
			return $html;
		} else {
			return wp_get_attachment_image($id, $all_sizes);
		}
	}
}

function cactus_inline_script() {
  if ( wp_script_is( 'jquery', 'done' ) ) {
?>
<script type="text/javascript">
<?php // these JS are inline to make sure images are loaded as soon as possible ?>
function getDevicePixelRatio(){
	if(window.screen.logicalXDPI){
		return window.screen.logicalXDPI / 96; // IE
	} else if(window.devicePixelRatio){
		return window.devicePixelRatio;
	} else return 1;
}

function getImageVersion() {
	var devicePixelRatio = getDevicePixelRatio();
	var width = window.innerWidth * devicePixelRatio;
	if (width > 1280) {
				return "x-high";
	} else if (width > 1024) {
				return "high";
	} else if (width > 768) {
				return "medium";
	} else {
		return "small"; // default version
	}
}

function loadAdaptiveImage(imageContainer) {

	var imageVersion = getImageVersion();

	if (!imageContainer || !imageContainer.children) {
		return;
	}
	var img = imageContainer.children[0];

	if (img) {
		var imgSRC = img.getAttribute("data-src-" + imageVersion);
		var altTxt = img.getAttribute("data-alt");
		if (imgSRC) {
			var imageElement = new Image();
			imageElement.src = imgSRC;
			imageElement.setAttribute("alt", altTxt ? altTxt : "");
			imageElement.setAttribute("width", "320");
			imageElement.setAttribute("height", "160");
			imageContainer.appendChild(imageElement);
			imageContainer.removeChild(imageContainer.children[0]);
		}
	}
}

lazyLoadedImages = document.getElementsByClassName("adaptive");

for (var i = 0; i < lazyLoadedImages.length; i++) {
	loadAdaptiveImage(lazyLoadedImages[i]);
}
</script>
<?php
  }
}
add_action( 'wp_footer', 'cactus_inline_script' );

/* Remove query strings from static resources */
function _remove_query_strings_1( $src ){	
	$rqs = explode( '?ver', $src );
        return $rqs[0];
}
		if ( is_admin() ) {
// Remove query strings from static resources disabled in admin
}

		else {
add_filter( 'script_loader_src', '_remove_query_strings_1', 15, 1 );
add_filter( 'style_loader_src', '_remove_query_strings_1', 15, 1 );
}

function _remove_query_strings_2( $src ){
	$rqs = explode( '&ver', $src );
        return $rqs[0];
}
		if ( is_admin() ) {
// Remove query strings from static resources disabled in admin
}

		else {
add_filter( 'script_loader_src', '_remove_query_strings_2', 15, 1 );
add_filter( 'style_loader_src', '_remove_query_strings_2', 15, 1 );
}