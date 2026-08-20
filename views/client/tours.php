<?php 
render_partial('header', [
    'page_title' => $page_title ?? 'Curated Sri Lanka Tours & Tailor-Made Packages | Mewa Tours'
]); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildGeneralInquiryMessage());
?>

<!-- =========================================================================
     02. TOURS HERO SECTION — SCENIC ELLA HIGHLANDS TRAIN
     ========================================================================= -->
<section class="tours-hero-section" id="toursHero">
    <div class="tours-hero-bg">
        <img src="<?= asset_url('images/tours/hero-tours-ella.jpg') ?>" alt="Scenic Sri Lanka Highland Train Journey" class="tours-hero-img">
        <div class="tours-hero-overlay"></div>
    </div>

    <div class="container tours-hero-container">
        <div class="tours-hero-content" data-reveal>
            <span class="tours-hero-eyebrow"><i class="fa-solid fa-route"></i> CURATED JOURNEYS ACROSS SRI LANKA</span>
            <h1 class="tours-hero-title">Explore Sri Lanka,<br>One Journey at a Time.</h1>
            <p class="tours-hero-description">
                From ancient cities and mist-covered mountains to wildlife-filled national parks and tropical coastlines, discover thoughtfully created journeys across Sri Lanka.
            </p>

            <div class="tours-hero-actions">
                <a href="#toursCollection" class="btn btn-hero-primary">
                    Explore Tours <i class="fa-solid fa-arrow-down"></i>
                </a>
                <a href="<?= base_url('contact') ?>" class="btn btn-hero-secondary">
                    Plan a Custom Journey
                </a>
            </div>

            <div class="tours-location-tag">
                <i class="fa-solid fa-location-dot"></i> Ella Highlands, Sri Lanka
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     03. SECTION 2 — EDITORIAL INTRO
     ========================================================================= -->
<section class="section-padding tours-intro-section">
    <div class="container text-center" data-reveal>
        <span class="section-eyebrow">FIND YOUR JOURNEY</span>
        <h2 class="section-title">Sri Lanka, Your Way.</h2>
        <p class="tours-intro-lead">
            Every traveller experiences Sri Lanka differently. Whether you're drawn to ancient culture, wildlife, mountains, beaches or slow scenic journeys, Mewa Tours can help you discover the island in a way that feels right for you.
        </p>
    </div>
</section>


<!-- =========================================================================
     04. SECTION 3 & 5 — CATEGORY FILTERS & MAIN TOURS COLLECTION
     ========================================================================= -->
