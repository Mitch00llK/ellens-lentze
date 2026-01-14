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
			// Base Colors
			[ '_id' => 'color_dark_blue', 'title' => 'Dark Blue', 'color' => '#002752' ],
			[ '_id' => 'color_light_blue', 'title' => 'Light Blue', 'color' => '#F2F7FC' ],
			[ '_id' => 'color_white', 'title' => 'White', 'color' => '#FCFCFC' ],
			[ '_id' => 'color_neutral_light', 'title' => 'Neutral Light', 'color' => '#F7F8FA' ],
			
			// Primary Blue Opacity Variants
			[ '_id' => 'color_primary_100', 'title' => 'Primary 100%', 'color' => '#004590' ],
			[ '_id' => 'color_primary_80', 'title' => 'Primary 80%', 'color' => 'rgba(0, 69, 144, 0.8)' ],
			[ '_id' => 'color_primary_60', 'title' => 'Primary 60%', 'color' => 'rgba(0, 69, 144, 0.6)' ],
			[ '_id' => 'color_primary_40', 'title' => 'Primary 40%', 'color' => 'rgba(0, 69, 144, 0.4)' ],
			[ '_id' => 'color_primary_20', 'title' => 'Primary 20%', 'color' => 'rgba(0, 69, 144, 0.2)' ],
			[ '_id' => 'color_primary_10', 'title' => 'Primary 10%', 'color' => 'rgba(0, 69, 144, 0.1)' ],
			
			// Secondary Orange Opacity Variants
			[ '_id' => 'color_secondary_100', 'title' => 'Secondary 100%', 'color' => '#EF8A00' ],
			[ '_id' => 'color_secondary_80', 'title' => 'Secondary 80%', 'color' => 'rgba(239, 138, 0, 0.8)' ],
			[ '_id' => 'color_secondary_60', 'title' => 'Secondary 60%', 'color' => 'rgba(239, 138, 0, 0.6)' ],
			[ '_id' => 'color_secondary_40', 'title' => 'Secondary 40%', 'color' => 'rgba(239, 138, 0, 0.4)' ],
			[ '_id' => 'color_secondary_20', 'title' => 'Secondary 20%', 'color' => 'rgba(239, 138, 0, 0.2)' ],
			[ '_id' => 'color_secondary_10', 'title' => 'Secondary 10%', 'color' => 'rgba(239, 138, 0, 0.1)' ],
			
			// Neutral Dark Opacity Variants
			[ '_id' => 'color_neutral_dark_100', 'title' => 'Neutral Dark 100%', 'color' => '#171717' ],
			[ '_id' => 'color_neutral_dark_80', 'title' => 'Neutral Dark 80%', 'color' => 'rgba(23, 23, 23, 0.8)' ],
			[ '_id' => 'color_neutral_dark_60', 'title' => 'Neutral Dark 60%', 'color' => 'rgba(23, 23, 23, 0.6)' ],
			[ '_id' => 'color_neutral_dark_40', 'title' => 'Neutral Dark 40%', 'color' => 'rgba(23, 23, 23, 0.4)' ],
			[ '_id' => 'color_neutral_dark_20', 'title' => 'Neutral Dark 20%', 'color' => 'rgba(23, 23, 23, 0.2)' ],
			[ '_id' => 'color_neutral_dark_10', 'title' => 'Neutral Dark 10%', 'color' => 'rgba(23, 23, 23, 0.1)' ],
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

		// 3. SYSTEM TYPOGRAPHY (Global Fonts)
		// Update the 4 system typography tokens: Primary, Secondary, Text, Accent
		// These appear in the 'Globals' settings.
		
		// Primary (Headings - Serif 64px)
		$settings['system_typography'][0]['typography_font_family'] = 'DM Serif Display';
		$settings['system_typography'][0]['typography_font_weight'] = '400';
		$settings['system_typography'][0]['typography_font_size'] = [ 'size' => 64, 'unit' => 'px' ];
		$settings['system_typography'][0]['typography_line_height'] = [ 'size' => 58, 'unit' => 'px' ];
		$settings['system_typography'][0]['typography_letter_spacing'] = [ 'size' => 2, 'unit' => 'px' ];
		
		// Secondary (Subheadings - Serif 32px)
		$settings['system_typography'][1]['typography_font_family'] = 'DM Serif Display';
		$settings['system_typography'][1]['typography_font_weight'] = '400';
		$settings['system_typography'][1]['typography_font_size'] = [ 'size' => 32, 'unit' => 'px' ];
		$settings['system_typography'][1]['typography_line_height'] = [ 'size' => 32, 'unit' => 'px' ];
		$settings['system_typography'][1]['typography_letter_spacing'] = [ 'size' => 0.64, 'unit' => 'px' ];

		// Text (Body - Sans 18px)
		$settings['system_typography'][2]['typography_font_family'] = 'DM Sans';
		$settings['system_typography'][2]['typography_font_weight'] = '400';
		$settings['system_typography'][2]['typography_font_size'] = [ 'size' => 18, 'unit' => 'px' ];
		$settings['system_typography'][2]['typography_line_height'] = [ 'size' => 32, 'unit' => 'px' ];
		$settings['system_typography'][2]['typography_letter_spacing'] = [ 'size' => 1, 'unit' => 'px' ];

		// Accent (Button/Link - Sans 16px)
		$settings['system_typography'][3]['typography_font_family'] = 'DM Sans';
		$settings['system_typography'][3]['typography_font_weight'] = '400';
		$settings['system_typography'][3]['typography_font_size'] = [ 'size' => 16, 'unit' => 'px' ];
		$settings['system_typography'][3]['typography_line_height'] = [ 'size' => 32, 'unit' => 'px' ];
		$settings['system_typography'][3]['typography_letter_spacing'] = [ 'size' => 0, 'unit' => 'px' ];


		// 4. THEME STYLE TYPOGRAPHY (HTML Tags)
		// These settings control the default style for HTML tags (h1, h2, p, etc.)
		
		// H1
		$settings['typography_h1_font_family'] = 'DM Serif Display';
		$settings['typography_h1_font_weight'] = '400';
		$settings['typography_h1_font_size'] = [ 'size' => 64, 'unit' => 'px' ];
		$settings['typography_h1_line_height'] = [ 'size' => 58, 'unit' => 'px' ];
		$settings['typography_h1_letter_spacing'] = [ 'size' => 2, 'unit' => 'px' ];
		$settings['typography_h1_letter_spacing_tablet'] = [ 'size' => 2, 'unit' => 'px' ];
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

		// H4
		$settings['typography_h4_font_family'] = 'DM Serif Display';
		$settings['typography_h4_font_weight'] = '400';
		$settings['typography_h4_font_size'] = [ 'size' => 20, 'unit' => 'px' ];
		$settings['typography_h4_line_height'] = [ 'size' => 36, 'unit' => 'px' ];
		$settings['typography_h4_letter_spacing'] = [ 'size' => 2, 'unit' => 'px' ];


		// H5 (Fallback to H4 20px)
		$settings['typography_h5_font_family'] = 'DM Serif Display';
		$settings['typography_h5_font_weight'] = '400';
		$settings['typography_h5_font_size'] = [ 'size' => 20, 'unit' => 'px' ];
		$settings['typography_h5_line_height'] = [ 'size' => 36, 'unit' => 'px' ];
		$settings['typography_h5_letter_spacing'] = [ 'size' => 2, 'unit' => 'px' ];

		// H6 (Fallback to H4 20px)
		$settings['typography_h6_font_family'] = 'DM Serif Display';
		$settings['typography_h6_font_weight'] = '400';
		$settings['typography_h6_font_size'] = [ 'size' => 20, 'unit' => 'px' ];
		$settings['typography_h6_line_height'] = [ 'size' => 36, 'unit' => 'px' ];
		$settings['typography_h6_letter_spacing'] = [ 'size' => 2, 'unit' => 'px' ];

		// Body Text (typography_text)
		$settings['typography_text_font_family'] = 'DM Sans';
		$settings['typography_text_font_weight'] = '400';
		$settings['typography_text_font_size'] = [ 'size' => 18, 'unit' => 'px' ];
		$settings['typography_text_line_height'] = [ 'size' => 32, 'unit' => 'px' ];
		$settings['typography_text_letter_spacing'] = [ 'size' => 1, 'unit' => 'px' ];

		// Buttons (Theme Style)
		$settings['buttons_typography_font_family'] = 'DM Sans';
		$settings['buttons_typography_font_weight'] = '400';
		$settings['buttons_typography_font_size'] = [ 'size' => 16, 'unit' => 'px' ];
		$settings['buttons_typography_line_height'] = [ 'size' => 32, 'unit' => 'px' ];
		$settings['buttons_typography_letter_spacing'] = [ 'size' => 0, 'unit' => 'px' ];

		// Accent (links/buttons usually in global map)
		// $settings['typography_accent_font_family'] = 'DM Sans';

		// Save updated settings
		// We update the controls then save.
		$kit->save( [ 'settings' => $settings ] );
	}
}
