<?php
namespace EllensLentze\Widgets\Team_Grid\Includes\Controls;

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
				'default' => esc_html__( 'De Specialisten van Ellens & Lentze', 'ellens-lentze' ),
				'placeholder' => esc_html__( 'Enter section title', 'ellens-lentze' ),
                'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'section_description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Een goed testament is essentieel om ervoor te zorgen dat uw wensen worden gerespecteerd...', 'ellens-lentze' ),
				'placeholder' => esc_html__( 'Enter section description', 'ellens-lentze' ),
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

        $widget->add_responsive_control(
			'grid_columns',
			[
				'label' => esc_html__( 'Columns', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'default' => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'options' => [
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                ],
				'selectors' => [
					'{{WRAPPER}} .team-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
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
	}
}
