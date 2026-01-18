<?php
namespace EllensLentze\Widgets\Contact_Info\Includes\Controls;

use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Contact Information', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'heading',
			[
				'label' => esc_html__( 'Heading', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'U kunt ons vinden en bereiken via', 'ellens-lentze' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'hide_heading',
			[
				'label' => esc_html__( 'Hide Heading', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$widget->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Bij ons bent u van harte welkom! Onze openingstijden zijn als volgt: Maandag tot en met Vrijdag van 09.00 tot 17.00 uur, met een verlenging op Dinsdag tot 20.00 uur. Voor afspraken buiten deze tijden kunt u dagelijks terecht van 08.00 tot 20.00 uur. We kijken ernaar uit u te zien!', 'ellens-lentze' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'hide_description',
			[
				'label' => esc_html__( 'Hide Description', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

        $widget->add_control(
			'address',
			[
				'label' => esc_html__( 'Address', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Parkstraat 94, 2514 JH Den Haag', 'ellens-lentze' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'hide_address',
			[
				'label' => esc_html__( 'Hide Address', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

        $widget->add_control(
			'email',
			[
				'label' => esc_html__( 'Email', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'notaris@ellenslentze.nl', 'ellens-lentze' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'hide_email',
			[
				'label' => esc_html__( 'Hide Email', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

        $widget->add_control(
			'phone',
			[
				'label' => esc_html__( 'Phone', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '070 364 48 30', 'ellens-lentze' ),
			'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'hide_phone',
			[
				'label' => esc_html__( 'Hide Phone', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$widget->end_controls_section();

		// Opening Hours Section
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

		$repeater = new \Elementor\Repeater();

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

		$widget->start_controls_section(
			'section_financial',
			[
				'label' => esc_html__( 'Financial Details', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'btw_number',
			[
				'label' => esc_html__( 'BTW Number', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'NL00.65.55.676.B.01', 'ellens-lentze' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'hide_btw_number',
			[
				'label' => esc_html__( 'Hide BTW Number', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$widget->add_control(
			'bank_account_label',
			[
				'label' => esc_html__( 'Bank Account Label', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Rekeningnummer', 'ellens-lentze' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'hide_bank_account_label',
			[
				'label' => esc_html__( 'Hide Bank Account Label', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$widget->add_control(
			'bank_account_details',
			[
				'label' => esc_html__( 'Bank Account Details', 'ellens-lentze' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => 'NL 51 RABO 0383 1759 09 t.n.v.<br>Kwaliteitsrekening Ellens & Lentze',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'hide_bank_account_details',
			[
				'label' => esc_html__( 'Hide Bank Account Details', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
	}
}
