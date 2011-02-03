<?php
/**
 * @package GNOME Website
 * @subpackage Grass Theme
 */

require_once("header.php"); ?>

    <!-- container -->
    <div id="container" class="two_columns">
        <div class="container_12">
        
            <div class="page_title">
                <h1><a href="#">News</a></h1>
            </div>
            
            <div class="content">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="news_title">
                    <p class="date"><?php the_date(); ?></p>
                    <h1><?php echo wppo_get_the_title(); ?></h1>
                </div>
                <?php echo wppo_get_the_content(); ?>
            <?php endwhile; // End the loop. Whew. ?>
                <br />
                <div class="clear"></div>
            </div>
            
            <div class="sidebar">
                
                    <p>For more GNOME news, check out the <a href="#">Planet GNOME</a>.</p>
                    
                    <p>FIXME</p>
                      
            </div>
            <?php require_once("footer_art.php"); ?>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <?php require_once("footer.php"); ?>
</body>
</html>
