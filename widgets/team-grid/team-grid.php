<?php
namespace EllensLentze\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Team Grid Widget.
 *
 * Elementor widget that displays team members in a grid.
 *
 * @since 1.0.0
 */
class Team_Grid_Widget extends Widget_Base {

	public function get_name() {
		return 'team_grid';
	}

	public function get_title() {
		return esc_html__( 'Team Grid', 'ellens-lentze' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	public function get_keywords() {
		return [ 'team', 'grid', 'members', 'staff' ];
	}

    public function get_style_depends() {
        return [ 'ellens-team-grid' ];
    }

	protected function register_controls() {
        
        require_once __DIR__ . '/includes/controls/content-controls.php';
        \EllensLentze\Widgets\Team_Grid\Includes\Controls\Content_Controls::register( $this );

	}

	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
        \EllensLentze\Widgets\Team_Grid\Includes\Render\Render_Functions::render_widget( $this );
	}
}
