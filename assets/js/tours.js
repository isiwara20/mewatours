/**
 * Mewa Tours - Real-Time Multi-Filtering & Ascending Sorting Engine
 */
document.addEventListener('DOMContentLoaded', () => {
    const filterTabs = document.querySelectorAll('#toursFilterTabs .filter-tab');
    const searchInput = document.getElementById('toursSearchInput');
    const durationSelect = document.getElementById('toursDurationSelect');
    const sortSelect = document.getElementById('toursSortSelect');
    const toursGrid = document.getElementById('mainToursGrid');
    const visibleCountEl = document.getElementById('visibleToursCount');
    const emptyState = document.getElementById('emptyFilterState');
    const resetBtn = document.getElementById('resetFilterBtn');

    const tourCards = Array.from(document.querySelectorAll('.tour-collection-card'));

    if (!tourCards.length) return;

    let activeCategory = 'all';

    function matchDuration(cardDays, filterValue) {
        if (!filterValue || filterValue === 'all') return true;
        const days = parseInt(cardDays, 10) || 1;
        if (filterValue === '1-3') return days >= 1 && days <= 3;
        if (filterValue === '4-7') return days >= 4 && days <= 7;
        if (filterValue === '8-12') return days >= 8 && days <= 12;
        if (filterValue === '13+') return days >= 13;
        return true;
    }

    function sortTourCards(cards, sortMode) {
        return cards.sort((a, b) => {
            const orderA = parseInt(a.getAttribute('data-order') || '0', 10);
            const orderB = parseInt(b.getAttribute('data-order') || '0', 10);
            const daysA = parseInt(a.getAttribute('data-days') || '1', 10);
            const daysB = parseInt(b.getAttribute('data-days') || '1', 10);
            const idA = parseInt(a.getAttribute('data-id') || '0', 10);
            const idB = parseInt(b.getAttribute('data-id') || '0', 10);
            const titleA = (a.getAttribute('data-title') || '').toLowerCase();
            const titleB = (b.getAttribute('data-title') || '').toLowerCase();

            if (sortMode === 'duration-asc') {
                return daysA - daysB || orderA - orderB;
            } else if (sortMode === 'duration-desc') {
                return daysB - daysA || orderA - orderB;
            } else if (sortMode === 'title-asc') {
                return titleA.localeCompare(titleB);
            } else {
                // Default: Ascending Order by display_order, duration_days, id
                if (orderA !== orderB) return orderA - orderB;
                if (daysA !== daysB) return daysA - daysB;
                return idA - idB;
            }
        });
    }

    function applyFiltersAndSort() {
        const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
        const durationVal = durationSelect ? durationSelect.value : 'all';
        const sortVal = sortSelect ? sortSelect.value : 'asc';

        let visibleCount = 0;

        // 1. Real-time filtering loop
        tourCards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            const cardSearch = (card.getAttribute('data-search') || '').toLowerCase();
            const cardDays = card.getAttribute('data-days');

            const matchCat = (activeCategory === 'all' || cardCat === activeCategory || (activeCategory === 'heritage-culture' && cardCat === 'heritage-cultural'));
            const matchQuery = (!query || cardSearch.includes(query));
            const matchDur = matchDuration(cardDays, durationVal);

            card.style.transition = 'opacity 0.2s ease, transform 0.2s ease';

            if (matchCat && matchQuery && matchDur) {
                card.style.display = 'flex';
                requestAnimationFrame(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                });
                visibleCount++;
            } else {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.96)';
                card.style.display = 'none';
            }
        });

        // 2. Real-time DOM sorting (Default: Ascending)
        if (toursGrid) {
            const sortedCards = sortTourCards([...tourCards], sortVal);
            sortedCards.forEach(card => {
                toursGrid.appendChild(card);
            });
        }

        // 3. Update counter badge & empty state
        if (visibleCountEl) {
            visibleCountEl.textContent = visibleCount.toString();
        }

        if (emptyState) {
            emptyState.style.display = (visibleCount === 0) ? 'block' : 'none';
        }
    }

    // Category Tabs real-time click listener
    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            filterTabs.forEach(t => {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
            });

            tab.classList.add('active');
            tab.setAttribute('aria-selected', 'true');

            activeCategory = tab.getAttribute('data-filter') || 'all';
            applyFiltersAndSort();
        });
    });

    // Real-time Search Input Listeners (input, keyup, search)
    if (searchInput) {
        ['input', 'keyup', 'search', 'change'].forEach(evt => {
            searchInput.addEventListener(evt, applyFiltersAndSort);
        });
    }

    // Dropdown Change Listeners
    if (durationSelect) durationSelect.addEventListener('change', applyFiltersAndSort);
    if (sortSelect) sortSelect.addEventListener('change', applyFiltersAndSort);

    // Reset Filters Button Listener
    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            if (durationSelect) durationSelect.value = 'all';
            if (sortSelect) sortSelect.value = 'asc';
            const allTab = document.querySelector('#toursFilterTabs .filter-tab[data-filter="all"]');
            if (allTab) allTab.click();
            else applyFiltersAndSort();
        });
    }

    // Initial Execution on Page Load
    applyFiltersAndSort();
});
