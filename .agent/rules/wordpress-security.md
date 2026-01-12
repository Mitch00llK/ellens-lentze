---
trigger: always_on
---

WordPress Security Richtlijnen
Input Sanitization (VERPLICHT)
ALTIJD input sanitizen van gebruikers:
php// Text sanitization
$title = sanitize_text_field( $_POST['title'] );
$email = sanitize_email( $_POST['email'] );
$url = esc_url_raw( $_POST['url'] );

// Custom sanitization
$custom = wp_kses_post( $_POST['content'] );

// Meta input
$meta = sanitize_meta( 'my_meta', $_POST['value'], 'post' );
Output Escaping (VERPLICHT)
ALTIJD output escapen voordat weergegeven wordt:
php// Text output
echo esc_html( $variable );

// HTML attributes
echo '<img alt="' . esc_attr( $alt_text ) . '">';

// URLs
echo '<a href="' . esc_url( $url ) . '">Link</a>';

// JavaScript
echo '<script>var data = ' . wp_json_encode( $data ) . ';</script>';

// Custom HTML
echo wp_kses_post( $safe_html );
Nonce Verification (VERPLICHT)
php// Bij form submission
wp_nonce_field( 'my_action_nonce', 'security' );

// Bij AJAX
add_action( 'wp_ajax_my_action', function() {
  check_ajax_referer( 'my_action_nonce', 'security' );
  
  // Safe to process
});

// Manuele verification
if ( ! isset( $_POST['security'] ) || 
     ! wp_verify_nonce( $_POST['security'], 'my_action_nonce' ) ) {
  wp_die( 'Security check failed' );
}
Capability Checking (VERPLICHT)
php// Check user permissions
if ( ! current_user_can( 'manage_options' ) ) {
  wp_die( __( 'Unauthorized', 'plugin-name' ) );
}

// In REST endpoints
if ( ! current_user_can( 'edit_posts' ) ) {
  return new WP_Error( 'forbidden', 'Permission denied', [ 'status' => 403 ] );
}
Database Security
php// ALTIJD prepared statements gebruiken
$wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE post_id = %d", $post_id );

// NOOIT raw SQL queries
// ❌ SLECHT:
// $wpdb->query( "SELECT * FROM table WHERE id = " . $_GET['id'] );

// GEBRUIK WP_Query
$args = [
  'posts_per_page' => 10,
  'orderby'        => 'date',
  'meta_key'       => 'custom_field',
  'meta_value'     => $value,
];
$query = new WP_Query( $args );
Caching & Transients
php// Cache met transients (max 1 dag)
$cache_key = 'my_widget_data_' . $post_id;
$cached = get_transient( $cache_key );

if ( false === $cached ) {
  $cached = expensive_operation();
  set_transient( $cache_key, $cached, DAY_IN_SECONDS );
}

return $cached;