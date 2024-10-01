<?php
function render_collections_block()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'collections';

  $collections = $wpdb->get_results("SELECT * FROM $table_name");
  $collection_items = __("Collection Items", "museable-components");
  if (empty($collections)) {
    return '<p>No collections found.</p>';
  }

  ob_start();

  echo '<div>';
  echo '<h1>' . esc_html($collection_items) . '</h1>';
  echo '<div class="custom-collections-block">';
  foreach ($collections as $collection) {
    echo '<div class="collection-card">';
    echo '<img src="' . esc_url($collection->image) . '" alt="' . esc_html($collection->title) . '">';
    echo '<div class="collection-card-body">';
    echo '<h3>' . esc_html($collection->title) . '</h3>';
    echo '<p>' . esc_html($collection->description) . '</p>';
    echo '</div>';
    echo '</div>';
  }
  echo '</div>';
  echo '</div>';

  return ob_get_clean();
}
