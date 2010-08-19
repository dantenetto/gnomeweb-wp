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
            <div class="links grid_3 right">
                <?php /* <div>
                    <strong>Also available in:</strong>
                    <a href="#">Español</a>
                    <a href="#">Français</a>
                    <a href="#">Deutsch</a>
                    <a href="#">Italiano</a>
                    <a href="#">Português</a>
                    <a href="#">中文 (Chinese)</a>
                    <a href="#">More...</a>
                </div>
                */ ?>
                <?php
                $sitepress->language_selector();
                ?>
            </div>
            
            <div id="footnotes" class="grid_9">
                Copyright © 2005‒2010 <strong class="gnome_logo"><?php _e( 'The GNOME Project', 'grass' ); ?></strong><br />
                <small><?php _e( 'Optimised for standards', 'grass' ); ?>. <?php _e( 'Hosted by', 'grass' ); ?> <a href="#">Red Hat</a>.</small>
            </div>
            
            <div class="clear"></div>
        </div>
    </div>
    <?php
    wp_footer();
    ?>
