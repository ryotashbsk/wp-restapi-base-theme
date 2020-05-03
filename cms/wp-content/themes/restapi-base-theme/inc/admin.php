<?php
/**
 * Custom admin menu.
 */
function add_custom_admin_menu(){
  $cms_root = esc_url(home_url('/'));
  add_menu_page('', 'URLリスト', 'manage_options', $cms_root . '/list/', '', '', '6');
}
// add_action('admin_menu', 'add_custom_admin_menu');


/**
 * Custom post menu label.
 */
$post_label = ADMIN_POST_MENU_LABEL;

if($post_label){
  function custom_post_menu_label($labels) {
    global $post_label;
    foreach ($labels as $key => $value) {
      $labels->$key = str_replace('投稿', $post_label, $value);
    }
    return $labels;
  }
  add_filter('post_type_labels_post', 'custom_post_menu_label');
}


/**
 * Custom page menu label.
 */
$page_label = ADMIN_PAGE_MENU_LABEL;

if($page_label){
  function custom_page_menu_label($labels) {
    global $page_label;
    foreach ($labels as $key => $value) {
      $labels->$key = str_replace('固定ページ', $page_label, $value);
    }
    return $labels;
  }
  add_filter('post_type_labels_page', 'custom_page_menu_label');
}


/**
 * Disable post tags.
 */
function disable_post_tags(){
  global $wp_taxonomies;
  if(!empty($wp_taxonomies['post_tag']->object_type)){
    foreach ($wp_taxonomies['post_tag']->object_type as $i => $object_type) {
      if($object_type == 'post'){
        unset($wp_taxonomies['post_tag']->object_type[$i]);
      }
    }
  }
  return true;
}
add_action('init', 'disable_post_tags');
