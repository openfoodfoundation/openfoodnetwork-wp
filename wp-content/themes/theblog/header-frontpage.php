<?php

    global $header_layout;

    if($header_layout == 'background_slider')
        get_background_slider_header();

    else if($header_layout == 'static_text_biography')
        get_author_biography_header();

    else if($header_layout == 'bottom_posts_carousel' || $header_layout == 'top_posts_carousel')
        get_posts_carousel_header();

    else if($header_layout == 'posts_tab')
        get_posts_tab_header();

    else
        get_background_slider_header();

?>

<?php

function get_background_slider_header()
{
    if(is_front_page())
    {
        $page_on_front = get_option('page_on_front');
        if($page_on_front == 0 || $page_on_front == '')
        {
            $background_slider_shortcode = ot_get_option('background_slider_shortcode');
        }
        else
        {
            $background_slider_shortcode = get_post_meta(get_the_ID(),'background_slider_shortcode',true);
        }

    }
    else if(is_page_template('page-templates/front-page.php'))
        $background_slider_shortcode = get_post_meta(get_the_ID(),'background_slider_shortcode',true);

	if($background_slider_shortcode != '' && $background_slider_shortcode != null)
	{
		$addFullHeight = '';
		$strpos_fullheight_1=strpos($background_slider_shortcode, "full_height='1'");
		$strpos_fullheight_2=strpos($background_slider_shortcode, "full_height=''");
		$strpos_fullheight_3=strpos($background_slider_shortcode, 'full_height="1"');
		$strpos_fullheight_4=strpos($background_slider_shortcode, 'full_height=""');

		if(	$strpos_fullheight_1 !== false || $strpos_fullheight_2 !== false || $strpos_fullheight_3 !== false || $strpos_fullheight_4 !== false) {
			$addFullHeight='data-full-height-wrap="1"';
		}

		echo '<div id="top-background-slider-0" class="cactus-background-color-2" '. $addFullHeight .'>';
			echo do_shortcode($background_slider_shortcode);
		echo '</div>';

	}else{

		echo '<div id="top-background-slider-0" class="cactus-background-color-2">';
			echo do_shortcode('[b-slider cats="" ids="" number_of_slides="" auto_play="" pagination="" transition="" full_height="" scroll_down_button=""]');
		echo '</div>';

	}
}

function get_author_biography_header()
{
    $header_background_color = '';

    if(is_front_page())
    {
        $page_on_front = get_option('page_on_front');
        if($page_on_front == 0 || $page_on_front == '')
        {
            $header_static_text_1 = ot_get_option('header_static_text_1', 'Enter text in the first line');
            $header_static_text_2 = ot_get_option('header_static_text_2', 'Enter text in the second line');
            $header_static_text_3 = ot_get_option('header_static_text_3', 'Enter text in the third line');
        }
        else
        {
            $header_static_text_1 = get_post_meta(get_the_ID(),'header_static_text_1',true);
            $header_static_text_2 = get_post_meta(get_the_ID(),'header_static_text_2',true);
            $header_static_text_3 = get_post_meta(get_the_ID(),'header_static_text_3',true);
            $header_background_color = get_post_meta(get_the_ID(),'header_background_color',true);
        }

    }
    else if(is_page_template('page-templates/front-page.php'))
    {
        $header_static_text_1 = get_post_meta(get_the_ID(),'header_static_text_1',true);
        $header_static_text_2 = get_post_meta(get_the_ID(),'header_static_text_2',true);
        $header_static_text_3 = get_post_meta(get_the_ID(),'header_static_text_3',true);
        $header_background_color = get_post_meta(get_the_ID(),'header_background_color',true);
    }

    $html = '';
    if($header_background_color != '')
    {
        $html .= '<style type="text/css">#header-navigation.index-v2 .cactus-wraper-slider-bg .background-color-1 {background-color:' . $header_background_color . '}</style>';
    }

    $html .='
    <div class="cactus-wraper-slider-bg">
        <div class="slider header-v2 background-color-1" data-auto-play="" data-pagination="0" data-transition="fade" data-full-height="0">
            <div class="slider-item is-text-parallax">
                <div class="container">
                    <div class="row">
                        <div class="text-content col-md-12">
                            <div class="text-1 font-1"><span>' . $header_static_text_1 . '</span></div>
                            <div class="text-2 font-3"><span>' . $header_static_text_2 . '</span></div>
                            <div class="text-3 font-1"><span>' . $header_static_text_3 . '</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';

    global $allowedposttags;
    $allowattributes = array('type'=>array());
    $allowedposttags['style']=$allowattributes;

    echo wp_kses_post($html,$allowedposttags);
}

