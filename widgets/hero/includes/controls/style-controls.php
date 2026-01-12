<?php
namespace EllensLentze\Widgets\Hero\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Style_Controls {

	public static function register( $widget ) {

        /* Card Style Section */
		$widget->start_controls_section(
			'section_style_card',
			[
				'label' => esc_html__( 'Card', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'card_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__card-bg' => 'background-color: {{VALUE}};',
				],
                'default' => '#004590',
			]
		);

        $widget->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__( 'Padding', 'ellens-lentze' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem', '%' ],
				'selectors' => [
					'{{WRAPPER}} .hero__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

        /* Subtitle Style Section */
        $widget->start_controls_section(
			'section_style_subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Subtitle Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__subtitle' => 'color: {{VALUE}};',
				],
                'default' => '#ef8a00',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .hero__subtitle',
			]
		);

        $widget->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'ellens-lentze' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} .hero__subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $widget->end_controls_section();

        /* Title Style Section */
        $widget->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__title' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .hero__title',
			]
		);

        $widget->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'ellens-lentze' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} .hero__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $widget->end_controls_section();

        /* Description Style Section */
        $widget->start_controls_section(
			'section_style_description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Description Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__description' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .hero__description',
			]
		);

        $widget->add_responsive_control(
			'description_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'ellens-lentze' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} .hero__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $widget->end_controls_section();

        /* Button Style Section */
        $widget->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->start_controls_tabs( 'tabs_button_style' );

        $widget->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__button' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->add_control(
			'button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__button' => 'background-color: {{VALUE}};',
				],
			]
		);

        $widget->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .hero__button',
			]
		);

        $widget->end_controls_tab();

        $widget->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__button:hover' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__button:hover' => 'background-color: {{VALUE}};',
				],
                'default' => 'rgba(255, 255, 255, 0.1)',
			]
		);

        $widget->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

        $widget->end_controls_tab();

        $widget->end_controls_tabs();

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .hero__button',
			]
		);

        $widget->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'ellens-lentze' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .hero__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $widget->end_controls_section();
	}
}
