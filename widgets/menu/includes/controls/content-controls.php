<?php
namespace EllensLentze\Widgets\Menu\Includes\Controls;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

        // Logo Section
		$widget->start_controls_section(
			'section_logo',
			[
				'label' => esc_html__( 'Logo', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'logo_image',
			[
				'label' => esc_html__( 'Logo Image', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $widget->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'logo_image',
				'default' => 'full',
				'separator' => 'none',
			]
		);

        $widget->add_control(
			'logo_link',
			[
				'label' => esc_html__( 'Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
				'default' => [
					'url' => home_url( '/' ),
				],
			]
		);

		$widget->end_controls_section();
        
        // Search Section
        $widget->start_controls_section(
			'section_search',
			[
				'label' => esc_html__( 'Search', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'search_enabled',
			[
				'label' => esc_html__( 'Enable Search', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ellens-lentze' ),
				'label_off' => esc_html__( 'Hide', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $post_types = get_post_types( [ 'public' => true ], 'objects' );
        $post_type_options = [];
        foreach ( $post_types as $post_type ) {
            $post_type_options[ $post_type->name ] = $post_type->label;
        }

        $widget->add_control(
			'search_post_types',
			[
				'label' => esc_html__( 'Search Post Types', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $post_type_options,
				'multiple' => true,
				'default' => [ 'post', 'page' ],
                'condition' => [
                    'search_enabled' => 'yes',
                ],
			]
		);

        $widget->end_controls_section();

        // Utility Buttons (Phone, Email)
        $widget->start_controls_section(
			'section_utilities',
			[
				'label' => esc_html__( 'Utility Buttons', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '070 - 364 48 30', 'ellens-lentze' ),
                'label_block' => true,
			]
		);

        $repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'tel:0703644830', 'ellens-lentze' ),
			]
		);

        $repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'ellens-lentze' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-phone',
					'library' => 'fa-solid',
				],
			]
		);

        $widget->add_control(
			'utility_buttons',
			[
				'label' => esc_html__( 'Buttons', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => '070 - 364 48 30',
						'link' => ['url' => 'tel:0703644830'],
                        'icon' => ['value' => 'fas fa-phone', 'library' => 'fa-solid'],
					],
                    [
						'text' => 'notaris@ellenslentze.nl',
						'link' => ['url' => 'mailto:notaris@ellenslentze.nl'],
                        'icon' => ['value' => 'fas fa-envelope', 'library' => 'fa-solid'],
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

        $widget->end_controls_section();

        // Main Navigation
        $widget->start_controls_section(
			'section_menu',
			[
				'label' => esc_html__( 'Navigation', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $menus = get_terms( 'nav_menu', [ 'hide_empty' => true ] );
		$options = [ '' => '' ];
		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		$widget->add_control(
			'menu',
			[
				'label' => esc_html__( 'Menu', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'options' => $options,
				'default' => array_keys( $options )[0],
			]
		);

        $widget->add_control(
			'portal_link_text',
			[
				'label' => esc_html__( 'Portal Link Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Klantportaal', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'portal_link_url',
			[
				'label' => esc_html__( 'Portal Link URL', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'default' => [
                    'url' => '#',
                ],
			]
		);

        $widget->end_controls_section();

        // Language Switcher
        $widget->start_controls_section(
			'section_language',
			[
				'label' => esc_html__( 'Language Switcher', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
        
        $widget->add_control(
            'show_language_switcher',
            [
                'label' => esc_html__( 'Show Switcher', 'ellens-lentze' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        // Simple manual implementation for MVP
        $widget->add_control(
			'current_lang',
			[
				'label' => esc_html__( 'Current Language', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
                    'nl' => 'NL',
                    'en' => 'EN',
                ],
				'default' => 'nl',
			]
		);
        
        $widget->end_controls_section();
	}
}
