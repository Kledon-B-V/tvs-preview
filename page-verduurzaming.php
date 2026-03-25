<?php
/**
 * Template Name: Verduurzaming
 * Hub page for the Verduurzaming branch (GREEN theme)
 */
get_header();

$branch = tvs_cfg('branches.verduurzaming');

// Redirect if branch is disabled
if (!$branch || empty($branch['enabled'])) {
  wp_redirect(home_url('/'));
  exit;
}

$img = get_template_directory_uri() . '/assets/images/';

// Fetch diensten
$diensten = get_posts([
  'post_type'      => 'tvs_dienst',
  'posts_per_page' => -1,
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
  'post_status'    => 'publish',
]);
?>

<style>
/* ===== VERDUURZAMING HUB — Theme system ===== */
:root {
  --bg: #f9fafb; --bg-card: #ffffff; --bg-card-hover: #f3f4f6;
  --text: #111827; --text-secondary: #4b5563; --text-muted: #9ca3af;
  --border: #e5e7eb; --border-hover: #d1d5db;
  --shadow: 0 1px 3px rgba(0,0,0,.08); --shadow-lg: 0 12px 32px rgba(0,0,0,.08);
  --orb-opacity: 0.08;
  --accent: #22c55e; --accent-light: rgba(34,197,94,.08); --accent-text: #15803d;
  --accent-secondary: #16a34a;
}
html.dark {
  --bg: #000000; --bg-card: rgba(255,255,255,.05); --bg-card-hover: rgba(255,255,255,.1);
  --text: #ffffff; --text-secondary: #9ca3af; --text-muted: #6b7280;
  --border: rgba(255,255,255,.1); --border-hover: rgba(255,255,255,.2);
  --shadow: none; --shadow-lg: none;
  --orb-opacity: 0.2;
  --accent: #22c55e; --accent-light: rgba(34,197,94,.15); --accent-text: #4ade80;
  --accent-secondary: #16a34a;
}

.verduurzaming-page { background: var(--bg); color: var(--text); min-height: 100vh; position: relative; overflow-x: hidden; }

