/**
 * Hero Card Dynamic Positioning
 * 
 * Automatically adjusts translateY based on card content height
 * 
 * @since 1.0.0
 */

(function() {
    'use strict';

    /**
     * Calculate and apply translateY to hero cards
     */
    function adjustHeroCardPosition() {
        const heroCards = document.querySelectorAll('.hero__card');
        
        heroCards.forEach(function(card) {
            // Temporarily remove transform to measure natural height
            card.style.transform = 'none';
            
            // Get card height and container/viewport height
            const cardHeight = card.offsetHeight;
            const container = card.closest('.hero__container');
            const containerHeight = container ? container.offsetHeight : window.innerHeight;
            const viewportHeight = window.innerHeight;

            const baseOffset = viewportHeight * 0.1;
  
            const cardHeightVh = (cardHeight / viewportHeight) * 100;
            let heightAdjustment = 0;
            
            if (cardHeightVh > 50) {
                // Tall card: reduce offset (move up)
                heightAdjustment = -(cardHeightVh - 50) * 2; // Reduce by 2px per vh over 50
            } else if (cardHeightVh < 30) {
                // Short card: increase offset (move down)
                heightAdjustment = (30 - cardHeightVh) * 3; // Increase by 3px per vh under 30
            }
            
            const translateY = baseOffset + heightAdjustment;
            
            // Ensure translateY is within reasonable bounds (5vh to 25vh)
            const minTranslateY = viewportHeight * 0.05;
            const maxTranslateY = viewportHeight * 0.25;
            const clampedTranslateY = Math.max(minTranslateY, Math.min(maxTranslateY, translateY));
            
            // Apply transform with vendor prefixes
            const translateValue = `translateY(${clampedTranslateY}px)`;
            card.style.transform = translateValue;
            card.style.webkitTransform = translateValue;
            card.style.mozTransform = translateValue;
            card.style.msTransform = translateValue;
            card.style.oTransform = translateValue;
        });
    }

    /**
     * Initialize on DOM ready
     */
    function init() {
        // Run on page load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', adjustHeroCardPosition);
        } else {
            adjustHeroCardPosition();
        }

        // Recalculate on window resize (debounced)
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(adjustHeroCardPosition, 250);
        });

        // Recalculate when images load (in case content height changes)
        const images = document.querySelectorAll('.hero__card img');
        images.forEach(function(img) {
            if (img.complete) {
                adjustHeroCardPosition();
            } else {
                img.addEventListener('load', adjustHeroCardPosition);
            }
        });
    }

    // Initialize
    init();

})();
