// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_text_block', function(editor, url) {
		editor.addButton('cactus_text_block', {
			text: '',
			tooltip: 'Text Block',
			id: 'cactus_text_block_shortcode',
			icon: 'icon-text-block',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Text Block',
					body: [
						{type: 'textbox', name: 'content', label: 'Content'},
						{type: 'listbox', 
							name: 'position',
							label: 'Position', 
							'values': [
								{text: 'Center', value: ''},
								{text: 'Left', value: 'left'},
								{text: 'Right', value: 'right'},
							]
						},

					],
					onsubmit: function(e) {
						var content = tinymce.activeEditor.selection.getContent() ? tinymce.activeEditor.selection.getContent() : e.data.content;						
						var shortcode = '[block pos="'+e.data.position+'"]';
							shortcode += content;
							shortcode+= '[/block]';							
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
