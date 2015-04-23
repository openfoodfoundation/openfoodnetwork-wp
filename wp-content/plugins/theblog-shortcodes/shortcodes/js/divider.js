// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_divider', function(editor, url) {
		editor.addButton('cactus_divider', {
			text: '',
			tooltip: 'Divider',
			id: 'cactus_divider_shortcode',
			icon: 'icon-divider',
			onclick: function() {
				editor.insertContent('[divider]');
			}
		});
	});
})();
