<?php
/**
 * @package BeckiPlugin
 */

/*
Plugin Name: BeckiPlugin
Description: This is my first attempt at writing a custom plugin
Version: 1.0.0
Author: beckibloom
Text Domain: beckiplugin

*/

// This version is for personal use only and therefore does not include any licensing details

defined('ABSPATH') or die('I am not the file you are looking for.');

include('shortcode_userip.php' );

class BeckiPlugin 
{
  function __construct() {
    add_action('init', array($this , 'custom_post_type'));
  }

  function register() {
    // display this post type among standard posts so they are easily visible on front end
    add_action('pre_get_posts', array($this, 'add_my_post_types_to_query'));
  }

  function activate() {
    $this->custom_post_type();
    flush_rewrite_rules();
  }

  function deactivate() {
    flush_rewrite_rules();
  }

  function custom_post_type() {
    register_post_type('review', ['public' => true, 'label' => 'Reviews']);
  }

  function add_my_post_types_to_query($query) {
    if (is_home() && $query->is_main_query()) {
      $query->set('post_type' , array('post' ,'review'));
      return $query;
    }
  }
}

if ( class_exists('BeckiPlugin')) {
  $beckiPlugin = new BeckiPlugin();
  $beckiPlugin->register();
}

register_activation_hook(__FILE__, array($beckiPlugin, 'activate'));

register_deactivation_hook(__FILE__, array($beckiPlugin, 'deactivate'));