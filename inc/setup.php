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
      if (is_page('producten'))     return 'producten';
      if (is_page('verwarming'))    return 'verwarming';
      if (is_page('verduurzaming')) return 'verduurzaming';
      if (is_page('over-ons'))      return 'over-ons';
      if (is_page('contact'))       return 'contact';
    }
    if (function_exists('is_post_type_archive') && is_post_type_archive('tvs_product')) {
      return 'producten';
    }
    if (function_exists('is_singular') && is_singular('tvs_product')) {
      return 'product';
    }
    if (function_exists('is_singular') && is_singular('tvs_dienst')) {
      return 'verduurzaming';
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
    $items .= '<li class="menu-item"><a href="' . esc_url(home_url('/verwarming/')) . '">Verwarming</a></li>';
    $items .= '<li class="menu-item"><a href="' . esc_url(home_url('/over-ons/')) . '">Over Ons</a></li>';
    $items .= '<li class="menu-item"><a href="' . esc_url(home_url('/contact/')) . '">Contact</a></li>';
    $items .= '<li class="menu-item menu-item--cta"><a class="btn btn-primary" href="' . esc_url(home_url('/contact/')) . '">Offerte Aanvragen</a></li>';

    echo '<ul class="' . esc_attr($args['menu_class']) . '">' . $items . '</ul>';
  }
}

/**
 * Primary nav renderer — desktop + mobile with branch dropdowns
 */
