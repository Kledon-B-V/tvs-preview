<?php
/**
 * Template Name: Over Ons
 */
get_header();
?>

<!-- Hero – dark (bg-gray-900) -->
<section class="page-hero">
  <div class="page-hero__bg" aria-hidden="true"></div>
  <div class="container" style="text-align:center">
    <h1>Over TVS</h1>
    <p class="lead lead--light" style="color:var(--gray-300)">Specialist in professionele verwarmingsoplossingen voor B2B</p>
  </div>
</section>

<!-- About Content – light (bg-white) -->
<section class="section section--white">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-12);align-items:center;max-width:1000px;margin:0 auto">
      <div>
        <h2 style="color:var(--gray-900)">Terras Verwarmings Specialisten</h2>
        <p style="color:var(--gray-700)">
          Wij zijn niet alleen een bedrijf dat gespecialiseerd is in de verkoop en het installeren
          van verwarmingsinstallaties voor terrassen, sport- en tribunes, bedrijfshallen, kerken e.a.,
          maar leveren en monteren ook zonnepanelen.
        </p>
        <p style="color:var(--gray-700)">Tevens hebben wij onze producten uitgebreid met de LED-collectie.</p>
        <p style="color:var(--gray-700)">Wij leveren aan de zakelijke markt.</p>
        <p style="color:var(--gray-700)">
          Bij de hedendaagse Horeca ondernemer bijvoorbeeld, is een goed en sfeervol ingericht terras
          niet meer weg te denken. De ervaring leert dat deze extra service door alle klanten het eerst
          wordt gezocht en wel een hogere prijs biedt dan elders. Nederland, met zijn wisselende
          temperaturen en weersverwachtingen, stellen u, als ondernemer, toch in staat om het gehele
          jaar het terras te benutten door het plaatsen van terrasverwarming van TVS.
        </p>
      </div>
      <div>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-team.jpg"
             alt="Het TVS team"
             style="width:100%;border-radius:var(--radius-xl);box-shadow:0 4px 24px rgba(0,0,0,.08)"
             loading="lazy">
      </div>
    </div>
  </div>
</section>

<!-- Stats – light (bg-gray-50) -->
<section class="section" style="background:var(--gray-50)" data-animate="reveal">
  <div class="container">
    <div class="stats-grid" data-animate="stagger">
      <div class="stat-card">
        <div class="stat-card__icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        </div>
        <span class="stat-card__num">20+</span>
        <span class="stat-card__label">Jaar Ervaring</span>
      </div>
      <div class="stat-card">
        <div class="stat-card__icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
        </div>
        <span class="stat-card__num">1000+</span>
        <span class="stat-card__label">Tevreden Klanten</span>
      </div>
      <div class="stat-card">
        <div class="stat-card__icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
        </div>
        <span class="stat-card__num">A-Merken</span>
        <span class="stat-card__label">Premium Kwaliteit</span>
      </div>
      <div class="stat-card">
        <div class="stat-card__icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        </div>
        <span class="stat-card__num">100%</span>
        <span class="stat-card__label">Maatwerk Service</span>
      </div>
    </div>
  </div>
</section>

<!-- Values – light (bg-white) -->
<section class="section section--white">
  <div class="container" style="max-width:800px">
    <h2 style="text-align:center;margin-bottom:48px;color:var(--gray-900)">Onze Kernwaarden</h2>
    <div class="values-grid">
      <div class="value-item">
        <h3 style="color:var(--gray-900)">Vakmanschap</h3>
        <p style="color:var(--gray-700)">Jarenlange ervaring en kennis van verwarmingsoplossingen voor elke situatie.</p>
      </div>
      <div class="value-item">
        <h3 style="color:var(--gray-900)">Kwaliteit</h3>
        <p style="color:var(--gray-700)">Alleen premium merken en producten met uitstekende garanties.</p>
      </div>
      <div class="value-item">
        <h3 style="color:var(--gray-900)">Service</h3>
        <p style="color:var(--gray-700)">Persoonlijk advies en support, voor, tijdens en na levering.</p>
      </div>
      <div class="value-item">
        <h3 style="color:var(--gray-900)">Betrouwbaarheid</h3>
        <p style="color:var(--gray-700)">Nakomen van afspraken en leveren van wat we beloven.</p>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
