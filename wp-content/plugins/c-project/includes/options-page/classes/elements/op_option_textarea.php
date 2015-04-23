<?php
if(!class_exists('OP_Option_textarea')){
class OP_Option_textarea extends OP_Option{
	
	/* Display option 
	 *
	 * @params
	 * $selectedValue: default selected value
	 */
	public function getOption($selectedValue = null){
		if($this->xmlElement == null) return;
		
		$atts = $this->xmlElement->attributes();
		$cols = ''; $rows = '';
		if(isset($atts['cols'])) $cols = ' cols = "'.$atts['cols'].'" ';
		if(isset($atts['rows'])) $rows = ' rows = "'.$atts['rows'].'" ';
		
		$html = '<textarea name="'.$this->name.'" '.$cols.$rows.'>' . stripslashes($selectedValue) . '</textarea>';
					
		return $html;
	}
	
}
}