<?php
/**
 * Theme setup
 */

add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('menus');
  add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

  register_nav_menus([
    'primary' => 'Hoofdmenu',
    'footer'  => 'Footer menu',
  ]);

  // Product thumbnail sizes
  add_image_size('product-card', 600, 400, true);
  add_image_size('product-large', 1200, 800, true);
  add_image_size('hero-bg', 1920, 1080, true);
});

// Verwijder WordPress emoji CSS/JS
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Bepaal huidige pagina context
 */
if (!function_exists('tvs_current_page')) {
  function tvs_current_page() {
    if (function_exists('is_front_page') && is_front_page()) {
      return 'home';
    }
    if (function_exists('is_page')) {
      if (is_page('producten')) return 'producten';
      if (is_page('over-ons')) return 'over-ons';
      if (is_page('contact')) return 'contact';
    }
    if (function_exists('is_post_type_archive') && is_post_type_archive('tvs_product')) {
      return 'producten';
    }
    if (function_exists('is_singular') && is_singular('tvs_product')) {
      return 'product';
    }
    return '';
  }
}

// Body classes
add_filter('body_class', function ($classes) {
  $page = tvs_current_page();
  if ($page) {
    $classes[] = 'tvs-page-' . sanitize_html_class($page);
  }
  return $classes;
});

/**
 * Fallback menu
 */
if (!function_exists('tvs_nav_fallback')) {
  function tvs_nav_fallback($args) {
    $items = '';
    $items .= '<li class="menu-item"><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    $items .= '<li class="menu-item"><a href="' . esc_url(home_url('/producten/')) . '">Producten</a></li>';
    $items .= '<li class="menu-item"><a href="' . esc_url(home_url('/over-ons/')) . '">Over Ons</a></li>';
    $items .= '<li class="menu-item"><a href="' . esc_url(home_url('/contact/')) . '">Contact</a></li>';
    $items .= '<li class="menu-item menu-item--cta"><a class="btn btn-primary" href="' . esc_url(home_url('/contact/')) . '">Offerte Aanvragen</a></li>';

    echo '<ul class="' . esc_attr($args['menu_class']) . '">' . $items . '</ul>';
  }
}

/**
 * Primary nav renderer
 */
if (!function_exists('tvs_render_primary_nav')) {
  function tvs_render_primary_nav() {
    $current = tvs_current_page();

    echo '<nav class="menu hidden lg:flex items-center gap-1" aria-label="Primary"><ul class="menu-items flex items-center gap-1 list-none m-0 p-0">';

    $links = [
      ['url' => home_url('/'), 'label' => 'Home', 'key' => 'home'],
      ['url' => home_url('/producten/'), 'label' => 'Producten', 'key' => 'producten'],
      ['url' => home_url('/over-ons/'), 'label' => 'Over Ons', 'key' => 'over-ons'],
      ['url' => home_url('/contact/'), 'label' => 'Contact', 'key' => 'contact'],
    ];

    foreach ($links as $link) {
      $active_cls = ($current === $link['key'])
        ? ' dark:text-white text-gray-900 dark:bg-white/5 bg-black/5 dark:border-white/10 border-gray-200'
        : ' dark:text-gray-400 text-gray-600 dark:hover:text-white hover:text-gray-900';
      echo '<li class="menu-item"><a class="relative px-5 py-2.5 rounded-xl font-semibold transition-all duration-300 no-underline' . $active_cls . '" href="' . esc_url($link['url']) . '">' . esc_html($link['label']) . '</a></li>';
    }

    echo '<li class="menu-item menu-item--cta ml-2"><div class="relative group"><div class="absolute -inset-0.5 bg-gradient-to-r from-red-500 to-orange-600 rounded-xl opacity-75 group-hover:opacity-100 blur transition duration-300"></div><a class="relative block bg-gradient-to-r from-red-500 to-orange-600 px-6 py-2.5 rounded-xl text-white font-bold no-underline" href="' . esc_url(home_url('/contact/')) . '">Offerte Aanvragen</a></div></li>';
    echo '</ul></nav>';
  }
}

/**
 * Self-healing: zorg dat de slug-pages bestaan
 */
add_action('init', function () {
  $flag = (int) get_option('tvs_pages_bootstrapped_v1', 0);
  if ($flag === 1) return;

  $pages = [
    'producten' => 'Producten',
    'over-ons'  => 'Over Ons',
    'contact'   => 'Contact',
  ];

  $changed = false;
  foreach ($pages as $slug => $title) {
    $existing = get_page_by_path($slug);
    if (!$existing) {
      $new_id = wp_insert_post([
        'post_type'    => 'page',
        'post_status'  => 'publish',
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_content' => '',
      ], true);
      if (!is_wp_error($new_id)) {
        $changed = true;
      }
    }
  }

  update_option('tvs_pages_bootstrapped_v1', 1, true);

  if ($changed && function_exists('flush_rewrite_rules')) {
    flush_rewrite_rules(false);
  }
}, 30);
