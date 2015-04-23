<?php

/**
 * Class Vc_Vendor_YoastSeo
 * @since 4.4
 */
Class Vc_Vendor_YoastSeo implements Vc_Vendor_Interface {

	/**
	 * Add filter for yoast.
	 * @since 4.4
	 */
	public function load() {
		if ( class_exists( 'WPSEO_Metabox' )
		     && ( vc_mode() == 'admin_page' || vc_mode() === 'admin_frontend_editor' ) ) {
			add_filter( 'wpseo_pre_analysis_post_content', array(
				&$this,
				'filterResults'
			) );
			add_action('vc_frontend_editor_render_template', array(&$this, 'addSubmitBox'));
		} // removed due to woocommerce fatal error :do_shortcode in is_admin() mode =  fatal error
	}

	/**
	 * Properly parse content to detect images/text keywords.
	 * @since 4.4
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public function filterResults( $content ) {
		/**
		 * @since 4.4.3
		 * vc_filter: vc_vendor_yoastseo_filter_results
		 */
		do_action('vc_vendor_yoastseo_filter_results');
		$content = do_shortcode( shortcode_unautop( $content ) );
		return $content;
	}
	public function addSubmitBox() {
		// do_action('post_submitbox_misc_actions');
	}
}