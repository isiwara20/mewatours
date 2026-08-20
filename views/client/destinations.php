<?php 
render_partial('header', [
    'page_title' => $page_title ?? 'Unforgettable Sri Lanka Destinations & Places to Visit | Mewa Tours'
]); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildGeneralInquiryMessage());
?>

<!-- =========================================================================
     02. DESTINATIONS HERO SECTION — SIGIRIYA ROCK FORTRESS
     ========================================================================= -->
<section class="destinations-hero-section" id="destinationsHero">
    <div class="destinations-hero-bg">
        <img src="<?= asset_url('images/destinations/hero-destinations-sigiriya.jpg') ?>" alt="Sigiriya Rock Fortress Sri Lanka" class="destinations-hero-img">
        <div class="destinations-hero-overlay"></div>
    </div>

    <div class="container destinations-hero-container">
        <div class="destinations-hero-content" data-reveal>
            <span class="destinations-hero-eyebrow"><i class="fa-solid fa-compass"></i> DISCOVER SRI LANKA</span>
            <h1 class="destinations-hero-title">Extraordinary Places.<br>Unforgettable Stories.</h1>
            <p class="destinations-hero-description">
                From ancient cities and mist-covered mountains to wild national parks and tropical shores, discover the remarkable places that make Sri Lanka unforgettable.
            </p>

            <div class="destinations-hero-actions">
                <a href="#destinationsCollection" class="btn btn-hero-primary">
                    Explore Destinations <i class="fa-solid fa-arrow-down"></i>
                </a>
                <a href="<?= base_url('contact') ?>" class="btn btn-hero-secondary">
                    Plan My Journey
                </a>
            </div>

            <div class="destinations-location-tag">
                <i class="fa-solid fa-location-dot"></i> Sigiriya Rock Fortress, Sri Lanka
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     03. SECTION 2 — EDITORIAL INTRO
     ========================================================================= -->
<section class="section-padding destinations-intro-section">
    <div class="container text-center" data-reveal>
        <span class="section-eyebrow">ONE ISLAND. ENDLESS DISCOVERY.</span>
        <h2 class="section-title">Find Your Place in Sri Lanka.</h2>
        <p class="destinations-intro-lead">
            Sri Lanka may be a small island, but every region feels different. Travel from sacred cities and tea-covered mountains to wildlife-rich wilderness and palm-fringed beaches, each with its own story to tell.
        </p>
    </div>
</section>


<!-- =========================================================================
     04. SECTION 3 — REGION / CATEGORY DISCOVERY
     ========================================================================= -->
<section class="section-padding region-discovery-section bg-light">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">EXPLORE BY EXPERIENCE</span>
            <h2 class="section-title">Where Will Sri Lanka Take You?</h2>
            <p class="section-subtitle">Discover diverse travel regions across the island tailored to your passions.</p>
        </div>

        <div class="region-cards-grid">
            <div class="region-card" data-reveal>
                <div class="region-card-media">
                    <img src="<?= asset_url('images/home/sigiriya-fortress.jpg') ?>" alt="Cultural Triangle">
                    <span class="region-tag">Heritage</span>
                </div>
                <div class="region-card-body">
                    <h3>Cultural Triangle</h3>
                    <p>Ancient kingdoms, sacred cave temples and some of Sri Lanka's most iconic heritage landmarks.</p>
                </div>
            </div>

            <div class="region-card" data-reveal>
                <div class="region-card-media">
                    <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Hill Country">
                    <span class="region-tag">Mountains</span>
                </div>
                <div class="region-card-body">
                    <h3>Hill Country</h3>
                    <p>Tea-covered mountains, waterfalls, cool highland air and unforgettable scenic train journeys.</p>
                </div>
            </div>

            <div class="region-card" data-reveal>
                <div class="region-card-media">
                    <img src="https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=600&q=80" alt="Wildlife">
                    <span class="region-tag">Safaris</span>
                </div>
                <div class="region-card-body">
                    <h3>Wildlife &amp; Safaris</h3>
                    <p>Untamed scrub jungles filled with herds of wild elephants, leopards and extraordinary birdlife.</p>
                </div>
            </div>

            <div class="region-card" data-reveal>
                <div class="region-card-media">
                    <img src="https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=600&q=80" alt="Southern Coast">
                    <span class="region-tag">Coastline</span>
                </div>
                <div class="region-card-body">
                    <h3>Southern Coast</h3>
                    <p>Historic Dutch colonial coastal fortresses, golden palm beaches and relaxed ocean living.</p>
                </div>
            </div>

            <div class="region-card" data-reveal>
                <div class="region-card-media">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="East Coast">
                    <span class="region-tag">Adventure</span>
                </div>
                <div class="region-card-body">
                    <h3>East Coast</h3>
                    <p>Turquoise ocean waters, point-break surfing, quiet beaches and a different side of island life.</p>
                </div>
            </div>

            <div class="region-card" data-reveal>
                <div class="region-card-media">
                    <img src="<?= asset_url('images/home/hero-dalada-maligawa.jpg') ?>" alt="Ancient Cities">
                    <span class="region-tag">Ancient Cities</span>
                </div>
                <div class="region-card-body">
                    <h3>Ancient Cities</h3>
                    <p>Walk through centuries of sacred Buddhist history, colossal stupas and royal stone carvings.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     05. SECTION 4 — FEATURED DESTINATION SPOTLIGHT — ELLA
     ========================================================================= -->
