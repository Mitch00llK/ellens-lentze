<?php
namespace EllensLentze\Widgets\News_Overview\Includes\Controls;

use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Style_Controls {

	public static function register( $widget ) {
        // Section: Header Style
        $widget->start_controls_section(
            'section_style_header',
            [
                'label' => esc_html__( 'Header', 'ellens-lentze' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .news-overview__title',
			]
		);

        $widget->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'ellens-lentze' ),
				'type' => Controls_Manager::COLOR,
                'default' => 'var(--color-primary-900)',
				'selectors' => [
					'{{WRAPPER}} .news-overview__title' => 'color: {{VALUE}}',
				],
			]
		);

        $widget->end_controls_section();

        // Section: Filter Style
        $widget->start_controls_section(
            'section_style_filter',
            [
                'label' => esc_html__( 'Filter Bar', 'ellens-lentze' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_control(
            'filter_active_color',
            [
                'label' => esc_html__( 'Active Color', 'ellens-lentze' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'var(--color-primary-500)',
                'selectors' => [
                    '{{WRAPPER}} .news-overview__filter-btn.active' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .news-overview__filter-btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $widget->end_controls_section();

        // Section: Card Style
        $widget->start_controls_section(
            'section_style_cards',
            [
                'label' => esc_html__( 'Cards', 'ellens-lentze' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

         $widget->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'ellens-lentze' ),
				'selector' => '{{WRAPPER}} .news-overview__item-image, {{WRAPPER}} .news-overview__featured-card',
			]
		);

        $widget->end_controls_section();
    }
}
