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
                <h1><?php _e( 'Looking for', 'grass' ); ?> <em><?php echo htmlentities(strip_tags($_GET['s']));?></em>...</h1>
            </div>
            
            <div class="content without_sidebar">
                <dl>
                <?php while ( have_posts() ) : the_post(); ?>
                    <dt><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dt>
                    <dd><?php the_excerpt(); ?></dd>
                <?php endwhile; // End the loop. Whew. ?>
                </dl>
                <div class="clear"></div>
            </div>
            <?php $footer_art = 'search'; ?>
            <?php require_once("footer_art.php"); ?>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <?php require_once("footer.php"); ?>
</body>
</html>