<section class="section-padding featured-dest-section">
    <div class="container">
        <div class="featured-dest-card" data-reveal>
            <div class="featured-dest-grid">
                <div class="featured-dest-media">
                    <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Ella Hill Country Sri Lanka" class="featured-dest-img">
                    <span class="featured-dest-badge"><i class="fa-solid fa-star"></i> Featured Destination</span>
                </div>
                <div class="featured-dest-content">
                    <span class="featured-dest-eyebrow">HIGHLIGHT SPOTLIGHT</span>
                    <h2 class="featured-dest-title">Ella</h2>
                    <h3 class="featured-dest-subtitle">Mountains, Waterfalls &amp; Unforgettable Journeys.</h3>
                    <p class="featured-dest-desc">
                        Surrounded by emerald hills and tea estates, Ella is one of Sri Lanka's most memorable highland escapes. Hike to panoramic viewpoints, discover waterfalls and experience the legendary train journey through the central mountains.
                    </p>

                    <div class="featured-dest-highlights">
                        <div class="dest-highlight-item"><i class="fa-solid fa-train-subway"></i> Nine Arch Bridge</div>
                        <div class="dest-highlight-item"><i class="fa-solid fa-mountain"></i> Little Adam's Peak</div>
                        <div class="dest-highlight-item"><i class="fa-solid fa-leaf"></i> Tea Estates</div>
                        <div class="dest-highlight-item"><i class="fa-solid fa-route"></i> Scenic Railway</div>
                    </div>

                    <div class="featured-dest-actions">
                        <a href="<?= base_url('destinations/ella') ?>" class="btn btn-primary">
                            Explore Ella <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="<?= base_url('tours') ?>" class="btn btn-outline">
                            View Related Tours
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     06. SECTION 5 — MAIN DESTINATIONS COLLECTION & FILTERING
     ========================================================================= -->
