<?php
namespace EllensLentze\Widgets\Sidebar_FAQ\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

		// FAQ Section
		$widget->start_controls_section(
			'section_faq',
			[
				'label' => esc_html__( 'FAQ Items', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'title',
			[
				'label' => esc_html__( 'Section Title', 'ellens-lentze' ),
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
				'default' => esc_html__( "Introduction text before the accordion.", 'ellens-lentze' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_type',
			[
				'label' => esc_html__( 'Item Type', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'question',
				'options' => [
					'question' => esc_html__( 'Question', 'ellens-lentze' ),
					'section'  => esc_html__( 'Section Header', 'ellens-lentze' ),
				],
			]
		);

        $repeater->add_control(
			'section_title',
			[
				'label' => esc_html__( 'Section Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'General Questions', 'ellens-lentze' ),
                'label_block' => true,
				'condition' => [
					'item_type' => 'section',
				],
			]
		);

        $repeater->add_control(
			'section_id',
			[
				'label' => esc_html__( 'Section ID (Anchor)', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Unique ID for sidebar navigation (e.g., "billing").', 'ellens-lentze' ),
				'condition' => [
					'item_type' => 'section',
				],
			]
		);

		$repeater->add_control(
			'question',
			[
				'label' => esc_html__( 'Question', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Wat komt er kijken bij een samenlevingscontract?', 'ellens-lentze' ),
				'label_block' => true,
                'condition' => [
					'item_type' => 'question',
				],
			]
		);

		$repeater->add_control(
			'answer',
			[
				'label' => esc_html__( 'Answer', 'ellens-lentze' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Answer content goes here.', 'ellens-lentze' ),
                'condition' => [
					'item_type' => 'question',
				],
			]
		);

		$widget->add_control(
			'faq_items',
			[
				'label' => esc_html__( 'FAQs', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
                    [ 'item_type' => 'section', 'section_title' => 'General', 'section_id' => 'general' ],
					[ 'item_type' => 'question', 'question' => esc_html__( 'Sample Question 1', 'ellens-lentze' ) ],
					[ 'item_type' => 'question', 'question' => esc_html__( 'Sample Question 2', 'ellens-lentze' ) ],
				],
				'title_field' => '{{{ item_type === "section" ? "SECTION: " + section_title : question }}}',
			]
		);

		$widget->end_controls_section();

        // Sidebar Card Section
        $widget->start_controls_section(
			'section_sidebar',
			[
				'label' => esc_html__( 'Sidebar Card', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
            'show_card_image',
            [
                'label' => esc_html__( 'Show Image', 'ellens-lentze' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'ellens-lentze' ),
                'label_off' => esc_html__( 'Hide', 'ellens-lentze' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $widget->add_control(
			'card_image',
			[
				'label' => esc_html__( 'Card Image', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'show_card_image' => 'yes',
                ],
			]
		);

        $widget->add_control(
			'card_title',
			[
				'label' => esc_html__( 'CTA Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Waar kunnen wij bij helpen?', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'card_description',
			[
				'label' => esc_html__( 'CTA Description', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Office ipsum you must be muted.', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
            'show_card_button',
            [
                'label' => esc_html__( 'Show Button', 'ellens-lentze' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'ellens-lentze' ),
                'label_off' => esc_html__( 'Hide', 'ellens-lentze' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $widget->add_control(
			'card_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Contact', 'ellens-lentze' ),
                'condition' => [
                    'show_card_button' => 'yes',
                ],
			]
		);

        $widget->add_control(
			'card_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
                'condition' => [
                    'show_card_button' => 'yes',
                ],
			]
		);

        $widget->add_control(
            'button_style',
            [
                'label'   => esc_html__( 'Button Style', 'ellens-lentze' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'btn--primary',
                'options' => [
                    'btn--primary'   => esc_html__( 'Primary', 'ellens-lentze' ),
                    'btn--secondary' => esc_html__( 'Secondary', 'ellens-lentze' ),
                    'btn--ghost'     => esc_html__( 'Ghost', 'ellens-lentze' ),
                    'btn--outline'   => esc_html__( 'Outline', 'ellens-lentze' ),
                ],
                'condition' => [
                    'show_card_button' => 'yes',
                ],
            ]
        );

        /* USPs Removed as per request */

        $widget->end_controls_section();
	}
}