<section class="section-padding tours-collection-section bg-light" id="toursCollection">
    <div class="container">
        
        <!-- Category Filter Tabs -->
        <div class="tours-filter-wrapper" data-reveal>
            <div class="tours-filter-tabs" id="toursFilterTabs" role="tablist">
                <button type="button" class="filter-tab active" data-filter="all" role="tab" aria-selected="true">All Journeys</button>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <button type="button" class="filter-tab" data-filter="<?= e($cat['slug']) ?>" role="tab" aria-selected="false"><?= e($cat['name']) ?></button>
                    <?php endforeach; ?>
                <?php else: ?>
                    <button type="button" class="filter-tab" data-filter="heritage-culture" role="tab" aria-selected="false">Heritage &amp; Culture</button>
                    <button type="button" class="filter-tab" data-filter="wildlife-nature" role="tab" aria-selected="false">Wildlife &amp; Nature</button>
                    <button type="button" class="filter-tab" data-filter="hill-country" role="tab" aria-selected="false">Hill Country</button>
                    <button type="button" class="filter-tab" data-filter="coastal-beach" role="tab" aria-selected="false">Coastal &amp; Beach</button>
                    <button type="button" class="filter-tab" data-filter="adventure" role="tab" aria-selected="false">Adventure</button>
                    <button type="button" class="filter-tab" data-filter="romantic" role="tab" aria-selected="false">Romantic</button>
                <?php endif; ?>
            </div>
            <div class="tours-count-badge" id="toursCountBadge">
                Showing <strong id="visibleToursCount"><?= count($tours) ?></strong> Journeys
            </div>
        </div>

        <!-- =====================================================================
             05. FEATURED SIGNATURE TOUR HIGHLIGHT (EDITORIAL SPLIT)
             ===================================================================== -->
        <?php if (!empty($featured_tour)): ?>
            <div class="featured-tour-card" data-reveal>
                <div class="featured-tour-grid">
                    <div class="featured-tour-media">
                        <img src="<?= asset_url('images/' . e($featured_tour['featured_image'])) ?>" alt="<?= e($featured_tour['title']) ?>" class="featured-tour-img" onerror="this.src='<?= asset_url('images/home/hero-dalada-maligawa.jpg') ?>'">
                        <span class="featured-ribbon"><i class="fa-solid fa-star"></i> Signature Journey</span>
                    </div>
                    <div class="featured-tour-content">
                        <span class="featured-cat-tag"><?= e($featured_tour['category_name'] ?? 'Signature Tour') ?></span>
                        <h2 class="featured-tour-title"><?= e($featured_tour['title']) ?></h2>
                        <div class="featured-meta">
                            <span class="meta-duration-badge"><i class="fa-solid fa-clock"></i> <?= e($featured_tour['formatted_duration']) ?></span>
                            <span class="meta-location-pin"><i class="fa-solid fa-location-dot"></i> <?= e($featured_tour['locations']) ?></span>
                        </div>
                        <p class="featured-tour-desc">
                            <?= e($featured_tour['description'] ?? $featured_tour['short_description'] ?? '') ?>
                        </p>
                        
                        <!-- Highlights -->
                        <div class="featured-highlights-grid">
                            <div class="highlight-pill"><i class="fa-solid fa-landmark"></i> Ancient UNESCO Heritage</div>
                            <div class="highlight-pill"><i class="fa-solid fa-train"></i> Scenic Highland Railway</div>
                            <div class="highlight-pill"><i class="fa-solid fa-paw"></i> Yala Leopard Safari</div>
                            <div class="highlight-pill"><i class="fa-solid fa-umbrella-beach"></i> Colonial Galle Fort</div>
                        </div>

                        <div class="featured-tour-actions">
                            <a href="<?= base_url('tours/' . e($featured_tour['slug'])) ?>" class="btn btn-primary">
                                View Signature Journey <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <a href="<?= e($featured_tour['whatsapp_url'] ?? $generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp-card">
                                <i class="fa-brands fa-whatsapp"></i> Inquire via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- =====================================================================
             06. MAIN TOURS GRID COLLECTION
             ===================================================================== -->
        <div class="section-header text-center" style="margin-top: 60px;" data-reveal>
            <span class="section-eyebrow">DISCOVER OUR TOURS</span>
            <h2 class="section-title">Journeys for Every Traveller</h2>
            <p class="section-subtitle">Explore a collection of Sri Lankan journeys designed around different interests, travel styles and experiences.</p>
        </div>

        <div class="main-tours-grid" id="mainToursGrid">
            <?php if (!empty($tours)): ?>
                <?php foreach ($tours as $tour): 
                    // Skip if featured tour is rendered above separately, or show all
                    $catCategorySlug = generate_slug($tour['category_name'] ?? 'general');
                ?>
                    <article class="tour-collection-card" data-category="<?= e($catCategorySlug) ?>" data-reveal>
                        <div class="tour-card-image-wrap">
                            <?php 
                                $imgSrc = (strpos($tour['featured_image'], 'http') === 0) 
                                    ? $tour['featured_image'] 
                                    : asset_url('images/' . e($tour['featured_image']));
                            ?>
                            <img src="<?= e($imgSrc) ?>" alt="<?= e($tour['title']) ?>" class="tour-card-img" onerror="this.src='https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80'">
                            <span class="card-duration-tag"><i class="fa-solid fa-clock"></i> <?= e($tour['formatted_duration']) ?></span>
                        </div>

                        <div class="tour-card-body">
                            <span class="card-cat-label"><?= e($tour['category_name'] ?? 'Tour Package') ?></span>
                            <h3 class="card-tour-title"><?= e($tour['title']) ?></h3>
                            <p class="card-locations"><i class="fa-solid fa-location-dot"></i> <?= e($tour['locations'] ?? 'Sri Lanka') ?></p>
                            <p class="card-tour-desc"><?= e($tour['short_description'] ?? '') ?></p>
                            
                            <div class="card-action-bar">
                                <a href="<?= base_url('tours/' . e($tour['slug'])) ?>" class="link-view-journey">
                                    View Journey <i class="fa-solid fa-arrow-right"></i>
                                </a>
                                <a href="<?= e($tour['whatsapp_url'] ?? $generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="link-wa-icon" title="Inquire via WhatsApp">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Empty Filter State Container -->
        <div class="empty-filter-state" id="emptyFilterState" style="display: none;">
            <div class="empty-state-icon"><i class="fa-solid fa-compass"></i></div>
            <h3>No Journeys Found in This Category</h3>
            <p>Explore another travel style above or contact our Sri Lankan experts to design a custom itinerary just for you.</p>
            <div class="empty-state-actions">
                <button type="button" class="btn btn-primary" id="resetFilterBtn">View All Tours</button>
                <a href="<?= base_url('contact') ?>" class="btn btn-outline">Plan a Custom Journey</a>
            </div>
        </div>

    </div>
</section>


