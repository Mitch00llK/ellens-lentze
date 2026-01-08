jQuery(window).on('elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction('frontend/element_ready/team_slider.default', function($scope, $) {
        const sliderContainer = $scope.find('.ellens-team-slider');
        if (!sliderContainer.length) return;

        const settings = sliderContainer.data('settings') || {};

        new Swiper(sliderContainer[0], {
            ...settings,
            // Ensure centered slides logic works visually
            on: {
                init: function () {
                    sliderContainer.addClass('loaded');
                },
            },
        });
    });
});
