<?php
namespace EllensLentze\Widgets\Post_Grid\Includes\Controls;

use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

        // Section Header
		$widget->start_controls_section(
			'section_header',
			[
				'label' => esc_html__( 'Header', 'ellens-lentze' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Actualiteit', 'ellens-lentze' ),
                'label_block' => true,
			]
		);

        $widget->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'ellens-lentze' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Bekijk alle', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Button Link', 'ellens-lentze' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
				'default' => [
					'url' => '#',
				],
			]
		);

        $widget->add_control(
			'button_style',
			[
				'label' => esc_html__( 'Button Style', 'ellens-lentze' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'primary',
				'options' => [
					'primary' => esc_html__( 'Primary (Blue)', 'ellens-lentze' ),
					'secondary' => esc_html__( 'Secondary (Orange)', 'ellens-lentze' ),
					'ghost' => esc_html__( 'Ghost', 'ellens-lentze' ),
					'outline' => esc_html__( 'Outline', 'ellens-lentze' ),
				],
			]
		);

		$widget->end_controls_section();

        // Section Cards
		$widget->start_controls_section(
			'section_cards',
			[
				'label' => esc_html__( 'Cards', 'ellens-lentze' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'card_button_style',
			[
				'label' => esc_html__( 'Button Style', 'ellens-lentze' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'light',
				'options' => [
					'primary' => esc_html__( 'Primary (Blue)', 'ellens-lentze' ),
					'secondary' => esc_html__( 'Secondary (Orange)', 'ellens-lentze' ),
					'ghost' => esc_html__( 'Ghost', 'ellens-lentze' ),
					'outline' => esc_html__( 'Outline', 'ellens-lentze' ),
                    'light' => esc_html__( 'Light (Default)', 'ellens-lentze' ),
				],
			]
		);

		$widget->end_controls_section();

        // Query Settings
		$widget->start_controls_section(
			'section_query',
			[
				'label' => esc_html__( 'Query', 'ellens-lentze' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Number of Posts', 'ellens-lentze' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
			]
		);

        // Optional Category Filter
        $widget->add_control(
			'category_filter',
			[
				'label' => esc_html__( 'Category Filter (Slug)', 'ellens-lentze' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Enter a category slug to filter posts, or leave empty for all.', 'ellens-lentze'),
			]
		);

		$widget->end_controls_section();
	}
}
