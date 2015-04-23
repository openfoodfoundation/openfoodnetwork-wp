<?php
if(!class_exists('OP_Option_category')){
class OP_Option_category extends OP_Option{
	
	/* Display option 
	 *
	 * @params
	 * $selectedValue: default selected value
	 */
	public function getOption($selectedValue = null){
		if($this->xmlElement == null) return;
		$atts = $this->xmlElement->attributes();
		
		$args = array('name'=>$this->name
						,'hide_empty'=>false
						,'hierarchical'=>true
						,'show_option_all' => __('All Categories','osp')
						,'selected'=>$selectedValue);
						
		if(isset($atts['taxonomy'])) $args['taxonomy'] = (string)$atts['taxonomy'];
		
		$html = '';
		ob_start();
		wp_dropdown_categories($args);
		$html = ob_get_contents();
		ob_end_clean();
					
		return $html;
	}
	
}
}