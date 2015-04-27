jQuery(document).ready(function($){
	$megaInputs = $( '.wpmega-custom input, .wpmega-custom textarea, .wpmega-custom select' );
	
	function processMegaAtts(){
		$( '.wpmega-atts.wpmega-unprocessed' ).each( function(){
			$( this ).removeClass( 'wpmega-unprocessed' );
			var $inputs = $( this ).find( ':input:not( .mashmenu_options_input )' );
			$inputs.each( function(){
				var name = $( this ).attr( 'name' );
				name = name.substring( 0 , name.indexOf( '[' ) );
				$( this ).attr( 'data-name' , name ).attr( 'name' , name ); //.removeAttr( 'name' );
			});
			var options = $inputs.serialize();
			$( this ).find( '.mashmenu_options_input' ).val( options );
			$inputs.removeAttr( 'name' );
		});
	}
	
	processMegaAtts();
	
	$megaInputs.live( 'change' , function(){
		var $attGroup = $( this ).parents( '.wpmega-atts' );
		var $inputs = $attGroup.find( ':input:not( .mashmenu_options_input )' );
		$inputs.each( function(){
			$( this ).attr( 'name' , $( this ).attr( 'data-name' ) );
		});
		var options = $inputs.serialize();
		console.log( options );
		$attGroup.find( '.mashmenu_options_input' ).val( options );
		$inputs.removeAttr( 'name' );
	});
	
	/* MENU ITEMS */
	/** Menu Panel Add New Item Override **/
	/* This overrides the normal addItemToMenu Function, in order to call a different callback which invokes the custom walker */
	if(typeof wpNavMenu != 'undefined'){
		wpNavMenu.addItemToMenu = function(menuItem, processMethod, callback) {
			//alert("add item to menu");
			var menu = $('#menu').val(),
			nonce = $('#menu-settings-column-nonce').val();
		
			processMethod = processMethod || function(){};
			callback = callback || function(){};
		
			params = {
				//'action': 'add-menu-item',
				"action": "mashMenu_addMenuItem",
				"menu": menu,
				"menu-settings-column-nonce": nonce,
				"menu-item": menuItem
			};			
		
			$.post( ajaxurl, params, function(menuMarkup) {
				
				var ins = $('#menu-instructions');
				processMethod(menuMarkup, params);
				if( ! ins.hasClass('menu-instructions-inactive') && ins.siblings().length )
					ins.addClass('menu-instructions-inactive');
				callback();
				processMegaAtts();
			});
		};
	}

	/** For Menus Panel - setup Navigation Locations **/
	$('#wp-mash-menu-navlocs-submit').click(function(){
		var $waiting = $(this).parent().find('.waiting');
		$waiting.fadeIn();
		
		var data = new Array();
		$('#nav-menu-theme-mashmenus input[name="wp-mash-menu-nav-loc"]').each(function(){
			if($(this).is(':checked')) data.push($(this).val());
		});
		data = data.join(',');
		
		$.ajax({
			type:	'POST',
			cache:	false,
			url:	ajaxurl,
			data:	{ "action" : "mashMenu_updateNavLocs",	"data" : data },
			error:	function(req, status, errorThrown){
				if(DEBUG) console.log('Error: '+status+' | '+errorThrown);
			},
			success: function(data, status, req){
				$waiting.fadeOut();
			}
		});		
		return false;
	});
});