<?php
namespace EllensLentze\Widgets;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * USP Grid Widget.
 *
 * Elementor widget that displays a grid of USPs with icons.
 *
 * @since 1.0.0
 */
class USP_Grid_Widget extends Widget_Base {

	public function get_name() {
		return 'usp_grid';
	}

	public function get_title() {
		return esc_html__( 'USP Grid', 'ellens-lentze' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	public function get_keywords() {
		return [ 'usp', 'grid', 'features', 'icons', 'list' ];
	}

    public function get_style_depends() {
        return [ 'ellens-usp-grid' ];
    }

	protected function register_controls() {
		require_once __DIR__ . '/includes/controls/content-controls.php';
        \EllensLentze\Widgets\USP_Grid\Includes\Controls\Content_Controls::register( $this );

		require_once __DIR__ . '/includes/controls/style-controls.php';
        \EllensLentze\Widgets\USP_Grid\Includes\Controls\Style_Controls::register( $this );
	}

	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
        \EllensLentze\Widgets\USP_Grid\Includes\Render\Render_Functions::render_widget( $this );
	}
}
