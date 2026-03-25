<?php
/**
 * TVS Product Seeder
 *
 * Maakt producten aan met de correcte categorieën, merken, type en afbeeldingen.
 * Draai eenmalig via: WP Admin > Hulpmiddelen > TVS Product Seeder
 *
 * Veilig om meerdere keren te draaien: controleert op bestaande producten via titel.
 */

if (!defined('ABSPATH')) exit;

/**
 * Admin menu pagina registreren
 */
add_action('admin_menu', function () {
  add_management_page(
    'TVS Product Seeder',
    'TVS Product Seeder',
    'manage_options',
    'tvs-seed-products',
    'tvs_seed_products_page'
  );
});

/**
 * Seed-pagina renderen
 */
function tvs_seed_products_page() {
  if (!current_user_can('manage_options')) {
    wp_die('Geen toegang.');
  }

  echo '<div class="wrap"><h1>TVS Product Seeder</h1>';

  if (isset($_POST['tvs_seed_run']) && wp_verify_nonce($_POST['_wpnonce'], 'tvs_seed_products')) {
    $result = tvs_run_product_seed();
    echo '<div class="notice notice-success"><p>' . esc_html($result) . '</p></div>';
  }

  // Toon huidige status
  $existing = new WP_Query(['post_type' => 'tvs_product', 'posts_per_page' => -1, 'fields' => 'ids']);
  $count = $existing->found_posts;

  echo '<p>Huidige producten in database: <strong>' . $count . '</strong></p>';
  echo '<form method="post">';
  wp_nonce_field('tvs_seed_products');
  echo '<input type="hidden" name="tvs_seed_run" value="1">';
  echo '<p><button type="submit" class="button button-primary">Producten importeren</button></p>';
  echo '<p class="description">Dit maakt producten aan op basis van de foto\'s in het theme. Bestaande producten met dezelfde titel worden overgeslagen.</p>';
  echo '</form></div>';
}

/**
 * Product seed-data
 */
