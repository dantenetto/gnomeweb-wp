<?php
/**
 * @package GNOME Website
 * @subpackage Grass Theme
 */

require_once("header.php"); ?>

    <!-- container -->
    <div id="container">
        <div class="container_12">
        
            <div class="project_title">
                <style> h1 img { vertical-align: middle } </style>
                <h1>
                <?php
                if ( has_post_thumbnail($post->ID) ) {
	                echo get_the_post_thumbnail($post->ID, 'icon-small' );
                } else {
	                // the current post lacks a thumbnail
	                echo 'noicon';
                }
                ?>
                <?php echo wppo_get_the_title(); ?></h1>
            </div>
            
            <div class="content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php echo wppo_get_the_content(); ?>
            <?php endwhile; // End the loop. Whew. ?>
                <br />
                <div class="clear"></div>
            </div>
            <?php require_once("footer_art.php"); ?>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <?php require_once("footer.php"); ?>
</body>
</html>
