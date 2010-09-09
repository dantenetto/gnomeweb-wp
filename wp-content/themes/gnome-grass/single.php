<?php
/**
 * @package GNOME Website
 * @subpackage Grass Theme
 */


$post_type = get_post_type();

if($post_type == 'post') {

    require_once('news.php');
    
} elseif($post_type == 'banner') {

    //require_once('banner.php');
    echo 'FIXME';
    
}


?>
