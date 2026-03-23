<?php
/**
 * Single product template — theme-aware (dark/light)
 */
get_header();

if (have_posts()) : while (have_posts()) : the_post();
  $price       = get_post_meta(get_the_ID(), '_tvs_product_price', true);
  $power       = get_post_meta(get_the_ID(), '_tvs_product_power', true);
  $type        = get_post_meta(get_the_ID(), '_tvs_product_type', true);
  $application = get_post_meta(get_the_ID(), '_tvs_product_application', true);
  $article_nr  = get_post_meta(get_the_ID(), '_tvs_product_article_nr', true);
  $cat_terms   = wp_get_post_terms(get_the_ID(), 'product_categorie', ['fields' => 'names']);
  $brand_terms = wp_get_post_terms(get_the_ID(), 'product_merk', ['fields' => 'names']);
  $brochure    = get_post_meta(get_the_ID(), '_tvs_product_brochure', true);

  // Features: try custom field first, fallback to defaults
  $features_raw = get_post_meta(get_the_ID(), '_tvs_product_features', true);
  if (!empty($features_raw)) {
    $features = array_filter(array_map('trim', explode("\n", $features_raw)));
  } else {
    $features = [
      'Hoogwaardig RVS behuizing',
      'IP65 weerbestendig',
      'Energiezuinig infrarood',
      'Geluidsarm < 40dB',
      'Eenvoudige wandmontage',
      'Direct warmtegevoel',
    ];
  }
?>

<style>
/* ===== THEME SYSTEM: CSS Custom Properties ===== */
:root {
  --bg: #f9fafb; --bg-card: #ffffff; --bg-card-hover: #f3f4f6;
  --bg-glass: rgba(255,255,255,.8);
  --text: #111827; --text-secondary: #4b5563; --text-muted: #9ca3af;
  --border: #e5e7eb; --border-hover: #d1d5db;
  --shadow: 0 1px 3px rgba(0,0,0,.08); --shadow-lg: 0 12px 32px rgba(0,0,0,.08);
  --spec-border: #f3f4f6;
}
html.dark {
  --bg: #000000; --bg-card: rgba(255,255,255,.05); --bg-card-hover: rgba(255,255,255,.1);
  --bg-glass: rgba(255,255,255,.05);
  --text: #ffffff; --text-secondary: #9ca3af; --text-muted: #6b7280;
  --border: rgba(255,255,255,.1); --border-hover: rgba(255,255,255,.2);
  --shadow: none; --shadow-lg: none;
  --spec-border: rgba(255,255,255,.08);
}

/* Product Detail Layout */
.product-detail {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-12, 3rem);
  align-items: start;
}
@media (max-width: 768px) {
  .product-detail { grid-template-columns: 1fr; gap: var(--space-8, 2rem); }
}

/* Glass card */
.pdp-glass {
  background: var(--bg-card);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg, 1rem);
  padding: var(--space-6, 1.5rem);
  transition: background-color .3s, border-color .3s;
}

/* Breadcrumb */
.pdp-breadcrumb {
  display: flex;
  align-items: center;
  gap: .5rem;
  font-size: var(--text-sm, .875rem);
  color: var(--text-muted);
  margin-bottom: var(--space-4, 1rem);
  flex-wrap: wrap;
}
.pdp-breadcrumb a {
  color: var(--text-secondary);
  transition: color .3s;
  text-decoration: none;
}
.pdp-breadcrumb a:hover {
  color: var(--text);
}
.pdp-breadcrumb .sep {
  color: var(--text-muted);
  font-size: .75rem;
}
.pdp-breadcrumb .current {
  color: var(--text);
  font-weight: 500;
}

/* Specs grid */
.pdp-specs-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3, .75rem);
}
@media (max-width: 480px) {
  .pdp-specs-grid { grid-template-columns: 1fr; }
}
.pdp-spec-item {
  background: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: var(--radius-md, .75rem);
  padding: var(--space-4, 1rem);
  transition: background-color .3s, border-color .3s;
}
.pdp-spec-item .spec-label {
  display: block;
  font-size: var(--text-xs, .75rem);
  color: var(--text-muted);
  text-transform: uppercase;
  letter-spacing: .06em;
  margin-bottom: .25rem;
}
.pdp-spec-item .spec-value {
  font-size: var(--text-base, 1rem);
  font-weight: 600;
  color: var(--text);
}

