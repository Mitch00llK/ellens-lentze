<?php
namespace EllensLentze\Widgets\Reliability_Grid\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Style Controls for Reliability Grid.
 */
class Style_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Main Title', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'main_title_color',
			[
				'label' => esc_html__( 'Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'var(--color-dark-blue)',
				'selectors' => [
					'{{WRAPPER}} .ellens-rg-title' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'main_title_typography',
				'selector' => '{{WRAPPER}} .ellens-rg-title',
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'section_feature_style',
			[
				'label' => esc_html__( 'Feature Items', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'feature_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'var(--icon-color-primary)',
				'selectors' => [
					'{{WRAPPER}} .ellens-rg-feature__icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ellens-rg-feature__icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'feature_title_color',
			[
				'label' => esc_html__( 'Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'var(--color-dark-blue)',
				'selectors' => [
					'{{WRAPPER}} .ellens-rg-feature__title-text' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feature_title_typography',
				'selector' => '{{WRAPPER}} .ellens-rg-feature__title-text',
			]
		);

		$widget->add_control(
			'feature_subtitle_color',
			[
				'label' => esc_html__( 'Subtitle Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'var(--color-primary)',
				'selectors' => [
					'{{WRAPPER}} .ellens-rg-feature__subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feature_subtitle_typography',
				'selector' => '{{WRAPPER}} .ellens-rg-feature__subtitle',
			]
		);

		$widget->add_control(
			'feature_description_color',
			[
				'label' => esc_html__( 'Description Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'var(--color-primary)',
				'selectors' => [
					'{{WRAPPER}} .ellens-rg-feature__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feature_description_typography',
				'selector' => '{{WRAPPER}} .ellens-rg-feature__desc',
			]
		);

		$widget->end_controls_section();
	}
}
