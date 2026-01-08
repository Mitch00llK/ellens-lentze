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
}
add_action( 'elementor/widgets/register', 'register_ellens_hero_widget' );

/**
 * Register Styles.
 */
function register_ellens_hero_styles() {
    // Base
	wp_register_style(
		'ellens-hero-base',
		plugins_url( 'widgets/hero/assets/css/base/variables.css', __FILE__ ),
		[],
		'1.0.0'
	);
    // Layout
    wp_register_style(
		'ellens-hero-layout',
		plugins_url( 'widgets/hero/assets/css/layout/container.css', __FILE__ ),
		[ 'ellens-hero-base' ],
		'1.0.0'
	);
    // Content
    wp_register_style(
		'ellens-hero-content',
		plugins_url( 'widgets/hero/assets/css/components/content.css', __FILE__ ),
		[ 'ellens-hero-base' ],
		'1.0.0'
	);
    // Responsive
    wp_register_style(
		'ellens-hero-responsive',
		plugins_url( 'widgets/hero/assets/css/responsive/tablet.css', __FILE__ ),
		[ 'ellens-hero-layout' ],
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'register_ellens_hero_styles' );

