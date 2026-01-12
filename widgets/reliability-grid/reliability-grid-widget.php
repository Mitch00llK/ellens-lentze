<?php
namespace EllensLentze\Widgets;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Reliability Grid Widget.
 *
 * Elementor widget that displays a centered image with a grid of feature blocks.
 *
 * @since 1.0.0
 */
class Reliability_Grid_Widget extends Widget_Base {

	public function get_name() {
		return 'ellens_reliability_grid';
	}

	public function get_title() {
		return esc_html__( 'Reliability Grid', 'ellens-lentze' );
	}

	public function get_icon() {
		return 'eicon-grid';
	}

	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	public function get_keywords() {
		return [ 'reliability', 'grid', 'features', 'image', 'split' ];
	}

    public function get_style_depends() {
        return [ 
            'font-awesome-5', 
            'ellens-global-variables', 
            'ellens-global-buttons',
            'ellens-rg-layout', 
            'ellens-rg-feature', 
            'ellens-rg-responsive' 
        ];
    }

	protected function register_controls() {
		require_once __DIR__ . '/includes/controls/content-controls.php';
        \EllensLentze\Widgets\Reliability_Grid\Includes\Controls\Content_Controls::register( $this );

		require_once __DIR__ . '/includes/controls/style-controls.php';
        \EllensLentze\Widgets\Reliability_Grid\Includes\Controls\Style_Controls::register( $this );
	}

	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
        \EllensLentze\Widgets\Reliability_Grid\Includes\Render\Render_Functions::render_widget( $this );
	}
}
