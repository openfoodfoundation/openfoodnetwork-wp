<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package cactus
 */
get_header('project');
$prj_listing_class = '';
$project_listing = op_get('c_project_settings','cactus-project-listing-blog');
$project_tags_filter = op_get('c_project_settings','cactus-project-show-tag-filter');
if($project_tags_filter == ''){
	$project_tags_filter = '1';
};
if($project_listing == ''){
	$project_listing = 'prj_list_modern_spacing';
};
if($project_listing == 'prj_list_modern_spacing'){
	$prj_listing_class = '';
}else if($project_listing == 'prj_list_modern_no_spacing'){
	$prj_listing_class = 'no-padding';	
}else if($project_listing=='prj_list_masonry_modern') {
	$prj_listing_class = 'portfolio-masonry';	
}else if($project_listing=='prj_list_masonry_modern_no_spacing') {
	$prj_listing_class = 'portfolio-masonry no-padding';
}
?>  	
<div id="cactus-body-container">
<!--Listing-->
<div class="list-wrap">
    <div class="loading-listing"></div> <!--Loading-->
    <div class="list-content background-color-5c post-grid modern-grid portfolio-grid <?php echo esc_attr($prj_listing_class);?>">
        <div class="container"> <!--Container-->
            <div class="row"> <!--row-->
                <div class="col-md-12 fix-right-left"> <!--col-md-12 -> 3 column --> <!--col-md-8 -> 2 column -->
                	<?php if($project_tags_filter != '' && $project_tags_filter != '0'){?>
                        <div class="tag-group">
                            <a href="#" class="filter-masonry active" rel="tag" data-filter="*">all</a>
                            <?php 
                                $prj_tags = get_terms( 'project-tag' );
                                foreach ($prj_tags as $p_term) {
                                    //$link_t = get_term_link($p_term->slug, 'project-tag');
                            ?>
                                <a href="#" class="filter-masonry" rel="tag" data-filter=".filter-listing-<?php echo esc_attr($p_term->slug);?>"><?php echo esc_html($p_term->name);?></a>
                            <?php }//End of Foreach?>
                        </div>
                    <?php }?>
                    <div class="row item-fix-modern">	
                    <?php 
						if ( have_posts() ) : 
                            while ( have_posts() ) : the_post();
							$single_project_repcolor = get_post_meta(get_the_ID(), 'c_project_repcolor', true);
							$main_color = ot_get_option('main_color', '#25c3d8');
							if($single_project_repcolor == ''){$sinlge_project_repcolor = '$main_color';}
					?>
                        <!--List Item-->
                        <div id="<?php echo 'single_project_'.get_the_ID();?>" data-cactus-color="<?php echo esc_attr($single_project_repcolor);?>" class="list-item col-md-4 is-effect-visible<?php $project_tag = wp_get_post_terms( get_the_ID(), 'project-tag'); foreach ($project_tag as $term) {echo ' filter-listing-'.''.$term->slug.'';}?>"> <!--add: is-effect-visible don't use for list masonry-->
                        
                            <div class="bg-list-item">
                            
                                <div class="slider-list"> <!--is-slider-post-list-->
                                    
                                    <div class="slider-list-item"> <!--Post list slide item-->
                                    
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php if(has_post_thumbnail()){ 
												$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'thumb_720x534', true); 
											?>
                                            	<img src="<?php echo esc_url($thumbnail[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php }else{?>
                                                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/default_white_image.jpg');?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php }?>
                                            <div class="thumb-overlay"></div>
                                        </a>
                                    
                                    </div>
                                     <!--Post list slide item-->
                                     
                                </div><!--is-slider-post-list-->
                                
                                <div class="fix-color-modern background-color-1"></div>
                                
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="fix-porfolio">
                                    <div class="fix-special">                                                	
                                        <div class="item-info">
                                            <div class="category">
                                                <span class="font-1">
												<?php 
													$tags_str = '';
													$project_tag = wp_get_post_terms( get_the_ID(), 'project-tag');							
														foreach ($project_tag as $term) {
															$tags_str .=  ', '.$term->name;
														}
														$tags_str = preg_replace('/^./', '', $tags_str);
													echo esc_html($tags_str); 
												?>
                                                </span>
                                            </div>                                                        
                                        </div>
                                        
                                        <div class="item-title font-1">
                                            <?php the_title(); ?>
                                        </div>                                                                                                        
                                    </div>
                                </a>
                                
                                <div class="clearfix"></div>
                                <div class="cactus-related-posts">
                                    <!--no related posts-->
                                    <div class="fix-height-related-posts"></div>
                                </div>  
                                
                            </div>        
                        </div><!--List Item-->  
                    <?php 	endwhile;
                    	endif; ?>  
                    </div>
                    
                    <!--wp-pagenavi-->
                   	<div class="page-navigation"><?php cactus_project_paging_nav();?></div>
                    <!--wp-pagenavi--> 
                     
                </div> <!--Col-->
                
            </div><!--row-->
        </div> <!--Container-->
        
    </div>
</div>
<!--Listing-->
<?php get_footer(); ?>