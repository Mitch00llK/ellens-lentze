<?php
namespace EllensLentze\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

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
        // Content Tab
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Number of Members', 'ellens-lentze' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

        $this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Order By', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => esc_html__( 'Date', 'ellens-lentze' ),
					'title' => esc_html__( 'Name', 'ellens-lentze' ),
                    'menu_order' => esc_html__( 'Menu Order', 'ellens-lentze' ),
                    'rand' => esc_html__( 'Random', 'ellens-lentze' ),
				],
			]
		);

        $this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => esc_html__( 'DESC', 'ellens-lentze' ),
					'ASC' => esc_html__( 'ASC', 'ellens-lentze' ),
				],
			]
		);

		$this->end_controls_section();

        // Settings Tab
        $this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Slider Settings', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__( 'Autoplay Speed (ms)', 'ellens-lentze' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
		require_once __DIR__ . '/includes/render/render-functions.php';
        \EllensLentze\Widgets\Team_Slider\Includes\Render\Render_Functions::render_widget( $this );
	}
}
