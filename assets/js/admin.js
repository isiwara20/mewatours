/**
 * Mewa Tours - Admin Portal Interaction & Dynamic Form Management
 */
document.addEventListener('DOMContentLoaded', () => {
    // Sidebar toggle for admin responsive layout
    const sidebarToggle = document.getElementById('adminSidebarToggle');
    const sidebar = document.getElementById('adminSidebar');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
    }

    // Dynamic Inclusions Management
    const addInclusionBtn = document.getElementById('addInclusionBtn');
    const inclusionsList = document.getElementById('inclusionsList');

    if (addInclusionBtn && inclusionsList) {
        addInclusionBtn.addEventListener('click', () => {
            const row = createDynamicRow('inclusions[]', 'e.g. Daily Breakfast');
            inclusionsList.appendChild(row);
            const input = row.querySelector('input');
            if (input) input.focus();
        });
    }

    // Dynamic Highlights Management
    const addHighlightBtn = document.getElementById('addHighlightBtn');
    const highlightsList = document.getElementById('highlightsList');

    if (addHighlightBtn && highlightsList) {
        addHighlightBtn.addEventListener('click', () => {
            const row = createDynamicRow('highlights[]', 'e.g. Yala Wildlife Safari');
            highlightsList.appendChild(row);
            const input = row.querySelector('input');
            if (input) input.focus();
        });
    }

    // Dynamic Itinerary Days Management
    const addItineraryDayBtn = document.getElementById('addItineraryDayBtn');
    const itineraryWrapper = document.getElementById('itineraryDaysWrapper');

    if (addItineraryDayBtn && itineraryWrapper) {
        addItineraryDayBtn.addEventListener('click', () => {
            addItineraryDay();
        });
    }
});

/**
 * Create a dynamic input row element with remove button
 */
function createDynamicRow(inputName, placeholderText) {
    const row = document.createElement('div');
    row.className = 'dynamic-input-row';
    row.innerHTML = `
        <div class="input-drag-handle"><i class="fa-solid fa-bars"></i></div>
        <input type="text" name="${inputName}" class="form-control" placeholder="${placeholderText}">
        <button type="button" class="btn-remove-row" onclick="removeDynamicRow(this)" title="Remove Item">
            <i class="fa-solid fa-minus-circle"></i> Remove
        </button>
    `;
    return row;
}

/**
 * Remove dynamic input row cleanly
 */
function removeDynamicRow(buttonElement) {
    const row = buttonElement.closest('.dynamic-input-row');
    if (row) {
        const container = row.parentElement;
        const rowsCount = container.querySelectorAll('.dynamic-input-row').length;
        if (rowsCount > 1) {
            row.remove();
        } else {
            const input = row.querySelector('input');
            if (input) input.value = '';
        }
    }
}

/**
 * Add a new Day-by-Day Itinerary card
 */
function addItineraryDay() {
    const wrapper = document.getElementById('itineraryDaysWrapper');
    if (!wrapper) return;

    const currentCards = wrapper.querySelectorAll('.itinerary-day-card');
    const nextIndex = currentCards.length;
    const nextDayNum = nextIndex + 1;

    const card = document.createElement('div');
    card.className = 'itinerary-day-card';
    card.innerHTML = `
        <div class="itinerary-card-header">
            <span class="day-badge-header">DAY <span class="day-num-display">${nextDayNum}</span></span>
            <div class="itinerary-card-actions">
                <button type="button" class="btn-itin-move" onclick="moveItineraryDay(this, -1)" title="Move Day Up"><i class="fa-solid fa-arrow-up"></i></button>
                <button type="button" class="btn-itin-move" onclick="moveItineraryDay(this, 1)" title="Move Day Down"><i class="fa-solid fa-arrow-down"></i></button>
                <button type="button" class="btn-itin-remove" onclick="removeItineraryDay(this)" title="Remove Day"><i class="fa-solid fa-trash-can"></i> Remove Day</button>
            </div>
        </div>
        <div class="form-grid gap-2 mt-3">
            <div class="form-group" style="max-width: 130px;">
                <label class="form-label required">Day #</label>
                <input type="number" name="itinerary[${nextIndex}][day_number]" class="form-control input-day-num" required min="1" value="${nextDayNum}" onchange="reindexItineraryDays()">
            </div>
            <div class="form-group col-span-2-flex">
                <label class="form-label required">Route / Day Title</label>
                <input type="text" name="itinerary[${nextIndex}][title]" class="form-control" required placeholder="e.g. Nuwara Eliya → Ella">
            </div>
        </div>
        <div class="form-group mt-3">
            <label class="form-label required">Day Description</label>
            <textarea name="itinerary[${nextIndex}][description]" class="form-control" rows="3" required placeholder="Provide day activities, sightseeing details, and travel notes..."></textarea>
        </div>
    `;

    wrapper.appendChild(card);
    reindexItineraryDays();
    const titleInput = card.querySelector('input[type="text"]');
    if (titleInput) titleInput.focus();
}

/**
 * Remove an itinerary day card
 */
function removeItineraryDay(buttonElement) {
    const card = buttonElement.closest('.itinerary-day-card');
    if (!card) return;

    const wrapper = card.parentElement;
    const count = wrapper.querySelectorAll('.itinerary-day-card').length;

    if (count > 1) {
        card.remove();
        reindexItineraryDays();
    } else {
        alert('A tour package must have at least 1 itinerary day.');
    }
}

/**
 * Move itinerary day up or down
 */
function moveItineraryDay(buttonElement, direction) {
    const card = buttonElement.closest('.itinerary-day-card');
    if (!card) return;

    if (direction === -1 && card.previousElementSibling) {
        card.parentElement.insertBefore(card, card.previousElementSibling);
    } else if (direction === 1 && card.nextElementSibling) {
        card.parentElement.insertBefore(card.nextElementSibling, card);
    }

    reindexItineraryDays();
}

/**
 * Reindex day numbers and input array keys sequentially
 */
function reindexItineraryDays() {
    const wrapper = document.getElementById('itineraryDaysWrapper');
    if (!wrapper) return;

    const cards = wrapper.querySelectorAll('.itinerary-day-card');
    cards.forEach((card, index) => {
        const dayNum = index + 1;
        
        // Update header badge display
        const badgeDisplay = card.querySelector('.day-num-display');
        if (badgeDisplay) badgeDisplay.textContent = dayNum.toString();

        // Update day number input if unchanged
        const numInput = card.querySelector('.input-day-num');
        if (numInput) {
            numInput.value = dayNum.toString();
            numInput.setAttribute('name', `itinerary[${index}][day_number]`);
        }

        // Update input names for form array serialization
        const titleInput = card.querySelector('input[type="text"]');
        if (titleInput) titleInput.setAttribute('name', `itinerary[${index}][title]`);

        const descArea = card.querySelector('textarea');
        if (descArea) descArea.setAttribute('name', `itinerary[${index}][description]`);
    });
}
