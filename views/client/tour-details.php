<?php 
render_partial('header', [
    'page_title' => $tour['title'] . ' | Mewa Tours Sri Lanka'
]); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildGeneralInquiryMessage());

// Booking status display helper
$bookingStatusText = 'Available to Book';
$bookingStatusClass = 'status-available';
if (($tour['booking_status'] ?? '') === 'ON_REQUEST') {
    $bookingStatusText = 'Available on Request';
    $bookingStatusClass = 'status-on-request';
} elseif (($tour['booking_status'] ?? '') === 'UNAVAILABLE') {
    $bookingStatusText = 'Currently Unavailable';
    $bookingStatusClass = 'status-unavailable';
}

$heroImgSrc = !empty($tour['featured_image']) 
    ? ((strpos($tour['featured_image'], 'http') === 0) ? $tour['featured_image'] : asset_url('images/' . e($tour['featured_image'])))
    : asset_url('images/tours/hero-tours-ella.jpg');
?>

<!-- Custom Tour Details CSS -->
<link rel="stylesheet" href="<?= asset_url('css/tour-details.css') ?>">

<!-- =========================================================================
     01. HERO SECTION
     ========================================================================= -->
<section class="tour-details-hero">
    <div class="hero-bg-container">
        <img src="<?= e($heroImgSrc) ?>" alt="<?= e($tour['title']) ?>" class="hero-bg-img" onerror="this.src='https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=1600&q=80'">
        <div class="hero-overlay"></div>
    </div>

    <div class="container hero-container">
        <!-- Breadcrumb Navigation -->
        <nav class="details-breadcrumb" aria-label="Breadcrumb">
            <ol>
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li><a href="<?= base_url('tours') ?>">Tours</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li class="active"><?= e($tour['title']) ?></li>
            </ol>
        </nav>

        <div class="hero-content" data-reveal>
            <div class="hero-tags">
                <span class="hero-cat-tag"><i class="fa-solid fa-route"></i> <?= e($tour['category_name'] ?? 'Curated Journey') ?></span>
                <?php if (!empty($tour['tour_type'])): ?>
                    <span class="hero-type-tag"><?= e(strtoupper($tour['tour_type'])) ?></span>
                <?php endif; ?>
            </div>

            <h1 class="hero-title"><?= e($tour['title']) ?></h1>

            <div class="hero-meta-bar">
                <span class="hero-meta-badge"><i class="fa-solid fa-clock"></i> <?= e($tour['formatted_duration']) ?></span>
                <?php if (!empty($tour['route'])): ?>
                    <span class="hero-meta-route"><i class="fa-solid fa-location-dot"></i> <?= e($tour['route']) ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     02. QUICK INFORMATION PANEL
     ========================================================================= -->
<section class="quick-info-section bg-light">
    <div class="container">
        <div class="quick-info-panel" data-reveal>
            <div class="info-item">
                <span class="info-label">BOOKING STATUS</span>
                <span class="info-value <?= $bookingStatusClass ?>">
                    <i class="fa-solid fa-circle"></i> <?= e($bookingStatusText) ?>
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">DURATION</span>
                <span class="info-value">
                    <i class="fa-solid fa-calendar-days"></i> <?= e($tour['formatted_duration']) ?>
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">TOUR STYLE</span>
                <span class="info-value">
                    <i class="fa-solid fa-compass"></i> <?= e($tour['tour_type'] ?? 'Tailor-Made Journey') ?>
                </span>
            </div>

            <div class="info-item info-item-wide">
                <span class="info-label">LOCATION</span>
                <span class="info-value">
                    <i class="fa-solid fa-map-pin"></i> <?= e($tour['location_summary'] ?? $tour['locations'] ?? $tour['route'] ?? 'Sri Lanka') ?>
                </span>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     03. TOUR OVERVIEW SECTION
     ========================================================================= -->
<section class="section-padding overview-section">
    <div class="container text-center" data-reveal>
        <span class="section-eyebrow">TOUR OVERVIEW</span>
        <h2 class="section-title">Discover the Journey</h2>
        <div class="overview-body-content">
            <?= nl2br(e($tour['description'] ?? $tour['short_description'] ?? '')) ?>
        </div>
    </div>
</section>


