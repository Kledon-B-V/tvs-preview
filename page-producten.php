<?php
/**
 * Template Name: Producten
 */
get_header();

// Gather taxonomy terms for filters
$cats = get_terms(['taxonomy' => 'product_categorie', 'hide_empty' => false]);
$brands = get_terms(['taxonomy' => 'product_merk', 'hide_empty' => false]);

// Product types & applications for quick filter pills
$types = ['Gas', 'Elektrisch'];
$applications = ['Horeca', 'Retail', 'Industrieel', 'Kerk'];

// Query products
$args = [
  'post_type'      => 'tvs_product',
  'posts_per_page' => -1,
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
];
$products = new WP_Query($args);
$product_count = $products->found_posts;
?>

<style>
/* ===== THEME SYSTEM: CSS Custom Properties ===== */
:root {
  --bg: #f9fafb; --bg-card: #ffffff; --bg-card-hover: #f3f4f6;
  --bg-glass: rgba(255,255,255,.8); --bg-sidebar: #ffffff;
  --text: #111827; --text-secondary: #4b5563; --text-muted: #9ca3af;
  --border: #e5e7eb; --border-hover: #d1d5db;
  --shadow: 0 1px 3px rgba(0,0,0,.08); --shadow-lg: 0 12px 32px rgba(0,0,0,.08);
  --orb-opacity: 0.08; --grid-color: rgba(0,0,0,.04);
  --input-bg: #ffffff; --pill-bg: #f3f4f6; --pill-text: #4b5563;
  --pill-border: #e5e7eb; --pill-hover-bg: #e5e7eb; --pill-hover-text: #111827;
  --select-bg: #ffffff; --select-text: #111827; --select-border: #e5e7eb;
  --badge-bg: rgba(255,255,255,.85); --badge-text: #374151; --badge-border: rgba(0,0,0,.1);
  --overlay-bg: rgba(0,0,0,.6);
  --slider-track: #e5e7eb; --slider-fill: #E31E24;
  --hero-text: #111827; --hero-sub: #6b7280;
  --count-bg: rgba(227,30,36,.08); --count-text: #E31E24;
  --img-placeholder: linear-gradient(135deg,#f3f4f6,#e5e7eb);
  --card-overlay: linear-gradient(to top,rgba(0,0,0,.2),transparent);
  --filter-tag-bg: rgba(227,30,36,.1); --filter-tag-text: #b91c1c; --filter-tag-border: rgba(227,30,36,.2);
  --modal-bg: #ffffff; --modal-text: #111827; --modal-secondary: #4b5563;
  --scrollbar-track: #f3f4f6; --scrollbar-thumb: #d1d5db;
}
html.dark {
  --bg: #000000; --bg-card: rgba(255,255,255,.05); --bg-card-hover: rgba(255,255,255,.1);
  --bg-glass: rgba(255,255,255,.05); --bg-sidebar: rgba(255,255,255,.03);
  --text: #ffffff; --text-secondary: #9ca3af; --text-muted: #6b7280;
  --border: rgba(255,255,255,.1); --border-hover: rgba(255,255,255,.2);
  --shadow: none; --shadow-lg: none;
  --orb-opacity: 0.2; --grid-color: rgba(255,255,255,.02);
  --input-bg: rgba(255,255,255,.05); --pill-bg: rgba(255,255,255,.05); --pill-text: #9ca3af;
  --pill-border: rgba(255,255,255,.1); --pill-hover-bg: rgba(255,255,255,.1); --pill-hover-text: #ffffff;
  --select-bg: rgba(255,255,255,.05); --select-text: #ffffff; --select-border: rgba(255,255,255,.1);
  --badge-bg: rgba(255,255,255,.1); --badge-text: #ffffff; --badge-border: rgba(255,255,255,.15);
  --overlay-bg: rgba(0,0,0,.8);
  --slider-track: rgba(255,255,255,.1); --slider-fill: #E31E24;
  --hero-text: #ffffff; --hero-sub: #9ca3af;
  --count-bg: rgba(227,30,36,.15); --count-text: #ff6b6b;
  --img-placeholder: linear-gradient(135deg,rgba(255,255,255,.05),rgba(255,255,255,.02));
  --card-overlay: linear-gradient(to top,rgba(0,0,0,.4),transparent);
  --filter-tag-bg: rgba(227,30,36,.15); --filter-tag-text: #ff8a8a; --filter-tag-border: rgba(227,30,36,.3);
  --modal-bg: #111111; --modal-text: #ffffff; --modal-secondary: #9ca3af;
  --scrollbar-track: rgba(255,255,255,.05); --scrollbar-thumb: rgba(255,255,255,.15);
}

/* ===== BASE ===== */
.producten-page {
  background: var(--bg); color: var(--text); min-height: 100vh;
  position: relative; overflow-x: hidden;
  transition: background-color .3s, color .3s;
}

/* Background orbs + grid */
.producten-bg { position: fixed; inset: 0; z-index: 0; pointer-events: none; opacity: var(--orb-opacity); }
.producten-bg__orb { position: absolute; border-radius: 50%; filter: blur(100px); animation: prodOrb 6s ease-in-out infinite; }
.producten-bg__orb--1 { top: 10%; left: -120px; width: 480px; height: 480px; background: rgba(227,30,36,.3); }
.producten-bg__orb--2 { bottom: 15%; right: -100px; width: 420px; height: 420px; background: rgba(249,115,22,.2); animation-delay: 1s; }
.producten-bg__orb--3 { top: 50%; left: 40%; width: 360px; height: 360px; background: rgba(227,30,36,.15); animation-delay: 2s; }
.producten-bg__grid { position: absolute; inset: 0; background-image: linear-gradient(var(--grid-color) 1px, transparent 1px), linear-gradient(90deg, var(--grid-color) 1px, transparent 1px); background-size: 64px 64px; }
@keyframes prodOrb { 0%,100% { opacity: .5; transform: scale(1); } 50% { opacity: .8; transform: scale(1.08); } }

.producten-content { position: relative; z-index: 1; }

/* ===== HERO ===== */
.prod-hero {
  padding: 8rem 0 3rem; text-align: center;
  background: linear-gradient(180deg, transparent 0%, var(--bg) 100%);
}
.prod-hero h1 {
  font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900;
  color: var(--hero-text); margin: 0; letter-spacing: -.02em;
}
.prod-hero p {
  color: var(--hero-sub); font-size: 1.125rem; margin-top: .75rem;
  max-width: 540px; margin-left: auto; margin-right: auto;
}
.prod-hero__count {
  display: inline-flex; align-items: center; gap: .5rem;
  margin-top: 1.25rem; padding: .5rem 1.25rem;
  background: var(--count-bg); color: var(--count-text);
  border-radius: 9999px; font-size: .875rem; font-weight: 600;
}

/* ===== SIDEBAR LAYOUT ===== */
.prod-layout {
  display: grid; grid-template-columns: 300px 1fr; gap: 2rem;
  align-items: start; padding-bottom: 6rem;
}

/* ===== FILTER PANEL (sidebar) ===== */
.prod-sidebar {
  position: sticky; top: 7rem;
  background: var(--bg-sidebar); border: 1px solid var(--border);
  border-radius: 1.5rem; padding: 1.5rem;
  box-shadow: var(--shadow);
  transition: background-color .3s, border-color .3s, box-shadow .3s;
  max-height: calc(100vh - 8rem); overflow-y: auto;
}
.prod-sidebar::-webkit-scrollbar { width: 6px; }
.prod-sidebar::-webkit-scrollbar-track { background: var(--scrollbar-track); border-radius: 3px; }
.prod-sidebar::-webkit-scrollbar-thumb { background: var(--scrollbar-thumb); border-radius: 3px; }

.prod-sidebar__title {
  font-size: 1rem; font-weight: 700; color: var(--text);
  margin: 0 0 1.25rem; display: flex; align-items: center; gap: .5rem;
}
.prod-sidebar__section { margin-bottom: 1.5rem; }
.prod-sidebar__section:last-child { margin-bottom: 0; }
.prod-sidebar__label {
  display: block; font-size: .75rem; font-weight: 700;
  text-transform: uppercase; letter-spacing: .06em;
  color: var(--text-muted); margin-bottom: .625rem;
}

/* Search */
.prod-search-wrap { position: relative; margin-bottom: 1.5rem; }
.prod-search-icon { position: absolute; left: .875rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); }
.prod-search-input {
  width: 100%; padding: .75rem .875rem .75rem 2.75rem;
  background: var(--input-bg); border: 1px solid var(--border);
  border-radius: .75rem; color: var(--text); font-size: .9375rem;
  transition: border-color .2s, box-shadow .2s;
}
.prod-search-input::placeholder { color: var(--text-muted); }
.prod-search-input:focus { outline: none; border-color: rgba(227,30,36,.5); box-shadow: 0 0 0 3px rgba(227,30,36,.12); }

