<?php
/**
 * Style controls for FAQ Section widget.
 */

namespace EllensLentze\Widgets\FAQ_Section\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Style_Controls {

	public static function register( $widget ) {

		// Section Style
		$widget->start_controls_section(
			'section_style_global',
			[
				'label' => esc_html__( 'Global', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ccdae9',
				'selectors' => [
					'{{WRAPPER}} .faq-section' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();

		// Content block style
		$widget->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content Block', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#004590',
				'selectors' => [
					'{{WRAPPER}} .faq-content__title' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .faq-content__title',
			]
		);

		$widget->end_controls_section();

		// Accordion Style
		$widget->start_controls_section(
			'section_style_accordion',
			[
				'label' => esc_html__( 'Accordion Items', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'acc_bg_color',
			[
				'label' => esc_html__( 'Item Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(237, 245, 252, 0.5)',
				'selectors' => [
					'{{WRAPPER}} .faq-accordion__header' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'acc_title_color',
			[
				'label' => esc_html__( 'Question Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#004590',
				'selectors' => [
					'{{WRAPPER}} .faq-accordion__title' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'acc_title_typography',
				'selector' => '{{WRAPPER}} .faq-accordion__title',
			]
		);

		$widget->end_controls_section();
	}
}
