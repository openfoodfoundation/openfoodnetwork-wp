// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_compare_table', function(editor, url) {
		editor.addButton('cactus_compare_table', {
			text: '',
			tooltip: 'Compare Table',
			id: 'cactus_compare_shortcode',
			icon: 'icon-compare-table',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Compare Table',
					body: [
						{type: 'textbox', name: 'column', label: 'Number of column', value: '4'},
						{type: 'textbox', name: 'row', label: 'Number of row', value: '6'},
						{type: 'textbox', name: 'currency', label: 'Currency', value: '$'},
					],
					onsubmit: function(e) {
						var uID =  Math.floor((Math.random()*100)+1);
						var column 				= e.data.column;
						var row 				= e.data.row;
						var price 				= e.data.price;
						var price_text 			= e.data.price_text;
						var currency 			= e.data.currency;
						var price_color 		= e.data.price_color;
						var shortcode = '[comparetable class="" id="compare-table-' + uID + '" color=""]<br class="nc"/>';
						for(i=0;i<column;i++)
						{
							shortcode+= '[c_column currency="'+currency+'" price_text="/mo" price_color="" price="120" class="" column="' + column + '" color="" bg_color="" title=""]<br class="nc"/>';
							for(j=0; j<row; j++)
							{
								shortcode+= '[c_row id="row-' + j + '" class="" color="" bg_color=""]Content[/c_row]<br class="nc"/>';
							}
							shortcode += '[/c_column]<br class="nc"/>';
						}
						shortcode+= '[/comparetable]<br class="nc"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();

