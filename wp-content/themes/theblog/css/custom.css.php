<?php

/* Get Theme Options here and echo custom CSS */
//
// for example:
// $topmenu_visible = ot_get_option( 'topmenu_visible', 1);

echo ot_get_option('custom_css','');

$body_font = ot_get_option('body_font',''); // for example, Playfair+Display:900
if($body_font){
	$font_name = get_google_font_name($body_font);
	
	// split the subset font name
	$texts = split('&',$font_name);
	if(count($texts) > 1) $font_name = $texts[0];
		
?>
body{font-family: "<?php echo esc_html($font_name);?>"}
<?php
}

// main color
$main_color = ot_get_option('main_color', '#25c3d8');
if(strtolower($main_color) != '#25c3d8') {
	?>
	/* background */

	.background-color-1,
	button, input[type=button], input[type=submit], .btn-default,
	.body-content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header:hover, .body-content .wpb_accordion .wpb_accordion_wrapper .ui-state-active,
	.dark-div .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header:hover, .dark-div .wpb_accordion .wpb_accordion_wrapper .ui-state-active,
	header .nav-default > .navbar-default ul li ul li:hover,
	header .nav-default > .navbar-default ul li ul li:last-child:hover,
	li[id*="mega-menu-item-"] div.sub-content.dropdown-menu ul.sub-channel > li:hover,
	li[id*="mega-menu-item-"] div.sub-content.dropdown-menu ul.sub-channel > li.hover,
	li[id*="mega-menu-item-"] div.sub-content.dropdown-menu ul.columns > li > ul.list li:hover,
	header .nav-default > .navbar-default .navbar-toggle:focus .icon-bar, .navbar-default .navbar-toggle:hover .icon-bar,
	.widget_tag_cloud .tagcloud a[class*="tag-link-"],
	.tag-group a:hover, .tag-group a.active,
	.cactus-light.active,
	header .nav-default.index-v4 > .navbar-default,
	.recommended.compare-table-wrapper .compare-table
	{
	 	background-color: <?php echo esc_html($main_color);?>;
	}

	@keyframes OldfixMinHeight1 {
		from { min-height:50px; background-color:rgba(0,0,0,0.75);}
		to { min-height:100px; background-color: <?php echo esc_html($main_color);?>;}
	}
	@-webkit-keyframes OldfixMinHeight1 {
		from { min-height:50px; background-color:rgba(0,0,0,0.75);}
		to { min-height:100px; background-color: <?php echo esc_html($main_color);?>;}
	}

	@media(max-width:1199px) {
			header .nav-default.index-v4 > .navbar-default.fixed-menu {background-color:<?php echo esc_html($main_color);?>}
	}

	@keyframes defaultfixMinHeight1 {
		from { min-height:100px; background-color: <?php echo esc_html($main_color);?>;}
		to { min-height:50px; background-color:rgba(0,0,0,0.75);}
	}
	@-webkit-keyframes defaultfixMinHeight1 {
		from { min-height:100px; background-color: <?php echo esc_html($main_color);?>;}
		to { min-height:50px; background-color:rgba(0,0,0,0.75);}
	}

	/* color */

	.color-1,
	a, a:active, a:focus, a:visited,
	.dark-div a:hover,
	.dark-div .body-content > a, .dark-div .body-content > a:active, .dark-div .body-content > a:focus, .dark-div .body-content > a:visited,
	.dark-div.body-content > a, .dark-div.body-content > a:active, .dark-div.body-content > a:focus, .dark-div.body-content > a:visited,
	a[data-toggle="tooltip"]:hover,
	.dark-div a[data-toggle="tooltip"],
	.body-content ul li a:hover, .body-content ol li a:hover,
	.dark-div .body-content ul > li > a:hover, .dark-div .body-content ol > li > a:hover,
	.body-content .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a:hover,
	.dark-div .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a:hover,
	header .nav-default > .navbar-default .navbar-nav>li>a:hover,
	header .nav-default > .navbar-default .navbar-nav.buy-theme>li>a:hover,
	header .nav-default > .navbar-default .navbar-nav > li.current-menu-item>a,
	header .nav-default > .navbar-default .navbar-nav > li.current-menu-item>a:hover,
	header .nav-default > .navbar-default ul > li:hover > a,
	li[id*="mega-menu-item-"] div.sub-content.dropdown-menu div.channel-content .content-item h3 > a:hover,
	header .nav-default > .navbar-default .navbar-toggle.search:hover,
	.off-canvas-inner .off-menu > ul li a:hover,
	.author-page .slider-item .text-content .text-3 .social-listing li:hover i,
	.social-listing li:hover i,
	.list-content.post-grid .item-info .category > span > a:hover,
	.list-content.post-grid .item-title > a:hover,
	.list-content.post-grid .item-author .author-content .author-name a:hover,
	.list-content.post-grid .list-item .item-sub-author cite > a:hover,
	.style-post.quote blockquote cite a:hover,
	.list-content.post-grid .cactus-related-posts .related-posts-content .related-posts-title > a:hover,
	.widget-latest-comments .post-item .post-item-info a:hover,
	.widget-latest-posts .related-posts-content .related-posts-item .content > span.title > a:hover,
	.widget-social-listing .list-inline li:hover .title,
	.dark-div .widget-social-listing .social-listing li:hover i,
	.listing-sc-content li a:hover,
	.listing-sc-content.menu li ul li a:hover,
	.dark-div .listing-sc-content.menu li a:hover,
	.widget_categories li a:hover,
	.widget_meta li a:hover,
	.widget_archive li a:hover,
	.widget_recent_entries li a:hover,
	.widget_recent_comments li a:hover,
	.widget_pages li a:hover,
	.widget_nav_menu li a:hover,
	.widget_recent_comments li .comment-author-link > a,
	.dark-div .widget_categories li a:hover,
	.dark-div .widget_meta li a:hover,
	.dark-div .widget_archive li a:hover,
	.dark-div .widget_recent_entries li a:hover,
	.dark-div .widget_recent_comments li a:hover,
	.dark-div .widget_pages li a:hover,
	.dark-div .widget_nav_menu li a:hover,
	.dark-div .widget_recent_comments li .comment-author-link > a,
	.dark-div .widget_calendar a:hover,
	a.next-to-comments:hover,
	.cactus-wraper-slider-bg a.next-to-comments:hover,
	.n-p-posts .p-post a:hover, .n-p-posts .n-post a:hover,
	.p-related-posts .related-posts-content .related-posts-item .content > span.title > a:hover,
	.single-page-content .list-content.post-grid.post-wide .item-title > a > h3:hover,
	#comments .comment-list .comment-body .comment-meta a:hover,
	#comments .comment-list .comment-body .reply a:hover,
	#comments .comment-notes,
	#comments .comment-awaiting-moderation,
	#comments #cancel-comment-reply-link:hover,
	.list-content.post-grid.modern-grid .sub-title-author .social-listing li:hover i,
	.list-post-nav .picture-content .picture .social-content .social-listing li:hover i,
	.list-content.background-color-5c:not(.post-classic):not(.post-wide):not(.modern-grid) .widget-latest-comments .comment-content a:hover,
	.list-wrap.index-v4 .list-content.background-color-5c .widget-latest-comments .comment-content a:hover,
	.list-content.background-color-5c:not(.post-classic):not(.post-wide):not(.modern-grid) .listing-sc-content.menu li ul li a:hover,
	.list-wrap.index-v4 .listing-sc-content.menu li ul li a:hover,
	.cactus-single-page .single-page-content .title-content .text-1 a:hover,
	.cactus-single-page .single-page-content .title-content .text-3 .author-name a:hover,
	.cactus-single-page .single-page-content .title-content .text-3 > span > span a:hover,
	.standard-v1 .slider-item .text-content a:hover
	{
		color: <?php echo esc_html($main_color);?>;
	}

	/*color need using important attribute*/
	.wptt_TwitterTweets ul.fetched_tweets li.tweets_avatar .tweet_data a:hover
	{
		color: <?php echo esc_html($main_color);?> !important;
	}

	/* border color */

	header .nav-default > .navbar-default .navbar-nav.buy-theme>li>a:hover,
	.off-canvas-inner .off-menu > ul.buytheme-mobile-menu li a:hover,
	.author-page .slider-item .text-content .text-3 .social-listing li:hover,
	.social-listing li:hover,
	.widget-social-listing .social-listing li:hover,
	.dark-div .widget-social-listing .social-listing li:hover,
	.container-version-6 .version-6-row .version-6-table-left .off-canvas-inner .off-menu > ul.buytheme-mobile-menu li a:hover,
	.list-content.post-grid.modern-grid .sub-title-author .social-listing li:hover,
	.list-post-nav .picture-content .picture .social-content .social-listing li:hover
	{
		border-color: <?php echo esc_html($main_color);?>;
	}


	<?php
		$rtl_options = ot_get_option('rtl', 'off');
		if($rtl_options != '' && $rtl_options == 'on'):
	?>
		.list-post-nav .title-content .title-item {border-left:none; border-right:3px solid rgba(153,153,153,0.3);}
		.list-post-nav .title-content .title-item:hover, .list-post-nav .title-content .title-item.active {border-left:none; border-right: 3px solid <?php echo esc_html($main_color);?>;}
	<?php else:?>
		.list-post-nav .title-content .title-item:hover, .list-post-nav .title-content .title-item.active {border-left:3px solid <?php echo esc_html($main_color);?>}
	<?php endif;?>


<?php } ?>