<!-- =========================================================================
     04. DAY-BY-DAY ITINERARY SECTION (VERTICAL TIMELINE)
     ========================================================================= -->
<?php if (!empty($tour['itinerary'])): ?>
<section class="section-padding itinerary-section bg-light" id="itinerary">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">DAY-BY-DAY ITINERARY</span>
            <h2 class="section-title">Carefully Planned for Every Day</h2>
            <p class="section-subtitle">Thoughtfully curated experiences for every stage of your Sri Lankan journey.</p>
        </div>

        <div class="timeline-wrapper">
            <?php foreach ($tour['itinerary'] as $index => $day): ?>
                <div class="timeline-item" data-reveal>
                    <div class="timeline-marker">
                        <span class="timeline-day-badge">DAY <?= (int)$day['day_number'] ?></span>
                    </div>

                    <div class="timeline-card">
                        <div class="timeline-card-header">
                            <span class="timeline-day-sub">DAY <?= (int)$day['day_number'] ?></span>
                            <h3 class="timeline-title"><?= e($day['title']) ?></h3>
                        </div>
                        <div class="timeline-card-body">
                            <p><?= nl2br(e($day['description'])) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- =========================================================================
     05. WHAT'S INCLUDED SECTION
     ========================================================================= -->
<?php if (!empty($tour['inclusions'])): ?>
<section class="section-padding inclusions-section">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">WHAT'S INCLUDED</span>
            <h2 class="section-title">Travel With Everything Taken Care Of</h2>
            <p class="section-subtitle">Dedicated private transportation, local expertise, and seamless care throughout your trip.</p>
        </div>

        <div class="inclusions-grid-container" data-reveal>
            <?php foreach ($tour['inclusions'] as $inc): 
                $incText = is_array($inc) ? ($inc['inclusion'] ?? '') : $inc;
            ?>
                <div class="inclusion-card-item">
                    <div class="inc-icon-box"><i class="fa-solid fa-check"></i></div>
                    <span class="inc-text-val"><?= e($incText) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- =========================================================================
     06. TOUR HIGHLIGHTS SECTION
     ========================================================================= -->
<?php if (!empty($tour['highlights'])): ?>
<section class="section-padding highlights-section bg-light">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">TOUR HIGHLIGHTS</span>
            <h2 class="section-title">Moments You Won't Want to Miss</h2>
            <p class="section-subtitle">Unforgettable landmarks, UNESCO heritage, and natural wonders included in this itinerary.</p>
        </div>

        <div class="highlights-grid-container" data-reveal>
            <?php foreach ($tour['highlights'] as $hl): 
                $hlText = is_array($hl) ? ($hl['highlight'] ?? '') : $hl;
            ?>
                <div class="highlight-chip-item">
                    <i class="fa-solid fa-location-dot hl-pin"></i>
                    <span><?= e($hlText) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- =========================================================================
     07. VISUAL JOURNEY PHOTO STRIP
     ========================================================================= -->
<section class="section-padding visual-strip-section">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">ISLAND SCENERY</span>
            <h2 class="section-title">Visual Moments of the Journey</h2>
            <p class="section-subtitle">A glimpse of the landscapes and historic landmarks awaiting you on this tour.</p>
        </div>

        <div class="visual-strip-grid" data-reveal>
            <div class="visual-photo-card">
                <img src="<?= asset_url('images/home/sigiriya-fortress.jpg') ?>" alt="Ancient Sigiriya Rock Fortress">
                <div class="visual-photo-caption">Sigiriya Fortress</div>
            </div>
            <div class="visual-photo-card">
                <img src="<?= asset_url('images/home/hero-dalada-maligawa.jpg') ?>" alt="Temple of the Sacred Tooth Relic Kandy">
                <div class="visual-photo-caption">Kandy Sacred Temple</div>
            </div>
            <div class="visual-photo-card">
                <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Nine Arch Bridge Scenic Train Ella">
                <div class="visual-photo-caption">Nine Arch Railway</div>
            </div>
            <div class="visual-photo-card">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" alt="Southern Golden Coasts Bentota">
                <div class="visual-photo-caption">Southern Coast</div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     08. BOOKING & INQUIRY CTA BANNER (WHATSAPP + EMAIL)
     ========================================================================= -->