/* Filter pills */
.prod-pills { display: flex; flex-wrap: wrap; gap: .375rem; }
.prod-pill {
  padding: .375rem .875rem; border-radius: 9999px; font-size: .8125rem; font-weight: 500;
  cursor: pointer; border: 1px solid var(--pill-border);
  background: var(--pill-bg); color: var(--pill-text);
  transition: all .2s; white-space: nowrap;
}
.prod-pill:hover { background: var(--pill-hover-bg); color: var(--pill-hover-text); }
.prod-pill.active { background: linear-gradient(135deg, #E31E24, #f97316); color: #fff; border-color: transparent; }

/* Dropdowns */
.prod-select {
  width: 100%; padding: .75rem 2.5rem .75rem 1rem;
  background: var(--select-bg); border: 1px solid var(--select-border);
  border-radius: .75rem; color: var(--select-text); font-size: .875rem;
  appearance: none; cursor: pointer;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1.5l5 5 5-5' stroke='%239ca3af' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat; background-position: right 1rem center;
  transition: border-color .2s;
}
.prod-select:focus { outline: none; border-color: rgba(227,30,36,.5); }
.prod-select option { background: var(--modal-bg); color: var(--text); }

/* Reset button */
.prod-reset-btn {
  width: 100%; padding: .625rem 1rem;
  background: none; border: 1px solid var(--border);
  border-radius: .75rem; color: var(--text-secondary);
  font-size: .8125rem; font-weight: 600; cursor: pointer;
  transition: all .2s; display: flex; align-items: center; justify-content: center; gap: .5rem;
}
.prod-reset-btn:hover { border-color: #E31E24; color: #E31E24; }

/* Active filter count badge */
.prod-filter-count {
  display: inline-flex; align-items: center; justify-content: center;
  min-width: 1.25rem; height: 1.25rem; padding: 0 .375rem;
  background: linear-gradient(135deg, #E31E24, #f97316); color: #fff;
  border-radius: 9999px; font-size: .6875rem; font-weight: 700;
}
.prod-filter-count:empty,
.prod-filter-count[data-count="0"] { display: none; }

/* ===== MAIN CONTENT AREA ===== */
.prod-main { min-width: 0; }

/* Active filter tags */
.prod-active-filters { display: flex; flex-wrap: wrap; gap: .5rem; margin-bottom: 1.25rem; }
.prod-active-filters:empty { display: none; }
.prod-filter-tag {
  display: inline-flex; align-items: center; gap: .375rem;
  padding: .375rem .75rem; border-radius: 9999px; font-size: .8125rem;
  background: var(--filter-tag-bg); color: var(--filter-tag-text); border: 1px solid var(--filter-tag-border);
}
.prod-filter-tag button {
  background: none; border: none; color: var(--text-muted); cursor: pointer;
  padding: 0; line-height: 1; font-size: 1rem;
}
.prod-filter-tag button:hover { color: var(--text); }

/* Products count bar */
.prod-count-bar {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 1.5rem; font-size: .9375rem; color: var(--text-secondary);
}
.prod-count-bar strong { color: var(--text); }

/* ===== PRODUCTS GRID ===== */
.prod-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; }

/* Product card */
.prod-card {
  background: var(--bg-card); border: 1px solid var(--border);
  border-radius: 1.25rem; overflow: hidden;
  transition: all .3s; cursor: pointer; box-shadow: var(--shadow);
}
.prod-card:hover {
  border-color: rgba(227,30,36,.4); transform: translateY(-4px);
  box-shadow: 0 20px 40px rgba(0,0,0,.12);
}
html.dark .prod-card:hover { box-shadow: 0 20px 40px rgba(0,0,0,.4); }

.prod-card__img {
  position: relative; height: 13rem; overflow: hidden;
  background: var(--img-placeholder);
}
.prod-card__img img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
.prod-card:hover .prod-card__img img { transform: scale(1.06); }
.prod-card__img-overlay { position: absolute; inset: 0; background: var(--card-overlay); }
.prod-card__placeholder { width: 100%; height: 100%; background: var(--img-placeholder); }

/* Card badges */
.prod-card__badges {
  position: absolute; top: .75rem; left: .75rem; right: .75rem;
  display: flex; justify-content: space-between; align-items: flex-start;
}
.prod-card__type-badge {
  padding: .25rem .625rem; border-radius: 9999px; font-size: .6875rem; font-weight: 600;
  background: var(--badge-bg); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
  border: 1px solid var(--badge-border); color: var(--badge-text);
}
.prod-card__featured {
  padding: .25rem .5rem; border-radius: 9999px; font-size: .625rem; font-weight: 700;
  text-transform: uppercase; background: linear-gradient(135deg, #eab308, #f97316);
  color: #000; letter-spacing: .03em;
}

/* Card body */
.prod-card__body { padding: 1rem 1.125rem 1.25rem; }
.prod-card__cat {
  font-size: .6875rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .06em; color: #E31E24;
}
.prod-card__title {
  font-size: 1rem; font-weight: 700; color: var(--text);
  margin: .25rem 0 .375rem; line-height: 1.3; transition: color .2s;
}
.prod-card:hover .prod-card__title { color: #E31E24; }
.prod-card__meta {
  display: flex; align-items: center; gap: .375rem;
  font-size: .75rem; color: var(--text-muted); margin-bottom: .75rem;
}
.prod-card__footer { display: flex; align-items: center; justify-content: space-between; gap: .5rem; }
.prod-card__price { display: flex; flex-direction: column; }
.prod-card__price small { font-size: .6875rem; color: var(--text-muted); }
.prod-card__price strong { font-size: 1.0625rem; font-weight: 900; color: var(--text); }
.prod-card__btn {
  display: inline-flex; align-items: center; gap: .375rem;
  padding: .5rem 1rem; border-radius: 9999px; font-size: .75rem; font-weight: 600;
  background: linear-gradient(135deg, #E31E24, #f97316); color: #fff;
  border: none; cursor: pointer; text-decoration: none;
  transition: all .2s; white-space: nowrap;
}
.prod-card__btn:hover { opacity: .9; transform: scale(1.03); }

/* Empty state */
.prod-empty {
  grid-column: 1/-1; text-align: center; padding: 4rem 2rem;
  background: var(--bg-card); border-radius: 1.25rem; border: 1px solid var(--border);
}
.prod-empty p { color: var(--text-secondary); }
.prod-empty strong { color: var(--text); }

/* No results */
.prod-no-results {
  display: none; grid-column: 1/-1; text-align: center; padding: 3rem 2rem;
  color: var(--text-secondary); font-size: 1rem;
}

/* ===== PRODUCT MODAL ===== */
.prod-modal {
  position: fixed; inset: 0; z-index: 9999;
  display: none; align-items: center; justify-content: center;
  background: var(--overlay-bg); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
  padding: 2rem; opacity: 0; transition: opacity .3s;
}
.prod-modal.is-open { display: flex; opacity: 1; }
.prod-modal__inner {
  background: var(--modal-bg); border-radius: 1.5rem;
  width: 100%; max-width: 900px; max-height: 90vh;
  overflow-y: auto; position: relative;
  box-shadow: 0 32px 64px rgba(0,0,0,.3);
  border: 1px solid var(--border);
  transition: transform .3s; transform: scale(.96);
}
.prod-modal.is-open .prod-modal__inner { transform: scale(1); }
.prod-modal__close {
  position: absolute; top: 1rem; right: 1rem; z-index: 2;
  width: 2.5rem; height: 2.5rem; border-radius: 50%;
  background: var(--bg-card); border: 1px solid var(--border);
  color: var(--text); cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: all .2s; font-size: 1.25rem;
}
.prod-modal__close:hover { background: var(--bg-card-hover); }
.prod-modal__img {
  width: 100%; height: 320px; object-fit: contain;
  border-radius: 1.5rem 1.5rem 0 0;
  background: #0a0a0a; padding: 1rem;
}
.prod-modal__img-placeholder {
  width: 100%; height: 320px;
  background: var(--img-placeholder);
  border-radius: 1.5rem 1.5rem 0 0;
}
.prod-modal__body { padding: 2rem; }
.prod-modal__cat {
  font-size: .75rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .06em; color: #E31E24; margin-bottom: .25rem;
}
.prod-modal__title {
  font-size: 1.5rem; font-weight: 900; color: var(--modal-text);
  margin: 0 0 1rem; line-height: 1.2;
}
.prod-modal__desc { color: var(--modal-secondary); font-size: .9375rem; line-height: 1.7; margin-bottom: 1.5rem; }
.prod-modal__specs {
  display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; margin-bottom: 1.5rem;
}
.prod-modal__spec {
  padding: .75rem 1rem; background: var(--bg-card); border: 1px solid var(--border);
  border-radius: .75rem;
}
.prod-modal__spec-label { font-size: .6875rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--text-muted); }
.prod-modal__spec-value { font-size: .9375rem; font-weight: 600; color: var(--modal-text); margin-top: .125rem; }
.prod-modal__footer {
  display: flex; align-items: center; justify-content: space-between; gap: 1rem;
  padding-top: 1.5rem; border-top: 1px solid var(--border);
}
.prod-modal__price strong { font-size: 1.5rem; font-weight: 900; color: var(--modal-text); }
.prod-modal__price small { font-size: .75rem; color: var(--text-muted); display: block; }
.prod-modal__cta {
  display: inline-flex; align-items: center; gap: .5rem;
  padding: .875rem 2rem; border-radius: .75rem; font-size: .9375rem; font-weight: 700;
  background: linear-gradient(135deg, #E31E24, #ea580c); color: #fff;
  border: none; cursor: pointer; text-decoration: none;
  transition: all .3s; box-shadow: 0 8px 24px rgba(227,30,36,.25);
}
.prod-modal__cta:hover { box-shadow: 0 12px 32px rgba(227,30,36,.35); transform: translateY(-1px); }
.prod-modal__nav {
  position: absolute; top: 50%; transform: translateY(-50%);
  width: 2.5rem; height: 2.5rem; border-radius: 50%;
  background: var(--bg-card); border: 1px solid var(--border);
  color: var(--text); cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: all .2s; z-index: 2;
}
.prod-modal__nav:hover { background: var(--bg-card-hover); }
.prod-modal__nav--prev { left: -3.5rem; }
.prod-modal__nav--next { right: -3.5rem; }

/* ===== RESPONSIVE ===== */
@media (max-width: 1280px) {
  .prod-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 1024px) {
  .prod-layout { grid-template-columns: 260px 1fr; gap: 1.5rem; }
  .prod-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
  .prod-layout { grid-template-columns: 1fr; }
  .prod-sidebar {
    position: relative; top: 0;
    max-height: none;
  }
  .prod-grid { grid-template-columns: repeat(2, 1fr); }
  .prod-hero { padding: 6rem 0 2rem; }
  .prod-modal__nav--prev { left: .5rem; }
  .prod-modal__nav--next { right: .5rem; }
  .prod-modal__specs { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
  .prod-grid { grid-template-columns: 1fr; }
  .prod-hero { padding: 5rem 0 1.5rem; }
  .prod-modal { padding: .5rem; }
  .prod-modal__inner { border-radius: 1rem; }
  .prod-modal__img, .prod-modal__img-placeholder { height: 220px; border-radius: 1rem 1rem 0 0; }
  .prod-modal__body { padding: 1.25rem; }
}
</style>

<div class="producten-page">
  <!-- Fixed background orbs + grid -->
  <div class="producten-bg" aria-hidden="true">
    <div class="producten-bg__orb producten-bg__orb--1"></div>
    <div class="producten-bg__orb producten-bg__orb--2"></div>
    <div class="producten-bg__orb producten-bg__orb--3"></div>
    <div class="producten-bg__grid"></div>
  </div>

  <div class="producten-content">
    <!-- Hero -->
    <section class="prod-hero">
      <div class="container" style="max-width:1280px;margin:0 auto;padding:0 1.5rem">
        <h1>Ons Assortiment</h1>
        <p>Ontdek onze complete collectie verwarmingsoplossingen voor elke toepassing</p>
        <div class="prod-hero__count">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
          <span id="hero-count"><?php echo $product_count; ?> producten</span>
        </div>
      </div>
    </section>

    <!-- Main content: sidebar + grid -->
    <section>
      <div class="container" style="max-width:1280px;margin:0 auto;padding:0 1.5rem">
        <div class="prod-layout">

          <!-- ===== SIDEBAR FILTER PANEL ===== -->
          <aside class="prod-sidebar" id="filter-panel">
            <div class="prod-sidebar__title">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/></svg>
              Filters
              <span class="prod-filter-count" id="filter-count" data-count="0"></span>
            </div>

            <!-- Search -->
            <div class="prod-search-wrap">
              <svg class="prod-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
              <input type="text" id="product-search" placeholder="Zoek producten..." class="prod-search-input">
            </div>

            <!-- Category pills -->
            <div class="prod-sidebar__section">
              <span class="prod-sidebar__label">Categorie</span>
              <div class="prod-pills" id="cat-pills">
                <?php if (!is_wp_error($cats) && !empty($cats)) : ?>
                  <?php foreach ($cats as $cat) : ?>
                    <button type="button" class="prod-pill" data-filter="category" data-value="<?php echo esc_attr($cat->slug); ?>">
                      <?php echo esc_html($cat->name); ?>
                    </button>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>

            <!-- Type pills -->
            <div class="prod-sidebar__section">
              <span class="prod-sidebar__label">Type</span>
              <div class="prod-pills" id="type-pills">
                <?php foreach ($types as $t) : ?>
                  <button type="button" class="prod-pill" data-filter="type" data-value="<?php echo esc_attr($t); ?>">
                    <?php echo esc_html($t); ?>
                  </button>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Brand dropdown -->
            <div class="prod-sidebar__section">
              <label class="prod-sidebar__label" for="filter-brand">Merk</label>
              <select class="prod-select" id="filter-brand">
                <option value="">Alle merken</option>
                <?php if (!is_wp_error($brands) && !empty($brands)) :
                  foreach ($brands as $brand) : ?>
                    <option value="<?php echo esc_attr($brand->slug); ?>"><?php echo esc_html($brand->name); ?></option>
                  <?php endforeach;
                endif; ?>
              </select>
            </div>

            <!-- Application dropdown -->
            <div class="prod-sidebar__section">
              <label class="prod-sidebar__label" for="filter-application">Toepassing</label>
              <select class="prod-select" id="filter-application">
                <option value="">Alle toepassingen</option>
                <?php foreach ($applications as $app) : ?>
                  <option value="<?php echo esc_attr($app); ?>"><?php echo esc_html($app); ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Reset -->
            <div class="prod-sidebar__section">
              <button type="button" class="prod-reset-btn" id="reset-filters">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                Filters wissen
              </button>
            </div>
          </aside>

          <!-- ===== MAIN: GRID ===== -->
          <div class="prod-main">
            <!-- Active filter tags -->
            <div class="prod-active-filters" id="active-filters"></div>

            <!-- Count bar -->
            <div class="prod-count-bar">
              <p id="products-count" style="margin:0"></p>
            </div>

            <!-- Products Grid -->
            <div class="prod-grid" id="products-grid">
              <?php
              if ($products->have_posts()) :
                while ($products->have_posts()) : $products->the_post();
                  $price       = get_post_meta(get_the_ID(), '_tvs_product_price', true);
                  $power       = get_post_meta(get_the_ID(), '_tvs_product_power', true);
                  $type        = get_post_meta(get_the_ID(), '_tvs_product_type', true);
                  $application = get_post_meta(get_the_ID(), '_tvs_product_application', true);
                  $featured    = get_post_meta(get_the_ID(), '_tvs_product_featured', true);
                  $article_nr  = get_post_meta(get_the_ID(), '_tvs_product_article_nr', true);

                  $cat_terms   = wp_get_post_terms(get_the_ID(), 'product_categorie', ['fields' => 'names']);
                  $brand_terms = wp_get_post_terms(get_the_ID(), 'product_merk', ['fields' => 'names']);
                  $cat_slugs   = wp_get_post_terms(get_the_ID(), 'product_categorie', ['fields' => 'slugs']);
                  $brand_slugs = wp_get_post_terms(get_the_ID(), 'product_merk', ['fields' => 'slugs']);

                  $cat_name   = !empty($cat_terms) ? $cat_terms[0] : '';
                  $brand_name = !empty($brand_terms) ? $brand_terms[0] : '';
                  $cat_slug   = !empty($cat_slugs) ? $cat_slugs[0] : '';
                  $brand_slug = !empty($brand_slugs) ? $brand_slugs[0] : '';

                  $thumb_url  = get_the_post_thumbnail_url(get_the_ID(), 'product-card');
                  $content    = get_the_content();
              ?>
                <div class="prod-card"
                     data-category="<?php echo esc_attr($cat_slug); ?>"
                     data-type="<?php echo esc_attr($type); ?>"
                     data-brand="<?php echo esc_attr($brand_slug); ?>"
                     data-application="<?php echo esc_attr($application); ?>"
                     data-name="<?php echo esc_attr(strtolower(get_the_title() . ' ' . $brand_name)); ?>"
                     data-price="<?php echo esc_attr($price); ?>"
                     data-title="<?php echo esc_attr(get_the_title()); ?>"
                     data-cat-name="<?php echo esc_attr($cat_name); ?>"
                     data-brand-name="<?php echo esc_attr($brand_name); ?>"
                     data-power="<?php echo esc_attr($power); ?>"
                     data-article="<?php echo esc_attr($article_nr); ?>"
                     data-permalink="<?php echo esc_url(get_the_permalink()); ?>"
                     data-image="<?php echo esc_url($thumb_url); ?>"
                     data-content="<?php echo esc_attr(wp_strip_all_tags($content)); ?>"
                     data-featured="<?php echo $featured ? '1' : ''; ?>">
                  <div class="prod-card__img">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('product-card', ['loading' => 'lazy']); ?>
                    <?php else : ?>
                      <div class="prod-card__placeholder"></div>
                    <?php endif; ?>
                    <div class="prod-card__img-overlay"></div>
                    <div class="prod-card__badges">
                      <div>
                        <?php if ($type) : ?>
                          <span class="prod-card__type-badge"><?php echo esc_html($type); ?></span>
                        <?php endif; ?>
                      </div>
                      <div>
                        <?php if ($featured) : ?>
                          <span class="prod-card__featured">Top</span>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <div class="prod-card__body">
                    <?php if ($cat_name) : ?>
                      <span class="prod-card__cat"><?php echo esc_html($cat_name); ?></span>
                    <?php endif; ?>
                    <h3 class="prod-card__title"><?php the_title(); ?></h3>
                    <div class="prod-card__meta">
                      <?php if ($brand_name) : ?><span><?php echo esc_html($brand_name); ?></span><?php endif; ?>
                      <?php if ($brand_name && $power) : ?><span>&bull;</span><?php endif; ?>
                      <?php if ($power) : ?><span><?php echo esc_html($power); ?></span><?php endif; ?>
                    </div>
                    <div class="prod-card__footer">
                      <?php if ($price) : ?>
                        <div class="prod-card__price">
                          <small>Vanaf</small>
                          <strong>&euro;<?php echo esc_html($price); ?></strong>
                        </div>
                      <?php else : ?>
                        <div class="prod-card__price">
                          <small>&nbsp;</small>
                          <strong>Op aanvraag</strong>
                        </div>
                      <?php endif; ?>
                      <a href="<?php the_permalink(); ?>" class="prod-card__btn" onclick="event.stopPropagation()">
                        Bekijk
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                      </a>
                    </div>
                  </div>
                </div>
              <?php
                endwhile;
                wp_reset_postdata();
              else :
              ?>
                <div class="prod-empty">
                  <p><strong>Nog geen producten toegevoegd.</strong></p>
                  <p>Producten worden beheerd via het WordPress admin panel.</p>
                </div>
              <?php endif; ?>

              <!-- No results message (shown by JS) -->
              <div class="prod-no-results" id="no-results">
                <p>Geen producten gevonden. Probeer andere zoektermen of filters.</p>
              </div>
            </div>
          </div>

        </div><!-- .prod-layout -->
      </div>
    </section>
  </div>
</div>

<!-- ===== PRODUCT MODAL ===== -->
<div class="prod-modal" id="product-modal" role="dialog" aria-modal="true" aria-label="Product details">
  <div class="prod-modal__inner">
    <button type="button" class="prod-modal__close" id="modal-close" aria-label="Sluiten">&times;</button>
    <button type="button" class="prod-modal__nav prod-modal__nav--prev" id="modal-prev" aria-label="Vorig product">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
    </button>
    <button type="button" class="prod-modal__nav prod-modal__nav--next" id="modal-next" aria-label="Volgend product">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
    </button>
    <div id="modal-image-wrap"></div>
    <div class="prod-modal__body">
      <div class="prod-modal__cat" id="modal-cat"></div>
      <h2 class="prod-modal__title" id="modal-title"></h2>
      <p class="prod-modal__desc" id="modal-desc"></p>
      <div class="prod-modal__specs" id="modal-specs"></div>
      <div class="prod-modal__footer">
        <div class="prod-modal__price" id="modal-price"></div>
        <a href="#" class="prod-modal__cta" id="modal-cta">
          Bekijk product
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  /* ===== ELEMENTS ===== */
  var grid         = document.getElementById('products-grid');
  var searchInput  = document.getElementById('product-search');
  var pills        = document.querySelectorAll('.prod-pill');
  var brandSelect  = document.getElementById('filter-brand');
  var appSelect    = document.getElementById('filter-application');
  var countEl      = document.getElementById('products-count');
  var heroCountEl  = document.getElementById('hero-count');
  var activeEl     = document.getElementById('active-filters');
  var noResults    = document.getElementById('no-results');
  var filterCount  = document.getElementById('filter-count');
  var resetBtn     = document.getElementById('reset-filters');
  var cards        = grid.querySelectorAll('.prod-card');

  /* Modal elements */
  var modal        = document.getElementById('product-modal');
  var modalClose   = document.getElementById('modal-close');
  var modalPrev    = document.getElementById('modal-prev');
  var modalNext    = document.getElementById('modal-next');
  var modalImgWrap = document.getElementById('modal-image-wrap');
  var modalCat     = document.getElementById('modal-cat');
  var modalTitle   = document.getElementById('modal-title');
  var modalDesc    = document.getElementById('modal-desc');
  var modalSpecs   = document.getElementById('modal-specs');
  var modalPrice   = document.getElementById('modal-price');
  var modalCta     = document.getElementById('modal-cta');

  /* ===== STATE ===== */
  var filters = { category: '', type: '', brand: '', application: '', search: '' };
  var visibleCards = [];
  var currentModalIndex = -1;

  /* ===== PILL TOGGLES ===== */
  pills.forEach(function(pill) {
    pill.addEventListener('click', function() {
      var key = this.dataset.filter;
      var val = this.dataset.value;
      if (filters[key] === val) {
        filters[key] = '';
        this.classList.remove('active');
      } else {
        pills.forEach(function(p) { if (p.dataset.filter === key) p.classList.remove('active'); });
        filters[key] = val;
        this.classList.add('active');
      }
      applyFilters();
    });
  });

  /* ===== SEARCH ===== */
  searchInput.addEventListener('input', function() {
    filters.search = this.value.toLowerCase();
    applyFilters();
  });

  /* ===== DROPDOWN FILTERS ===== */
  brandSelect.addEventListener('change', function() { filters.brand = this.value; applyFilters(); });
  appSelect.addEventListener('change', function() { filters.application = this.value; applyFilters(); });

  /* ===== RESET ===== */
  resetBtn.addEventListener('click', function() {
    filters = { category: '', type: '', brand: '', application: '', search: '' };
    pills.forEach(function(p) { p.classList.remove('active'); });
    searchInput.value = '';
    brandSelect.value = '';
    appSelect.value = '';
    applyFilters();
  });

  /* ===== APPLY FILTERS ===== */
  function applyFilters() {
    var visible = 0;
    visibleCards = [];
    cards.forEach(function(card) {
      var show = true;
      if (filters.category && card.dataset.category !== filters.category) show = false;
      if (filters.type && card.dataset.type !== filters.type) show = false;
      if (filters.brand && card.dataset.brand !== filters.brand) show = false;
      if (filters.application && card.dataset.application !== filters.application) show = false;
      if (filters.search && card.dataset.name.indexOf(filters.search) === -1) show = false;
      card.style.display = show ? '' : 'none';
      if (show) { visible++; visibleCards.push(card); }
    });
    countEl.innerHTML = '<strong>' + visible + '</strong> product' + (visible !== 1 ? 'en' : '') + ' gevonden';
    heroCountEl.textContent = visible + ' product' + (visible !== 1 ? 'en' : '');
    noResults.style.display = visible === 0 ? 'block' : 'none';
    updateActiveFilterCount();
    renderActiveFilters();
  }

  /* ===== ACTIVE FILTER COUNT ===== */
  function updateActiveFilterCount() {
    var count = 0;
    if (filters.category) count++;
    if (filters.type) count++;
    if (filters.brand) count++;
    if (filters.application) count++;
    if (filters.search) count++;
    filterCount.textContent = count > 0 ? count : '';
    filterCount.setAttribute('data-count', count);
  }

  /* ===== RENDER ACTIVE FILTER TAGS ===== */
  function renderActiveFilters() {
    var html = '';
    if (filters.category) html += tag('category', pillLabel('category', filters.category));
    if (filters.type) html += tag('type', filters.type);
    if (filters.brand) {
      var opt = brandSelect.options[brandSelect.selectedIndex];
      html += tag('brand', opt ? opt.text : filters.brand);
    }
    if (filters.application) html += tag('application', filters.application);
    if (filters.search) html += tag('search', '"' + filters.search + '"');
    activeEl.innerHTML = html;

    activeEl.querySelectorAll('button').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var key = this.parentElement.dataset.key;
        if (key === 'category' || key === 'type') {
          filters[key] = '';
          pills.forEach(function(p) { if (p.dataset.filter === key) p.classList.remove('active'); });
        } else if (key === 'brand') { filters.brand = ''; brandSelect.value = ''; }
        else if (key === 'application') { filters.application = ''; appSelect.value = ''; }
        else if (key === 'search') { filters.search = ''; searchInput.value = ''; }
        applyFilters();
      });
    });
  }

  function tag(key, label) {
    return '<span class="prod-filter-tag" data-key="' + key + '">' + label + '<button type="button" aria-label="Verwijder filter">&times;</button></span>';
  }

  function pillLabel(filterKey, value) {
    var lbl = value;
    pills.forEach(function(p) { if (p.dataset.filter === filterKey && p.dataset.value === value) lbl = p.textContent.trim(); });
    return lbl;
  }

  /* ===== PRODUCT MODAL ===== */
  /* Open modal on card click */
  cards.forEach(function(card) {
    card.addEventListener('click', function(e) {
      if (e.target.closest('.prod-card__btn')) return;
      var idx = visibleCards.indexOf(card);
      if (idx === -1) return;
      openModal(idx);
    });
  });

  function openModal(index) {
    if (index < 0 || index >= visibleCards.length) return;
    currentModalIndex = index;
    var card = visibleCards[index];

    /* Image */
    var imgSrc = card.dataset.image;
    if (imgSrc) {
      modalImgWrap.innerHTML = '<img class="prod-modal__img" src="' + imgSrc + '" alt="' + escHtml(card.dataset.title) + '">';
    } else {
      modalImgWrap.innerHTML = '<div class="prod-modal__img-placeholder"></div>';
    }

    /* Text */
    modalCat.textContent = card.dataset.catName || '';
    modalTitle.textContent = card.dataset.title || '';
    modalDesc.textContent = card.dataset.content ? card.dataset.content.substring(0, 300) + (card.dataset.content.length > 300 ? '...' : '') : 'Neem contact met ons op voor meer informatie over dit product.';

    /* Specs */
    var specs = '';
    if (card.dataset.brandName) specs += spec('Merk', card.dataset.brandName);
    if (card.dataset.type) specs += spec('Type', card.dataset.type);
    if (card.dataset.power) specs += spec('Vermogen', card.dataset.power);
    if (card.dataset.application) specs += spec('Toepassing', card.dataset.application);
    if (card.dataset.article) specs += spec('Artikelnr.', card.dataset.article);
    if (card.dataset.category) specs += spec('Categorie', card.dataset.catName || card.dataset.category);
    modalSpecs.innerHTML = specs;

    /* Price */
    if (card.dataset.price) {
      modalPrice.innerHTML = '<small>Vanaf</small><strong>\u20AC' + escHtml(card.dataset.price) + '</strong>';
    } else {
      modalPrice.innerHTML = '<small>&nbsp;</small><strong>Op aanvraag</strong>';
    }

    /* CTA link */
    modalCta.href = card.dataset.permalink || '#';

    /* Nav visibility */
    modalPrev.style.display = index > 0 ? 'flex' : 'none';
    modalNext.style.display = index < visibleCards.length - 1 ? 'flex' : 'none';

    /* Show */
    modal.classList.add('is-open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.classList.remove('is-open');
    document.body.style.overflow = '';
    currentModalIndex = -1;
  }

  function spec(label, value) {
    return '<div class="prod-modal__spec"><div class="prod-modal__spec-label">' + escHtml(label) + '</div><div class="prod-modal__spec-value">' + escHtml(value) + '</div></div>';
  }

  function escHtml(str) {
    if (!str) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
  }

  /* Close modal */
  modalClose.addEventListener('click', closeModal);
  modal.addEventListener('click', function(e) {
    if (e.target === modal) closeModal();
  });

  /* Navigation */
  modalPrev.addEventListener('click', function(e) {
    e.stopPropagation();
    if (currentModalIndex > 0) openModal(currentModalIndex - 1);
  });
  modalNext.addEventListener('click', function(e) {
    e.stopPropagation();
    if (currentModalIndex < visibleCards.length - 1) openModal(currentModalIndex + 1);
  });

  /* Keyboard navigation */
  document.addEventListener('keydown', function(e) {
    if (!modal.classList.contains('is-open')) return;
    if (e.key === 'Escape') { closeModal(); }
    else if (e.key === 'ArrowLeft' && currentModalIndex > 0) { openModal(currentModalIndex - 1); }
    else if (e.key === 'ArrowRight' && currentModalIndex < visibleCards.length - 1) { openModal(currentModalIndex + 1); }
  });

  /* ===== INITIAL COUNT ===== */
  applyFilters();
})();
</script>

<?php get_footer(); ?>
