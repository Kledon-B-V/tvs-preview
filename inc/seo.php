<?php
/**
 * SEO: meta tags, Open Graph, JSON-LD
 */

add_action('wp_head', function () {
  $page = function_exists('tvs_current_page') ? tvs_current_page() : '';
  $desc = (string) tvs_cfg('seo.descriptions.' . ($page ?: 'home'), '');
  $og_image = tvs_cfg('seo.og_image', '');

  // Google Search Console
  $gsc = tvs_cfg('seo.search_console_id', '');
  if ($gsc) {
    echo '<meta name="google-site-verification" content="' . esc_attr($gsc) . '">' . "\n";
  }

  // Meta description
  if ($desc) {
    echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
  }

  // Canonical
  if (function_exists('home_url')) {
    $canonical = is_front_page() ? home_url('/') : get_permalink();
    if ($canonical) {
      echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
    }
  }

  // hreflang
  if (function_exists('home_url')) {
    $url = is_front_page() ? home_url('/') : get_permalink();
    echo '<link rel="alternate" hreflang="nl" href="' . esc_url($url) . '">' . "\n";
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url($url) . '">' . "\n";
  }

  // Open Graph
  $title = wp_get_document_title();
  $og_url = is_front_page() ? home_url('/') : get_permalink();

  echo '<meta property="og:type" content="website">' . "\n";
  echo '<meta property="og:locale" content="nl_NL">' . "\n";
  echo '<meta property="og:site_name" content="' . esc_attr(tvs_cfg('company.full_name', 'TVS')) . '">' . "\n";
  echo '<meta property="og:url" content="' . esc_url($og_url) . '">' . "\n";
  echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
  if ($desc) {
    echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
  }
  if ($og_image) {
    echo '<meta property="og:image" content="' . esc_url(get_stylesheet_directory_uri() . '/' . $og_image) . '">' . "\n";
  }

  // Twitter Card
  echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
  echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
  if ($desc) {
    echo '<meta name="twitter:description" content="' . esc_attr($desc) . '">' . "\n";
  }
}, 1);

/**
 * JSON-LD: Organization + LocalBusiness
 */
add_action('wp_head', function () {
  if (!is_front_page()) return;

  $company = tvs_cfg('company.legal_name', 'TVS');
  $email   = tvs_cfg('contact.email', '');
  $phone   = tvs_cfg('contact.phone', '');
  $address = tvs_cfg('contact.address', '');
  $zip     = tvs_cfg('contact.zipcode', '');
  $city    = tvs_cfg('contact.city', '');
  $kvk     = tvs_cfg('company.kvk', '');

  $schema = [
    '@context'    => 'https://schema.org',
    '@type'       => 'LocalBusiness',
    'name'        => $company,
    'url'         => home_url('/'),
    'description' => tvs_cfg('seo.descriptions.home', ''),
    'email'       => $email,
    'telephone'   => $phone,
    'address'     => [
      '@type'           => 'PostalAddress',
      'streetAddress'   => $address,
      'postalCode'      => $zip,
      'addressLocality' => $city,
      'addressCountry'  => 'NL',
    ],
    'areaServed'  => [
      ['@type' => 'Country', 'name' => 'NL'],
      ['@type' => 'Country', 'name' => 'BE'],
    ],
    'hasOfferCatalog' => [
      '@type' => 'OfferCatalog',
      'name'  => 'Verwarmingsoplossingen',
      'itemListElement' => [
        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Terrasverwarming']],
        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Halverwarming']],
        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Kerkverwarming']],
      ],
    ],
  ];

  if ($kvk) {
    $schema['identifier'] = [
      '@type'  => 'PropertyValue',
      'name'   => 'KvK',
      'value'  => $kvk,
    ];
  }

  echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}, 5);

/**
 * GA4 (consent-aware, loaded via cookie consent)
 */
add_action('wp_head', function () {
  $ga4 = tvs_cfg('seo.ga4_id', '');
  if (!$ga4) return;

  ?>
  <script>
  window.TVS_GA4_ID = <?php echo wp_json_encode($ga4); ?>;
  function tvs_load_ga4() {
    if (window._ga4_loaded) return;
    window._ga4_loaded = true;
    var s = document.createElement('script');
    s.src = 'https://www.googletagmanager.com/gtag/js?id=' + window.TVS_GA4_ID;
    s.async = true;
    document.head.appendChild(s);
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', window.TVS_GA4_ID, { anonymize_ip: true });
  }
  </script>
  <?php
}, 2);
