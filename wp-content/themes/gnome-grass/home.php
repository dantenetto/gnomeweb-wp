<?php


require_once("header.php"); ?>

    <!-- introduction home -->
    <div style="background: url(<?php bloginfo('stylesheet_directory'); ?>/images/home/introduction-bg.png) bottom center no-repeat; overflow: hidden;">
        <div class="container_12">
                
                <div class="grid_12" style="border-bottom: 1px solid #ccc; padding-bottom: 70px;">
                    <div class="grid_7 alpha">
                        <h1 style="margin-bottom: 0;">Lorem ipsum dolor sit</h1>
                        <p class="main_feature" style="margin-top: 0;">Amet conseguer domulus sit lorem ipsum dolor sit amet avec consequer.</p>
                        <p><a href="#" class="action_button">Lorem ipsum GNOME</a></p>
                    </div>
                    
                    <div class="clear"></div>
                </div>
        </div>
    </div>
    
    <!-- container -->
    <div id="container" class="two_columns">

        <div class="container_12">
            
            <div class="news_list grid_9">
            
                <?php
                $i = 0;
                while ( have_posts() ) : the_post();
                ?>
                    <div class="news">
                        <?php if ($i == 0): ?>
                        <div class="grid_9 alpha omega" style="background: #ececec; margin-bottom: 10px; height: 180px;">
                            &nbsp;
                        </div>
                        <?php endif; ?>
                        <div class="date grid_3 alpha">
                            <?php the_date(); ?>
                        </div>
                        
                        <div class="grid_6 omega">
                            <a href="<?php the_permalink(); ?>">
                                <strong><?php echo wppo_get_the_title(); ?></strong><br />
                                <?php echo strip_tags(wppo_get_the_excerpt()); ?>
                            </a>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php
                $i++;
                endwhile;
                ?>
            </div>
            
            <div class="grid_3 omega">
                <div class="subtle_box">
                    <p>For more GNOME news, check out the <a href="#">Planet GNOME</a>.</p>
                    <p><strong>Planet GNOME</strong> groups blogs of GNOME hackers and contribuitors.</p>
                </div>
            </div>
            
            <div class="clear"></div>
            
        <?php require_once("footer_art.php"); ?>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <?php require_once("footer.php"); ?>
</body>
</html>
