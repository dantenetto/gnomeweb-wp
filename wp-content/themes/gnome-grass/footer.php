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
                
                if(function_exists('icl_get_languages')) {
                
                    $languages = icl_get_languages('skip_missing=0&orderby=code');
                    
                    echo '<div><ul class="menu available_languages">';
                    
                    if(count($languages) > 0) {
                        echo '<li><strong>';
                        echo _e('Also available in:', 'grass');
                        echo '</strong><ul class="sub-menu">';
                    }
                    
                    foreach($languages as $key => $value) {
                        if($value['active'] == true) {
                            echo '<li class="active"><a href="'.$value['url'].'" title="'.$value['translated_name'].'">'.$value['native_name'].'</a></li>';
                        } else {
                            echo '<li><a href="'.$value['url'].'" title="'.$value['translated_name'].'">'.$value['native_name'].'</a></li>';
                        }
                    }
                    
                    echo '</ul></li></ul></div>';
                    
                    /*
                     * If the number of available languages get bigger,
                     * we'll have to put a "more..." link here.
                     *
                     */
                    
                }
                
                ?>
            </div>
            
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
