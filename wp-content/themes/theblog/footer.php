<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package cactus
 */
?>
<?php global $theme_layout;?>
</div> <!-- end cactus-body-container-->
      <footer> <!--Footer-->
        <?php if(ot_get_option('scroll_top_button')=='on'):?>
          <div class="container next-top-header">
                <div class="row">
                    <div class="col-md-12">
                      <div class="button-to-top">
                          <i class="fa fa-angle-up"></i>
                        </div>
                    </div>
                </div>
            </div>
          <?php endif;?>

          <div class="footer-inner background-color-2 dark-div">
            <div class="footer-sidebar">
                <div class="container">
                    <div class="row">
                      <?php
                        if ( is_active_sidebar( 'footer_sidebar' ) ) :
							global $wid_def;
							$wid_def=1; // to recognize footer sidebar
                              dynamic_sidebar( 'footer_sidebar' );
							$wid_def=0;
                        endif;
                      ?>
                    </div>
                </div>
            </div>
          </div>

          <div class="footer-info background-color-2 dark-div">
              <div class="container">
                  <div class="row">
                    <div class="border-top"></div>
                      <div class="col-md-6 col-sm-6 copyright font-1"><?php echo ot_get_option('copyright'); ?></div>
                      <div class="col-md-6 col-sm-6 link font-1">
                          <div class="menu-footer-menu-container">
                              <ul id="menu-footer-menu" class="menu">
                                  <?php
                                    if(has_nav_menu( 'footer-menu' ))
                                    {
                                      wp_nav_menu(array(
                                        'theme_location'  => 'footer-menu',
                                        'container' => false,
                                        'items_wrap' => '%3$s'
                                      ));
                                    }
                                  ?>
                              </ul>
                           </div>
                      </div>
                  </div>
              </div>
          </div>

      </footer> <!--Footer-->      
<?php if($theme_layout != 'standard'):?>
</div></div></div></div></div>
<?php else:?>
    </div><!--wrap-->
</div><!--body-wrap-->
<?php endif;?>
<?php wp_footer(); ?>
</body>
</html>