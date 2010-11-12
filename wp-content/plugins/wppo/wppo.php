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

define (PO_DIR, ABSPATH . "po/");

/* Setting up where compiled po files are located and which translation
 * domain to use. */
bindtextdomain ('gnomesite', PO_DIR);
bind_textdomain_codeset ('gnomesite', 'UTF-8');
textdomain ('gnomesite');

/* This action will be fired when a post/page is updated. It's used to
 * update (regenerate, actually) the pot file with all translatable
 * strings of the gnome.org website. */
function wppo_update_pot_file ($post) {
  $xml_file = PO_DIR . ".tmp.xml";
  $pot_file = PO_DIR . "gnomesite.pot";
  file_put_contents ($xml_file, wppo_generate_po_xml ());
  exec ("/usr/bin/xml2po -o $pot_file $xml_file");
  unlink ($xml_file);
}
add_action ('post_updated', 'wppo_update_pot_file');

/* Using gettext to get the translated version of received strings */
function wppo_get_translated_string ($content) {
  $lang = isset ($_REQUEST['lang']) ? $_REQUEST['lang'] : $_COOKIE['lang'];
  if (!$lang)
    return $content;

  setlocale (LC_MESSAGES, $lang);

  /* If there's a new line in the content, we use wpautop() function,
   * because the script that generates the xml with translatable strings
   * has to call it otherwise we'll lose paragraphs inserted by the
   * user. */
  if (stristr ($content, "\n") === FALSE)
    return gettext ($content);
  else
    $content = wpautop ($content);

  /* Parsing the content to split up <p> tags */
  $newct = '';
  $parser = xml_parser_create ();
  xml_parse_into_struct ($parser, "<r>$content</r>", $vals, $index);
  foreach ((array) $index['P'] as $p)
    $newct .= "<p>" . gettext ($vals[$p]['value']) . "</p>\n";
  xml_parser_free ($parser);
  return $newct;
}
add_filter ('the_title', 'wppo_get_translated_string', 1);
add_filter ('the_content', 'wppo_get_translated_string', 1);

/* Saving the language code choosen by the user */
if (isset ($_REQUEST['lang']))
  setcookie ("lang", $_REQUEST['lang'], time () + 36000, "/");

/* A nice url to show the pot file */
if (isset ($_REQUEST['pot'])) {
  header ("Content-Type: text/plain");
  die (file_get_contents (PO_DIR . "gnomesite.pot"));
}

?>