/* Features checklist */
.pdp-features {
  list-style: none;
  padding: 0;
  margin: 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3, .75rem);
}
@media (max-width: 480px) {
  .pdp-features { grid-template-columns: 1fr; }
}
.pdp-features li {
  display: flex;
  align-items: center;
  gap: .625rem;
  font-size: var(--text-sm, .875rem);
  color: var(--text);
}
.pdp-features .check-icon {
  flex-shrink: 0;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: linear-gradient(135deg, #E31E24, #ea580c);
  display: flex;
  align-items: center;
  justify-content: center;
}
.pdp-features .check-icon svg {
  width: 12px;
  height: 12px;
  color: #fff;
}

/* CTA buttons */
.pdp-btn-gradient {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: .5rem;
  width: 100%;
  padding: 1rem 2rem;
  background: linear-gradient(135deg, #E31E24, #ea580c);
  color: #fff;
  border: none;
  border-radius: var(--radius-lg, .75rem);
  font-size: var(--text-base, 1rem);
  font-weight: 700;
  cursor: pointer;
  text-decoration: none;
  box-shadow: 0 8px 24px rgba(227,30,36,.25);
  transition: all .3s;
}
.pdp-btn-gradient:hover {
  box-shadow: 0 12px 32px rgba(227,30,36,.35);
  transform: translateY(-1px);
}
.pdp-btn-ghost {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: .5rem;
  width: 100%;
  padding: 1rem 2rem;
  background: transparent;
  color: var(--text);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg, .75rem);
  font-size: var(--text-base, 1rem);
  font-weight: 700;
  cursor: pointer;
  text-decoration: none;
  transition: all .3s;
}
.pdp-btn-ghost:hover {
  background: var(--bg-card);
  border-color: var(--border-hover);
}

/* Image */
.product-detail__img {
  border-radius: var(--radius-3xl, 1.5rem);
  width: 100%;
  object-fit: cover;
  aspect-ratio: 1 / 1;
  background: var(--bg-card);
}
.product-detail__placeholder {
  width: 100%;
  aspect-ratio: 1 / 1;
  border-radius: var(--radius-3xl, 1.5rem);
  background: var(--bg-card);
  border: 1px solid var(--border);
}
</style>

<!-- Product Hero -->
<section class="page-hero page-hero--sm">
  <div class="page-hero__bg" aria-hidden="true"></div>
  <div class="container">
    <nav class="pdp-breadcrumb" aria-label="Breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Home
      </a>
      <span class="sep">/</span>
      <a href="<?php echo esc_url(home_url('/producten/')); ?>">Producten</a>
      <?php if (!empty($cat_terms)) : ?>
        <span class="sep">/</span>
        <a href="<?php echo esc_url(home_url('/producten/')); ?>"><?php echo esc_html($cat_terms[0]); ?></a>
      <?php endif; ?>
      <span class="sep">/</span>
      <span class="current"><?php the_title(); ?></span>
    </nav>
  </div>
</section>

<!-- Product Detail -->
<section style="background:var(--bg);padding:0 0 var(--space-24, 6rem);transition:background-color .3s">
  <div class="container">
    <div class="product-detail" data-animate="reveal">

      <!-- Gallery -->
      <div class="product-detail__gallery">
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('product-large', [
            'class' => 'product-detail__img',
          ]); ?>
        <?php else : ?>
          <div class="product-detail__placeholder"></div>
        <?php endif; ?>
      </div>

      <!-- Info -->
      <div class="product-detail__info">
        <?php if (!empty($cat_terms)) : ?>
          <span style="display:inline-block;font-size:var(--text-xs, .75rem);font-weight:600;color:var(--red-500, #E31E24);text-transform:uppercase;letter-spacing:.08em;margin-bottom:var(--space-3, .75rem)">
            <?php echo esc_html($cat_terms[0]); ?>
          </span>
        <?php endif; ?>

        <h1 style="color:var(--text);font-size:var(--text-4xl, 2.25rem);margin-bottom:var(--space-2, .5rem);transition:color .3s"><?php the_title(); ?></h1>

        <?php if (!empty($brand_terms)) : ?>
          <p style="color:var(--text-secondary);font-size:var(--text-lg, 1.125rem);margin:0 0 var(--space-8, 2rem);transition:color .3s">
            <?php echo esc_html($brand_terms[0]); ?>
            <?php if ($type) : ?> &middot; <?php echo esc_html($type); ?><?php endif; ?>
          </p>
        <?php endif; ?>

        <!-- Price Card -->
        <?php if ($price) : ?>
          <div class="pdp-glass" style="margin-bottom:var(--space-6, 1.5rem)">
            <small style="display:block;font-size:var(--text-sm, .875rem);color:var(--text-muted);margin-bottom:var(--space-1, .25rem)">Vanaf</small>
            <strong style="font-size:var(--text-4xl, 2.25rem);font-weight:800;color:var(--text)">&euro;<?php echo esc_html($price); ?></strong>
            <span style="display:block;font-size:var(--text-xs, .75rem);color:var(--text-muted);margin-top:var(--space-1, .25rem)">Excl. BTW &middot; B2B prijs</span>
          </div>
        <?php endif; ?>

        <!-- Features Checklist -->
        <?php if (!empty($features)) : ?>
          <div style="margin-bottom:var(--space-6, 1.5rem)">
            <h3 style="color:var(--text);font-size:var(--text-xs, .75rem);font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin-bottom:var(--space-3, .75rem);transition:color .3s">Kenmerken</h3>
            <ul class="pdp-features">
              <?php foreach (array_slice($features, 0, 6) as $feat) : ?>
                <li>
                  <span class="check-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                  </span>
                  <?php echo esc_html($feat); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <!-- Specifications Glass Card Grid -->
        <div style="margin-bottom:var(--space-8, 2rem)">
          <h3 style="color:var(--text);font-size:var(--text-xs, .75rem);font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin-bottom:var(--space-3, .75rem);transition:color .3s">Specificaties</h3>

          <div class="pdp-specs-grid">
            <?php if (!empty($brand_terms)) : ?>
              <div class="pdp-spec-item">
                <span class="spec-label">Merk</span>
                <span class="spec-value"><?php echo esc_html($brand_terms[0]); ?></span>
              </div>
            <?php endif; ?>
            <?php if ($type) : ?>
              <div class="pdp-spec-item">
                <span class="spec-label">Type</span>
                <span class="spec-value"><?php echo esc_html($type); ?></span>
              </div>
            <?php endif; ?>
            <?php if ($power) : ?>
              <div class="pdp-spec-item">
                <span class="spec-label">Vermogen</span>
                <span class="spec-value"><?php echo esc_html($power); ?></span>
              </div>
            <?php endif; ?>
            <?php if ($application) : ?>
              <div class="pdp-spec-item">
                <span class="spec-label">Toepassing</span>
                <span class="spec-value"><?php echo esc_html($application); ?></span>
              </div>
            <?php endif; ?>
            <?php if ($article_nr) : ?>
              <div class="pdp-spec-item">
                <span class="spec-label">Artikelnummer</span>
                <span class="spec-value"><?php echo esc_html($article_nr); ?></span>
              </div>
            <?php endif; ?>
            <?php if (!empty($cat_terms)) : ?>
              <div class="pdp-spec-item">
                <span class="spec-label">Categorie</span>
                <span class="spec-value"><?php echo esc_html($cat_terms[0]); ?></span>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- CTA: Offerte Aanvragen gradient button -->
        <a href="<?php echo esc_url(home_url('/contact/?product=' . urlencode(get_the_title()))); ?>" class="pdp-btn-gradient">
          Offerte Aanvragen <span>&rarr;</span>
        </a>

        <!-- CTA: Brochure ghost button -->
        <?php
          $brochure_url = !empty($brochure) ? $brochure : home_url('/contact/?type=brochure&product=' . urlencode(get_the_title()));
        ?>
        <a href="<?php echo esc_url($brochure_url); ?>" class="pdp-btn-ghost" style="margin-top:var(--space-3, .75rem)" <?php if (!empty($brochure)) echo 'target="_blank" rel="noopener"'; ?>>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
          Brochure Downloaden
        </a>
      </div>
    </div>

    <!-- Product Description -->
    <?php $content = get_the_content(); if (!empty(trim($content))) : ?>
      <div style="margin-top:var(--space-16, 4rem);max-width:800px" data-animate="reveal">
        <h2 style="color:var(--text);font-size:var(--text-2xl, 1.5rem);margin-bottom:var(--space-6, 1.5rem);transition:color .3s">Productomschrijving</h2>
        <div class="product-detail__content" style="color:var(--text-secondary);line-height:1.8;transition:color .3s">
          <?php the_content(); ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- CTA Strip -->
<section class="section cta-section" data-animate="reveal">
  <div class="cta-bg" aria-hidden="true">
    <div class="cta-overlay"></div>
  </div>
  <div class="container">
    <div class="cta-card glass" style="text-align:center">
      <h2 style="color:var(--text);transition:color .3s">Interesse in dit product?</h2>
      <p class="lead lead--light" style="max-width:560px;margin:0 auto var(--space-8, 2rem);color:var(--text-secondary)">
        Neem contact op voor een vrijblijvende offerte of persoonlijk advies over dit product.
      </p>
      <div class="hero-ctas" style="justify-content:center">
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-white btn-lg">
          Offerte Aanvragen <span class="btn-arrow">&rarr;</span>
        </a>
        <a href="<?php echo esc_url(home_url('/producten/')); ?>" class="btn btn-glass-white btn-lg">
          Meer Producten
        </a>
      </div>
    </div>
  </div>
</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
