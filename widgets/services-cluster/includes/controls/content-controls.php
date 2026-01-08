<?php
namespace EllensLentze\Widgets\Services_Cluster\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

        /* Visuals Section */
		$widget->start_controls_section(
			'section_visuals',
			[
				'label' => esc_html__( 'Visuals', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'mask_image',
			[
				'label' => esc_html__( 'Mask Shape (SVG)', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Upload an SVG to use as the mask shape.', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'center_image',
			[
				'label' => esc_html__( 'Center Image', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $widget->end_controls_section();

        /* Services Section (Repeater) */
        $widget->start_controls_section(
			'section_services',
			[
				'label' => esc_html__( 'Services', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
			'icon',
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
			'title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Service Title', 'ellens-lentze' ),
                'label_block' => true,
			]
		);

        $repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Short description of the service.', 'ellens-lentze' ),
			]
		);

        $repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'items',
			[
				'label' => esc_html__( 'Service Items', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
                    [ 'title' => 'Familierecht' ],
                    [ 'title' => 'Vastgoedrecht' ],
                    [ 'title' => 'Ondernemingsrecht' ],
                    [ 'title' => 'Mediation' ],
                ],
				'title_field' => '{{{ title }}}',
			]
		);

		$widget->end_controls_section();
	}
}
