<?php
namespace EllensLentze\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Team Slider Widget.
 *
 * Elementor widget that displays team members in a slider.
 *
 * @since 1.0.0
 */
class Team_Slider_Widget extends Widget_Base {

	public function get_name() {
		return 'team_slider';
	}

	public function get_title() {
		return esc_html__( 'Team Slider', 'ellens-lentze' );
	}

	public function get_icon() {
		return 'eicon-slides';
	}

	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	public function get_keywords() {
		return [ 'team', 'slider', 'members', 'carousel' ];
	}

    public function get_style_depends() {
        return [ 'ellens-ts-base', 'ellens-ts-layout', 'ellens-ts-component', 'ellens-ts-responsive' ];
    }

    public function get_script_depends() {
        return [ 'ellens-ts-script' ];
    }

	protected function register_controls() {
        
        require_once __DIR__ . '/includes/controls/content-controls.php';
        \EllensLentze\Widgets\Team_Slider\Includes\Controls\Content_Controls::register( $this );

        require_once __DIR__ . '/includes/controls/style-controls.php';
        \EllensLentze\Widgets\Team_Slider\Includes\Controls\Style_Controls::register( $this );

	}

	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
        \EllensLentze\Widgets\Team_Slider\Includes\Render\Render_Functions::render_widget( $this );
	}
}
