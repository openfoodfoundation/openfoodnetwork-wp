<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package cactus
 */

get_header(); ?>

	<?php
		global $paged;
		$paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
		wp_reset_postdata();
		$page_content = get_post_meta(get_the_ID(),'page_content',true);

	    global $page_sidebar;

	    $page_sidebar =get_post_meta(get_the_ID(),'page_sidebar', true );
	    if($page_sidebar=='default' || $page_sidebar==''){
	    	$page_sidebar = ot_get_option('page_sidebar', 'right');
	    }

	    // var_dump($page_sidebar);die;

	    $page_sidebar_css = ($page_sidebar != '' && $page_sidebar != 'hidden')  ? 'col-md-8 ' : 'col-md-12 ';
	    $page_sidebar_css .= ($page_sidebar != '' && $page_sidebar == 'right')  ? 'sidebar-right' : '';
	    $page_sidebar_css .= ($page_sidebar != '' && $page_sidebar == 'left')  ? 'sidebar-left' : '';


	?>
	<?php if($page_content == 'page_ct'):?>
		<div class="cactus-single-page background-color-5c">
			<div class="container">
		    	<?php if ( is_active_sidebar( 'maintop_sidebar' ) && $paged < 2 ):?>
                    <div class="main-top-sidebar row">
                        <?php dynamic_sidebar( 'maintop_sidebar' );?>
                    </div>
                <?php endif;?>
			    <div class="row">


			        <div class="<?php echo esc_attr($page_sidebar_css);?> fix-right-left">

						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'html/single/content', 'page' ); ?>

							<?php //cactus_print_social_share();?>

						<?php endwhile; // end of the loop. ?>

					</div>

					<?php
					    if($page_sidebar != 'hidden' && $page_sidebar != '')
					        get_sidebar();
				    ?>


				</div>
			    <?php if ( is_active_sidebar( 'mainbottom_sidebar' ) && $paged < 2 ):?>
			        <div class="main-bottom-sidebar row">
			            <?php dynamic_sidebar( 'mainbottom_sidebar' );?>
			        </div>
			    <?php endif;?>
			</div>
		</div><!-- .cactus-single-page -->
	<?php elseif($page_content == 'blog'):?>
		<?php
		    global $header_layout;
		    global $paged;
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

	                $blog_layout =  get_post_meta(get_the_ID(),'blog_layout',true) != '' ? get_post_meta(get_the_ID(),'blog_layout',true) : '' ;


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
		                        global $paged, $wp;
		                        global $wp_query;
                            	$temp_query = $wp_query;
                            	$paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);

		                        $options = array(
		                            'post_type'             => 'post',
		                            'order'                 => 'desc',
		                            'paged'					=> $paged,
		                            'post_status'           => 'publish',
		                            'ignore_sticky_posts'   => true
		                        );

	                            $post_limit 				= get_post_meta(get_the_ID(),'post_count',true) != '' ? get_post_meta(get_the_ID(),'post_count',true) : 9;
	                            $post_cat          			= get_post_meta(get_the_ID(),'post_categories',true);
	                            $post_tags         			= get_post_meta(get_the_ID(),'post_tags',true);
	                            $post_ids          			= get_post_meta(get_the_ID(),'post_ids',true);
	                            $order_by     				= get_post_meta(get_the_ID(),'order_by',true);

	                            // if you don't setup post_ids param
	                            if(isset($post_ids) && $post_ids == '')
	                            {
	                                if(isset($post_cat) && $post_cat != '')
	                                {
	                                    $cats = explode(",",$post_cat);
	                                    if(is_numeric($cats[0]))
	                                        $options['category__in'] = $cats;
	                                    else
	                                        $options['category_name'] = $post_cat;
	                                }
	                                if(isset($post_tags) && $post_tags != '')
	                                {
	                                    $options['tag'] = $post_tags;
	                                }
	                            }
	                            else
	                            {
	                                $ids = explode(",",$post_ids);
	                                if(is_numeric($ids[0]))
	                                    $options['post__in'] = $ids;
	                            }

	                            $options['orderby'] = $order_by == 'random' ? 'rand' : 'date';


		                        $options['posts_per_page'] = $post_limit;

		                        $query= new WP_Query($options);

								// echo '<pre>';
								//     print_r($query);
								// echo '</pre>';
								// die;
                                $wp_query = $query;

                                $total_page = ceil($query->found_posts / get_option('posts_per_page'));

    							global $wp_query, $wp;

								$js_params['current_url'] =  home_url($wp->request);
								//$query->query_vars;
								$js_query_vars = '';
								foreach($query->query as $key=>$value){
								   if(is_numeric($value)){
								       $js_query_vars .= '"'.$key.'":'.$value.',';
								   }
								    elseif(is_array($value)) {
								    	$output = array();
								    	foreach($value as $json_arr)
								    	{
								    		$output[] = '"' . $json_arr . '"';
								    	}
								        $js_query_vars .= '"'.$key.'":['.implode(',', $output).'],';
								    }
								    else
								       $js_query_vars .= '"'.$key.'":"'.$value.'",';

								}

		                    ?>
							<script type="text/javascript">
                             var cactus = {"ajaxurl":"<?php echo admin_url( 'admin-ajax.php' );?>","query_vars":{<?php echo $js_query_vars; ?>},"current_url":"<?php echo home_url($wp->request);?>" }
                            </script>

		                    <div class="<?php echo esc_attr($page_sidebar_css);?> fix-right-left"> <!--col-md-12 -> 3 column --> <!--col-md-8 -> 2 column -->
		                    	<?php cactus_display_ads('ads_top_archives');?>
		                        <div class="row item-fix-modern">

		                            <?php if ( $query->have_posts() ) : ?>

		                                <?php /* Start the Loop */ ?>
		                                <?php while($query->have_posts()) : $query->the_post(); ?>

		                                    <?php
		                                        /* Include the Post-Format-specific template for the content.
		                                         * If you want to override this in a child theme, then include a file
		                                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		                                         */
		                                        get_template_part( 'html/loop/content', get_post_format() );
		                                    ?>

		                                <?php endwhile; wp_reset_postdata();?>

		                            <?php else : ?>

		                                <?php get_template_part( 'html/loop/content', 'none' ); ?>

		                            <?php endif; ?>


		                            <div style="display: none;" class="check-loading-img <?php echo esc_attr($is_isotope_class);?>"></div>
		                        </div>
		                        <input type="hidden" name="first_index_blog_listing" value="<?php echo esc_attr($index_blog_listing);?>"/>
		                        <input type="hidden" name="last_index_blog_listing" value="<?php echo esc_attr($index_blog_listing);?>"/>
		                        <input type="hidden" name="hidden_page_per_page" value="<?php echo esc_attr($options['posts_per_page']);?>"/>
		                        <input type="hidden" name="hidden_blog_layout" value="<?php echo esc_attr($blog_layout);?>"/>
		                        <div class="page-navigation"><?php cactus_paging_nav('.list-content .fix-right-left .row.item-fix-modern','html/loop/content', $total_page, $paged); $wp_query = $temp_query ;?></div>
		                    		<?php cactus_display_ads('ads_bottom_archives');?>
		                    </div>

	                    	<?php
	                    	    if($page_sidebar != 'hidden' && $page_sidebar != '')
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
	<?php elseif($page_content == 'portfolio'):?>
		<?php
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if(is_plugin_active('c-project/c-projects.php')):
		?>
			<?php
			$prj_listing_class 		= '';
			$project_listing 		= get_post_meta(get_the_ID(),'portfolio_layout',true);
			$project_tags_filter 	= get_post_meta(get_the_ID(),'show_tags_filter',true);

			if($project_tags_filter == '')
			    $project_tags_filter = 'on';

			if($project_listing == '')
			    $project_listing = 'prj_list_modern_spacing';

			if($project_listing == 'prj_list_modern_spacing')
			    $prj_listing_class = '';

			else if($project_listing == 'prj_list_modern_no_spacing')
			    $prj_listing_class = 'no-padding';

			else if($project_listing=='prj_list_masonry_modern')
			    $prj_listing_class = 'portfolio-masonry';

			else if($project_listing=='prj_list_masonry_modern_no_spacing')
			    $prj_listing_class = 'portfolio-masonry no-padding';

			?>
			<!--Listing-->
			<div class="list-wrap">
			    <div class="loading-listing"></div> <!--Loading-->
			    <div class="list-content background-color-5c post-grid modern-grid portfolio-grid <?php echo esc_attr($prj_listing_class);?>">
			        <div class="container"> <!--Container-->
			            <div class="row"> <!--row-->
			                <div class="col-md-12 fix-right-left"> <!--col-md-12 -> 3 column --> <!--col-md-8 -> 2 column -->
			                    <?php if($project_tags_filter != '' && $project_tags_filter != 'off'){?>
			                        <div class="tag-group">
			                            <a href="#" class="filter-masonry active" rel="tag" data-filter="*">all</a>
			                            <?php
			                                $prj_tags = get_terms( 'project-tag' );
			                                foreach ($prj_tags as $p_term) {
			                                    //$link_t = get_term_link($p_term->slug, 'project-tag');
			                            ?>
			                                <a href="#" class="filter-masonry" rel="tag" data-filter=".filter-listing-<?php echo esc_attr($p_term->slug);?>"><?php echo $p_term->name;?></a>
			                            <?php }//End of Foreach?>
			                        </div>
			                    <?php }?>
			                    <div class="row item-fix-modern">
			                    <?php
			                    	global $paged, $wp;
			                        global $wp_query;
	                            	$temp_query = $wp_query;
	                            	$paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);

			                        $options = array(
			                            'post_type'             => 'c-project',
			                            'order'                 => 'desc',
			                            'paged'					=> $paged,
			                            'post_status'           => 'publish',
			                            'ignore_sticky_posts'   => true
			                        );

			                        $query= new WP_Query($options);

			                        $wp_query = $query;

			                        global $wp_query, $wp;

			                        $total_page = ceil($query->found_posts / get_option('posts_per_page'));

									$js_params['current_url'] =  home_url($wp->request);

			                        if ( $query->have_posts() ) :
			                            while ( $query->have_posts() ) : $query->the_post();
										$single_project_repcolor = get_post_meta(get_the_ID(), 'c_project_repcolor', true);
										$main_color = ot_get_option('main_color', '#25c3d8');
										if($single_project_repcolor == ''){$single_project_repcolor = $main_color;}
			                    ?>
			                        <!--List Item-->
			                        <div id="<?php echo 'single_post_'.get_the_ID();?>" data-cactus-color="<?php echo esc_attr($single_project_repcolor);?>" class="list-item col-md-4 is-effect-visible<?php $project_tag = wp_get_post_terms( get_the_ID(), 'project-tag'); foreach ($project_tag as $term) {echo ' filter-listing-'.''.$term->slug.'';}?>"> <!--add: is-effect-visible don't use for list masonry-->

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
			                                                    echo $tags_str;
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
			                    <?php   endwhile;
			                        endif; ?>
			                    </div>

			                    <!--wp-pagenavi-->
			                    <div class="page-navigation"><?php cactus_project_paging_nav();$wp_query = $temp_query ;?></div>
			                    <!--wp-pagenavi-->

			                </div> <!--Col-->

			            </div><!--row-->
			        </div> <!--Container-->

			    </div>
			</div>
			<!--Listing-->
		<?php else:?>
		<div class="list-wrap">
		    <div class="loading-listing"></div> <!--Loading-->
		    <div class="list-content background-color-5c post-grid modern-grid portfolio-grid">
		        <div class="container"> <!--Container-->
		            <div class="row"> <!--row-->
		                <div class="col-md-12 fix-right-left"> <!--col-md-12 -> 3 column --> <!--col-md-8 -> 2 column -->
		                	<?php esc_html_e('You need to install CactusThemes-Project plugin to use this function', 'cactusthemes');?>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<?php endif;?>

	<?php endif;?>



<?php get_footer(); ?>
