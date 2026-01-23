class EllensMenuSearchHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                searchToggle: '.js-menu-search-toggle',
                searchClose: '.js-menu-search-close',
                searchOverlay: '.menu__search-overlay',
                searchField: '.menu__search-field',
                searchResults: '.menu__search-results',
                searchForm: '.menu__search-form',
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $searchToggle: this.$element.find(selectors.searchToggle),
            $searchClose: this.$element.find(selectors.searchClose),
            $searchOverlay: this.$element.find(selectors.searchOverlay),
            $searchField: this.$element.find(selectors.searchField),
            $searchResults: this.$element.find(selectors.searchResults),
            $searchForm: this.$element.find(selectors.searchForm),
        };
    }

    onInit() {
        super.onInit();
        this.selectedIndex = -1;
        this.currentResults = [];
        
        // Debug: Check if elements are found
        if (this.elements.$searchField.length === 0) {
            console.warn('Menu search: Search field not found');
        }
        if (this.elements.$searchForm.length === 0) {
            console.warn('Menu search: Search form not found');
        }
        if (this.elements.$searchResults.length === 0) {
            console.warn('Menu search: Search results container not found');
        }
    }

    bindEvents() {
        if (this.elements.$searchToggle.length) {
            // Main Toggle Button (Search <-> Close)
            this.elements.$searchToggle.on('click', this.toggleSearch.bind(this));

            // Keep inner close button just in case, or for overlay actions
            this.elements.$searchClose.on('click', this.closeSearch.bind(this));

            // Prevent form submission - we handle search via AJAX
            this.elements.$searchForm.on('submit', (e) => {
                e.preventDefault();
                const term = this.elements.$searchField.val().trim();
                if (term.length >= 2) {
                    this.performSearch(term);
                }
                return false;
            });

            // Live Search Input with Debounce
            this.elements.$searchField.on('input', this.debounce(this.onSearchInput.bind(this), 300));

            // Keyboard navigation for autocomplete
            this.elements.$searchField.on('keydown', this.handleKeydown.bind(this));

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

            // Handle result item clicks
            this.elements.$searchResults.on('click', '.menu__result-item', (e) => {
                e.preventDefault();
                const url = jQuery(e.currentTarget).attr('href');
                if (url) {
                    window.location.href = url;
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
        this.selectedIndex = -1;

        if (term.length < 2) {
            this.elements.$searchResults.empty().removeClass('is-loading');
            this.currentResults = [];
            return;
        }

        console.log('Search triggered for term:', term);
        this.showLoading();
        this.performSearch(term);
    }

    handleKeydown(event) {
        const $results = this.elements.$searchResults.find('.menu__result-item');
        const resultsCount = $results.length;

        if (resultsCount === 0) {
            return;
        }

        switch (event.key) {
            case 'ArrowDown':
                event.preventDefault();
                this.selectedIndex = (this.selectedIndex + 1) % resultsCount;
                this.updateSelection($results);
                break;

            case 'ArrowUp':
                event.preventDefault();
                this.selectedIndex = this.selectedIndex <= 0 ? resultsCount - 1 : this.selectedIndex - 1;
                this.updateSelection($results);
                break;

            case 'Enter':
                event.preventDefault();
                if (this.selectedIndex >= 0 && this.selectedIndex < resultsCount) {
                    const $selected = $results.eq(this.selectedIndex);
                    const url = $selected.attr('href');
                    if (url) {
                        window.location.href = url;
                    }
                } else if (resultsCount > 0) {
                    // If nothing selected, go to first result
                    const $first = $results.first();
                    const url = $first.attr('href');
                    if (url) {
                        window.location.href = url;
                    }
                }
                break;

            case 'Escape':
                // Let the default handler close the search
                break;
        }
    }

    updateSelection($results) {
        $results.removeClass('is-selected');
        if (this.selectedIndex >= 0 && this.selectedIndex < $results.length) {
            const $selected = $results.eq(this.selectedIndex);
            $selected.addClass('is-selected');
            
            // Scroll into view
            const resultsContainer = this.elements.$searchResults[0];
            const selectedElement = $selected[0];
            if (resultsContainer && selectedElement) {
                const containerRect = resultsContainer.getBoundingClientRect();
                const selectedRect = selectedElement.getBoundingClientRect();
                
                if (selectedRect.top < containerRect.top) {
                    selectedElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else if (selectedRect.bottom > containerRect.bottom) {
                    selectedElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            }
        }
    }

    showLoading() {
        this.elements.$searchResults
            .addClass('is-loading')
            .html('<div class="menu__search-loading">Zoeken...</div>');
    }

    performSearch(term) {
        // Collect post types from hidden inputs
        const postTypes = [];
        this.elements.$searchForm.find('input[name="post_type[]"]').each(function () {
            postTypes.push(jQuery(this).val());
        });

        // Get WordPress AJAX URL - prioritize localized variable, then Elementor, then fallback
        let ajaxUrl = '';
        if (typeof ellensMenuSearch !== 'undefined' && ellensMenuSearch.ajaxUrl) {
            ajaxUrl = ellensMenuSearch.ajaxUrl;
        } else if (typeof elementorFrontend !== 'undefined' && elementorFrontend.config && elementorFrontend.config.urls && elementorFrontend.config.urls.ajax) {
            ajaxUrl = elementorFrontend.config.urls.ajax;
        } else {
            // Fallback to WordPress admin-ajax.php
            ajaxUrl = '/wp-admin/admin-ajax.php';
        }

        console.log('Performing search:', { term, postTypes, ajaxUrl });

        jQuery.ajax({
            url: ajaxUrl,
            method: 'GET',
            data: {
                action: 'ellens_menu_search',
                term: term,
                post_types: postTypes,
            },
            success: (response) => {
                console.log('Search response:', response);
                this.elements.$searchResults.removeClass('is-loading');
                if (response.success) {
                    this.renderResults(response.data);
                } else {
                    console.error('Search error:', response.data);
                    this.elements.$searchResults.html('<p class="menu__search-no-results">Er is een fout opgetreden bij het zoeken.</p>');
                }
            },
            error: (xhr, status, error) => {
                console.error('AJAX error:', status, error);
                console.error('Response:', xhr.responseText);
                console.error('Status code:', xhr.status);
                this.elements.$searchResults.removeClass('is-loading');
                this.elements.$searchResults.html('<p class="menu__search-no-results">Er is een fout opgetreden bij het zoeken.</p>');
            },
        });
    }

    renderResults(results) {
        this.elements.$searchResults.removeClass('is-loading');
        this.currentResults = results || [];
        this.selectedIndex = -1;

        if (!results || results.length === 0) {
            this.elements.$searchResults.html('<p class="menu__search-no-results">Geen resultaten gevonden.</p>');
            return;
        }

        const searchTerm = this.elements.$searchField.val().trim().toLowerCase();
        const html = results.map((item, index) => {
            const highlightedTitle = this.highlightMatch(item.title, searchTerm);
            return `
                <a href="${item.url}" class="menu__result-item" data-index="${index}">
                    <span class="menu__result-title">${highlightedTitle}</span>
                    <span class="menu__result-type">${item.type}</span>
                </a>
            `;
        }).join('');

        this.elements.$searchResults.html(html);
    }

    highlightMatch(text, searchTerm) {
        if (!searchTerm) {
            return this.escapeHtml(text);
        }

        const escapedText = this.escapeHtml(text);
        const escapedTerm = this.escapeHtml(searchTerm);
        
        // Create regex to match search term (case insensitive)
        const regex = new RegExp(`(${escapedTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        
        return escapedText.replace(regex, '<mark class="menu__result-highlight">$1</mark>');
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    openSearch(event) {
        if (event) event.preventDefault();

        this.elements.$searchOverlay.addClass('is-active');

        // Icon Animation: Search -> Times
        const $icon = this.elements.$searchToggle.find('i');
        $icon.removeClass('fa-search').addClass('fa-times');

        // Focus input after transition
        setTimeout(() => {
            this.elements.$searchField.focus();
        }, 300);
    }

    closeSearch(event) {
        if (event) event.preventDefault();

        this.elements.$searchOverlay.removeClass('is-active');
        this.elements.$searchField.val('');
        this.elements.$searchResults.empty().removeClass('is-loading');
        this.selectedIndex = -1;
        this.currentResults = [];

        // Icon Animation: Times -> Search
        const $icon = this.elements.$searchToggle.find('i');
        $icon.removeClass('fa-times').addClass('fa-search');
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(EllensMenuSearchHandler, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/ellens_menu.default', addHandler);
});
