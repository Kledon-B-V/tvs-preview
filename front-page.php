<?php
get_header();

$img     = get_template_directory_uri() . '/assets/images/';
$tagline = (string) tvs_cfg('company.tagline', 'Uw specialist in verwarming en verduurzaming');
$vw      = tvs_cfg('branches.verwarming', []);
$vd      = tvs_cfg('branches.verduurzaming', []);
$vd_on   = !empty($vd['enabled']);
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

<!-- ========== SECTION 1: HERO ========== -->
<section class="relative min-h-screen flex items-center justify-center dark:bg-black bg-gray-50 pt-24 pb-20 transition-colors duration-300">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center">

    <!-- Logo -->
    <div class="mb-8">
      <img src="<?php echo esc_url($img . 'logo-tvs-header.png'); ?>"
           alt="<?php echo esc_attr(tvs_cfg('company.short_name', 'TVS NL')); ?>"
           class="h-20 sm:h-24 mx-auto dark:hidden">
      <img src="<?php echo esc_url($img . 'logo-tvs-header-dark.png'); ?>"
           alt="<?php echo esc_attr(tvs_cfg('company.short_name', 'TVS NL')); ?>"
           class="h-20 sm:h-24 mx-auto hidden dark:block">
    </div>

    <!-- Company name -->
    <h1 class="font-black text-5xl sm:text-6xl lg:text-7xl tracking-tight dark:text-white text-gray-900 mb-4">
      <?php echo esc_html(tvs_cfg('company.short_name', 'TVS NL')); ?>
    </h1>

    <!-- Subtitle -->
    <p class="text-xl sm:text-2xl font-semibold bg-gradient-to-r from-red-500 to-orange-500 bg-clip-text text-transparent mb-6">
      Installatie &amp; Elektrotechniek
    </p>

    <!-- Tagline -->
    <p class="text-lg sm:text-xl dark:text-gray-400 text-gray-600 max-w-2xl mx-auto leading-relaxed">
      <?php echo esc_html($tagline); ?>
    </p>

    <!-- Scroll indicator -->
    <div class="mt-16 animate-bounce">
      <svg class="w-6 h-6 mx-auto dark:text-gray-500 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>

  </div>
</section>

