/**
 * Mewa Tours - Interactive Gallery & Lightbox Controller
 */
document.addEventListener('DOMContentLoaded', () => {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryCards = document.querySelectorAll('.gallery-card');
    const lightboxModal = document.getElementById('lightboxModal');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const lightboxWaCta = document.getElementById('lightboxWaCta');
    const lightboxCloseBtn = document.getElementById('lightboxCloseBtn');
    const lightboxPrevBtn = document.getElementById('lightboxPrevBtn');
    const lightboxNextBtn = document.getElementById('lightboxNextBtn');

    let currentCardIndex = -1;
    let visibleCards = Array.from(galleryCards);

    /* --------------------------------------------------------------------------
       1. CATEGORY FILTER TABS
       -------------------------------------------------------------------------- */
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            visibleCards = [];
            galleryCards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                if (filterValue === 'all' || cardCategory === filterValue) {
                    card.style.display = 'flex';
                    visibleCards.push(card);
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    /* --------------------------------------------------------------------------
       2. LIGHTBOX MODAL FUNCTIONALITY
       -------------------------------------------------------------------------- */
    const openLightbox = (index) => {
        if (index < 0 || index >= visibleCards.length) return;
        currentCardIndex = index;
        const card = visibleCards[index];

        const imgSrc = card.getAttribute('data-full-img') || card.querySelector('.gallery-card-img').src;
        const title = card.getAttribute('data-title') || 'Gallery Photo';
        const caption = card.getAttribute('data-desc') || '';
        const waMessage = `Hello Mewa Tours, I saw the photo "${title}" in your gallery and would like to inquire about a similar tour package.`;

        lightboxImg.src = imgSrc;
        lightboxTitle.textContent = title;
        lightboxCaption.textContent = caption;

        if (lightboxWaCta) {
            lightboxWaCta.href = `https://wa.me/94769695024?text=${encodeURIComponent(waMessage)}`;
        }

        lightboxModal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Lock scrolling
    };

    const closeLightbox = () => {
        lightboxModal.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
        lightboxImg.src = '';
    };

    const nextImage = () => {
        if (visibleCards.length === 0) return;
        let nextIndex = (currentCardIndex + 1) % visibleCards.length;
        openLightbox(nextIndex);
    };

    const prevImage = () => {
        if (visibleCards.length === 0) return;
        let prevIndex = (currentCardIndex - 1 + visibleCards.length) % visibleCards.length;
        openLightbox(prevIndex);
    };

    // Event Listeners for Cards
    galleryCards.forEach(card => {
        card.addEventListener('click', (e) => {
            const index = visibleCards.indexOf(card);
            if (index !== -1) {
                openLightbox(index);
            }
        });
    });

    // Lightbox Controls
    if (lightboxCloseBtn) lightboxCloseBtn.addEventListener('click', closeLightbox);
    if (lightboxNextBtn) lightboxNextBtn.addEventListener('click', (e) => { e.stopPropagation(); nextImage(); });
    if (lightboxPrevBtn) lightboxPrevBtn.addEventListener('click', (e) => { e.stopPropagation(); prevImage(); });

    // Close on backdrop click
    if (lightboxModal) {
        lightboxModal.addEventListener('click', (e) => {
            if (e.target === lightboxModal) {
                closeLightbox();
            }
        });
    }

    // Keyboard Navigation
    document.addEventListener('keydown', (e) => {
        if (!lightboxModal.classList.contains('active')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') prevImage();
    });
});
