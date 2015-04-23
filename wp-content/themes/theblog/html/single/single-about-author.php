<?php
/**
 * The Template for displaying About Author
 *
 * @package cactus
 */
global $_is_retina_;
?>
<!--author-->
<div class="i-p-author">
    <div class="author-content">
        <div class="author-pic">
            <div class="img-oval">
                 <?php
                    if($_is_retina_){
                            echo get_avatar( get_the_author_meta('email'), 180, esc_url(get_template_directory_uri() . '/images/avatar-2x-retina.jpg' ));
                    }else{
                            echo get_avatar( get_the_author_meta('email'), 90, esc_url(get_template_directory_uri() . '/images/avatar-2x.jpg' ));
                }?>
            </div>
        </div>
        <div class="author-name">
            <span class="name font-1"><?php the_author_meta( 'display_name' ); ?></span>
            <span class="mnl font-1">
             <?php
             $author = get_user_by( 'email', get_the_author_meta( 'email' ) );
             if($twitter = get_the_author_meta('positon',$author->ID)){ echo esc_attr( get_the_author_meta( 'positon', $author->ID ) ); }?>
            </span>
        </div>

        <!--author social block-->
        <div class="author-social">
            <ul class="list-inline social-listing">
                <?php 
                if($facebook = get_the_author_meta('facebook',$author->ID)){ ?>
                    <li class="facebook"><a rel="nofollow" href="<?php echo esc_url($facebook); ?>" title="<?php esc_html_e('Facebook', 'cactusthemes');?>"><i class="fa fa-facebook"></i></a></li>
                <?php }
                if($twitter = get_the_author_meta('twitter',$author->ID)){ ?>
                    <li class="twitter"><a rel="nofollow" href="<?php echo esc_url($twitter); ?>" title="<?php esc_html_e('Twitter', 'cactusthemes');?>"><i class="fa fa-twitter"></i></a></li>
                <?php }
                if($google = get_the_author_meta('google',$author->ID)){ ?>
                   <li class="google-plus"> <a rel="nofollow" href="<?php echo esc_url($google); ?>" title="<?php esc_html_e('Google Plus', 'cactusthemes');?>"><i class="fa fa-google-plus"></i></a></li>
                <?php }
                if($email = get_the_author_meta('email',$author->ID)){ ?>
                    <li class="email"><a rel="nofollow" href="mailto:<?php echo esc_url($email); ?>" title="<?php esc_html_e('Email', 'cactusthemes');?>"><i class="fa fa-envelope-o"></i></a></li>
                <?php } ?>
            </ul>
        </div>
        <!--author social block-->

    </div>

    <!--remove <p>...</p>-->
    <div class="author-excerpt">
    <?php 
        $author_excerpt = '';
        $author_excerpt = get_the_author_meta('description');
        if($author_excerpt != ''){
            echo '<p>'. $author_excerpt .'</p>';
        }
    ?>    
</div><!--author excerpt -->

</div>
<!--author-->