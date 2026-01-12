<?php
namespace EllensLentze\Widgets;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Services Cluster Widget.
 *
 * Elementor widget that displays a central visual cluster surrounded by feature cards.
 *
 * @since 1.0.0
 */
class Services_Cluster_Widget extends Widget_Base {

	public function get_name() {
		return 'services_cluster';
	}

	public function get_title() {
		return esc_html__( 'Services Cluster', 'ellens-lentze' );
	}

	public function get_icon() {
		return 'eicon-image-hotspot';
	}

	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	public function get_keywords() {
		return [ 'services', 'cluster', 'features', 'grid', 'mask' ];
	}

    public function get_style_depends() {
        return [ 'ellens-global-variables', 'ellens-sc-layout', 'ellens-sc-content', 'ellens-sc-responsive' ];
    }

	protected function register_controls() {
		require_once __DIR__ . '/includes/controls/content-controls.php';
        \EllensLentze\Widgets\Services_Cluster\Includes\Controls\Content_Controls::register( $this );

		require_once __DIR__ . '/includes/controls/style-controls.php';
        \EllensLentze\Widgets\Services_Cluster\Includes\Controls\Style_Controls::register( $this );
	}

	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
        \EllensLentze\Widgets\Services_Cluster\Includes\Render\Render_Functions::render_widget( $this );
	}
}
