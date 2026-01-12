<?php
namespace EllensLentze\Widgets\Post_Grid\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Style_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'ellens-lentze' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $widget->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ellens-lentze' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ellens-post-grid-wrapper' => 'background-color: {{VALUE}}',
				],
                // Default handling via variable fallback in CSS
			]
		);

        $widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => esc_html__( 'Section Title Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .section-title',
			]
		);

        $widget->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Section Title Color', 'ellens-lentze' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title' => 'color: {{VALUE}}',
				],
			]
		);

        $widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'post_title_typography',
                'label' => esc_html__( 'Post Title Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .post-title',
			]
		);

        $widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
                'label' => esc_html__( 'Category Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .post-category',
			]
		);

		$widget->end_controls_section();
	}
}
