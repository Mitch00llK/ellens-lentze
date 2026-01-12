<?php
namespace EllensLentze\Widgets;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Hero Widget.
 *
 * Elementor widget that displays a hero section with a floating content card.
 *
 * @since 1.0.0
 */
class Hero_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve hero widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'hero';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve hero widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Hero', 'ellens-lentze' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve hero widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-banner';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve hero widget custom help URL.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget custom help URL.
	 */
	public function get_custom_help_url() {
		return '';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the hero widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the hero widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'hero', 'banner', 'card', 'header' ];
	}

    /**
     * Get style dependencies.
     *
     * Retrieve the list of style dependencies the widget requires.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_style_depends() {
        return [ 'ellens-global-variables', 'ellens-hero-layout', 'ellens-hero-content', 'ellens-hero-responsive' ];
    }

	/**
	 * Register hero widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// Content Controls
		require_once __DIR__ . '/includes/controls/content-controls.php';
        \EllensLentze\Widgets\Hero\Includes\Controls\Content_Controls::register( $this );

		// Style Controls
		require_once __DIR__ . '/includes/controls/style-controls.php';
        \EllensLentze\Widgets\Hero\Includes\Controls\Style_Controls::register( $this );

	}

	/**
	 * Render hero widget output on the frontend.
	 *
	 * Written in PHP and outputting to the html.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
        \EllensLentze\Widgets\Hero\Includes\Render\Render_Functions::render_widget( $this );
	}
}
