<?php ?>
</main>

<?php
$email   = (string) tvs_cfg('contact.email', 'info@terrasverwarmer.nu');
$phone   = (string) tvs_cfg('contact.phone', '');
$address = (string) tvs_cfg('contact.address', '');
$zip     = (string) tvs_cfg('contact.zipcode', '');
$city    = (string) tvs_cfg('contact.city', '');
$kvk     = (string) tvs_cfg('company.kvk', '');
$company = (string) tvs_cfg('company.full_name', 'Terras Verwarmings Specialisten');
?>

<footer class="site-footer bg-gradient-to-b from-gray-50 to-gray-100 dark:from-black dark:to-gray-950 border-t border-gray-200 dark:border-white/5 transition-colors duration-300">
  <div class="container max-w-7xl mx-auto px-6 py-16">
    <div class="footer-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

      <div class="footer-col">
        <div class="footer-brand flex items-center gap-3 mb-4">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-tvs-footer.png" alt="TVS NL - Installatie &amp; Elektrotechniek" class="h-10 w-auto block dark:hidden">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-tvs-footer-dark.png" alt="TVS NL - Installatie &amp; Elektrotechniek" class="h-10 w-auto hidden dark:block">
        </div>
        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed max-w-xs">
          Specialist in verwarmingsoplossingen voor terrassen, hallen, kerken en meer.
        </p>
      </div>

      <div class="footer-col">
        <h3 class="text-gray-900 dark:text-white font-semibold text-sm uppercase tracking-wider mb-4">Producten</h3>
        <ul class="footer-links list-none m-0 p-0 flex flex-col gap-2.5">
          <li><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="<?php echo esc_url(home_url('/producten/')); ?>">Terrasverwarming</a></li>
          <li><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="<?php echo esc_url(home_url('/producten/')); ?>">Parasolverwarming</a></li>
          <li><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="<?php echo esc_url(home_url('/producten/')); ?>">Halverwarming</a></li>
          <li><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="<?php echo esc_url(home_url('/producten/')); ?>">Kerkverwarming</a></li>
        </ul>
      </div>

      <?php if (tvs_cfg('modules.show_verduurzaming', false)) : ?>
      <div class="footer-col">
        <h3 class="text-gray-900 dark:text-white font-semibold text-sm uppercase tracking-wider mb-4">Verduurzaming</h3>
        <ul class="footer-links list-none m-0 p-0 flex flex-col gap-2.5">
          <li><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="<?php echo esc_url(home_url('/#verduurzaming')); ?>">Zonnepanelen</a></li>
          <li><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="<?php echo esc_url(home_url('/#verduurzaming')); ?>">Laadpalen</a></li>
        </ul>
      </div>
      <?php endif; ?>

      <div class="footer-col">
        <h3 class="text-gray-900 dark:text-white font-semibold text-sm uppercase tracking-wider mb-4">Navigatie</h3>
        <ul class="footer-links list-none m-0 p-0 flex flex-col gap-2.5">
          <li><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
          <li><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="<?php echo esc_url(home_url('/producten/')); ?>">Producten</a></li>
          <li><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="<?php echo esc_url(home_url('/over-ons/')); ?>">Over Ons</a></li>
          <li><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h3 class="text-gray-900 dark:text-white font-semibold text-sm uppercase tracking-wider mb-4">Contact</h3>
        <ul class="footer-links list-none m-0 p-0 flex flex-col gap-2.5">
          <?php if ($address) : ?><li class="text-gray-600 dark:text-gray-400 text-sm"><?php echo esc_html($address); ?></li><?php endif; ?>
          <?php if ($zip && $city) : ?><li class="text-gray-600 dark:text-gray-400 text-sm"><?php echo esc_html($zip . ' ' . $city); ?></li><?php endif; ?>
          <?php if ($phone) : ?><li class="pt-2"><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></li><?php endif; ?>
          <?php if ($email) : ?><li><a class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></li><?php endif; ?>
          <?php if ($kvk) : ?><li class="pt-2 text-gray-500 dark:text-gray-500 text-xs">KvK <?php echo esc_html($kvk); ?></li><?php endif; ?>
        </ul>
      </div>

    </div>
  </div>

  <div class="border-t border-gray-200 dark:border-white/5">
    <div class="container max-w-7xl mx-auto px-6 py-6 flex flex-wrap items-center justify-between gap-4">
      <span class="text-gray-500 dark:text-gray-500 text-sm">&copy; <?php echo date('Y'); ?> TVS NL B.V. Alle rechten voorbehouden.</span>
      <div class="footer-bottom-links">
        <a class="text-gray-500 dark:text-gray-500 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 text-sm no-underline" href="#" data-cc-open>Cookie-instellingen</a>
      </div>
    </div>
  </div>
</footer>

<?php if (function_exists('wp_footer')) { wp_footer(); } ?>
</body>
</html>