<section class="section-padding main-destinations-section bg-light" id="destinationsCollection">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">PLACES TO DISCOVER</span>
            <h2 class="section-title">Explore the Best of Sri Lanka</h2>
            <p class="section-subtitle">Every destination offers a different perspective on Sri Lanka, from sacred heritage and misty mountains to wildlife and the Indian Ocean.</p>
        </div>

        <!-- Destination Filter Tabs -->
        <div class="dest-filter-wrapper" data-reveal>
            <div class="dest-filter-tabs" id="destFilterTabs" role="tablist">
                <button type="button" class="dest-filter-btn active" data-filter="all" role="tab" aria-selected="true">All Places</button>
                <button type="button" class="dest-filter-btn" data-filter="culture" role="tab" aria-selected="false">Culture</button>
                <button type="button" class="dest-filter-btn" data-filter="hill-country" role="tab" aria-selected="false">Hill Country</button>
                <button type="button" class="dest-filter-btn" data-filter="wildlife" role="tab" aria-selected="false">Wildlife</button>
                <button type="button" class="dest-filter-btn" data-filter="beaches" role="tab" aria-selected="false">Beaches</button>
                <button type="button" class="dest-filter-btn" data-filter="ancient-cities" role="tab" aria-selected="false">Ancient Cities</button>
            </div>
            <div class="dest-count-badge" id="destCountBadge">
                Showing <strong id="visibleDestCount"><?= count($destinations) ?></strong> Destinations
            </div>
        </div>

        <!-- Main Destinations Collection Grid -->
        <div class="destinations-collection-grid" id="mainDestGrid">
            <?php if (!empty($destinations)): ?>
                <?php foreach ($destinations as $dest): 
                    // Determine category filter slug tag
                    $slug = $dest['slug'];
                    $catTag = 'culture';
                    if (in_array($slug, ['ella', 'nuwara-eliya'], true)) $catTag = 'hill-country';
                    elseif (in_array($slug, ['yala'], true)) $catTag = 'wildlife';
                    elseif (in_array($slug, ['galle', 'mirissa', 'bentota', 'arugam-bay', 'trincomalee'], true)) $catTag = 'beaches';
                    elseif (in_array($slug, ['anuradhapura', 'polonnaruwa'], true)) $catTag = 'ancient-cities';
                ?>
                    <article class="dest-collection-card" data-category="<?= e($catTag) ?>" data-reveal>
                        <div class="dest-card-image-wrap">
                            <?php 
                                $imgSrc = (strpos($dest['featured_image'], 'http') === 0) 
                                    ? $dest['featured_image'] 
                                    : asset_url('images/' . e($dest['featured_image']));
                            ?>
                            <img src="<?= e($imgSrc) ?>" alt="<?= e($dest['name']) ?>" class="dest-card-img" onerror="this.src='https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80'">
                            <span class="dest-card-tag"><?= e($dest['short_description'] ?? 'Destination') ?></span>
                        </div>

                        <div class="dest-card-body">
                            <h3 class="dest-card-title"><?= e($dest['name']) ?></h3>
                            <p class="dest-card-desc"><?= e($dest['description'] ?? '') ?></p>

                            <div class="dest-card-action-bar">
                                <a href="<?= base_url('destinations/' . e($dest['slug'])) ?>" class="link-explore-dest">
                                    Explore Place <i class="fa-solid fa-arrow-right"></i>
                                </a>
                                <a href="<?= e($dest['whatsapp_url'] ?? $generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="link-wa-icon" title="Inquire about <?= e($dest['name']) ?>">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Empty Filter State Container -->
        <div class="empty-dest-filter-state" id="emptyDestFilterState" style="display: none;">
            <div class="empty-state-icon"><i class="fa-solid fa-map-location-dot"></i></div>
            <h3>No Destinations Found in This Category</h3>
            <p>Explore another region above or speak with Mewa Tours to craft a custom Sri Lankan route.</p>
            <div class="empty-state-actions">
                <button type="button" class="btn btn-primary" id="resetDestFilterBtn">View All Places</button>
                <a href="<?= base_url('contact') ?>" class="btn btn-outline">Plan My Journey</a>
            </div>
        </div>

    </div>
</section>


<!-- =========================================================================
     07. SECTION 6 — STORYTELLING BANNER
     ========================================================================= -->
<section class="story-banner-section">
    <div class="story-banner-bg">
        <img src="<?= asset_url('images/tours/hero-tours-ella.jpg') ?>" alt="Sri Lanka Scenic Discovery" class="story-banner-img">
        <div class="story-banner-overlay"></div>
    </div>

    <div class="container story-banner-container text-center" data-reveal>
        <span class="story-banner-eyebrow">FROM MOUNTAINS TO THE SEA</span>
        <h2 class="story-banner-title">One Island.<br>A Thousand Experiences.</h2>
        <p class="story-banner-text">
            Wake among misty tea plantations, spend the afternoon exploring an ancient city and end another day beside the Indian Ocean. Sri Lanka brings remarkable variety into every journey.
        </p>
        <a href="<?= base_url('tours') ?>" class="btn btn-cta-white">
            Explore Our Tours <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</section>


