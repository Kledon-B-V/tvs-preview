<?php
/**
 * GDPR Cookie Consent Banner
 */

add_action('wp_footer', function () {
  ?>
  <div id="cookie-banner" class="cookie-banner" role="dialog" aria-label="Cookie-instellingen" style="display:none">
    <div class="cookie-banner__inner">
      <h3 class="cookie-banner__title">Cookie-instellingen</h3>
      <p class="cookie-banner__text">
        Wij gebruiken cookies om uw ervaring te verbeteren. U kunt kiezen welke cookies u accepteert.
      </p>

      <div class="cookie-banner__options">
        <label class="cookie-option">
          <input type="checkbox" checked disabled>
          <span class="cookie-option__label">
            <strong>Noodzakelijk</strong>
            <small>Vereist voor de werking van de website</small>
          </span>
        </label>
        <label class="cookie-option">
          <input type="checkbox" id="cc-analytics">
          <span class="cookie-option__label">
            <strong>Analytisch</strong>
            <small>Helpt ons de website te verbeteren</small>
          </span>
        </label>
      </div>

      <div class="cookie-banner__actions">
        <button type="button" class="btn btn-primary" id="cc-accept">Alles accepteren</button>
        <button type="button" class="btn btn-ghost" id="cc-save">Opslaan</button>
        <button type="button" class="btn btn-ghost" id="cc-reject">Weigeren</button>
      </div>
    </div>
  </div>
  <?php
});
