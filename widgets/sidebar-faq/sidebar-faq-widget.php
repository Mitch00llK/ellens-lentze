<?php
/**
 * Handles Sidebar FAQ widget registration and assets.
 *
 * @since      1.0.0
 * @package    EllensLentze\Widgets
 * @subpackage EllensLentze\Widgets\Sidebar_FAQ
 */

namespace EllensLentze\Widgets;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Sidebar FAQ Widget Class
 */
class Sidebar_FAQ_Widget extends Widget_Base {

	public function get_name() {
		return 'sidebar_faq';
	}

	public function get_title() {
		return esc_html__( 'Sidebar FAQ', 'ellens-lentze' );
	}

	public function get_icon() {
		return 'eicon-accordion';
	}

	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	public function get_keywords() {
		return [ 'faq', 'sidebar', 'accordion', 'questions', 'support' ];
	}

	public function get_style_depends() {
		return [ 'ellens-sidebar-faq-v2' ];
	}

    public function get_script_depends() {

		return [ 'ellens-faq-section' ]; 
	}

	protected function register_controls() {
		require_once __DIR__ . '/includes/controls/content-controls.php';
		\EllensLentze\Widgets\Sidebar_FAQ\Includes\Controls\Content_Controls::register( $this );
	}

	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
		\EllensLentze\Widgets\Sidebar_FAQ\Includes\Render\Render_Functions::render_widget( $this );
	}
}
