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
}
add_action( 'elementor/widgets/register', 'register_ellens_hero_widget' );

/**
 * Register Custom Widget Category.
 */
function register_ellens_widget_category( $elements_manager ) {

	$elements_manager->add_category(
		'ellens-lentze',
		[
			'title' => esc_html__( 'SocialLane Components', 'ellens-lentze' ),
			'icon' => 'fa fa-plug',
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'register_ellens_widget_category' );


/**
 * Register Assets Config.
 */
function register_ellens_assets() {
    require_once( __DIR__ . '/includes/assets/class-assets-config.php' );
    \EllensLentze\Includes\Assets\Assets_Config::register();
}
add_action( 'wp_enqueue_scripts', 'register_ellens_assets' );

