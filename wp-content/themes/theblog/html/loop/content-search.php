<?php
/**
 * @package cactus
 */
?>
<?php
    $quote_post_class       = get_post_format() == 'quote' ? 'quote-post ' : '';
?>

<div class="list-item col-md-4 <?php echo esc_attr($quote_post_class);?>"> <!--add: is-effect-visible don't use for list masonry-->

    <div id="post-<?php the_ID(); ?>" <?php post_class('bg-list-item'); ?>>

        <div class="fix-color-modern background-color-1"></div>

        <div class="fix-special">

            <div class="item-info">
                <div class="category">
                    <span class="font-1"><?php echo date_i18n(get_option('date_format') ,get_the_time('U'));?></span>
                </div>
                <div class="time">

                </div>
            </div>

            <div class="item-title">
                <a href="<?php echo esc_url(get_permalink());?>" title="<?php echo the_title();?>" class="font-1"><?php echo the_title();?></a>
            </div>

            <?php if(trim(get_the_excerpt()) != '' && trim(get_the_excerpt()) != null && trim(get_the_excerpt()) != '&nbsp;'):?>
                <div class="item-excerpt">
                    <span>
                        <?php echo get_the_excerpt(); ?>
                    </span>
                </div>
            <?php endif;?>

            <!--<div class="continue-reading">
                <a href="#" title="" class="">Continue Reading ...</a>
            </div>-->

            <?php
                if(get_post_format() == 'quote')
                {
                    $quote_content      = get_the_content();
                    $quote_content      = preg_replace('/(<cite)(.*)(<\/cite>)/', '', $quote_content);
                    preg_match('/(<cite)(.*)(<\/cite>)/', get_the_content(), $matches);
                    $link_post_quote    = '<a href="' . get_the_permalink() . '?>" title="' . get_the_title() . '?>" class="font-1">' . substr(strip_tags($quote_content), 0, 100) . '</a>';
                    $author             = isset($matches[0]) ? $matches[0] : '';
                    $author_post_quote  = '<div class="item-sub-author color-5 font-1">' . $author . '</div>';
                }
                else
                {
                    $link_post_quote = '';
                    $author_post_quote = '';
                }
            ?>

            <div class="item-title item-sub-title">
                <?php echo wp_kses_post($link_post_quote);?>
            </div>

            <?php echo wp_kses_post($author_post_quote);?>

            <div class="continue-reading">
                <a href="<?php the_permalink();?>" title="" class=""><?php esc_html_e('Continue Reading ...','cactusthemes');?></a>
            </div>

        </div>

        <div class="clearfix"></div>

        <div class="cactus-related-posts">
            <div class="fix-height-related-posts"></div>
        </div>

    </div>
</div>


