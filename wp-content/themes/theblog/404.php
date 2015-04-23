<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package cactus
 */
get_header(); 
$title_404 = ot_get_option('page_title');
$content_404 = ot_get_option('page_content');
?>  	
    <!--Single Page-->
    <div class="background-color-5g page-404">
        <div class="container">
            <div class="row">
                <div class="col-md-12 fix-right-left"> <!--col-md-12 -> 3 column --> <!--col-md-8 -> 2 column -->
                    <h1 class="font-1 color-1">404</h1>  
                    <h2 class="font-1 color-2"><?php echo wp_kses_post(balanceTags($title_404, true)); ?></h2> 
                    <span class="font-1 color-5"><?php echo wp_kses_post(balanceTags($content_404, true)); ?></span>  
                    <a href="<?php echo esc_url(get_home_url()); ?>" class="btn btn-default font-1"><?php esc_html_e('GO TO HOMEPAGE','cactusthemes');?></a>                           
                </div>
            </div>
        </div>
    </div><!--Single Page-->
<?php get_footer(); ?>