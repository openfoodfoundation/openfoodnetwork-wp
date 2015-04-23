<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package cactus
 */
?>
<?php
	if(is_page())
	{
		global $page_sidebar;
		$sidebar = ($page_sidebar != '' && $page_sidebar == 'right')  ? 'sidebar-right' : 'sidebar-left';
	}
	else if(is_single())
	{
		global $single_sidebar;
		$sidebar = ($single_sidebar != '' && $single_sidebar == 'right')  ? 'sidebar-right' : 'sidebar-left';
	}
	else
	{
		global $theme_sidebar;
	    $sidebar = ($theme_sidebar != '' && $theme_sidebar == 'right')  ? 'sidebar-right' : 'sidebar-left';
	}
?>
	<div id="secondary" class="widget-area col-md-4 cactus-sidebar <?php echo esc_attr($sidebar);?>" role="complementary">
		<?php if ( ! dynamic_sidebar( 'main-sidebar' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->