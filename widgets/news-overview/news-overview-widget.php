<?php
namespace EllensLentze\Widgets\News_Overview;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_News_Overview extends Widget_Base {

	public function get_name() {
		return 'news_overview';
	}

	public function get_title() {
		return esc_html__( 'News Overview', 'ellens-lentze' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

	public function get_script_depends() {
		return [ 'news-overview-script' ]; 
	}

	public function get_style_depends() {
		return [ 'news-overview-style' ];
	}

	protected function register_controls() {
		require_once( __DIR__ . '/includes/controls/content-controls.php' );
        require_once( __DIR__ . '/includes/controls/style-controls.php' );
        
        \EllensLentze\Widgets\News_Overview\Includes\Controls\Content_Controls::register( $this );
        \EllensLentze\Widgets\News_Overview\Includes\Controls\Style_Controls::register( $this );
	}

	protected function render() {
		require_once( __DIR__ . '/includes/render/render-functions.php' );
        \EllensLentze\Widgets\News_Overview\Includes\Render\Render_Functions::render_widget( $this );
	}
}
