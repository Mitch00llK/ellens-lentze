<?php
namespace EllensLentze\Widgets\Contact_Info\Includes\Controls;

use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Primary_Contact_Controls {

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
	}
}
