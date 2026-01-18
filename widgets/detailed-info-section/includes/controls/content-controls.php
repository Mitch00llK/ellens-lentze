<?php
namespace EllensLentze\Widgets\Detailed_Info_Section\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

		// Content Section
		$widget->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Main Content', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'content_source',
			[
				'label' => esc_html__( 'Content Source', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'manual',
				'options' => [
					'manual' => esc_html__( 'Manual Content', 'ellens-lentze' ),
					'current_post' => esc_html__( 'Current Post', 'ellens-lentze' ),
				],
			]
		);

        $content_repeater = new Repeater();

        $content_repeater->add_control(
			'block_title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Block Title', 'ellens-lentze' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $content_repeater->add_control(
			'block_content',
			[
				'label' => esc_html__( 'Content', 'ellens-lentze' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Enter your content here.', 'ellens-lentze' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'content_blocks',
			[
				'label' => esc_html__( 'Content Blocks', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $content_repeater->get_controls(),
				'default' => [
					[
						'block_title' => esc_html__( 'Gefeliciteerd, u gaat samenwonen!', 'ellens-lentze' ),
					],
				],
				'title_field' => '{{{ block_title }}}',
				'condition' => [
					'content_source' => 'manual',
				],
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
			'card_image',
			[
				'label' => esc_html__( 'Card Image', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'card_type',
			[
				'label' => esc_html__( 'Card Type', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cta',
				'options' => [
					'cta' => esc_html__( 'CTA Card', 'ellens-lentze' ),
					'contact' => esc_html__( 'Contact Card', 'ellens-lentze' ),
				],
			]
		);

        $contact_repeater = new Repeater();

        $contact_repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'ellens-lentze' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-envelope',
					'library' => 'solid',
				],
			]
		);

        $contact_repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'info@example.com', 'ellens-lentze' ),
                'dynamic' => [
					'active' => true,
				],
			]
		);

        $contact_repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'mailto:info@example.com', 'ellens-lentze' ),
                'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'contact_items',
			[
				'label' => esc_html__( 'Contact Items', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $contact_repeater->get_controls(),
				'default' => [
					[
						'icon' => [ 'value' => 'fas fa-envelope', 'library' => 'solid' ],
                        'text' => 'info@ellenslentze.nl',
                        'link' => [ 'url' => 'mailto:info@ellenslentze.nl' ]
					],
                    [
						'icon' => [ 'value' => 'fas fa-phone', 'library' => 'solid' ],
                        'text' => '070 364 48 30',
                        'link' => [ 'url' => 'tel:0703644830' ]
					],
				],
				'title_field' => '{{{ text }}}',
				'condition' => [
					'card_type' => 'contact',
				],
			]
		);

        $widget->add_control(
			'card_title',
			[
				'label' => esc_html__( 'CTA Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Waar kunnen wij bij helpen?', 'ellens-lentze' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'card_description',
			[
				'label' => esc_html__( 'CTA Description', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Office ipsum you must be muted.', 'ellens-lentze' ),
				'dynamic' => [
					'active' => true,
				],
                'condition' => [
                    'card_type' => 'cta',
                ],
			]
		);

        $widget->add_control(
			'card_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Contact', 'ellens-lentze' ),
				'dynamic' => [
					'active' => true,
				],
                'condition' => [
                    'card_type' => 'cta',
                ],
			]
		);

        $widget->add_control(
			'card_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
				'dynamic' => [
					'active' => true,
				],
                'condition' => [
                    'card_type' => 'cta',
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
                    'card_type' => 'cta',
                ],
            ]
        );

        $usp_repeater = new Repeater();

        $usp_repeater->add_control(
			'usp_text',
			[
				'label' => esc_html__( 'USP Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'USP Item', 'ellens-lentze' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'usps',
			[
				'label' => esc_html__( 'USPs', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $usp_repeater->get_controls(),
				'default' => [
					[ 'usp_text' => esc_html__( 'Specialisten', 'ellens-lentze' ) ],
					[ 'usp_text' => esc_html__( 'Persoonlijke aandacht', 'ellens-lentze' ) ],
					[ 'usp_text' => esc_html__( 'Toegankelijk', 'ellens-lentze' ) ],
				],
				'title_field' => '{{{ usp_text }}}',
                'condition' => [
                    'card_type' => 'cta',
                ],
			]
		);

        $widget->end_controls_section();
	}
}
