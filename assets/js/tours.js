/**
 * Mewa Tours - Premium Tour Carousel with Real-Time Multi-Filter Engine
 * Carousel + Filter Integration v2.0
 */
document.addEventListener('DOMContentLoaded', () => {

    // =========================================================================
    // 0. DOM REFERENCES
    // =========================================================================
    const filterTabs       = document.querySelectorAll('#toursFilterTabs .filter-tab');
    const searchInput      = document.getElementById('toursSearchInput');
    const durationSelect   = document.getElementById('toursDurationSelect');
    const sortSelect       = document.getElementById('toursSortSelect');
    const visibleCountEl   = document.getElementById('visibleToursCount');
    const emptyState       = document.getElementById('emptyFilterState');
    const resetBtn         = document.getElementById('resetFilterBtn');

    const carouselViewport = document.getElementById('carouselViewport');
    const track            = document.getElementById('mainToursGrid');
    const prevBtn          = document.getElementById('carouselPrev');
    const nextBtn          = document.getElementById('carouselNext');
    const dotsContainer    = document.getElementById('carouselDots');
    const carouselWrapper  = document.getElementById('toursCarouselWrapper');

    const allCards = Array.from(document.querySelectorAll('.tour-collection-card'));

    if (!allCards.length) return;

    // =========================================================================
    // 1. CAROUSEL STATE
    // =========================================================================
    let currentPage    = 0;
    let slidesPerPage  = getSlidesPerPage();
    let visibleCards   = [...allCards]; // cards currently passing filter
    let totalPages     = 0;
    let isAnimating    = false;

    // Track active filter values
    let activeCategory = 'all';

    // =========================================================================
    // 2. UTILITY: How many cards to show per page?
    // =========================================================================
    function getSlidesPerPage() {
        const w = window.innerWidth;
        if (w <= 640)  return 1;
        if (w <= 992)  return 2;
        return 3;
    }

    // =========================================================================
    // 3. FILTER HELPERS (Duration matching, Sort)
    // =========================================================================
    function matchDuration(cardDays, filterValue) {
        if (!filterValue || filterValue === 'all') return true;
        const days = parseInt(cardDays, 10) || 1;
        if (filterValue === '1-3')  return days >= 1  && days <= 3;
        if (filterValue === '4-7')  return days >= 4  && days <= 7;
        if (filterValue === '8-12') return days >= 8  && days <= 12;
        if (filterValue === '13+')  return days >= 13;
        return true;
    }

    function sortCards(cards, sortMode) {
        return [...cards].sort((a, b) => {
            const orderA  = parseInt(a.dataset.order || '0', 10);
            const orderB  = parseInt(b.dataset.order || '0', 10);
            const daysA   = parseInt(a.dataset.days  || '1', 10);
            const daysB   = parseInt(b.dataset.days  || '1', 10);
            const idA     = parseInt(a.dataset.id    || '0', 10);
            const idB     = parseInt(b.dataset.id    || '0', 10);
            const titleA  = (a.dataset.title || '').toLowerCase();
            const titleB  = (b.dataset.title || '').toLowerCase();

            if (sortMode === 'duration-asc')  return daysA  - daysB  || orderA - orderB;
            if (sortMode === 'duration-desc') return daysB  - daysA  || orderA - orderB;
            if (sortMode === 'title-asc')     return titleA.localeCompare(titleB);
            // Default ascending
            if (orderA !== orderB) return orderA - orderB;
            if (daysA  !== daysB)  return daysA  - daysB;
            return idA - idB;
        });
    }

    // =========================================================================
    // 4. CAROUSEL SIZING
    //    Calculates the card width so exactly `slidesPerPage` fill the viewport.
    // =========================================================================
    function getCardWidth() {
        if (!carouselViewport) return 300;
        const gap       = 28; // must match CSS gap on .main-tours-grid
        const vpWidth   = carouselViewport.clientWidth;
        return (vpWidth - gap * (slidesPerPage - 1)) / slidesPerPage;
    }

    // =========================================================================
    // 5. CAROUSEL RENDER
    //    Positions all visible cards with correct width and re-applies transform.
    // =========================================================================
    function renderCarousel(resetToPage0 = false) {
        if (resetToPage0) currentPage = 0;

        slidesPerPage = getSlidesPerPage();
        const cardW   = getCardWidth();
        const gap     = 28;

        // Set each visible card's width explicitly so all are equal
        visibleCards.forEach(card => {
            card.style.width  = cardW + 'px';
            card.style.flex   = '0 0 ' + cardW + 'px';
        });

        totalPages = Math.max(1, Math.ceil(visibleCards.length / slidesPerPage));
        if (currentPage >= totalPages) currentPage = totalPages - 1;

        // Apply slide transform
        applySlide();
        updateDots();
        updateArrows();
    }

    function applySlide() {
        if (!track) return;
        const cardW   = getCardWidth();
        const gap     = 28;
        const offset  = currentPage * slidesPerPage * (cardW + gap);
        track.style.transform = `translateX(-${offset}px)`;
    }

    // =========================================================================
    // 6. DOTS
    // =========================================================================
    function updateDots() {
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';

        if (totalPages <= 1) return; // no dots for single page

        for (let i = 0; i < totalPages; i++) {
            const dot = document.createElement('button');
            dot.type      = 'button';
            dot.className = 'carousel-dot' + (i === currentPage ? ' active' : '');
            dot.setAttribute('aria-label', `Go to page ${i + 1}`);
            dot.setAttribute('role', 'tab');
            dot.addEventListener('click', () => {
                if (i !== currentPage) {
                    currentPage = i;
                    applySlide();
                    updateDots();
                    updateArrows();
                }
            });
            dotsContainer.appendChild(dot);
        }
    }

    // =========================================================================
    // 7. ARROWS
    // =========================================================================
    function updateArrows() {
        if (prevBtn) prevBtn.disabled = (currentPage === 0);
        if (nextBtn) nextBtn.disabled = (currentPage >= totalPages - 1);

        if (carouselWrapper) {
            carouselWrapper.style.display = (visibleCards.length === 0) ? 'none' : 'flex';
        }
    }

    function goTo(page) {
        if (isAnimating) return;
        const clamped = Math.max(0, Math.min(page, totalPages - 1));
        if (clamped === currentPage) return;
        isAnimating = true;
        currentPage = clamped;
        applySlide();
        updateDots();
        updateArrows();
        setTimeout(() => { isAnimating = false; }, 580);
    }

    if (prevBtn) prevBtn.addEventListener('click', () => goTo(currentPage - 1));
    if (nextBtn) nextBtn.addEventListener('click', () => goTo(currentPage + 1));

    // =========================================================================
    // 8. KEYBOARD ARROW NAVIGATION (when carousel is focused)
    // =========================================================================
    if (carouselWrapper) {
        carouselWrapper.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') { e.preventDefault(); goTo(currentPage + 1); }
            if (e.key === 'ArrowLeft')  { e.preventDefault(); goTo(currentPage - 1); }
        });
    }

    // =========================================================================
    // 9. TOUCH SWIPE SUPPORT
    // =========================================================================
    let touchStartX = 0;
    let touchStartY = 0;

    if (carouselViewport) {
        carouselViewport.addEventListener('touchstart', (e) => {
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        }, { passive: true });

        carouselViewport.addEventListener('touchend', (e) => {
            const dx = e.changedTouches[0].clientX - touchStartX;
            const dy = e.changedTouches[0].clientY - touchStartY;
            // Only act on primarily-horizontal swipes (> 40px horizontal, less than 60px vertical drift)
            if (Math.abs(dx) > 40 && Math.abs(dy) < 60) {
                if (dx < 0) goTo(currentPage + 1); // swipe left → next
                else        goTo(currentPage - 1); // swipe right → prev
            }
        }, { passive: true });
    }

    // =========================================================================
    // 10. FILTER + SORT ENGINE
    //     Updates visibleCards, re-orders in DOM, triggers carousel reset.
    // =========================================================================
    function applyFiltersAndSort() {
        const query       = searchInput   ? searchInput.value.trim().toLowerCase()  : '';
        const durationVal = durationSelect ? durationSelect.value                   : 'all';
        const sortVal     = sortSelect     ? sortSelect.value                       : 'asc';

        // 1. Determine which cards pass the filter
        const passing = allCards.filter(card => {
            const cardCat    = card.dataset.category || '';
            const cardSearch = (card.dataset.search  || '').toLowerCase();
            const cardDays   = card.dataset.days;

            const matchCat = (
                activeCategory === 'all' ||
                cardCat === activeCategory ||
                (activeCategory === 'heritage-culture'  && cardCat === 'heritage-cultural') ||
                (activeCategory === 'heritage-cultural' && cardCat === 'heritage-culture')
            );
            const matchQuery = (!query || cardSearch.includes(query));
            const matchDur   = matchDuration(cardDays, durationVal);

            return matchCat && matchQuery && matchDur;
        });

        // 2. Sort passing cards
        const sorted = sortCards(passing, sortVal);

        // 3. Rebuild DOM order: append sorted visible cards, then hidden ones
        const hidden = allCards.filter(c => !passing.includes(c));
        if (track) {
            sorted.forEach(card => {
                card.classList.remove('carousel-hidden');
                track.appendChild(card);
            });
            hidden.forEach(card => {
                card.classList.add('carousel-hidden');
                track.appendChild(card);
            });
        }

        // 4. Update state
        visibleCards = sorted;
        const count  = sorted.length;

        if (visibleCountEl) visibleCountEl.textContent = count.toString();

        // 5. Show/hide empty state vs carousel
        const isEmpty = count === 0;
        if (emptyState)       emptyState.style.display       = isEmpty ? 'block' : 'none';
        if (dotsContainer)    dotsContainer.style.display    = isEmpty ? 'none'  : 'flex';

        // 6. Re-render carousel from page 0
        renderCarousel(true);
    }

    // =========================================================================
    // 11. FILTER EVENT LISTENERS
    // =========================================================================
    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            filterTabs.forEach(t => {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
            });
            tab.classList.add('active');
            tab.setAttribute('aria-selected', 'true');
            activeCategory = tab.dataset.filter || 'all';
            applyFiltersAndSort();
        });
    });

    if (searchInput) {
        ['input', 'keyup', 'search', 'change'].forEach(evt => {
            searchInput.addEventListener(evt, applyFiltersAndSort);
        });
    }

    if (durationSelect) durationSelect.addEventListener('change', applyFiltersAndSort);
    if (sortSelect)     sortSelect.addEventListener('change', applyFiltersAndSort);

    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            if (searchInput)    searchInput.value  = '';
            if (durationSelect) durationSelect.value = 'all';
            if (sortSelect)     sortSelect.value   = 'asc';
            const allTab = document.querySelector('#toursFilterTabs .filter-tab[data-filter="all"]');
            if (allTab) {
                filterTabs.forEach(t => { t.classList.remove('active'); t.setAttribute('aria-selected', 'false'); });
                allTab.classList.add('active');
                allTab.setAttribute('aria-selected', 'true');
                activeCategory = 'all';
            }
            applyFiltersAndSort();
        });
    }

    // =========================================================================
    // 12. WINDOW RESIZE — recompute slides per page + card widths
    // =========================================================================
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            // Temporarily disable transition for instant resize snap
            if (track) track.style.transition = 'none';
            renderCarousel(false);
            requestAnimationFrame(() => {
                if (track) track.style.transition = '';
            });
        }, 120);
    });

    // =========================================================================
    // 13. URL QUERY PARAM — Auto-select category from ?category=slug
    // =========================================================================
    const urlParams     = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');

    if (categoryParam && categoryParam !== 'all') {
        const matchingTab = Array.from(filterTabs).find(tab => {
            const slug = tab.dataset.filter || '';
            return slug === categoryParam ||
                   (categoryParam === 'heritage-culture'  && slug === 'heritage-cultural') ||
                   (categoryParam === 'heritage-cultural' && slug === 'heritage-culture');
        });

        if (matchingTab) {
            filterTabs.forEach(t => { t.classList.remove('active'); t.setAttribute('aria-selected', 'false'); });
            matchingTab.classList.add('active');
            matchingTab.setAttribute('aria-selected', 'true');
            activeCategory = matchingTab.dataset.filter || 'all';

            // Smooth scroll to tours section after a short delay
            const toursSection = document.getElementById('toursCollection');
            if (toursSection) {
                setTimeout(() => {
                    toursSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 200);
            }
        }
    }

    // =========================================================================
    // 14. INITIAL RENDER
    // =========================================================================
    applyFiltersAndSort();
});