function tvs_get_seed_products() {
  return [
    // === GOLDSUN ELITE — GAS ===
    [
      'title'       => 'Goldsun Finch',
      'description' => 'Stijlvolle Goldsun Finch gasverwarmer, ideaal voor terrassen. Krachtige warmteafgifte met een elegant design.',
      'image'       => 'products/goldsun-elite/finch-1.jpg',
      'gallery'     => ['products/goldsun-elite/finch-2.jpg'],
      'category'    => 'terrasverwarming',
      'brand'       => 'Goldsun',
      'type'        => 'Gas',
      'application' => 'Horeca',
    ],
    [
      'title'       => 'Goldsun Elite 5',
      'description' => 'De Goldsun Elite 5 is een hoogwaardige gas terrasverwarmer met uitstekende prestaties en modern design.',
      'image'       => 'products/goldsun-elite/goldsun-elite-5.jpg',
      'gallery'     => ['products/goldsun-elite/goldsun-elite-6.jpg', 'products/goldsun-elite/goldsun-elite-7.jpg'],
      'category'    => 'terrasverwarming',
      'brand'       => 'Goldsun',
      'type'        => 'Gas',
      'application' => 'Horeca',
    ],
    [
      'title'       => 'Goldsun 9',
      'description' => 'Goldsun model 9 gasverwarmer. Betrouwbare terrasverwarming voor professioneel gebruik.',
      'image'       => 'products/goldsun-elite/goldsun-9.jpg',
      'category'    => 'terrasverwarming',
      'brand'       => 'Goldsun',
      'type'        => 'Gas',
      'application' => 'Horeca',
    ],
    [
      'title'       => 'Goldsun 10',
      'description' => 'Goldsun model 10 gasverwarmer. Krachtige verwarming met breed bereik voor grotere terrassen.',
      'image'       => 'products/goldsun-elite/goldsun-10.jpg',
      'category'    => 'terrasverwarming',
      'brand'       => 'Goldsun',
      'type'        => 'Gas',
      'application' => 'Horeca',
    ],
    [
      'title'       => 'Goldsun 15',
      'description' => 'Goldsun model 15 gasverwarmer. Top-of-the-line verwarming voor veeleisende horeca-omgevingen.',
      'image'       => 'products/goldsun-elite/goldsun-15.jpg',
      'category'    => 'terrasverwarming',
      'brand'       => 'Goldsun',
      'type'        => 'Gas',
      'application' => 'Horeca',
    ],

    // === HLQ — ELEKTRISCH ===
    [
      'title'       => 'HLQ Elektrische Terrasverwarmer',
      'description' => 'Professionele HLQ elektrische terrasverwarmer. Efficiënte infrarood warmte zonder gasaansluiting.',
      'image'       => 'products/hlq-elektrisch/hlq-1.jpg',
      'gallery'     => ['products/hlq-elektrisch/hlq-7.jpg', 'products/hlq-elektrisch/hlq-rotterdam.jpg'],
      'category'    => 'terrasverwarming',
      'brand'       => 'HLQ',
      'type'        => 'Elektrisch',
      'application' => 'Horeca',
    ],
    [
      'title'       => 'HLQ 6000 Watt',
      'description' => 'Krachtige HLQ 6000 Watt elektrische verwarmer. Hoog vermogen voor grote terrassen en buitenruimtes.',
      'image'       => 'products/hlq-elektrisch/hlq-6000-watt.jpg',
      'category'    => 'terrasverwarming',
      'brand'       => 'HLQ',
      'type'        => 'Elektrisch',
      'power'       => '6000W',
      'application' => 'Horeca',
    ],

    // === PARASOLVERWARMING ===
    [
      'title'       => 'Parasolverwarming Lely',
      'description' => 'Compacte parasolverwarming, eenvoudig te bevestigen aan de parasol. Ideaal voor restaurants en cafés.',
      'image'       => 'products/parasolverwarming/parasol-lely-1.jpg',
      'gallery'     => ['products/parasolverwarming/parasol-lely-2.jpg'],
      'category'    => 'parasolverwarming',
      'type'        => 'Elektrisch',
      'application' => 'Horeca',
    ],
    [
      'title'       => 'Parasolverwarming met LED',
      'description' => 'Parasolverwarmer met geïntegreerde LED-verlichting. Warmte én sfeerverlichting in één oplossing.',
      'image'       => 'products/parasolverwarming/parasol-verwarming-met-led.jpg',
      'category'    => 'parasolverwarming',
      'type'        => 'Elektrisch',
      'application' => 'Horeca',
    ],
    [
      'title'       => 'Parasolverlichting',
      'description' => 'Parasolverlichting voor een warme sfeer op het terras. Combineerbaar met parasolverwarming.',
      'image'       => 'products/parasolverwarming/parasolverlichting-lely.jpg',
      'gallery'     => ['products/parasolverwarming/parasolverlichting-2.jpg', 'products/parasolverwarming/parasolverlichting-3.jpg'],
      'category'    => 'parasolverwarming',
      'type'        => 'Elektrisch',
      'application' => 'Horeca',
    ],
    [
      'title'       => 'Parasolverwarming Black',
      'description' => 'Parasolverwarmer in stijlvol zwart. Discrete en effectieve verwarming onder de parasol.',
      'image'       => 'products/parasolverwarming/parasolverwarming-black.jpg',
      'category'    => 'parasolverwarming',
      'type'        => 'Elektrisch',
      'application' => 'Horeca',
    ],
  ];
}

/**
 * Seed uitvoeren
 */
