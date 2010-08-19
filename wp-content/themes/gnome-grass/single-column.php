<?php
/*
Template Name: Single Column
*/

require_once("header.php"); ?>

    <!-- container -->
    <div id="container" class="two_columns">
        <div class="container_12">
        
            <div class="page_title">
                <h1><?php the_title(); ?></h1>
            </div>
            
            <div class="content without_sidebar">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; // End the loop. Whew. ?>
                <br />
                <div class="clear"></div>
            </div>
            
            <!-- footer artwork -->
            <?php
            
            $footer = get_post_meta($post->ID, 'footer');
            if(count($footer) > 0) {
                $footer_art = $footer[0];
            } else {
                $footer_art = 'default';
            }
            
            ?>
            <div id="footer_art" class="grid_12 <?php echo $footer_art; ?>">
                <?php print_r($post_meta[$post->ID]); ?>
            </div>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <?php require_once("footer.php"); ?>
</body>
</html>
