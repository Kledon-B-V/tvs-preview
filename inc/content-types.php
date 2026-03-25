<?php
/**
 * Custom Post Types & Taxonomies
 *
 * Producten (verwarming) + Diensten (verduurzaming)
 * De klant kan alles via WordPress admin beheren.
 */

add_action('init', function () {

  // ========== PRODUCTEN (Verwarming) ==========
  register_post_type('tvs_product', [
    'labels' => [
      'name'               => 'Producten',
      'singular_name'      => 'Product',
      'add_new'            => 'Nieuw product',
      'add_new_item'       => 'Nieuw product toevoegen',
      'edit_item'          => 'Product bewerken',
      'new_item'           => 'Nieuw product',
      'view_item'          => 'Bekijk product',
      'search_items'       => 'Zoek producten',
      'not_found'          => 'Geen producten gevonden',
      'not_found_in_trash' => 'Geen producten in prullenbak',
    ],
    'public'       => true,
    'has_archive'  => true,
    'rewrite'      => ['slug' => 'product', 'with_front' => false],
    'supports'     => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'],
    'show_in_rest' => true,
    'menu_icon'    => 'dashicons-products',
    'menu_position' => 5,
  ]);

  // Product categorieën (hierarchisch: terrasverwarming > parasolverwarming)
  register_taxonomy('product_categorie', 'tvs_product', [
    'labels' => [
      'name'          => 'Productcategorieën',
      'singular_name' => 'Categorie',
      'add_new_item'  => 'Nieuwe categorie',
      'search_items'  => 'Zoek categorieën',
    ],
    'hierarchical' => true,
    'public'       => true,
    'rewrite'      => ['slug' => 'categorie'],
    'show_in_rest' => true,
    'show_admin_column' => true,
  ]);

  // Product merken
  register_taxonomy('product_merk', 'tvs_product', [
    'labels' => [
      'name'          => 'Merken',
      'singular_name' => 'Merk',
      'add_new_item'  => 'Nieuw merk',
    ],
    'hierarchical' => false,
    'public'       => true,
    'rewrite'      => ['slug' => 'merk'],
    'show_in_rest' => true,
    'show_admin_column' => true,
  ]);

  // ========== DIENSTEN (Verduurzaming) ==========
  register_post_type('tvs_dienst', [
    'labels' => [
      'name'               => 'Diensten',
      'singular_name'      => 'Dienst',
      'add_new'            => 'Nieuwe dienst',
      'add_new_item'       => 'Nieuwe dienst toevoegen',
      'edit_item'          => 'Dienst bewerken',
      'new_item'           => 'Nieuwe dienst',
      'view_item'          => 'Bekijk dienst',
      'search_items'       => 'Zoek diensten',
      'not_found'          => 'Geen diensten gevonden',
      'not_found_in_trash' => 'Geen diensten in prullenbak',
    ],
    'public'       => true,
    'has_archive'  => true,
    'rewrite'      => ['slug' => 'dienst', 'with_front' => false],
    'supports'     => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'],
    'show_in_rest' => true,
    'menu_icon'    => 'dashicons-admin-site-alt3',
    'menu_position' => 6,
  ]);

  // Dienst categorieën
  register_taxonomy('dienst_categorie', 'tvs_dienst', [
    'labels' => [
      'name'          => 'Dienstcategorieën',
      'singular_name' => 'Dienstcategorie',
      'add_new_item'  => 'Nieuwe dienstcategorie',
      'search_items'  => 'Zoek dienstcategorieën',
    ],
    'hierarchical' => true,
    'public'       => true,
    'rewrite'      => ['slug' => 'diensten'],
    'show_in_rest' => true,
    'show_admin_column' => true,
  ]);
});

/**
 * Expose product meta via REST API
 */
add_action('rest_api_init', function () {
  $fields = ['_tvs_product_power', '_tvs_product_type', '_tvs_product_application'];

  foreach ($fields as $field) {
    register_rest_field('tvs_product', $field, [
      'get_callback' => function ($object) use ($field) {
        return get_post_meta($object['id'], $field, true);
      },
      'schema' => ['type' => 'string'],
    ]);
  }
});
