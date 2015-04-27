<?php 
function mashmenu_settings_page(){
?>
	<div class="wrap">
	<h2>MashMenu Options</h2>
	<form method="post" action="options.php" enctype="multipart/form-data"> 
	<?php settings_fields('mashmenu_options' ); ?>
	<?php do_settings_sections(dirname(__FILE__)._DS_.'megamenu.php'); ?>
	<?php submit_button(); ?>
	</form>
	</div>
<?php }?>