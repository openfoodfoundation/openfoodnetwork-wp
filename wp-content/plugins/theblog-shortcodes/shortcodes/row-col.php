<?php
function cactus_create_row($atts, $content){
	$fluid = isset($atts['fluid']) ? $atts['fluid'] : '';
	$class = isset($atts['class']) ? $atts['class'] : '';
	$content = preg_replace('/<br class="cr".\/>/', '', $content);
	ob_start(); ?>
   		<div class="container<?php echo $fluid?'-fluid':'' ;?>">
            <div class="row <?php echo $class?>">
              <?php echo do_shortcode($content) ?>
            </div>
        </div>
	<?php
	//return
	$output_string=ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('row','cactus_create_row');

function cactus_create_col($atts, $content){
	$content = preg_replace('/<br class="cr".\/>/', '', $content);
	$lg = isset($atts['size_lg']) ? $atts['size_lg'] : '';
	$md = isset($atts['size_md']) ? $atts['size_md'] : '';
	$sm = isset($atts['size_sd']) ? $atts['size_sd'] : '';
	$xs = isset($atts['size_xs']) ? $atts['size_xs'] : '';
	$off_lg = isset($atts['offset_lg']) ? $atts['offset_lg'] : '';
	$off_md = isset($atts['offset_md']) ? $atts['offset_md'] : '';
	$off_sm = isset($atts['offset_sm']) ? $atts['offset_sm'] : '';
	$off_xs = isset($atts['offset_xs']) ? $atts['offset_xs'] : '';
	ob_start();?>
		<div class="<?php echo $lg?'col-lg-'.$lg.' ':'' ?><?php echo $md?'col-md-'.$md.' ':'' ?><?php echo $sm?'col-sm-'.$sm.' ':'' ?><?php echo $xs?'col-xs-'.$xs.' ':'' ?><?php echo $off_lg?'offset-lg-'.$off_lg.' ':'' ?><?php echo $off_md?'offset-md-'.$off_md.' ':'' ?><?php echo $off_sm?'offset-sm-'.$off_sm.' ':'' ?><?php echo $off_xs?'offset-xs-'.$off_xs.' ':'' ?>">
          <?php echo do_shortcode($content) ?>
        </div>
	<?php
	//return
	$output_string=ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('col','cactus_create_col');
