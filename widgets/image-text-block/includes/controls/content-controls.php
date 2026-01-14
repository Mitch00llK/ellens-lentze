<?php
namespace EllensLentze\Widgets\Image_Text_Block\Includes\Controls;

use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'image_position',
			[
				'label' => esc_html__( 'Image Position', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Left', 'ellens-lentze' ),
					'right' => esc_html__( 'Right', 'ellens-lentze' ),
				],
			]
		);

        $widget->end_controls_section();

        $widget->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$widget->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Professionele aanpak met persoonlijke aandacht', 'ellens-lentze' ),
			]
		);

		$widget->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Een goed testament is essentieel om ervoor te zorgen dat uw wensen worden gerespecteerd.', 'ellens-lentze' ),
			]
		);

        $widget->end_controls_section();

        $widget->start_controls_section(
			'section_buttons',
			[
				'label' => esc_html__( 'Buttons', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        /* Primary Button */
        $widget->add_control(
			'btn_primary_text',
			[
				'label' => esc_html__( 'Primary Button Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Over ons', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'btn_primary_link',
			[
				'label' => esc_html__( 'Primary Button Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
                'default' => [
					'url' => '#',
				],
			]
		);

        $widget->add_control(
			'btn_primary_style',
			[
				'label' => esc_html__( 'Primary Button Style', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'primary',
				'options' => [
					'primary' => esc_html__( 'Primary (Blue)', 'ellens-lentze' ),
					'secondary' => esc_html__( 'Secondary (Orange)', 'ellens-lentze' ),
					'ghost' => esc_html__( 'Ghost', 'ellens-lentze' ),
					'outline' => esc_html__( 'Outline', 'ellens-lentze' ),
				],
			]
		);

        /* Secondary Button (Optional) */
        $widget->add_control(
			'show_btn_secondary',
			[
				'label' => esc_html__( 'Show Secondary Button', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ellens-lentze' ),
				'label_off' => esc_html__( 'Hide', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

        $widget->add_control(
			'btn_secondary_text',
			[
				'label' => esc_html__( 'Secondary Button Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Contact', 'ellens-lentze' ),
                'condition' => [
					'show_btn_secondary' => 'yes',
				],
			]
		);

		$widget->add_control(
			'btn_secondary_link',
			[
				'label' => esc_html__( 'Secondary Button Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
                'default' => [
					'url' => '#',
				],
                'condition' => [
					'show_btn_secondary' => 'yes',
				],
			]
		);

        $widget->add_control(
			'btn_secondary_style',
			[
				'label' => esc_html__( 'Secondary Button Style', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'secondary',
				'options' => [
					'primary' => esc_html__( 'Primary (Blue)', 'ellens-lentze' ),
					'secondary' => esc_html__( 'Secondary (Orange)', 'ellens-lentze' ),
					'ghost' => esc_html__( 'Ghost', 'ellens-lentze' ),
					'outline' => esc_html__( 'Outline', 'ellens-lentze' ),
				],
                'condition' => [
					'show_btn_secondary' => 'yes',
				],
			]
		);

		$widget->end_controls_section();
	}
}
