<?php
namespace EllensLentze\Includes\Assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Assets_Config {

    public static function register() {
         // Initialize Vite Loader
         require_once( dirname( __DIR__ ) . '/assets/class-vite-loader.php' );

         // FontAwesome (External - Keep as is)
         wp_register_style(
            'font-awesome-5',
            'https://use.fontawesome.com/releases/v5.15.4/css/all.css',
            [],
            '5.15.4'
        );

         // Reset CSS (Override Elementor Defaults)
         Vite_Loader::register_style(
            'ellens-reset-css',
            'assets/css/globals/reset.css', // Entry key (relative path)
            [ 'elementor-frontend' ]
        );

         // Global Assets
         Vite_Loader::register_style(
            'ellens-global-variables',
            'assets/css/globals/variables.css',
            [ 'ellens-reset-css' ]
        );

         Vite_Loader::register_style(
            'ellens-global-utilities',
            'assets/css/globals/utilities.css',
            [ 'ellens-global-variables' ]
        );

         Vite_Loader::register_style(
            'ellens-global-buttons',
            'assets/css/globals/buttons.css',
            [ 'ellens-global-variables' ]
        );

        // Button Animations Script
        Vite_Loader::register_script(
            'ellens-button-animations',
            'assets/js/button-animations.js',
            [],
            '1.0.0',
            true
        );

         /* Hero Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-hero',
            'widgets/hero/assets/css/hero.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
        );

        Vite_Loader::register_script(
            'ellens-hero-card-position',
            'widgets/hero/assets/js/hero-card-position.js',
            [],
            '1.0.0',
            true
        );


        /* Action Buttons Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-action-buttons',
            'widgets/action-buttons/assets/css/action-buttons.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
        );

        /* USP Grid Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-usp-grid',
            'widgets/usp-grid/assets/css/usp-grid.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
        );

        /* Image Text Block Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-image-text-block',
            'widgets/image-text-block/assets/css/image-text-block.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
        );

        /* Services Cluster Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-services-cluster',
            'widgets/services-cluster/assets/css/services-cluster.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
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
        Vite_Loader::register_style(
            'ellens-team-slider',
            'widgets/team-slider/assets/css/team-slider.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'splide-core' ]
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
        Vite_Loader::register_script(
            'ellens-team-slider',
            'widgets/team-slider/assets/js/team-slider.js',
            [ 'jquery', 'splide-core' ],
            '1.0.0',
            true
        );

        /* Team Grid Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-team-grid',
            'widgets/team-grid/assets/css/team-grid.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'font-awesome-5', 'ellens-global-utilities' ]
        );

        /* Post Grid Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-post-grid',
            'widgets/post-grid/assets/css/post-grid.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
        );

        /* Services Grid Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-services-grid',
            'widgets/services-grid/assets/css/services-grid.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
        );

        /* Detailed Info Section Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-detailed-info-section',
            'widgets/detailed-info-section/assets/css/detailed-info-section.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
        );

        /* FAQ Section Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-faq-section',
            'widgets/faq-section/assets/css/faq-section.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
        );

        /* Sidebar FAQ Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-sidebar-faq-v2',
            'widgets/sidebar-faq/assets/css/sidebar-faq.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
        );

        // FAQ Script
        Vite_Loader::register_script(
            'ellens-faq-section',
            'widgets/faq-section/assets/js/faq-accordion.js',
            [],
            '1.0.0',
            true
        );
        /* Reliability Grid Widget Assets (Consolidated) */
        Vite_Loader::register_style(
            'ellens-reliability-grid',
            'widgets/reliability-grid/assets/css/reliability-grid.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
        );

        /* Menu Widget Assets */
        Vite_Loader::register_style(
            'menu-styles',
            'widgets/menu/assets/css/menu.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'font-awesome-5', 'ellens-global-utilities' ]
        );

        Vite_Loader::register_script(
            'menu-handler',
            'widgets/menu/assets/js/menu-handler.js',
            [ 'elementor-frontend' ], 
            '1.0.0',
            true
        );

        Vite_Loader::register_script(
            'menu-search-handler',
            'widgets/menu/assets/js/menu-search.js',
            [ 'elementor-frontend' ], 
            '1.0.0',
            true
        );

        /* Footer Widget Assets */
        Vite_Loader::register_style(
            'ellens-footer',
            'widgets/footer/assets/css/footer.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'ellens-global-utilities' ]
        );

        /* News Overview Widget Assets */
        Vite_Loader::register_style(
            'news-overview-style',
            'widgets/news-overview/assets/css/news-overview.css',
            [ 'ellens-global-variables', 'ellens-global-buttons', 'font-awesome-5', 'ellens-global-utilities' ]
        );

        Vite_Loader::register_script(
            'news-overview-script',
            'widgets/news-overview/assets/js/news-overview.js',
            [], // No specific deps other than DOM
            '1.0.0',
            true
        );

        /* Contact Info Widget Assets */
        Vite_Loader::register_style(
            'ellens-contact-info',
            'widgets/contact-info/assets/css/contact-info.css',
            [ 'ellens-global-variables', 'font-awesome-5', 'ellens-global-utilities' ]
        );
    }
}
