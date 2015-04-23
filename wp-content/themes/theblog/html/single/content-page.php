<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package cactus
 */
?>

<div class="single-page-content"><!--Single Page Content-->
    
    <article>
		<?php if(!is_front_page() && !is_page_template('page-templates/front-page.php')):?>
            <div class="title-content">
                <div class="text-2 font-1">
                    <div>
                        <h1><?php the_title(); ?></h1>
                    </div>
                </div>
            </div><!-- .title-content -->
        <?php endif;?>
            <div class="body-content">
            <?php the_content(); ?>
            </div>
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
            <?php $disable_comments =ot_get_option('disable_comments');?>
			<?php if($disable_comments != 'on'):?>
                <div class="comment-form-fix">
                    <?php
                        if ( comments_open() || '0' != get_comments_number() )
                            comments_template();
                    ?>
                </div>
            <?php endif;?>
	</article>
        
</div><!-- .single-page-content -->