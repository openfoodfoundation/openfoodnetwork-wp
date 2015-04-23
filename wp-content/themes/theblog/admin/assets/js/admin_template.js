jQuery(document).ready(function() {

	//show hide settings when choose page tempate
		var page_tpl_obj 				= jQuery('select[name=page_template]');
		var page_tpl 					= jQuery('select[name=page_template]').val();
		var front_page_layout_obj 		= jQuery('#page_meta_box_front_page_layout.postbox');
		var front_page_header_obj 		= jQuery('#page_meta_box_front_page_header.postbox');
		var front_page_content_obj 		= jQuery('#page_meta_box_front_page_content.postbox');

		if(page_tpl == 'page-templates/front-page.php'){
			front_page_layout_obj.show();
			front_page_header_obj.show();
			front_page_content_obj.show();
		}else{
			front_page_layout_obj.hide();
			front_page_header_obj.hide();
			front_page_content_obj.hide();
		}

		page_tpl_obj.change(function(event) {
			if(jQuery(this).val() == 'page-templates/front-page.php'){
				front_page_layout_obj.show(200);
				front_page_header_obj.show(200);
				front_page_content_obj.show(200);
			}else{
				front_page_layout_obj.hide(200);
				front_page_header_obj.hide(200);
				front_page_content_obj.hide(200);
			}
		});

	// js for front page template
	if(page_tpl_obj.length > 0)
	{
		var theme_layout_obj 					= jQuery('#theme_layout');
		var theme_layout 						= jQuery('#theme_layout').val();
		var header_layout_obj 					= jQuery('#header_layout');
		var header_layout 						= jQuery('#header_layout').val();
		var setting_header_layout 				= jQuery('#setting_header_layout');
		var setting_header_carousel_count_obj 	= jQuery('#setting_header_carousel_count');
		var setting_background_slider_shortcode = jQuery('#setting_background_slider_shortcode');
		var setting_header_static_text_1 		= jQuery('#setting_header_static_text_1');
		var setting_header_static_text_2 		= jQuery('#setting_header_static_text_2');
		var setting_header_static_text_3 		= jQuery('#setting_header_static_text_3');
		var setting_header_background_color 	= jQuery('#setting_header_background_color');
		var setting_front_page_heading 			= jQuery('#setting_front_page_heading');
		var setting_header_carousel_categories 	= jQuery('#setting_header_carousel_categories');
		var setting_header_carousel_tags 		= jQuery('#setting_header_carousel_tags');
		var setting_header_carousel_ids 		= jQuery('#setting_header_carousel_ids');
		var setting_header_carousel_order_by 	= jQuery('#setting_header_carousel_order_by');

		if(theme_layout == 'standard')
		{
			setting_front_page_heading.hide();
			if(header_layout == 'static_text_biography')
			{
				setting_header_static_text_1.show();
				setting_header_static_text_2.show();
				setting_header_static_text_3.show();
				setting_header_background_color.show();
				setting_header_carousel_count_obj.hide();
				setting_background_slider_shortcode.hide();
				setting_header_carousel_categories.hide();
				setting_header_carousel_tags.hide();
				setting_header_carousel_ids.hide();
				setting_header_carousel_order_by.hide();
			}
			else if(header_layout == 'bottom_posts_carousel' || header_layout == 'top_posts_carousel' || header_layout == 'posts_tab')
			{
				setting_header_static_text_1.hide();
				setting_header_static_text_2.hide();
				setting_header_static_text_3.hide();
				setting_header_background_color.hide();
				setting_background_slider_shortcode.hide();
				setting_header_carousel_count_obj.show();
				setting_header_carousel_categories.show();
				setting_header_carousel_tags.show();
				setting_header_carousel_ids.show();
				setting_header_carousel_order_by.show();
			}
			else if(header_layout == 'background_slider')
			{
				setting_header_static_text_1.hide();
				setting_header_static_text_2.hide();
				setting_header_static_text_3.hide();
				setting_header_background_color.hide();
				setting_header_carousel_count_obj.hide();
				setting_background_slider_shortcode.show();
				setting_header_carousel_categories.hide();
				setting_header_carousel_tags.hide();
				setting_header_carousel_ids.hide();
				setting_header_carousel_order_by.hide();
			}
			else
			{
				setting_header_carousel_count_obj.hide();
				setting_header_static_text_1.hide();
				setting_header_static_text_2.hide();
				setting_header_static_text_3.hide();
				setting_header_background_color.hide();
				setting_background_slider_shortcode.hide();
				setting_header_carousel_categories.hide();
				setting_header_carousel_tags.hide();
				setting_header_carousel_ids.hide();
				setting_header_carousel_order_by.hide();
			}

			header_layout_obj.change(function(event) {
				if(jQuery(this).val() == 'static_text_biography')
				{
					setting_header_static_text_1.show(200);
					setting_header_static_text_2.show(200);
					setting_header_static_text_3.show(200);
					setting_header_background_color.show(200);
					setting_header_carousel_count_obj.hide(200);
					setting_background_slider_shortcode.hide(200);
					setting_header_carousel_categories.hide(200);
					setting_header_carousel_tags.hide(200);
					setting_header_carousel_ids.hide(200);
					setting_header_carousel_order_by.hide(200);

				}
				else if(jQuery(this).val() == 'bottom_posts_carousel' || jQuery(this).val() == 'top_posts_carousel'  || jQuery(this).val() == 'posts_tab')
				{
					setting_header_carousel_count_obj.show(200);
					setting_header_static_text_1.hide(200);
					setting_header_static_text_2.hide(200);
					setting_header_static_text_3.hide(200);
					setting_header_background_color.hide(200);
					setting_background_slider_shortcode.hide(200);
					setting_header_carousel_categories.show(200);
					setting_header_carousel_tags.show(200);
					setting_header_carousel_ids.show(200);
					setting_header_carousel_order_by.show(200);
				}
				else if(jQuery(this).val() == 'background_slider')
				{
					setting_background_slider_shortcode.show(200);
					setting_header_static_text_1.hide(200);
					setting_header_static_text_2.hide(200);
					setting_header_static_text_3.hide(200);
					setting_header_background_color.hide(200);
					setting_header_carousel_count_obj.hide(200);
					setting_header_carousel_categories.hide(200);
					setting_header_carousel_tags.hide(200);
					setting_header_carousel_ids.hide(200);
					setting_header_carousel_order_by.hide(200);
				}
				else
				{
					setting_header_carousel_count_obj.hide(200);
					setting_header_static_text_1.hide(200);
					setting_header_static_text_2.hide(200);
					setting_header_static_text_3.hide(200);
					setting_header_background_color.hide(200);
					setting_background_slider_shortcode.hide(200);
					setting_header_carousel_categories.hide(200);
					setting_header_carousel_tags.hide(200);
					setting_header_carousel_ids.hide(200);
					setting_header_carousel_order_by.hide(200);
				}
			});
		}
		else
		{
			setting_front_page_heading.show();
			setting_header_layout.hide();
			setting_header_carousel_count_obj.hide();
			setting_header_static_text_1.hide();
			setting_header_static_text_2.hide();
			setting_header_static_text_3.hide();
			setting_header_background_color.hide();
			setting_background_slider_shortcode.hide();
			setting_header_carousel_categories.hide();
			setting_header_carousel_tags.hide();
			setting_header_carousel_ids.hide();
			setting_header_carousel_order_by.hide();
		}

		theme_layout_obj.change(function(event) {
			if(jQuery(this).val() == 'standard')
			{
				setting_header_layout.show(200);
				setting_front_page_heading.hide(200);

				header_layout = jQuery('#header_layout').val();

				if(header_layout == 'static_text_biography')
				{
					setting_header_static_text_1.show(200);
					setting_header_static_text_2.show(200);
					setting_header_static_text_3.show(200);
					setting_header_background_color.show(200);
					setting_header_carousel_count_obj.hide(200);
					setting_background_slider_shortcode.hide(200);
					setting_header_carousel_categories.hide(200);
					setting_header_carousel_tags.hide(200);
					setting_header_carousel_ids.hide(200);
					setting_header_carousel_order_by.hide(200);
				}
				else if(header_layout == 'bottom_posts_carousel' || header_layout == 'top_posts_carousel' || header_layout == 'posts_tab')
				{
					setting_header_static_text_1.hide();
					setting_header_static_text_2.hide();
					setting_header_static_text_3.hide();
					setting_header_background_color.hide();
					setting_background_slider_shortcode.hide();
					setting_header_carousel_count_obj.show();
					setting_header_carousel_categories.show();
					setting_header_carousel_tags.show();
					setting_header_carousel_ids.show();
					setting_header_carousel_order_by.show();
				}
				else if(header_layout == 'background_slider')
				{
					setting_header_static_text_1.hide();
					setting_header_static_text_2.hide();
					setting_header_static_text_3.hide();
					setting_header_background_color.hide();
					setting_header_carousel_count_obj.hide();
					setting_background_slider_shortcode.show();
					setting_header_carousel_categories.hide();
					setting_header_carousel_tags.hide();
					setting_header_carousel_ids.hide();
					setting_header_carousel_order_by.hide();
				}
				else
				{
					setting_header_carousel_count_obj.hide();
					setting_header_static_text_1.hide();
					setting_header_static_text_2.hide();
					setting_header_static_text_3.hide();
					setting_header_background_color.hide();
					setting_background_slider_shortcode.hide();
					setting_header_carousel_categories.hide();
					setting_header_carousel_tags.hide();
					setting_header_carousel_ids.hide();
					setting_header_carousel_order_by.hide();
				}

				header_layout_obj.change(function(event) {
					if(jQuery(this).val() == 'static_text_biography')
					{
						setting_header_static_text_1.show(200);
						setting_header_static_text_2.show(200);
						setting_header_static_text_3.show(200);
						setting_header_background_color.show(200);
						setting_header_carousel_count_obj.hide(200);
						setting_background_slider_shortcode.hide(200);
						setting_header_carousel_categories.hide(200);
						setting_header_carousel_tags.hide(200);
						setting_header_carousel_ids.hide(200);
						setting_header_carousel_order_by.hide(200);

					}
					else if(jQuery(this).val() == 'bottom_posts_carousel' || jQuery(this).val() == 'top_posts_carousel'  || jQuery(this).val() == 'posts_tab')
					{
						setting_header_carousel_count_obj.show(200);
						setting_header_static_text_1.hide(200);
						setting_header_static_text_2.hide(200);
						setting_header_static_text_3.hide(200);
						setting_header_background_color.hide(200);
						setting_background_slider_shortcode.hide(200);
						setting_header_carousel_categories.show(200);
						setting_header_carousel_tags.show(200);
						setting_header_carousel_ids.show(200);
						setting_header_carousel_order_by.show(200);
					}
					else if(jQuery(this).val() == 'background_slider')
					{
						setting_background_slider_shortcode.show(200);
						setting_header_static_text_1.hide(200);
						setting_header_static_text_2.hide(200);
						setting_header_static_text_3.hide(200);
						setting_header_background_color.hide(200);
						setting_header_carousel_count_obj.hide(200);
						setting_header_carousel_categories.hide(200);
						setting_header_carousel_tags.hide(200);
						setting_header_carousel_ids.hide(200);
						setting_header_carousel_order_by.hide(200);
					}
					else
					{
						setting_header_carousel_count_obj.hide(200);
						setting_header_static_text_1.hide(200);
						setting_header_static_text_2.hide(200);
						setting_header_static_text_3.hide(200);
						setting_header_background_color.hide(200);
						setting_background_slider_shortcode.hide(200);
						setting_header_carousel_categories.hide(200);
						setting_header_carousel_tags.hide(200);
						setting_header_carousel_ids.hide(200);
						setting_header_carousel_order_by.hide(200);
					}
				});
			}
			else if(jQuery(this).val() == 'left_navigation')
			{
				setting_front_page_heading.show(200);
				setting_header_layout.hide(200);
				setting_header_carousel_count_obj.hide(200);
				setting_header_static_text_1.hide(200);
				setting_header_static_text_2.hide(200);
				setting_header_static_text_3.hide(200);
				setting_header_background_color.hide(200);
				setting_background_slider_shortcode.hide(200);
				setting_header_carousel_categories.hide(200);
				setting_header_carousel_tags.hide(200);
				setting_header_carousel_ids.hide(200);
				setting_header_carousel_order_by.hide(200);
			}
		});

		//show hide settings when choose page tempate
		var page_content_obj 					= jQuery('#page_content');
		var page_content 						= jQuery('#page_content').val();
		var setting_blog_layout 				= jQuery('#setting_blog_layout');
		var setting_post_categories 			= jQuery('#setting_post_categories');
		var setting_post_tags 					= jQuery('#setting_post_tags');
		var setting_post_ids 					= jQuery('#setting_post_ids');
		var setting_order_by 					= jQuery('#setting_order_by');
		var setting_post_count 					= jQuery('#setting_post_count');
		var setting_portfolio_layout 			= jQuery('#setting_portfolio_layout');
		var setting_show_tags_filter 			= jQuery('#setting_show_tags_filter');

		if(page_content == 'page_ct')
		{
			setting_blog_layout.hide();
			setting_post_categories.hide();
			setting_post_tags.hide();
			setting_post_ids.hide();
			setting_order_by.hide();
			setting_post_count.hide();
			setting_portfolio_layout.hide();
			setting_show_tags_filter.hide();
		}
		else if(page_content == 'blog')
		{
			setting_blog_layout.show();
			setting_post_categories.show();
			setting_post_tags.show();
			setting_post_ids.show();
			setting_order_by.show();
			setting_post_count.show();
			setting_portfolio_layout.hide();
			setting_show_tags_filter.hide();
		}
		else if(page_content == 'portfolio')
		{
			setting_blog_layout.hide();
			setting_post_categories.hide();
			setting_post_tags.hide();
			setting_post_ids.hide();
			setting_order_by.hide();
			setting_post_count.hide();
			setting_portfolio_layout.show();
			setting_show_tags_filter.show();
		}
		else
		{
			setting_blog_layout.hide();
			setting_post_categories.hide();
			setting_post_tags.hide();
			setting_post_ids.hide();
			setting_order_by.hide();
			setting_post_count.hide();
			setting_portfolio_layout.hide();
			setting_show_tags_filter.hide();
		}

		page_content_obj.change(function(event) {
			if(jQuery(this).val() == 'page_ct')
			{
				setting_blog_layout.hide(200);
				setting_post_categories.hide(200);
				setting_post_tags.hide(200);
				setting_post_ids.hide(200);
				setting_order_by.hide(200);
				setting_post_count.hide();
				setting_portfolio_layout.hide(200);
				setting_show_tags_filter.hide(200);

			}
			else if(jQuery(this).val() == 'blog')
			{
				setting_blog_layout.show(200);
				setting_post_categories.show(200);
				setting_post_tags.show(200);
				setting_post_ids.show(200);
				setting_order_by.show(200);
				setting_post_count.show(200);
				setting_portfolio_layout.hide(200);
				setting_show_tags_filter.hide(200);
			}
			else if(jQuery(this).val() == 'portfolio')
			{
				setting_blog_layout.hide(200);
				setting_post_categories.hide(200);
				setting_post_tags.hide(200);
				setting_post_ids.hide(200);
				setting_order_by.hide(200);
				setting_post_count.hide(200);
				setting_portfolio_layout.show(200);
				setting_show_tags_filter.show(200);
			}
			else
			{
				setting_blog_layout.hide(200);
				setting_post_categories.hide(200);
				setting_post_tags.hide(200);
				setting_post_ids.hide(200);
				setting_order_by.hide(200);
				setting_post_count.hide();
				setting_portfolio_layout.hide(200);
				setting_show_tags_filter.hide(200);
			}
		});
	}
		


	jQuery(document).on('click','#id_cactus_alert button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_alert_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_button button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_button_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_compare button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_compare_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_divider button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_divider_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_dropcap button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_dropcap_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_icon_box button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_iconbox_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_image_carousel button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_image_carousel_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_image_column button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_image_column_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_row_col button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_row_col_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_textblock button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_text_block_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_tooltip button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_tooltip_shortcode button').trigger( "click" );
	});

});

