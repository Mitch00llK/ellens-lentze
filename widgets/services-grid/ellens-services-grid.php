<?php
namespace EllensLentze\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Services Grid Widget.
 *
 * Elementor widget that displays a grid of service cards.
 *
 * @since 1.0.0
 */
class Services_Grid_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve services grid widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ellens_services_grid';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve services grid widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Services Grid', 'ellens-lentze' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve services grid widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the services grid widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the services grid widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'services', 'grid', 'cards', 'ellens' ];
	}

    public function get_style_depends() {
		return [ 'font-awesome-5', 'ellens-global-variables', 'ellens-sg-layout', 'ellens-sg-component' ];
	}

	/**
	 * Register services grid widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		require_once __DIR__ . '/includes/controls/content-controls.php';
        \EllensLentze\Widgets\Services_Grid\Includes\Controls\Content_Controls::register( $this );

		require_once __DIR__ . '/includes/controls/style-controls.php';
        \EllensLentze\Widgets\Services_Grid\Includes\Controls\Style_Controls::register( $this );

	}

	/**
	 * Render services grid widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		require_once __DIR__ . '/includes/render/render-services-grid.php';
        \EllensLentze\Widgets\Services_Grid\Includes\Render\Render_Services_Grid::render( $this->get_settings_for_display() );
	}
}
