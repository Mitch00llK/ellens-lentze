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

        $content_repeater = new Repeater();

        $content_repeater->add_control(
			'block_title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Block Title', 'ellens-lentze' ),
				'label_block' => true,
			]
		);

        $content_repeater->add_control(
			'block_content',
			[
				'label' => esc_html__( 'Content', 'ellens-lentze' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Enter your content here.', 'ellens-lentze' ),
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
			'card_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Contact', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'card_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
			]
		);

        $usp_repeater = new Repeater();

        $usp_repeater->add_control(
			'usp_text',
			[
				'label' => esc_html__( 'USP Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'USP Item', 'ellens-lentze' ),
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
			]
		);

        $widget->end_controls_section();
	}
}
