/**
 * Team Slider Swiper Initialization
 *
 * Initializes Swiper for the Team Slider widget.
 *
 * @since 1.0.0
 */
(function ($) {
    'use strict';

    /**
     * Initialize the Team Slider
     * @param {jQuery} $scope - The widget's jQuery element wrapper
     */
    function initTeamSlider($scope) {
        // Check inside function, not at parse time
        if (typeof Swiper === 'undefined') {
            console.error('[Team Slider] Swiper is not defined.');
            return;
        }

        const $sliderElement = $scope.find('.ellens-team-slider');

        if (!$sliderElement.length) {
            return;
        }

        // Avoid re-init
        if ($sliderElement.hasClass('swiper-initialized')) {
            return;
        }

        const settings = $sliderElement.data('settings') || {};

        const swiperConfig = {
            slidesPerView: 'auto',
            centeredSlides: true,
            loop: true,
            spaceBetween: 24,
            autoplay: settings.autoplay || false,
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

    // Fallback for non-Elementor pages
    $(document).ready(function () {
        if (typeof elementorFrontend === 'undefined') {
            $('.ellens-team-slider').each(function () {
                initTeamSlider($(this).closest('.elementor-widget-team_slider'));
            });
        }
    });

})(jQuery);
