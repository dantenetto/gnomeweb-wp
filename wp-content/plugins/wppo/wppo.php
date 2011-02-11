<?php
/*
Plugin Name: WPPO
Description: A hack to make wordpress become a multilingual site using gettext
Version: 0.1
Author: Lincoln de Sousa <lincoln@comum.org>
Author URI: http://lincoln.comum.org
License: AGPLv3
*/

/* Copyright 2010  Lincoln de Sousa <lincoln@comum.org>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once ("wppo.genxml.php");

define (WPPO_DIR, ABSPATH . "wppo/");
define (PO_DIR, WPPO_DIR . "po/");
define (POT_DIR, WPPO_DIR . "pot/");
define (POT_FILE, POT_DIR . "gnomesite.pot");
define (XML_DIR, WPPO_DIR . "xml/");

$wppo_cache = array();

/* Setting up where compiled po files are located and which translation
 * domain to use. */
bindtextdomain ('gnomesite', PO_DIR);
bind_textdomain_codeset ('gnomesite', 'UTF-8');
textdomain ('gnomesite');

/* Creates wppo auxiliary table when plugin is installed to keep all the
 * translated xml in an easy accessible format.
 */
function wppo_install () {
  global $wpdb;

  $table_name = $wpdb->prefix . "wppo";
  
  if($wpdb->get_var ("SHOW TABLES LIKE '$table_name'") != $table_name) {
  
    $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
             `wppo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
             `post_id` bigint(20) unsigned NOT NULL,
             `lang` varchar(10) NOT NULL,
             `translated_title` text NOT NULL,
             `translated_excerpt` text NOT NULL,
             `translated_name` varchar(200) NOT NULL,
             `translated_content` longtext NOT NULL,
             PRIMARY KEY (`wppo_id`),
             KEY `post_id` (`post_id`)
           ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    
    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta ($sql);
  }
  
  if (!is_dir (PO_DIR)) {
    @mkdir (PO_DIR, 0777);
    @mkdir (POT_DIR, 0777);
    @mkdir (XML_DIR, 0777);
  }
  
  wppo_update_pot_file ();
}
register_activation_hook (__FILE__, 'wppo_install');


/* This action will be fired when a post/page is updated. It's used to
 * update (regenerate, actually) the pot file with all translatable
 * strings of the gnome.org website. */
function wppo_update_pot_file ($post) {
  $xml_file = XML_DIR . "gnomesite.xml";
  file_put_contents ($xml_file, wppo_generate_po_xml ());
  exec ("/usr/bin/xml2po -m xhtml -o " . POT_FILE . " $xml_file");
  
  /* Update all the existing po files to handle the modifications in the
   * content using xml2po -u
   */
  if ($handle = opendir (PO_DIR)) {
    while (false !== ($po_file = readdir ($handle))) {
    
      /* Gets all the .po files from PO_DIR. */
      if (strpos ($po_file, '.po', 1) !== false && strpos ($po_file, '.pot', 1) === false) {
        exec ("/usr/bin/xml2po -m xhtml -u " . PO_DIR . " $po_file $xml_file");
      }
    }
  }
  
  /* This shouldn't be here. FIXME */
  wppo_receive_po_file ();
  
}
add_action ('post_updated', 'wppo_update_pot_file');


/* this action will be fired when damned lies system send an updated version of
 * a po file. This function needs to take care of creating the translated
 * xml file and separate its content to the wordpress database */
function wppo_receive_po_file () {
  global $wpdb;
  
  $table_format = array ('%s', '%d', '%s', '%s', '%s'); 
  
  if ($handle = opendir (PO_DIR)) {
    while (false !== ($po_file = readdir ($handle))) {
    
      /* Gets all the .po files from PO_DIR. Then it will generate a translated
       * XML for each language.
       *
       * All the po files must use the following format: "gnomesite.[lang-code].po"
       *
       */
      if (strpos ($po_file, '.po') !== false && strpos ($po_file, '.pot') === false) {
        $po_file_array = explode ('.', $po_file);
        
        /* Arranging the name of the translated xml to something like
         * "gnomesite.pt-br.xml".
         */
        $lang = $po_file_array[1];
        $translated_xml_file = XML_DIR . 'gnomesite.' . $lang . '.xml';
        
        exec ("/usr/bin/xml2po -m xhtml -p " . PO_DIR . "$po_file -o $translated_xml_file " . XML_DIR . "gnomesite.xml");
        
        $translated_xml = file_get_contents ($translated_xml_file);
        
        $dom = new DOMDocument ();
        $dom->loadXML($translated_xml);
        
        $pages = $dom->getElementsByTagName ('page');
        
        foreach ($pages as $page) {
        
          $page_id      = $page->getAttributeNode ('id')->value;
          $page_title   = $page->getElementsByTagName ('title')->item(0)->nodeValue;
          $page_excerpt = $page->getElementsByTagName ('excerpt')->item(0)->nodeValue;
          $page_name    = $page->getElementsByTagName ('name')->item(0)->nodeValue;
          

          $page_content_elements = $page->getElementsByTagName ('html')->item (0)->childNodes;
          $page_content = '';
          foreach ($page_content_elements as $element) {
            $page_content .= $element->ownerDocument->saveXML ($element);
          }
          
          $page_array = array ('lang' => $lang,
                                'post_id' => $page_id,
                                'translated_title' => $page_title,
                                'translated_excerpt' => $page_excerpt,
                                'translated_name' => $page_name,
                                'translated_content' => $page_content);
          
          
          /* Stores in the table the translated version of the page */
          $wpdb->get_row ("SELECT wppo_id FROM " . $wpdb->prefix . "wppo WHERE post_id = '" . $page_id . "' AND lang = '" . $lang . "'");
          if($wpdb->num_rows == 0) {
              $wpdb->insert ($wpdb->prefix . "wppo", $page_array, $table_format);
          } else {
              $wpdb->update ($wpdb->prefix . "wppo", $page_array, array ('post_id' => $page_id, 'lang' => $lang), $table_format);
          }
          
        
        }     
      }
    }
  }
}


/* Get all the translated data from the current post */
function wppo_get_translated_data ($string) {
  global $post, $wpdb, $wppo_cache;
  
  $lang = isset ($_REQUEST['lang']) ? $_REQUEST['lang'] : $_COOKIE['lang'];
  
  if (!$lang)
    return false;
  
  if(!isset ($wppo_cache[$post->ID])) {
    $wppo_cache[$post->ID] = $wpdb->get_row ("SELECT * FROM " . $wpdb->prefix . "wppo WHERE post_id = '" . $post->ID . "' AND lang = '" . $lang . "'", ARRAY_A);
  }
  
  if(isset ($wppo_cache[$post->ID][$string]))
    return $wppo_cache[$post->ID][$string];
  else
    return false;
}


function wppo_get_the_title () {
  global $post, $wpdb;
  
  $title = wppo_get_translated_data ('translated_title');
  
  if ($title != false) {
    return $title;
  } else {
    return $post->post_title;
  }
  
}

function wppo_get_the_excerpt () {
  global $post, $wpdb;
  
  $content = wppo_get_translated_data ('translated_excerpt');
  
  if ($content != false) {
    return $content;
  } else {
    return $post->post_excerpt;
  }
  
}

function wppo_get_the_content () {
  global $post, $wpdb;
  
  $content = wppo_get_translated_data ('translated_content');
  
  if ($content != false) {
    return $content;
  } else {
    return wpautop ($post->post_content);
  }
  
}


/* Using gettext to get the translated version of received strings */
/* This function won't be used anymore. FIXME */
//function wppo_get_translated_string ($content) {
//  $lang = isset ($_REQUEST['lang']) ? $_REQUEST['lang'] : $_COOKIE['lang'];
//  if (!$lang)
//    return $content;
//
//  setlocale (LC_MESSAGES, $lang);
//
//  /* If there's a new line in the content, we use wpautop() function,
//   * because the script that generates the xml with translatable strings
//   * has to call it otherwise we'll lose paragraphs inserted by the
//   * user. */
//  if (stristr ($content, "\n") === FALSE)
//    return gettext ($content);
//  else
//    $content = wpautop ($content);
//
//  /* Parsing the content to split up <p> tags */
//  $newct = '';
//  $parser = xml_parser_create ();
//  xml_parse_into_struct ($parser, "<r>$content</r>", $vals, $index);
//  foreach ((array) $index['P'] as $p)
//    $newct .= "<p>" . gettext ($vals[$p]['value']) . "</p>\n";
//  xml_parser_free ($parser);
//  return $newct;
//}
//add_filter ('the_title', 'wppo_get_translated_string', 1);
//add_filter ('the_content', 'wppo_get_translated_string', 1);
//
///* Saving the language code choosen by the user */
//if (isset ($_REQUEST['lang']))
//  setcookie ("lang", $_REQUEST['lang'], time () + 36000, "/");
//
///* A nice url to show the pot file */
//if (isset ($_REQUEST['pot'])) {
//  header ("Content-Type: text/plain");
//  die (file_get_contents (PO_DIR . "gnomesite.pot"));
//}

?>
