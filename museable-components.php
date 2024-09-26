<?php

/**
 * Plugin Name: Museable Components Plugin
 * Description: A plugin consists of museable components, using Blocks.
 * Version: 0.0.1
 * Author: Van Alfred Sabacajan
 * Author URI: https://github.com/vanskins/wp-museable-components
 * License: GPL2
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

register_activation_hook(__FILE__, 'custom_table_create');

function custom_table_create()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'collections';  // Define table name

  // Set charset
  $charset_collate = $wpdb->get_charset_collate();

  // SQL statement to create the table
  $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        title tinytext NOT NULL,
        description text NOT NULL,
        image varchar(255) DEFAULT '' NOT NULL,
        itemType varchar(50) DEFAULT '' NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

  // Include the WordPress upgrade library to run dbDelta()
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}

function insert_custom_items()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'collections';

  $wpdb->insert(
    $table_name,
    array(
      'title' => 'Ancient Wonders in Cathedral City',
      'description' => 'This is the first custom item.',
      'image' => 'https://kesq.b-cdn.net/2020/01/Screen-Shot-2020-01-06-at-2.05.25-PM-860x466.png',
      'itemType' => 'collection'
    )
  );

  $wpdb->insert(
    $table_name,
    array(
      'title' => 'Spurlock Museum',
      'description' => 'This is the second custom item.',
      'image' => 'https://www.spurlock.illinois.edu/img/collections/collections_hero_1920.jpg',
      'itemType' => 'collection'
    )
  );

  $wpdb->insert(
    $table_name,
    array(
      'title' => 'Korean Historical Artifacts',
      'description' => 'This is the second custom item.',
      'image' => 'https://www.korea.net/upload/content/editImage/New_Year_Press_Conference_Museum_03.jpg',
      'itemType' => 'collection'
    )
  );

  $wpdb->insert(
    $table_name,
    array(
      'title' => 'Sculptures 9000 AD',
      'description' => 'This is the second custom item.',
      'image' => 'https://media.istockphoto.com/id/459502395/photo/museum.jpg?s=612x612&w=0&k=20&c=zz27WgxL7cnM-10xDLqxAx77y03VMavcH5bZBtdLQfQ=',
      'itemType' => 'collection'
    )
  );
}

// Add the function to be called during plugin activation
register_activation_hook(__FILE__, 'insert_custom_items');


// list of plugin build should be registered
function my_musable_components_index_register_block()
{
  register_block_type_from_metadata(__DIR__ . '/build/museable-title');
}

add_action('init', 'my_musable_components_index_register_block');
