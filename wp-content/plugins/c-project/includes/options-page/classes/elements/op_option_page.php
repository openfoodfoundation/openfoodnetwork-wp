<?php
if(!class_exists('OP_Option_page')){
class OP_Option_page extends OP_Option{
	
	/* Display option 
	 *
	 * @params
	 * $selectedValue: default selected value
	 */
	public function getOption($selectedValue = null){
		if($this->xmlElement == null) return;
		
		$atts = $this->xmlElement->attributes();
													
		$html = '';
		ob_start();
		wp_dropdown_pages(array('selected'=>$selectedValue,'name'=>$this->name));
		$html = ob_get_contents();
		ob_end_clean();
					
		return $html;
	}
	
}
}