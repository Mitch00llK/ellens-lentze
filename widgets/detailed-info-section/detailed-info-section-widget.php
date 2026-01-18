<?php
namespace EllensLentze\Widgets;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Detailed Info Section Widget.
 *
 * Elementor widget that displays a main content area and a sidebar card.
 *
 * @package EllensLentze\Widgets\Detailed_Info_Section
 * @since 1.0.0
 */
class Detailed_Info_Section_Widget extends Widget_Base {

	public function get_name() {
		return 'detailed_info_section';
	}

	public function get_title() {
		return esc_html__( 'Detailed Info Section', 'ellens-lentze' );
	}

	public function get_icon() {
		return 'eicon-columns';
	}

	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	public function get_keywords() {
		return [ 'detailed', 'info', 'section', 'sidebar', 'card', 'usp' ];
	}

    public function get_style_depends() {
        return [ 'ellens-detailed-info-section' ];
    }

	protected function register_controls() {
		require_once __DIR__ . '/includes/controls/content-controls.php';
        \EllensLentze\Widgets\Detailed_Info_Section\Includes\Controls\Content_Controls::register( $this );

		require_once __DIR__ . '/includes/controls/style-controls.php';
        \EllensLentze\Widgets\Detailed_Info_Section\Includes\Controls\Style_Controls::register( $this );
	}

	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
        \EllensLentze\Widgets\Detailed_Info_Section\Includes\Render\Render_Functions::render_widget( $this );
	}
}