<section class="booking-cta-section" id="bookNow">
    <div class="booking-cta-overlay"></div>
    <div class="container booking-cta-container text-center" data-reveal>
        <span class="cta-micro-eyebrow">READY TO EXPERIENCE THIS JOURNEY?</span>
        <h2 class="cta-title">Speak With Our Local Sri Lankan Experts</h2>
        <p class="cta-description">
            Speak directly with Mewa Tours to check availability, ask questions, or personalise this itinerary around your exact travel dates and preferences.
        </p>

        <?php if (($tour['booking_status'] ?? '') === 'UNAVAILABLE'): ?>
            <div class="status-notice-banner bg-warning">
                <i class="fa-solid fa-triangle-exclamation"></i> This tour is currently unavailable for instant booking. You can still inquire for future dates or customize a similar itinerary.
            </div>
        <?php endif; ?>

        <div class="cta-button-group">
            <?php if (($tour['booking_status'] ?? '') !== 'UNAVAILABLE'): ?>
                <a href="<?= e($tour['whatsapp_url'] ?? $generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-cta-whatsapp-lg">
                    <i class="fa-brands fa-whatsapp"></i> Book via WhatsApp
                </a>
            <?php endif; ?>

            <a href="<?= base_url('contact?tour=' . e($tour['slug'])) ?>" class="btn btn-cta-email-lg">
                <i class="fa-solid fa-envelope"></i> Book via Email
            </a>
        </div>

        <p class="cta-subnote">
            <i class="fa-solid fa-shield-halved"></i> Direct local booking &bull; No online credit card payment required &bull; Tailor-made flexibility
        </p>
    </div>
</section>


<!-- =========================================================================
     09. RELATED TOURS COLLECTION
     ========================================================================= -->
<?php if (!empty($tour['related_tours'])): ?>
<section class="section-padding related-tours-section bg-light">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">YOU MAY ALSO LIKE</span>
            <h2 class="section-title">Continue Exploring Sri Lanka</h2>
            <p class="section-subtitle">Discover other curated journeys designed around culture, wildlife, and tropical beaches.</p>
        </div>

        <div class="main-tours-grid">
            <?php foreach ($tour['related_tours'] as $relTour): 
                $relCategorySlug = generate_slug($relTour['category_name'] ?? 'general');
                $relImgSrc = !empty($relTour['featured_image']) 
                    ? ((strpos($relTour['featured_image'], 'http') === 0) ? $relTour['featured_image'] : asset_url('images/' . e($relTour['featured_image'])))
                    : asset_url('images/tours/hero-tours-ella.jpg');
            ?>
                <article class="tour-collection-card" data-category="<?= e($relCategorySlug) ?>" data-reveal>
                    <div class="tour-card-image-wrap">
                        <img src="<?= e($relImgSrc) ?>" alt="<?= e($relTour['title']) ?>" class="tour-card-img" onerror="this.src='https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80'">
                        
                        <div class="card-badges-top">
                            <span class="card-badge-duration"><i class="fa-solid fa-clock"></i> <?= e($relTour['formatted_duration']) ?></span>
                            <?php if (!empty($relTour['tour_type'])): ?>
                                <span class="card-badge-type"><?= e(strtoupper($relTour['tour_type'])) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="tour-card-body">
                        <span class="card-cat-label"><?= e($relTour['category_name'] ?? 'Tour Package') ?></span>
                        <h3 class="card-tour-title"><?= e($relTour['title']) ?></h3>

                        <?php if (!empty($relTour['route'])): ?>
                            <div class="card-route-box" title="<?= e($relTour['route']) ?>">
                                <i class="fa-solid fa-route route-icon"></i>
                                <span class="route-text"><?= e($relTour['route']) ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($relTour['short_description'])): ?>
                            <p class="card-tour-desc"><?= e($relTour['short_description']) ?></p>
                        <?php endif; ?>

                        <div class="card-action-bar">
                            <a href="<?= base_url('tours/' . e($relTour['slug'])) ?>" class="btn btn-card-primary">
                                View Journey <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <a href="<?= e($relTour['whatsapp_url'] ?? $generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-card-whatsapp" title="Inquire via WhatsApp">
                                <i class="fa-brands fa-whatsapp"></i> Enquire Now
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php render_partial('footer'); ?>
