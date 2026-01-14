<?php
namespace EllensLentze\Includes\Assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Assets_Config {

    public static function register() {
         // FontAwesome
         wp_register_style(
            'font-awesome-5',
            'https://use.fontawesome.com/releases/v5.15.4/css/all.css',
            [],
            '5.15.4'
        );

         // Global Assets
         wp_register_style(
            'ellens-global-variables',
            plugins_url( 'assets/css/globals/variables.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0'
        );

         wp_register_style(
            'ellens-global-buttons',
            plugins_url( 'assets/css/globals/buttons.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );

         // Layout
        wp_register_style(
            'ellens-hero-layout',
            plugins_url( 'widgets/hero/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons' ],
            '1.0.0'
        );
        
        // Content
        wp_register_style(
            'ellens-hero-content',
            plugins_url( 'widgets/hero/assets/css/components/content.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );

        // Responsive
        wp_register_style(
            'ellens-hero-responsive',
            plugins_url( 'widgets/hero/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-hero-layout' ],
            '1.0.0'
        );

        // Template: Full Width Blue
        wp_register_style(
            'ellens-hero-template-full-width',
            plugins_url( 'widgets/hero/assets/css/layout/template-full-width.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );

        /* Action Buttons Assets */
        // Layout
        wp_register_style(
            'ellens-ab-layout',
            plugins_url( 'widgets/action-buttons/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons' ],
            '1.0.0'
        );
        // Content
        wp_register_style(
            'ellens-ab-content',
            plugins_url( 'widgets/action-buttons/assets/css/components/content.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
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
        // Layout
        wp_register_style(
            'ellens-usp-layout',
            plugins_url( 'widgets/usp-grid/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons' ],
            '1.0.0'
        );
        // Content
        wp_register_style(
            'ellens-usp-content',
            plugins_url( 'widgets/usp-grid/assets/css/components/content.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
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
        // Layout
        wp_register_style(
            'ellens-itb-layout',
            plugins_url( 'widgets/image-text-block/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons' ],
            '1.0.0'
        );
        // Content
        wp_register_style(
            'ellens-itb-content',
            plugins_url( 'widgets/image-text-block/assets/css/components/content.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
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
        // Layout
        wp_register_style(
            'ellens-sc-layout',
            plugins_url( 'widgets/services-cluster/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons' ],
            '1.0.0'
        );
        // Content
        wp_register_style(
            'ellens-sc-content',
            plugins_url( 'widgets/services-cluster/assets/css/components/content.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
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
        // Splide CSS (from CDN)
        wp_register_style(
            'splide-core',
            'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide-core.min.css',
            [],
            '4.1.4'
        );

        // Layout
        wp_register_style(
            'ellens-ts-layout',
            plugins_url( 'widgets/team-slider/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'splide-core' ],
            '1.0.0'
        );
        // Component
        wp_register_style(
            'ellens-ts-component',
            plugins_url( 'widgets/team-slider/assets/css/components/card.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );
        // Responsive
        wp_register_style(
            'ellens-ts-responsive',
            plugins_url( 'widgets/team-slider/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-ts-layout' ],
            '1.0.0'
        );

        // Splide JS (from CDN)
        wp_register_script(
            'splide-core',
            'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js',
            [],
            '4.1.4',
            true
        );

        // Script
        wp_register_script(
            'ellens-ts-script',
            plugins_url( 'widgets/team-slider/assets/js/team-slider.js', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'jquery', 'splide-core' ],
            '1.0.0',
            true
        );

        /* Post Grid Assets */
        // Layout
        wp_register_style(
            'ellens-pg-layout',
            plugins_url( 'widgets/post-grid/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons' ],
            '1.0.0'
        );
        // Component
        wp_register_style(
            'ellens-pg-component',
            plugins_url( 'widgets/post-grid/assets/css/components/card.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );
        // Responsive
        wp_register_style(
            'ellens-pg-responsive',
            plugins_url( 'widgets/post-grid/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-pg-layout' ],
            '1.0.0'
        );

        /* Services Grid Assets */
        // Layout
        wp_register_style(
            'ellens-sg-layout',
            plugins_url( 'widgets/services-grid/assets/css/layout/layout.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons' ],
            '1.0.0'
        );
        // Component
        wp_register_style(
            'ellens-sg-component',
            plugins_url( 'widgets/services-grid/assets/css/components/card.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );

        /* Detailed Info Section Assets */
        // Layout
        wp_register_style(
            'ellens-dis-layout',
            plugins_url( 'widgets/detailed-info-section/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons' ],
            '1.0.0'
        );
        // Card
        wp_register_style(
            'ellens-dis-card',
            plugins_url( 'widgets/detailed-info-section/assets/css/components/card.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );
        // Content
        wp_register_style(
            'ellens-dis-content',
            plugins_url( 'widgets/detailed-info-section/assets/css/components/content.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );
        // Responsive
        wp_register_style(
            'ellens-dis-responsive',
            plugins_url( 'widgets/detailed-info-section/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-dis-layout' ],
            '1.0.0'
        );

        /* FAQ Section Assets */
        // Layout
        wp_register_style(
            'ellens-faq-layout',
            plugins_url( 'widgets/faq-section/assets/css/layout/container.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons' ],
            '1.0.0'
        );
        // Accordion
        wp_register_style(
            'ellens-faq-accordion',
            plugins_url( 'widgets/faq-section/assets/css/components/accordion.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );
        // Responsive
        wp_register_style(
            'ellens-faq-responsive',
            plugins_url( 'widgets/faq-section/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-faq-layout', 'ellens-faq-accordion' ],
            '1.0.0'
        );
        // Script
        wp_register_script(
            'ellens-faq-js',
            plugins_url( 'widgets/faq-section/assets/js/faq-accordion.js', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0',
            true
        );
        /* Reliability Grid Assets */
        // Layout
        wp_register_style(
            'ellens-rg-layout',
            plugins_url( 'widgets/reliability-grid/assets/css/layout/grid.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons' ],
            '1.0.0'
        );
        // Feature
        wp_register_style(
            'ellens-rg-feature',
            plugins_url( 'widgets/reliability-grid/assets/css/components/feature.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );
        // Responsive
        wp_register_style(
            'ellens-rg-responsive',
            plugins_url( 'widgets/reliability-grid/assets/css/responsive/tablet.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-rg-layout' ],
            '1.0.0'
        );
    }
}
