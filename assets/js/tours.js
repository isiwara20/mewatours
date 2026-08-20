/**
 * Mewa Tours - Tours Page Category Filtering JavaScript
 */
document.addEventListener('DOMContentLoaded', () => {
    const filterTabs = document.querySelectorAll('#toursFilterTabs .filter-tab');
    const tourCards = document.querySelectorAll('.tour-collection-card');
    const visibleCountEl = document.getElementById('visibleToursCount');
    const emptyState = document.getElementById('emptyFilterState');
    const resetBtn = document.getElementById('resetFilterBtn');

    if (!filterTabs.length || !tourCards.length) return;

    function applyFilter(category) {
        let visibleCount = 0;

        tourCards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (category === 'all' || cardCat === category || (category === 'heritage-culture' && cardCat === 'heritage-cultural')) {
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

    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            filterTabs.forEach(t => {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
            });

            tab.classList.add('active');
            tab.setAttribute('aria-selected', 'true');

            const filterValue = tab.getAttribute('data-filter') || 'all';
            applyFilter(filterValue);
        });
    });

    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            const allTab = document.querySelector('#toursFilterTabs .filter-tab[data-filter="all"]');
            if (allTab) {
                allTab.click();
            }
        });
    }
});
