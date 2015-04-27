;(function($){
	var DEBUG = false;
	$.mashmenu = function(el, options){
		var menu = $(el);
		var settings = $.extend({
			animation : 300
		},options);
		
		var _onSlideDown = false;
		
		methods = {
			/* lazy load images in a content div. What it actually does is to change data-src property into src property */
			loadImages : function(divContent){
				$("img",$(divContent)).each(function(){
					if($(this).attr("data-src") != ""){
						$(this).attr("src",$(this).attr("data-src"));
						$(this).attr("data-src","");
					}
				});
			},
			init : function(){			
				if(mashmenu.ajax_enabled == 0){
					// modify HTML of sub content
					menu.find(".channel-content").each(function(){
						$(this).appendTo($(this).parent().parent());
					});
				}
				menu.find(".menu-mobile").click(function(){
					menu.find(".menu").toggleClass("active");
				});
				
				$(window).resize(function(){
						menu.find(".menu").removeClass("active");
				});
				
				menu.find(".channel-title").each(function(){
					$(this).hover(function(){
						methods.displayChannel($(this));
					});
				});
				
				menu.find(".level0").hover(function(){
					$(this).addClass("hover");
					// if current hovered item is not active
					if(!_onSlideDown && $(this).find(".sub-content-active").length == 0){			
						// find current active item				
						var activeSub = $(this).parent().find(".sub-content-active");			
						if(activeSub.length == 0){ // if no active item
							var sub = $(this).find(".sub-content");
							if(sub.length > 0){	
								// if has sub content
								_onSlideDown = true; // mark animation
								// start sliding down
								sub.slideDown(300,function(){
									sub.addClass("sub-content-active");
									_onSlideDown = false; // end animation
									
									if(sub.find(".sub-channel .hover").length == 0){
										methods.displayChannel(sub.find(".sub-channel .channel-title:eq(0)"));
									}
								});
							}
						} else { // change active flag
							var divContent = $(this).find(".sub-content");
							divContent.addClass("sub-content-active");
							activeSub.hide().removeClass("sub-content-active");
							
							if(divContent.find(".sub-channel .hover").length == 0){
								methods.displayChannel(divContent.find(".sub-channel .channel-title:eq(0)"));
							}
						}
					}
				},function(){
					$(this).removeClass("hover");
					setTimeout($.proxy(function(){ // hide active item if mouse is out of menu
						if($(this).find(".menu>.hover").length == 0){
							sub = $(this).find(".sub-content");
							_onSlideDown = true;
							sub.slideUp(200,function(){
									_onSlideDown = false; // end animation
									
									sub.removeClass("sub-content-active");
								});
						}
					}, menu),300);
				});
			},
			displayChannel : function(channel_title){
				var target = "#" + $(channel_title).attr("data-target");			
				$(channel_title).parent().parent().find(".channel-content").removeClass("active");
				
				if($(target).length == 0){
					if(mashmenu.ajax_enabled != 0){
						// create panel to receive data
						var channel = $('<div class="channel-content active" id="' + $(channel_title).attr("data-target") + '"><div class="content-inner"> <div class="loading">'+
						
						 '<div class="loading-img loadnow">'+
							 '<div class="floatingCirclesG loadnow">'+
								 '<div class="f_circleG frotateG_01 loadnow"></div>'+
								 '<div class="f_circleG frotateG_02 loadnow"></div>'+
								 '<div class="f_circleG frotateG_03 loadnow"></div>'+
								 '<div class="f_circleG frotateG_04 loadnow"></div>'+
								 '<div class="f_circleG frotateG_05 loadnow"></div>'+
								 '<div class="f_circleG frotateG_06 loadnow"></div>'+
								 '<div class="f_circleG frotateG_07 loadnow"></div>'+
								 '<div class="f_circleG frotateG_08 loadnow"></div>'+
							 '</div>'+
						 '</div>'+
						
						'</div> </div></div>');
						$(channel_title).parent().parent().append(channel);
					
						methods.getChannelContent(target,$(channel_title).attr("data-object"),$(channel_title).attr("data-id"),$(channel_title).attr('data-post'));
					}
				} else {
					methods.loadImages(target);
					$(target).addClass("active");
				}
				
				$(channel_title).parent().find(".channel-title").removeClass("hover");
				$(channel_title).addClass("hover");
			},
			getChannelContent : function(channelId, dataType, dataId, postType){
					$.ajax({
						type:	'POST',
						cache:	false,
						url:	mashmenu.ajax_url,
						data:	{ "action" : "mashMenu_getChannelContent",	"data" : new Array(dataType, dataId,postType) },
						error:	function(req, status, errorThrown){
							if(DEBUG) console.log('Error: '+status+' | '+errorThrown);
						},
						success: function(data, status, req){
							$(channelId).find(".content-inner").html(data);
						}
					});	
			}
		};	

		methods.init();
	};
	$.fn.mashmenu = function(options){
		return new $.mashmenu(this,options);
	}
}(jQuery));

// var _mobile_screen = 480; global variable, defined in HTML

jQuery(document).ready(function($){
	var _mashmenu = $(".mashmenu").mashmenu();
});