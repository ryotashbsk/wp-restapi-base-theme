<?php
// get_api_list
function get_api($title, $type, $param, $acf = false)
{
  $url = '';
  $endpoint_default = 'wp-json/wp/v2/';
  $endpoint_acf = 'wp-json/acf/v3/';

  if ($param) {
    if ($acf !== false) {
      $url .= esc_url(home_url('/')) . $endpoint_acf . $type . '/?' . $param;
    } else {
      $url .= esc_url(home_url('/')) . $endpoint_default . $type . '/?' . $param;
    }
  } else {
    if ($acf !== false) {
      $url .= esc_url(home_url('/')) . $endpoint_acf . $type . '/';
    } else {
      $url .= esc_url(home_url('/')) . $endpoint_default . $type . '/';
    }
  }
  echo '
    <li>
      <h3 class="title">' . $title . '</h3>
      <a href="' . $url . '" target="_blank" class="link"> ' . $url . ' </a>
    </li>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?php the_title(); ?> | <?php bloginfo('name'); ?></title>
  <link rel='stylesheet' href='<?php echo $get_template_assets_dir ?>css/reset.css'>
  <link rel='stylesheet' href='<?php echo $get_template_assets_dir ?>css/style.css'>
</head>

<body class="page-list">
  <main>
    <div class="contents">
      <h1><?php the_title() ?></h1>
      <div class="page-list-item">
        <h2 class="heading">API</h2>
        <ul class="list">
          <?php
          get_api('SAMPLE', 'pages', 'slug[]=sample', true);
          get_api('NEWS', 'posts', '');
          ?>
        </ul>
      </div>
    </div>
  </main>
</body>

</html>