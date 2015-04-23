<?php
/**
 * The Template for displaying all related project.
 *
 * @package cactusthemes
 */
if(function_exists('op_get')){
	$related_number =  op_get('c_project_settings','cactus-project-count-related');
	if($related_number == ''){
		$related_number='6';		
	}
}
$post_id = get_the_ID();
$tags_str = '';
$project_tag = wp_get_post_terms( get_the_ID(), 'project-tag');							
foreach ($project_tag as $term) {
	$tags_str .=  ', '.$term->term_id;
}
$tags_str = preg_replace('/^./', '', $tags_str);
$args = array(
	'post_type' => 'c-project',
	'posts_per_page' => $related_number,
	'orderby' => 'title',
	'order' => 'ASC',
	'post_status' => 'publish',
	'post__not_in' => array($post_id),
	'tax_query' => array(
		array(
			'taxonomy' => 'project-tag',
			'field'    => 'ID',
			'terms'    => array( $tags_str ),
		),
	),
);

$tm_query = get_posts($args);
?>
<?php if(count($tm_query)>0){?>
<div class="list-wrap">
<div class="loading-listing"></div> <!--Loading-->
<div class="list-content background-color-5c post-grid modern-grid portfolio-grid"> <!--post-grid, post-masonry, post-classic, post-wide, post-special, modern-grid, modern-masonry-->
    
    <div class="container"> <!--Container-->
        <div class="row"> <!--row-->
            
            <div class="col-md-12 fix-right-left"> <!--col-md-12 -> 3 column --> <!--col-md-8 -> 2 column -->
                
                <div class="row item-fix-modern">
                	
                <?php
					foreach ( $tm_query as $key => $post ) : setup_postdata( $post );
					$tags_str = '';
					$project_tag = wp_get_post_terms( get_the_ID(), 'project-tag');							
						foreach ($project_tag as $term) {
							$tags_str .=  ', '.$term->name;
						}
						$tags_str = preg_replace('/^./', '', $tags_str);
						
					$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'thumb_520x388', true);
				?>	
                    <!--List Item-->
                    <div class="list-item col-md-4 is-effect-visible filter-listing-computer"> <!--add: is-effect-visible don't use for list masonry-->
                    
                        <div class="bg-list-item">
                        
                            <div class="slider-list"> <!--is-slider-post-list-->
                                
                                <div class="slider-list-item"> <!--Post list slide item-->
                                	<?php if(has_post_thumbnail()){?>
                                        <img src="<?php echo esc_url($thumbnail[0]);?>" alt="" title="">
                                        <div class="thumb-overlay"></div>
                                	<?php }else{?>
                                    	<img src="<?php echo esc_url(get_template_directory_uri() . '/images/default_white_image.jpg');?>" alt="" title="">
                                        <div class="thumb-overlay"></div>
                                    <?php }?>        
                                </div>
                                 <!--Post list slide item-->
                                 
                            </div><!--is-slider-post-list-->
                            
                            <div class="fix-color-modern background-color-1"></div>
                            
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="fix-porfolio">
                                <div class="fix-special">                                                	
                                    <div class="item-info">
                                        <div class="category">
                                            <span class="font-1"><?php echo esc_html($tags_str); ?></span>
                                        </div>                                                        
                                    </div>
                                    
                                    <div class="item-title font-1">
                                        <?php the_title() ?>
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
                <?php 
					endforeach;
				?>
                       
                </div>
            </div> <!--Col-->
            
        </div><!--row-->
    </div> <!--Container-->
    
</div>
</div>
<!--Listing-->
<?php } wp_reset_postdata();?>