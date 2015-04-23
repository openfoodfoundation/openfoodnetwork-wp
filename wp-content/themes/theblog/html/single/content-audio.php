<?php
/**
 * @package cactus
 */
global $_is_retina_;
$categories = get_the_category();
$cat_name = '';
$cat_id = '';
if($categories){
    foreach($categories as $category) {
        $cat_name = $category->cat_name;
        $cat_id = $category->cat_ID;
    }
}
global $single_sidebar;

$single_sidebar = get_post_meta(get_the_ID(),'post_sidebar', true );
if($single_sidebar=='default' || $single_sidebar==''){
    $single_sidebar = ot_get_option('single_sidebar', 'right');
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

?>
<div class="container">
    <?php if ( is_active_sidebar( 'maintop_sidebar' )):?>
        <div class="main-top-sidebar row">
            <?php dynamic_sidebar( 'maintop_sidebar' );?>
        </div>
    <?php endif;?>
    <div class="row">
    <div class="<?php echo esc_attr($single_sidebar_css);?> fix-right-left">
        <?php echo cactus_display_ads('ads_top_single');?>
        <!--Single Page Content-->
        <div class="single-page-content">
            <article class="hentry">
                <div class="title-content">

                    <!--remove <span>...</span>-->
                    <?php if($single_show_categories != '' && $single_show_categories == 'on'):?>
                        <div class="text-1 font-1"><span><a href="<?php echo esc_url(get_category_link( $cat_id )); ?> "><?php echo $cat_name ?></a></span></div>
                    <?php endif;?>

                    <!--remove <span>...</span>-->
                    <div class="text-2 font-1"><div><h1 class="entry-title"><?php the_title() ?></h1></div></div>

                    <!--remove <span>...</span>-->
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

                <!-- style-post audio-->
                <div class="style-post audio">
                    <?php
                          preg_match("/<embed\s+(.+?)>/i", $post->post_content, $matches_emb); if(isset($matches_emb[0])){ echo $matches_emb[0];}
                          preg_match("/<source\s+(.+?)>/i", $post->post_content, $matches_sou) ;
                          preg_match('/\<object(.*)\<\/object\>/is', $post->post_content, $matches_oj);
                          preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $post->post_content, $matches);
                          preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $post->post_content, $match);

                          if(!isset($matches_emb[0]) && isset($matches_sou[0])){
                              echo $matches_sou[0];
                          }else if(!isset($matches_sou[0]) && isset($matches_oj[0])){
                              echo $matches_oj[0];
                          }else if( !isset($matches_oj[0]) && isset($matches[0])){
                              echo $matches[0];
                          }else if( !isset($matches[0]) && isset($match[0])){
                              foreach ($match as $matc) {
                                  echo wp_oembed_get($matc[0]);
                              }
                          }
                    ?>
                </div>

                <!-- style-post audio-->
                
                <?php if($single_show_sharing != '' && $single_show_sharing == 'on'){?>
                <div class="top-post-share">
                    <ul class="list-inline social-listing">
                         <?php cactus_print_social_share();?>
                    </ul>
                </div>
                <?php }?>
                
                <!--Body content-->
                <div class="body-content">
                    <?php
                    if(get_post_format()=='video' || get_post_format()=='audio'){
                        $content =  preg_replace ('#<embed(.*?)>(.*)#is', ' ', get_the_content());
                        $content =  preg_replace ('@<iframe[^>]*?>.*?</iframe>@siu', ' ', $content);
                        preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $match);
                        foreach ($match[0] as $amatch) {
                            if(strpos($amatch,'youtube.com') !== false || strpos($amatch,'vimeo.com') !== false || strpos($amatch,'soundcloud.com') !== false){
                                $content = str_replace($amatch, '', $content);
                            }
                        }
                        $content = preg_replace('%<object.+?</object>%is', '', $content);
                            echo apply_filters('the_content',$content);
                    }else{ the_content(); }?>
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