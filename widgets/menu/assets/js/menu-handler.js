class EllensMenuHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                toggle: '.menu__toggle',
                drawer: '.menu__drawer',
                wrapper: '.menu-wrapper',
                icon: '.menu__toggle i',
                mobileItemWithChildren: '.menu__mobile-item--has-children',
                mobileLink: '.menu__mobile-link',
                mobileToggle: '.menu__mobile-toggle',
                mobileSubMenu: '.menu__mobile-sub-menu',
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $toggle: this.$element.find(selectors.toggle),
            $drawer: this.$element.find(selectors.drawer),
            $wrapper: this.$element.find(selectors.wrapper),
            $icon: this.$element.find(selectors.icon),
            $mobileItemsWithChildren: this.$element.find(selectors.mobileItemWithChildren),
        };
    }

    bindEvents() {
        this.elements.$toggle.on('click', this.onToggleClick.bind(this));

        // Handle mobile menu toggle buttons (chevron) for items with children
        // Use event delegation on the wrapper to ensure it works even when drawer is hidden
        this.elements.$wrapper.on('click', '.menu__mobile-toggle', this.onMobileToggleClick.bind(this));
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

            // Trigger stagger animation on menu items
            this.animateMenuItems();
        } else {
            this.elements.$icon.removeClass('fa-times').addClass('fa-bars');
            document.body.style.overflow = ''; // Unlock Body

            // Reset animation state
            this.resetMenuItemsAnimation();
        }
    }

    animateMenuItems() {
        // Remove any existing animation classes
        this.elements.$drawer.find('.menu__mobile-item').removeClass('animate-in');
        this.elements.$drawer.find('.menu__lang-switcher--mobile').removeClass('animate-in');

        // Small delay to ensure drawer is visible, then trigger animation
        setTimeout(() => {
            // Animate menu items
            this.elements.$drawer.find('.menu__mobile-item').each((index, item) => {
                setTimeout(() => {
                    jQuery(item).addClass('animate-in');
                }, index * 50); // 50ms delay between each item
            });

            // Animate language switcher after menu items (with additional delay)
            const menuItemCount = this.elements.$drawer.find('.menu__mobile-item').length;
            const languageSwitcherDelay = menuItemCount * 50 + 100; // After all items + 100ms

            setTimeout(() => {
                this.elements.$drawer.find('.menu__lang-switcher--mobile').addClass('animate-in');
            }, languageSwitcherDelay);
        }, 50);
    }

    resetMenuItemsAnimation() {
        // Remove animation classes when closing
        this.elements.$drawer.find('.menu__mobile-item').removeClass('animate-in');
        this.elements.$drawer.find('.menu__lang-switcher--mobile').removeClass('animate-in');
    }

    onMobileToggleClick(event) {
        event.preventDefault();
        event.stopPropagation();

        const $button = jQuery(event.currentTarget);
        const $item = $button.closest('.menu__mobile-item--has-children');

        // Toggle the submenu
        const isOpen = $item.hasClass('is-open');

        if (isOpen) {
            $item.removeClass('is-open');
            $button.attr('aria-expanded', 'false');
        } else {
            // Close other open items (accordion behavior)
            this.elements.$mobileItemsWithChildren.not($item).removeClass('is-open')
                .find('.menu__mobile-toggle').attr('aria-expanded', 'false');

            $item.addClass('is-open');
            $button.attr('aria-expanded', 'true');
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
