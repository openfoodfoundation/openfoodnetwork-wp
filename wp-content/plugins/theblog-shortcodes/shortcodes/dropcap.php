<?php
/*Create Dropcaps*/
function cactus_create_dropcaps($dr, $dr_content){
	$drcID =  rand(1, 999);
	$id = isset($atts['id']) ? $atts['id'] : 'cr-dropcaps-'.$drcID;
	$html ='<span class="dropcaps" id="'.$id.'"><span> '.$dr_content.' </span></span>';
	return $html;
}
add_shortcode('dropcap','cactus_create_dropcaps');
/*Create Dropcaps END*/