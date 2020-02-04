<?php

/** 
  * trigger this file on plugin uninstall
  * 
  * @package BeckiPlugin
  */

//Check to make sure the uninstall file is triggered properly
if(!defined('WP_UNINSTALL_PLUGIN')) {
  die;
}

// //Clear database of stored data
// $books = get_posts(array('post_type' => 'book', 'numberposts' => -1));

// foreach($books as $book) {
//   wp_delete_post($book->ID, true);
// }

// Access the database via SQL (with great power comes great responsibility!)
// Faster, but more dangerous!
global $wpdb;
$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'book'");
// Remove any other data with ID related to a deleted post
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");