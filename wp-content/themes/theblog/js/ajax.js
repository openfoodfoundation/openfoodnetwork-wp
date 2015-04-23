( function() {
	// Save current page
	if(typeof cactus.query_vars !== 'undefined'){
		_current_page = cactus.query_vars.paged;
	} else {
		_current_page = -1;
	}
	if(_current_page == 0) _current_page = 1;
	// flag to check if an ajax is executing
	_ajax_loading = false;

	function do_ajax(first_index_blog_listing, blog_layout)
	{

		if(jQuery('#navigation-ajax').length > 0){
			jQuery('#navigation-ajax').live('click', function(e){
				  e.preventDefault();
				  if(_current_page > -1 && !_ajax_loading){
						item_template = jQuery(this).attr('data-template');
						last_index_blog_listing = jQuery('input[name=last_index_blog_listing]').val();
						post_per_page 			= jQuery('input[name=hidden_page_per_page]').val();
						icon_loading 			= jQuery('.navigation-ajax i');
						ajax_button 			= jQuery('#navigation-ajax');

						data = 	{
									action: 'load_more',
									page: _current_page,
									template: item_template,
									vars:cactus.query_vars,
									last_index_blog_listing: last_index_blog_listing,
									blog_layout: blog_layout,
									post_per_page:post_per_page

								};

						content_div = jQuery(this).attr('data-target');

						_ajax_loading = true;
						ajax_button.addClass('hidden1-loading');
						icon_loading.removeClass('hidden-loading');

					    jQuery.ajax({
							  type: 'POST',
							  url: cactus.ajaxurl,
							  cache: false,
							  data: data,
							  success: function(data, textStatus, XMLHttpRequest){
								if(data != ''){
									// do something fancy before appending data?

									// then append data
									// jQuery(content_div).append(data);
									var checkLoadingImg  = jQuery('.check-loading-img');
									jQuery(data).appendTo(checkLoadingImg);
									//var newItems = jQuery(data).appendTo(content_div);

									var imgLoad = imagesLoaded( document.querySelector('.check-loading-img') );	

									imgLoad.on( 'done', function( instance ) {
										var strHTML=data;
										var find='list-item col-md-4';
										var re = new RegExp(find, 'g');
										strHTML = strHTML.replace(re, 'list-item col-md-4 opacity-0');

										var newItems = jQuery(strHTML).appendTo(content_div);
										
										var lazyLoadedImages_ajax = document.querySelectorAll('.opacity-0 .adaptive');//getElementsByClassName("adaptive");								
										for (var i = 0; i < lazyLoadedImages_ajax.length; i++) {
											loadAdaptiveImage(lazyLoadedImages_ajax[i]);
										};
										checkLoadingImg.html('');

										if(checkLoadingImg.hasClass('is-isotope'))
										{
											setTimeout(function(){
										  		jQuery(content_div).isotope('appended', newItems).isotope('layout');
												jQuery('.list-item.col-md-4').removeClass('opacity-0');
											},500);
										}
										else
										{
											jQuery('.list-item.col-md-4').removeClass('opacity-0');
										}

										//open and close share listing
										openCloseShareListing();

										//fix by listing gallery post
										jQuery(".is-slider-post-list").each(function(index, elements){
										   createCarouselPostList(jQuery(this));
										  });

										setTimeout(function(){
											jQuery('.fa-refresh').removeClass("fa-spin");
											jQuery('.fa-refresh').addClass("hide");
											jQuery('.load-title').removeClass("hidden");
											jQuery('#navigation-ajax').removeClass("disabled");
										},500);
									});

									jQuery('input[name=last_index_blog_listing]').val(parseInt(last_index_blog_listing) + parseInt(post_per_page));

									// increase current page
									_current_page = _current_page + 1;



									if(jQuery('.no-posts').length > 0){
										// no more post
										_current_page = -1;
										if(checkLoadingImg.hasClass('is-isotope'))
										{
											setTimeout(function(){
												jQuery(".navigation-ajax").hide('slow');
											},500);
										}
										else
											jQuery(".navigation-ajax").hide('slow');
									}

									icon_loading.addClass('hidden-loading');
									ajax_button.removeClass('hidden1-loading');

								} else {
									_current_page = -1;
									// do something else when there is no more results
									// alert('No more results. You should do something, like hiding this link button. Edit me in /js/ajax.js');
									 jQuery(".navigation-ajax").hide('slow');
								}

								_ajax_loading = false;
							  },
							  error: function(MLHttpRequest, textStatus, errorThrown){
									alert(errorThrown);
									_ajax_loading = false;
									icon_loading.addClass('hidden-loading');
									ajax_button.removeClass('hidden1-loading');
							  }
						  });
					}

				});
		}
	}

	jQuery(document).ready(function(){
		var first_index_blog_listing 	= jQuery('input[name=first_index_blog_listing]').val();
		jQuery('input[name=last_index_blog_listing]').val(first_index_blog_listing);
		var blog_layout 			= jQuery('input[name=hidden_blog_layout]').val();

		jQuery('#navigation-ajax').click(function() {
			jQuery('.fa-refresh').addClass("fa-spin");
			jQuery('.fa-refresh').removeClass("hide");
			jQuery('.load-title').addClass("hidden");
			jQuery('#navigation-ajax').addClass("disabled");
			do_ajax(first_index_blog_listing, blog_layout);
		});

	});
}) ();