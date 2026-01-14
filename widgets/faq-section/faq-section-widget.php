<?php
/**
 * Handles FAQ Section widget registration and assets.
 *
 * @since      1.0.0
 * @package    EllensLentze\Widgets
 * @subpackage EllensLentze\Widgets\FAQ_Section
 */

namespace EllensLentze\Widgets;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * FAQ Section Widget Class
 */
class FAQ_Section_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'faq_section';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return esc_html__( 'FAQ Section', 'ellens-lentze' );
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-accordion';
	}

	/**
	 * Get widget categories.
	 */
	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	/**
	 * Get widget keywords.
	 */
	public function get_keywords() {
		return [ 'faq', 'accordion', 'questions', 'answers' ];
	}

	/**
	 * Get style dependencies.
	 */
	public function get_style_depends() {
		return [ 'ellens-faq-section' ];
	}

	/**
	 * Get script dependencies.
	 */
	public function get_script_depends() {
		return [ 'ellens-faq-section' ];
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		require_once __DIR__ . '/includes/controls/content-controls.php';
		\EllensLentze\Widgets\FAQ_Section\Includes\Controls\Content_Controls::register( $this );

		require_once __DIR__ . '/includes/controls/style-controls.php';
		\EllensLentze\Widgets\FAQ_Section\Includes\Controls\Style_Controls::register( $this );
	}

	/**
	 * Render widget output on the frontend.
	 */
	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
		\EllensLentze\Widgets\FAQ_Section\Includes\Render\Render_Functions::render_widget( $this );
	}
}
