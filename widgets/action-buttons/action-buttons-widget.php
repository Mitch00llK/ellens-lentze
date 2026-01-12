<?php
namespace EllensLentze\Widgets;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Action Buttons Widget.
 *
 * Elementor widget that displays a title, description, and a list of action buttons.
 *
 * @since 1.0.0
 */
class Action_Buttons_Widget extends Widget_Base {

	public function get_name() {
		return 'action_buttons';
	}

	public function get_title() {
		return esc_html__( 'Action Buttons', 'ellens-lentze' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	public function get_keywords() {
		return [ 'buttons', 'action', 'filter', 'list' ];
	}

    public function get_style_depends() {
        return [ 'font-awesome-5', 'ellens-global-variables', 'ellens-ab-layout', 'ellens-ab-content', 'ellens-ab-responsive' ];
    }

	protected function register_controls() {
		require_once __DIR__ . '/includes/controls/content-controls.php';
        \EllensLentze\Widgets\Action_Buttons\Includes\Controls\Content_Controls::register( $this );

		require_once __DIR__ . '/includes/controls/style-controls.php';
        \EllensLentze\Widgets\Action_Buttons\Includes\Controls\Style_Controls::register( $this );
	}

	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
        \EllensLentze\Widgets\Action_Buttons\Includes\Render\Render_Functions::render_widget( $this );
	}
}