<!-- =========================================================================
     07. SECTION 7 — CUSTOM JOURNEY CTA BANNER
     ========================================================================= -->
<section class="custom-cta-section">
    <div class="custom-cta-bg">
        <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Sri Lanka Custom Travel" class="custom-cta-img">
        <div class="custom-cta-overlay"></div>
    </div>

    <div class="container custom-cta-container text-center" data-reveal>
        <span class="custom-cta-eyebrow">CAN'T FIND THE PERFECT JOURNEY?</span>
        <h2 class="custom-cta-title">Let's Create One Around You.</h2>
        <p class="custom-cta-text">
            Tell us where you want to go, what you love doing and how long you have. Mewa Tours can help shape a personalised Sri Lankan journey around you.
        </p>

        <div class="custom-cta-buttons">
            <a href="<?= base_url('contact') ?>" class="btn btn-cta-white">
                Create My Journey <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-cta-whatsapp">
                <i class="fa-brands fa-whatsapp"></i> WhatsApp Us
            </a>
        </div>
    </div>
</section>


<!-- =========================================================================
     08. SECTION 8 — WHY TRAVEL WITH MEWA TOURS
     ========================================================================= -->
<section class="section-padding why-tours-section">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">THE MEWA DIFFERENCE</span>
            <h2 class="section-title">Why Travel With Mewa Tours?</h2>
            <p class="section-subtitle">Dedicated local care, authentic island insights, and personal service on every tour.</p>
        </div>

        <div class="why-tours-grid">
            <div class="why-tour-item" data-reveal>
                <div class="why-icon-badge"><i class="fa-solid fa-map"></i></div>
                <h3>Local Knowledge</h3>
                <p>Travel with guidance shaped by genuine, deep-rooted local knowledge of Sri Lanka's culture and secret spots.</p>
            </div>

            <div class="why-tour-item" data-reveal>
                <div class="why-icon-badge"><i class="fa-solid fa-pen-ruler"></i></div>
                <h3>Personalised Planning</h3>
                <p>Journeys can be adjusted around your exact travel dates, pace, hotel choices, and personal interests.</p>
            </div>

            <div class="why-tour-item" data-reveal>
                <div class="why-icon-badge"><i class="fa-solid fa-arrows-spin"></i></div>
                <h3>Flexible Journeys</h3>
                <p>Use our published tours as inspiration and seamlessly customize the itinerary to fit your schedule.</p>
            </div>

            <div class="why-tour-item" data-reveal>
                <div class="why-icon-badge"><i class="fa-solid fa-comments"></i></div>
                <h3>Friendly Support</h3>
                <p>Speak directly with our local Sri Lankan travel specialists before, during, and after your trip.</p>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     09. SECTION 9 — TRAVEL INSPIRATION STRIP
     ========================================================================= -->
<section class="section-padding inspiration-section bg-light">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">ISLAND DISCOVERY</span>
            <h2 class="section-title">A Journey Through Every Side of Sri Lanka</h2>
            <p class="section-subtitle">Ancient heritage, highlands, national park wildlife, and golden coasts in one island.</p>
        </div>

        <div class="inspiration-grid" data-reveal>
            <div class="inspiration-card">
                <img src="<?= asset_url('images/home/sigiriya-fortress.jpg') ?>" alt="Ancient Heritage Sigiriya">
                <div class="inspiration-label">Culture &amp; Heritage</div>
            </div>
            <div class="inspiration-card">
                <img src="https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=600&q=80" alt="Wildlife Safaris Yala">
                <div class="inspiration-label">Wild Safaris</div>
            </div>
            <div class="inspiration-card">
                <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Tea Country Railways Ella">
                <div class="inspiration-label">Misty Highlands</div>
            </div>
            <div class="inspiration-card">
                <img src="https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=600&q=80" alt="Southern Golden Coasts Mirissa">
                <div class="inspiration-label">Tropical Beaches</div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     10. SECTION 10 — FINAL INQUIRY CONVERSION CTA
     ========================================================================= -->
<section class="final-cta-section">
    <div class="container text-center" data-reveal>
        <h2 class="final-cta-title">Ready to Find Your Sri Lankan Journey?</h2>
        <p class="final-cta-text">
            Explore our tours or speak with Mewa Tours to create an itinerary designed around you.
        </p>
        <div class="final-cta-buttons">
            <a href="<?= base_url('contact') ?>" class="btn btn-final-primary">
                Plan Your Trip <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-final-whatsapp">
                <i class="fa-brands fa-whatsapp"></i> WhatsApp Us
            </a>
        </div>
    </div>
</section>

<!-- Include Tours Page Specific JS -->
<script src="<?= asset_url('js/tours.js') ?>"></script>

<?php render_partial('footer'); ?>
