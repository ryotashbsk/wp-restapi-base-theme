<?php
/**
 * Remove default response
 */
function remove_default_responce($response, $post, $request) {
  unset($response->data['author']);
  unset($response->data['featured_media']);
  unset($response->data['date_gmt']);
  unset($response->data['modified']);
  unset($response->data['modified_gmt']);
  // unset($response->data['slug']);
  unset($response->data['status']);
  unset($response->data['type']);
  unset($response->data['content']);
  unset($response->data['excerpt']);
  unset($response->data['comment_status']);
  unset($response->data['ping_status']);
  unset($response->data['sticky']);
  unset($response->data['template']);
  unset($response->data['format']);
  unset($response->data['meta']);
  unset($response->data['tags']);
  unset($response->data['guid']);
  unset($response->data['group_en']);

  $response->remove_link('predecessor-version');
  $response->remove_link('collection');
  $response->remove_link('self');
  $response->remove_link('about');
  $response->remove_link('author');
  $response->remove_link('replies');
  $response->remove_link('version-history');
  $response->remove_link('https://api.w.org/featuredmedia');
  $response->remove_link('https://api.w.org/attachment');
  $response->remove_link('https://api.w.org/term');
  $response->remove_link('curies');

  return $response;
}
add_filter('rest_prepare_post', 'remove_rest_api_default_responce', 10, 3);


/**
 * Disable user query
 */
function disable_users_query(){
  if( preg_match('/wp\/v2\/users/i', $_SERVER['REQUEST_URI']) || preg_match('/wp\/v2\/users/i', $_SERVER['QUERY_STRING'])){
    wp_safe_redirect(home_url('/'), 301);
    exit;
  }
}
add_action('init', 'disable_users_query');


/**
 * Set max per_page
 */
function set_max_per_page($params) {
  if(isset( $params['per_page'])) {
    $params['per_page']['maximum'] = 500;
  }
  return $params;
}
add_filter('rest_post_collection_params', 'set_max_per_page', 10, 1);


/**
 * Set rest cache
 */
require_once ABSPATH . 'wp-admin/includes/plugin.php';
if ( is_plugin_active( 'wp-rest-cache/wp-rest-cache.php' ) ) {
  include_once WP_PLUGIN_DIR . '/wp-rest-cache/wp-rest-cache.php';
  $wp_rest_cache_api = new \WP_Rest_Cache_Plugin\Includes\API\Endpoint_Api();
  $wp_rest_cache_api->get_api_cache();
}


