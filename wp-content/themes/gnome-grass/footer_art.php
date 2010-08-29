            <!-- footer artwork -->
            <?php
            
            if(!isset($footer_art)) {
                $footer = get_post_meta($post->ID, 'footer_art');
                if(count($footer) > 0) {
                    $footer_art = $footer[0];
                } else {
                    $footer_art = 'default';
                }
            }
            
            ?>
            <div id="footer_art" class="grid_12" style="background-image: url(<?php bloginfo('stylesheet_directory') ?>/images/footer_arts/<?php echo $footer_art;?>.png);">
                <?php print_r($post_meta[$post->ID]); ?>
            </div>
