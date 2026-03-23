<?php
/**
 * Assets (CSS/JS) + performance hints
 */

add_action('wp_enqueue_scripts', function () {
  // Fonts: Inter
  wp_enqueue_style(
    'tvs-fonts',
    'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap',
    [],
    null
  );

  // CSS cache-bust
  $css_path = get_stylesheet_directory() . '/style.css';
  $css_ver  = file_exists($css_path) ? (string) filemtime($css_path) : '1.0';

  wp_enqueue_style(
    'tvs-style',
    get_stylesheet_uri(),
    ['tvs-fonts'],
    $css_ver
  );

  // Site layer
  $site_rel  = '/assets/css/site.css';
  $site_path = get_stylesheet_directory() . $site_rel;
  $site_url  = get_stylesheet_directory_uri() . $site_rel;
  $site_ver  = file_exists($site_path) ? (string) filemtime($site_path) : $css_ver;

  wp_enqueue_style(
    'tvs-site',
    $site_url,
    ['tvs-style'],
    $site_ver
  );

  // JS (1 file, defer)
  $js_rel  = '/assets/js/tvs.js';
  $js_path = get_stylesheet_directory() . $js_rel;
  $js_url  = get_stylesheet_directory_uri() . $js_rel;
  $js_ver  = file_exists($js_path) ? (string) filemtime($js_path) : '1.0';

  wp_enqueue_script(
    'tvs-app',
    $js_url,
    [],
    $js_ver,
    true
  );

  $config = [
    'restUrl' => esc_url_raw(rest_url()),
    'homeUrl' => esc_url_raw(home_url('/')),
    'ajaxUrl' => esc_url_raw(admin_url('admin-ajax.php')),
    'nonce'   => wp_create_nonce('tvs_contact_nonce'),
  ];

  wp_add_inline_script(
    'tvs-app',
    'window.TVS=' . wp_json_encode($config) . ';',
    'before'
  );
});

// Defer script
add_filter('script_loader_tag', function ($tag, $handle, $src) {
  if ($handle !== 'tvs-app') {
    return $tag;
  }
  return '<script src="' . esc_url($src) . '" defer></script>';
}, 10, 3);

// Preconnect for fonts
add_filter('wp_resource_hints', function ($hints, $relation_type) {
  if ($relation_type !== 'preconnect') {
    return $hints;
  }
  $hints[] = 'https://fonts.googleapis.com';
  $hints[] = [
    'href'        => 'https://fonts.gstatic.com',
    'crossorigin' => 'anonymous',
  ];
  return $hints;
}, 10, 2);

// Font preload
add_action('wp_head', function () {
  echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" as="style">' . "\n";
}, 1);

/**
 * Dequeue WordPress block/global CSS
 */
add_action('wp_enqueue_scripts', function () {
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('classic-theme-styles');
  wp_dequeue_style('global-styles');
  wp_deregister_style('global-styles');
}, 100);

add_action('wp_footer', function () {
  wp_dequeue_style('global-styles');
}, 1);
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

add_filter('wp_img_tag_add_auto_sizes', '__return_false');
