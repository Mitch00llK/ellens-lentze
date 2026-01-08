<?php
namespace EllensLentze\Widgets\USP_Grid\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;

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

        $repeater = new Repeater();
        
        $repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'ellens-lentze' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'USP Title', 'ellens-lentze' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Office ipsum you must be muted.', 'ellens-lentze' ),
			]
		);

		$widget->add_control(
			'usps',
			[
				'label' => esc_html__( 'USPs', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Specialisten', 'ellens-lentze' ),
                        'description' => esc_html__( 'Office ipsum you must be muted. Let\'s anyway submit globalize manage unlock stronger.', 'ellens-lentze' ),
					],
					[
						'title' => esc_html__( 'Persoonlijke aandacht', 'ellens-lentze' ),
                        'description' => esc_html__( 'Office ipsum you must be muted. Let\'s anyway submit globalize manage unlock stronger.', 'ellens-lentze' ),
					],
                    [
						'title' => esc_html__( 'Toegankelijk', 'ellens-lentze' ),
                        'description' => esc_html__( 'Office ipsum you must be muted. Let\'s anyway submit globalize manage unlock stronger.', 'ellens-lentze' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$widget->end_controls_section();
	}
}