<!-- =========================================================================
     08. SECTION 7 — EXPERIENCE BY PLACE
     ========================================================================= -->
<section class="section-padding exp-by-place-section">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">FIND WHAT INSPIRES YOU</span>
            <h2 class="section-title">Choose the Experience.<br>We'll Help Find the Place.</h2>
            <p class="section-subtitle">Connect your favorite travel moments to the right Sri Lankan destinations.</p>
        </div>

        <div class="exp-by-place-grid">
            <div class="exp-place-card" data-reveal>
                <div class="exp-place-icon"><i class="fa-solid fa-landmark"></i></div>
                <h3>Culture</h3>
                <p class="exp-place-list">Kandy • Sigiriya • Anuradhapura</p>
                <p class="exp-place-desc">Ancient rock fortresses, sacred temples, and UNESCO heritage landmarks.</p>
            </div>

            <div class="exp-place-card" data-reveal>
                <div class="exp-place-icon"><i class="fa-solid fa-paw"></i></div>
                <h3>Wildlife</h3>
                <p class="exp-place-list">Yala • Udawalawe • Wilpattu</p>
                <p class="exp-place-desc">Wild leopards, elephant herds, and untouched national park wilderness.</p>
            </div>

            <div class="exp-place-card" data-reveal>
                <div class="exp-place-icon"><i class="fa-solid fa-mountain"></i></div>
                <h3>Mountains</h3>
                <p class="exp-place-list">Ella • Nuwara Eliya • Haputale</p>
                <p class="exp-place-desc">Misty highlands, emerald tea estates, and scenic mountain railways.</p>
            </div>

            <div class="exp-place-card" data-reveal>
                <div class="exp-place-icon"><i class="fa-solid fa-umbrella-beach"></i></div>
                <h3>Beaches</h3>
                <p class="exp-place-list">Mirissa • Bentota • Trincomalee</p>
                <p class="exp-place-desc">Golden palm coasts, ocean whale safaris, and tropical beach retreats.</p>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     09. SECTION 8 — CUSTOM TRAVEL CTA
     ========================================================================= -->
<section class="custom-dest-cta-section bg-light">
    <div class="container text-center" data-reveal>
        <span class="custom-dest-eyebrow">NOT SURE WHERE TO GO?</span>
        <h2 class="custom-dest-title">Tell Us What You Love.<br>We'll Find Your Sri Lanka.</h2>
        <p class="custom-dest-text">
            Whether you're dreaming of wildlife, beaches, culture or mountain scenery, tell us what inspires you and we'll help shape the right journey.
        </p>
        <div class="custom-dest-buttons">
            <a href="<?= base_url('contact') ?>" class="btn btn-primary">
                Plan My Journey <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp-card">
                <i class="fa-brands fa-whatsapp"></i> WhatsApp Us
            </a>
        </div>
    </div>
</section>


<!-- =========================================================================
     10. SECTION 9 — FINAL CONVERSION CTA
     ========================================================================= -->
<section class="final-cta-section">
    <div class="container text-center" data-reveal>
        <h2 class="final-cta-title">Ready to Discover Your Sri Lanka?</h2>
        <p class="final-cta-text">
            Explore our journeys or speak with Mewa Tours to create a personalised route through the places that inspire you most.
        </p>
        <div class="final-cta-buttons">
            <a href="<?= base_url('tours') ?>" class="btn btn-final-primary">
                Explore Tours <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="<?= base_url('contact') ?>" class="btn btn-outline" style="color: #ffffff; border-color: rgba(255,255,255,0.4);">
                Plan Your Trip
            </a>
        </div>
    </div>
</section>

<!-- Include Destinations Page Specific JS -->
<script src="<?= asset_url('js/destinations.js') ?>"></script>

<?php render_partial('footer'); ?>
