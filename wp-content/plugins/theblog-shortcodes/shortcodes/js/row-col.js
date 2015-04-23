// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_row_col', function(editor, url) {
		editor.addButton('cactus_row_col', {
			text: '',
			tooltip: 'Row - Column',
			id: 'cactus_row_col_shortcode',
			icon: 'icon-row-col',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Row - Column',
					body: [
						{type: 'textbox', name: 'col', label: 'Number of Column'},
						{type: 'listbox', 
							name: 'fluid', 
							label: 'Fluid', 
							'values': [
								{text: 'Yes', value: '1'},
								{text: 'No', value: '0'},
							]
						},
						{type: 'textbox', name: 'class', label: 'Custom Class'},
					],
					onsubmit: function(e) {
						// Insert content when the window form is submitted
						var uID =  Math.floor((Math.random()*100)+1);
						var col = e.data.col;
						var shortcode = '[row fluid="'+e.data.fluid+'" class="'+e.data.class+'"]';
						for(i=0;i<col;i++){
							j=i+1;
								shortcode += '<br class="cr"/>[col size_lg="" size_md="" size_sm="" size_xs="" offset_lg="" offset_md="" offset_xs="" class=""] [/col]';
							}
							shortcode+= '<br class="cr"/>[/row]';
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
