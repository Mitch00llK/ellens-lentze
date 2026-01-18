<?php
namespace EllensLentze\Widgets\Action_Buttons\Includes\Controls;

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

		$widget->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Waar kunnen wij bij helpen?', 'ellens-lentze' ),
				'placeholder' => esc_html__( 'Type your title here', 'ellens-lentze' ),
			]
		);

        $widget->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXTAREA, // Using Textarea for simplicity as per design snippets
				'default' => esc_html__( 'Office ipsum you must be muted. Lets anyway submit globalize manage unlock stronger.', 'ellens-lentze' ),
			]
		);

        $repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'ellens-lentze' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Button Text', 'ellens-lentze' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'ellens-lentze' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ellens-lentze' ),
				'default' => [
					'url' => '#',
				],
			]
		);
        
        // Icon control removed to enforce standardization

		$widget->add_control(
			'buttons',
			[
				'label' => esc_html__( 'Buttons', 'ellens-lentze' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'Samenleven', 'ellens-lentze' ),
                        'link' => [ 'url' => '#' ],
					],
					[
						'text' => esc_html__( 'Wonen', 'ellens-lentze' ),
                        'link' => [ 'url' => '#' ],
					],
                    [
						'text' => esc_html__( 'Nalaten', 'ellens-lentze' ),
                        'link' => [ 'url' => '#' ],
					],
				],
				'title_field' => '{{{ text }}}',
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
