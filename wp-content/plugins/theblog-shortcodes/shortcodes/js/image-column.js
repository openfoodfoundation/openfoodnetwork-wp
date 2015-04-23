// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_image_column', function(editor, url) {
		editor.addButton('cactus_image_column', {
			text: '',
			tooltip: 'Image Column',
			id: 'cactus_image_column_shortcode',
			icon: 'icon-image-column',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Image Column',
					body: [
						{type: 'textbox', name: 'class', label: 'Class Name'},
						{type: 'textbox', name: 'img_1', label: 'IMG Default 1'},
						{type: 'textbox', name: 'img_2', label: 'IMG Default 2'},

					],
					onsubmit: function(e) {
						var content_class = e.data.class!=''&&e.data.class!=null ? e.data.class : '';	
						var content_1 = e.data.img_1!=''&&e.data.img_1!=null ? e.data.img_1 : '';	
						var content_2 = e.data.img_2!=''&&e.data.img_2!=null ? e.data.img_2 : '';	
											
						var shortcode  = '[image_column class_img_column="'+content_class+'"]<br class="cactus_br">';
							shortcode += '[img_column src="'+content_1+'"]<br class="cactus_br">';
							shortcode += '[img_column src="'+content_2+'"]<br class="cactus_br">';
							shortcode += '[/image_column]<br class="cactus_br">';							
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
