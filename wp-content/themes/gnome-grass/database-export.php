<?php
// Vinicius Depizzol
// vdepizzol@gmail.com


// This code by now only generates a XML with all the content from WordPress database.

require_once(ABSPATH . "wp-config.php");

function generate_po_xml () {
  global $wpdb;

  $myrows = $wpdb->get_results( "SELECT ID, post_content, post_title, post_excerpt, post_name FROM wp_posts WHERE post_type != 'revision' && post_type != 'nav_menu_item'" );


  header("Content-type: text/xml");

  $broken_dom_pages = array();

  $dom = new DOMDocument('1.0', 'utf-8');
  $dom->formatOutput   = true;

  $root = $dom->createElement("website");

  foreach($myrows as $key => $value) {

    $page = $dom->createElement("page");


    // ID

    $page_id = $dom->createAttribute('id');
    $page_id_value = $dom->createTextNode($value->ID);
    $page_id->appendChild($page_id_value);
    $page->appendChild($page_id);


    // page_title

    $page_title = $dom->createElement("title");
    $page_title_value = $dom->createTextNode($value->post_title);
    $page_title->appendChild($page_title_value);
    $page->appendChild($page_title);


    // page_name

    $page_name = $dom->createElement("name");
    $page_name_value = $dom->createTextNode($value->post_name);
    $page_name->appendChild($page_name_value);
    $page->appendChild($page_name);


    // page_content


    $value->post_content = wpautop($value->post_content);


    $content_xml = $dom->createDocumentFragment();
    $content_xml->appendXML('<html>'.$value->post_content.'</html>');
    if($content_xml == false) {
      $broken_dom_pages[] = $value->ID;
    }

    $page_content = $dom->createElement("content");
    $page_content->appendChild($content_xml);
    $page->appendChild($page_content);

    $root->appendChild($page);

  }
  $dom->appendChild($root);

  $content = $dom->saveXML();
  return $content;
}

if (isset($_REQUEST['print']))
  print generate_po_xml ();

?>
