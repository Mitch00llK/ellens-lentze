<?php
namespace EllensLentze\Widgets\Services_Cluster\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

        /* Visuals Section */
		$widget->start_controls_section(
			'section_visuals',
			[
				'label' => esc_html__( 'Visuals', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'mask_image',
			[
				'label' => esc_html__( 'Mask Shape (SVG)', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Upload an SVG to use as the mask shape.', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'center_image',
			[
				'label' => esc_html__( 'Center Image', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $widget->end_controls_section();

        /* Services Section (Repeater) */
        $widget->start_controls_section(
			'section_services',
			[
				'label' => esc_html__( 'Services', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'ellens-lentze' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

        $repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Service Title', 'ellens-lentze' ),
                'label_block' => true,
			]
		);

        $repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Short description of the service.', 'ellens-lentze' ),
			]
		);

        $repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
			]
		);

        $repeater->add_control(
			'hr_position',
			[
				'label' => esc_html__( 'Horizontal Position', 'ellens-lentze' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $repeater->add_control(
			'horizontal_anchor',
			[
				'label' => esc_html__( 'Horizontal Anchor', 'ellens-lentze' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'ellens-lentze' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ellens-lentze' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'toggle' => false,
			]
		);

        $repeater->add_responsive_control(
			'horizontal_value',
			[
				'label' => esc_html__( 'Horizontal Distance', 'ellens-lentze' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw', 'rem' ],
				'range' => [
					'px' => [ 'min' => -500, 'max' => 1000 ],
					'%'  => [ 'min' => -50, 'max' => 150 ],
                    'vw' => [ 'min' => -50, 'max' => 150 ],
				],
				'default' => [
					'unit' => '%',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => '{{horizontal_anchor.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $repeater->add_control(
			'vr_position',
			[
				'label' => esc_html__( 'Vertical Position', 'ellens-lentze' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $repeater->add_control(
			'vertical_anchor',
			[
				'label' => esc_html__( 'Vertical Anchor', 'ellens-lentze' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'ellens-lentze' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'ellens-lentze' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);

        $repeater->add_responsive_control(
			'vertical_value',
			[
				'label' => esc_html__( 'Vertical Distance', 'ellens-lentze' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh', 'rem' ],
				'range' => [
					'px' => [ 'min' => -500, 'max' => 1000 ],
					'%'  => [ 'min' => -50, 'max' => 150 ],
                    'vh' => [ 'min' => -50, 'max' => 150 ],
				],
				'default' => [
					'unit' => '%',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => '{{vertical_anchor.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $widget->add_control(
			'items',
			[
				'label' => esc_html__( 'Service Items', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
                    [ 'title' => 'Familierecht' ],
                    [ 'title' => 'Vastgoedrecht' ],
                    [ 'title' => 'Ondernemingsrecht' ],
                    [ 'title' => 'Mediation' ],
                ],
				'title_field' => '{{{ title }}}',
			]
		);

		$widget->end_controls_section();
	}
}
