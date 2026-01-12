document.addEventListener('DOMContentLoaded', () => {
    const faqItems = document.querySelectorAll('.faq-accordion__item');

    faqItems.forEach(item => {
        const header = item.querySelector('.faq-accordion__header');
        const content = item.querySelector('.faq-accordion__content');

        header.addEventListener('click', () => {
            const isActive = item.classList.contains('is-active');

            // Close other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('is-active');
                    otherItem.querySelector('.faq-accordion__header').setAttribute('aria-expanded', 'false');
                    otherItem.querySelector('.faq-accordion__content').style.maxHeight = null;
                    otherItem.querySelector('.faq-accordion__content').setAttribute('hidden', '');
                }
            });

            // Toggle current item
            if (isActive) {
                item.classList.remove('is-active');
                header.setAttribute('aria-expanded', 'false');
                content.style.maxHeight = null;
                setTimeout(() => content.setAttribute('hidden', ''), 300);
            } else {
                item.classList.add('is-active');
                header.setAttribute('aria-expanded', 'true');
                content.removeAttribute('hidden');
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    });
});
