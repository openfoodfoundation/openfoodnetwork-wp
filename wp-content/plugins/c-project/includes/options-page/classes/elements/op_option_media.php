<?php
if(!class_exists('OP_Option_media')){
	class OP_Option_media extends OP_Option{
		
		
		/* Display option 
		 *
		 * @params
		 * $selectedValue: default selected value
		 */
		public function getOption($selectedValue = null){
			if($this->xmlElement == null) return;
			
			$atts = $this->xmlElement->attributes();
			
			$html = '<input type="text" name="'.$this->name.'" value="'.$selectedValue.'"/> <a class="button upload_logo" href="#">' . __('Upload Media','osp').'</a> <div id="logo_image_holder">' . ($selectedValue == '' ? '' : '<img src="'.$selectedValue.'"/>').'</div>';
				
			return $html;
		}
	}
}


global $osp_menu;
add_action( 'admin_print_scripts-' . $osp_menu, 'op_option_media_custom_js');
if(!function_exists('op_option_media_custom_js')){
function op_option_media_custom_js(){
	wp_enqueue_media();

	wp_enqueue_script('media-upload'); // we need this for WordPress Uploader frame
    wp_enqueue_script('thickbox'); // For modal windows
	wp_enqueue_script('op-option-media-js',plugins_url('media/op_option_media.js', __FILE__),array('jquery'), false, true);
    
}
}
add_action( 'admin_print_styles-' . $osp_menu, 'op_option_media_custom_css' );

if(!function_exists('op_option_media_custom_css')){
function op_option_media_custom_css(){
	wp_enqueue_style('thickbox');
}
}