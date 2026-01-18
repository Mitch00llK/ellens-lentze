<?php
namespace EllensLentze\Widgets\Contact_Info\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Opening_Hours_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_opening_hours',
			[
				'label' => esc_html__( 'Opening Hours', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'opening_hours_title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Openingstijden', 'ellens-lentze' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'hide_opening_hours_title',
			[
				'label' => esc_html__( 'Hide Opening Hours Title', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'day',
			[
				'label' => esc_html__( 'Day', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Maandag', 'ellens-lentze' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'hours',
			[
				'label' => esc_html__( 'Hours', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '09.00 – 17.00 uur', 'ellens-lentze' ),
				'label_block' => true,
			]
		);

		$widget->add_control(
			'opening_hours_list',
			[
				'label' => esc_html__( 'Hours List', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'day' => esc_html__( 'Maandag', 'ellens-lentze' ),
						'hours' => esc_html__( '09.00 – 17.00 uur', 'ellens-lentze' ),
					],
					[
						'day' => esc_html__( 'Dinsdag', 'ellens-lentze' ),
						'hours' => esc_html__( '09.00 – 20.00 uur', 'ellens-lentze' ),
					],
					[
						'day' => esc_html__( 'Woensdag', 'ellens-lentze' ),
						'hours' => esc_html__( '09.00 – 17.00 uur', 'ellens-lentze' ),
					],
					[
						'day' => esc_html__( 'Donderdag', 'ellens-lentze' ),
						'hours' => esc_html__( '09.00 – 17.00 uur', 'ellens-lentze' ),
					],
					[
						'day' => esc_html__( 'Vrijdag', 'ellens-lentze' ),
						'hours' => esc_html__( '09.00 – 17.00 uur', 'ellens-lentze' ),
					],
				],
				'title_field' => '{{{ day }}}',
			]
		);

		$widget->add_control(
			'opening_hours_footer',
			[
				'label' => esc_html__( 'Footer Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Op afspraak kunt u ook buiten de normale openingstijden bij ons terecht, dagelijks kan dit tussen 8.00 uur en 20.00 uur.', 'ellens-lentze' ),
				'label_block' => true,
			]
		);

		$widget->add_control(
			'hide_opening_hours_footer',
			[
				'label' => esc_html__( 'Hide Opening Hours Footer', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$widget->add_control(
			'hide_opening_hours_section',
			[
				'label' => esc_html__( 'Hide Opening Hours Section', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
				'description' => esc_html__( 'Hide the entire opening hours section (title, list, and footer).', 'ellens-lentze' ),
			]
		);

		$widget->end_controls_section();
	}
}
