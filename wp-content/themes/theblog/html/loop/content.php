<?php
/**
 * @package cactus-theblog
 */

	global $_is_retina_;
    global $blog_layout;
    global $index_blog_listing;
    global $is_index_blog_listing_ajax;
    if($is_index_blog_listing_ajax == false)
        $index_blog_listing     = $wp_query->current_post + 1;

    $class_special          = (($index_blog_listing + 1) % 4 == 0 || $index_blog_listing % 4 ==0) ? 'fix-50' : '';

    $fix_no_picture_class   = ($blog_layout == 'normal_classic' && !has_post_thumbnail() && get_post_format() != 'gallery') ? 'fix-no-picture' : '';
    $fix_social_share_html  = ($blog_layout == 'modern' || $blog_layout == 'masonry_modern') ? '<div class="fix-color-modern background-color-1"></div>' : '';
    $open_a_tag             = ($blog_layout != 'modern' && $blog_layout != 'masonry_modern') ? '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" class="adaptive">' : '';
    $close_a_tag            = ($blog_layout != 'modern' && $blog_layout != 'masonry_modern') ? '</a>' : '';
    $quote_post_class       = get_post_format() == 'quote' ? 'quote-post ' : '';
	
	// detect correct thumb size
	global $_device_;
	$thumb_size = '';
	$sizes = array();

	if($blog_layout == 'grid')
		$thumb_size = 'thumb_listing_grid';

	else if($blog_layout == 'masonry' || $blog_layout == 'modern')
		$thumb_size = 'thumb_listing_masonry';

	else if($blog_layout == 'wide_classic')
		$sizes = array('thumb_listing_wide_mobile','thumb_listing_wide_tablet','thumb_listing_wide_pc','thumb_listing_wide_pc');

	else if($blog_layout == 'normal_classic')
		$sizes = array('thumb_listing_classic_mobile','thumb_listing_classic','thumb_listing_classic','thumb_listing_classic');
		
	else if($blog_layout == 'one_column') {
		if($class_special == 'fix-50') {
			$sizes = array('thumb_listing_onecolumn_mobile','thumb_listing_onecolumn_mobile','thumb_listing_onecolumn_small_1x','thumb_listing_onecolumn_small_2x');
		} else {
			$sizes = array('thumb_listing_onecolumn_mobile','thumb_listing_onecolumn_mobile','thumb_listing_onecolumn_big_1x','thumb_listing_onecolumn_big_2x');
		}
	}
		
	else if($blog_layout == 'masonry_modern')
		$thumb_size = 'thumb_listing_masonry_modern';
	
	$single_post_repcolor = get_post_meta(get_the_ID(), 'cactus_post_repcolor', true);
	$main_color = ot_get_option('main_color', '#25c3d8');
	if($single_post_repcolor == ''){$single_post_repcolor = $main_color;}
?>

