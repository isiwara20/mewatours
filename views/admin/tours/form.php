<?php 
render_partial('admin-header', ['page_title' => $page_title ?? 'Manage Tour Package']); 
$isEdit = ($action === 'edit' && !empty($tour));
$formTitle = $isEdit ? 'Edit Tour Package' : 'Add New Tour Package';
$formAction = $isEdit ? base_url('admin/tours/edit/' . $tour['id']) : base_url('admin/tours/create');
?>

<div class="admin-page-header">
    <div class="header-content">
        <h2><i class="fa-solid fa-route"></i> <?= e($formTitle) ?></h2>
        <p class="text-muted"><?= $isEdit ? 'Update details, travel route, day-by-day itinerary, inclusions, and highlights for this tour.' : 'Fill in the information below to add a new tour package to Mewa Tours.' ?></p>
    </div>
    <div class="header-actions">
        <a href="<?= base_url('admin/tours') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to Tours
        </a>
    </div>
</div>

<form action="<?= e($formAction) ?>" method="POST" enctype="multipart/form-data" class="admin-form-container">
    <?= CsrfService::inputField() ?>
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= (int)$tour['id'] ?>">
    <?php endif; ?>

    <!-- 01. BASIC INFORMATION -->
    <div class="admin-card form-section-card">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-circle-info"></i> 01 Basic Information</h3>
            <p>Set primary identity, category classification, and display ordering.</p>
        </div>
        <div class="form-grid gap-2">
            <div class="form-group col-span-2">
                <label for="title" class="form-label required">Tour Title</label>
                <input type="text" id="title" name="title" class="form-control" required placeholder="e.g. Sri Lanka Cultural & Beach Escape" value="<?= old('title', $tour['title'] ?? '') ?>">
                <small class="form-hint">A clear, inviting name for this travel package.</small>
            </div>

            <!-- Tour Category Selection Group -->
            <div class="form-group col-span-2">
                <label class="form-label required"><i class="fa-solid fa-tags" style="color: var(--brand-blue);"></i> Tour Category Selection</label>
                <p class="form-hint" style="margin-bottom: 8px;">Click a category badge below or choose from the dropdown menu:</p>
                <div class="category-pills-selector" id="categoryPillsWrapper" style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 10px;">
                    <?php if (!empty($categories)): ?>
                        <?php 
                            $currentCatId = old('category_id', $tour['category_id'] ?? '');
                        ?>
                        <?php foreach ($categories as $cat): ?>
                            <?php $isSelected = ((string)$currentCatId === (string)$cat['id']); ?>
                            <button type="button" 
                                    class="category-pill-btn <?= $isSelected ? 'active' : '' ?>" 
                                    data-cat-id="<?= $cat['id'] ?>"
                                    onclick="selectCategoryPill(this, <?= $cat['id'] ?>)"
                                    style="padding: 8px 16px; border-radius: 30px; border: 1px solid <?= $isSelected ? '#004080' : '#cbd5e1' ?>; background: <?= $isSelected ? '#004080' : '#f8fafc' ?>; color: <?= $isSelected ? '#ffffff' : '#334155' ?>; font-weight: 600; font-size: 0.88rem; cursor: pointer; transition: all 0.2s ease;">
                                <i class="fa-solid fa-tag" style="margin-right: 5px;"></i> <?= e($cat['name']) ?>
                            </button>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">-- Select Tour Category --</option>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <?php 
                                $selectedCatId = old('category_id', $tour['category_id'] ?? '');
                                $selected = ((string)$selectedCatId === (string)$cat['id']) ? 'selected' : ''; 
                            ?>
                            <option value="<?= $cat['id'] ?>" <?= $selected ?>><?= e($cat['name']) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <small class="form-hint">Categorizes package under public filter tabs (e.g. Heritage &amp; Culture, Wildlife &amp; Nature, Hill Country, Coastal &amp; Beach).</small>
            </div>

            <input type="hidden" id="slug" name="slug" value="<?= old('slug', $tour['slug'] ?? '') ?>">

            <div class="form-group">
                <label for="display_order" class="form-label">Display Order</label>
                <input type="number" id="display_order" name="display_order" class="form-control" value="<?= old('display_order', (string)($tour['display_order'] ?? 0)) ?>" min="0">
                <small class="form-hint">Lower numbers appear first on public listing.</small>
            </div>
        </div>
    </div>

    <!-- 02. DURATION & TOUR STYLE -->
    <div class="admin-card form-section-card">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-clock"></i> 02 Duration &amp; Tour Style</h3>
            <p>Define trip length (days/nights) and flexible travel type classification.</p>
        </div>
        <div class="form-grid gap-3">
            <div class="form-group">
                <label for="duration_days" class="form-label required">Duration Days</label>
                <input type="number" id="duration_days" name="duration_days" class="form-control" required min="1" value="<?= old('duration_days', (string)($tour['duration_days'] ?? 7)) ?>">
                <small class="form-hint">Total number of days (e.g. 7).</small>
            </div>

            <div class="form-group">
                <label for="duration_nights" class="form-label">Duration Nights</label>
                <input type="number" id="duration_nights" name="duration_nights" class="form-control" min="0" value="<?= old('duration_nights', (string)($tour['duration_nights'] ?? 6)) ?>">
                <small class="form-hint">Number of nights. Set to 0 if not applicable.</small>
            </div>

            <div class="form-group">
                <label for="tour_type" class="form-label required">Tour Type</label>
                <input type="text" id="tour_type" name="tour_type" class="form-control" required placeholder="e.g. Cultural + Beach" value="<?= old('tour_type', $tour['tour_type'] ?? '') ?>">
                <small class="form-hint">Examples: Cultural + Beach, Wildlife + Adventure, Hill Country + Nature.</small>
            </div>
        </div>
    </div>

    <!-- 03. ROUTE & LOCATION SUMMARY -->
    <div class="admin-card form-section-card">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-map-location-dot"></i> 03 Travel Route &amp; Location Summary</h3>
            <p>Define travel sequence and location summary for quick information panels.</p>
        </div>
        <div class="form-group mb-4">
            <label for="route" class="form-label required">Travel Route</label>
            <textarea id="route" name="route" class="form-control" rows="3" required placeholder="Colombo → Sigiriya → Kandy → Nuwara Eliya → Ella → Yala → Galle → Colombo"><?= old('route', $tour['route'] ?? '') ?></textarea>
            <small class="form-hint"><i class="fa-solid fa-lightbulb"></i> Enter destinations in travel order. Use <strong>&rarr;</strong> between stops for clean display.</small>
        </div>

        <div class="form-group">
            <label for="location_summary" class="form-label">Location Summary (for Quick Info)</label>
            <input type="text" id="location_summary" name="location_summary" class="form-control" placeholder="e.g. Negombo / Sigiriya / Kandy / Nuwara Eliya / Ella / Bentota" value="<?= old('location_summary', $tour['location_summary'] ?? '') ?>">
            <small class="form-hint">Short slash-separated summary displayed on tour details quick info card.</small>
        </div>
    </div>

    <!-- 04. OVERVIEW -->
    <div class="admin-card form-section-card">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-align-left"></i> 04 Overview</h3>
            <p>Provide short summary for public cards and full overview for tour details page.</p>
        </div>

        <div class="form-group mb-4">
            <label for="short_description" class="form-label required">Short Description (for Listing Card)</label>
            <textarea id="short_description" name="short_description" class="form-control" rows="3" required placeholder="Write 1-3 sentences summarising who this tour is ideal for..."><?= old('short_description', $tour['short_description'] ?? '') ?></textarea>
            <small class="form-hint">Displayed on public tour cards (2–3 lines).</small>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Full Tour Overview</label>
            <textarea id="description" name="description" class="form-control" rows="5" placeholder="Discover the highlights of Sri Lanka on this carefully designed..."><?= old('description', $tour['description'] ?? '') ?></textarea>
            <small class="form-hint">Displayed on the main Tour Details overview section.</small>
        </div>
    </div>

    <!-- 05. DAY-BY-DAY ITINERARY -->
    <div class="admin-card form-section-card">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-calendar-days"></i> 05 Day-by-Day Itinerary</h3>
            <p>Add detailed day-by-day travel route titles and descriptions for visitors.</p>
        </div>

        <div id="itineraryDaysWrapper" class="itinerary-days-container">
            <?php 
                $existingItinerary = !empty($tour['itinerary']) ? $tour['itinerary'] : [];
                if (empty($existingItinerary) && !$isEdit) {
                    $existingItinerary = [
                        ['day_number' => 1, 'title' => 'Airport → Negombo', 'description' => 'Arrive at Bandaranaike International Airport...'],
                        ['day_number' => 2, 'title' => 'Negombo → Sigiriya', 'description' => 'Travel to Sigiriya and visit the magnificent UNESCO World Heritage-listed Sigiriya Rock Fortress...']
                    ];
                }
                foreach ($existingItinerary as $i => $dayItem):
            ?>
                <div class="itinerary-day-card">
                    <div class="itinerary-card-header">
                        <span class="day-badge-header">DAY <span class="day-num-display"><?= (int)($dayItem['day_number'] ?? ($i + 1)) ?></span></span>
                        <div class="itinerary-card-actions">
                            <button type="button" class="btn-itin-move" onclick="moveItineraryDay(this, -1)" title="Move Day Up"><i class="fa-solid fa-arrow-up"></i></button>
                            <button type="button" class="btn-itin-move" onclick="moveItineraryDay(this, 1)" title="Move Day Down"><i class="fa-solid fa-arrow-down"></i></button>
                            <button type="button" class="btn-itin-remove" onclick="removeItineraryDay(this)" title="Remove Day"><i class="fa-solid fa-trash-can"></i> Remove Day</button>
                        </div>
                    </div>
                    <div class="form-grid gap-2 mt-3">
                        <div class="form-group" style="max-width: 130px;">
                            <label class="form-label required">Day #</label>
                            <input type="number" name="itinerary[<?= $i ?>][day_number]" class="form-control input-day-num" required min="1" value="<?= (int)($dayItem['day_number'] ?? ($i + 1)) ?>" onchange="reindexItineraryDays()">
                        </div>
                        <div class="form-group col-span-2-flex">
                            <label class="form-label required">Route / Day Title</label>
                            <input type="text" name="itinerary[<?= $i ?>][title]" class="form-control" required placeholder="e.g. Airport → Negombo" value="<?= e($dayItem['title'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label required">Day Description</label>
                        <textarea name="itinerary[<?= $i ?>][description]" class="form-control" rows="3" required placeholder="Provide day activities, sightseeing details, and travel notes..."><?= e($dayItem['description'] ?? '') ?></textarea>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="dynamic-add-action">
            <button type="button" class="btn btn-admin-outline" id="addItineraryDayBtn">
                <i class="fa-solid fa-plus-circle"></i> Add Another Day
            </button>
        </div>
    </div>

    <!-- 06. INCLUSIONS -->
    <div class="admin-card form-section-card">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-circle-check"></i> 06 What's Included</h3>
            <p>Add key items included in this tour package (e.g. Private chauffeur, Airport transfers, Fuel, Taxes).</p>
        </div>
        
        <div id="inclusionsList" class="dynamic-inputs-wrapper">
            <?php 
                $existingInclusions = !empty($tour['inclusions']) ? array_column($tour['inclusions'], 'inclusion') : ['Private English-speaking chauffeur', 'Airport pickup & drop-off', 'Private air-conditioned vehicle', 'Fuel charges & government taxes'];
                foreach ($existingInclusions as $idx => $incVal):
            ?>
                <div class="dynamic-input-row">
                    <div class="input-drag-handle"><i class="fa-solid fa-bars"></i></div>
                    <input type="text" name="inclusions[]" class="form-control" placeholder="e.g. Private air-conditioned vehicle" value="<?= e($incVal) ?>">
                    <button type="button" class="btn-remove-row" onclick="removeDynamicRow(this)" title="Remove Inclusion">
                        <i class="fa-solid fa-minus-circle"></i> Remove
                    </button>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="dynamic-add-action">
            <button type="button" class="btn btn-admin-outline" id="addInclusionBtn">
                <i class="fa-solid fa-plus-circle"></i> Add Inclusion
            </button>
        </div>
    </div>

    <!-- 07. HIGHLIGHTS -->
    <div class="admin-card form-section-card">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-star"></i> 07 Tour Highlights</h3>
            <p>Add key attractions, cities, or safari experiences included in this journey.</p>
        </div>

        <div id="highlightsList" class="dynamic-inputs-wrapper">
            <?php 
                $existingHighlights = !empty($tour['highlights']) ? array_column($tour['highlights'], 'highlight') : ['Sigiriya Rock Fortress', 'Dambulla Cave Temple', 'Temple of the Sacred Tooth Relic', 'Nine Arches Bridge', 'Bentota Beach'];
                foreach ($existingHighlights as $idx => $hlVal):
            ?>
                <div class="dynamic-input-row">
                    <div class="input-drag-handle"><i class="fa-solid fa-bars"></i></div>
                    <input type="text" name="highlights[]" class="form-control" placeholder="e.g. Sigiriya Rock Fortress" value="<?= e($hlVal) ?>">
                    <button type="button" class="btn-remove-row" onclick="removeDynamicRow(this)" title="Remove Highlight">
                        <i class="fa-solid fa-minus-circle"></i> Remove
                    </button>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="dynamic-add-action">
            <button type="button" class="btn btn-admin-outline" id="addHighlightBtn">
                <i class="fa-solid fa-plus-circle"></i> Add Highlight
            </button>
        </div>
    </div>

    <!-- 08. MEDIA -->
    <div class="admin-card form-section-card">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-image"></i> 08 Featured Media</h3>
            <p>Upload a high-resolution cover image for public tour cards and hero headers.</p>
        </div>

        <div class="form-group">
            <label for="featured_image" class="form-label">Featured Tour Image</label>
            <input type="file" id="featured_image" name="featured_image" class="form-control" accept="image/jpeg,image/png,image/webp">
            <small class="form-hint">Allowed formats: JPG, PNG, WebP (Max 5MB). Recommended ratio: 16:10 or 4:3.</small>

            <?php if ($isEdit && !empty($tour['featured_image'])): ?>
                <div class="current-media-preview mt-3">
                    <span class="d-block text-muted mb-2">Current Featured Image:</span>
                    <?php 
                        $imgSrc = (strpos($tour['featured_image'], 'http') === 0) ? $tour['featured_image'] : asset_url('images/' . e($tour['featured_image']));
                    ?>
                    <img src="<?= e($imgSrc) ?>" alt="Current Tour Image" class="form-preview-img">
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- 09. BOOKING AVAILABILITY -->
    <div class="admin-card form-section-card">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-calendar-check"></i> 09 Booking Availability</h3>
            <p>Set public booking status (Available to Book / Available on Request / Unavailable).</p>
        </div>

        <div class="form-group" style="max-width: 400px;">
            <label for="booking_status" class="form-label required">Booking Status</label>
            <select id="booking_status" name="booking_status" class="form-select" required>
                <option value="AVAILABLE" <?= ($isEdit && ($tour['booking_status'] ?? '') === 'AVAILABLE') ? 'selected' : '' ?>>AVAILABLE (Available to Book)</option>
                <option value="ON_REQUEST" <?= ($isEdit && ($tour['booking_status'] ?? '') === 'ON_REQUEST') ? 'selected' : '' ?>>ON_REQUEST (Available on Request)</option>
                <option value="UNAVAILABLE" <?= ($isEdit && ($tour['booking_status'] ?? '') === 'UNAVAILABLE') ? 'selected' : '' ?>>UNAVAILABLE (Currently Unavailable)</option>
            </select>
            <small class="form-hint">Controls the public booking button behavior and badge text on tour details.</small>
        </div>
    </div>

    <!-- 10. PUBLISHING -->
    <div class="admin-card form-section-card">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-sliders"></i> 10 Status &amp; Visibility</h3>
            <p>Control whether this tour package is published live or featured.</p>
        </div>

        <div class="form-grid gap-2">
            <div class="form-group">
                <label for="status" class="form-label required">Publication Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="ACTIVE" <?= ($isEdit && ($tour['status'] ?? '') === 'ACTIVE') ? 'selected' : '' ?>>ACTIVE (Published Live)</option>
                    <option value="INACTIVE" <?= ($isEdit && ($tour['status'] ?? '') === 'INACTIVE') ? 'selected' : '' ?>>INACTIVE (Draft / Hidden)</option>
                </select>
            </div>

            <div class="form-group flex-align-center">
                <label class="checkbox-container">
                    <input type="checkbox" name="is_featured" value="1" <?= (!empty($tour['is_featured'])) ? 'checked' : '' ?>>
                    <span class="checkmark"></span>
                    <span class="checkbox-label">Mark as Featured Signature Journey</span>
                </label>
            </div>
        </div>
    </div>

    <!-- FORM SUBMIT ACTIONS -->
    <div class="form-actions-bar">
        <button type="submit" class="btn btn-admin-primary btn-lg">
            <i class="fa-solid fa-floppy-disk"></i> <?= $isEdit ? 'Save Changes' : 'Publish Tour Package' ?>
        </button>
        <a href="<?= base_url('admin/tours') ?>" class="btn btn-admin-secondary btn-lg">Cancel</a>
    </div>
