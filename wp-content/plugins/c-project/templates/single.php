<?php
get_header(); ?>
<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
						if(has_post_thumbnail()){
							$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true); ?>
							<div class="content-image"><img src="<?php echo $thumbnail[0] ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"></div>
						<?php } ?>
					
						<header class="entry-header">
							<?php
								the_title( '<h1 class="entry-title">', '</h1>' );
							?>
							<div class="entry-meta"><?php echo date_i18n(get_option('date_format') ,get_the_time('U'));?></div><!-- .entry-meta -->
						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php
								the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'cactusthemes' ) );
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'cactusthemes' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
								) );
							?>
						</div><!-- .entry-content -->
					</article><!-- #post-## -->
					<?php
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<?php
get_sidebar();
get_footer();
