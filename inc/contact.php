<?php
/**
 * Contact form AJAX handler
 */

add_action('wp_ajax_tvs_contact', 'tvs_handle_contact');
add_action('wp_ajax_nopriv_tvs_contact', 'tvs_handle_contact');

function tvs_handle_contact() {
  // Nonce check
  if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'tvs_contact_nonce')) {
    wp_send_json_error(['message' => 'Beveiligingscontrole mislukt.'], 403);
  }

  // Required fields
  $company = sanitize_text_field($_POST['company'] ?? '');
  $name    = sanitize_text_field($_POST['name'] ?? '');
  $email   = sanitize_email($_POST['email'] ?? '');
  $phone   = sanitize_text_field($_POST['phone'] ?? '');
  $subject = sanitize_text_field($_POST['subject'] ?? '');
  $message = sanitize_textarea_field($_POST['message'] ?? '');

  if (!$name || !$email || !$subject || !$message) {
    wp_send_json_error(['message' => 'Vul alle verplichte velden in.'], 400);
  }

  if (!is_email($email)) {
    wp_send_json_error(['message' => 'Ongeldig e-mailadres.'], 400);
  }

  // Rate limiting
  $ip_key = 'tvs_contact_' . md5($_SERVER['REMOTE_ADDR'] ?? 'unknown');
  if (get_transient($ip_key)) {
    wp_send_json_error(['message' => 'U heeft recent al een bericht gestuurd. Probeer het later opnieuw.'], 429);
  }
  set_transient($ip_key, 1, 60);

  // Send email to admin
  $to = tvs_cfg('contact.email', 'info@terrasverwarmer.nu');
  $email_subject = 'Offerte aanvraag: ' . $subject . ' — ' . $company;

  $body  = "Nieuw contactformulier bericht:\n\n";
  $body .= "Bedrijf: {$company}\n";
  $body .= "Naam: {$name}\n";
  $body .= "Email: {$email}\n";
  $body .= "Telefoon: {$phone}\n";
  $body .= "Onderwerp: {$subject}\n\n";
  $body .= "Bericht:\n{$message}\n";

  $headers = [
    'From: TVS Website <wordpress@' . ($_SERVER['HTTP_HOST'] ?? 'terrasverwarmers.nu') . '>',
    'Reply-To: ' . $name . ' <' . $email . '>',
  ];

  $sent = wp_mail($to, $email_subject, $body, $headers);

  if ($sent) {
    wp_send_json_success(['message' => 'Bedankt voor uw bericht! We nemen zo snel mogelijk contact met u op.']);
  } else {
    wp_send_json_error(['message' => 'Er ging iets mis bij het versturen. Probeer het later opnieuw.'], 500);
  }
}
