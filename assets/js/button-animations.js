/**
 * Button Animation Handler
 * 
 * Automatically applies vertical flip animation to all buttons
 * without requiring manual HTML structure with btn__content and btn__hover-content divs.
 * 
 * @since 1.0.0
 */
(function() {
    'use strict';

    /**
     * Enable/Disable Button Animations
     * 
     * Set to false to disable all button animations globally.
     * 
     * Other ways to disable:
     * - Add data-disable-button-animations="true" to the <body> tag
     * - Add .no-button-animations class to the <body> tag
     */
    const ENABLE_BUTTON_ANIMATIONS = true;

    /**
     * Check if animations should be enabled
     */
    function shouldEnableAnimations() {
        // Check global flag
        if (!ENABLE_BUTTON_ANIMATIONS) {
            return false;
        }
        
        // Check for data attribute or class on body/html
        const body = document.body || document.documentElement;
        if (body) {
            if (body.getAttribute('data-disable-button-animations') === 'true') {
                return false;
            }
            if (body.classList.contains('no-button-animations')) {
                return false;
            }
        }
        
        return true;
    }

    /**
     * Initialize button animations
     */
    function initButtonAnimations() {
        // Check if animations should be enabled
        if (!shouldEnableAnimations()) {
            return;
        }
        // Select all buttons that don't already have the animated structure
        const buttons = document.querySelectorAll('.btn:not(.btn--animated):not([data-animated])');
        
        buttons.forEach(function(button) {
            // Skip if button already has btn__content structure
            if (button.querySelector('.btn__content')) {
                return;
            }

            // Get the button's inner HTML (text, icons, etc.)
            const buttonContent = button.innerHTML;
            
            // Skip if button is empty
            if (!buttonContent.trim()) {
                return;
            }

            // Create wrapper structure
            const contentWrapper = document.createElement('div');
            contentWrapper.className = 'btn__content';
            contentWrapper.innerHTML = buttonContent;

            const hoverWrapper = document.createElement('div');
            hoverWrapper.className = 'btn__hover-content';
            hoverWrapper.innerHTML = buttonContent;

            // Clear button content and add wrappers
            // Remove gap from button since wrappers will handle it
            button.style.gap = '0';
            button.innerHTML = '';
            button.appendChild(contentWrapper);
            button.appendChild(hoverWrapper);

            // Add animated class
            button.classList.add('btn--animated');
            button.setAttribute('data-animated', 'true');
        });
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initButtonAnimations);
    } else {
        initButtonAnimations();
    }

    // Re-initialize for dynamically loaded content (e.g., Elementor)
    if (typeof jQuery !== 'undefined') {
        jQuery(document).on('elementor/popup/show', initButtonAnimations);
    }

    // MutationObserver for dynamically added buttons
    if (typeof MutationObserver !== 'undefined') {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes.length) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1) { // Element node
                            // Check if the added node is a button or contains buttons
                            if (node.classList && node.classList.contains('btn')) {
                                initButtonAnimations();
                            } else if (node.querySelectorAll) {
                                const newButtons = node.querySelectorAll('.btn:not(.btn--animated):not([data-animated])');
                                if (newButtons.length > 0) {
                                    initButtonAnimations();
                                }
                            }
                        }
                    });
                }
            });
        });

        // Start observing
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }
})();
