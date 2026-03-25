<?php
/**
 * TVS site configuration (single source of truth).
 * Pas dit bestand aan om modules/copy/legal in één plek te beheren.
 *
 * BRANCHES: De site heeft twee takken — verwarming (rood) en verduurzaming (groen).
 * Zet 'enabled' op false om een hele tak uit te schakelen.
 */
return [
  'modules' => [
    'show_products'     => true,
    'show_testimonials' => false,
    'show_contact_form' => true,
    'show_prices'       => false,
  ],

  'contact' => [
    'email'   => 'info@terrasverwarmer.nu',
    'phone'   => '+31 (0)348 220338',
    'address' => 'Nijverheidsweg 16B',
    'zipcode' => '3481 MB',
    'city'    => 'Harmelen',
  ],

  'company' => [
    'legal_name' => 'TVS NL B.V.',
    'short_name' => 'TVS NL',
    'full_name'  => 'TVS NL — Installatie & Elektrotechniek',
    'tagline'    => 'Uw specialist in verwarming en verduurzaming',
    'kvk'        => '58781005',
    'website'    => 'terrasverwarmers.nu',
  ],

  // ===== BRANCH SYSTEM =====
  'branches' => [
    'verwarming' => [
      'slug'            => 'verwarming',
      'label'           => 'Verwarming',
      'tagline'         => 'Professionele verwarmingsoplossingen',
      'description'     => 'Van terrasverwarming tot halverwarming en kerkverwarming. Al 20+ jaar uw specialist.',
      'color_primary'   => '#E31E24',
      'color_secondary' => '#ff6633',
      'color_gradient'  => 'from-red-600 to-orange-500',
      'icon'            => 'flame',
      'type'            => 'catalog',
      'post_type'       => 'tvs_product',
      'taxonomy'        => 'product_categorie',
      'enabled'         => true,
      'hero_image'      => 'products/goldsun-elite/goldsun-elite-5.jpg',
      'seo' => [
        'description' => 'TVS is specialist in terrasverwarming, halverwarming en kerkverwarming. Ontdek onze uitgebreide catalogus met A-merken.',
      ],
      'contact_subjects' => [
        'terrasverwarming' => 'Terrasverwarming',
        'halverwarming'    => 'Halverwarming',
        'kerkverwarming'   => 'Kerkverwarming',
        'loungehaarden'    => 'Loungehaarden',
        'anders'           => 'Anders',
      ],
    ],

    'verduurzaming' => [
      'slug'            => 'verduurzaming',
      'label'           => 'Verduurzaming',
      'tagline'         => 'Duurzame oplossingen voor een groene toekomst',
      'description'     => 'Zonnepanelen, laadpalen en accu-oplossingen. Advies, installatie en onderhoud op maat.',
      'color_primary'   => '#22c55e',
      'color_secondary' => '#16a34a',
      'color_gradient'  => 'from-emerald-600 to-emerald-500',
      'icon'            => 'leaf',
      'type'            => 'services',
      'post_type'       => 'tvs_dienst',
      'taxonomy'        => 'dienst_categorie',
      'enabled'         => true,
      'hero_image'      => 'products/zonnepanelen.jpg',
      'seo' => [
        'description' => 'TVS biedt duurzame oplossingen: zonnepanelen, laadpalen en accu-systemen. Advies en installatie op maat.',
      ],
      'contact_subjects' => [
        'zonnepanelen' => 'Zonnepanelen',
        'laadpalen'    => 'Laadpalen',
        'accus'        => "Accu's / Opslag",
        'advies'       => 'Duurzaamheidsadvies',
      ],
    ],
  ],

  // Legacy: backward compat (wordt berekend in functions.php)
  'categories' => [
    'terrasverwarming' => [
      'slug'  => 'terrasverwarming',
      'label' => 'Terrasverwarming',
      'desc'  => 'Gas en elektrische verwarmingsoplossingen',
    ],
    'halverwarming' => [
      'slug'  => 'halverwarming',
      'label' => 'Halverwarming',
      'desc'  => 'Donkerstralers voor bedrijfshallen en sporthallen',
    ],
    'kerkverwarming' => [
      'slug'  => 'kerkverwarming',
      'label' => 'Kerkverwarming',
      'desc'  => 'Speciale oplossingen voor kerken',
    ],
  ],

  'opening_hours' => [
    'weekdays' => '9:00 - 17:00',
    'weekend'  => 'Op afspraak',
  ],

  'colors' => [
    'primary'   => '#E31E24',
    'secondary' => '#ff6633',
    'green'     => '#22c55e',
    'dark'      => '#1f2937',
    'light'     => '#f9fafb',
  ],

  'seo' => [
    'ga4_id'            => '',
    'search_console_id' => '',
    'og_image'          => 'assets/images/og-tvs.png',
    'descriptions'      => [
      'home'           => 'TVS NL — Installatie & Elektrotechniek. Specialist in verwarming en verduurzaming.',
      'producten'      => 'Bekijk ons complete assortiment verwarmingsoplossingen van A-merken.',
      'verwarming'     => 'Terrasverwarming, halverwarming en kerkverwarming van TVS NL.',
      'verduurzaming'  => 'Zonnepanelen, laadpalen en accu-systemen van TVS NL.',
      'over-ons'       => 'TVS NL: 20+ jaar ervaring in installatie & elektrotechniek.',
      'contact'        => 'Neem contact op met TVS NL voor vrijblijvend advies of een offerte op maat.',
    ],
  ],

  'legal' => [
    'privacy' => '',
    'terms'   => '',
  ],
];
