<?php
namespace EllensLentze\Widgets\Team_Slider\Includes\Controls;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'section_title',
			[
				'label' => esc_html__( 'Section Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Het team van Ellens & Lentze', 'ellens-lentze' ),
				'placeholder' => esc_html__( 'Enter section title', 'ellens-lentze' ),
                'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Over ons', 'ellens-lentze' ),
                'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Button Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
				'default' => [
					'url' => '/over-ons',
				],
			]
		);

		$widget->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Number of Members', 'ellens-lentze' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

        $widget->add_control(
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

        $widget->add_control(
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

		$widget->end_controls_section();

        // Settings Tab
        $widget->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Slider Settings', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
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

        $widget->add_control(
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

        $widget->end_controls_section();
	}
}
