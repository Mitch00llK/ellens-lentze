<?php
namespace EllensLentze\Widgets\Services_Cluster\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Style_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_style_cards',
			[
				'label' => esc_html__( 'Cards Style', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'card_bg_color',
			[
				'label' => esc_html__( 'Card Background', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services-cluster__card' => 'background-color: {{VALUE}};',
				],
                'default' => 'rgba(0, 41, 86, 0.6)',
			]
		);

        $widget->add_control(
			'card_border_color',
			[
				'label' => esc_html__( 'Border Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services-cluster__card' => 'border-color: {{VALUE}};',
				],
                'default' => 'rgba(237, 245, 252, 0.2)',
			]
		);

        $widget->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services-cluster__title' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);


        $widget->add_control(
			'cluster_title_color',
			[
				'label' => esc_html__( 'Cluster Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services-cluster__main-title' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cluster_title_typography',
                'label' => esc_html__( 'Cluster Title Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .services-cluster__main-title',
			]
		);
        $widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .services-cluster__title',
			]
		);

        $widget->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Description Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services-cluster__description' => 'color: {{VALUE}};',
				],
                'default' => '#edf5fc',
			]
		);

        $widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
                'label' => esc_html__( 'Description Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .services-cluster__description',
			]
		);

        $widget->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services-cluster__icon' => 'color: {{VALUE}};',
				],
                'default' => '#ef8a00',
			]
		);

		$widget->end_controls_section();
	}
}
