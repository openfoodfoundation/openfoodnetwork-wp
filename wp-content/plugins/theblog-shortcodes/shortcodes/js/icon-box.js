// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_iconbox', function(editor, url) {
		editor.addButton('cactus_iconbox', {
			text: '',
			tooltip: 'Icon Box',
			id: 'cactus_iconbox_shortcode',
			icon: 'icon-box',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Icon Box',
					body: [
						{type: 'textbox', name: 'icon', label: 'Icon - Font Awesome', multiline: false},
						{type: 'textbox', name: 'color', label: 'Color', value: ''},						
						{type: 'textbox', name: 'title', label: 'Title', multiline: true},
						{type: 'textbox', name: 'titlecolor', label: 'Title Hover Color', value: ''},
						{type: 'textbox', name: 'url', label: 'Title Link', multiline: false},
						{type: 'textbox', name: 'content', label: 'Content', multiline: true},
					],
					onsubmit: function(e) {
						 var icon = e.data.icon? e.data.icon:''; 
						 var color = e.data.color? e.data.color:''; 
						 var titlecolor = e.data.titlecolor? e.data.titlecolor:''; 
						 var title = e.data.title? e.data.title:''; 
						 var content = e.data.content? e.data.content:'';
						 var url = e.data.url? e.data.url:'';					 
						
						 editor.insertContent('[icon-box icon="'+icon+'" title="'+title+'" icon_color="'+color+'" title_hover_color="'+titlecolor+'" title_url="'+url+'"]'+content+'[/icon-box]');
						
					}
				});
			}
		});
	});
})();
