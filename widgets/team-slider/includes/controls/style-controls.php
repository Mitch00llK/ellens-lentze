<?php
namespace EllensLentze\Widgets\Team_Slider\Includes\Controls;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

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
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .section-title',
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
			'card_name_color',
			[
				'label' => esc_html__( 'Name Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-name' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'card_name_typography',
                'label' => esc_html__( 'Name Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .team-name',
			]
		);

        $widget->add_control(
			'card_job_color',
			[
				'label' => esc_html__( 'Job Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-job' => 'color: {{VALUE}};',
				],
                'default' => '#ef8a00',
			]
		);

        $widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'card_job_typography',
                'label' => esc_html__( 'Job Title Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .team-job',
			]
		);

        $widget->add_control(
			'card_arrow_bg',
			[
				'label' => esc_html__( 'Arrow Background', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-arrow' => 'background-color: {{VALUE}};',
				],
                'default' => '#ef8a00',
			]
		);

        $widget->add_control(
			'card_arrow_color',
			[
				'label' => esc_html__( 'Arrow Icon Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-arrow' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

        $widget->end_controls_section();
	}
}
