<!--Navigation-->
<?php
    if(is_front_page())
    {
        $page_on_front = get_option('page_on_front');
        if($page_on_front == 0 || $page_on_front == '')
            $header_layout =  ot_get_option('header_layout', 'static_text_biography');
        else
            $header_layout =  get_post_meta(get_the_ID(),'header_layout',true);

    }
    else if(is_page_template('page-templates/front-page.php'))
        $header_layout =  get_post_meta(get_the_ID(),'header_layout',true);
    else
        $header_layout =  ot_get_option('header_layout', 'static_text_biography');

    $fixed_scroll_top = $header_layout == 'top_posts_carousel' && !is_single() ? 'auto' : '2';

    //sticky menu
    $sticky_menu =  ot_get_option('sticky_navigation')!= '' && ot_get_option('sticky_navigation') == 'on' ? '1' : '0' ;
    $enable_search = ot_get_option('enable_search');

    $cta_button_text = ot_get_option('cta_text');
    if($cta_button_text != '')
    {
        $cta_button_url         = ot_get_option('cta_url') != '' ? ot_get_option('cta_url') : '#';
        $cta_button_cta_target  = (ot_get_option('cta_target') != '' && ot_get_option('cta_target') == 'current_page') ? '' : 'target="_blank"';
    }

    $logo = ot_get_option('logo_image');

    global $theme_layout;
    if($theme_layout == 'standard'):
