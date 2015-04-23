// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_shortcode_button', function(editor, url) {
		editor.addButton('cactus_shortcode_button', {
			text: '',
			tooltip: 'Shortcode',
			id: 'bt_listshortcode',
			icon: 'icons',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Shortcode',
					body: [
						{type: 'button', name: 'Alert', text: 'Alert', label: 'Alert' , id: 'id_cactus_alert'},
						{type: 'button', name: 'Button', text: 'Button', label: 'Button' , id: 'id_cactus_button'},
						{type: 'button', name: 'Compare Table', text: 'Compare Table', label: 'Compare Table' , id: 'id_cactus_compare'},
						{type: 'button', name: 'Divider', text: 'Divider', label: 'Divider' , id: 'id_cactus_divider'},
						{type: 'button', name: 'Dropcap', text: 'Dropcap', label: 'Dropcap' , id: 'id_cactus_dropcap'},
						{type: 'button', name: 'Icon Box', text: 'Icon Box', label: 'Icon Box' , id: 'id_cactus_icon_box'},
						{type: 'button', name: 'Image Carousel', text: 'Image Carousel', label: 'Image Carousel' , id: 'id_cactus_image_carousel'},
						{type: 'button', name: 'Image Column', text: 'Image Column', label: 'Image Column' , id: 'id_cactus_image_column'},
						{type: 'button', name: 'Row - Column', text: 'Row - Column', label: 'Row - Column' , id: 'id_cactus_row_col'},
						{type: 'button', name: 'Text Block', text: 'Text Block', label: 'Text Block' , id: 'id_cactus_textblock'},
						{type: 'button', name: 'Tooltip', text: 'Tooltip', label: 'Tooltip' , id: 'id_cactus_tooltip'},
					],
				});
			}
		});
	});
})();



// #cactus_alert_shortcode,
// #cactus_button_shortcode,
// #cactus_collapse_shortcode,
// #cactus_dropcap_shortcode,
// #cactus_row_col_shortcode,
// #cactus_tabs_shortcode,
// #cactus_text_block_shortcode,
// #cactus_tooltip_shortcode,

// #cactus_iconbox_shortcode,
// #cactus_divider_shortcode,
// #cactus_compare_shortcode,
// #cactus_image_column_shortcode,
// #cactus_image_carousel_shortcode {