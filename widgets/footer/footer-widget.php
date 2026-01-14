<?php
namespace EllensLentze\Widgets;

use Elementor\Widget_Base;
use EllensLentze\Widgets\Footer\Includes\Controls\Content_Controls;
use EllensLentze\Widgets\Footer\Includes\Render\Render_Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Ellens Footer Widget.
 *
 * Elementor widget that displays the site footer with 4 columns:
 * Brand/Contact, Specialismes, Adviesgebieden, and Information.
 *
 * @since 1.0.0
 */
class Footer_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ellens_footer';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Ellens Footer', 'ellens-lentze' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-footer';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'footer', 'menu', 'contact', 'sociallane' ];
	}

    /**
	 * Get style dependencies.
	 *
	 * @return array Style handles.
	 */
	public function get_style_depends() {
		return [ 'ellens-footer' ];
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
        // Load Controls
        require_once( __DIR__ . '/includes/controls/content-controls.php' );
        Content_Controls::register( $this );
	}

	/**
	 * Render widget output on the frontend.
	 */
	protected function render() {
        // Load Render Functions
        require_once( __DIR__ . '/includes/render/render-functions.php' );
        Render_Functions::render_widget( $this );
	}
}
