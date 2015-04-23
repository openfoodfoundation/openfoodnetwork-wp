<?php
if(!class_exists('OP_Option_textfield')){
class OP_Option_textfield extends OP_Option{
	
	/* Display option 
	 *
	 * @params
	 * $selectedValue: default selected value
	 */
	public function getOption($selectedValue = null){
		if($this->xmlElement == null) return;
		
		$atts = $this->xmlElement->attributes();
		$width = '';
		if(isset($atts['width'])) $width = ' style="width:' . $atts['width'] . 'px" '; 
		
		$html = '<input type="text" name="'.$this->name.'" '. $width .'value="' . $selectedValue . '" />';
					
		return $html;
	}
	
}
}