<?php
/**
 * @package cactus
 */
/*$slider_height = get_post_meta(get_the_ID(), 'custom_height_slider', true);
if(!$slider_height){$slider_height='800';}*/

global $single_sidebar;
global $_is_retina_;

$single_sidebar = get_post_meta(get_the_ID(),'post_sidebar', true );
if($single_sidebar=='default' || $single_sidebar==''){
    $single_sidebar = ot_get_option('single_sidebar', 'right');
}

global $thumbnail;
$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => 999 ) );
global $check_null;
$check_null = $images;

$add_class ='';
if(count($images)==0){
    $add_class ='no-image';
}

$single_sidebar_css = ($single_sidebar != '' && $single_sidebar != 'hidden')  ? 'col-md-8 ' : 'col-md-12 ';
$single_sidebar_css .= ($single_sidebar != '' && $single_sidebar == 'right')  ? 'sidebar-right' : '';
$single_sidebar_css .= ($single_sidebar != '' && $single_sidebar == 'left')  ? 'sidebar-left' : '';

$single_show_categories         = ot_get_option('single_show_categories');
$single_show_author             = ot_get_option('single_show_author');
$single_show_date               = ot_get_option('single_show_date');
$single_show_tags               = ot_get_option('single_show_tags');
$single_show_sharing            = ot_get_option('single_show_sharing');
$single_show_post_navigation    = ot_get_option('single_show_post_navigation');
$single_show_related_posts      = ot_get_option('single_show_related_posts');
$single_show_about_author       = ot_get_option('single_show_about_author');

$single_gallery_layout = get_post_meta(get_the_ID(), 'post_gallery_layout', true);
if($single_gallery_layout =='default'|| $single_gallery_layout==''){
    $single_gallery_layout = ot_get_option('single_gallery_layout', 'layout_1');
}
$categories = get_the_category();
$cat_name = '';
$cat_id = '';
if($categories){
    foreach($categories as $category) {
        $cat_name = $category->cat_name;
        $cat_id = $category->cat_ID;
    }
}
$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
$thumb_url = wp_get_attachment_url( $thumbnail_id );

