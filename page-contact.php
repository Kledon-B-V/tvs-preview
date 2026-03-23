<?php
/**
 * Template Name: Contact
 */
get_header();

$email   = (string) tvs_cfg('contact.email', 'info@terrasverwarmer.nu');
$phone   = (string) tvs_cfg('contact.phone', '');
$address = (string) tvs_cfg('contact.address', '');
$zip     = (string) tvs_cfg('contact.zipcode', '');
$city    = (string) tvs_cfg('contact.city', '');
$kvk     = (string) tvs_cfg('company.kvk', '');
$hours_week = (string) tvs_cfg('opening_hours.weekdays', '9:00 - 17:00');
$hours_wknd = (string) tvs_cfg('opening_hours.weekend', 'Op afspraak');
?>

<!-- Hero -->
<section class="page-hero">
  <div class="page-hero__bg" aria-hidden="true"></div>
  <div class="container" style="text-align:center">
    <h1>Contact</h1>
    <p class="lead lead--light">Neem contact op voor vrijblijvend advies of een offerte op maat</p>
  </div>
</section>

<!-- Contact Section -->
<section class="section section--white">
  <div class="container">
    <div class="contact-grid">
      <!-- Contact Info -->
      <div class="contact-info">
        <h2>Contactgegevens</h2>

        <div class="contact-items">
          <div class="contact-item">
            <div class="contact-item__icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            </div>
            <div>
              <h3>Adres</h3>
              <p>Terras Verwarmings Specialisten TVSnl B.V</p>
              <p><?php echo esc_html($address); ?></p>
              <p><?php echo esc_html($zip . ' ' . $city); ?></p>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-item__icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
            </div>
            <div>
              <h3>Telefoon</h3>
              <a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-item__icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            </div>
            <div>
              <h3>Email</h3>
              <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-item__icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
            <div>
              <h3>KvK</h3>
              <p><?php echo esc_html($kvk); ?></p>
            </div>
          </div>
        </div>

        <div class="opening-hours">
          <h3>Openingstijden</h3>
          <div class="opening-hours__row">
            <span>Maandag - Vrijdag</span>
            <strong><?php echo esc_html($hours_week); ?></strong>
          </div>
          <div class="opening-hours__row">
            <span>Weekend</span>
            <strong><?php echo esc_html($hours_wknd); ?></strong>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="contact-form-wrap">
        <div class="contact-form-card">
          <h2>Offerte Aanvragen</h2>
          <p class="muted">Vul het formulier in en we nemen binnen 24 uur contact met u op</p>

          <form id="tvs-contact-form" class="contact-form" novalidate>
            <div class="form-row form-row--2">
              <div class="form-group">
                <label for="cf-company">Bedrijfsnaam *</label>
                <input type="text" id="cf-company" name="company" required placeholder="Uw bedrijfsnaam">
              </div>
              <div class="form-group">
                <label for="cf-name">Contactpersoon *</label>
                <input type="text" id="cf-name" name="name" required placeholder="Uw naam">
              </div>
            </div>

            <div class="form-row form-row--2">
              <div class="form-group">
                <label for="cf-email">Email *</label>
                <input type="email" id="cf-email" name="email" required placeholder="uw@email.nl">
              </div>
              <div class="form-group">
                <label for="cf-phone">Telefoon</label>
                <input type="tel" id="cf-phone" name="phone" placeholder="06 12345678">
              </div>
            </div>

            <div class="form-group">
              <label for="cf-subject">Onderwerp *</label>
              <select id="cf-subject" name="subject" required>
                <option value="">Selecteer een onderwerp</option>
                <option value="terrasverwarming">Terrasverwarming</option>
                <option value="halverwarming">Halverwarming</option>
                <option value="kerkverwarming">Kerkverwarming</option>
                <option value="anders">Anders</option>
              </select>
            </div>

            <div class="form-group">
              <label for="cf-message">Bericht *</label>
              <textarea id="cf-message" name="message" rows="6" required placeholder="Vertel ons over uw wensen en project..."></textarea>
            </div>

            <div id="form-feedback" class="form-feedback" style="display:none"></div>

            <button type="submit" class="btn btn-primary btn-lg" style="width:100%">
              Verstuur Aanvraag
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
