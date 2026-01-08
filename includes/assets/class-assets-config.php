<?php
namespace EllensLentze\Includes\Assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Assets_Config {

    public static function register() {
         // Base
        wp_register_style(
            'ellens-hero-base',
            plugins_url( 'widgets/hero/assets/css/base/variables.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0'
        );
        
        // Layout
        wp_register_style(
            'ellens-hero-layout',
            plugins_url( 'widgets/hero/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-hero-base' ],
            '1.0.0'
        );

        // Content
        wp_register_style(
            'ellens-hero-content',
            plugins_url( 'widgets/hero/assets/css/components/content.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-hero-base' ],
            '1.0.0'
        );

        // Responsive
        wp_register_style(
            'ellens-hero-responsive',
            plugins_url( 'widgets/hero/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-hero-layout' ],
            '1.0.0'
        );

        /* Action Buttons Assets */
        // Base
        wp_register_style(
            'ellens-ab-base',
            plugins_url( 'widgets/action-buttons/assets/css/base/variables.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0'
        );
        // Layout
        wp_register_style(
            'ellens-ab-layout',
            plugins_url( 'widgets/action-buttons/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-ab-base' ],
            '1.0.0'
        );
        // Content
        wp_register_style(
            'ellens-ab-content',
            plugins_url( 'widgets/action-buttons/assets/css/components/content.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-ab-base' ],
            '1.0.0'
        );
        // Responsive
        wp_register_style(
            'ellens-ab-responsive',
            plugins_url( 'widgets/action-buttons/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-ab-layout' ],
            '1.0.0'
        );
    }
}
