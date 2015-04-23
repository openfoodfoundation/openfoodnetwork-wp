<?php
if(!class_exists('OP_Option_checkbox')){
class OP_Option_checkbox extends OP_Option{
		
	/* Display option 
	 *
	 * @params
	 * $selectedValue: default selected value
	 */
	public function getOption($selectedValue = null){
		if($this->xmlElement == null) return;
		
		$atts = $this->xmlElement->attributes();
		
		$html = '';
		
		foreach($this->xmlElement->select as $select){
			$atts2 = $select->attributes();
			
			$checked = false;
			
			if(!is_array($selectedValue) && $selectedValue != ''){
				$selectedValue = explode(',',$selectedValue);
			}
			
			if(is_array($selectedValue)){								
				foreach($selectedValue as $s){
					if($s == $atts2['value']){
						$checked = true;
						break;
					}
				}
			}
			
			$html .= 
				'<input type="checkbox" name="'.$this->name.'[]" value="'.$atts2['value'].'" '. ($checked?'checked="checked"':'') .'/> ' . $atts2['text'];
		}
			
		return $html;
	}
	
}
}