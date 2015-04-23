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
$single_standard_layout = get_post_meta(get_the_ID(), 'post_standard_layout', true);
if($single_standard_layout =='default'|| $single_standard_layout==''){
	$single_standard_layout = ot_get_option('single_standard_layout', 'layout_1');
}
$thumbnail_id = get_post_thumbnail_id( get_the_ID() );

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
$main_layout = ot_get_option('theme_layout', 'standard');
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
            <div class="single-page-content">
                <article class="hentry">
                    <?php if(($single_standard_layout == 'layout_1' && $thumbnail_id == '') || $single_standard_layout == 'layout_2' || $main_layout == 'left_navigation' ):?>
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
                    <?php else:?>
                        <div class="hidden-information">
                            <div class="text-2 font-1 entry-title"><span><?php the_title() ?></span></div>
                            <span class="author-name vcard author">
                                <span class="fn">
                                    <?php the_author_meta( 'display_name' ); ?>
                                </span>
                            </span>
                            <span class="time updated">
                                <?php echo date_i18n(get_option('date_format') ,get_the_time('U'));?>
                            </span>
                        </div>
                    <?php endif;?>
                    <?php if($single_standard_layout == 'layout_2'){ ?>

                        <?php if($thumbnail_id !=''){?>

                            <div class="style-post">
                                <?php the_post_thumbnail();?>
                            </div>

                        <?php }?>


                    <?php } ?>
                    <?php if($single_show_sharing != '' && $single_show_sharing == 'on'){?>
                    <div class="top-post-share">
                    	<ul class="list-inline social-listing">
                             <?php cactus_print_social_share();?>
                        </ul>
                    </div>
					<?php }?>
                    <!--Body content-->
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
<!-- Single Post Layout 2 -->