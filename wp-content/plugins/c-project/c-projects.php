<?php
/**
 * @package TheBlog
 * @version 1.0
 */
/*
Plugin Name: CactusThemes - Project
Plugin URI: http://www.cactusthemes.com/
Description: Enable Project Custom Post Type
Version: 1.0
Author: CactusThemes
Author URI: http://cactusthemes.com/
License: Commercial
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if(!class_exists('U_project')){	
class U_project{
	/* custom template relative url in theme, default is "U_project" */
	public $template_url;
	public static $woocommerce;
	/* Plugin path */
	public $plugin_path;
	
	/* Main query */
	public $query;
	
	public function __construct() {
		// constructor
		$this->includes();
		$this->register_configuration();
		
		add_action( 'init', array($this,'init'), 0);
	}
	function u_project_scripts_styles() {
		global $wp_styles;
		
		/*
		 * Loads our main javascript.
		 */	
		
		wp_enqueue_script( 'c-project-js',plugins_url('/js/custom.js', __FILE__) , array('jquery'), '', true );
	}
	
	function includes(){
		// custom meta boxes
		include_once('project-functions.php');
		
		if(!class_exists('Options_Page')){
			include_once('includes/options-page/options-page.php');
		}
		//include_once('classes/u-project-query.php');
	}
	
	/* This is called as soon as possible to set up options page for the plugin
	 * after that, $this->get_option($name) can be called to get options.
	 *
	 */
	function register_configuration(){
		global $c_project_settings;
		$c_project_settings = new Options_Page('c_project_settings', array('option_file'=>dirname(__FILE__) . '/options.xml','menu_title'=>'Project Settings','menu_position'=>null), array('page_title'=>'Project Setting Page','submit_text'=>'Save'));
	}
	
	/* Get main options of the plugin. If there are any sub options page, pass Options Page Id to the second args
	 *
	 *
	 */
	function get_option($option_name, $op_id = ''){
		return $GLOBALS[$op_id != ''?$op_id:'c_project_settings']->get($option_name);
	}
	
	function init(){
		// Variables
		$this->template_url			= apply_filters( 'c_project_template_url', 'c-project/' );
		if(isset($GLOBALS['woocommerce'])){
			self::$woocommerce=$GLOBALS['woocommerce'];
		}
		$this->register_taxonomies();		
		add_filter( 'cmb_meta_boxes', array($this,'register_post_type_metadata') );
		add_action( 'admin_init', array( $this, 'project_meta' ) );		
		add_filter( 'template_include', array( $this, 'template_loader' ) );
		add_action( 'template_redirect', array($this, 'template_redirect' ) );
		add_action( 'wp_enqueue_scripts', array($this, 'u_project_scripts_styles') );
	}	
	/**
	 * Get the plugin path.
	 *
	 * @access public
	 * @return string
	 */
	public function plugin_path() {
		if ( $this->plugin_path ) return $this->plugin_path;

		return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
	}
	/**
	 *
	 * Load custom page template for specific pages 
	 *
	 * @return string
	 */
	function template_loader($template){
		
		$find = array('c-project.php');
		$file = '';
		
		if(is_post_type_archive( 'c-project' ) || is_page('project') || is_tax('project-tag')){
			$file = 'archive-c-project.php';
			$find[] = $file;
			$find[] = $this->template_url . $file;
		}
		elseif(is_singular('u_project')){
			$file = 'single.php';
			$find[] = $file;
			$find[] = $this->template_url . $file;
		}
		if ( $file ) {
			$template = locate_template( $find );
			
			if ( ! $template ) $template = $this->plugin_path() . '/templates/' . $file;
		}
		return $template;		
	}
	
	/**
	 * Handle redirects before content is output - hooked into template_redirect so is_page works.
	 *
	 * @access public
	 * @return void
	 */
	function template_redirect(){
		global $u_project, $wp_query;

		// When default permalinks are enabled, redirect stores page to post type archive url
		if ( ! empty( $_GET['page_id'] ) && get_option( 'permalink_structure' ) == "" && $_GET['page_id'] ==  'project' ) {
			wp_safe_redirect( get_post_type_archive_link('u_project') );
			exit;
		}
	}
	
	function register_taxonomies(){
		$this->register_u_project();
	}
	
	/* Register u_project post type and its custom taxonomies */
	function register_u_project(){
		$labels = array(
			'name'               => esc_html__('Project', 'cactusthemes'),
			'singular_name'      => esc_html__('Project', 'cactusthemes'),
			'add_new'            => esc_html__('Add New Project', 'cactusthemes'),
			'add_new_item'       => esc_html__('Add New Project', 'cactusthemes'),
			'edit_item'          => esc_html__('Edit Project', 'cactusthemes'),
			'new_item'           => esc_html__('New Project', 'cactusthemes'),
			'all_items'          => esc_html__('All Project', 'cactusthemes'),
			'view_item'          => esc_html__('View Project', 'cactusthemes'),
			'search_items'       => esc_html__('Search Project', 'cactusthemes'),
			'not_found'          => esc_html__('No Project found', 'cactusthemes'),
			'not_found_in_trash' => esc_html__('No Project found in Trash', 'cactusthemes'),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__('Project', 'cactusthemes'),
		  );
		$slug_ev =  $this->get_option('cactus-project-slug');
		if($slug_ev==''){
			$slug_ev = 'project';
		}
		if ( $slug_ev )
			$rewrite =  array( 'slug' => untrailingslashit( $slug_ev ), 'with_front' => false, 'feeds' => true );
		else
			$rewrite = false;

		  $args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => $rewrite,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'		 => 5,
			'menu_icon' 		  => 'dashicons-portfolio',
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
		  );
		register_post_type( 'c-project', $args );
		
		$u_project_tag_labels = array(
			'name'			=>	esc_html__( 'Project Tags' , 'cactusthemes' ),
			'singular_name' =>	esc_html__( 'Project Tags' , 'cactusthemes' ),
			'add_new_item'	=>	esc_html__( 'Add New Tag' , 'cactusthemes' ),
			'search_items'	=>	esc_html__( 'Search Tags' , 'cactusthemes' ),
			'popular_items' =>	esc_html__( 'Popular Tags' , 'cactusthemes' ),
		);
		
		$slug_tag =  $this->get_option('cactus-project-slug-tag');
		if($slug_tag==''){
			$slug_tag = 'project-tag';
		}
		
		register_taxonomy('project-tag', 'c-project', array('labels'=>$u_project_tag_labels,'meta_box_cb'=>array($this,'u_project_type_meta_box_cb'), 'rewrite'=>array('slug'=> $slug_tag)));
	}
		
	/* Register meta box for Store Type 
	 * Wordpress 3.8
	 */
	function u_project_type_meta_box_cb($post, $box){
		$defaults = array('taxonomy' => 'post_tag');
		if ( !isset($box['args']) || !is_array($box['args']) )
			$args = array();
		else
			$args = $box['args'];
		extract( wp_parse_args($args, $defaults), EXTR_SKIP );
		$tax_name = esc_attr($taxonomy);
		$taxonomy = get_taxonomy($taxonomy);
		$user_can_assign_terms = current_user_can( $taxonomy->cap->assign_terms );
		$comma = _x( ',', 'tag delimiter' );
		?>
		<div class="tagsdiv" id="<?php echo $tax_name; ?>">
			<div class="jaxtag">
			<div class="nojs-tags hide-if-js">
			<p><?php echo $taxonomy->labels->add_or_remove_items; ?></p>
			<textarea name="<?php echo "tax_input[$tax_name]"; ?>" rows="3" cols="20" class="the-tags" id="tax-input-<?php echo $tax_name; ?>" <?php disabled( ! $user_can_assign_terms ); ?>><?php echo str_replace( ',', $comma . ' ', get_terms_to_edit( $post->ID, $tax_name ) ); // textarea_escaped by esc_attr() ?></textarea></div>
			<?php if ( $user_can_assign_terms ) : ?>
			<div class="ajaxtag hide-if-no-js">
				<label class="screen-reader-text" for="new-tag-<?php echo $tax_name; ?>"><?php echo $box['title']; ?></label>
				<div class="taghint"><?php echo $taxonomy->labels->add_new_item; ?></div>
				<p><input type="text" id="new-tag-<?php echo $tax_name; ?>" name="newtag[<?php echo $tax_name; ?>]" class="newtag form-input-tip" size="16" autocomplete="off" value="" />
				<input type="button" class="button tagadd" value="<?php esc_attr_e('Add'); ?>" /></p>
			</div>
			<p class="howto"><?php echo $taxonomy->labels->separate_items_with_commas; ?></p>
			<?php endif; ?>
			</div>
			<div class="tagchecklist"></div>
		</div>
		<?php if ( $user_can_assign_terms ) : ?>
		<p class="hide-if-no-js"><a href="#titlediv" class="tagcloud-link" id="link-<?php echo $tax_name; ?>"><?php echo $taxonomy->labels->choose_from_most_used; ?></a></p>
		<?php endif; ?>
		<?php
	}
	
	/**
	 * Display post categories form fields.
	 *
	 * @since 2.6.0
	 *
	 * @param object $post
	 */
	function u_project_categories_meta_box_cb( $post, $box ) {
	$defaults = array('taxonomy' => 'category');
	if ( !isset($box['args']) || !is_array($box['args']) )
		$args = array();
	else
		$args = $box['args'];
	extract( wp_parse_args($args, $defaults), EXTR_SKIP );
	$tax = get_taxonomy($taxonomy);

	?>
	<div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
		<ul id="<?php echo $taxonomy; ?>-tabs" class="category-tabs">
			<li class="tabs"><a href="#<?php echo $taxonomy; ?>-all"><?php echo $tax->labels->all_items; ?></a></li>
			<li class="hide-if-no-js"><a href="#<?php echo $taxonomy; ?>-pop"><?php _e( 'Most Used' ); ?></a></li>
		</ul>

		<div id="<?php echo $taxonomy; ?>-pop" class="tabs-panel" style="display: none;">
			<ul id="<?php echo $taxonomy; ?>checklist-pop" class="categorychecklist form-no-clear" >
				<?php $popular_ids = wp_popular_terms_checklist($taxonomy); ?>
			</ul>
		</div>

		<div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
			<?php
            $name = ( $taxonomy == 'category' ) ? 'post_category' : 'tax_input[' . $taxonomy . ']';
            echo "<input type='hidden' name='{$name}[]' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
            ?>
			<ul id="<?php echo $taxonomy; ?>checklist" data-wp-lists="list:<?php echo $taxonomy?>" class="categorychecklist form-no-clear">
				<?php wp_terms_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids ) ) ?>
			</ul>
		</div>
	<?php if ( current_user_can($tax->cap->edit_terms) ) : ?>
			<div id="<?php echo $taxonomy; ?>-adder" class="wp-hidden-children">
				<h4>
					<a id="<?php echo $taxonomy; ?>-add-toggle" href="#<?php echo $taxonomy; ?>-add" class="hide-if-no-js">
						<?php
							/* translators: %s: add new taxonomy label */
							printf( __( '+ %s' ), $tax->labels->add_new_item );
						?>
					</a>
				</h4>
				<p id="<?php echo $taxonomy; ?>-add" class="category-add wp-hidden-child">
					<label class="screen-reader-text" for="new<?php echo $taxonomy; ?>"><?php echo $tax->labels->add_new_item; ?></label>
					<input type="text" name="new<?php echo $taxonomy; ?>" id="new<?php echo $taxonomy; ?>" class="form-required form-input-tip" value="<?php echo esc_attr( $tax->labels->new_item_name ); ?>" aria-required="true"/>
					<label class="screen-reader-text" for="new<?php echo $taxonomy; ?>_parent">
						<?php echo $tax->labels->parent_item_colon; ?>
					</label>
					<?php wp_dropdown_categories( array( 'taxonomy' => $taxonomy, 'hide_empty' => 0, 'name' => 'new'.$taxonomy.'_parent', 'orderby' => 'name', 'hierarchical' => 1, 'show_option_none' => '&mdash; ' . $tax->labels->parent_item . ' &mdash;' ) ); ?>
					<input type="button" id="<?php echo $taxonomy; ?>-add-submit" data-wp-lists="add:<?php echo $taxonomy ?>checklist:<?php echo $taxonomy ?>-add" class="button category-add-submit" value="<?php echo esc_attr( $tax->labels->add_new_item ); ?>" />
					<?php wp_nonce_field( 'add-'.$taxonomy, '_ajax_nonce-add-'.$taxonomy, false ); ?>
					<span id="<?php echo $taxonomy; ?>-ajax-response"></span>
				</p>
			</div>
		<?php endif; ?>
	</div>
	<?php

}
	
	function register_post_type_metadata(array $meta_boxes){
		// register aff store metadata
		$c_project_fields_layout = array(	
			array( 'id' => 'project-sidebar', 'name' => 'Sidebar', 'type' => 'select', 'options' => array( 'def' => 'Default', 'left' => 'Left ', 'right' => 'Right', 'full' => 'Hidden'),'desc' => 'Select "Default" to use settings in Theme Options'),
			array( 'id' => 'project-ctpadding', 'name' => 'Content Padding', 'type' => 'select', 'options' => array( 'on' => 'On', 'off' => 'Off' ),'desc' => 'Enable default top and bottom padding  for content (30px)'),
		);
		$meta_boxes[] = array(
			'title' => esc_html__('Layout settings','cactusthemes'),
			'pages' => 'u_project',
			'fields' => $c_project_fields_layout,
			'priority' => 'high'
		);	
		return $meta_boxes;
	}
	
	function project_meta(){
		//option tree
		  $meta_box_review = array(
			'id'        => 'meta_box_project',
			'title'     => esc_html__( 'Project Metadata' , 'cactusthemes' ),
			'desc'      => '',
			'pages'     => array( 'c-project' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
		  	)
		  );
		 /* $tmr_criteria = $this->get_option('uproject-defmeta');
		  $tmr_criteria = $tmr_criteria?explode(",", $tmr_criteria):'';
		  if($tmr_criteria){
			  foreach($tmr_criteria as $criteria){
				  $meta_box_review['fields'][] = array(
					  'id'          => 'project_'.sanitize_title($criteria),
					  'label'       => $criteria,
					  'desc'        => '',
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  );
			  }
		  }*/
		  $meta_box_review['fields'][] = array(
				'id'          => 'c_project_layout',
				'label'       => esc_html__( 'Layout For Single Project', 'cactusthemes' ),
				'desc'        => esc_html__('Choose default layout for Single Project', 'cactusthemes' ),
				'std'         => 'default',
				'type'        => 'select',
				'section'     => 'single_post',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and',
				'choices'     => array(
				  array(
					'value'       => 'default',
					'label'       => esc_html__( 'Default', 'cactusthemes' ),
					'src'         => ''
				  ),
				  array(
					'value'       => 'slide',
					'label'       => esc_html__( 'Project Slide', 'cactusthemes' ),
					'src'         => ''
				  ),
				  array(
					'value'       => 'photo',
					'label'       => esc_html__( 'Project Photo', 'cactusthemes' ),
					'src'         => ''
				  ),
				)
		  );
		  $meta_box_review['fields'][] = array(
				'id'          => 'c_project_repcolor',
				'label'       => esc_html__( 'Representative Color', 'cactusthemes' ),
				'desc'        => esc_html__('Choose a color that represents this project. It is the color of an item when hovered in a grid listing page', 'cactusthemes' ),
				'std'         => '',
        		'type'        => 'colorpicker',
				'section'     => 'single_post',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and',
		  );
		  if (function_exists('ot_register_meta_box')) {
			ot_register_meta_box( $meta_box_review );
		  }
	}

}


} // class_exists check
if ( ! function_exists( 'u_project_get_page_id' ) ) {

	/**
	 * Affiliatez page IDs
	 *
	 * retrieve page ids - used for myaccount, edit_address, change_password, shop, cart, checkout, pay, view_order, thanks, terms
	 *
	 * returns -1 if no page is found
	 *
	 * @access public
	 * @param string $page
	 * @return int
	 */
	 /* function u_project_get_page_id( $page ) {
		  global $affiliatez;
		  $page = apply_filters('affiliatez_get_' . $page . '_page_id', $affiliatez->get_option($page . '-page-id'));
		  return ( $page ) ? $page : -1;
	  }*/
}

