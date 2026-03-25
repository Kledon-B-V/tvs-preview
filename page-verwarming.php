<?php
/**
 * Template Name: Verwarming
 * Hub page for the Verwarming branch (RED theme)
 */
get_header();

$branch = tvs_cfg('branches.verwarming');
$img    = get_template_directory_uri() . '/assets/images/';

// Fetch product categories
$categories = get_terms([
  'taxonomy'   => 'product_categorie',
  'hide_empty' => false,
  'orderby'    => 'name',
  'order'      => 'ASC',
]);
if (is_wp_error($categories)) {
  $categories = [];
}
?>

<style>
/* ===== VERWARMING HUB — Theme system ===== */
:root {
  --bg: #f9fafb; --bg-card: #ffffff; --bg-card-hover: #f3f4f6;
  --text: #111827; --text-secondary: #4b5563; --text-muted: #9ca3af;
  --border: #e5e7eb; --border-hover: #d1d5db;
  --shadow: 0 1px 3px rgba(0,0,0,.08); --shadow-lg: 0 12px 32px rgba(0,0,0,.08);
  --orb-opacity: 0.08;
  --accent: #E31E24; --accent-light: rgba(227,30,36,.08); --accent-text: #b91c1c;
}
html.dark {
  --bg: #000000; --bg-card: rgba(255,255,255,.05); --bg-card-hover: rgba(255,255,255,.1);
  --text: #ffffff; --text-secondary: #9ca3af; --text-muted: #6b7280;
  --border: rgba(255,255,255,.1); --border-hover: rgba(255,255,255,.2);
  --shadow: none; --shadow-lg: none;
  --orb-opacity: 0.2;
  --accent: #E31E24; --accent-light: rgba(227,30,36,.15); --accent-text: #ff6b6b;
}

.verwarming-page { background: var(--bg); color: var(--text); min-height: 100vh; position: relative; overflow-x: hidden; }

