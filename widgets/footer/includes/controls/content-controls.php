<?php
namespace EllensLentze\Widgets\Footer\Includes\Controls;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

        // BRAND SECTION
		$widget->start_controls_section(
			'section_brand',
			[
				'label' => esc_html__( 'Brand & Contact', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'logo',
			[
				'label' => esc_html__( 'Logo', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $widget->add_control(
			'address',
			[
				'label' => esc_html__( 'Address', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Parkstraat 93, 2514 JH Den Haag', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'email',
			[
				'label' => esc_html__( 'Email', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'notaris@ellenslentze.nl', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'phone',
			[
				'label' => esc_html__( 'Phone', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '070 364 48 30', 'ellens-lentze' ),
			]
		);

		$widget->end_controls_section();

        // MENU COLUMNS
        // Loop to create 3 standardized menu columns
        $columns = [
            'col2' => [ 'label' => 'Column 2 (Specialismes)', 'default' => 'Specialismes' ],
            'col3' => [ 'label' => 'Column 3 (Adviesgebieden)', 'default' => 'Adviesgebieden' ],
            'col4' => [ 'label' => 'Column 4 (Info)', 'default' => 'Belangrijke informatie' ],
        ];

        // Get available menus
        $menus = self::get_available_menus();

        foreach ( $columns as $id => $data ) {
            $widget->start_controls_section(
                'section_' . $id,
                [
                    'label' => esc_html__( $data['label'], 'ellens-lentze' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );

            $widget->add_control(
                $id . '_title',
                [
                    'label' => esc_html__( 'Title', 'ellens-lentze' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( $data['default'], 'ellens-lentze' ),
                ]
            );

            if ( ! empty( $menus ) ) {
                $widget->add_control(
                    $id . '_menu',
                    [
                        'label' => esc_html__( 'Select Menu', 'ellens-lentze' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => $menus,
                        'default' => array_key_first( $menus ),
                        'description' => esc_html__( 'Select a WordPress menu to display.', 'ellens-lentze' ),
                    ]
                );
            } else {
                $widget->add_control(
                    $id . '_no_menus',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => '<strong>' . esc_html__( 'No menus found. Please create a menu in Appearance > Menus.', 'ellens-lentze' ) . '</strong>',
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
                );
            }

            $widget->end_controls_section();
        }

        // CTA SECTION (Appended to Column 4 or separate?)
        // Design shows CTA at bottom right. Let's add it as a separate section but render it in Col 4.
        $widget->start_controls_section(
			'section_cta',
			[
				'label' => esc_html__( 'CTA Button', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'cta_text',
			[
				'label' => esc_html__( 'Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Offerte aanvragen', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'cta_link',
			[
				'label' => esc_html__( 'Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
				'default' => [
					'url' => '#',
				],
			]
		);

        $widget->end_controls_section();
	}
    /**
     * Get available WordPress menus.
     *
     * @return array Menu ID => Menu Name.
     */
    protected static function get_available_menus() {
        $menus = wp_get_nav_menus();
        $options = [];

        foreach ( $menus as $menu ) {
            $options[ $menu->term_id ] = $menu->name;
        }

        return $options;
    }
}
