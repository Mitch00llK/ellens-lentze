<?php
namespace EllensLentze\Widgets\Services_Grid\Includes\Controls;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'section_title',
			[
				'label' => esc_html__( 'Main Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Wij kunnen met het volgende helpen', 'ellens-lentze' ),
				'placeholder' => esc_html__( 'Enter section title', 'ellens-lentze' ),
                'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater = new Repeater();

        $repeater->add_control(
			'card_icon',
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
			'card_title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Card Title', 'ellens-lentze' ),
				'label_block' => true,
                'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'card_description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Office ipsum you must be muted. Lets anyway submit globalize manage unlock stronger.', 'ellens-lentze' ),
				'show_label' => true,
                'dynamic' => [
					'active' => true,
				],
			]
		);

        $repeater->add_control(
			'card_link',
			[
				'label' => esc_html__( 'Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
					'custom_attributes' => '',
				],
			]
		);

        $repeater->add_control(
			'card_is_featured',
			[
				'label' => esc_html__( 'Is Featured (Tall)', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

         $repeater->add_control(
			'card_bg_graphic',
			[
				'label' => esc_html__( 'Background Graphic', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
                'condition' => [
                    'card_is_featured' => 'yes',
                ],
			]
		);

        $repeater->add_control(
			'card_hide',
			[
				'label' => esc_html__( 'Hide Card', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$widget->add_control(
			'cards_list',
			[
				'label' => esc_html__( 'Cards', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'card_title' => esc_html__( 'Samenwonen', 'ellens-lentze' ),
					],
                    [
						'card_title' => esc_html__( 'Nalaten', 'ellens-lentze' ),
                        'card_description' => 'Office ipsum you must be muted. Lets anyway submit globalize manage unlock stronger.',
                        'card_is_featured' => 'yes',
					],
                    [
						'card_title' => esc_html__( 'Wonen', 'ellens-lentze' ),
					],
                    [
						'card_title' => esc_html__( 'Ondernemen', 'ellens-lentze' ),
					],
                    [
						'card_title' => esc_html__( 'Scheiden', 'ellens-lentze' ),
					],
				],
				'title_field' => '{{{ card_title }}}',
			]
		);

		$widget->end_controls_section();

	}
}
