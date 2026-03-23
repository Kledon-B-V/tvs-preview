<?php
get_header();

$email      = (string) tvs_cfg('contact.email', 'info@terrasverwarmer.nu');
$phone      = (string) tvs_cfg('contact.phone', '');
$address    = (string) tvs_cfg('contact.address', '');
$city       = (string) tvs_cfg('contact.city', '');
$categories = tvs_cfg('categories', []);
$img        = get_template_directory_uri() . '/assets/images/';
?>

<!-- Fixed background orbs + grid pattern -->
<div class="fixed inset-0 -z-10 overflow-hidden" aria-hidden="true">
  <div class="absolute top-1/4 -left-32 w-[500px] h-[500px] dark:bg-red-600/20 bg-red-600/10 rounded-full blur-[120px] dark:opacity-20 opacity-10"></div>
  <div class="absolute bottom-1/4 -right-32 w-[400px] h-[400px] dark:bg-orange-500/15 bg-orange-500/10 rounded-full blur-[120px] dark:opacity-20 opacity-10"></div>
  <!-- Light mode grid overlay -->
  <div class="absolute inset-0 dark:hidden" style="background-image: linear-gradient(rgba(0,0,0,.04) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,.04) 1px, transparent 1px); background-size: 64px 64px;"></div>
  <!-- Dark mode grid overlay -->
  <div class="absolute inset-0 hidden dark:block" style="background-image: linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.02) 1px, transparent 1px); background-size: 64px 64px;"></div>
</div>

<!-- ========== HERO SECTION ========== -->
<section class="relative min-h-screen flex items-center dark:bg-black bg-gray-50 pt-32 pb-20 transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

      <!-- LEFT COLUMN -->
      <div class="space-y-8">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm backdrop-blur-xl border rounded-full px-5 py-2.5">
          <svg class="w-4 h-4 text-red-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.09 6.26L20.18 9.27l-5 4.87L16.36 21 12 17.77 7.64 21l1.18-6.86-5-4.87 6.09-1.01L12 2z"/></svg>
          <span class="text-sm dark:text-gray-300 text-gray-600 font-medium">Premium B2B Verwarmingsoplossingen</span>
        </div>

        <!-- Heading -->
        <h1 class="font-black text-5xl sm:text-6xl lg:text-7xl leading-[1.05] tracking-tight">
          <span class="dark:text-white text-gray-900">Innovatieve</span><br>
          <span class="bg-gradient-to-r from-red-500 to-orange-500 bg-clip-text text-transparent">Verwarming</span>
        </h1>

        <!-- Lead text -->
        <p class="text-xl dark:text-gray-400 text-gray-600 max-w-lg leading-relaxed">
          Specialist in terrasverwarming, halverwarming en kerkverwarming.
          Ontdek onze uitgebreide catalogus met A-merken.
        </p>

        <!-- CTAs -->
        <div class="flex flex-wrap gap-4">
          <a href="<?php echo esc_url(home_url('/producten/')); ?>"
             class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-500 hover:to-orange-400 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 shadow-lg shadow-red-600/25">
            Ontdek Producten
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="<?php echo esc_url(home_url('/contact/')); ?>"
             class="inline-flex items-center gap-2 dark:bg-white/5 dark:border-white/10 dark:text-white bg-white border-gray-200 text-gray-900 shadow-sm hover:bg-white/10 border font-semibold px-8 py-4 rounded-xl backdrop-blur-xl transition-all duration-300">
            Offerte Aanvragen
          </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-4 pt-4">
          <div class="dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-2xl p-5 text-center backdrop-blur-xl transition-colors duration-300">
            <span class="block text-2xl font-black dark:text-white text-gray-900">20+</span>
            <span class="text-sm dark:text-gray-400 text-gray-600">Jaar Ervaring</span>
          </div>
          <div class="dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-2xl p-5 text-center backdrop-blur-xl transition-colors duration-300">
            <span class="block text-2xl font-black dark:text-white text-gray-900">1000+</span>
            <span class="text-sm dark:text-gray-400 text-gray-600">Tevreden Klanten</span>
          </div>
          <div class="dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-2xl p-5 text-center backdrop-blur-xl transition-colors duration-300">
            <span class="block text-2xl font-black dark:text-white text-gray-900">100%</span>
            <span class="text-sm dark:text-gray-400 text-gray-600">Kwaliteit</span>
          </div>
        </div>
      </div>

      <!-- RIGHT COLUMN: Image grid -->
      <div class="grid grid-cols-2 gap-4">
        <!-- Large image spanning 2 cols -->
        <div class="col-span-2 relative h-80 rounded-3xl overflow-hidden group">
          <img src="<?php echo esc_url($img . 'hero-terras.jpg'); ?>" alt="Terrasverwarming"
               class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
          <div class="absolute bottom-6 left-6">
            <span class="text-white font-bold text-lg">Terrasverwarming</span>
            <p class="text-gray-300 text-sm mt-1">Premium buitenverwarming</p>
          </div>
        </div>
        <!-- Smaller image 1 -->
        <div class="relative h-52 rounded-3xl overflow-hidden group">
          <img src="<?php echo esc_url($img . 'cat-halverwarming.jpg'); ?>" alt="Halverwarming"
               class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
          <div class="absolute bottom-4 left-4">
            <span class="text-white font-semibold">Halverwarming</span>
          </div>
        </div>
        <!-- Smaller image 2 -->
        <div class="relative h-52 rounded-3xl overflow-hidden group">
          <img src="<?php echo esc_url($img . 'cat-kerkverwarming.jpg'); ?>" alt="Kerkverwarming"
               class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
          <div class="absolute bottom-4 left-4">
            <span class="text-white font-semibold">Kerkverwarming</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ========== CATEGORIES SECTION ========== -->
