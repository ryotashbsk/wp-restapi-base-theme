<?php
/**
 * Variables
 */
$get_template_dir = get_template_directory_uri();
$get_template_assets_dir = $get_template_dir . '/assets/';



/**
 * Init
 */
function init() {

  // Set auto update.
  if(WP_CORE_AUTO_UPDATE !== false){
    add_filter('allow_major_auto_core_updates', '__return_true');
  }
  if(WP_PLUGIN_AUTO_UPDATE !== false){
    add_filter('auto_update_plugin', '__return_true');
  }


  // Default settting.
  wp_deregister_style('wp-block-library');
  wp_deregister_style('wp-block-library-theme');

  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'rel_canonical');
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  remove_action('wp_head', 'wp_shortlink_wp_head');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('wp_head','rest_output_link_wp_head');
  remove_action('wp_head','wp_oembed_add_discovery_links');
  remove_action('wp_head','wp_oembed_add_host_js');
  remove_filter('pre_user_description', 'wp_filter_kses');
  remove_filter('the_content', 'wpautop');

  add_filter('wp_calculate_image_srcset', '__return_false');
  add_filter('use_block_editor_for_post', '__return_false');


  // Disable tool bar.
  add_filter('show_admin_bar', '__return_false');


  // Disable comment.
  add_filter('comments_open', '__return_false');


  // Disable dns prefetch.
  function disable_dns_prefetch($hints, $relation_type) {
    if('dns-prefetch' === $relation_type) {
      return array_diff(wp_dependencies_unique_hosts(), $hints);
    }
    return $hints;
  }
  add_filter('wp_resource_hints', 'disable_dns_prefetch', 10, 2);


  // Disable pinback.
  function disable_pingback($headers) {
    unset($headers['X-Pingback']);
    return $headers;
  }
  add_filter('wp_headers', 'disable_pingback');


  // Disable author.
  function disable_author_query(){
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
    $wp_rewrite->author_base = '';
    $wp_rewrite->author_structure = '/';

    if(isset($_REQUEST['author']) && !empty($_REQUEST['author'])) {
      $user_info = get_userdata(intval($_REQUEST['author']));
      if($user_info && array_key_exists('administrator', $user_info->caps) && in_array('administrator', $user_info->roles)) {
        wp_redirect('/');
        exit;
      }
    }
  }
  add_action('init', 'disable_author_query');


  // Disable visual edotor.
  function disable_visual_editor_mypost(){
   add_filter('user_can_richedit', 'disable_visual_editor_filter');
  }
  add_action('load-post.php', 'disable_visual_editor_mypost');
  function disable_visual_editor_filter(){
    return false;
  }
  add_action('load-post-new.php', 'disable_visual_editor_mypost');


  // Remove welocome panel.
  remove_action('welcome_panel', 'wp_welcome_panel');


  // Remove dashboard widget.
  function remove_dashboard_widget() {
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
  }
  add_action('wp_dashboard_setup', 'remove_dashboard_widget');


  // Remove default message from admin footer.
  function remove_admin_footer(){
   echo '&nbsp;';
  }
  add_filter('admin_footer_text', 'remove_admin_footer');


  // Remove default admin bar menu.
  function remove_admin_bar_menu($wp_admin_bar){
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('new-content');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('search');
  }
  add_action('admin_bar_menu', 'remove_admin_bar_menu', 9999);


  // Remove default admin column from post list.
  function remove_admin_post_column($columns){
    unset($columns['author']);
    unset($columns['comments']);
    return $columns;
  }
  add_filter('manage_posts_columns', 'remove_admin_post_column');


  // Remove default admin column from page list.
  function remove_admin_page_column($columns){
    unset($columns['author']);
    unset($columns['comments']);
    return $columns;
  }
  add_filter('manage_pages_columns', 'remove_admin_page_column');


  // Remove default admin menu.
  function remove_admin_menu() {
    if (!current_user_can('administrator')){
      // remove_menu_page('index.php');
      remove_menu_page('link-manager.php');
      remove_menu_page('themes.php');
      remove_menu_page('edit.php?post_type=acf-field-group');
      remove_menu_page('tools.php');
      remove_menu_page('profile.php');
      remove_menu_page('users.php');
      remove_menu_page('plugins.php');
      remove_menu_page('options-general.php');
    } else{
      // admin
    }
    remove_menu_page('edit-comments.php');
  }
  add_action('admin_menu', 'remove_admin_menu');


  // Set login enque.
  function set_login_enque(){
    global $get_template_assets_dir;
    wp_enqueue_style('style', $get_template_assets_dir . 'css/login.css', [], time(), 'all');
  }
  add_action('login_head', 'set_login_enque');


  // Set admin enque.
  function set_admin_enque(){
    global $get_template_assets_dir;
    wp_enqueue_style('style', $get_template_assets_dir . 'css/admin.css', [], time(), 'all');
    wp_enqueue_script('script', $get_template_assets_dir . 'js/admin.js', [], time(), true);
  }
  add_action('admin_print_styles', 'set_admin_enque');
}
add_action('after_setup_theme', 'init');
