<?php
/**
 * TVS site configuration (single source of truth).
 * Pas dit bestand aan om modules/copy/legal in één plek te beheren.
 */
return [
  'modules' => [
    'show_products'      => true,
    'show_testimonials'  => false,
    'show_contact_form'  => true,
    'show_verduurzaming' => true,
  ],

  'contact' => [
    'email'   => 'info@terrasverwarmer.nu',
    'phone'   => '+31 (0)348 220338',
    'address' => 'Nijverheidsweg 16B',
    'zipcode' => '3481 MB',
    'city'    => 'Harmelen',
  ],

  'company' => [
    'legal_name' => 'Terras Verwarmings Specialisten (TVS NL B.V.)',
    'short_name' => 'TVS',
    'full_name'  => 'Terras Verwarmings Specialisten',
    'kvk'        => '58781005',
    'website'    => 'terrasverwarmers.nu',
  ],

  'categories' => [
    'terrasverwarming' => [
      'slug'  => 'terrasverwarming',
      'label' => 'Terrasverwarming',
      'desc'  => 'Gas en elektrische verwarmingsoplossingen',
      'children' => [
        'parasolverwarming' => [
          'slug'  => 'parasolverwarming',
          'label' => 'Parasolverwarming',
          'desc'  => 'Compacte verwarmingsoplossingen voor parasols',
        ],
      ],
    ],
    'halverwarming' => [
      'slug'  => 'halverwarming',
      'label' => 'Halverwarming',
      'desc'  => 'Effectieve verwarming voor grote ruimtes',
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
    'dark'      => '#1f2937',
    'light'     => '#f9fafb',
  ],

  'seo' => [
    'ga4_id'            => '',
    'search_console_id' => '',
    'og_image'          => 'assets/images/og-tvs.png',
    'descriptions'      => [
      'home'       => 'TVS is specialist in terrasverwarming, halverwarming en kerkverwarming. Ontdek onze uitgebreide catalogus met A-merken voor professionele verwarmingsoplossingen.',
      'producten'  => 'Bekijk ons complete assortiment professionele verwarmingsoplossingen. Terrasverwarming, halverwarming en kerkverwarming van A-merken.',
      'over-ons'   => 'Terras Verwarmings Specialisten: 20+ jaar ervaring in professionele verwarmingsoplossingen voor horeca, kerken, hallen en meer.',
      'contact'    => 'Neem contact op met TVS voor vrijblijvend advies of een offerte op maat voor uw verwarmingsproject.',
    ],
  ],

  'verduurzaming' => [
    'title'    => 'Verduurzaming',
    'subtitle' => 'Duurzame oplossingen voor een groene toekomst',
    'color'    => '#22c55e',
    'diensten' => [
      'zonnepanelen' => [
        'label'    => 'Zonnepanelen',
        'desc'     => 'Bespaar op energiekosten met zonnepanelen op maat. Wij verzorgen advies, installatie en monitoring voor bedrijven en particulieren.',
        'icon'     => 'sun',
        'image'    => 'products/zonnepanelen.jpg',
        'features' => ['Op maat advies', 'Professionele installatie', 'Subsidie-check', 'Monitoring & onderhoud'],
      ],
      'laadpalen' => [
        'label'    => 'Laadpalen',
        'desc'     => 'Oplaadoplossingen voor thuis en zakelijk. Van advies tot installatie en slimme laadoplossingen.',
        'icon'     => 'battery-charging',
        'image'    => '',
        'features' => ['Thuis & zakelijk', 'Slimme laadoplossingen', 'Installatie & onderhoud', 'Subsidie-check'],
      ],
    ],
  ],

  'legal' => [
    'privacy' => '',
    'terms'   => '',
  ],
];
