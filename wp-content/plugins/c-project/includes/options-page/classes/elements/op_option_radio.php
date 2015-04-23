<?php
if(!class_exists('OP_Option_radio')){
class OP_Option_radio extends OP_Option{
	
	/* Display option 
	 *
	 * @params
	 * $selectedValue: default selected value
	 */
	public function getOption($selectedValue = null){
		if($this->xmlElement == null) return;
		
		$atts = $this->xmlElement->attributes();
		
		$html = '';
		
		$idx = 0;
		
		foreach($this->xmlElement->select as $select){
			$idx++;
			$atts2 = $select->attributes();
			
			$checked = false;
			
			$html .= 
				'<input type="radio" name="'.$this->name.'" value="'.$atts2['value'].'" '. (($selectedValue == '' && $idx == 1)?'checked="checked"':((string)$atts2['value'] == $selectedValue ?'checked="checked"':'')) .'/> ' . $atts2['text'];
		}
			
		return $html;
	}
	
}
}