<section class="relative py-24 dark:bg-black bg-gray-50 transition-colors duration-300" id="categorien">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Section header -->
    <div class="text-center mb-16">
      <div class="inline-flex items-center gap-2 dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-full px-5 py-2.5 mb-6">
        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
        <span class="text-sm dark:text-gray-300 text-gray-600 font-medium uppercase tracking-wider">Onze Productlijnen</span>
      </div>
      <h2 class="text-4xl sm:text-5xl font-black dark:text-white text-gray-900">Premium Oplossingen</h2>
    </div>

    <!-- Category grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php
      // Fallback images for categories
      $cat_images = [
        $img . 'hero-terras.jpg',
        $img . 'cat-halverwarming.jpg',
        $img . 'cat-kerkverwarming.jpg',
      ];

      $terms = get_terms([
        'taxonomy'   => 'product_categorie',
        'hide_empty' => false,
        'number'     => 4,
      ]);

      if (!is_wp_error($terms) && !empty($terms)) :
        foreach ($terms as $i => $term) :
          $count = $term->count;
          $thumb = get_term_meta($term->term_id, 'thumbnail_url', true);
          $card_img = $thumb ? $thumb : ($cat_images[$i] ?? $cat_images[0]);
      ?>
        <a href="<?php echo esc_url(get_term_link($term)); ?>"
           class="group dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-2xl overflow-hidden backdrop-blur-xl transition-all duration-300 dark:hover:bg-white/10 dark:hover:border-white/20 hover:border-gray-300 hover:shadow-lg">
          <!-- Image -->
          <div class="relative h-64 overflow-hidden">
            <img src="<?php echo esc_url($card_img); ?>" alt="<?php echo esc_attr($term->name); ?>"
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
          </div>
          <!-- Content -->
          <div class="p-6 space-y-3">
            <span class="inline-block bg-gradient-to-r from-red-600/20 to-orange-500/20 text-red-400 text-xs font-semibold px-3 py-1 rounded-full border border-red-500/20">
              <?php echo esc_html($count); ?> producten
            </span>
            <h3 class="dark:text-white text-gray-900 font-bold text-lg group-hover:text-red-400 transition-colors duration-300">
              <?php echo esc_html($term->name); ?>
            </h3>
            <p class="dark:text-gray-400 text-gray-600 text-sm leading-relaxed line-clamp-2">
              <?php echo esc_html($term->description); ?>
            </p>
            <span class="inline-flex items-center gap-1 text-red-400 text-sm font-medium">
              Bekijk producten
              <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </span>
          </div>
        </a>
      <?php
        endforeach;
      else :
        // Fallback: categories from config
        foreach ($categories as $i => $cat) :
          $card_img = $cat_images[$i] ?? $cat_images[0];
      ?>
        <a href="<?php echo esc_url(home_url('/producten/')); ?>"
           class="group dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-2xl overflow-hidden backdrop-blur-xl transition-all duration-300 dark:hover:bg-white/10 dark:hover:border-white/20 hover:border-gray-300 hover:shadow-lg">
          <!-- Image -->
          <div class="relative h-64 overflow-hidden">
            <img src="<?php echo esc_url($card_img); ?>" alt="<?php echo esc_attr($cat['label']); ?>"
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
          </div>
          <!-- Content -->
          <div class="p-6 space-y-3">
            <h3 class="dark:text-white text-gray-900 font-bold text-lg group-hover:text-red-400 transition-colors duration-300">
              <?php echo esc_html($cat['label']); ?>
            </h3>
            <p class="dark:text-gray-400 text-gray-600 text-sm leading-relaxed line-clamp-2">
              <?php echo esc_html($cat['desc']); ?>
            </p>
            <span class="inline-flex items-center gap-1 text-red-400 text-sm font-medium">
              Bekijk producten
              <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </span>
          </div>
        </a>
      <?php
        endforeach;
      endif;
      ?>
    </div>
  </div>
