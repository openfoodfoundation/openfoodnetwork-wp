<?php
/**
 * The template for displaying Search Results pages.
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

<div class="cactus-single-page background-color-5c">
	<div class="container">
    	<div class="row">
            <div class="col-md-12 fix-right-left"> <!--col-md-12 -> 3 column --> <!--col-md-8 -> 2 column -->
				<div class="single-page-content search-result">
					<article>
						<div class="title-content">

						    <!--remove <span>...</span>-->
						    <div class="text-1 font-1"></div>

						    <!--remove <span>...</span>-->
						    <div class="text-2 font-1"><div><h1><?php esc_html_e('Search Results for "' . get_search_query() . '"', 'cactusthemes');?></h1></div></div>

						    <!--remove <span>...</span>-->
						    <div class="text-3 font-1">

						    </div>
						</div>

						<div class="body-content">
							<!--Listing-->
							<div class="list-wrap">
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
							    	<div class="list-content background-color-5c post-grid post-wide"> <!--post-grid, post-masonry, post-classic, post-wide, post-special, modern-grid, modern-masonry-->
							    		<div class="container"> <!--Container-->
							    			<div class="row"> <!--row-->
												<div class="col-md-12 fix-right-left"> <!--col-md-12 -> 3 column --> <!--col-md-8 -> 2 column -->

													<div class="row item-fix-modern">
														<?php if ( have_posts() ) : ?>

															<?php /* Start the Loop */ ?>
															<?php while ( have_posts() ) : the_post(); ?>

																<?php
																	/* Include the Post-Format-specific template for the content.
																	 * If you want to override this in a child theme, then include a file
																	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
																	 */
																	get_template_part( 'html/loop/content-search');
																?>

															<?php endwhile; ?>

														<?php else : ?>

															<?php get_template_part( 'html/loop/content', 'none' ); ?>

														<?php endif; ?>

													</div>
													<div style="display: none;" class="check-loading-img"></div>
													<div class="page-navigation"><?php cactus_paging_nav('.list-content .fix-right-left .row.item-fix-modern','html/loop/content-search'); ?></div>
												</div>
											<?php //get_sidebar(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>



