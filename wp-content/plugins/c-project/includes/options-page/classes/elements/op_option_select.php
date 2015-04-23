<?php
if(!class_exists('OP_Option_select')){
class OP_Option_select extends OP_Option{
	
	/* Display option 
	 *
	 * @params
	 * $selectedValue: default selected value
	 */
	public function getOption($selectedValue = null){
		if($this->xmlElement == null) return;
		
		$atts = $this->xmlElement->attributes();
													
		$html = '<select name="'.$this->name . '">';
		
		foreach($this->xmlElement->select as $select){
			$atts2 = $select->attributes();
			
			$html .=
				'<option value="'.$atts2['value'].'" '.($selectedValue == $atts2['value'] ? 'selected="selected"':'').'>'.$atts2['text'].'</option>';
		}													
			
		$html .=
			'</select>';
			
		return $html;
	}
	
}
}