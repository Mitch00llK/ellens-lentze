<?php
namespace EllensLentze\Widgets;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Contact Info Widget.
 *
 * Elementor widget that displays contact information with icons.
 *
 * @package EllensLentze\Widgets\Contact_Info
 * @since 1.0.0
 */
class Contact_Info_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'contact_info';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Contact Info', 'ellens-lentze' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-info-box';
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
		return [ 'contact', 'info', 'address', 'email', 'phone' ];
	}

	/**
	 * Get style dependencies.
	 *
	 * @return array Style handles.
	 */
	public function get_style_depends() {
		return [ 'ellens-contact-info' ];
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		require_once __DIR__ . '/includes/controls/content-controls.php';
		\EllensLentze\Widgets\Contact_Info\Includes\Controls\Content_Controls::register( $this );
	}

	/**
	 * Render widget output on the frontend.
	 */
	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
		\EllensLentze\Widgets\Contact_Info\Includes\Render\Render_Functions::render_widget( $this );
	}
}
