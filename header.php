<?php ?><!doctype html>
<html <?php language_attributes(); ?> class="dark">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
<meta name="theme-color" content="#000000" id="meta-theme-color">
<meta name="color-scheme" content="dark light">
<script>
/* Anti-flash: set theme before any render */
(function(){
  var t = localStorage.getItem('tvs-theme');
  if (t === 'light') {
    document.documentElement.classList.remove('dark');
    document.getElementById('meta-theme-color').content = '#f9fafb';
  }
})();
</script>
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        red: { 500: '#E31E24', 600: '#c51a20' },
      }
    }
  }
}
</script>
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">
<style id="tvs-responsive-critical">
/* Theme transition */
html.theme-transitioning,html.theme-transitioning *{transition:background-color .3s ease,color .3s ease,border-color .3s ease,box-shadow .3s ease !important}

@media (pointer:coarse) and (hover:none){
  .hero{min-height:70vh !important}
  .grid-2,.grid-3,.grid-4,.category-grid,.usp-grid,.stats-grid,.contact-grid,.footer-grid{grid-template-columns:1fr !important}
  .hero-ctas{flex-direction:column}
  .hero-ctas .btn{width:100%}
  h1{font-size:clamp(1.8rem,6vw,2.5rem) !important}
  .lead{font-size:clamp(0.95rem,2.5vw,1.125rem) !important}
  .site-header .brand-text{display:none}
}
@media screen and (max-width:1024px){
  .grid-2,.grid-3,.category-grid,.usp-grid{grid-template-columns:1fr !important}
  .grid-4{grid-template-columns:1fr 1fr !important}
}
@media screen and (max-width:768px){
  .grid-4{grid-template-columns:1fr !important}
  .stats-grid{grid-template-columns:repeat(auto-fit,minmax(120px,1fr)) !important}
  .contact-grid{grid-template-columns:1fr !important}
  .footer-grid{grid-template-columns:1fr !important}
}
@media screen and (max-width:640px){
  .hero-ctas{flex-direction:column}
  .hero-ctas .btn{width:100%}
}

/* Mobile nav */
@media screen and (max-width:1024px){
  .site-header .menu{
    position:absolute;top:100%;left:1rem;right:1rem;
    border-radius:1rem;padding:1rem;margin-top:.5rem;
    flex-direction:column;gap:.25rem;display:none;
  }
  .nav-toggle:checked ~ .menu{display:flex}
  .site-header .menu-items{flex-direction:column;gap:.25rem}
  .site-header .menu-item a{width:100%;justify-content:center}
}
</style>
<?php wp_head(); ?>
</head>
<body <?php body_class('dark:bg-black bg-gray-50 dark:text-white text-gray-900 transition-colors duration-300'); ?>>
<?php if (function_exists('wp_body_open')) { wp_body_open(); } ?>

<header class="site-header fixed top-0 left-0 right-0 z-50 h-24 flex items-center backdrop-blur-3xl border-b transition-colors duration-300 dark:bg-black/60 bg-white/60 dark:border-white/5 border-gray-200/50" data-header>
  <div class="container nav flex items-center justify-between w-full max-w-7xl mx-auto px-6">
    <a class="brand flex items-center gap-3 no-underline group" href="<?php echo esc_url(home_url('/')); ?>" aria-label="TVS home">
      <span class="brand-logo relative inline-flex items-center justify-center px-4 py-2 rounded-xl text-xl font-black text-white bg-gradient-to-br from-red-500 to-orange-500 select-none transition-shadow duration-300 group-hover:shadow-[0_0_20px_rgba(227,30,36,.4)]" aria-hidden="true">TVS</span>
      <span class="brand-text hidden sm:flex flex-col leading-tight">
        <span class="brand-name dark:text-white text-gray-900 font-black text-lg transition-colors duration-300">Terras Verwarmings</span>
        <span class="brand-sub dark:text-gray-400 text-gray-500 text-sm transition-colors duration-300">Specialisten</span>
      </span>
    </a>

    <div class="flex items-center gap-2">
      <!-- Theme Toggle - inline onclick for guaranteed functionality -->
      <button id="theme-toggle" onclick="var h=document.documentElement;h.classList.toggle('dark');localStorage.setItem('tvs-theme',h.classList.contains('dark')?'dark':'light');var m=document.getElementById('meta-theme-color');if(m)m.content=h.classList.contains('dark')?'#000000':'#f9fafb'" class="relative z-[999] p-3 rounded-xl cursor-pointer dark:bg-white/10 bg-gray-200 dark:hover:bg-white/20 hover:bg-gray-300 transition-all duration-300" style="pointer-events:auto" aria-label="Wissel thema">
        <svg class="w-5 h-5 text-yellow-400 hidden dark:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
        <svg class="w-5 h-5 text-gray-700 block dark:hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
      </button>

      <input id="nav-toggle" type="checkbox" class="nav-toggle sr-only peer" aria-hidden="true">
      <label for="nav-toggle" class="nav-icon relative z-50 flex flex-col gap-1.5 cursor-pointer p-2 lg:hidden" aria-label="Open menu">
        <span class="block w-6 h-0.5 dark:bg-gray-400 bg-gray-600 rounded transition-all"></span>
        <span class="block w-6 h-0.5 dark:bg-gray-400 bg-gray-600 rounded transition-all"></span>
        <span class="block w-6 h-0.5 dark:bg-gray-400 bg-gray-600 rounded transition-all"></span>
      </label>
    </div>

    <?php
      if (function_exists('tvs_render_primary_nav')) {
        tvs_render_primary_nav();
      } else {
        echo '<nav class="menu hidden lg:flex items-center gap-1" aria-label="Primary"><ul class="menu-items flex items-center gap-1 list-none m-0 p-0">';
        echo '<li class="menu-item menu-item--cta"><a class="btn btn-primary inline-flex items-center px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-red-500 to-orange-500 no-underline" href="' . esc_url(home_url('/contact/')) . '">Offerte Aanvragen</a></li>';
        echo '</ul></nav>';
      }
    ?>
  </div>
</header>

<main class="pt-24">
