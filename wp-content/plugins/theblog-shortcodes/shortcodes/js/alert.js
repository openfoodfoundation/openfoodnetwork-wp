// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_alert', function(editor, url) {
		editor.addButton('cactus_alert', {
			text: '',
			tooltip: 'Alert',
			id: 'cactus_alert_shortcode',
			icon: 'icon-alert',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Alert',
					body: [
						{type: 'textbox', name: 'content', label: 'Content', multiline: true},
						{type: 'listbox', 
							name: 'type', 
							label: 'Type', 
							'values': [
								{text: 'Success', value: 'success'},
								{text: 'Info', value: 'info'},
								{text: 'Warning', value: 'warning'},
								{text: 'Danger', value: 'danger'}
							]
						},
						{type: 'listbox', 
							name: 'dismissable', 
							label: 'Dismissable alerts', 
							'values': [
								{text: 'No', value: 'false'},
								{text: 'Yes', value: 'true'},
							]
						}
					],
					onsubmit: function(e) {
						//var uID =  Math.floor((Math.random()*100)+1);
						// Insert content when the window form is submitted
						editor.insertContent('[alert type="'+e.data.type+'" dismissable="'+e.data.dismissable+'"]'+e.data.content+'[/alert]');
					}
				});
			}
		});
	});
})();