jQuery(document).ready(function(){
	var defaultVal=jQuery('input[name=post_format]:checked', '#post').val();
	checkPostformat(defaultVal);
	jQuery('input[name=post_format]', '#post').click(function(){
		var keyVal=jQuery(this).val();
		checkPostformat(keyVal);
	});
	function checkPostformat(strVal){

		switch(strVal) {
		case "0":
			jQuery('#setting_post_standard_layout').show('slow');
			jQuery('#setting_post_gallery_layout').hide('slow');
			jQuery('#setting_post_gallery_v1_slider_height').hide('slow');
			break;
		case "audio":
			jQuery('#setting_post_gallery_layout').hide('slow');
			jQuery('#setting_post_gallery_v1_slider_height').hide('slow');
			jQuery('#setting_post_standard_layout').hide('slow');
			break;
		case "video":
			jQuery('#setting_post_gallery_layout').hide('slow');
			jQuery('#setting_post_gallery_v1_slider_height').hide('slow');
			jQuery('#setting_post_standard_layout').hide('slow');
			break;
		case "gallery":
			jQuery('#setting_post_gallery_layout').show('slow');
			jQuery('#setting_post_gallery_v1_slider_height').show('slow');
			jQuery('#setting_post_standard_layout').hide('slow');
			break;
		case "quote":
			jQuery('#setting_post_gallery_layout').hide('slow');
			jQuery('#setting_post_gallery_v1_slider_height').hide('slow');
			jQuery('#setting_post_standard_layout').hide('slow');
			break;
		}
	};
});


