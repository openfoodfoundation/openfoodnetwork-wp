<?php
$atts = array();
parse_str( $data, $atts );
$output = $el_class = $image = $img_size = $img_link = $img_link_target = $img_link_large = $title = $alignment = $css_animation = $css = '';
$image_string = '';
extract( shortcode_atts( array(
	'title' => '',
	'image' => $image,
	'img_size' => 'full',
	'link' => '',
	'img_link_target' => '_self',
	'alignment' => 'left',
	'el_class' => '',
	'css_animation' => '',
	'style' => '',
	'border_color' => '',
	'css' => ''
), $atts ) );
require_once vc_path_dir( 'SHORTCODES_DIR', 'vc-single-image.php' );
$img_class = new WPBakeryShortCode_VC_Single_image( array( 'base' => 'vc_single_image' ) );
$style = ( $style != '' ) ? $style : '';
$border_color = ( $border_color != '' ) ? ' vc_box_border_' . $border_color : '';

$img_id = get_post_thumbnail_id( $post->ID );
$img = wpb_getImageBySize( array(
	'attach_id' => $img_id,
	'thumb_size' => $img_size,
	'class' => 'vc_single_image-img'
) );
$img = apply_filters( 'vc_gitem_attribute_featured_image_img', $img );
if ( NULL === $img || false === $img ) {
	return $output;
}
$el_class = $img_class->getExtraClass( $el_class );
$link = vc_gitem_create_link_real( $atts, $post );

$img_output = ( $style == 'vc_box_shadow_3d' ) ? '<span class="vc_box_shadow_3d_wrap">' . $img[ 'thumbnail' ] . '</span>' : $img[ 'thumbnail' ];
$image_string = ! empty( $link ) ? '<' . $link . '><div class="vc_single_image-wrapper ' . $style . ' ' . $border_color . '">' . $img_output . '</div></a>' : '<div class="vc_single_image-wrapper ' . $style . ' ' . $border_color . '">' . $img_output . '</div>';
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_single_image wpb_content_element' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $img_class->settings( 'base' ), $atts );
$css_class .= $img_class->getCSSAnimation( $css_animation );

$css_class .= ' vc_align_' . $alignment;

$output .= "\n\t" . '<div class="' . $css_class . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= "\n\t\t\t" . $image_string;
$output .= "\n\t\t" . '</div> ' . $img_class->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $img_class->endBlockComment( '.wpb_single_image' );

return $output;
