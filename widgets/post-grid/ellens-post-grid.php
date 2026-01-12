<?php
namespace EllensLentze\Widgets\Post_Grid;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Ellens_Post_Grid extends Widget_Base {

	public function get_name() {
		return 'ellens_post_grid';
	}

	public function get_title() {
		return esc_html__( 'Ellens Post Grid', 'ellens-lentze' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	public function get_script_depends() {
		return []; 
	}

	public function get_style_depends() {
		return [ 
            'ellens-global-variables',
            'ellens-pg-layout',
            'ellens-pg-component', // Card
            'ellens-pg-responsive'
        ];
	}

	protected function register_controls() {
		require_once( __DIR__ . '/includes/controls/content-controls.php' );
        require_once( __DIR__ . '/includes/controls/style-controls.php' );
        
        \EllensLentze\Widgets\Post_Grid\Includes\Controls\Content_Controls::register( $this );
        \EllensLentze\Widgets\Post_Grid\Includes\Controls\Style_Controls::register( $this );
	}

	protected function render() {
		require_once( __DIR__ . '/includes/render/render-functions.php' );
        \EllensLentze\Widgets\Post_Grid\Includes\Render\Render_Functions::render_widget( $this );
	}
}
