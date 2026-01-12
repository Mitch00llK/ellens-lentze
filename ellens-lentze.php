<?php
/**
 * Plugin Name: SocialLane Components
 * Description: Custom components and functionality for SocialLane.
 * Version: 1.0.0
 * Author: Mitch
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Hero Widget and Assets.
 */
function register_ellens_hero_widget( $widgets_manager ) {
	require_once( __DIR__ . '/widgets/hero/hero-widget.php' );
	$widgets_manager->register( new \EllensLentze\Widgets\Hero_Widget() );

    require_once( __DIR__ . '/widgets/action-buttons/action-buttons-widget.php' );
	$widgets_manager->register( new \EllensLentze\Widgets\Action_Buttons_Widget() );

    require_once( __DIR__ . '/widgets/usp-grid/usp-grid-widget.php' );
	$widgets_manager->register( new \EllensLentze\Widgets\USP_Grid_Widget() );

    require_once( __DIR__ . '/widgets/image-text-block/image-text-block-widget.php' );
	$widgets_manager->register( new \EllensLentze\Widgets\Image_Text_Block_Widget() );

    require_once( __DIR__ . '/widgets/services-cluster/services-cluster-widget.php' );
	$widgets_manager->register( new \EllensLentze\Widgets\Services_Cluster_Widget() );

    require_once( __DIR__ . '/widgets/team-slider/team-slider-widget.php' );
	$widgets_manager->register( new \EllensLentze\Widgets\Team_Slider_Widget() );

    require_once( __DIR__ . '/widgets/post-grid/ellens-post-grid.php' );
	$widgets_manager->register( new \EllensLentze\Widgets\Post_Grid\Ellens_Post_Grid() );

    require_once( __DIR__ . '/widgets/services-grid/ellens-services-grid.php' );
	$widgets_manager->register( new \EllensLentze\Widgets\Services_Grid_Widget() );
}
add_action( 'elementor/widgets/register', 'register_ellens_hero_widget' );

/**
 * Register SocialLane Components Category.
 */
function register_ellens_widget_category( $elements_manager ) {
	$elements_manager->add_category(
		'ellens-lentze',
		[
			'title' => esc_html__( 'SocialLane Components', 'ellens-lentze' ),
			'icon'  => 'fa fa-plug',
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'register_ellens_widget_category', 1 );


/**
 * Register Assets Config.
 */
function register_ellens_assets() {
    require_once( __DIR__ . '/includes/assets/class-assets-config.php' );
    \EllensLentze\Includes\Assets\Assets_Config::register();
}
add_action( 'wp_enqueue_scripts', 'register_ellens_assets' );
// Also register for Elementor frontend
add_action( 'elementor/frontend/after_register_scripts', 'register_ellens_assets' );
add_action( 'elementor/frontend/after_register_styles', 'register_ellens_assets' );

/**
 * Register Custom Post Types.
 */
function register_ellens_cpt() {
    require_once( __DIR__ . '/includes/cpt/class-cpt-team.php' );
    \EllensLentze\Includes\CPT\CPT_Team::register();
}
add_action( 'init', 'register_ellens_cpt' );