<?php
$google_font = ot_get_option('google_font', 'off');
if($google_font == 'on')
{
// main font family
	$main_font = ot_get_option('main_font_family');
	if($main_font){
		$font_name = get_google_font_name($main_font);
		
		// split the subset font name
		$texts = preg_split('/&/',$font_name);
		if(count($texts) > 1) $font_name = $texts[0];
		
		if($font_name != 'Crimson Text') {
?>
	html, body,
	.font-2,
	.cactus-slider-single,
	.cactus-font-2
	{font-family: "<?php echo esc_html($font_name);?>";}
<?php
	}
}
?>

<?php
// main heading font family
	$main_heading_font = ot_get_option('heading_font_family');
	if($main_heading_font){
		$heading_font_name = get_google_font_name($main_heading_font);
		
		// split the subset font name
		$texts = preg_split('/&/',$heading_font_name);
		if(count($texts) > 1) $heading_font_name = $texts[0];
		
		if($heading_font_name != 'Roboto') {
?>
	.font-1,
	button, input[type=button], input[type=submit], .btn-default,
	.body-content table tbody tr:first-child,
	input:not([type]), input[type="color"], input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="search"], textarea, .form-control,
	textarea,
	input:not([type]):focus, input[type="color"]:focus, input[type="email"]:focus, input[type="number"]:focus, input[type="password"]:focus, input[type="tel"]:focus, input[type="url"]:focus , input[type="search"]:focus, .form-control:focus, textarea:focus, input[type="text"]:focus,
	.body-content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a,
	.body-content .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
	.page-navigation,
	aside .widget-title,
	.textwidget.font-1, .textwidget,
	.widget_tag_cloud .tagcloud a[class*="tag-link-"],
	.widget_calendar caption,
	.widget_calendar td#prev , .widget_calendar td#next,
	.wptt_TwitterTweets ul.fetched_tweets li.tweets_avatar .tweet_data,
	blockquote,
	.tag-group a,
	#comments > h2.comments-title,
	#comments .comment-list .comment-body .reply a,
	#comments .comment-list .comment-body .comment-metadata a,
	#comments .comment-list .comment-author b.fn,
	#comments .comment-reply-title,
	#comments .logged-in-as,
	#comments .form-submit input[type=submit]#submit,
	.body-content table thead tr:first-child,
	.cactus-font-1,
    h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6
	{font-family: "<?php echo esc_html($heading_font_name);?>";}


	/*cannot combine*/
	.form-control::-moz-placeholder {font-family: "<?php echo esc_html($heading_font_name);?>";}
	.form-control:-ms-input-placeholder {font-family: "<?php echo esc_html($heading_font_name);?>";}
	.form-control::-webkit-input-placeholder {font-family: "<?php echo esc_html($heading_font_name);?>";}
	input::-moz-placeholder {font-family: "<?php echo esc_html($heading_font_name);?>";}
	input:-ms-input-placeholder {font-family: "<?php echo esc_html($heading_font_name);?>";}
	input::-webkit-input-placeholder {font-family: "<?php echo esc_html($heading_font_name);?>";}
	textarea::-moz-placeholder {font-family: "<?php echo esc_html($heading_font_name);?>";}
	textarea:-ms-input-placeholder {font-family: "<?php echo esc_html($heading_font_name);?>";}
	textarea::-webkit-input-placeholder {font-family: "<?php echo esc_html($heading_font_name);?>";}

<?php
		}
	}
}
?>

<?php
// main font size
	$main_font_size = ot_get_option('main_font_size', '18');
	if($main_font_size != '18'){
?>
	html, body {font-size: <?php echo intval($main_font_size);?>px;}
<?php } ?>

<?php

//custom fonts 1
if($custom_font_1 = ot_get_option( 'custom_font_1')){ ?>
	@font-face
    {
    	font-family: 'Custom Font 1';
    	src: url('<?php echo esc_url($custom_font_1); ?>';
    }
<?php } ?>

<?php
//custom fonts 1
if($custom_font_2 = ot_get_option( 'custom_font_2')){ ?>
	@font-face
    {
    	font-family: 'Custom Font 2';
    	src: url('<?php echo esc_url($custom_font_2); ?>';
    }
<?php } ?>