function get_posts_carousel_header()
{
    $options = array();
    $options = prepare_data_posts_carousel_posts_tab();

    $the_query = new WP_Query( $options );

    $html = '';
    $html .='
    <div class="cactus-wraper-slider-bg">
        <div class="slider cactus-silder-multi background-color-1" data-auto-play="4000" data-pagination="0">';
        if($the_query->have_posts())
        {
            while($the_query->have_posts())
            {
                $the_query->the_post();

                //get images thumbnail and alt text
                $img_id     = get_post_thumbnail_id();
                $image      = wp_get_attachment_image_src($img_id, 'thumb_carousel');
				$image_mobile      = wp_get_attachment_image_src($img_id, 'thumb_carousel_mobile');
                if($image[0] == '')
                    $image[0] = esc_url(get_template_directory_uri() . '/images/default_image.jpg');
                $alt_text   = get_post_meta($img_id , '_wp_attachment_image_alt', true);
                $category   = get_the_category();

                $html .='
                    <div class="slider-item">

                        <a href="' . esc_url(get_permalink()) . '" title="' . get_the_title() . '">
                            <div class="picture-content adaptive">
								<noscript data-src-small="'.$image_mobile[0].'"
									data-src-medium="'.$image[0].'"
									data-src-high="'.$image[0].'"
									data-src-x-high="'.$image[0].'">
										<img src="'.$image_mobile[0].'" alt="' . $alt_text . '" title="' . get_the_title() . '" width="'.$image_mobile[1].'" height="'.$image_mobile[2].'">
								</noscript>
                                <img src="' . $image[0] . '" alt="' . $alt_text . '" title="' . get_the_title() . '">
                            </div>

                            <div class="thumb-overlay"></div>

                            <div class="text-content">
                                <div class="text-1 font-1"><span>' . $category[0]->name . '</span></div>
                                <div class="text-2 font-1"><span>' . get_the_title() . '</span></div>
                                <div class="text-3">
                                    <span>' . get_the_excerpt() . '</span>
                                </div>
                            </div>
                        </a>

                    </div>';
            }
            wp_reset_postdata();
        }
    $html .='
        </div>
    </div>';

    echo wp_kses_post($html);
}

