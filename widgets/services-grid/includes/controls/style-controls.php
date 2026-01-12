<?php
namespace EllensLentze\Widgets\Services_Grid\Includes\Controls;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Style_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_style_general',
			[
				'label' => esc_html__( 'General', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'main_title_color',
			[
				'label' => esc_html__( 'Main Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ellens-services-grid__title' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'main_title_typography',
                'label' => esc_html__( 'Main Title Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .ellens-services-grid__title',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
			]
		);

		$widget->end_controls_section();

        $widget->start_controls_section(
			'section_style_cards',
			[
				'label' => esc_html__( 'Cards', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'card_bg_color',
			[
				'label' => esc_html__( 'Card Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ellens-service-card' => 'background-color: {{VALUE}};',
				],
                'default' => '#002956',
			]
		);

        $widget->add_control(
			'card_title_color',
			[
				'label' => esc_html__( 'Card Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ellens-service-card__title' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'card_title_typography',
                'label' => esc_html__( 'Card Title Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .ellens-service-card__title',
			]
		);

        $widget->add_control(
			'card_desc_color',
			[
				'label' => esc_html__( 'Description Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ellens-service-card__description' => 'color: {{VALUE}};',
				],
                'default' => '#edf5fc',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'card_desc_typography',
                'label' => esc_html__( 'Description Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .ellens-service-card__description',
			]
		);

        $widget->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ellens-service-card__icon' => 'color: {{VALUE}};',
				],
                'default' => '#f6921e',
			]
		);

        $widget->add_control(
			'button_bg_color',
			[
				'label' => esc_html__( 'Button Background', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ellens-service-card__arrow' => 'background-color: {{VALUE}};',
				],
                'default' => '#004590',
			]
		);

        $widget->add_control(
			'button_icon_color',
			[
				'label' => esc_html__( 'Button Icon Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ellens-service-card__arrow' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->end_controls_section();
	}
}
