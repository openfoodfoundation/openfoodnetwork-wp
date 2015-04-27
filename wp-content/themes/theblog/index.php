<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cactus
 */

get_header(); ?>
<?php
    global $header_layout;
    global $paged;
    global $theme_sidebar;
    $theme_sidebar = ot_get_option('sidebar', 'right');
    $paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);

    $class_index_v4 = (is_front_page() && $header_layout == 'posts_tab') ? 'index-v4' : '';
?>
    <!--Listing-->
<div class="list-wrap <?php echo esc_attr($class_index_v4);?>">
    <!--
        1/ config list default: post-grid
        2/ config list masonry: post-grid + post-masonry
        3/ config list wide: post-grid + post-wide
        4/ config list classic: post-grid + post-classic
        5/ config list special: post-grid + post-special
        6/ config modern grid: post-grid + modern-grid
        7/ config modern masonry: post-grid + modern-grid + modern-masonry
    -->
    <div class="loading-listing"></div> <!--Loading-->
        <?php
            global $index_blog_listing;
            global $is_index_blog_listing_ajax;
            $is_index_blog_listing_ajax = false;

            global $blog_layout;

            $blog_layout =  ot_get_option('blog_layout', 'grid');

            $is_isotope_class = ($blog_layout == 'masonry' || $blog_layout == 'masonry_modern' || $blog_layout == 'modern') ? 'is-isotope' : '';


            if($blog_layout == 'grid')
                $blog_layout_class = '';
            else if($blog_layout == 'masonry')
                $blog_layout_class = 'post-masonry';

            else if($blog_layout == 'wide_classic')
                $blog_layout_class = 'post-wide';

            else if($blog_layout == 'normal_classic')
                $blog_layout_class = 'post-classic';

            else if($blog_layout == 'one_column')
                $blog_layout_class = 'post-special';

            else if($blog_layout == 'modern')
                $blog_layout_class = 'modern-grid';

            else if($blog_layout == 'masonry_modern')
                $blog_layout_class = 'modern-grid modern-masonry';

            else
                $blog_layout_class = '';

        ?>
        <div class="list-content background-color-5c post-grid <?php echo esc_attr($blog_layout_class);?>"> <!--post-grid, post-masonry, post-classic, post-wide, post-special, modern-grid, modern-masonry-->
            <div class="container"> <!--Container-->
                <?php if ( is_active_sidebar( 'maintop_sidebar' ) && $paged < 2 ):?>
                    <div class="main-top-sidebar row">
                        <?php dynamic_sidebar( 'maintop_sidebar' );?>
                    </div>
                <?php endif;?>
                <div class="row"> <!--row-->
                    <?php
                        $blog_sidebar = ($theme_sidebar != '' && $theme_sidebar != 'hidden')  ? 'col-md-8 ' : 'col-md-12 ';
                        $blog_sidebar .= ($theme_sidebar != '' && $theme_sidebar == 'right')  ? 'sidebar-right' : '';
                        $blog_sidebar .= ($theme_sidebar != '' && $theme_sidebar == 'left')  ? 'sidebar-left' : '';
                    ?>
                    <div class="<?php echo esc_attr($blog_sidebar);?> fix-right-left"> <!--col-md-12 -> 3 column --> <!--col-md-8 -> 2 column -->
                        <div class="row item-fix-modern">

                            <?php if ( have_posts() ) : ?>

                                <?php /* Start the Loop */ ?>
                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php
                                        /* Include the Post-Format-specific template for the content.
                                         * If you want to override this in a child theme, then include a file
                                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                         */
                                        get_template_part( 'html/loop/content', get_post_format() );
                                    ?>

                                <?php endwhile; ?>

                            <?php else : ?>

                                <?php get_template_part( 'html/loop/content', 'none' ); ?>

                            <?php endif; ?>

                        </div>
                        <div style="display: none;" class="check-loading-img <?php echo esc_attr($is_isotope_class);?>"></div>
                        <input type="hidden" name="first_index_blog_listing" value="<?php echo esc_attr($index_blog_listing);?>"/>
                        <input type="hidden" name="last_index_blog_listing" value="<?php echo esc_attr($index_blog_listing);?>"/>
                        <input type="hidden" name="hidden_page_per_page" value="<?php echo esc_attr(get_option('posts_per_page'));?>"/>
                        <input type="hidden" name="hidden_blog_layout" value="<?php echo esc_attr($blog_layout);?>"/>
                        <div class="page-navigation"><?php cactus_paging_nav('.list-content .fix-right-left .row.item-fix-modern','html/loop/content'); ?></div>
                    </div>
                    <?php
                    if($theme_sidebar != 'hidden' && $theme_sidebar != '')
                        get_sidebar();
                    ?>

            </div>
            <?php if ( is_active_sidebar( 'mainbottom_sidebar' ) && $paged < 2 ):?>
                <div class="main-bottom-sidebar row">
                    <?php dynamic_sidebar( 'mainbottom_sidebar' );?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>
<?php get_footer(); ?>



