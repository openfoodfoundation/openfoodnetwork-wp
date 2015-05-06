<?php
	

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