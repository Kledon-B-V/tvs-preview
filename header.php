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

/* Hamburger button */
.hamburger{display:none;cursor:pointer;background:none;border:none;padding:.5rem;flex-direction:column;gap:5px;z-index:200}
.hamburger span{display:block;width:24px;height:2px;border-radius:2px;background:var(--text,#fff);transition:all .3s}
/* Mobile menu */
.mobile-menu{position:fixed;inset:0;z-index:150;background:var(--bg,#000);display:none;flex-direction:column;padding:96px 1.5rem 2rem;overflow-y:auto}
.mobile-menu.open{display:flex}
.mobile-menu-inner{display:flex;flex-direction:column;gap:.25rem}
.mobile-link{display:block;padding:1rem;border-radius:.75rem;font-size:1.125rem;font-weight:600;color:var(--text-secondary,#9ca3af);transition:all .2s;text-decoration:none}
.mobile-link:hover,.mobile-link--active{color:var(--text,#fff);background:var(--bg-card,rgba(255,255,255,.05))}
.mobile-accordion-btn{display:flex;align-items:center;justify-content:space-between;width:100%;text-align:left;background:none;border:none;cursor:pointer;font-family:inherit}
.mobile-chevron{transition:transform .2s}
.mobile-accordion.open .mobile-chevron{transform:rotate(180deg)}
.mobile-accordion-content{display:none;padding:.25rem 0 .5rem}
.mobile-accordion.open .mobile-accordion-content{display:block}
.mobile-accordion-group{padding:.5rem 0}
.mobile-accordion-group + .mobile-accordion-group{border-top:1px solid var(--border,rgba(255,255,255,.1))}
.mobile-group-label{padding:.375rem 1rem .375rem 1.5rem;font-size:.6875rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--text-muted,#6b7280)}
.mobile-accordion-content a{display:block;padding:.5rem 1rem .5rem 1.5rem;font-size:.9375rem;color:var(--text-secondary,#9ca3af);border-radius:.5rem;transition:all .15s;text-decoration:none}
.mobile-accordion-content a:hover{color:var(--text,#fff);background:var(--bg-card,rgba(255,255,255,.05))}
.mobile-cta{display:block;text-align:center;margin-top:1rem;padding:1rem;border-radius:.75rem;font-weight:700;background:linear-gradient(135deg,#E31E24,#ea580c);color:#fff;text-decoration:none}
@media screen and (max-width:1024px){
  .hamburger{display:flex}
  .site-header .menu{display:none !important}
}
</style>
<?php wp_head(); ?>
</head>
<body <?php body_class('dark:bg-black bg-gray-50 dark:text-white text-gray-900 transition-colors duration-300'); ?>>
<?php if (function_exists('wp_body_open')) { wp_body_open(); } ?>

<header class="site-header fixed top-0 left-0 right-0 z-50 h-24 flex items-center backdrop-blur-3xl border-b transition-colors duration-300 dark:bg-black/60 bg-white/60 dark:border-white/5 border-gray-200/50" data-header>
  <div class="container nav flex items-center justify-between w-full max-w-7xl mx-auto px-6">
    <a class="brand flex items-center gap-3 no-underline group" href="<?php echo esc_url(home_url('/')); ?>" aria-label="TVS home">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-tvs-header.png" alt="TVS NL - Installatie &amp; Elektrotechniek" class="h-12 w-auto block dark:hidden">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-tvs-header-dark.png" alt="TVS NL - Installatie &amp; Elektrotechniek" class="h-12 w-auto hidden dark:block">
    </a>

    <div class="flex items-center gap-2">
      <!-- Theme Toggle - inline onclick for guaranteed functionality -->
      <button id="theme-toggle" onclick="var h=document.documentElement;h.classList.toggle('dark');localStorage.setItem('tvs-theme',h.classList.contains('dark')?'dark':'light');var m=document.getElementById('meta-theme-color');if(m)m.content=h.classList.contains('dark')?'#000000':'#f9fafb'" class="relative z-[999] p-3 rounded-xl cursor-pointer dark:bg-white/10 bg-gray-200 dark:hover:bg-white/20 hover:bg-gray-300 transition-all duration-300" style="pointer-events:auto" aria-label="Wissel thema">
        <svg class="w-5 h-5 text-yellow-400 hidden dark:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
        <svg class="w-5 h-5 text-gray-700 block dark:hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
      </button>

      <button class="hamburger" id="hamburger" aria-label="Menu" onclick="var m=document.getElementById('mobile-menu');m.classList.toggle('open');document.body.style.overflow=m.classList.contains('open')?'hidden':''">
        <span></span><span></span><span></span>
      </button>
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

<script>
/* Close mobile menu on link click */
document.querySelectorAll('.mobile-link, .mobile-accordion-content a, .mobile-cta').forEach(function(link) {
  link.addEventListener('click', function() {
    var m = document.getElementById('mobile-menu');
    if (m) { m.classList.remove('open'); document.body.style.overflow = ''; }
  });
});
</script>

<main class="pt-24">