/* Background orbs */
.verduurzaming-bg { position: fixed; inset: 0; z-index: 0; pointer-events: none; opacity: var(--orb-opacity); }
.verduurzaming-bg__orb { position: absolute; border-radius: 50%; filter: blur(120px); }
.verduurzaming-bg__orb--1 { width: 600px; height: 600px; background: #22c55e; top: -10%; right: -5%; animation: gOrb1 8s ease-in-out infinite; }
.verduurzaming-bg__orb--2 { width: 400px; height: 400px; background: #16a34a; bottom: 20%; left: -10%; animation: gOrb2 10s ease-in-out infinite; }
.verduurzaming-bg__orb--3 { width: 300px; height: 300px; background: #22c55e; top: 50%; right: 30%; animation: gOrb1 12s ease-in-out infinite reverse; }
@keyframes gOrb1 { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-30px); } }
@keyframes gOrb2 { 0%,100% { transform: translateX(0); } 50% { transform: translateX(20px); } }

/* Hero */
.verduurzaming-hero { position: relative; z-index: 1; padding: 6rem 0 4rem; text-align: center; }
.verduurzaming-hero__badge { display: inline-flex; align-items: center; gap: .5rem; padding: .5rem 1.25rem; border-radius: 9999px; font-size: .8125rem; font-weight: 600; background: var(--accent-light); color: var(--accent-text); border: 1px solid rgba(34,197,94,.15); margin-bottom: 1.5rem; }
.verduurzaming-hero__title { font-size: clamp(2.25rem, 5vw, 3.5rem); font-weight: 800; line-height: 1.1; margin: 0 0 1rem; }
.verduurzaming-hero__title span { background: linear-gradient(135deg, #22c55e, #16a34a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.verduurzaming-hero__tagline { font-size: 1.125rem; color: var(--text-secondary); max-width: 600px; margin: 0 auto; line-height: 1.7; }

/* Dienst cards */
.dienst-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; max-width: 56rem; margin: 0 auto; }
@media (max-width: 768px) { .dienst-grid { grid-template-columns: 1fr; } }

.dienst-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 1rem; overflow: hidden; transition: all .3s; display: flex; flex-direction: column; }
.dienst-card:hover { border-color: var(--accent); transform: translateY(-4px); box-shadow: 0 12px 32px rgba(34,197,94,.1); }
.dienst-card__img { width: 100%; aspect-ratio: 16/9; object-fit: cover; }
.dienst-card__img-placeholder { width: 100%; aspect-ratio: 16/9; background: linear-gradient(135deg, rgba(34,197,94,.08), rgba(22,163,74,.08)); display: flex; align-items: center; justify-content: center; }
.dienst-card__img-placeholder svg { width: 48px; height: 48px; color: var(--accent); opacity: .5; }
.dienst-card__body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
.dienst-card__title { font-size: 1.25rem; font-weight: 700; margin: 0 0 .75rem; color: var(--text); }
.dienst-card__excerpt { font-size: .875rem; color: var(--text-secondary); line-height: 1.6; margin: 0 0 1rem; }
.dienst-card__features { list-style: none; margin: 0 0 1.25rem; padding: 0; display: flex; flex-direction: column; gap: .5rem; flex: 1; }
.dienst-card__feature { display: flex; align-items: flex-start; gap: .5rem; font-size: .8125rem; color: var(--text-secondary); }
.dienst-card__feature svg { flex-shrink: 0; width: 18px; height: 18px; color: var(--accent); margin-top: 1px; }
.dienst-card__cta { display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.5rem; background: var(--accent); color: #fff; font-weight: 600; font-size: .875rem; border-radius: .75rem; text-decoration: none; transition: all .2s; align-self: flex-start; }
.dienst-card__cta:hover { opacity: .9; transform: translateY(-1px); }

/* Process / Hoe werkt het */
.process-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; }
@media (max-width: 768px) { .process-grid { grid-template-columns: 1fr; } }
.process-card { text-align: center; padding: 2rem 1.5rem; }
.process-card__step { width: 56px; height: 56px; border-radius: 50%; background: var(--accent-light); border: 2px solid var(--accent); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.25rem; font-weight: 800; color: var(--accent-text); }
.process-card__title { font-size: 1.125rem; font-weight: 700; margin: 0 0 .5rem; }
.process-card__desc { font-size: .875rem; color: var(--text-secondary); line-height: 1.6; margin: 0; }

/* CTA section */
.verduurzaming-cta { background: linear-gradient(135deg, #22c55e, #16a34a); border-radius: 1.5rem; padding: 3rem; text-align: center; color: #fff; }
.verduurzaming-cta__title { font-size: 1.75rem; font-weight: 800; margin: 0 0 .75rem; }
.verduurzaming-cta__text { font-size: 1rem; opacity: .9; margin: 0 0 1.5rem; }
.verduurzaming-cta__btn { display: inline-flex; align-items: center; gap: .5rem; padding: .875rem 2rem; background: #fff; color: #16a34a; font-weight: 700; border-radius: .75rem; text-decoration: none; transition: transform .2s, box-shadow .2s; }
.verduurzaming-cta__btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.2); }
</style>

<div class="verduurzaming-page">
  <!-- Background orbs -->
  <div class="verduurzaming-bg" aria-hidden="true">
    <div class="verduurzaming-bg__orb verduurzaming-bg__orb--1"></div>
    <div class="verduurzaming-bg__orb verduurzaming-bg__orb--2"></div>
    <div class="verduurzaming-bg__orb verduurzaming-bg__orb--3"></div>
  </div>

  <!-- Hero -->
  <section class="verduurzaming-hero">
    <div class="max-w-7xl mx-auto px-6">
      <div class="verduurzaming-hero__badge">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        Duurzame Energie Oplossingen
      </div>
      <h1 class="verduurzaming-hero__title"><span><?php echo esc_html($branch['label'] ?? 'Verduurzaming'); ?></span></h1>
      <p class="verduurzaming-hero__tagline"><?php echo esc_html($branch['description'] ?? ''); ?></p>
    </div>
  </section>

  <!-- Diensten Cards -->
  <section class="relative z-10 pb-20">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="text-2xl font-bold" style="color: var(--text);">Onze diensten</h2>
        <p class="mt-2" style="color: var(--text-secondary); font-size: .9375rem;">Advies, installatie en onderhoud op maat</p>
      </div>

      <?php if (!empty($diensten)) : ?>
      <div class="dienst-grid">
        <?php foreach ($diensten as $dienst) :
          $thumb_id  = get_post_thumbnail_id($dienst->ID);
          $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'product-card') : '';
          $excerpt   = $dienst->post_excerpt ?: wp_trim_words($dienst->post_content, 20, '...');
          $features_raw = get_post_meta($dienst->ID, '_tvs_dienst_features', true);
          $features  = $features_raw ? array_filter(array_map('trim', explode('|', $features_raw))) : [];
        ?>
        <div class="dienst-card">
          <?php if ($thumb_url) : ?>
            <img class="dienst-card__img" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($dienst->post_title); ?>" loading="lazy">
          <?php else : ?>
            <div class="dienst-card__img-placeholder">
              <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"/></svg>
            </div>
          <?php endif; ?>
          <div class="dienst-card__body">
            <h3 class="dienst-card__title"><?php echo esc_html($dienst->post_title); ?></h3>
            <?php if ($excerpt) : ?>
              <p class="dienst-card__excerpt"><?php echo esc_html($excerpt); ?></p>
            <?php endif; ?>
            <?php if (!empty($features)) : ?>
              <ul class="dienst-card__features">
                <?php foreach ($features as $feature) : ?>
                  <li class="dienst-card__feature">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    <?php echo esc_html($feature); ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <a href="<?php echo esc_url(home_url('/contact/?branch=verduurzaming')); ?>" class="dienst-card__cta">
              Vraag advies aan
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php else : ?>
        <p class="text-center" style="color: var(--text-muted);">Diensten worden binnenkort toegevoegd.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Process: Hoe werkt het? -->
  <section class="relative z-10 pb-20">
    <div class="max-w-4xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="text-2xl font-bold" style="color: var(--text);">Hoe werkt het?</h2>
        <p class="mt-2" style="color: var(--text-secondary); font-size: .9375rem;">In drie stappen naar een duurzame oplossing</p>
      </div>
      <div class="process-grid">
        <div class="process-card">
          <div class="process-card__step">1</div>
          <h3 class="process-card__title">Adviesgesprek</h3>
          <p class="process-card__desc">Wij analyseren uw situatie en bespreken de mogelijkheden. Vrijblijvend en zonder verplichtingen.</p>
        </div>
        <div class="process-card">
          <div class="process-card__step">2</div>
          <h3 class="process-card__title">Offerte op maat</h3>
          <p class="process-card__desc">U ontvangt een heldere offerte met een compleet plan afgestemd op uw wensen en budget.</p>
        </div>
        <div class="process-card">
          <div class="process-card__step">3</div>
          <h3 class="process-card__title">Installatie</h3>
          <p class="process-card__desc">Onze gecertificeerde monteurs zorgen voor een vakkundige installatie met minimale overlast.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="relative z-10 pb-20">
    <div class="max-w-4xl mx-auto px-6">
      <div class="verduurzaming-cta">
        <h2 class="verduurzaming-cta__title">Klaar voor een duurzame stap?</h2>
        <p class="verduurzaming-cta__text">Neem contact op voor een vrijblijvend adviesgesprek en ontdek wat verduurzaming voor u kan betekenen.</p>
        <a href="<?php echo esc_url(home_url('/contact/?branch=verduurzaming')); ?>" class="verduurzaming-cta__btn">
          Neem contact op
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>
    </div>
  </section>
</div>

<?php get_footer(); ?>
