class EllensMenuHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                toggle: '.menu__toggle',
                drawer: '.menu__drawer',
                wrapper: '.menu-wrapper',
                icon: '.menu__toggle i',
                searchToggle: '.js-menu-search-toggle',
                searchClose: '.js-menu-search-close',
                searchOverlay: '.menu__search-overlay',
                searchField: '.menu__search-field',
                searchResults: '.menu__search-results',
                searchForm: '.menu__search-form',
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
            $searchToggle: this.$element.find(selectors.searchToggle),
            $searchClose: this.$element.find(selectors.searchClose),
            $searchOverlay: this.$element.find(selectors.searchOverlay),
            $searchField: this.$element.find(selectors.searchField),
            $searchResults: this.$element.find(selectors.searchResults),
            $searchForm: this.$element.find(selectors.searchForm),
            $mobileItemsWithChildren: this.$element.find(selectors.mobileItemWithChildren),
        };
    }

    bindEvents() {
        this.elements.$toggle.on('click', this.onToggleClick.bind(this));

        // Handle mobile menu toggle buttons (chevron) for items with children
        // Use event delegation on the wrapper to ensure it works even when drawer is hidden
        this.elements.$wrapper.on('click', '.menu__mobile-toggle', this.onMobileToggleClick.bind(this));

        if (this.elements.$searchToggle.length) {
            // Main Toggle Button (Search <-> Close)
            this.elements.$searchToggle.on('click', this.toggleSearch.bind(this));

            // Keep inner close button just in case, or for overlay actions
            this.elements.$searchClose.on('click', this.closeSearch.bind(this));

            // Live Search Input with Debounce
            this.elements.$searchField.on('input', this.debounce(this.onSearchInput.bind(this), 300));

            // Close on Escape key
            jQuery(document).on('keydown', (e) => {
                if (e.key === 'Escape' && this.elements.$searchOverlay.hasClass('is-active')) {
                    this.closeSearch();
                }
            });

            // Close when clicking outside (optional but good UX)
            jQuery(document).on('click', (e) => {
                if (this.elements.$searchOverlay.hasClass('is-active') &&
                    !jQuery(e.target).closest(this.elements.$searchOverlay).length &&
                    !jQuery(e.target).closest(this.elements.$searchToggle).length) {
                    this.closeSearch();
                }
            });
        }
    }

    toggleSearch(event) {
        event.preventDefault();

        if (this.elements.$searchOverlay.hasClass('is-active')) {
            this.closeSearch();
        } else {
            this.openSearch();
        }
    }

    debounce(func, wait) {
        let timeout;
        return function (...args) {
            const context = this;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    onSearchInput(event) {
        const term = event.target.value.trim();

        if (term.length < 3) {
            this.elements.$searchResults.empty();
            return;
        }

        this.performSearch(term);
    }

    performSearch(term) {
        // Collect post types from hidden inputs
        const postTypes = [];
        this.elements.$searchForm.find('input[name="post_type[]"]').each(function () {
            postTypes.push(jQuery(this).val());
        });

        jQuery.ajax({
            url: elementorFrontend.config.urls.ajax,
            method: 'GET',
            data: {
                action: 'ellens_menu_search',
                term: term,
                post_types: postTypes,
            },
            success: (response) => {
                if (response.success) {
                    this.renderResults(response.data);
                }
            },
        });
    }

    renderResults(results) {
        this.elements.$searchResults.empty();

        if (!results || results.length === 0) {
            this.elements.$searchResults.append('<p style="color:white; opacity: 0.7;">Geen resultaten gevonden.</p>');
            return;
        }

        const html = results.map(item => `
            <a href="${item.url}" class="menu__result-item">
                <span class="menu__result-title">${item.title}</span>
                <span class="menu__result-type">${item.type}</span>
            </a>
        `).join('');

        this.elements.$searchResults.append(html);
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

    openSearch(event) {
        if (event) event.preventDefault();

        this.elements.$searchOverlay.addClass('is-active');

        // Icon Animation: Search -> Times
        const $icon = this.elements.$searchToggle.find('i');
        $icon.removeClass('fa-search').addClass('fa-times');

        // document.body.style.overflow = 'hidden'; // Optional: Lock body if needed

        // Focus input after transition
        setTimeout(() => {
            this.elements.$searchField.focus();
        }, 300);
    }

    closeSearch(event) {
        if (event) event.preventDefault();

        this.elements.$searchOverlay.removeClass('is-active');

        // Icon Animation: Times -> Search
        const $icon = this.elements.$searchToggle.find('i');
        $icon.removeClass('fa-times').addClass('fa-search');

        // document.body.style.overflow = ''; 
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
