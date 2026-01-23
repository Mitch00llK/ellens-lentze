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

		// Get more results initially for fuzzy matching
		$args = [
			'post_type'      => $post_types,
			'post_status'    => 'publish',
			's'              => $term,
			'posts_per_page' => 50, // Get more results for fuzzy filtering
		];

		$query = new \WP_Query( $args );
		$results = [];

		if ( $query->have_posts() ) {
			$term_lower = mb_strtolower( $term );
			$term_words = array_filter( explode( ' ', $term_lower ) );

			while ( $query->have_posts() ) {
				$query->the_post();
                
				$post_type_obj = get_post_type_object( get_post_type() );
				$type_label = $post_type_obj ? $post_type_obj->labels->singular_name : get_post_type();
				$title = get_the_title();
				$title_lower = mb_strtolower( $title );
				$excerpt = get_the_excerpt();
				$excerpt_lower = mb_strtolower( $excerpt );

				// Calculate fuzzy match score
				$score = self::calculate_fuzzy_score( $term_lower, $term_words, $title_lower, $excerpt_lower );

				// Only include results with a minimum relevance score (threshold: 30%)
				if ( $score >= 30 ) {
					$results[] = [
						'id'    => get_the_ID(),
						'title' => $title,
						'url'   => get_permalink(),
						'type'  => $type_label,
						'score' => $score,
					];
				}
			}
			wp_reset_postdata();

			// Sort by score (highest first)
			usort( $results, function( $a, $b ) {
				return $b['score'] <=> $a['score'];
			} );

			// Limit to top 10 results
			$results = array_slice( $results, 0, 10 );

			// Remove score from final output
			$results = array_map( function( $item ) {
				unset( $item['score'] );
				return $item;
			}, $results );
		}

		// If no results from WP_Query, try fuzzy search on all posts
		if ( empty( $results ) && strlen( $term ) >= 2 ) {
			$results = self::fuzzy_fallback_search( $term_lower, $post_types );
		}

		wp_send_json_success( $results );
	}

	/**
	 * Calculate fuzzy match score between search term and post content.
	 *
	 * @param string $term_lower Lowercase search term
	 * @param array  $term_words Array of individual words from search term
	 * @param string $title_lower Lowercase post title
	 * @param string $excerpt_lower Lowercase post excerpt
	 * @return float Relevance score (0-100)
	 */
	private static function calculate_fuzzy_score( $term_lower, $term_words, $title_lower, $excerpt_lower ) {
		$score = 0;

		// Exact title match gets highest score
		if ( $title_lower === $term_lower ) {
			return 100;
		}

		// Title starts with search term
		if ( strpos( $title_lower, $term_lower ) === 0 ) {
			$score += 90;
		}

		// Title contains search term
		if ( strpos( $title_lower, $term_lower ) !== false ) {
			$score += 80;
		}

		// Calculate similarity using similar_text (0-100)
		$title_similarity = 0;
		similar_text( $term_lower, $title_lower, $title_similarity );
		$score += $title_similarity * 0.6; // Title similarity weighted 60%

		// Check if all words appear in title (word-by-word matching)
		$words_in_title = 0;
		foreach ( $term_words as $word ) {
			if ( strlen( $word ) > 2 && strpos( $title_lower, $word ) !== false ) {
				$words_in_title++;
			}
		}
		if ( count( $term_words ) > 0 ) {
			$word_match_ratio = ( $words_in_title / count( $term_words ) ) * 100;
			$score += $word_match_ratio * 0.4; // Word matching weighted 40%
		}

		// Levenshtein distance for typo tolerance
		$max_length = max( strlen( $term_lower ), strlen( $title_lower ) );
		if ( $max_length > 0 ) {
			$levenshtein_distance = levenshtein( $term_lower, $title_lower );
			$levenshtein_similarity = ( 1 - ( $levenshtein_distance / $max_length ) ) * 100;
			// Only apply if similarity is reasonable (within 3 character edits for short terms, more for longer)
			$max_edits = min( 3, max( 1, floor( strlen( $term_lower ) / 3 ) ) );
			if ( $levenshtein_distance <= $max_edits ) {
				$score += $levenshtein_similarity * 0.3;
			}
		}

		// Partial word matching (substring within words)
		foreach ( $term_words as $word ) {
			if ( strlen( $word ) >= 3 ) {
				// Check if word appears as substring in title words
				$title_words = explode( ' ', $title_lower );
				foreach ( $title_words as $title_word ) {
					if ( strpos( $title_word, $word ) !== false || strpos( $word, $title_word ) !== false ) {
						$score += 20;
						break;
					}
				}
			}
		}

		// Content/excerpt matching (lower weight)
		if ( ! empty( $excerpt_lower ) ) {
			if ( strpos( $excerpt_lower, $term_lower ) !== false ) {
				$score += 15;
			}
			$excerpt_similarity = 0;
			similar_text( $term_lower, $excerpt_lower, $excerpt_similarity );
			$score += $excerpt_similarity * 0.1; // Content similarity weighted 10%
		}

		return min( 100, $score ); // Cap at 100
	}

	/**
	 * Fallback fuzzy search when WP_Query returns no results.
	 * Searches through all published posts with fuzzy matching.
	 *
	 * @param string $term_lower Lowercase search term
	 * @param array  $post_types Post types to search
	 * @return array Search results
	 */
	private static function fuzzy_fallback_search( $term_lower, $post_types ) {
		$args = [
			'post_type'      => $post_types,
			'post_status'    => 'publish',
			'posts_per_page' => 100, // Get more posts for fuzzy matching
			'orderby'        => 'date',
			'order'          => 'DESC',
		];

		$query = new \WP_Query( $args );
		$results = [];
		$term_words = array_filter( explode( ' ', $term_lower ) );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();

				$post_type_obj = get_post_type_object( get_post_type() );
				$type_label = $post_type_obj ? $post_type_obj->labels->singular_name : get_post_type();
				$title = get_the_title();
				$title_lower = mb_strtolower( $title );
				$excerpt = get_the_excerpt();
				$excerpt_lower = mb_strtolower( $excerpt );

				// Calculate fuzzy match score
				$score = self::calculate_fuzzy_score( $term_lower, $term_words, $title_lower, $excerpt_lower );

				// Lower threshold for fallback search (20%)
				if ( $score >= 20 ) {
					$results[] = [
						'id'    => get_the_ID(),
						'title' => $title,
						'url'   => get_permalink(),
						'type'  => $type_label,
						'score' => $score,
					];
				}
			}
			wp_reset_postdata();

			// Sort by score (highest first)
			usort( $results, function( $a, $b ) {
				return $b['score'] <=> $a['score'];
			} );

			// Limit to top 5 results for fallback
			$results = array_slice( $results, 0, 5 );

			// Remove score from final output
			$results = array_map( function( $item ) {
				unset( $item['score'] );
				return $item;
			}, $results );
		}

		return $results;
	}
}
