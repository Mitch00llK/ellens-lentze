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

         // Reset CSS (Override Elementor Defaults)
         wp_register_style(
            'ellens-reset-css',
            plugins_url( 'assets/css/globals/reset.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'elementor-frontend' ],
            '1.0.0'
        );

         // Global Assets
         wp_register_style(
            'ellens-global-variables',
            plugins_url( 'assets/css/globals/variables.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-reset-css' ],
            '1.0.0'
        );

         wp_register_style(
            'ellens-global-utilities',
            plugins_url( 'assets/css/globals/utilities.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );

         wp_register_style(
            'ellens-global-buttons',
            plugins_url( 'assets/css/globals/buttons.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables' ],
            '1.0.0'
        );

        // Button Animations Script
        wp_register_script(
            'ellens-button-animations',
            plugins_url( 'assets/js/button-animations.js', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0',
            true
        );

         /* Hero Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-hero',
            plugins_url( 'widgets/hero/assets/css/hero.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
            '1.0.0'
        );

        wp_register_script(
            'ellens-hero-card-position',
            plugins_url( 'widgets/hero/assets/js/hero-card-position.js', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0',
            true
        );


        /* Action Buttons Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-action-buttons',
            plugins_url( 'widgets/action-buttons/assets/css/action-buttons.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
            '1.0.0'
        );

        /* USP Grid Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-usp-grid',
            plugins_url( 'widgets/usp-grid/assets/css/usp-grid.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
            '1.0.0'
        );

        /* Image Text Block Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-image-text-block',
            plugins_url( 'widgets/image-text-block/assets/css/image-text-block.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
            '1.0.0'
        );

        /* Services Cluster Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-services-cluster',
            plugins_url( 'widgets/services-cluster/assets/css/services-cluster.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
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

        // Team Slider Consolidated CSS
        wp_register_style(
            'ellens-team-slider',
            plugins_url( 'widgets/team-slider/assets/css/team-slider.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'splide-core' ],
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

        // Team Slider Script
        wp_register_script(
            'ellens-team-slider',
            plugins_url( 'widgets/team-slider/assets/js/team-slider.js', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'jquery', 'splide-core' ],
            '1.0.0',
            true
        );

        /* Team Grid Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-team-grid',
            plugins_url( 'widgets/team-grid/assets/css/team-grid.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'font-awesome-5', 'ellens-global-utilities' ],
            '1.0.0'
        );

        /* Post Grid Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-post-grid',
            plugins_url( 'widgets/post-grid/assets/css/post-grid.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
            '1.0.0'
        );

        /* Services Grid Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-services-grid',
            plugins_url( 'widgets/services-grid/assets/css/services-grid.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
            '1.0.0'
        );

        /* Detailed Info Section Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-detailed-info-section',
            plugins_url( 'widgets/detailed-info-section/assets/css/detailed-info-section.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
            '1.0.0'
        );

        /* FAQ Section Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-faq-section',
            plugins_url( 'widgets/faq-section/assets/css/faq-section.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
            '1.0.0'
        );

        /* Sidebar FAQ Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-sidebar-faq-v2',
            plugins_url( 'widgets/sidebar-faq/assets/css/sidebar-faq.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
            '1.0.0'
        );

        // FAQ Script
        wp_register_script(
            'ellens-faq-section',
            plugins_url( 'widgets/faq-section/assets/js/faq-accordion.js', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [],
            '1.0.0',
            true
        );
        /* Reliability Grid Widget Assets (Consolidated) */
        wp_register_style(
            'ellens-reliability-grid',
            plugins_url( 'widgets/reliability-grid/assets/css/reliability-grid.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
            '1.0.0'
        );

        /* Menu Widget Assets */
        wp_register_style(
            'menu-styles',
            plugins_url( 'widgets/menu/assets/css/menu.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'font-awesome-5', 'ellens-global-utilities' ],
            '1.0.0'
        );

        wp_register_script(
            'menu-handler',
            plugins_url( 'widgets/menu/assets/js/menu-handler.js', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'elementor-frontend' ], 
            '1.0.0',
            true
        );

        wp_register_script(
            'menu-search-handler',
            plugins_url( 'widgets/menu/assets/js/menu-search.js', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'elementor-frontend' ], 
            '1.0.0',
            true
        );

        /* Footer Widget Assets */
        wp_register_style(
            'ellens-footer',
            plugins_url( 'widgets/footer/assets/css/footer.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ],
            '1.0.0'
        );

        /* News Overview Widget Assets */
        wp_register_style(
            'news-overview-style',
            plugins_url( 'widgets/news-overview/assets/css/news-overview.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'ellens-global-buttons', 'font-awesome-5', 'ellens-global-utilities' ],
            '1.0.0'
        );

        wp_register_script(
            'news-overview-script',
            plugins_url( 'widgets/news-overview/assets/js/news-overview.js', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [], // No specific deps other than DOM
            '1.0.0',
            true
        );

        /* Contact Info Widget Assets */
        wp_register_style(
            'ellens-contact-info',
            plugins_url( 'widgets/contact-info/assets/css/contact-info.css', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' ),
            [ 'ellens-global-variables', 'font-awesome-5', 'ellens-global-utilities' ],
            '1.0.0'
        );
    }
}
