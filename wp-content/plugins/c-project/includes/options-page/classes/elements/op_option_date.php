<?php
if(!class_exists('OP_Option_date')){
class OP_Option_date extends OP_Option{
	
	/* Display option 
	 *
	 * @params
	 * $selectedValue: default selected value
	 */
	public function getOption($selectedValue = null){
		if($this->xmlElement == null) return;
		
		$atts = $this->xmlElement->attributes();
		
		$html = '<input type="text" data-uk-datepicker="{format:\'DD.MM.YYYY\'}" name="'.$this->name.'" value="'.$selectedValue.'"/> ';
			
		return $html;
	}
	
}
}