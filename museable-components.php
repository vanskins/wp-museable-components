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

// list of plugin build should be registered
function my_musable_components_index_register_block()
{
  register_block_type_from_metadata(__DIR__ . '/build/museable-title');
}

add_action('init', 'my_musable_components_index_register_block');
