<?php
/**
 * Content controls for FAQ Section widget.
 */

namespace EllensLentze\Widgets\FAQ_Section\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

		// Left Content Section
		$widget->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content Block', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Veelgestelde vragen', 'ellens-lentze' ),
				'label_block' => true,
			]
		);

		$widget->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( "In today's fast-paced work environment, effective communication is key to success. With the rise of remote work, it's essential to adapt our communication styles to ensure clarity and collaboration.<Max 200 tekens>", 'ellens-lentze' ),
			]
		);

		$widget->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Veelgestelde vragen', 'ellens-lentze' ),
			]
		);

		$widget->add_control(
			'btn_link',
			[
				'label' => esc_html__( 'Button Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
			]
		);

		$widget->end_controls_section();

		// FAQ Section
		$widget->start_controls_section(
			'section_faq',
			[
				'label' => esc_html__( 'FAQ Items', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'question',
			[
				'label' => esc_html__( 'Question', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Wat komt er kijken bij een samenlevingscontract?', 'ellens-lentze' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'answer',
			[
				'label' => esc_html__( 'Answer', 'ellens-lentze' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Answer content goes here.', 'ellens-lentze' ),
			]
		);

		$widget->add_control(
			'faq_items',
			[
				'label' => esc_html__( 'FAQs', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[ 'question' => esc_html__( 'Wat komt er kijken bij een samenlevingscontract?', 'ellens-lentze' ) ],
					[ 'question' => esc_html__( 'Wat komt er kijken bij een samenlevingscontract?', 'ellens-lentze' ) ],
					[ 'question' => esc_html__( 'Wat komt er kijken bij een samenlevingscontract?', 'ellens-lentze' ) ],
				],
				'title_field' => '{{{ question }}}',
			]
		);

		$widget->end_controls_section();
	}
}
