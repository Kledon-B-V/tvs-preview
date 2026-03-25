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

// ===== BRANCH HELPERS =====

/**
 * Get a specific branch config by slug
 */
if (!function_exists('tvs_get_branch')) {
  function tvs_get_branch($slug) {
    return tvs_cfg('branches.' . $slug, null);
  }
}

/**
 * Get all active/visible branches (respects enabled toggle)
 */
if (!function_exists('tvs_get_active_branches')) {
  function tvs_get_active_branches() {
    $branches = tvs_cfg('branches', []);
    return array_filter($branches, function ($b) {
      return !empty($b['enabled']);
    });
  }
}

/**
 * Detect which branch the current page belongs to
 */
if (!function_exists('tvs_current_branch')) {
  function tvs_current_branch() {
    if (function_exists('is_singular')) {
      if (is_singular('tvs_product') || is_post_type_archive('tvs_product') || is_tax('product_categorie') || is_tax('product_merk')) {
        return 'verwarming';
      }
      if (is_singular('tvs_dienst') || is_post_type_archive('tvs_dienst') || is_tax('dienst_categorie')) {
        return 'verduurzaming';
      }
    }
    if (function_exists('is_page')) {
      if (is_page('verwarming') || is_page('producten')) return 'verwarming';
      if (is_page('verduurzaming')) return 'verduurzaming';
    }
    if (function_exists('is_page') && is_page('contact') && isset($_GET['branch'])) {
      $requested = sanitize_key($_GET['branch']);
      if (tvs_cfg('branches.' . $requested)) return $requested;
    }
    return '';
  }
}

/**
 * Get branch color
 */
if (!function_exists('tvs_branch_color')) {
  function tvs_branch_color($property = 'color_primary', $branch = null) {
    $branch = $branch ?: tvs_current_branch() ?: 'verwarming';
    return tvs_cfg('branches.' . $branch . '.' . $property, '#E31E24');
  }
}

/**
 * Get Tailwind gradient classes for a branch
 */
if (!function_exists('tvs_branch_gradient')) {
  function tvs_branch_gradient($branch = null) {
    $branch = $branch ?: tvs_current_branch() ?: 'verwarming';
    return tvs_cfg('branches.' . $branch . '.color_gradient', 'from-red-600 to-orange-500');
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
  __DIR__ . '/inc/seed-products.php',
];

foreach ($tvs_includes as $file) {
  if (file_exists($file)) {
    require_once $file;
  }
}