if (!function_exists('tvs_render_primary_nav')) {
  function tvs_render_primary_nav() {
    $current = tvs_current_page();
    $home    = esc_url(home_url('/'));
    $verw    = esc_url(home_url('/verwarming/'));
    $verd    = esc_url(home_url('/verduurzaming/'));
    $over    = esc_url(home_url('/over-ons/'));
    $contact = esc_url(home_url('/contact/'));

    // Fetch categories for Verwarming dropdown
    $cats = get_terms([
      'taxonomy'   => 'product_categorie',
      'hide_empty' => false,
      'orderby'    => 'name',
      'order'      => 'ASC',
    ]);
    if (is_wp_error($cats)) $cats = [];

    // Fetch diensten for Verduurzaming dropdown (conditional)
    $verduurzaming_branch = tvs_cfg('branches.verduurzaming');
    $show_verduurzaming   = $verduurzaming_branch && !empty($verduurzaming_branch['enabled']);
    $diensten = [];
    if ($show_verduurzaming) {
      $diensten = get_posts([
        'post_type'      => 'tvs_dienst',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
      ]);
    }

    // Active class helpers
    $active_cls = function ($key) use ($current) {
      return ($current === $key)
        ? ' dark:text-white text-gray-900 dark:bg-white/5 bg-black/5 dark:border-white/10 border-gray-200'
        : ' dark:text-gray-400 text-gray-600 dark:hover:text-white hover:text-gray-900';
    };

    $link_cls = 'relative px-5 py-2.5 rounded-xl font-semibold transition-all duration-300 no-underline';

    // Dropdown inline styles
    ?>
    <style>
    /* === Nav dropdown (CSS hover) === */
    .tvs-dropdown { position: relative; }
    .tvs-dropdown__panel {
      position: absolute; top: 100%; left: 50%; transform: translateX(-50%) translateY(8px);
      min-width: 240px; padding: .75rem 0; border-radius: .75rem;
      background: var(--bg-card, #fff); border: 1px solid var(--border, #e5e7eb);
      box-shadow: 0 12px 32px rgba(0,0,0,.12);
      opacity: 0; visibility: hidden; pointer-events: none;
      transition: opacity .2s, transform .2s, visibility .2s;
      z-index: 100;
    }
    html.dark .tvs-dropdown__panel {
      background: #111; border-color: rgba(255,255,255,.1);
      box-shadow: 0 12px 32px rgba(0,0,0,.4);
    }
    .tvs-dropdown:hover .tvs-dropdown__panel,
    .tvs-dropdown:focus-within .tvs-dropdown__panel {
      opacity: 1; visibility: visible; pointer-events: auto;
      transform: translateX(-50%) translateY(0);
    }
    .tvs-dropdown__panel--red { border-top: 2px solid #E31E24; }
    .tvs-dropdown__panel--green { border-top: 2px solid #22c55e; }
    .tvs-dropdown__link {
      display: flex; align-items: center; gap: .5rem;
      padding: .5rem 1.25rem; font-size: .875rem; font-weight: 500;
      color: var(--text-secondary, #4b5563); text-decoration: none;
      transition: all .15s;
    }
    .tvs-dropdown__link:hover {
      color: var(--text, #111); background: var(--bg-card-hover, #f3f4f6);
    }
    html.dark .tvs-dropdown__link { color: #9ca3af; }
    html.dark .tvs-dropdown__link:hover { color: #fff; background: rgba(255,255,255,.05); }
    .tvs-dropdown__link svg { width: 16px; height: 16px; flex-shrink: 0; opacity: .5; }
    .tvs-dropdown__divider { height: 1px; margin: .5rem 1rem; background: var(--border, #e5e7eb); }
    html.dark .tvs-dropdown__divider { background: rgba(255,255,255,.1); }
    .tvs-dropdown__footer {
      display: flex; align-items: center; gap: .25rem;
      padding: .5rem 1.25rem; font-size: .8125rem; font-weight: 600;
      text-decoration: none; transition: all .15s;
    }
    .tvs-dropdown__footer--red { color: #E31E24; }
    .tvs-dropdown__footer--red:hover { color: #c51a20; }
    .tvs-dropdown__footer--green { color: #22c55e; }
    .tvs-dropdown__footer--green:hover { color: #16a34a; }
    .tvs-dropdown__chevron { transition: transform .2s; }
    </style>
    <?php

    // === DESKTOP NAV ===
    echo '<nav class="menu hidden lg:flex items-center gap-1" aria-label="Primary"><ul class="menu-items flex items-center gap-1 list-none m-0 p-0">';

    // Home
    echo '<li class="menu-item"><a class="' . $link_cls . $active_cls('home') . '" href="' . $home . '">Home</a></li>';

    // Verwarming dropdown
    $verw_active = in_array($current, ['verwarming', 'producten', 'product']) ? $active_cls('verwarming') : $active_cls('');
    echo '<li class="menu-item tvs-dropdown">';
    echo '<a class="' . $link_cls . $verw_active . ' inline-flex items-center gap-1" href="' . $verw . '">';
    echo 'Verwarming';
    echo '<svg class="tvs-dropdown__chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>';
    echo '</a>';
    echo '<div class="tvs-dropdown__panel tvs-dropdown__panel--red">';
    if (!empty($cats)) {
      foreach ($cats as $cat) {
        $cat_url = esc_url(home_url('/producten/?categorie=' . $cat->slug));
        echo '<a class="tvs-dropdown__link" href="' . $cat_url . '">';
        echo '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2c.5 3.5-1 6-3 8.5C7 13 8.5 16 12 17c3.5-1 5-4 3-6.5C13 8 11.5 5.5 12 2z"/></svg>';
        echo esc_html($cat->name);
        echo '</a>';
      }
      echo '<div class="tvs-dropdown__divider"></div>';
    }
    echo '<a class="tvs-dropdown__footer tvs-dropdown__footer--red" href="' . $verw . '">Alle producten <span>&rarr;</span></a>';
    echo '</div>';
    echo '</li>';

    // Verduurzaming dropdown (conditional)
    if ($show_verduurzaming) {
      $verd_active = ($current === 'verduurzaming') ? $active_cls('verduurzaming') : $active_cls('');
      echo '<li class="menu-item tvs-dropdown">';
      echo '<a class="' . $link_cls . $verd_active . ' inline-flex items-center gap-1" href="' . $verd . '">';
      echo 'Verduurzaming';
      echo '<svg class="tvs-dropdown__chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>';
      echo '</a>';
      echo '<div class="tvs-dropdown__panel tvs-dropdown__panel--green">';
      if (!empty($diensten)) {
        foreach ($diensten as $dienst) {
          $dienst_url = esc_url(get_permalink($dienst->ID));
          echo '<a class="tvs-dropdown__link" href="' . $dienst_url . '">';
          echo '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"/></svg>';
          echo esc_html($dienst->post_title);
          echo '</a>';
        }
        echo '<div class="tvs-dropdown__divider"></div>';
      }
      echo '<a class="tvs-dropdown__footer tvs-dropdown__footer--green" href="' . $verd . '">Meer over verduurzaming <span>&rarr;</span></a>';
      echo '</div>';
      echo '</li>';
    }

    // Over Ons
    echo '<li class="menu-item"><a class="' . $link_cls . $active_cls('over-ons') . '" href="' . $over . '">Over Ons</a></li>';

    // Contact
    echo '<li class="menu-item"><a class="' . $link_cls . $active_cls('contact') . '" href="' . $contact . '">Contact</a></li>';

    // CTA
    echo '<li class="menu-item menu-item--cta ml-2"><div class="relative group"><div class="absolute -inset-0.5 bg-gradient-to-r from-red-500 to-orange-600 rounded-xl opacity-75 group-hover:opacity-100 blur transition duration-300"></div><a class="relative block bg-gradient-to-r from-red-500 to-orange-600 px-6 py-2.5 rounded-xl text-white font-bold no-underline" href="' . $contact . '">Offerte Aanvragen</a></div></li>';
    echo '</ul></nav>';

    // === MOBILE MENU ===
    $m_active = function ($key) use ($current) {
      return $current === $key ? ' mobile-link--active' : '';
    };
    ?>
    <div class="mobile-menu" id="mobile-menu">
      <div class="mobile-menu-inner">
        <a href="<?php echo $home; ?>" class="mobile-link<?php echo $m_active('home'); ?>">Home</a>

        <!-- Verwarming accordion -->
        <div class="mobile-accordion">
          <button class="mobile-link mobile-accordion-btn<?php echo in_array($current, ['verwarming', 'producten', 'product']) ? ' mobile-link--active' : ''; ?>" onclick="this.parentElement.classList.toggle('open')">
            Verwarming
            <svg class="mobile-chevron" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          <div class="mobile-accordion-content">
            <?php if (!empty($cats)) : ?>
              <?php foreach ($cats as $cat) : ?>
                <a href="<?php echo esc_url(home_url('/producten/?categorie=' . $cat->slug)); ?>"><?php echo esc_html($cat->name); ?></a>
              <?php endforeach; ?>
            <?php endif; ?>
            <a href="<?php echo $verw; ?>" style="font-weight:600; color: #E31E24;">Alle producten &rarr;</a>
          </div>
        </div>

        <?php if ($show_verduurzaming) : ?>
        <!-- Verduurzaming accordion -->
        <div class="mobile-accordion">
          <button class="mobile-link mobile-accordion-btn<?php echo $m_active('verduurzaming'); ?>" onclick="this.parentElement.classList.toggle('open')">
            Verduurzaming
            <svg class="mobile-chevron" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          <div class="mobile-accordion-content">
            <?php if (!empty($diensten)) : ?>
              <?php foreach ($diensten as $dienst) : ?>
                <a href="<?php echo esc_url(get_permalink($dienst->ID)); ?>"><?php echo esc_html($dienst->post_title); ?></a>
              <?php endforeach; ?>
            <?php endif; ?>
            <a href="<?php echo $verd; ?>" style="font-weight:600; color: #22c55e;">Meer over verduurzaming &rarr;</a>
          </div>
        </div>
        <?php endif; ?>

        <a href="<?php echo $over; ?>" class="mobile-link<?php echo $m_active('over-ons'); ?>">Over Ons</a>
        <a href="<?php echo $contact; ?>" class="mobile-link<?php echo $m_active('contact'); ?>">Contact</a>
        <a href="<?php echo $contact; ?>" class="mobile-cta">Offerte Aanvragen</a>
      </div>
    </div>
    <?php
  }
}

/**
 * Self-healing: zorg dat de slug-pages bestaan
 */
add_action('init', function () {
  $flag = (int) get_option('tvs_pages_bootstrapped_v2', 0);
  if ($flag === 1) return;

  $pages = [
    'producten'     => 'Producten',
    'verwarming'    => 'Verwarming',
    'verduurzaming' => 'Verduurzaming',
    'over-ons'      => 'Over Ons',
    'contact'       => 'Contact',
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

  update_option('tvs_pages_bootstrapped_v2', 1, true);

  if ($changed && function_exists('flush_rewrite_rules')) {
    flush_rewrite_rules(false);
  }
}, 30);
