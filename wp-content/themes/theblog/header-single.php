<?php
/**
 * @package cactus
 */
?>
<?php
global $_is_retina_;
	while ( have_posts() ) : the_post();

$single_standard_layout = get_post_meta(get_the_ID(), 'post_standard_layout', true);
if($single_standard_layout =='default'|| $single_standard_layout==''){
	$single_standard_layout = ot_get_option('single_standard_layout', 'layout_1');
}
	if($single_standard_layout == 'layout_1'){
	$categories = get_the_category();
    $cat_name = '';
	$cat_id = '';
	if($categories){
		foreach($categories as $category) {
			$cat_name = $category->cat_name;
			$cat_id = $category->cat_ID;
		}
	}
	$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
	$thumb_url = wp_get_attachment_url( $thumbnail_id );
	$post_types = get_post_type(get_the_ID());
	?>
<!--Slider-->
<?php if(get_post_format()!= "gallery" && get_post_format()!= "video" && get_post_format()!= "audio" && get_post_format()!= "quote" && $post_types != 'c-project'){ ?>
    <div class="cactus-wraper-slider-bg">

        <!--Slider V1-->
        <div class="slider cactus-slider-single" data-auto-play="" data-pagination="0" data-transition="fade" data-full-height="0"> <!--fade, backSlide, goDown, scaleUp-->

        <?php if($thumbnail_id !=''){?>
            <!--Slider Item-->
            <div class="slider-item is-parallax" data-bg-img="<?php echo esc_attr($thumb_url);?>" data-div-height="620px" data-background-single="fixed"> <!-- images/slide-1.jpg -->

                <div class="thumb-overlay background-color-2"></div>

                <div class="container">
                    <div class="row">

                        <?php
                        $single_show_categories         = ot_get_option('single_show_categories');
                        $single_show_author             = ot_get_option('single_show_author');
                        $single_show_date               = ot_get_option('single_show_date');
                        ?>
                        <div class="text-content">
                            <?php if($single_show_categories != '' && $single_show_categories == 'on'):?>
                                <div class="text-1 font-1"><span><a href="<?php echo esc_url(get_category_link( $cat_id )); ?> "><?php echo esc_html($cat_name); ?></a></span></div>
                            <?php endif;?>
                            <div class="text-2 font-1 col-md-12"><div><h1><?php the_title() ?></h1></div></div>
                            <div class="clearfix"></div>
                            <div class="text-3 font-1">
                                <span>
                                    <?php if($single_show_author != '' && $single_show_author == 'on'):?>
                                        <span class="picture-author">
                                        	<?php
    											if(isset($_is_retina_)&&$_is_retina_){
    													echo get_avatar( get_the_author_meta('email'), 80, esc_url(get_template_directory_uri() . '/images/avatar-2x-retina.jpg' ));
    											}else{
    													echo get_avatar( get_the_author_meta('email'), 40, esc_url(get_template_directory_uri() . '/images/avatar-2x.jpg' ));
    										}?>
                                        </span>
                                        <span class="author-name">
                                        	<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author_meta( 'display_name' ); ?></a>
                                        </span>
                                    <?php endif;?>

                                    <?php if($single_show_date != '' && $single_show_date == 'on'):?>
                                        <span class="time">
                                        	<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr( get_the_time() ) ?>"><?php echo date_i18n(get_option('date_format') ,get_the_time('U'));?></a>
                                        </span>
                                    <?php endif;?>

                                    <span class="comment-s">
                                    	<a class="next-to-comments" href="#"> <?php comments_number(); ?> </a>
                                    </span>
                                </span>
                            </div>
                        </div>

                    </div>
                 </div>

                 <div class="loading-img">
                     <div class="floatingCirclesG">
                         <div class="f_circleG frotateG_01"></div>
                         <div class="f_circleG frotateG_02"></div>
                         <div class="f_circleG frotateG_03"></div>
                         <div class="f_circleG frotateG_04"></div>
                         <div class="f_circleG frotateG_05"></div>
                         <div class="f_circleG frotateG_06"></div>
                         <div class="f_circleG frotateG_07"></div>
                         <div class="f_circleG frotateG_08"></div>
                     </div>
                 </div>
            </div><!--Slider Item-->
        <?php }?>
        </div>
        <!--Slider V1-->
    </div>
    <!--Slider-->
    <?php } //check post format?>
<?php } endwhile;?>

<?php if($single_standard_layout == 'layout_2' || get_post_format()=="quote" || get_post_format()=="video" || get_post_format()=="audio" || get_post_format()=="gallery" || $post_types == 'c-project'){ ?>
<!--Slider-->
<div class="cactus-wraper-slider-bg">
    <!--Slider V1-->
    <div class="slider cactus-slider-single" data-auto-play="" data-pagination="0" data-transition="fade" data-full-height="0"> <!--fade, backSlide, goDown, scaleUp-->
    </div>
    <!--Slider V1-->

    <!--scroll down for more-->
    <div class="scroll-next-div font-1">
        scroll down for more
    </div>
    <!--scroll down for more-->
</div>
<!--Slider-->
<?php }?>