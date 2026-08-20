/**
 * Mewa Tours - Destinations Page Category Filtering JavaScript
 */
document.addEventListener('DOMContentLoaded', () => {
    const filterBtns = document.querySelectorAll('#destFilterTabs .dest-filter-btn');
    const destCards = document.querySelectorAll('.dest-collection-card');
    const visibleCountEl = document.getElementById('visibleDestCount');
    const emptyState = document.getElementById('emptyDestFilterState');
    const resetBtn = document.getElementById('resetDestFilterBtn');

    if (!filterBtns.length || !destCards.length) return;

    function applyFilter(category) {
        let visibleCount = 0;

        destCards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (category === 'all' || cardCat === category) {
                card.style.display = 'flex';
                card.style.opacity = '1';
                visibleCount++;
            } else {
                card.style.display = 'none';
                card.style.opacity = '0';
            }
        });

        if (visibleCountEl) {
            visibleCountEl.textContent = visibleCount.toString();
        }

        if (emptyState) {
            if (visibleCount === 0) {
                emptyState.style.display = 'block';
            } else {
                emptyState.style.display = 'none';
            }
        }
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });

            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true');

            const filterValue = btn.getAttribute('data-filter') || 'all';
            applyFilter(filterValue);
        });
    });

    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            const allBtn = document.querySelector('#destFilterTabs .dest-filter-btn[data-filter="all"]');
            if (allBtn) {
                allBtn.click();
            }
        });
    }
});