/* Background orbs */
.verwarming-bg { position: fixed; inset: 0; z-index: 0; pointer-events: none; opacity: var(--orb-opacity); }
.verwarming-bg__orb { position: absolute; border-radius: 50%; filter: blur(120px); }
.verwarming-bg__orb--1 { width: 600px; height: 600px; background: #E31E24; top: -10%; right: -5%; animation: vOrb1 8s ease-in-out infinite; }
.verwarming-bg__orb--2 { width: 400px; height: 400px; background: #ff6633; bottom: 20%; left: -10%; animation: vOrb2 10s ease-in-out infinite; }
.verwarming-bg__orb--3 { width: 300px; height: 300px; background: #E31E24; top: 50%; right: 30%; animation: vOrb1 12s ease-in-out infinite reverse; }
@keyframes vOrb1 { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-30px); } }
@keyframes vOrb2 { 0%,100% { transform: translateX(0); } 50% { transform: translateX(20px); } }

/* Hero */
.verwarming-hero { position: relative; z-index: 1; padding: 6rem 0 4rem; text-align: center; }
.verwarming-hero__badge { display: inline-flex; align-items: center; gap: .5rem; padding: .5rem 1.25rem; border-radius: 9999px; font-size: .8125rem; font-weight: 600; background: var(--accent-light); color: var(--accent-text); border: 1px solid rgba(227,30,36,.15); margin-bottom: 1.5rem; }
.verwarming-hero__title { font-size: clamp(2.25rem, 5vw, 3.5rem); font-weight: 800; line-height: 1.1; margin: 0 0 1rem; }
.verwarming-hero__title span { background: linear-gradient(135deg, #E31E24, #ff6633); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.verwarming-hero__tagline { font-size: 1.125rem; color: var(--text-secondary); max-width: 600px; margin: 0 auto; line-height: 1.7; }

/* Category cards */
.cat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
@media (max-width: 1024px) { .cat-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 640px) { .cat-grid { grid-template-columns: 1fr; } }

.cat-card { position: relative; background: var(--bg-card); border: 1px solid var(--border); border-radius: 1rem; overflow: hidden; transition: all .3s; text-decoration: none; color: var(--text); display: flex; flex-direction: column; }
.cat-card:hover { border-color: var(--accent); transform: translateY(-4px); box-shadow: 0 12px 32px rgba(227,30,36,.1); }
.cat-card__img { width: 100%; aspect-ratio: 4/3; object-fit: cover; background: var(--bg-card-hover); }
.cat-card__img-placeholder { width: 100%; aspect-ratio: 4/3; background: linear-gradient(135deg, rgba(227,30,36,.08), rgba(255,102,51,.08)); display: flex; align-items: center; justify-content: center; }
.cat-card__img-placeholder svg { width: 48px; height: 48px; color: var(--accent); opacity: .5; }
.cat-card__body { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; }
.cat-card__name { font-size: 1.125rem; font-weight: 700; margin: 0 0 .5rem; }
.cat-card__desc { font-size: .875rem; color: var(--text-secondary); line-height: 1.6; margin: 0 0 1rem; flex: 1; }
.cat-card__footer { display: flex; align-items: center; justify-content: space-between; }
.cat-card__count { font-size: .75rem; font-weight: 600; padding: .25rem .75rem; border-radius: 9999px; background: var(--accent-light); color: var(--accent-text); }
.cat-card__link { font-size: .875rem; font-weight: 600; color: var(--accent); display: inline-flex; align-items: center; gap: .25rem; transition: gap .2s; }
.cat-card:hover .cat-card__link { gap: .5rem; }

/* USP section */
.usp-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; }
@media (max-width: 768px) { .usp-grid { grid-template-columns: 1fr; } }
.usp-card { text-align: center; padding: 2rem 1.5rem; background: var(--bg-card); border: 1px solid var(--border); border-radius: 1rem; }
.usp-card__icon { width: 56px; height: 56px; border-radius: 1rem; background: var(--accent-light); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
.usp-card__icon svg { width: 28px; height: 28px; color: var(--accent); }
.usp-card__title { font-size: 1.125rem; font-weight: 700; margin: 0 0 .5rem; }
.usp-card__desc { font-size: .875rem; color: var(--text-secondary); line-height: 1.6; margin: 0; }

/* CTA section */
.verwarming-cta { background: linear-gradient(135deg, #E31E24, #ff6633); border-radius: 1.5rem; padding: 3rem; text-align: center; color: #fff; }
.verwarming-cta__title { font-size: 1.75rem; font-weight: 800; margin: 0 0 .75rem; }
.verwarming-cta__text { font-size: 1rem; opacity: .9; margin: 0 0 1.5rem; }
.verwarming-cta__btn { display: inline-flex; align-items: center; gap: .5rem; padding: .875rem 2rem; background: #fff; color: #E31E24; font-weight: 700; border-radius: .75rem; text-decoration: none; transition: transform .2s, box-shadow .2s; }
.verwarming-cta__btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.2); }
</style>

<div class="verwarming-page">
  <!-- Background orbs -->
  <div class="verwarming-bg" aria-hidden="true">
    <div class="verwarming-bg__orb verwarming-bg__orb--1"></div>
    <div class="verwarming-bg__orb verwarming-bg__orb--2"></div>
    <div class="verwarming-bg__orb verwarming-bg__orb--3"></div>
  </div>

  <!-- Hero -->
  <section class="verwarming-hero">
    <div class="max-w-7xl mx-auto px-6">
      <div class="verwarming-hero__badge">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2c.5 3.5-1 6-3 8.5C7 13 8.5 16 12 17c3.5-1 5-4 3-6.5C13 8 11.5 5.5 12 2z"/></svg>
        Premium B2B Verwarmingsoplossingen
      </div>
      <h1 class="verwarming-hero__title"><span><?php echo esc_html($branch['label'] ?? 'Verwarming'); ?></span></h1>
      <p class="verwarming-hero__tagline"><?php echo esc_html($branch['description'] ?? ''); ?></p>
    </div>
  </section>

  <!-- Category Cards -->
  <section class="relative z-10 pb-20">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="text-2xl font-bold" style="color: var(--text);">Onze productcategorie&euml;n</h2>
        <p class="mt-2" style="color: var(--text-secondary); font-size: .9375rem;">Ontdek ons complete assortiment professionele verwarmingsoplossingen</p>
      </div>

      <?php if (!empty($categories)) : ?>
      <div class="cat-grid">
        <?php foreach ($categories as $term) :
          $thumb_url = get_term_meta($term->term_id, 'thumbnail_url', true);
          $count     = $term->count;
          $link      = esc_url(home_url('/producten/?categorie=' . $term->slug));
        ?>
        <a href="<?php echo $link; ?>" class="cat-card">
          <?php if ($thumb_url) : ?>
            <img class="cat-card__img" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($term->name); ?>" loading="lazy">
          <?php else : ?>
            <div class="cat-card__img-placeholder">
              <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 2c.5 3.5-1 6-3 8.5C7 13 8.5 16 12 17c3.5-1 5-4 3-6.5C13 8 11.5 5.5 12 2z"/></svg>
            </div>
          <?php endif; ?>
          <div class="cat-card__body">
            <h3 class="cat-card__name"><?php echo esc_html($term->name); ?></h3>
            <p class="cat-card__desc"><?php echo esc_html($term->description ?: 'Bekijk ons aanbod ' . strtolower($term->name)); ?></p>
            <div class="cat-card__footer">
              <?php if ($count > 0) : ?>
                <span class="cat-card__count"><?php echo (int) $count; ?> product<?php echo $count !== 1 ? 'en' : ''; ?></span>
              <?php else : ?>
                <span></span>
              <?php endif; ?>
              <span class="cat-card__link">Bekijk producten <span>&rarr;</span></span>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
      <?php else : ?>
        <p class="text-center" style="color: var(--text-muted);">Productcategorie&euml;n worden binnenkort toegevoegd.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- USP Section -->
  <section class="relative z-10 pb-20">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="text-2xl font-bold" style="color: var(--text);">Waarom TVS?</h2>
      </div>
      <div class="usp-grid">
        <div class="usp-card">
          <div class="usp-card__icon">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          </div>
          <h3 class="usp-card__title">20+ jaar ervaring</h3>
          <p class="usp-card__desc">Al meer dan twee decennia uw specialist in professionele verwarmingsoplossingen voor elk project.</p>
        </div>
        <div class="usp-card">
          <div class="usp-card__icon">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
          </div>
          <h3 class="usp-card__title">A-merken</h3>
          <p class="usp-card__desc">Wij werken uitsluitend met gerenommeerde merken voor gegarandeerde kwaliteit en levensduur.</p>
        </div>
        <div class="usp-card">
          <div class="usp-card__icon">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 0 0-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 0 1 5.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 0 1 9.288 0M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/></svg>
          </div>
          <h3 class="usp-card__title">Persoonlijk advies</h3>
          <p class="usp-card__desc">Vrijblijvend advies op maat. Wij denken mee over de beste oplossing voor uw situatie.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="relative z-10 pb-20">
    <div class="max-w-4xl mx-auto px-6">
      <div class="verwarming-cta">
        <h2 class="verwarming-cta__title">Advies nodig?</h2>
        <p class="verwarming-cta__text">Onze specialisten helpen u graag bij het kiezen van de juiste verwarmingsoplossing.</p>
        <a href="<?php echo esc_url(home_url('/contact/?branch=verwarming')); ?>" class="verwarming-cta__btn">
          Neem contact op
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>
    </div>
  </section>
</div>

<?php get_footer(); ?>
