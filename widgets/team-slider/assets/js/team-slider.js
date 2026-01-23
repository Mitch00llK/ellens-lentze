import Splide from '@splidejs/splide';
import '@splidejs/splide/css';

/**
 * Team Slider - Splide.js Initialization
 *
 * @since 1.0.0
 */
(function ($) {
    'use strict';

    function initTeamSlider() {
        $('.ellens-team-slider').each(function () {
            var $el = $(this);

            // Avoid re-init
            if ($el.hasClass('is-initialized')) {
                return;
            }

            // Check Splide availability - Removed as we import it


            var settings = $el.data('settings') || {};

            var splide = new Splide(this, {
                type: 'loop',
                perPage: 5,
                perMove: 1,
                focus: 'center',
                gap: '24px',
                autoplay: settings.autoplay ? true : false,
                interval: settings.autoplay ? settings.autoplay.delay : 3000,
                pauseOnHover: true,
                pagination: true,
                arrows: false,
                breakpoints: {
                    1024: {
                        perPage: 2,
                        gap: '20px',
                    },
                    767: {
                        perPage: 1,
                        gap: '16px',
                    },
                },
            });

            splide.mount();
        });
    }

    // Initialize on DOM ready
    $(document).ready(function () {
        initTeamSlider();
    });

    // Initialize on window load (backup)
    $(window).on('load', function () {
        initTeamSlider();
    });

    // Elementor editor support
    $(window).on('elementor/frontend/init', function () {
        if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
            elementorFrontend.hooks.addAction(
                'frontend/element_ready/team_slider.default',
                function ($scope) {
                    initTeamSlider();
                }
            );
        }
    });

})(jQuery);
