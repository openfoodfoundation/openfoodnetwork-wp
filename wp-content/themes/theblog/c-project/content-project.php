<?php
/**
 * @package cactus
 */

global $thumbnail;
$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => 999 ) );
global $check_null;
$check_null = $images;
$id_slider =  rand(1, 999);
$tags_str = '';
$term_link = '';
$project_tag = wp_get_post_terms( get_the_ID(), 'project-tag');							
	foreach ($project_tag as $term) {
		$term_link = get_term_link( $term );
		$tags_str .=  ', '.'<a href="'.esc_url($term_link).'">'.$term->name.'</a>';
	}
	$tags_str = preg_replace('/^./', '', $tags_str);
$c_prj_layout =  op_get('c_project_settings','cactus-project-layout');
if($c_prj_layout ==''){
	$c_prj_layout ='photo';
}
$project_layout = get_post_meta(get_the_ID(), 'c_project_layout', true);
if($project_layout ==''){
	$project_layout ='default';
}
if($project_layout != '' && $project_layout !='default'){
	$c_prj_layout = $project_layout;
}

if ( ! function_exists( 'cactus_project_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function cactus_project_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	if(function_exists('op_get')){
		  $next_pre =  op_get('c_project_settings','cactus-project-nav-post');
	}
	if($next_pre=='same_tags'){
		 $prev = get_adjacent_post(true, '', true, 'project-tag');
		 $next = get_adjacent_post(true, '', false, 'project-tag');
	}else{
		$prev = get_adjacent_post(false, '', true);
		$next = get_adjacent_post(false, '', false);
	}
	
	$checkClassFix = false;
	if (!$next || !$prev) {
		$checkClassFix=true;
	}
	?>
	<div class="n-p-posts <?php if($checkClassFix) { echo 'fixonecolumn';} ?>">
    	<?php			
			if($prev) {
		?>
            <div class="p-post">
            <?php
                if($next_pre=='same_tags'){
                    previous_post_link( '%link',  __( ' <span class="nav-bt font-1"> Previous </span> <span class="nav-title font-1"> %title </span> ', 'cactusthemes' ), TRUE, ' ', 'project-tag' ); 
                }else{
                    previous_post_link( '%link',  __( ' <span class="nav-bt font-1"> Previous </span> <span class="nav-title font-1"> %title </span> ', 'cactusthemes' ));
                }
            ?>
            </div>
        <?php
			}
			if($next) {
		?>
            <div class="n-post">
            <?php
                if($next_pre=='same_tags'){
                    next_post_link( '%link',  __( ' <span class="nav-bt font-1"> Next </span> <span class="nav-title font-1"> %title </span> ', 'cactusthemes' ), TRUE, ' ', 'project-tag' ); 
                }else{
                    next_post_link( '%link',  __( ' <span class="nav-bt font-1"> Next </span> <span class="nav-title font-1"> %title </span> ', 'cactusthemes' )); 
                }
            ?> 
            </div>
        <?php
			}
		?>    
    </div><!-- .n-p-posts -->
	<?php
}
endif;
$cactus_project_show_back = op_get('c_project_settings','cactus-project-show-back');
if($cactus_project_show_back == ''){$cactus_project_show_back ='1';}
$cactus_project_show_sharing = op_get('c_project_settings','cactus-project-show-sharing');
if($cactus_project_show_sharing == ''){$cactus_project_show_sharing ='1';}
$cactus_project_show_navigation = op_get('c_project_settings','cactus-project-show-navigation');
if($cactus_project_show_navigation == ''){$cactus_project_show_navigation ='1';}
$cactus_project_show_related = op_get('c_project_settings','cactus-project-show-related');
if($cactus_project_show_related == ''){$cactus_project_show_related ='1';}
?>
<div class="container">	
	<div class="row">
        <div class="col-md-12 fix-right-left">
        
        <!--Single Page Content-->
        <div class="single-page-content">
            <article>
            
                <div class="title-content">
                    <!--remove <span>...</span>-->
                    <div class="text-1 font-1"><span><?php echo wp_kses_post($tags_str); ?></span></div>  
                                                     
                    <div class="text-2 font-1"><div><h1><?php the_title() ?></h1></div></div> 
                </div>
                <!-- Single Project Slider -->
                <?php if($c_prj_layout =='slide'){?>
					<?php if ( $images and count($images)>0 ) {?>
                    <!--Shortcode slider-->
                    <div class="sc-slider-post <?php echo esc_attr($id);?>">
                        <div class="fix-width-full-row">
                            <div class="cactus-silder-multi-post" data-auto-play="4000" data-pagination="0" data-auto-height="" data-id="<?php echo esc_attr($id_slider);?>">
                            <?php
                                if ( $images and count($images)>0 ) {
                                    foreach((array)$images as $attachment_id => $attachment){
                                    $image_img_tag = wp_get_attachment_image_src( $attachment_id,'full' );
                                   
                                    // ignore the feature image
                                    if(trim($thumbnail[0])==trim($image_img_tag[0])) continue;
                            ?>
                                 <!--Slider Item-->
                                <div class="slider-item">
                                    <div class="picture-content">
                                        <img src="<?php echo esc_url($image_img_tag[0]); ?>" alt="" title="">
                                    </div>                                                            
                                </div><!--Slider Item-->
                            <?php
                                //wp_reset_query();
                                wp_reset_postdata();
                                    }// end foreach
                                }
                            ?>    
                            </div>
                            <div class="currentPage"></div>
                        </div>
                        
                        <div class="prev c-<?php echo esc_attr($id_slider);?>"><i class="fa fa-angle-left"></i></div>
                        <div class="next c-<?php echo esc_attr($id_slider);?>"><i class="fa fa-angle-right"></i></div>    
                    </div>
                    <!--Shortcode slider-->
                <?php }
				}
				?>
                <!-- !Single Project Slider -->
                
                <!-- Single Project Photo -->
                <?php if($c_prj_layout =='photo'){?> 
                    <div class="style-post">
                    <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
                        <img src="<?php echo esc_url($url); ?>" alt="" title="">
                    </div>
                <?php }?>
                <!-- !Single Project Photo -->
                                                        
                <!--Body content-->
                <div class="body-content">
                    <?php the_content(); ?>    
                </div>
                <!--Body content-->
                
                <?php if($cactus_project_show_back == '1'){?>
                <!--close-project-->
                    <div class="close-project">
                        <a href="<?php echo esc_url(get_post_type_archive_link('c-project'));?>" title="<?php esc_html_e('Project Listing', 'cactusthemes');?>">
                            <div class="button-close"></div>
                        </a>
                    </div>
                <!--close-project-->
                <?php } ?>
                
                <?php if($cactus_project_show_sharing == '1'){?>
                <!--share group-->
                    <div class="share-group">
                    <ul class="list-inline social-listing">
                        <li class="share-this font-1"><?php esc_html_e('Share This: ','cactusthemes');?></li>
                         <?php cactus_print_social_share();?>
                    </ul>
                    </div>
                <!--share group-->
                <?php } ?>
                
                <?php if($cactus_project_show_navigation == '1'){
					/** Post Nav **/
					cactus_project_nav();
					/** Post Nav End **/
				}?>
                
				<?php if($cactus_project_show_related == '1'){
					/** Related Project **/
					get_template_part( 'c-project/project', 'related' ); 
					/** Related Project End **/
				}?>
      
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
	</div>
</div> 
