<?php
/**
 * The Template for displaying all related posts by Category & tag.
 *
 * @package cactus
 */
?>
<?php 

$the_query = cactus_get_related_posts();

 if($the_query->have_posts()){
?>
<div class="p-related-posts">
      
	<div class="title-related-post font-1"><?php esc_html_e('Related Posts','cactusthemes'); ?></div>
	<div class="related-posts-content">
	<?php 
		while($the_query->have_posts())
		{ $the_query->the_post();
			 ?>
	  <?php
		  $add_class =''; 
		  if(get_the_post_thumbnail() ==''){
			$add_class ='fix-no-picture';  
		  }
	  ?>
		  <div class="related-posts-item">
		  <?php if(!get_the_post_thumbnail() ==''){?>
			  <div class="picture">
				<a class="image" href="<?php echo esc_url(get_permalink($post->ID));?>"><?php echo get_the_post_thumbnail( $post->ID, 'thumb_listing_grid' ); ?>
				<div class="thumb-overlay"></div>
				</a>
			  </div>
		  <?php }?>
			  <div class="content <?php echo esc_attr($add_class);?>">
				<span class="title font-1 "><a href="<?php echo esc_url((get_permalink($post->ID)));?>"><?php the_title();?></a></span>
				<span class="time font-1"><?php echo date_i18n(get_option('date_format') ,get_the_time('U'));?></span>
			</div>
		</div>
	<?php
		}//end while
		wp_reset_postdata();
	?>
      </div><!-- !related-posts-content -->
  </div>
<?php }?>