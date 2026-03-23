<?php
/**
 * TVS Theme — bootstrap
 *
 * Config: /inc/config.php
 * Doel: superlicht, geen build step, wel modulair en strak.
 */

if (!function_exists('tvs_config')) {
  function tvs_config() {
    static $cfg = null;
    if (is_array($cfg)) {
      return $cfg;
    }

    $path = __DIR__ . '/inc/config.php';
    $cfg = file_exists($path) ? require $path : [];

    if (!is_array($cfg)) {
      $cfg = [];
    }

    return $cfg;
  }
}

if (!function_exists('tvs_cfg')) {
  function tvs_cfg($key, $default = null) {
    $cfg = tvs_config();
    if (!$key) {
      return $cfg;
    }

    $parts = explode('.', (string) $key);
    $cur = $cfg;

    foreach ($parts as $p) {
      if (is_array($cur) && array_key_exists($p, $cur)) {
        $cur = $cur[$p];
      } else {
        return $default;
      }
    }

    return $cur;
  }
}

if (!function_exists('tvs_theme_file_url')) {
  function tvs_theme_file_url($filename) {
    $filename = trim((string) $filename);
    if ($filename === '') {
      return '';
    }

    $base = function_exists('get_stylesheet_directory_uri')
      ? trailingslashit(get_stylesheet_directory_uri())
      : '/wp-content/themes/TVS-Theme/';

    return $base . rawurlencode($filename);
  }
}

if (!function_exists('tvs_page_url')) {
  function tvs_page_url($slug, $fallback = '') {
    $slug = trim((string) $slug, "/ \t\n\r\0\x0B");
    if ($slug === '') {
      return (string) $fallback;
    }

    if (function_exists('get_page_by_path') && function_exists('get_permalink')) {
      $page = get_page_by_path($slug);
      if ($page && isset($page->ID)) {
        $url = get_permalink($page->ID);
        if ($url) {
          return $url;
        }
      }
    }

    if (function_exists('home_url')) {
      return home_url('/' . $slug . '/');
    }

    return (string) $fallback;
  }
}

$tvs_includes = [
  __DIR__ . '/inc/setup.php',
  __DIR__ . '/inc/assets.php',
  __DIR__ . '/inc/content-types.php',
  __DIR__ . '/inc/meta-boxes.php',
  __DIR__ . '/inc/contact.php',
  __DIR__ . '/inc/seo.php',
  __DIR__ . '/inc/cookie-consent.php',
];

foreach ($tvs_includes as $file) {
  if (file_exists($file)) {
    require_once $file;
  }
}
