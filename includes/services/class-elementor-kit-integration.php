<?php
/**
 * Elementor Global Kit Integration.
 *
 * Updates Elementor's global settings (Colors & Typography) to match
 * the strict design tokens defined in the Figma system.
 *
 * @package EllensLentze\Includes\Services
 */

namespace EllensLentze\Includes\Services;

use Elementor\Core\Kits\Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Kit_Integration {

	/**
	 * Init the integration.
	 */
	public static function init() {
		// Run on elementor/init or later. 
        // We use 'admin_init' to allow running once or on check.
        // Ideally, we might want a button or run this on plugin activation.
        // For now, let's hook into `elementor/init` and check if we need to update.
		add_action( 'elementor/init', [ __CLASS__, 'update_global_kit_settings' ] );
	}

	/**
	 * Update the active kit with our strict tokens.
	 */

	public static function update_global_kit_settings() {
		// Only run in admin to check and update if needed.
		if ( ! is_admin() || ! did_action( 'elementor/init' ) ) {
			return;
		}

		$kits_manager = \Elementor\Plugin::$instance->kits_manager;
		$kit = $kits_manager->get_active_kit();
		
		if ( ! $kit ) {
			return;
		}

		// Retrieve current raw settings
		$settings = $kit->get_data( 'settings' );

		// 1. SYSTEM COLORS
		// Primary
		$settings['system_colors'][0]['color'] = '#004590';
		// Secondary
		$settings['system_colors'][1]['color'] = '#EF8A00';
		// Text
		$settings['system_colors'][2]['color'] = '#171717';
		// Accent
		$settings['system_colors'][3]['color'] = '#EF8A00';

		// 2. CUSTOM COLORS
		if ( ! isset( $settings['custom_colors'] ) ) {
			$settings['custom_colors'] = [];
		}

		$custom_colors = [
			[ '_id' => 'color_dark_blue', 'title' => 'Dark Blue', 'color' => '#002752' ],
			[ '_id' => 'color_light_blue', 'title' => 'Light Blue', 'color' => '#F2F7FC' ],
			[ '_id' => 'color_white', 'title' => 'White', 'color' => '#FCFCFC' ],
			[ '_id' => 'color_neutral_light', 'title' => 'Neutral Light', 'color' => '#F7F8FA' ],
		];

		foreach ( $custom_colors as $new_color ) {
			$found = false;
			foreach ( $settings['custom_colors'] as &$existing_color ) {
				if ( isset( $existing_color['title'] ) && $existing_color['title'] === $new_color['title'] ) {
					$existing_color['color'] = $new_color['color'];
					$found = true;
					break;
				}
			}
			if ( ! $found ) {
				$settings['custom_colors'][] = $new_color;
			}
		}

		// 3. TYPOGRAPHY (Global Settings)
		// We map strict values directly to H1-H6, Body, Accent keys if available, 
		// but Elementor usually stores these in flat keys prefixed with typography_.
		
		// H1
		$settings['typography_h1_font_family'] = 'DM Serif Display';
		$settings['typography_h1_font_weight'] = '400';
		$settings['typography_h1_font_size'] = [ 'size' => 64, 'unit' => 'px' ];
		$settings['typography_h1_line_height'] = [ 'size' => 58, 'unit' => 'px' ];
		$settings['typography_h1_letter_spacing'] = [ 'size' => 2, 'unit' => 'px' ];
		$settings['typography_h1_letter_spacing_tablet'] = [ 'size' => 2, 'unit' => 'px' ]; // Fallback
		$settings['typography_h1_letter_spacing_mobile'] = [ 'size' => 1, 'unit' => 'px' ];

		// H2
		$settings['typography_h2_font_family'] = 'DM Serif Display';
		$settings['typography_h2_font_weight'] = '400';
		$settings['typography_h2_font_size'] = [ 'size' => 32, 'unit' => 'px' ];
		$settings['typography_h2_line_height'] = [ 'size' => 32, 'unit' => 'px' ];
		$settings['typography_h2_letter_spacing'] = [ 'size' => 0.64, 'unit' => 'px' ];

		// H3
		$settings['typography_h3_font_family'] = 'DM Serif Display';
		$settings['typography_h3_font_weight'] = '400';
		$settings['typography_h3_font_size'] = [ 'size' => 24, 'unit' => 'px' ];
		$settings['typography_h3_line_height'] = [ 'size' => 36, 'unit' => 'px' ];
		$settings['typography_h3_letter_spacing'] = [ 'size' => 2, 'unit' => 'px' ];

		// H4 (Might map to H4 if Elementor exposes it, typically H1-H6 are available)
		$settings['typography_h4_font_family'] = 'DM Serif Display';
		$settings['typography_h4_font_weight'] = '400';
		$settings['typography_h4_font_size'] = [ 'size' => 20, 'unit' => 'px' ];
		$settings['typography_h4_line_height'] = [ 'size' => 36, 'unit' => 'px' ];
		$settings['typography_h4_letter_spacing'] = [ 'size' => 2, 'unit' => 'px' ];

		// Body Text (typography_text)
		$settings['typography_text_font_family'] = 'DM Sans';
		$settings['typography_text_font_weight'] = '400';
		$settings['typography_text_font_size'] = [ 'size' => 18, 'unit' => 'px' ];
		$settings['typography_text_line_height'] = [ 'size' => 32, 'unit' => 'px' ];
		$settings['typography_text_letter_spacing'] = [ 'size' => 1, 'unit' => 'px' ];

		// Accent (links/buttons usually)
		// $settings['typography_accent_font_family'] = 'DM Sans';

		// Save updated settings
		// We update the controls then save.
		$kit->save( [ 'settings' => $settings ] );
	}
}
