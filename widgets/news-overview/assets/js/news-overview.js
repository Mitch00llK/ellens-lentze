document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.news-overview__filter-btn');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault(); // If it's a button, prevent submit. If link, prevent nav?

            // Remove active class from siblings in same widget
            const wrapper = btn.closest('.news-overview');
            if (!wrapper) return;

            wrapper.querySelectorAll('.news-overview__filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');
            const items = wrapper.querySelectorAll('.news-overview__item');

            items.forEach(item => {
                if (filterValue === '*' || filterValue === '') {
                    item.classList.remove('hidden');
                } else {
                    const categories = item.getAttribute('data-categories').split(' ');
                    if (categories.includes(filterValue)) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                }
            });
        });
    });
});
