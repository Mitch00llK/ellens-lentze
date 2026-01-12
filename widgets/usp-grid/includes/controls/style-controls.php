<?php
namespace EllensLentze\Widgets\USP_Grid\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Style_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_style_general',
			[
				'label' => esc_html__( 'General Style', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .usp-grid__icon' => 'color: {{VALUE}};',
				],
                'default' => '#ef8a00',
			]
		);

        $widget->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .usp-grid__title' => 'color: {{VALUE}};',
				],
                'default' => '#edf5fc',
			]
		);

        $widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .usp-grid__title',
			]
		);

        $widget->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Description Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .usp-grid__description' => 'color: {{VALUE}};',
				],
                'default' => '#edf5fc',
			]
		);

        $widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
                'label' => esc_html__( 'Description Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .usp-grid__description',
			]
		);

		$widget->end_controls_section();
	}
}