<!-- ========== SECTION 2: TWO DOORS ========== -->
<section class="relative dark:bg-black bg-gray-50 transition-colors duration-300 py-12 sm:py-16 lg:py-24" id="takken">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Section header -->
    <div class="text-center mb-12 sm:mb-16">
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black dark:text-white text-gray-900">Wat kunnen wij voor u doen?</h2>
      <p class="mt-4 text-lg dark:text-gray-400 text-gray-600 max-w-2xl mx-auto">Kies uw richting en ontdek onze oplossingen</p>
    </div>

    <div class="grid grid-cols-1 <?php echo $vd_on ? 'lg:grid-cols-2' : ''; ?> gap-6 lg:gap-8">

      <!-- LEFT DOOR: Verwarming -->
      <a href="<?php echo esc_url(home_url('/verwarming/')); ?>"
         class="<?php echo !$vd_on ? 'lg:col-span-2 max-w-4xl mx-auto w-full' : ''; ?> group relative block rounded-3xl overflow-hidden h-[40vh] sm:h-[45vh] lg:h-[50vh] transition-all duration-500">
        <!-- Background image -->
        <?php if (!empty($vw['hero_image'])) : ?>
        <img src="<?php echo esc_url($img . $vw['hero_image']); ?>"
             alt="<?php echo esc_attr($vw['label'] ?? 'Verwarming'); ?>"
             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        <?php endif; ?>
        <!-- Red gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-red-900/80 to-red-600/60 transition-opacity duration-500 group-hover:from-red-900/70 group-hover:to-red-600/50"></div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col items-center justify-center h-full px-6 sm:px-10 text-center">
          <!-- Icon -->
          <div class="mb-6 p-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path d="M12 2c0 4-4 6-4 10a4 4 0 0 0 8 0c0-4-4-6-4-10z"/>
              <path d="M12 22v-2"/>
            </svg>
          </div>

          <!-- Title -->
          <h3 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mb-3">
            <?php echo esc_html($vw['label'] ?? 'Verwarming'); ?>
          </h3>

          <!-- Description -->
          <p class="text-white/80 text-base sm:text-lg max-w-md mb-6 leading-relaxed">
            <?php echo esc_html($vw['tagline'] ?? 'Professionele verwarmingsoplossingen'); ?>
          </p>

          <!-- Preview badges -->
          <div class="flex flex-wrap justify-center gap-2 mb-8">
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-white/15 text-white backdrop-blur-sm border border-white/20">Terrasverwarming</span>
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-white/15 text-white backdrop-blur-sm border border-white/20">Halverwarming</span>
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-white/15 text-white backdrop-blur-sm border border-white/20">Kerkverwarming</span>
          </div>

          <!-- CTA button -->
          <span class="inline-flex items-center gap-2 bg-white text-red-700 font-semibold px-8 py-4 rounded-xl transition-all duration-300 group-hover:bg-red-50 group-hover:shadow-lg group-hover:shadow-red-900/20 text-base">
            Ontdek Verwarming
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </span>
        </div>
      </a>

      <?php if ($vd_on) : ?>
      <!-- RIGHT DOOR: Verduurzaming -->
      <a href="<?php echo esc_url(home_url('/verduurzaming/')); ?>"
         class="group relative block rounded-3xl overflow-hidden h-[40vh] sm:h-[45vh] lg:h-[50vh] transition-all duration-500">
        <!-- Background image -->
        <?php if (!empty($vd['hero_image'])) : ?>
        <img src="<?php echo esc_url($img . $vd['hero_image']); ?>"
             alt="<?php echo esc_attr($vd['label'] ?? 'Verduurzaming'); ?>"
             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        <?php endif; ?>
        <!-- Green gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/80 to-emerald-600/60 transition-opacity duration-500 group-hover:from-emerald-900/70 group-hover:to-emerald-600/50"></div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col items-center justify-center h-full px-6 sm:px-10 text-center">
          <!-- Icon -->
          <div class="mb-6 p-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446A9 9 0 1 1 12 3z"/>
              <path d="M17 4a2 2 0 0 0 2 2 2 2 0 0 0-2 2 2 2 0 0 0-2-2 2 2 0 0 0 2-2"/>
              <path d="M21 10h1"/>
            </svg>
          </div>

          <!-- Title -->
          <h3 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mb-3">
            <?php echo esc_html($vd['label'] ?? 'Verduurzaming'); ?>
          </h3>

          <!-- Description -->
          <p class="text-white/80 text-base sm:text-lg max-w-md mb-6 leading-relaxed">
            <?php echo esc_html($vd['tagline'] ?? 'Duurzame oplossingen voor een groene toekomst'); ?>
          </p>

          <!-- Preview badges -->
          <div class="flex flex-wrap justify-center gap-2 mb-8">
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-white/15 text-white backdrop-blur-sm border border-white/20">Zonnepanelen</span>
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-white/15 text-white backdrop-blur-sm border border-white/20">Laadpalen</span>
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-white/15 text-white backdrop-blur-sm border border-white/20">Accu's</span>
          </div>

          <!-- CTA button -->
          <span class="inline-flex items-center gap-2 bg-white text-emerald-700 font-semibold px-8 py-4 rounded-xl transition-all duration-300 group-hover:bg-emerald-50 group-hover:shadow-lg group-hover:shadow-emerald-900/20 text-base">
            Ontdek Verduurzaming
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </span>
        </div>
      </a>
      <?php endif; ?>

    </div>
  </div>
</section>