</section>

<!-- ========== USP SECTION ========== -->
<section class="relative py-24 dark:bg-black bg-gray-50 transition-colors duration-300" id="waarom-tvs">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Section header -->
    <div class="text-center mb-16">
      <div class="inline-flex items-center gap-2 dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-full px-5 py-2.5 mb-6">
        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <span class="text-sm dark:text-gray-300 text-gray-600 font-medium uppercase tracking-wider">Waarom TVS</span>
      </div>
      <h2 class="text-4xl sm:text-5xl font-black dark:text-white text-gray-900">Jouw Partner in Verwarming</h2>
    </div>

    <!-- USP cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Card 1: Ervaring -->
      <div class="dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-2xl p-8 backdrop-blur-xl text-center space-y-4 dark:hover:bg-white/10 dark:hover:border-white/20 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
        <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-red-600 to-orange-500 rounded-2xl mx-auto">
          <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3 class="dark:text-white text-gray-900 font-bold text-xl">20+ Jaar Ervaring</h3>
        <p class="dark:text-gray-400 text-gray-600 leading-relaxed">
          Betrouwbare partner met uitgebreide kennis van verwarmingsoplossingen voor diverse sectoren.
        </p>
      </div>

      <!-- Card 2: A-Merken -->
      <div class="dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-2xl p-8 backdrop-blur-xl text-center space-y-4 dark:hover:bg-white/10 dark:hover:border-white/20 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
        <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-red-600 to-orange-500 rounded-2xl mx-auto">
          <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
        </div>
        <h3 class="dark:text-white text-gray-900 font-bold text-xl">Premium A-Merken</h3>
        <p class="dark:text-gray-400 text-gray-600 leading-relaxed">
          Alleen hoogwaardige producten met uitstekende garanties van gerenommeerde fabrikanten.
        </p>
      </div>

      <!-- Card 3: Maatwerk -->
      <div class="dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-2xl p-8 backdrop-blur-xl text-center space-y-4 dark:hover:bg-white/10 dark:hover:border-white/20 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
        <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-red-600 to-orange-500 rounded-2xl mx-auto">
          <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        </div>
        <h3 class="dark:text-white text-gray-900 font-bold text-xl">Maatwerk Advies</h3>
        <p class="dark:text-gray-400 text-gray-600 leading-relaxed">
          Persoonlijk advies en support op maat voor uw specifieke situatie en wensen.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ========== CTA SECTION ========== -->
<section class="relative py-24 dark:bg-black bg-gray-50 transition-colors duration-300">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-xl backdrop-blur-3xl border rounded-[3rem] p-12 sm:p-16 text-center overflow-hidden transition-colors duration-300">

      <!-- Decorative gradient blurs -->
      <div class="absolute top-0 left-1/4 w-64 h-64 dark:bg-red-600/20 bg-red-600/10 rounded-full blur-[100px] dark:opacity-20 opacity-10" aria-hidden="true"></div>
      <div class="absolute bottom-0 right-1/4 w-48 h-48 dark:bg-orange-500/20 bg-orange-500/10 rounded-full blur-[80px] dark:opacity-20 opacity-10" aria-hidden="true"></div>

      <div class="relative z-10 space-y-8">
        <h2 class="text-4xl sm:text-5xl font-black dark:text-white text-gray-900">Klaar Om Te Starten?</h2>
        <p class="text-xl dark:text-gray-400 text-gray-600 max-w-2xl mx-auto leading-relaxed">
          Gebruik ons geavanceerde filtersysteem om snel het juiste product te vinden,
          of neem direct contact op voor professioneel advies op maat.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="<?php echo esc_url(home_url('/producten/')); ?>"
             class="inline-flex items-center gap-2 dark:bg-white dark:text-black dark:hover:bg-gray-100 bg-gray-900 text-white hover:bg-gray-800 font-semibold px-8 py-4 rounded-xl transition-all duration-300">
            Bekijk Alle Producten
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="<?php echo esc_url(home_url('/contact/')); ?>"
             class="inline-flex items-center gap-2 dark:bg-white/10 dark:border-white/20 dark:text-white dark:hover:bg-white/15 bg-white border-gray-300 text-gray-900 hover:bg-gray-50 border font-semibold px-8 py-4 rounded-xl backdrop-blur-xl transition-all duration-300">
            Vraag Offerte Aan
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
