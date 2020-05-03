<?php
/**
 * Thumbnail settings.
 */
function post_thumbnail(){
  return the_post_thumbnail('default_thumbnail');
}

$img_size = [
  'thumb' => [100, 100, true],
];

foreach($img_size as $key => $value){
  add_image_size($key , $value[0] , $value[1] , $value[2]);
}

add_theme_support('post-thumbnails');
add_filter('jpeg_quality', function($arg){ return 100;});

function media_settings_by_post_type( $sizes ) {
  $type = get_post_type($_REQUEST['post_id']);
  foreach($sizes as $key => $value){
    if($type=='post' && $value != 'thumb') {
      unset($sizes[$key]);
    }
  }
  return $sizes;
}
add_action( 'intermediate_image_sizes', 'media_settings_by_post_type' );


/**
 * Sanitize image file.
 */
function rename_file_md5($fileName){
  $i = strrpos($fileName, '.');
  if($i) $Exts = '.'.substr($fileName, $i + 1);
  else $Exts = '';
  $fileName = md5(time().$fileName).$Exts;
  return strtolower($fileName);
}
add_filter('sanitize_file_name', 'rename_file_md5', 10);


/**
 * Remove default image attribute.
 */
function remove_image_attribute($html){
  $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
  $html = preg_replace('/class=[\'"]([^\'"]+)[\'"]/i', '', $html);
  return $html;
}
function strip_empty_classes($menu) {
  $menu = preg_replace('/ class=(["\'])(?!on).*?\1/','',$menu);
  return $menu;
}
add_filter('image_send_to_editor', 'remove_image_attribute', 10);
add_filter('post_thumbnail_html', 'remove_image_attribute', 10);
add_filter('wp_calculate_image_srcset', '__return_false');


/**
 * Disable image sizes.
 */

function disable_image_sizes( $new_sizes ) {
  // unset($new_sizes['thumbnail']);
  unset($new_sizes['medium']);
  unset($new_sizes['large']);
  // unset($new_sizes['medium_large']);
  // unset($new_sizes['1536x1536']);
  // unset($new_sizes['2048x2048']);
  return $new_sizes;
}
add_filter('intermediate_image_sizes_advanced', 'disable_image_sizes');
add_filter('big_image_size_threshold', '__return_false');