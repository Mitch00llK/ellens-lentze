<?php
namespace EllensLentze\Widgets\Contact_Info\Includes\Controls;

use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Financial_Controls {

	public static function register( $widget ) {

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

		$widget->end_controls_section();
	}
}
