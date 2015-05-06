<?php
	
// This is best practice stuff: 
// add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
//   function theme_enqueue_styles() {
//     wp_enqueue_style( 'parent-style', get_template_directory_uri() . '../theblog/style.css' );
//     wp_enqueue_style( 'child-style',
//       get_stylesheet_directory_uri() . '../theblog-child/style.css',
//       array('parent-style')
//   );
// }


// Add Your Menu Locations
function register_my_menus() {
  register_nav_menus(
    array(  
      'user_guide' => __( 'User Guide' ), 
    )
  );
} 

add_action( 'init', 'register_my_menus' );

function default_user_guide() { // HTML markup for a default message in menu location
  echo "<ul class='nav'>          
    <li>User Guide</li>
  </ul>";
}