<?php
namespace EllensLentze\Widgets\News_Overview\Includes\Controls;

use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {

        // Section Header
		$widget->start_controls_section(
			'section_header',
			[
				'label' => esc_html__( 'Header', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Actualiteit', 'ellens-lentze' ),
                'label_block' => true,
			]
		);

        // Header Buttons (e.g. "Alle berichten", "Nieuws")
        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Button Text', 'ellens-lentze' ),
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
			]
		);
        
        $repeater->add_control(
			'is_filter',
			[
				'label' => esc_html__( 'Is Filter?', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ellens-lentze' ),
				'label_off' => esc_html__( 'No', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => 'no',
                'description'   => esc_html__( 'If enabled, this button acts as a category filter (use text as slug or add control). For V1, link is preferred.', 'ellens-lentze' ),
			]
		);
        // Note: For true filtering, we might need a slug field. Adding one.
        $repeater->add_control(
			'filter_slug',
			[
				'label' => esc_html__( 'Filter Slug', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
                'condition' => [ 'is_filter' => 'yes' ],
			]
		);

		$widget->add_control(
			'header_buttons',
			[
				'label' => esc_html__( 'Header Buttons', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'button_text' => esc_html__( 'Alle berichten', 'ellens-lentze' ),
                        'is_filter' => 'yes',
                        'filter_slug' => '',
					],
                    [
						'button_text' => esc_html__( 'Nieuws', 'ellens-lentze' ),
                        'is_filter' => 'yes',
                        'filter_slug' => 'news',
					],
				],
				'title_field' => '{{{ button_text }}}',
			]
		);

		$widget->end_controls_section();

        // Section Featured
		$widget->start_controls_section(
			'section_featured',
			[
				'label' => esc_html__( 'Featured Posts', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        // Helper to get categories
        $categories = get_categories( [ 'hide_empty' => true ] );
        $cat_options = [ '' => esc_html__( 'Select Category', 'ellens-lentze' ) ];
        foreach ( $categories as $category ) {
            $cat_options[ $category->slug ] = $category->name;
        }

        $widget->add_control(
			'show_featured',
			[
				'label' => esc_html__( 'Show Featured Posts', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ellens-lentze' ),
				'label_off' => esc_html__( 'Hide', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $widget->add_control(
			'featured_category',
			[
				'label' => esc_html__( 'Featured Category', 'ellens-lentze' ),
				'type' => Controls_Manager::SELECT,
				'options' => $cat_options,
                'default' => '',
                'description' => esc_html__( 'Select the category to pull the 2 featured posts from.', 'ellens-lentze' ),
			]
		);

		$widget->end_controls_section();

        // Section Grid
		$widget->start_controls_section(
			'section_grid',
			[
				'label' => esc_html__( 'Grid Settings', 'ellens-lentze' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $widget->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Posts to Load', 'ellens-lentze' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 9,
			]
		);

        $widget->add_control(
			'show_filters',
			[
				'label' => esc_html__( 'Show Filters', 'ellens-lentze' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ellens-lentze' ),
				'label_off' => esc_html__( 'Hide', 'ellens-lentze' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->end_controls_section();
	}
}
