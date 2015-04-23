<?php
if(!class_exists('OP_Option_editor')){
class OP_Option_editor extends OP_Option{
		
	/* Display option 
	 *
	 * @params
	 * $selectedValue: default selected value
	 */
	public function getOption($selectedValue = null){
		if($this->xmlElement == null) return;
		
		$html = '';
		ob_start();
		wp_editor($selectedValue,$this->name, array('textarea_rows'=>5));
		$html = ob_get_contents();
		ob_end_clean();
					
		return $html;
	}
	
}
}