<!-- ========== SECTION 3: USPs ========== -->
<section class="relative py-24 dark:bg-black bg-gray-50 transition-colors duration-300" id="waarom-tvs">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Section header -->
    <div class="text-center mb-16">
      <div class="inline-flex items-center gap-2 dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-full px-5 py-2.5 mb-6">
        <svg class="w-4 h-4 dark:text-gray-400 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <span class="text-sm dark:text-gray-300 text-gray-600 font-medium uppercase tracking-wider">Waarom TVS NL</span>
      </div>
      <h2 class="text-4xl sm:text-5xl font-black dark:text-white text-gray-900">Uw Betrouwbare Partner</h2>
    </div>

    <!-- USP cards (branch-neutral) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Card 1: Ervaring -->
      <div class="dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-2xl p-8 backdrop-blur-xl text-center space-y-4 dark:hover:bg-white/10 dark:hover:border-white/20 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
        <div class="inline-flex items-center justify-center w-14 h-14 dark:bg-white/10 bg-gray-100 rounded-2xl mx-auto">
          <svg class="w-7 h-7 dark:text-white text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3 class="dark:text-white text-gray-900 font-bold text-xl">20+ Jaar Ervaring</h3>
        <p class="dark:text-gray-400 text-gray-600 leading-relaxed">
          Al meer dan twee decennia uw betrouwbare partner in installatie en elektrotechniek.
        </p>
      </div>

      <!-- Card 2: Vakmanschap -->
      <div class="dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-2xl p-8 backdrop-blur-xl text-center space-y-4 dark:hover:bg-white/10 dark:hover:border-white/20 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
        <div class="inline-flex items-center justify-center w-14 h-14 dark:bg-white/10 bg-gray-100 rounded-2xl mx-auto">
          <svg class="w-7 h-7 dark:text-white text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
        </div>
        <h3 class="dark:text-white text-gray-900 font-bold text-xl">Vakmanschap</h3>
        <p class="dark:text-gray-400 text-gray-600 leading-relaxed">
          Gecertificeerde vakmensen met uitgebreide technische kennis en oog voor detail.
        </p>
      </div>

      <!-- Card 3: Maatwerk Advies -->
      <div class="dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-sm border rounded-2xl p-8 backdrop-blur-xl text-center space-y-4 dark:hover:bg-white/10 dark:hover:border-white/20 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
        <div class="inline-flex items-center justify-center w-14 h-14 dark:bg-white/10 bg-gray-100 rounded-2xl mx-auto">
          <svg class="w-7 h-7 dark:text-white text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <h3 class="dark:text-white text-gray-900 font-bold text-xl">Maatwerk Advies</h3>
        <p class="dark:text-gray-400 text-gray-600 leading-relaxed">
          Persoonlijk advies en oplossingen die precies aansluiten bij uw situatie en wensen.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ========== SECTION 4: CTA ========== -->
<section class="relative py-24 dark:bg-black bg-gray-50 transition-colors duration-300">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative dark:bg-white/5 dark:border-white/10 bg-white border-gray-200 shadow-xl backdrop-blur-3xl border rounded-[3rem] p-12 sm:p-16 text-center overflow-hidden transition-colors duration-300">

      <!-- Decorative gradient blurs -->
      <div class="absolute top-0 left-1/4 w-64 h-64 dark:bg-red-600/20 bg-red-600/10 rounded-full blur-[100px] dark:opacity-20 opacity-10" aria-hidden="true"></div>
      <div class="absolute bottom-0 right-1/4 w-48 h-48 dark:bg-orange-500/20 bg-orange-500/10 rounded-full blur-[80px] dark:opacity-20 opacity-10" aria-hidden="true"></div>

      <div class="relative z-10 space-y-8">
        <h2 class="text-4xl sm:text-5xl font-black dark:text-white text-gray-900">Klaar Om Te Starten?</h2>
        <p class="text-xl dark:text-gray-400 text-gray-600 max-w-2xl mx-auto leading-relaxed">
          Neem vrijblijvend contact op voor persoonlijk advies of een offerte op maat.
          Wij helpen u graag verder.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="<?php echo esc_url(home_url('/contact/')); ?>"
             class="inline-flex items-center gap-2 dark:bg-white dark:text-black dark:hover:bg-gray-100 bg-gray-900 text-white hover:bg-gray-800 font-semibold px-8 py-4 rounded-xl transition-all duration-300">
            Neem Contact Op
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="tel:<?php echo esc_attr(str_replace(' ', '', tvs_cfg('contact.phone', ''))); ?>"
             class="inline-flex items-center gap-2 dark:bg-white/10 dark:border-white/20 dark:text-white dark:hover:bg-white/15 bg-white border-gray-300 text-gray-900 hover:bg-gray-50 border font-semibold px-8 py-4 rounded-xl backdrop-blur-xl transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <?php echo esc_html(tvs_cfg('contact.phone', '+31 (0)348 220338')); ?>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
