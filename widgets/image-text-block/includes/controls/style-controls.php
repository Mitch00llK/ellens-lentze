<?php
namespace EllensLentze\Widgets\Image_Text_Block\Includes\Controls;

use \Elementor\Controls_Manager;

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
			'content_bg_color',
			[
				'label' => esc_html__( 'Content Background Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .image-text-block__content-wrapper' => 'background-color: {{VALUE}};',
				],
                'default' => '#002956',
			]
		);

        $widget->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .image-text-block__title' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Description Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .image-text-block__description' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

		$widget->end_controls_section();
	}
}
