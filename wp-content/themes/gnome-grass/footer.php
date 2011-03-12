    <!-- footer grass -->
    <div id="footer_grass">
        &nbsp;
    </div>

    <!-- footer -->
    <div id="footer">
        <div class="container_12">
            <div class="links grid_9">
                <?php
                wp_nav_menu('menu=footer-1');
                wp_nav_menu('menu=footer-2');
                wp_nav_menu('menu=footer-3');
                wp_nav_menu('menu=footer-4');
                wp_nav_menu('menu=footer-5');
                ?>
            </div>
            <div class="language grid_3">
                <div>
                    <strong><?php _e( 'This website is available in many languages', 'grass' ); ?></strong><br />
                    <a href="#FIXME" class="map"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/footer-map.png" alt="<?php _e( 'Switch Language', 'grass' ); ?>" title="<?php _e( 'Switch Language', 'grass' ); ?>" /></a>
                </div>
            </div>
            
            <!-- footnotes -->
            <div id="footnotes" class="grid_9">
                <?php _e( 'Copyright', 'grass' ); ?> © 2005‒2010 <strong class="gnome_logo"><?php _e( 'The GNOME Project', 'grass' ); ?></strong><br />
                <small><?php _e( 'Optimised for standards', 'grass' ); ?>. <?php _e( 'Hosted by', 'grass' ); ?> <a href="http://redhat.com">Red Hat</a>.</small>
            </div>
            
            <div class="clear"></div>
        </div>
    </div>
    <?php
    wp_footer();
    ?>   
