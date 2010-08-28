<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<!-- Good morning, GNOME -->
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('-', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.png" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/template.js"></script>
<?php wp_head(); ?>
</head>


<body>

    <!-- accessibility access -->
    <div id="accessibility_access">
        <ul>
            <li><a href="#container"><?php _e( 'Go to page content', 'grass' ); ?></a></li>
            <li><a href="#top_bar"><?php _e( 'Go to main menu', 'grass' ); ?></a></li>
            <li><a href="#s" onclick="$('#s').focus(); return false;"><?php _e( 'Go to the search field', 'grass' ); ?></a></li>
        </ul>
    </div>
    
    <!-- header -->
    <div id="header" class="container_12">
        <div id="logo" class="grid_3">
            <h1><a title="<?php _e( 'Go to home page', 'grass' ); ?>" href="<?php bloginfo('url'); ?>/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/gnome-logo.png" alt="<?php echo _e('GNOME: The Free Software Desktop Project', 'grass');?>" /></a></h1>
        </div>
        <div id="top_bar" class="grid_9">
            <div class="left">
                <?php wp_nav_menu('menu=globalnav'); ?>
                <?php /*<ul>
                    <li class="selected"><a href="index.html">About</a></li>
                    <li><a href="../products/index.html">Products</a></li>
                    <li><a href="../download/index.html">Download</a></li>
                    <li><a href="../support/index.html">Support</a></li>
                    <li><a href="../community/index.html">Community</a></li>
                    <li><a href="../contact/index.html">Contact</a></li>
                </ul> */ ?>
            </div>
            <div class="right">
                <form role="search" method="get" id="searchform" action="<?php bloginfo('url'); ?>/" >
                    <div>
                        <label class="hidden" for="s"><?php _e( 'Search', 'grass' ); ?>: </label><input type="text" value="<?php if(isset($_GET['s'])) { echo htmlentities(strip_tags($_GET['s'])); } ?>" name="s" id="s" placeholder="<?php _e( 'Search', 'grass' ); ?>" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
