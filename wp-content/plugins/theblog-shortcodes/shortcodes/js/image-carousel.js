// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_image_carousel', function(editor, url) {
		editor.addButton('cactus_image_carousel', {
			text: '',
			tooltip: 'Image Carousel',
			id: 'cactus_image_carousel_shortcode',
			icon: 'icon-image-carousel',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Image Carousel',
					body: [
						{type: 'textbox', name: 'height', label: 'Height of carousel', value:"550"},
						{type: 'listbox', 
							name: 'autoplay',
							label: 'Enable autoplay', 
							'values': [
								{text: 'False', value: '0'},
								{text: 'True', value: '1'},
							]
						},
						{type: 'textbox', name: 'speed', label: 'Speed of carousel animation', value:"4000"},
					],
					onsubmit: function(e) {
					
						var shortcode = '[image_carousel height="'+e.data.height+'" autoplay="'+e.data.autoplay+'" speed="'+e.data.speed+'"]';
							shortcode += '<br class="cactus_br"/>[img src="#"]<br class="cactus_br"/>[img src="#"]<br class="cactus_br"/>[img src="#"]<br class="cactus_br"/>[img src="#"]';
							shortcode+= '<br class="cactus_br"/>[/image_carousel]';
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
