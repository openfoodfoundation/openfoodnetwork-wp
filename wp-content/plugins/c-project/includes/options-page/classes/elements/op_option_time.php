<?php
if(!class_exists('OP_Option_time')){
class OP_Option_time extends OP_Option{
	
	/* Display option 
	 *
	 * @params
	 * $selectedValue: default selected value
	 */
	public function getOption($selectedValue = null){
		if($this->xmlElement == null) return;
		
		$atts = $this->xmlElement->attributes();
		
		$html = '<input type="text" data-uk-timepicker="{showMeridian:true,minuteStep:5, showSeconds:true}" name="'.$this->name.'" value="'.$selectedValue.'"/> ';
			
		return $html;
	}
	
}
}