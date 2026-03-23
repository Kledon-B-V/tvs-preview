<?php
/**
 * Product meta boxes
 */

add_action('add_meta_boxes', function () {
  add_meta_box(
    'tvs_product_details',
    'Product Details',
    'tvs_product_meta_box_html',
    'tvs_product',
    'normal',
    'high'
  );
});

function tvs_product_meta_box_html($post) {
  wp_nonce_field('tvs_product_meta', 'tvs_product_meta_nonce');

  $price       = get_post_meta($post->ID, '_tvs_product_price', true);
  $power       = get_post_meta($post->ID, '_tvs_product_power', true);
  $type        = get_post_meta($post->ID, '_tvs_product_type', true);
  $application = get_post_meta($post->ID, '_tvs_product_application', true);
  $article_nr  = get_post_meta($post->ID, '_tvs_product_article_nr', true);
  ?>
  <table class="form-table">
    <tr>
      <th><label for="tvs_price">Prijs (€)</label></th>
      <td><input type="text" id="tvs_price" name="_tvs_product_price" value="<?php echo esc_attr($price); ?>" class="regular-text" placeholder="899"></td>
    </tr>
    <tr>
      <th><label for="tvs_power">Vermogen</label></th>
      <td><input type="text" id="tvs_power" name="_tvs_product_power" value="<?php echo esc_attr($power); ?>" class="regular-text" placeholder="12kW"></td>
    </tr>
    <tr>
      <th><label for="tvs_type">Type</label></th>
      <td>
        <select id="tvs_type" name="_tvs_product_type">
          <option value="">-- Selecteer --</option>
          <option value="Gas" <?php selected($type, 'Gas'); ?>>Gas</option>
          <option value="Elektrisch" <?php selected($type, 'Elektrisch'); ?>>Elektrisch</option>
          <option value="Infrarood" <?php selected($type, 'Infrarood'); ?>>Infrarood</option>
        </select>
      </td>
    </tr>
    <tr>
      <th><label for="tvs_application">Toepassing</label></th>
      <td>
        <select id="tvs_application" name="_tvs_product_application">
          <option value="">-- Selecteer --</option>
          <option value="Horeca" <?php selected($application, 'Horeca'); ?>>Horeca</option>
          <option value="Retail" <?php selected($application, 'Retail'); ?>>Retail</option>
          <option value="Industrieel" <?php selected($application, 'Industrieel'); ?>>Industrieel</option>
          <option value="Kerk" <?php selected($application, 'Kerk'); ?>>Kerk</option>
        </select>
      </td>
    </tr>
    <tr>
      <th><label for="tvs_article_nr">Artikelnummer</label></th>
      <td><input type="text" id="tvs_article_nr" name="_tvs_product_article_nr" value="<?php echo esc_attr($article_nr); ?>" class="regular-text" placeholder="TVS-001"></td>
    </tr>
  </table>
  <?php
}

add_action('save_post_tvs_product', function ($post_id) {
  if (!isset($_POST['tvs_product_meta_nonce']) || !wp_verify_nonce($_POST['tvs_product_meta_nonce'], 'tvs_product_meta')) {
    return;
  }
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  $fields = ['_tvs_product_price', '_tvs_product_power', '_tvs_product_type', '_tvs_product_application', '_tvs_product_article_nr'];

  foreach ($fields as $field) {
    if (isset($_POST[$field])) {
      update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
    }
  }
});
