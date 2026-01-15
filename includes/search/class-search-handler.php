<?php
namespace EllensLentze\Includes\Search;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Search_Handler {

	public static function register() {
		add_action( 'wp_ajax_ellens_menu_search', [ __CLASS__, 'handle_search' ] );
		add_action( 'wp_ajax_nopriv_ellens_menu_search', [ __CLASS__, 'handle_search' ] );
	}

	public static function handle_search() {
		// Check nonce (security best practice, adding if passed, or just open for now)
		// if ( ! check_ajax_referer( 'ellens_search_nonce', 'nonce', false ) ) {
		//     wp_send_json_error( 'Invalid nonce' );
		// }

		$term = isset( $_GET['term'] ) ? sanitize_text_field( $_GET['term'] ) : '';
		$post_types = isset( $_GET['post_types'] ) ? $_GET['post_types'] : [ 'post', 'page' ];

		// Sanitize post types
		if ( is_array( $post_types ) ) {
			$post_types = array_map( 'sanitize_text_field', $post_types );
		} else {
			$post_types = [ 'post', 'page' ];
		}

		if ( empty( $term ) ) {
			wp_send_json_success( [] );
		}

		$args = [
			'post_type'      => $post_types,
			'post_status'    => 'publish',
			's'              => $term,
			'posts_per_page' => 5, // Limit results
			'orderby'        => 'relevance',
		];

		$query = new \WP_Query( $args );
		$results = [];

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
                
                $post_type_obj = get_post_type_object( get_post_type() );
                $type_label = $post_type_obj ? $post_type_obj->labels->singular_name : get_post_type();

				$results[] = [
					'id'    => get_the_ID(),
					'title' => get_the_title(),
					'url'   => get_permalink(),
					'type'  => $type_label,
				];
			}
			wp_reset_postdata();
		}

		wp_send_json_success( $results );
	}
}