//custom upload image in User Setting.
jQuery(document).ready(function($){

    var custom_uploader;

    $('#upload_image_button').click(function(e) {

        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            if($('#author_header_background').length > 0)
            	$('#author_header_background').val(attachment.url);
        });
        //Open the uploader dialog
        custom_uploader.open();

    });

	$('#upload_image_button1').click(function(e) {

	    e.preventDefault();

	    //If the uploader object has already been created, reopen the dialog
	    if (custom_uploader) {
	        custom_uploader.open();
	        return;
	    }

	    //Extend the wp.media object
	    custom_uploader = wp.media.frames.file_frame = wp.media({
	        title: 'Choose Image',
	        button: {
	            text: 'Choose Image'
	        },
	        multiple: false
	    });

	    //When a file is selected, grab the URL and set it as the text field's value
	    custom_uploader.on('select', function() {
	        attachment = custom_uploader.state().get('selection').first().toJSON();
	        if($('#page_background').length > 0)
	        	$('#page_background').val(attachment.url);
	    });
	    //Open the uploader dialog
	    custom_uploader.open();

	});

});

//Remove image in User Setting.
jQuery(document).ready(function($){
	$('#remove_image_button').click(function(e) {
		if($('#author_header_background').length > 0)
	  		$('#author_header_background').val('');
	  	if($('#page_background').length > 0)
	  		$('#page_background').val('');
	});
	$('#remove_image_button1').click(function(e) {
	  	if($('#page_background').length > 0)
	  		$('#page_background').val('');
	});
});

