// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_dropcap', function(editor, url) {
		editor.addButton('cactus_dropcap', {
			text: '',
			tooltip: 'Dropcap',
			id: 'cactus_dropcap_shortcode',
			icon: 'icon-dropcap',
			onclick: function() {
				var content = tinymce.activeEditor.selection.getContent() ? tinymce.activeEditor.selection.getContent() : 'Dropcap text here';
				editor.insertContent('[dropcap]'+content+'[/dropcap]');
			}
		});
	});
})();

