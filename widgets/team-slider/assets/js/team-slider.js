/**
 * Team Slider Swiper Initialization
 *
 * Initializes Swiper for the Team Slider widget.
 * Works in both Elementor editor and frontend.
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
        // Ensure we have jQuery object
        var $element = $scope.jquery ? $scope : $($scope);
        var $sliderElement = $element.find('.ellens-team-slider');

        // If $scope IS the slider element itself (for direct init)
        if (!$sliderElement.length && $element.hasClass('ellens-team-slider')) {
            $sliderElement = $element;
        }

        if (!$sliderElement.length) {
            return;
        }

        // Avoid re-init
        if ($sliderElement.hasClass('swiper-initialized')) {
            return;
        }

        // Check Swiper availability
        if (typeof Swiper === 'undefined') {
            console.error('[Team Slider] Swiper is not defined.');
            return;
        }

        var settings = $sliderElement.data('settings') || {};

        var swiperConfig = {
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

    // Method 1: Register with Elementor Frontend hooks (works in editor)
    if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/team_slider.default',
            initTeamSlider
        );
    }

    // Method 2: Listen for elementor/frontend/init event
    $(window).on('elementor/frontend/init', function () {
        if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
            elementorFrontend.hooks.addAction(
                'frontend/element_ready/team_slider.default',
                initTeamSlider
            );
        }
    });

    // Method 3: Direct initialization on DOM ready (fallback for frontend)
    $(document).ready(function () {
        // Small delay to ensure all scripts are loaded
        setTimeout(function () {
            $('.ellens-team-slider').each(function () {
                var $slider = $(this);
                if (!$slider.hasClass('swiper-initialized')) {
                    initTeamSlider($slider);
                }
            });
        }, 100);
    });

    // Method 4: Also try on window load as final fallback
    $(window).on('load', function () {
        $('.ellens-team-slider').each(function () {
            var $slider = $(this);
            if (!$slider.hasClass('swiper-initialized')) {
                initTeamSlider($slider);
            }
        });
    });

})(jQuery);
