<?php

/**
 * Config
 */


// Auto update.
const WP_CORE_AUTO_UPDATE = true;
const WP_PLUGIN_AUTO_UPDATE = true;


// Redirect to this url, if index.php is empty.
const INDEX_REDIRECT = '/';


// Set Include path.
const INC_PATH = 'inc/';


// Set admin menu label.
const ADMIN_POST_MENU_LABEL = 'お知らせ';
const ADMIN_PAGE_MENU_LABEL = 'ページ';


// Set custom post type.
const CUSTOM_POST_TYPE = [
  ['type' => 'test', 'label' => 'テスト'],
];
