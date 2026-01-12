<?php
namespace EllensLentze\Widgets\Action_Buttons\Includes\Controls;

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
			'card_bg_color',
			[
				'label' => esc_html__( 'Card Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .action-buttons__card' => 'background-color: {{VALUE}};',
				],
                'default' => '#002956',
			]
		);

        $widget->add_control(
			'text_color_title',
			[
				'label' => esc_html__( 'Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .action-buttons__title' => 'color: {{VALUE}};',
				],
                'default' => '#edf5fc',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .action-buttons__title',
			]
		);

        $widget->add_control(
			'text_color_desc',
			[
				'label' => esc_html__( 'Description Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .action-buttons__description' => 'color: {{VALUE}};',
				],
                'default' => '#edf5fc',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .action-buttons__description',
			]
		);

		$widget->end_controls_section();

        $widget->start_controls_section(
			'section_style_buttons',
			[
				'label' => esc_html__( 'Buttons Style', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .action-buttons__item' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .action-buttons__item' => 'border-color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);
        
        $widget->add_control(
			'button_hover_bg',
			[
				'label' => esc_html__( 'Hover Background', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .action-buttons__item:hover' => 'background-color: {{VALUE}};',
				],
                'default' => 'rgba(255, 255, 255, 0.1)',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .action-buttons__item',
			]
		);

        $widget->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'ellens-lentze' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .action-buttons__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $widget->end_controls_section();
	}
}
