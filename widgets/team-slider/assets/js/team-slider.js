/**
 * Team Slider Swiper Initialization
 *
 * Initializes Swiper for the Team Slider widget.
 * We use `elementor/frontend/init` and the widget-specific hook.
 *
 * @since 1.0.0
 */
(function ($) {
    'use strict';

    // Ensure Swiper is available (bundled by Elementor or as a global)
    if (typeof Swiper === 'undefined') {
        console.error('[Team Slider] Swiper is not defined. Make sure it is enqueued properly.');
        return;
    }

    // Helper function to initialize the slider
    function initTeamSlider($scope) {
        const $sliderElement = $scope.find('.ellens-team-slider');

        if (!$sliderElement.length) {
            return;
        }

        // Avoid re-init if already initialized
        if ($sliderElement.hasClass('swiper-initialized')) {
            return;
        }

        const settings = $sliderElement.data('settings');
        const swiperConfig = {
            slidesPerView: 'auto',
            centeredSlides: true,
            loop: true,
            spaceBetween: 24,
            autoplay: settings && settings.autoplay ? settings.autoplay : false,
            pagination: {
                el: $sliderElement.find('.swiper-pagination')[0],
                clickable: true,
            },
            breakpoints: {
                768: {
                    spaceBetween: 36,
                },
            },
            observer: true,
            observeParents: true,
        };

        new Swiper($sliderElement[0], swiperConfig);
    }

    // Register with Elementor Frontend
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/team_slider.default',
            initTeamSlider
        );
    });

    // Fallback for non-Elementor pages or late loading
    $(document).ready(function () {
        // If not in Elementor frontend mode, init manually
        if (typeof elementorFrontend === 'undefined') {
            $('.ellens-team-slider').each(function () {
                const $el = $(this);
                if (!$el.hasClass('swiper-initialized')) {
                    const settings = $el.data('settings');
                    new Swiper(this, {
                        slidesPerView: 'auto',
                        centeredSlides: true,
                        loop: true,
                        spaceBetween: 24,
                        autoplay: settings && settings.autoplay ? settings.autoplay : false,
                        pagination: {
                            el: $el.find('.swiper-pagination')[0],
                            clickable: true,
                        },
                    });
                }
            });
        }
    });
})(jQuery);
