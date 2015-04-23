// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_tooltip', function(editor, url) {
		editor.addButton('cactus_tooltip', {
			text: '',
			tooltip: 'Tooltip',
			id: 'cactus_tooltip_shortcode',
			icon: 'icon-tooltip',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Tooltip',
					body: [
						{type: 'textbox', name: 'title', label: 'Tooltip Text', multiline: true},
					],
					onsubmit: function(e) {
						// Insert content when the window form is submitted
						 //var uID =  Math.floor((Math.random()*100)+1);
						 var title = e.data.title? e.data.title:'Tooltip title'; 
						 var content = tinymce.activeEditor.selection.getContent() ? tinymce.activeEditor.selection.getContent() : 'Tooltip text';
						editor.insertContent('[tooltip title="'+title+'"]'+content+'[/tooltip]');
						
					}
				});
			}
		});
	});
})();
