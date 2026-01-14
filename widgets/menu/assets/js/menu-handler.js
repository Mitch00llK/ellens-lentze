class EllensMenuHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                toggle: '.menu__toggle',
                drawer: '.menu__drawer',
                wrapper: '.menu-wrapper',
                icon: '.menu__toggle i'
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $toggle: this.$element.find(selectors.toggle),
            $drawer: this.$element.find(selectors.drawer),
            $wrapper: this.$element.find(selectors.wrapper),
            $icon: this.$element.find(selectors.icon)
        };
    }

    bindEvents() {
        this.elements.$toggle.on('click', this.onToggleClick.bind(this));
    }

    onToggleClick(event) {
        event.preventDefault();

        const isOpen = this.elements.$wrapper.hasClass('is-open');

        // Toggle Class
        this.elements.$wrapper.toggleClass('is-open');

        // Accessibility
        this.elements.$toggle.attr('aria-expanded', !isOpen);

        // Icon Swap (Bars <-> Times)
        if (!isOpen) {
            this.elements.$icon.removeClass('fa-bars').addClass('fa-times');
            document.body.style.overflow = 'hidden'; // Lock Body
        } else {
            this.elements.$icon.removeClass('fa-times').addClass('fa-bars');
            document.body.style.overflow = ''; // Unlock Body
        }
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(EllensMenuHandler, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/ellens_menu.default', addHandler);
});
