<?php
namespace EllensLentze\Widgets\Detailed_Info_Section\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Style_Controls {

	public static function register( $widget ) {

		// Content Style
		$widget->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dis-content__title' => 'color: {{VALUE}};',
				],
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .dis-content__title',
			]
		);

        $widget->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Text Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dis-content__text' => 'color: {{VALUE}};',
				],
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .dis-content__text',
			]
		);

		$widget->end_controls_section();

        // Card Style
        $widget->start_controls_section(
			'section_style_card',
			[
				'label' => esc_html__( 'Sidebar Card', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'card_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dis-card' => 'background-color: {{VALUE}};',
				],
			]
		);

        $widget->add_control(
			'cta_bg_color',
			[
				'label' => esc_html__( 'CTA Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dis-card__cta' => 'background-color: {{VALUE}};',
				],
			]
		);

        $widget->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Button Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();
	}
}
