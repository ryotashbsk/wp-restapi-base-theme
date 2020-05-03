<?php
/**
 * Register custom post type.
 */
function register_cpt($cpt, $label){
  register_post_type(
    $cpt, [
      'labels' => [
        'name' => __($label),
        'singular_name' => __($label),
        'edit_item'     => __($label . 'の編集'),
        'add_new_item'  => __($label . 'の新規作成')
      ],
      'public'               => true,
      'show_ui'              => true,
      'show_in_menu'         => true,
      'has_archive'          => false,
      'show_in_rest'         => true,
      'menu_position'        => 5,
      'exclude_from_search'  => true,
      'query_var'            => true,
      'capability_type'      => 'post'
    ]
  );
}

function add_custom_post_type(){
  foreach(CUSTOM_POST_TYPE as $data){
    register_cpt($data['type'], $data['label']);
  }
}
add_action('init', 'add_custom_post_type');


/**
 * Change custom post order in admin.
 */
function set_post_types_admin_order($wp_query){
  if(is_admin()){
    $post_type = $wp_query->query['post_type'];
    if($post_type == 'shop'){
      $wp_query->set('orderby','date');
      $wp_query->set('order','DESC');
    }
  }
}
// add_filter('pre_get_posts', 'set_post_types_admin_order');
