<?php
/*
Template Name: Single Column
*/

require_once("header.php"); ?>

    <!-- container -->
    <div id="container" class="two_columns">
        <div class="container_12">
            
            <div class="content without_sidebar">
            <?php
            
            $temp_query = clone $wp_query;
            
            query_posts(array('post_type' => 'banner', 'posts_per_page' => 1));
            
            while ( have_posts() ) : the_post();
            
            ?>
                <?php
                
                $home_link = get_post_meta($post->ID, 'link', true);
                
                echo '<div id="home_banner">';
                if($home_link != '') {echo '<a href="'.$home_link.'">'; } ?>
                <?php the_post_thumbnail(array(940, 350), array('alt' => get_the_excerpt($post->ID), 'title' => get_the_title($post->ID))); ?>
                <?php if($home_link != '') {echo '</a>'; }
                echo '</div>';
                ?>
                
            <?php endwhile; // End the loop. Whew.

            $wp_query = clone $temp_query;
            
            ?><div class="news_list grid_9 alpha"><?php
            while ( have_posts() ) : the_post();
            ?>
                <div class="news">
                    <div class="date grid_3 alpha">
                        <?php the_date(); ?>
                    </div>
                    
                    <div class="grid_6 omega">
                        <a href="<?php the_permalink(); ?>">
                            <strong><?php the_title(); ?></strong><br />
                            <?php echo strip_tags(get_the_excerpt()); ?>
                        </a>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php
            endwhile;
            ?>
            </div>
                <div class="grid_3 omega">
                    <div class="subtle_box">
                        <p>For more GNOME news, check out the <a href="#">Planet GNOME</a>.</p>
                        <p><strong>Planet GNOME</strong> groups blogs of GNOME hackers and contribuitors.</p>
                    </div>
                </div>
            <?php
            
            ?>
                <br />
                <div class="clear"></div>
            </div>
            
            <!-- footer artwork -->
            <?php require_once("footer_art.php"); ?>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <?php require_once("footer.php"); ?>
</body>
</html>
