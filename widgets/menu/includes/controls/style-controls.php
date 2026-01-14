<?php
namespace EllensLentze\Widgets\Menu\Includes\Controls;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Style_Controls {

	public static function register( $widget ) {

        // Container Style
        $widget->start_controls_section(
			'section_style_container',
			[
				'label' => esc_html__( 'Container', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'container_bg',
			[
				'label' => esc_html__( 'Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

        $widget->add_responsive_control(
			'container_padding',
			[
				'label' => esc_html__( 'Padding', 'ellens-lentze' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .menu-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $widget->end_controls_section();

        // Links Style
		$widget->start_controls_section(
			'section_style_links',
			[
				'label' => esc_html__( 'Menu Links', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'links_typography',
				'selector' => '{{WRAPPER}} .menu__nav-link',
			]
		);

        $widget->add_control(
			'links_color',
			[
				'label' => esc_html__( 'Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu__nav-link' => 'color: {{VALUE}};',
				],
			]
		);

        $widget->add_control(
			'links_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu__nav-link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();

        // Utility Buttons Style
        $widget->start_controls_section(
			'section_style_utilities',
			[
				'label' => esc_html__( 'Utility Buttons', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'utility_typography',
				'selector' => '{{WRAPPER}} .menu__utility-btn',
			]
		);

        $widget->end_controls_section();
	}
}
