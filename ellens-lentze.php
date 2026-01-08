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
    // Register Team CPT
    require_once( __DIR__ . '/includes/cpt/class-cpt-team.php' );
    \EllensLentze\Includes\CPT\CPT_Team::register();

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