function tvs_run_product_seed() {
  $products  = tvs_get_seed_products();
  $theme_dir = get_template_directory();
  $created   = 0;
  $skipped   = 0;

  // Zorg dat taxonomieën bestaan
  $parent_cat = tvs_ensure_term('product_categorie', 'Terrasverwarming', 'terrasverwarming');
  tvs_ensure_term('product_categorie', 'Parasolverwarming', 'parasolverwarming', $parent_cat);
  tvs_ensure_term('product_categorie', 'Halverwarming', 'halverwarming');
  tvs_ensure_term('product_categorie', 'Kerkverwarming', 'kerkverwarming');

  foreach ($products as $product) {
    // Check of product al bestaat
    $existing = get_page_by_title($product['title'], OBJECT, 'tvs_product');
    if ($existing) {
      $skipped++;
      continue;
    }

    // Maak product aan
    $post_id = wp_insert_post([
      'post_type'    => 'tvs_product',
      'post_title'   => $product['title'],
      'post_content' => $product['description'],
      'post_status'  => 'publish',
    ]);

    if (is_wp_error($post_id)) {
      continue;
    }

    // Categorie toewijzen
    $cat_slug = $product['category'];
    $term = get_term_by('slug', $cat_slug, 'product_categorie');
    if ($term) {
      wp_set_object_terms($post_id, [$term->term_id], 'product_categorie');
      // Als het een subcategorie is, ook de parent toewijzen
      if ($term->parent) {
        wp_set_object_terms($post_id, [$term->parent, $term->term_id], 'product_categorie');
      }
    }

    // Merk toewijzen
    if (!empty($product['brand'])) {
      $brand_term = tvs_ensure_term('product_merk', $product['brand'], sanitize_title($product['brand']));
      if ($brand_term) {
        wp_set_object_terms($post_id, [$brand_term], 'product_merk');
      }
    }

    // Meta fields
    if (!empty($product['type'])) {
      update_post_meta($post_id, '_tvs_product_type', $product['type']);
    }
    if (!empty($product['application'])) {
      update_post_meta($post_id, '_tvs_product_application', $product['application']);
    }
    if (!empty($product['power'])) {
      update_post_meta($post_id, '_tvs_product_power', $product['power']);
    }

    // Featured image
    $img_path = $theme_dir . '/assets/images/' . $product['image'];
    if (file_exists($img_path)) {
      $attach_id = tvs_sideload_theme_image($img_path, $post_id);
      if ($attach_id) {
        set_post_thumbnail($post_id, $attach_id);
      }
    }

    $created++;
  }

  return sprintf('%d producten aangemaakt, %d overgeslagen (bestonden al).', $created, $skipped);
}

/**
 * Taxonomy-term aanmaken als die nog niet bestaat
 */
function tvs_ensure_term($taxonomy, $name, $slug, $parent = 0) {
  $term = get_term_by('slug', $slug, $taxonomy);
  if ($term) {
    return $term->term_id;
  }

  $result = wp_insert_term($name, $taxonomy, [
    'slug'   => $slug,
    'parent' => $parent,
  ]);

  return is_wp_error($result) ? 0 : $result['term_id'];
}

/**
 * Afbeelding uit theme importeren in media library
 */
function tvs_sideload_theme_image($file_path, $post_id = 0) {
  if (!file_exists($file_path)) {
    return 0;
  }

  require_once ABSPATH . 'wp-admin/includes/file.php';
  require_once ABSPATH . 'wp-admin/includes/media.php';
  require_once ABSPATH . 'wp-admin/includes/image.php';

  $filename  = basename($file_path);
  $upload    = wp_upload_dir();
  $dest_path = $upload['path'] . '/' . $filename;

  // Kopieer naar uploads map
  if (!copy($file_path, $dest_path)) {
    return 0;
  }

  $filetype = wp_check_filetype($filename);
  $attachment = [
    'post_mime_type' => $filetype['type'],
    'post_title'     => sanitize_file_name(pathinfo($filename, PATHINFO_FILENAME)),
    'post_content'   => '',
    'post_status'    => 'inherit',
  ];

  $attach_id = wp_insert_attachment($attachment, $dest_path, $post_id);
  if (is_wp_error($attach_id)) {
    return 0;
  }

  $attach_data = wp_generate_attachment_metadata($attach_id, $dest_path);
  wp_update_attachment_metadata($attach_id, $attach_data);

  return $attach_id;
}
