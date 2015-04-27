<?php
global $menu_mobile;
global $menu_v6;
$menu_mobile = false;
$menu_v6  = false;
class custom_walker_nav_menu extends Walker_Nav_Menu {


	function __construct($is_mobile_menu = false, $is_menu_v6 = false)
	{
		global $menu_mobile;
		global $menu_v6;
		$menu_mobile 	= $is_mobile_menu;
		$menu_v6 		= $is_menu_v6;
	}

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array()) {
		global $menu_mobile;
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0

		if(!$menu_mobile)
		{
		$classes = array(
			'dropdown-menu',
			//( $display_depth >=2 ? 'dropdown-submenu' : '' ),
			'menu-depth-' . $display_depth
			);
		}
		else
		{
			$classes = array(
			// 'dropdown-menu',
			//( $display_depth >=2 ? 'dropdown-submenu' : '' ),
			'menu-depth-' . $display_depth
			);
		}
		$class_names = implode( ' ', $classes );

		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";

		global $multi_column;
		if($multi_column){
			global $first_column;
			$first_column = 1;
			global $column_open;
			$column_open = 0;
		}
	}

	function end_lvl( &$output, $depth = 0, $args = array() ){
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		global $multi_column;
		global $column_open;
		if($multi_column && $column_open){
			$output .= '</ul></li>';
		}
		$output .= "\n$indent</ul>\n";
	}

	// add main/sub classes to li's and links
	 function start_el( &$output, $item, $depth = 0, $args = array(),  $current_object_id = 0) {
		$args = (object) $args;
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			//( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$is_parent = false;

		$valid_classes = array();
		// check if there is "icon-*" class set. If found, remove it
		$icon_classes = array();
		foreach($classes as $class){
			if(strpos($class,'icon-') === false || strpos($class,'icon-') != 0){
				$valid_classes[] = $class;
			} else {
				$icon_classes[] = $class;
			}
			if($class == 'parent'){
				$is_parent = true;
				$valid_classes[]=$depth==0?'dropdown':'dropdown-submenu';
			}
		}

		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $valid_classes ), $item ) ) );
		//column
		if(in_array('column-header',$valid_classes) || in_array('column-new',$valid_classes)){
			global $first_column;
			global $column_open;
			if($first_column){
				$indent = $indent.'<li class="menu-column"><ul>';
				$first_column = 0;
			}else{
				$indent = $indent.'</ul></li><li class="menu-column"><ul>';
			}
			$column_open = 1;
		}

		global $menu_mobile;
		global $menu_v6;
		// build html
		if($menu_mobile && $menu_v6)
		{
			$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
		}
		else if(!$menu_mobile)
			$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
		else
			$output .= $indent . '<li id="nav-menu-mobile-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ' href="' . esc_url(get_permalink($item->ID)) . '"';

		$icon_class_names = '';
		if(count($icon_classes) > 0){
			$icon_class_names = '<i class="'.esc_attr( implode( '"></i><i class="', $icon_classes ) ).'"></i>';
		}
		global $multi_column;
		if($depth==0){
			$multi_column = false;
		}
		if(in_array('multi-column',$valid_classes)){
			$multi_column = true;
		}

		$attributes .= ' class="menu-link '.($is_parent&&$depth==0?'dropdown-toggle disabled':'').' '.( $depth > 0 ? 'sub-menu-link':'main-menu-link' ).'"';

		$item_output = sprintf( '%1$s<a%2$s'.($is_parent&&$depth==0?' data-toggle="dropdown"':'').'>'.$icon_class_names.'%3$s%4$s%5$s ' . ($item->description&&$depth==0?'<span class="menu-description">'.$item->description.'</span>':'') .'</a>%6$s',
			is_array($args) ?  $args['before'] : $args->before,
			$attributes,
			is_array($args) ? $args['link_before'] : $args->link_before,
			apply_filters( 'the_title',(empty($item->post_title) ? $item->title : $item->post_title) , $item->ID ),
			is_array($args) ? $args['link_after']  : $args->link_after,
			is_array($args) ? $args['after'] : $args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class custom_walker_nav_menu_mobile extends Walker_Nav_Menu {

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array()) {
		$output .= "</option>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array()){
		$output .= "";
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if(substr($output, -strlen("</option>\n")) === "</option>\n"){
			// if true, this should be end_lvl(), instead of end_el
		} else {
			$output .= "</option>\n";
		}
	}

	// add main/sub classes to li's and links
	 function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$is_parent = false;

		$valid_classes = array();
		// check if there is "icon-*" class set. If found, remove it
		$icon_classes = array();
		foreach($classes as $class){
			if(strpos($class,'icon-') === false || strpos($class,'icon-') != 0){
				$valid_classes[] = $class;
			} else {
				$icon_classes[] = $class;
			}
			if($class == 'parent') $is_parent = true;
		}

		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $valid_classes ), $item ) ) );

		// build html
		if(str_replace('current-menu-item', '', $class_names) != $class_names)
			$output .= $indent . '<option value="'. ( ! empty( $item->url ) ? $item->url : esc_url(get_permalink($item->ID))).'" selected="selected">';
		else
			$output .= $indent . '<option value="'.( ! empty( $item->url ) ? $item->url : esc_url(get_permalink($item->ID))).'">';

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ' href="' . esc_url(get_permalink($item->ID)) . '"';

		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
		$sub_menu = '';

		if($depth > 0){
			for($i = 0; $i < $depth; $i++){
				$sub_menu .= ' - ';
			}
		}
		$item_output = sprintf( '%1$s%3$s%4$s%5$s%6$s',
			is_array($args) ?  $args['before'] : $args->before,
			$attributes,
			is_array($args) ? $args['link_before'] : $args->link_before,
			apply_filters( 'the_title', $sub_menu . (empty($item->post_title) ? $item->title : $item->post_title) , $item->ID ),
			is_array($args) ? $args['link_after']  : $args->link_after,
			is_array($args) ? $args['after'] : $args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/* Filter to add "parent" class to <li> item if it has sub-menu */
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {

	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}

	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'parent';
		}
	}

	return $items;
}