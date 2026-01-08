<?php
namespace EllensLentze\Includes\Assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Assets_Config {

    public static function register() {
         // Global Assets
         wp_register_style(
            'ellens-global-buttons',
            plugins_url( 'assets/css/globals/buttons.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0'
        );

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

        /* USP Grid Assets */

        // Base
        wp_register_style(
            'ellens-usp-base',
            plugins_url( 'widgets/usp-grid/assets/css/base/variables.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0'
        );
        // Layout
        wp_register_style(
            'ellens-usp-layout',
            plugins_url( 'widgets/usp-grid/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-usp-base' ],
            '1.0.0'
        );
        // Content
        wp_register_style(
            'ellens-usp-content',
            plugins_url( 'widgets/usp-grid/assets/css/components/content.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-usp-base' ],
            '1.0.0'
        );
        // Responsive
        wp_register_style(
            'ellens-usp-responsive',
            plugins_url( 'widgets/usp-grid/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-usp-layout' ],
            '1.0.0'
        );

        /* Image Text Block Assets */
        // Base
        wp_register_style(
            'ellens-itb-base',
            plugins_url( 'widgets/image-text-block/assets/css/base/variables.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0'
        );
        // Layout
        wp_register_style(
            'ellens-itb-layout',
            plugins_url( 'widgets/image-text-block/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-itb-base' ],
            '1.0.0'
        );
        // Content
        wp_register_style(
            'ellens-itb-content',
            plugins_url( 'widgets/image-text-block/assets/css/components/content.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-itb-base' ],
            '1.0.0'
        );
        // Responsive
        wp_register_style(
            'ellens-itb-responsive',
            plugins_url( 'widgets/image-text-block/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-itb-layout' ],
            '1.0.0'
        );


        /* Services Cluster Assets */
        // Base
        wp_register_style(
            'ellens-sc-base',
            plugins_url( 'widgets/services-cluster/assets/css/base/variables.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0'
        );
        // Layout
        wp_register_style(
            'ellens-sc-layout',
            plugins_url( 'widgets/services-cluster/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-sc-base' ],
            '1.0.0'
        );
        // Content
        wp_register_style(
            'ellens-sc-content',
            plugins_url( 'widgets/services-cluster/assets/css/components/content.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-sc-base' ],
            '1.0.0'
        );
        // Responsive
        wp_register_style(
            'ellens-sc-responsive',
            plugins_url( 'widgets/services-cluster/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-sc-layout' ],
            '1.0.0'
        );

        /* Team Slider Assets */
        // Base
        wp_register_style(
            'ellens-ts-base',
            plugins_url( 'widgets/team-slider/assets/css/base/variables.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0'
        );
        // Layout
        wp_register_style(
            'ellens-ts-layout',
            plugins_url( 'widgets/team-slider/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-ts-base', 'ellens-global-buttons' ],
            '1.0.0'
        );
        // Component
        wp_register_style(
            'ellens-ts-component',
            plugins_url( 'widgets/team-slider/assets/css/components/card.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-ts-base' ],
            '1.0.0'
        );
        // Responsive
        wp_register_style(
            'ellens-ts-responsive',
            plugins_url( 'widgets/team-slider/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-ts-layout' ],
            '1.0.0'
        );
         // Script
         wp_register_script(
            'ellens-ts-script',
            plugins_url( 'widgets/team-slider/assets/js/team-slider.js', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'jquery', 'elementor-frontend', 'swiper' ],
            '1.0.0',
            true
        );
    }
}
