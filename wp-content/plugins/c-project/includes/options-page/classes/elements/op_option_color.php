<?php
if(!class_exists('OP_Option_color')){
class OP_Option_color extends OP_Option{
	
	/* Display option 
	 *
	 * @params
	 * $selectedValue: default selected value
	 */
	public function getOption($selectedValue = null){
		if($this->xmlElement == null) return;
		
		$atts = $this->xmlElement->attributes();
		
		$html = '<input type="text" class="color" name="'.$this->name.'" value="'.$selectedValue.'"/> ';
			
		return $html;
	}
}
}

// add custom CSS and JS

global $osp_menu;
add_action( 'admin_print_scripts-' . $osp_menu, 'op_option_color_custom_js');
if(!function_exists('op_option_color_custom_js')){
function op_option_color_custom_js(){	
	wp_enqueue_script('op-option-color-js',plugins_url('color/op_option_color.js', __FILE__),array('wp-color-picker'), false, true);
}
}

add_action( 'admin_print_styles-' . $osp_menu, 'op_option_color_custom_css' );
if(!function_exists('op_option_color_custom_css')){
function op_option_color_custom_css(){
	wp_enqueue_style( 'wp-color-picker' );
}
}