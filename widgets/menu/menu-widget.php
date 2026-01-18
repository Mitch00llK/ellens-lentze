<?php
namespace EllensLentze\Widgets\Menu;

use Elementor\Widget_Base;
use EllensLentze\Widgets\Menu\Includes\Controls\Content_Controls;
use EllensLentze\Widgets\Menu\Includes\Controls\Style_Controls;
use EllensLentze\Widgets\Menu\Includes\Render\Render_Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Menu Widget.
 *
 * @package EllensLentze\Widgets\Menu
 * @since 1.0.0
 */
class Menu_Widget extends Widget_Base {

	public function get_name() {
		return 'ellens_menu';
	}

	public function get_title() {
		return esc_html__( 'Ellens Menu', 'ellens-lentze' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return [ 'ellens-lentze' ];
	}

    public function get_script_depends() {
		return [ 'menu-handler', 'menu-search-handler' ];
	}

	public function get_style_depends() {
		return [ 'menu-styles' ];
	}

	protected function register_controls() {
        require_once __DIR__ . '/includes/controls/content-controls.php';
		Content_Controls::register( $this );

        require_once __DIR__ . '/includes/controls/style-controls.php';
		Style_Controls::register( $this );
	}

	protected function render() {
        require_once __DIR__ . '/includes/render/render-functions.php';
		Render_Functions::render_widget( $this );
	}
}
