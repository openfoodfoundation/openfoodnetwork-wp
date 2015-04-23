<?php 
function cactus_create_tooltip($atts, $content = null) {
	$tooltipID =  rand(1, 999);	
	$id = isset($atts['id']) ? $atts['id'] : 'cr-tooltip-'.$tooltipID;
	$title = isset($atts['title']) ? $atts['title'] : 'This tooltip is on top!';
	$html = '';
	$html .='
	<a href="#" data-toggle="tooltip" data-placement="top" title="'.$title.'"'.($id?' id="'.$id.'"':'').' class="cactus_tooltip">'.$content.'</a>
	';
	return $html;
}
add_shortcode('tooltip', 'cactus_create_tooltip');