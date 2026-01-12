<?php
namespace EllensLentze\Widgets\Reliability_Grid\Includes\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Content Controls for Reliability Grid.
 */
class Content_Controls {

	public static function register( $widget ) {

		$widget->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
			]
		);

		$widget->add_control(
			'main_title',
			[
				'label' => esc_html__( 'Section Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Hier kan je op rekenen', 'ellens-lentze' ),
				'placeholder' => esc_html__( 'Enter your title', 'ellens-lentze' ),
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Center Image', 'ellens-lentze' ),
			]
		);

		$widget->add_control(
			'center_image',
			[
				'label' => esc_html__( 'Choose Image', 'ellens-lentze' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'section_features',
			[
				'label' => esc_html__( 'Features', 'ellens-lentze' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'feature_icon',
			[
				'label' => esc_html__( 'Icon', 'ellens-lentze' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'feature_title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Feature Title', 'ellens-lentze' ),
			]
		);

		$repeater->add_control(
			'feature_subtitle',
			[
				'label' => esc_html__( 'Subtitle (Small text)', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '<max 35 tekens>', 'ellens-lentze' ),
			]
		);

		$repeater->add_control(
			'feature_description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Office ipsum you must be muted. Let\'s anyway submit globalize manage unlock stronger.', 'ellens-lentze' ),
			]
		);

		$widget->add_control(
			'features_list',
			[
				'label' => esc_html__( 'Features List', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[ 'feature_title' => 'Specialisten' ],
					[ 'feature_title' => 'Persoonlijke aandacht' ],
					[ 'feature_title' => 'Feature 3' ],
					[ 'feature_title' => 'Feature 4' ],
				],
				'title_field' => '{{{ feature_title }}}',
			]
		);

		$widget->end_controls_section();
	}
}
