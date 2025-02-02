<?php

/**
 * Plugin Name: Museable Components Plugin
 * Description: A plugin consists of museable components, using Blocks.
 * Version: 0.0.1
 * Author: Van Alfred Sabacajan
 * Author URI: https://github.com/vanskins/wp-museable-components
 * License: GPL2
 * Text Domain: museable-components
 * Domain Path: /languages
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

register_activation_hook(__FILE__, 'custom_table_create');


// Load the text domain for translations.
function museable_components_plugin_load_textdomain()
{
  // load_plugin_textdomain('museable-components', false, basename(dirname(__FILE__)) . '/languages');
  load_textdomain('museable-components', plugin_dir_path(__FILE__) . 'languages/museable-components-es_ES.mo');
}
add_action('init', 'museable_components_plugin_load_textdomain');

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

// Fetch rest api
add_action('rest_api_init', function () {
  register_rest_route('custom/v1', '/collections/', array(
    'methods' => 'GET',
    'callback' => 'get_collections',
  ));
});

function get_collections()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'collections';

  $results = $wpdb->get_results("SELECT * FROM $table_name");

  if (empty($results)) {
    return new WP_Error('no_collections', 'No collections found', array('status' => 404));
  }

  return rest_ensure_response($results);
}



// list of plugin build should be registered
function my_musable_components_index_register_block()
{
  register_block_type_from_metadata(__DIR__ . '/build/museable-title');
  register_block_type_from_metadata(__DIR__ . '/build/museable-cards', array(
    'render_callback' => 'render_collections_block',
  ));

  register_block_type_from_metadata(__DIR__ . '/build/museable-cards/block.json', array(
    'textdomain' => 'museable-components'
  ));
  register_block_type_from_metadata(__DIR__ . '/build/museable-title/block.json', array(
    'textdomain' => 'museable-components'
  ));
}

add_action('init', 'my_musable_components_index_register_block');


// Include the dynamic rendering function
require_once __DIR__ . '/includes/collections-render.php';

function enqueue_block_styles()
{
  // Enqueue frontend styles
  wp_enqueue_style(
    'your-plugin-style', // Handle
    plugins_url('src/museable-cards/style.css', __FILE__), // Path to your compiled CSS
    array(), // Dependencies
    filemtime(plugin_dir_path(__FILE__) . 'src/museable-cards/style.css') // Version based on file modification time
  );
}
add_action('enqueue_block_assets', 'enqueue_block_styles');