<div id="<?php echo 'single_post_'.get_the_ID();?>" data-cactus-color="<?php echo esc_attr($single_post_repcolor);?>" class="list-item col-md-4 <?php echo esc_attr($quote_post_class) . esc_attr($class_special);?>"> <!--add: is-effect-visible don't use for list masonry-->

    <div id="post-<?php the_ID(); ?>" <?php post_class('bg-list-item'); ?>>

        <?php if(get_post_format() != 'gallery'):?>
            <div class="slider-list <?php echo esc_attr($fix_no_picture_class);?>"> <!--is-slider-post-list-->
                <?php if ( has_post_thumbnail() ):?>
                    <div class="slider-list-item <?php if($open_a_tag == '') echo "adaptive";?>"> <!--Post list slide item-->

                        <?php echo $open_a_tag;?>

                            <?php
							
							if(count($sizes) > 0)
								echo cactus_get_responsive_featured_image(get_the_ID(), array('alt' => get_the_title()), $sizes );
							else 
								echo cactus_get_responsive_featured_image(get_the_ID(), array('alt' => get_the_title()), $thumb_size);
							
                            ?>
                            <div class="thumb-overlay"></div>

                            <?php if(has_post_thumbnail()):?>
                                <?php if(get_post_format() == 'video'):?>
                                    <div class="cactus-icon-picture playmedia"></div>
                                <?php elseif(get_post_format() == 'image'):?>
                                    <div class="cactus-icon-picture capture"></div>
                                <?php elseif(get_post_format() == 'audio'):?>
                                    <div class="cactus-icon-picture music"></div>
                                <?php elseif(get_post_format() == 'quote'):?>
                                    <div class="cactus-icon-picture quote"></div>
                                <?php endif;?>
                            <?php endif;?>
                            <!--capture, playmedia, music, quote-->

                        <?php echo $close_a_tag;?>

                    </div>
                     <!--Post list slide item-->
                <?php elseif(!has_post_thumbnail() && ($blog_layout == 'modern' || $blog_layout == 'masonry_modern')):?>
                    <div class="slider-list-item"><img src="<?php echo esc_url(get_template_directory_uri() . '/images/default_white_image.jpg');?>" alt=""></div>
                <?php endif;?>


            </div><!--is-slider-post-list-->
        <?php else:?>
                <?php if($blog_layout == 'modern' || $blog_layout == 'masonry_modern'):?>
                <div class="slider-list"> <!--is-slider-post-list--> <!--fade, backSlide, goDown, fadeUp-->
                        <?php if ( has_post_thumbnail() ):?>
                        <div class="slider-list-item">
    
                                <?php
								
								if(count($sizes) > 0)
									echo cactus_get_responsive_featured_image(get_the_ID(), array('alt' => get_the_title()), $sizes );
								else 
									echo cactus_get_responsive_featured_image(get_the_ID(), array('alt' => get_the_title()), $thumb_size);

                                ?>

                                <div class="thumb-overlay"></div>
                                <div class="cactus-icon-picture capture"></div>
                        </div>
                        <?php else:?>
                            <div class="slider-list-item"><img src="<?php echo esc_url(get_template_directory_uri() . '/images/default_white_image.jpg');?>" alt=""></div>
                        <?php endif;?>
                </div>
                <?php else:
                        $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => 999 ) );
                ?>
                <div class="slider-list is-slider-post-list" data-auto-play="" data-pagination="1" data-transition="fade"> <!--is-slider-post-list--> <!--fade, backSlide, goDown, fadeUp-->
                     <?php if(count($images) > 0):
                            foreach ( $images as $attachment_id => $attachment ):?>
                                <div class="slider-list-item"> <!--Post list slide item-->

                                    <a href="<?php the_permalink();?>" class="adaptive" title="<?php echo esc_attr(get_the_title());?>">

                                        <?php
										
										if(count($sizes) > 0)
											echo cactus_get_responsive_attachment_image($attachment_id, $sizes);
										else
											echo cactus_get_responsive_attachment_image($attachment_id, $thumb_size);
										//echo wp_get_attachment_image($attachment_id, $thumb_size);

                                        ?>
                                        <div class="thumb-overlay"></div>

                                    </a>
                                </div>
                        <?php endforeach;
                     endif;?>
                     <!--Post list slide item-->
                </div><!--is-slider-post-list-->
                 <?php endif;?>


        <?php endif;?>

        <div class="fix-color-modern background-color-1"></div>

        <div class="fix-special <?php echo esc_attr($fix_no_picture_class);?>">


            <div class="item-info">
                <?php echo wp_kses_post($fix_social_share_html);?>
                <?php
                    /* translators: used between list items, there is a space after the comma */
                    $categories_list = get_the_category_list( __( ', ', 'cactusthemes' ) );
                    if ( $categories_list && cactus_categorized_blog() ) :
                ?>
                <div class="category">
                    <span class="font-1">
                        <?php printf( __( '%1$s', 'cactusthemes' ), $categories_list ); ?>
                    </span>
                </div>
                <?php endif;?>
                <div class="time updated">
                    <span class="font-1"><?php echo date_i18n(get_option('date_format') ,get_the_time('U'));?></span>
                </div>
            </div>

            <div class="item-title entry-title">
                <?php echo wp_kses_post($fix_social_share_html);?>
                <a href="<?php echo esc_url(get_permalink());?>" title="<?php the_title();?>" class="font-1"><?php the_title();?></a>

                <span class="note-wrap"><span class="note-title font-1 background-color-1"><?php esc_html_e('premium', 'cactusthemes');?></span></span>
            </div>

            <?php if(trim(get_the_excerpt()) != '' && trim(get_the_excerpt()) != null && trim(get_the_excerpt()) != '&nbsp;'):?>
                <div class="item-excerpt">
                    <span>
                        <?php echo get_the_excerpt(); ?>
                    </span>
                </div>
            <?php endif;?>

            <!--<div class="continue-reading">
                <a href="#" title="" class="">Continue Reading ...</a>
            </div>-->

            <?php
                if(get_post_format() == 'quote')
                {
                    if(preg_match('~<blockquote>(.*?)</blockquote>~is',get_the_content(), $matches))
					{
						// if yes, remove it from content
						$quote = $matches[0];
						$quote_content      = preg_replace('/(<cite)(.*)(<\/cite>)/', '', $quote);
						preg_match('/(<cite)(.*)(<\/cite>)/', get_the_content(), $matches1);
						$link_post_quote    = '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" class="font-1">' . strip_tags($quote_content). '</a>';
						$author             = isset($matches1[0]) ? $matches1[0] : '';
						$author_post_quote  = '<div class="item-sub-author color-5 font-1">' . $author . '</div>';
					}
                }
                else
                {
                    $link_post_quote = '';
                    $author_post_quote = '';
                }
            ?>

            <div class="item-title item-sub-title">
                <?php echo wp_kses_post($fix_social_share_html);?>
                <?php echo wp_kses_post($link_post_quote);?>

                <span class="note-wrap"><span class="note-title font-1 background-color-1"><?php esc_html_e('premium','cactusthemes');?></span></span>
            </div>

            <?php echo wp_kses_post($author_post_quote);?>

            <div class="continue-reading">
                <a href="<?php the_permalink();?>" title="" class=""><?php esc_html_e('Continue Reading ...','cactusthemes');?></a>
            </div>

            <div class="item-author">
                <div class="author-pic">
                    <div>
                        <?php  if(isset($_is_retina_)&&$_is_retina_){
								echo get_avatar( get_the_author_meta('email'), 60, esc_url(get_template_directory_uri() . '/images/avatar-2x-retina.jpg') );
						}else{
								echo get_avatar( get_the_author_meta('email'), 30, esc_url(get_template_directory_uri() . '/images/avatar-2x.jpg') );
						}?>
                    </div>
                </div>
                <div class="author-content font-1">
                    <span class="author-name vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span>
                    <?php
                        $author     = get_user_by( 'email', get_the_author_meta( 'email' ) );
                        $position   = (is_object($author) && get_the_author_meta('positon',$author->ID)) != '' ? get_the_author_meta('positon',$author->ID) : esc_html_e('','cactusthemes')
                    ?>
                    <span class="author-og"><?php echo esc_html($position);?></span>
                </div>
                <div class="author-button" data-close-btn-text="open">
                    <a href="#" title="">
                        <i class="fa fa-share-alt"></i>
                    </a>
                </div>

                <div class="hidden-social">
                    <?php echo wp_kses_post($fix_social_share_html);?>
                    <div class="table-list">
                        <ul class="list-inline social-listing">
                            <?php echo cactus_print_social_share();?>
                        </ul>

                        <div class="hidden-social-button" data-close-btn-text="close">
                            <div></div>
                        </div>
                     </div>
                </div>


                <div class="hidden-social sub">
                    <div class="table-list">
                        <ul class="list-inline social-listing">
                            <?php echo cactus_print_social_share();?>
                        </ul>
                     </div>
                </div>
            </div>



        </div>

        <div class="clearfix"></div>

        <div class="cactus-related-posts">
            <?php
                if($blog_layout == 'normal_classic' || $blog_layout == 'wide_classic'):
                    $show_related_posts = get_post_meta($post->ID, 'post_show_related_post_in_archive', true);
                    if($show_related_posts != '' && $show_related_posts != 'no'):

                        $single_related_posts_by    = ot_get_option('single_related_posts_by', 'categories');
                        $related_posts_order_by     = ot_get_option('related_posts_order_by', 'date');

                        $related_post_limit         = $blog_layout == 'normal_classic' ? 4 : 3;

                        $options = array(
                            'post_type'             => 'post',
                            'posts_per_page'        => $related_post_limit,
                            'orderby'               => $related_posts_order_by,
                            'post_status'           => 'publish',
                            'post__not_in'          => array($post->ID),
                            'ignore_sticky_posts'   => true
                        );


                        if($single_related_posts_by != '' && $single_related_posts_by == 'categories')
                        {
                            //get categories of post
                            $categories =  get_the_category($post->ID);
                            $cats       = array();
                            if(count($categories) > 0)
                            {
                                foreach($categories as $category)
                                {
                                    $cats[] = $category->term_id;
                                }
                                $cats_str = implode(",",$cats);
                                $options['cat'] = $cats_str;
                            }
                        }
                        else if($single_related_posts_by != '' && $single_related_posts_by == 'tags')
                        {
                            $tags       = wp_get_post_tags($post->ID);
                            $tags_arr   = array();
                            if(count($tags) > 0)
                            {
                                foreach($tags as $tag)
                                {
                                    $tags_arr[] = $tag->term_id;
                                }
                                $options['tag__in'] = $tags_arr;
                            }
                        }

                        $realated_post_query = new WP_Query( $options );

                        if($realated_post_query->have_posts()):
            ?>
                            <div class="cactus-divider center-20">
                                <div class="line-50 one">
                                    <div class="line-fix"></div>
                                </div>
                                <div class="c-title">
                                    <span>
                                        <?php esc_html_e('Related Posts','cactusthemes');?>
                                    </span>
                                </div>
                                <div class="line-50 two">
                                    <div class="line-fix"></div>
                                </div>
                            </div>

                            <div class="related-posts-content">

                                <div class="row">

                                    <?php
                                        while($realated_post_query->have_posts()):
                                            $realated_post_query->the_post();

                                            //get images thumbnail and alt text
                                            $img_id     = get_post_thumbnail_id();
                                            $image      = wp_get_attachment_image_src($img_id, 'thumb_listing_related_post');
                                            if($image[0] == '')
                                                $image[0] = esc_url(get_template_directory_uri() . '/images/default_image.jpg');
                                            $alt_text   = get_post_meta($img_id , '_wp_attachment_image_alt', true);
                                    ?>
                                                <div class="col-md-3">
                                                    <div class="related-posts-item">
                                                        <div class="related-posts-picture">
                                                            <a class="adaptive" href="<?php echo esc_url(get_permalink());?>" title="<?php echo esc_attr(get_the_title());?>">
                                                                <img src="<?php echo $image[0];?>" alt="<?php echo esc_attr($alt_text);?>" title="<?php echo esc_attr(get_the_title());?>">
                                                                <div class="thumb-overlay"></div>
                                                            </a>
                                                        </div>

                                                        <div class="related-posts-title font-1">
                                                            <a href="<?php echo esc_url(get_permalink());?>" title="<?php echo esc_attr(get_the_title());?>">
                                                                <?php echo get_the_title();?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                 </div>

                                        <?php endwhile; wp_reset_postdata();?>

                                </div>

                            </div>
                        <?php endif;?>
                    <?php endif;?>
                <?php endif;?>

            <div class="fix-height-related-posts"></div>

        </div>

    </div>
</div>