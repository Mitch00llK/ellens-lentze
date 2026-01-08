<?php
namespace EllensLentze\Widgets\Hero\Includes\Controls;

use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Style_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content Style', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'card_bg_color',
			[
				'label' => esc_html__( 'Card Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__card-bg' => 'background-color: {{VALUE}};',
				],
                'default' => '#004590',
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

		$widget->end_controls_section();

        $widget->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button Style', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
			'button_border_color',
			[
				'label' => esc_html__( 'Border Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__button' => 'border-color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);
        
        $widget->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Hover Text Color', 'ellens-lentze' ),
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
				'label' => esc_html__( 'Hover Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero__button:hover' => 'background-color: {{VALUE}};',
				],
                'default' => 'rgba(255, 255, 255, 0.1)',
			]
		);

        $widget->end_controls_section();
	}
}