/**
 * Init u_project
 */
$GLOBALS['u_project'] = new U_project();

/** Project Navigation **/
if ( ! function_exists( 'cactus_project_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @params $content_div & $template are passed to Ajax pagination
 */
function cactus_project_paging_nav($content_div = '#main', $template = 'html/loop/content') {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		echo '';
	}else {
	
		$nav_type = op_get('c_project_settings','cactus-project-listing-pagination');
		if($nav_type == ''){$nav_type = 'def_wp';}
		switch($nav_type){
			case 'def_wp':
				cacus_paging_nav_default();
				break;
			case 'wp_pagenavi':
				if( ! function_exists( 'wp_pagenavi' ) ) {	
					// fall back to default navigation style
					cacus_project_paging_nav_default(); 
				} else {
					wp_pagenavi();
				}
				break;
		}
	}
}
endif;

if ( ! function_exists( 'cacus_project_paging_nav_default' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable. Default WordPress style
 */
function cacus_project_paging_nav_default() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		echo '';
	}else{	
	?>
	<div class='wp-pagenavi'>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'cactus' ); ?></h1>
			<div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( esc_html__( '<span class="meta-nav">&larr;</span> Older posts', 'cactus' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'cactus' ) ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
	</div>
	<?php }
}
endif;
/** Project Navigation End **/

?>