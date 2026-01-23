<?php
namespace EllensLentze\Widgets\Hero\Includes\Controls;

use \Elementor\Controls_Manager;

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
            'layout_template',
            [
                'label'   => esc_html__( 'Layout Template', 'ellens-lentze' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'         => esc_html__( 'Floating Card (Default)', 'ellens-lentze' ),
                    'full_width_blue' => esc_html__( 'Full Width Blue', 'ellens-lentze' ),
                ],
            ]
        );
        $widget->add_control(
			'show_card_container',
			[
				'label' => esc_html__( 'Show Card Container', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ellens-lentze' ),
				'label_off' => esc_html__( 'Hide', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $widget->add_control(
			'card_alignment',
			[
				'label' => esc_html__( 'Card Alignment', 'ellens-lentze' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'ellens-lentze' ),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ellens-lentze' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'right',
				'condition' => [
					'layout_template' => 'default',
					'show_card_container' => 'yes',
				],
				'toggle' => true,
			]
		);

        $widget->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'ELLENS & LENTZE', 'ellens-lentze' ),
				'placeholder' => esc_html__( 'Type your subtitle here', 'ellens-lentze' ),
                'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Wij zijn er voor alle belangrijke gebeurtenissen in uw leven.', 'ellens-lentze' ),
				'placeholder' => esc_html__( 'Type your title here', 'ellens-lentze' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'show_description',
			[
				'label' => esc_html__( 'Show Description', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ellens-lentze' ),
				'label_off' => esc_html__( 'Hide', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);

        $widget->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Wij zijn er voor alle belangrijke gebeurtenissen in uw leven.', 'ellens-lentze' ),
				'placeholder' => esc_html__( 'Type your description here', 'ellens-lentze' ),
				'condition' => [
					'show_description' => 'yes',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'show_button',
			[
				'label' => esc_html__( 'Show Button', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ellens-lentze' ),
				'label_off' => esc_html__( 'Hide', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);

        $widget->add_control(
			'link_text',
			[
				'label' => esc_html__( 'Link Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Onze expertises', 'ellens-lentze' ),
				'condition' => [
					'show_button' => 'yes',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'link_url',
			[
				'label' => esc_html__( 'Link URL', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'show_button' => 'yes',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_control(
			'button_style',
			[
				'label' => esc_html__( 'Button Style', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'primary',
				'options' => [
					'primary' => esc_html__( 'Primary (Blue)', 'ellens-lentze' ),
					'secondary' => esc_html__( 'Secondary (Orange)', 'ellens-lentze' ),
					'ghost' => esc_html__( 'Ghost', 'ellens-lentze' ),
					'outline' => esc_html__( 'Outline', 'ellens-lentze' ),
				],
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);

        $widget->end_controls_section();

        // Contact Form Section (for Floating Card layout)
        $widget->start_controls_section(
			'section_contact_form',
			[
				'label' => esc_html__( 'Contact Form', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout_template' => 'default',
				],
			]
		);

        $widget->add_control(
			'enable_contact_form',
			[
				'label' => esc_html__( 'Enable Contact Form', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__( 'Add a contact form below the card content.', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'form_heading',
			[
				'label' => esc_html__( 'Form Heading', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Vragen of opmerkingen?', 'ellens-lentze' ),
				'placeholder' => esc_html__( 'Vragen of opmerkingen?', 'ellens-lentze' ),
				'label_block' => true,
				'condition' => [
					'layout_template' => 'default',
					'enable_contact_form' => 'yes',
				],
			]
		);

        $widget->add_control(
			'gravity_form_shortcode',
			[
				'label' => esc_html__( 'Gravity Forms Shortcode', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => '[gravityform id="1" title="false" description="false"]',
				'placeholder' => '[gravityform id="1" title="false" description="false"]',
				'description' => esc_html__( 'Enter your Gravity Forms shortcode. Example: [gravityform id="1" title="false" description="false"]', 'ellens-lentze' ),
				'label_block' => true,
				'condition' => [
					'layout_template' => 'default',
					'enable_contact_form' => 'yes',
				],
			]
		);

        $widget->end_controls_section();

        $widget->start_controls_section(
			'section_images',
			[
				'label' => esc_html__( 'Images', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'image',
			[
				'label' => esc_html__( 'Background Image', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'large',
			]
		);

        $widget->add_control(
			'graphic_overlay',
			[
				'label' => esc_html__( 'Graphic Overlay', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
                'description' => esc_html__( 'Upload the SVG graphic overlay.', 'ellens-lentze' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $widget->end_controls_section();
	}
}
