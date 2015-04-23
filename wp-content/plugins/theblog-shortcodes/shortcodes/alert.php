<?php
function cactus_create_alert($atts, $content){
	$altID =  rand(1, 999);	
	$id = isset($atts['id']) ? $atts['id'] : 'cr-alert-'.$altID;
	$type = isset($atts['type']) ? $atts['type'] : 'success';
	$dismissable = isset($atts['dismissable']) ? $atts['dismissable'] : '';
	$html = '';
	$html .= ' 
		<div class="alert '.$type.'" id="'.$id.'">';
		if($dismissable=='true'){
			$html .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';	
		}
		$html .= $content;
		$html .= '</div>';
	return $html;	
}
add_shortcode( 'alert', 'cactus_create_alert' );