</form>

<script>
function selectCategoryPill(btn, catId) {
    const select = document.getElementById('category_id');
    if (select) {
        select.value = catId;
    }
    const wrapper = document.getElementById('categoryPillsWrapper');
    if (wrapper) {
        wrapper.querySelectorAll('.category-pill-btn').forEach(pill => {
            pill.classList.remove('active');
            pill.style.background = '#f8fafc';
            pill.style.color = '#334155';
            pill.style.borderColor = '#cbd5e1';
        });
    }
    btn.classList.add('active');
    btn.style.background = '#004080';
    btn.style.color = '#ffffff';
    btn.style.borderColor = '#004080';
}

document.getElementById('category_id')?.addEventListener('change', function() {
    const val = this.value;
    const wrapper = document.getElementById('categoryPillsWrapper');
    if (wrapper) {
        wrapper.querySelectorAll('.category-pill-btn').forEach(pill => {
            if (pill.getAttribute('data-cat-id') == val) {
                pill.classList.add('active');
                pill.style.background = '#004080';
                pill.style.color = '#ffffff';
                pill.style.borderColor = '#004080';
            } else {
                pill.classList.remove('active');
                pill.style.background = '#f8fafc';
                pill.style.color = '#334155';
                pill.style.borderColor = '#cbd5e1';
            }
        });
    }
});
</script>

<?php render_partial('admin-footer'); ?>
