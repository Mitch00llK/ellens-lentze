<?php
namespace EllensLentze\Widgets\Image_Text_Block\Includes\Controls;

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

        $widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .image-text-block__title',
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



        $widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
                'label' => esc_html__( 'Description Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .image-text-block__description',
			]
		);

		$widget->end_controls_section();
	}
}