?>

    <?php if(is_front_page() && is_page_template('page-templates/front-page.php')):?>
        <div class="alert alert-default alert-shop alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            Want to shop on OFN? 
            <strong><a href="#">Start here</a></strong>
        </div><!-- alert -->
    <?php endif;?>
    

         <nav class="navbar navbar-default background-color-1 preload" role="navigation" data-fixed-scroll-top="<?php echo esc_attr($fixed_scroll_top);?>" data-fixed="<?php echo esc_attr($sticky_menu);?>">
            <div class="container">

                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" id="open-menu-moblie">
                    <span class="sr-only"><?php echo esc_html__('Toggle navigation','cactusthemes');?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>

                  <button type="button" class="navbar-toggle search">
                    <i class="fa fa-search"></i>
                  </button>

                  <a class="navbar-brand" href="<?php echo esc_url(get_home_url()); ?>">
                    <div class="primary-logo">
                        <?php if($logo != ''):?>
                                <img src="<?php echo esc_url($logo); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
                        <?php else:?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v2.png');?>"  alt="<?php wp_title( '|', true, 'right' );?>" />
                        <?php endif;?>
                    </div>
                    <div class="sub-logo-animate">
                        <?php $logo_image_sticky = ot_get_option('logo_image_sticky');?>
                        <?php if($logo_image_sticky != ''):?>
                                <img src="<?php echo esc_url($logo_image_sticky); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
                        <?php else:?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v2-sub.png');?>"  alt="<?php wp_title( '|', true, 'right' );?>" />
                        <?php endif;?>
                    </div>
                  </a>
                </div>

                <div class="collapse navbar-collapse font-1">

                    
                    <?php if($cta_button_text != ''):?>
                        <ul class="buy-theme nav navbar-nav navbar-right"><!--Buy Theme Button-->
                            <li class="buy-theme"><a href="<?php echo esc_url($cta_button_url);?>" <?php echo $cta_button_cta_target;?> class="active"><?php echo $cta_button_text;?></a></li>
                        </ul><!--Buy Theme Button-->
                    <?php endif;?>

                    <?php if($enable_search != '' && $enable_search == 'on'):?>
                        <ul class="search nav navbar-nav navbar-right"><!--Search Button-->
                            <li class="search"><a href="#" class="active"><i class="fa fa-search"></i></a></li>
                        </ul><!--Search Button-->
                    <?php endif;?>
                <!--MENU-->
                        <?php   $megamenu = ot_get_option('megamenu', 'off');
                                    if($megamenu =='off'){ ?>
                                        <ul class="nav navbar-nav navbar-right"><!-- nav navbar-nav navbar-right -->
                                        <?php
                                        if(has_nav_menu( 'primary' ))
                                        {
                                            wp_nav_menu(array(
                                                'theme_location'  => 'primary',
                                                'container' => false,
                                                'items_wrap' => '%3$s',
                                                'walker'=> new custom_walker_nav_menu()
                                            ));
                                        }
                                        else {?>
                                                <li><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home','cactusthemes') ?> <span class="menu-description"><?php esc_html_e('Home page','cactusthemes') ?></span></a></li>
                                                <?php wp_list_pages('depth=1&number=4&title_li=' ); ?>
                                            <?php } ?>
                                    </ul><!-- nav navbar-nav navbar-right END -->
                                    <?php }elseif($megamenu =='on') { ?>
                                    <?php
                                        /** Load Magamenu **/
                                        mashmenu_load();?>
                                    <?php }?>
                <!-- MENU END-->

                    <?php if($enable_search != '' && $enable_search == 'on'):?>
                        <ul class="search sub nav navbar-nav navbar-right"><!--Search Button-->
                            <li class="search sub"><a href="#" class="active"><i class="fa fa-search"></i></a></li>
                        </ul><!--Search Button-->
                    <?php endif;?>


                    <?php if($cta_button_text != ''):?>
                        <ul class="buy-theme nav navbar-nav navbar-right buy-theme-sub"><!--Buy Theme Button-->
                            <li class="buy-theme"><a href="<?php echo esc_url($cta_button_url);?>" <?php echo $cta_button_cta_target;?> class="active"><?php echo $cta_button_text;?></a></li>
                        </ul><!--Buy Theme Button-->
                    <?php endif;?>

                </div>

                <!--Sub Logo-->
                <div class="sub-logo">
                    <div class="sub-logo-content">
                        <a href="<?php echo esc_url(get_home_url()); ?>">
                            <?php if($logo != ''):?>
                                    <img src="<?php echo esc_url($logo); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
                            <?php else:?>
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v3.png');?>"  alt="<?php wp_title( '|', true, 'right' );?>" />
                            <?php endif;?>
                        </a>
                    </div>
                </div>
                <!--Sub Logo-->

                <?php if($enable_search != '' && $enable_search == 'on'):?>
                    <!--Search Form-->
                    <div class="cactus-form-header">
                        <div class="search-header-top"></div>
                        <form method="get" action="<?php echo esc_url(home_url()); ?>">
                            <input type="text" name="s" class="input-search font-1" placeholder="<?php esc_html_e('Search', 'cactusthemes');?>">
                            <input type="hidden" name="post_type" value="post" />
                        </form>
                        <div class="button-search-top">
                        </div>
                    </div>
                    <!--Search Form-->
                <?php endif;?>

            </div>
        </nav>
        <!--Navigation-->
    <?php else:?>
        <div class="version-6-table-left">
            <div class="menu-background background-color-27"></div>

            <div class="menu-container">

                <header> <!--Header-->
                    <a href="<?php echo esc_url(get_home_url()); ?>">
                    <!--main logo (large)-->
                    <div class="primary-logo">
                        <?php if($logo != ''):?>
                                <img src="<?php echo esc_url($logo); ?>"  alt="<?php wp_title( '|', false, 'right' );?>">
                        <?php else:?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-v6.png');?>" width="141" height="60"  alt="<?php wp_title( '|', true, 'right' );?>" />
                        <?php endif;?>
                    </div><!--main logo (large)-->
                    </a><!--logo-->
                </header> <!--Header-->

                <div class="off-canvas-inner">
                    <nav class="off-menu font-1">
                        <ul>
                            <?php
                            if(has_nav_menu( 'primary' )):
                                wp_nav_menu(array(
                                    'theme_location'  => 'primary',
                                    'container' => false,
                                    'items_wrap' => '%3$s',
                                    'walker'=> new custom_walker_nav_menu(true, true)
                                ));
                            ?>
                            <?php else:?>
                                    <li><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home','cactusthemes') ?> <span class="menu-description"><?php esc_html_e('Home page','cactusthemes') ?></span></a></li>
                                    <?php wp_list_pages('depth=1&number=4&title_li=' ); ?>
                            <?php endif; ?>

                        </ul>

                        <?php if($enable_search != '' && $enable_search == 'on'):?>
                            <ul class="search-mobile-menu">
                                <li><a href="#" class="open-mini-search-box"><i class="fa fa-search"></i></a></li>

                                <li class="cactus-form-mobile">
                                    <div class="wrap-form">
                                        <form method="get" action="<?php echo esc_url(home_url());?>">
                                            <input type="text" name="s" class="input-search font-1" placeholder="<?php esc_html_e('Search', 'cactusthemes');?>">
                                            <input type="hidden" name="post_type" value="post" />
                                        </form>
                                        <div class="button-search-mobile"></div>
                                    </div>
                                </li>
                            </ul>
                        <?php endif;?>
                        
                        <?php if($cta_button_text != ''):?>
                            <ul class="buytheme-mobile-menu">
                                <li class="buy-theme"><a href="<?php echo esc_url($cta_button_url);?>" <?php echo $cta_button_cta_target;?> class="active"><?php echo $cta_button_text;?></a></li>
                            </ul>
                        <?php endif;?>
                    </nav>
                </div>
            </div>

        </div>

    <?php endif;?>