function get_posts_tab_header()
{
    $options = array();
    $options = prepare_data_posts_carousel_posts_tab();

    $the_query = new WP_Query( $options );

    $html = '';
    $html .='
    <div class="cactus-wraper-slider-bg">
        <div class="slider" data-auto-play="" data-pagination="0">
            <div class="list-post-nav">
                <div class="container">
                    <div class="row">
                        <div class="table-fix">
                            <div class="col-md-7 fix-left">
                                <div class="picture-content">
                                    <div class="picture">

                                    </div>

                                    <div class="loading-background active background-color-2"></div>
                                    <div class="loading-img active">
                                         <div class="floatingCirclesG">
                                             <div class="f_circleG frotateG_01"></div>
                                             <div class="f_circleG frotateG_02"></div>
                                             <div class="f_circleG frotateG_03"></div>
                                             <div class="f_circleG frotateG_04"></div>
                                             <div class="f_circleG frotateG_05"></div>
                                             <div class="f_circleG frotateG_06"></div>
                                             <div class="f_circleG frotateG_07"></div>
                                             <div class="f_circleG frotateG_08"></div>
                                         </div>
                                     </div>

                                </div>
                            </div>
                            <div class="col-md-5 fix-right">
                                <div class="overflow-fix">
                                    <div class="title-content">';
                                        if($the_query->have_posts())
                                        {
                                            while($the_query->have_posts())
                                            {
                                                $the_query->the_post();

                                                //get images thumbnail and alt text
                                                $img_id     = get_post_thumbnail_id();
                                                $image      = wp_get_attachment_image_src($img_id, array('720', '455'));
                                                if($image[0] == '')
                                                    $image[0] = esc_url(get_template_directory_uri() . '/images/default_image.jpg');
                                                $alt_text   = get_post_meta($img_id , '_wp_attachment_image_alt', true);

                                                $html .='
                                                    <div class="title-item" data-loading="" data-picture="' . $image[0] . '">
                                                        <a class="link-mobile" href="' . esc_url(get_permalink()) . '" title="' . get_the_title() . '">
                                                            <div class="item-struc">
                                                                <span class="title font-1">' . get_the_title() . '</span>
                                                                <span class="info font-1">' . esc_html__('By','cactusthemes') . ' <span class="name">' . get_the_author() . '</span>, ' . esc_html__('on ', 'cactusthemes') . date_i18n(get_option('date_format') ,get_the_time('U')) . '</span>
                                                            </div>
                                                        </a>

                                                        <div class="data-social-images">
                                                            <a href="' . esc_url(get_permalink()) . '" title="' . get_the_title() . '">
                                                                <img class="get-picture" src="' . $image[0] . '" alt="" title="' . get_the_title() . '">
                                                                <div class="thumb-overlay"></div>
                                                            </a>

                                                            <div class="social-content">
                                                                <!--Remove-->
                                                                <ul class="list-inline social-listing">';

																$social_html = '';
                                                                ob_start();
                                                                cactus_print_social_share();
																$social_html = ob_get_contents();
																ob_end_clean();
																$html .= $social_html;

                                                                $html .= '
                                                                </ul><!--Remove-->
                                                            </div>
                                                        </div>

                                                    </div>';
                                            }
                                            wp_reset_postdata();
                                        }
    $html .='                       </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';

	global $allowedposttags;
	$allowattributes = array('class'=>array(),'id'=>array(),'data-auto-play'=>array(),'data-loading'=>array(),'data-picture'=>array());
	$allowedposttags['div']=$allowattributes;

    echo wp_kses_post($html,$allowedposttags);
}

function prepare_data_posts_carousel_posts_tab()
{
    $options = array(
        'post_type'             => 'post',
        'orderby'               => 'date',
        'order'                 => 'desc',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => true
    );

    if(is_front_page())
    {
        $page_on_front = get_option('page_on_front');
        if($page_on_front == 0 || $page_on_front == '')
        {
            $options['posts_per_page'] = ot_get_option('header_carousel_count') != '' ? ot_get_option('header_carousel_count') : '6';
                    $options['meta_query'] = array(array(
                                'key'     => 'featured_post',
                                'value'   => 'yes',
                            ),
                        );
        }
        else
        {
            $options = array_merge($options, get_data_carousel_posts_tab());
        }
    }
    else if(is_page_template('page-templates/front-page.php'))
    {
        $options = array_merge($options, get_data_carousel_posts_tab());
    }

    return $options;
}

function get_data_carousel_posts_tab()
{
    $options = array();
    $post_carousel_header_limit = get_post_meta(get_the_ID(),'header_carousel_count',true);
    $post_carousel_cat          = get_post_meta(get_the_ID(),'header_carousel_categories',true);
    $post_carousel_tags         = get_post_meta(get_the_ID(),'header_carousel_tags',true);
    $post_carousel_ids          = get_post_meta(get_the_ID(),'header_carousel_ids',true);
    $post_carousel_order_by     = get_post_meta(get_the_ID(),'header_carousel_order_by',true);

    // if you don't setup post_ids param
    if(isset($post_carousel_ids) && $post_carousel_ids == '')
    {
        if(isset($post_carousel_cat) && $post_carousel_cat != '')
        {
            $cats = explode(",",$post_carousel_cat);
            if(is_numeric($cats[0]))
                $options['cat'] = $post_carousel_cat;
            else
                $options['category_name'] = $post_carousel_cat;
        }
        if(isset($post_carousel_tags) && $post_carousel_tags != '')
        {
            $options['tag'] = $post_carousel_tags;
        }
    }
    else
    {
        $ids = explode(",",$post_carousel_ids);
        if(is_numeric($ids[0]))
            $options['post__in'] = $ids;
    }

    $options['orderby']             = $post_carousel_order_by == 'random' ? 'rand' : 'date';
    $options['posts_per_page']      = $post_carousel_header_limit;

    return $options;
}