?>
<?php if($single_gallery_layout == 'layout_1'){
$single_gallery_v1_slider_height = get_post_meta(get_the_ID(), 'post_gallery_v1_slider_height', true);
if($single_gallery_v1_slider_height==''){
    $single_gallery_v1_slider_height = ot_get_option('single_gallery_v1_slider_height', '800');
}

?>
<div class="container">
     <?php echo cactus_display_ads('ads_top_single');?>
    <?php if ( is_active_sidebar( 'maintop_sidebar' )):?>
        <div class="main-top-sidebar row">
            <?php dynamic_sidebar( 'maintop_sidebar' );?>
        </div>
    <?php endif;?>
    <div class="row">
        <div class="col-md-12">

            <div class="single-page-content fix-title <?php echo esc_attr($add_class);?>">
                <article class="hentry">
                    <div class="title-content">
                        <?php if($single_show_categories != '' && $single_show_categories == 'on'):?>
                            <div class="text-1 font-1"><span><a href="<?php echo esc_url(get_category_link( $cat_id )); ?> "><?php echo $cat_name ?></a></span></div>
                        <?php endif;?>
                        <div class="text-2 font-1"><div><h1 class="entry-title"><?php the_title() ?></h1></div></div>
                        <div class="text-3 font-1">
                        <span>

                            <?php if($single_show_author != '' && $single_show_author == 'on'):?>
                                <span class="picture-author">
                                    <?php
                                    if(isset($_is_retina_)&&$_is_retina_){
                                            echo get_avatar( get_the_author_meta('email'), 80, esc_url(get_template_directory_uri() . '/images/avatar-2x-retina.jpg' ));
                                    }else{
                                            echo get_avatar( get_the_author_meta('email'), 40, esc_url(get_template_directory_uri() . '/images/avatar-2x.jpg' ));
                                    }?>
                                </span>

                                <span class="author-name vcard author">
                                    <span class="fn">
                                        <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author_meta( 'display_name' ); ?></a>
                                    </span>
                                </span>
                            <?php endif;?>

                            <?php if($single_show_date != '' && $single_show_date == 'on'):?>
                                <span class="time updated">
                                     <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr( get_the_time() ) ?>"><?php echo date_i18n(get_option('date_format') ,get_the_time('U'));?></a>
                                </span>
                            <?php endif;?>


                            <span class="comment-s">
                                <a class="next-to-comments" href="#"> <?php comments_number(); ?> </a>
                            </span>

                        </span>
                    </div>
                    </div>
                </article>
            </div>
            <?php if(count($images)>0){ //check null?>
            <!--default-->
            <div class="style-post gallery-v1">
                <!--Slider V1-->
                <div class="cactus-wraper-slider-bg">
                <?php
                    $gallery_slider_autoplay = ot_get_option('single_gallery_slider_autoplay', 'on');
                    $gallery_slider_speed = ot_get_option('single_gallery_slider_speed', '5000');
                    $gallery_speed = '';
                    if($gallery_slider_autoplay =='on'){
                        $gallery_speed = $gallery_slider_speed;
                    }else{
                        $gallery_speed = '';
                    }
                ?>
                    <div class="slider cactus-slider-single is-post-fix-parallax cactus-background-color-2" data-auto-play="<?php echo esc_attr($gallery_speed);?>" data-pagination="1" data-transition="fade" data-full-height="0"> <!--fade, backSlide, goDown, scaleUp-->
                        <?php
                            if ( $images and count($images)>0 ) {
                                foreach((array)$images as $attachment_id => $attachment){
                                $image_img_tag = wp_get_attachment_image_src( $attachment_id,'full' );

                                // ignore the feature image
                                if(trim($thumbnail[0])==trim($image_img_tag[0])) continue;
                        ?>
                        <!--Slider Item-->
                        <div class="slider-item is-parallax is-post-fix-parallax" data-bg-img="<?php echo esc_attr($image_img_tag[0]); ?>" data-div-height="<?php echo esc_attr($single_gallery_v1_slider_height);?>px"> <!-- images/slide-1.jpg -->

                            <div class="thumb-overlay cactus-background-color-2"></div>

                             <div class="loading-img">
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
                        </div><!--Slider Item-->

                        <?php
                            //wp_reset_query();
                            wp_reset_postdata();
                            }// end foreach
                            }
                        ?>
                    </div>
                    <!--Slider V1-->
                </div>
            </div>
            <!--default-->
            <?php } //check null?>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
     <?php if(count($images)>0){ //check null?>
        <div class="fix-top-gallery-v1"><div></div></div>
     <?php } ?>   
        <div class="<?php echo esc_attr($single_sidebar_css);?> fix-right-left">

            <!--Single Page Content-->
            <div class="single-page-content fix-body">
                <article>
                    <!--Body content-->
                    <?php if($single_show_sharing != '' && $single_show_sharing == 'on'){?>
                    <div class="top-post-share">
                        <ul class="list-inline social-listing">
                             <?php cactus_print_social_share();?>
                        </ul>
                    </div>
                    <?php }?>
                    
                    <div class="body-content">
                        <?php the_content(); ?>
                         <?php
                            global $page, $numpages;
                            wp_link_pages(array(
                                'before' => '<div class="cactus-post-break font-1"><span class="total-post"> '. __('Page ','cactusthemes').$page.__(' of ','cactusthemes').$numpages.' </span><span class="page-link-wp">',
                                'after' => '</span></div>',
                                'next_or_number' => 'next',
                                'nextpagelink' => '<span class="next-post-link"><i class="fa fa-angle-right"></i></span>',
                                'separator'        => '<span class="current">'. $page.'</span>',
                                'previouspagelink' => '<span class="previous-post-link"><i class="fa fa-angle-left"></i></span>' ,
                                'pagelink' => '%',
                                'echo' => 1 )
                            );  
                        ?>
                    </div>
                    <!--Body content-->

                    <?php echo cactus_display_ads('ads_bottom_single');?>

                    <?php if($single_show_tags != '' && $single_show_tags == 'on'):?>
                        <!--tag group-->
                        <?php $tag_check = get_the_tag_list();
                            if($tag_check != ''){?>
                        <div class="tag-group">
                            <?php $tag_list = get_the_tag_list( '', __( ' ', 'cactusthemes' ) ); ?>
                            <?php echo $tag_list; ?>
                        </div>
                        <?php }else { echo '<div class="tag-group"></div>';}?>
                        <!--tag group-->
                    <?php endif;?>

                     <?php if($single_show_sharing != '' && $single_show_sharing == 'on'):?>
                        <!--share group-->
                        <!--remove <div>...</div>-->
                        <div class="share-group">
                            <ul class="list-inline social-listing">
                                <li class="share-this font-1"><?php esc_html_e('Share This: ','cactusthemes');?></li>
                                 <?php cactus_print_social_share();?>
                            </ul>

                        </div>
                        <!--share group-->
                    <?php endif;?>

                    <?php if($single_show_post_navigation != '' && $single_show_post_navigation == 'on'):?>
                        <!-- Post Nav-->
                        <?php cactus_post_nav(); ?>
                        <!-- Post Nav End-->
                    <?php endif;?>

                    <?php if($single_show_about_author != '' && $single_show_about_author == 'on'):?>
                    <?php get_template_part( 'html/single/single', 'about-author' ); ?>
                    <?php endif;?>

                <?php if($single_show_related_posts != '' && $single_show_related_posts == 'on'):?>
                    <!--related post-->
                    <?php get_template_part( 'html/single/single', 'related' ); ?>
                    <!--related post-->
                <?php endif;?>

                <!-- Comment-->
                <div class="comment-form-fix">
                    <?php
                        //If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>
                </div>
                <!-- Comment-->

                </article>
            </div><!--Single Page Content-->
        </div>
        <?php
            if($single_sidebar != 'hidden' && $single_sidebar != '')
                get_sidebar();
        ?>
    </div>
    <?php if ( is_active_sidebar( 'mainbottom_sidebar' )):?>
        <div class="main-bottom-sidebar row">
            <?php dynamic_sidebar( 'mainbottom_sidebar' );?>
        </div>
    <?php endif;?>
</div>
<?php }?>
<?php if($single_gallery_layout == 'layout_2'){ ?>
<div class="container">
    <?php if ( is_active_sidebar( 'maintop_sidebar' )):?>
        <div class="main-top-sidebar row">
            <?php dynamic_sidebar( 'maintop_sidebar' );?>
        </div>
    <?php endif;?>
    <div class="row">
        <div class="<?php echo esc_attr($single_sidebar_css);?> fix-right-left"> <!--col-md-12 -> 3 column --> <!--col-md-8 -> 2 column -->
        <?php echo cactus_display_ads('ads_top_single');?>
        <!--Single Page Content-->
        <div class="single-page-content">
            <article class="hentry">

                <div class="title-content">

                    <!--remove <span>...</span>-->
                    <div class="text-1 font-1"><span><a href="<?php echo esc_url(get_category_link( $cat_id )); ?> "><?php echo $cat_name ?></a></span></div>

                    <!--remove <span>...</span>-->
                    <div class="text-2 font-1"><div><h1 class="entry-title"><?php the_title()?></h1></div></div>

                    <!--remove <span>...</span>-->
                    <div class="text-3 font-1">
                        <span>

                            <?php if($single_show_author != '' && $single_show_author == 'on'):?>
                                <span class="picture-author">
                                    <?php
                                    if(isset($_is_retina_)&&$_is_retina_){
                                            echo get_avatar( get_the_author_meta('email'), 60, esc_url(get_template_directory_uri() . '/images/avatar-2x-retina.jpg' ));
                                    }else{
                                            echo get_avatar( get_the_author_meta('email'), 60, esc_url(get_template_directory_uri() . '/images/avatar-2x.jpg' ));
                                    }?>
                                </span>

                                <span class="author-name vcard author">
                                    <span class="fn">
                                        <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author_meta( 'display_name' ); ?></a>
                                    </span>
                                </span>
                            <?php endif;?>

                            <?php if($single_show_date != '' && $single_show_date == 'on'):?>
                                <span class="time updated">
                                     <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr( get_the_time() ) ?>"><?php echo date_i18n(get_option('date_format') ,get_the_time('U'));?></a>
                                </span>
                            <?php endif;?>

                            <span class="comment-s">
                                <a class="next-to-comments" href="#"> <?php comments_number(); ?> </a>
                            </span>

                        </span>
                    </div>
                </div>
                <!--default-->

               <?php if(count($images)>0){ //check null?>
                <!--Style Post-->
               <div class="style-post gallery-v2">
                    <div class="cactus-gallery-v2-content">
                    <div class="sync1 owl-carousel">
                    <?php
                        if ( $images and count($images)>0 ) {
                            foreach((array)$images as $attachment_id => $attachment){
                            $image_img_tag = wp_get_attachment_image_src( $attachment_id,'full' );
                            // ignore the feature image
                            if(trim($thumbnail[0])==trim($image_img_tag[0])) continue;
                    ?>
                            <div class="slider_item_sync1"><img src="<?php echo esc_url($image_img_tag[0]); ?>" alt="" title=""></div>
                        <?php
                            //wp_reset_query();
                            wp_reset_postdata();
                                }// end foreach
                            }
                        ?>
                     </div>
                        <div class="sync2 owl-carousel">
                        <?php
                            if ( $images and count($images)>0 ) {
                                foreach((array)$images as $attachment_id => $attachment){
                                $image_img_tag = wp_get_attachment_image_src( $attachment_id,'thumb_80x80' );
                                // ignore the feature image
                                if(trim($thumbnail[0])==trim($image_img_tag[0])) continue;
                        ?>
                            <div class="slider_item_sync1"><img src="<?php echo esc_url($image_img_tag[0]); ?>" alt="" title=""></div>
                        <?php
                            //wp_reset_query();
                            wp_reset_postdata();
                                }// end foreach
                            }
                        ?>
                        </div>
                    </div>
                </div>
                <!--Style Post-->
                <?php } //check null?>

                <!--Body content-->
                <!--remove <div>...</div>-->
                
                <?php if($single_show_sharing != '' && $single_show_sharing == 'on'){?>
                <div class="top-post-share">
                    <ul class="list-inline social-listing">
                         <?php cactus_print_social_share();?>
                    </ul>
                </div>
                <?php }?>

                <div class="body-content">
                    <?php the_content(); ?>
                     <?php
                        global $page, $numpages;
                        wp_link_pages(array(
                            'before' => '<div class="cactus-post-break font-1"><span class="total-post"> '. esc_html__('Page ','cactusthemes').$page.esc_html__(' of ','cactusthemes').$numpages.' </span><span class="page-link-wp">',
                            'after' => '</span></div>',
                            'next_or_number' => 'next',
                            'nextpagelink' => '<span class="next-post-link"><i class="fa fa-angle-right"></i></span>',
                            'separator'        => '<span class="current">'. $page.'</span>',
                            'previouspagelink' => '<span class="previous-post-link"><i class="fa fa-angle-left"></i></span>' ,
                            'pagelink' => '%',
                            'echo' => 1 )
                        );  
                    ?>
                </div><!--Body content-->

                <?php echo cactus_display_ads('ads_bottom_single');?>

                <?php if($single_show_tags != '' && $single_show_tags == 'on'):?>
                    <!--tag group-->
                    <?php $tag_check = get_the_tag_list();
                        if($tag_check != ''){?>
                    <div class="tag-group">
                        <?php $tag_list = get_the_tag_list( '', __( ' ', 'cactusthemes' ) ); ?>
                        <?php echo $tag_list; ?>
                    </div>
                    <?php }else { echo '<div class="tag-group"></div>';}?>
                    <!--tag group-->
                <?php endif;?>

                <!--share group-->
                <!--remove <div>...</div>-->
                <div class="share-group">
                    <ul class="list-inline social-listing">
                        <li class="share-this font-1"><?php esc_html_e('Share This: ','cactusthemes');?></li>
                         <?php cactus_print_social_share();?>
                    </ul>

                </div>
                <!--share group-->

                <?php if($single_show_post_navigation != '' && $single_show_post_navigation == 'on'):?>
                    <!-- Post Nav-->
                    <?php cactus_post_nav(); ?>
                    <!-- Post Nav End-->
                <?php endif;?>

                <?php if($single_show_about_author != '' && $single_show_about_author == 'on'):?>
                    <!--author-->
                    <div class="i-p-author">
                        <div class="author-content">
                            <div class="author-pic">
                                <div class="img-oval">
                                     <?php
                                        if(isset($_is_retina_)&&$_is_retina_){
                                                echo get_avatar( get_the_author_meta('email'), 60, esc_url(get_template_directory_uri() . '/images/avatar-2x-retina.jpg' ));
                                        }else{
                                                echo get_avatar( get_the_author_meta('email'), 60, esc_url(get_template_directory_uri() . '/images/avatar-2x.jpg' ));
                                    }?>
                                </div>
                            </div>
                            <div class="author-name">
                                <span class="name font-1"><?php the_author_meta( 'display_name' ); ?></span>
                                <span class="mnl font-1">
                                 <?php
                                 $author = get_user_by( 'email', get_the_author_meta( 'email' ) );
                                 if($twitter = get_the_author_meta('positon',$author->ID)){ echo esc_attr( get_the_author_meta( 'positon', $author->ID ) ); }?>
                                </span>
                            </div>

                            <!--author social block-->
                            <div class="author-social">
                                <ul class="list-inline social-listing">
                                    <?php
                                    if($facebook = get_the_author_meta('facebook',$author->ID)){ ?>
                                        <li class="facebook"><a rel="nofollow" href="<?php echo esc_url($facebook); ?>" title="<?php esc_html_e('Facebook', 'cactusthemes');?>"><i class="fa fa-facebook"></i></a></li>
                                    <?php }
                                    if($twitter = get_the_author_meta('twitter',$author->ID)){ ?>
                                        <li class="twitter"><a rel="nofollow" href="<?php echo esc_url($twitter); ?>" title="<?php esc_html_e('Twitter', 'cactusthemes');?>"><i class="fa fa-twitter"></i></a></li>
                                    <?php }
                                    if($google = get_the_author_meta('google',$author->ID)){ ?>
                                       <li class="google-plus"> <a rel="nofollow" href="<?php echo esc_url($google); ?>" title="<?php esc_html_e('Google Plus', 'cactusthemes');?>"><i class="fa fa-google-plus"></i></a></li>
                                    <?php }
                                    if($email = get_the_author_meta('email',$author->ID)){ ?>
                                        <li class="email"><a rel="nofollow" href="mailto:?subject=<?php echo esc_url($email); ?>" title="<?php esc_html_e('Email', 'cactusthemes');?>"><i class="fa fa-envelope-o"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <!--author social block-->

                        </div>

                        <!--remove <p>...</p>-->
                        <div class="author-excerpt">
                        <?php 
                            $author_excerpt = '';
                            $author_excerpt = get_the_author_meta('description');
                            if($author_excerpt != ''){
                                echo '<p>'. $author_excerpt .'</p>';
                            }
                        ?>    
                    </div><!--author excerpt -->

                    </div>
                    <!--author-->
                <?php endif;?>

                <?php if($single_show_related_posts != '' && $single_show_related_posts == 'on'):?>
                    <!--related post-->
                    <?php get_template_part( 'html/single/single', 'related' ); ?>
                    <!--related post-->
                <?php endif;?>

                <!-- Comment-->
                <div class="comment-form-fix">
                    <?php
                        //If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>
                </div>
                <!-- Comment-->
                </article>
            </div><!--Single Page Content-->
        </div>
        <?php
            if($single_sidebar != 'hidden' && $single_sidebar != '')
                get_sidebar();
        ?>
    </div><!-- row -->
    <?php if ( is_active_sidebar( 'mainbottom_sidebar' )):?>
        <div class="main-bottom-sidebar row">
            <?php dynamic_sidebar( 'mainbottom_sidebar' );?>
        </div>
    <?php endif;?>
</div><!-- container -->
<?php } ?>