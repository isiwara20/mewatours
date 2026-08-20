<?php 
render_partial('header', [
    'page_title' => $page_title ?? 'Authentic Sri Lankan Travel Experiences & Activities | Mewa Tours'
]); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildGeneralInquiryMessage());
?>

<!-- =========================================================================
     02. EXPERIENCES HERO SECTION — WILDLIFE ELEPHANT SAFARI
     ========================================================================= -->
<section class="experiences-hero-section" id="experiencesHero">
    <div class="experiences-hero-bg">
        <img src="<?= asset_url('images/experiences/hero-experiences-safari.jpg') ?>" alt="Sri Lanka Wild Elephant Safari Experience" class="experiences-hero-img">
        <div class="experiences-hero-overlay"></div>
    </div>

    <div class="container experiences-hero-container">
        <div class="experiences-hero-content" data-reveal>
            <span class="experiences-hero-eyebrow"><i class="fa-solid fa-heart"></i> EXPERIENCE SRI LANKA</span>
            <h1 class="experiences-hero-title">More Than a Journey.<br>A Story to Live.</h1>
            <p class="experiences-hero-description">
                From walking through ancient temples and watching wild elephants to riding mountain trains and tasting local flavours, discover the moments that make Sri Lanka unforgettable.
            </p>

            <div class="experiences-hero-actions">
                <a href="#experiencesCollection" class="btn btn-hero-primary">
                    Explore Experiences <i class="fa-solid fa-arrow-down"></i>
                </a>
                <a href="<?= base_url('contact') ?>" class="btn btn-hero-secondary">
                    Plan My Journey
                </a>
            </div>

            <div class="experiences-location-tag">
                <i class="fa-solid fa-location-dot"></i> Udawalawe National Park, Sri Lanka
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     03. SECTION 2 — EDITORIAL INTRO
     ========================================================================= -->
<section class="section-padding experiences-intro-section">
    <div class="container text-center" data-reveal>
        <span class="section-eyebrow">THE HEART OF TRAVEL</span>
        <h2 class="section-title">It's the Moments You Remember.</h2>
        <p class="experiences-intro-lead">
            A journey through Sri Lanka is shaped by more than the places you visit. It is the sunrise above an ancient fortress, the sound of a train crossing the mountains, the taste of a home-cooked meal and the unforgettable sight of wildlife in its natural habitat.
        </p>
        <p class="experiences-intro-sublead">
            Mewa Tours helps you discover these experiences in a way that feels personal, natural and truly connected to the island.
        </p>
    </div>
</section>


<!-- =========================================================================
     04. SECTION 3 — EXPLORE EXPERIENCE CATEGORIES (MIXED GRID)
     ========================================================================= -->
<section class="section-padding exp-categories-section bg-light">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">FIND WHAT INSPIRES YOU</span>
            <h2 class="section-title">Experiences for Every Kind of Traveller</h2>
            <p class="section-subtitle">Whether you're looking for wildlife, culture, adventure or quiet moments by the ocean, Sri Lanka offers experiences for every travel style.</p>
        </div>

        <div class="exp-cat-masonry-grid">
            <!-- Wildlife (Large Card) -->
            <div class="exp-cat-card exp-cat-large" data-reveal>
                <img src="<?= asset_url('images/experiences/hero-experiences-safari.jpg') ?>" alt="Wildlife & Safaris">
                <div class="exp-cat-overlay"></div>
                <div class="exp-cat-content">
                    <span class="exp-cat-tag">SANCTUARIES</span>
                    <h3>Wildlife &amp; Safaris</h3>
                    <p>Encounter elephants, leopards, birds and extraordinary wilderness across Sri Lanka's national parks.</p>
                    <a href="#experiencesCollection" class="exp-cat-link">Explore Wildlife <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Culture & Heritage -->
            <div class="exp-cat-card" data-reveal>
                <img src="<?= asset_url('images/home/sigiriya-fortress.jpg') ?>" alt="Culture & Heritage">
                <div class="exp-cat-overlay"></div>
                <div class="exp-cat-content">
                    <span class="exp-cat-tag">HERITAGE</span>
                    <h3>Culture &amp; Heritage</h3>
                    <p>Discover ancient kingdoms, sacred temples and living traditions that tell the story of Sri Lanka.</p>
                    <a href="#experiencesCollection" class="exp-cat-link">Discover Culture <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Hill Country -->
            <div class="exp-cat-card" data-reveal>
                <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Hill Country">
                <div class="exp-cat-overlay"></div>
                <div class="exp-cat-content">
                    <span class="exp-cat-tag">HIGHLANDS</span>
                    <h3>Hill Country</h3>
                    <p>Ride scenic trains, walk through tea estates and discover cool green mountain landscapes.</p>
                    <a href="#experiencesCollection" class="exp-cat-link">Explore Highlands <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Tropical Beaches -->
            <div class="exp-cat-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" alt="Tropical Beaches">
                <div class="exp-cat-overlay"></div>
                <div class="exp-cat-content">
                    <span class="exp-cat-tag">COASTLINE</span>
                    <h3>Tropical Beaches</h3>
                    <p>Slow down beside warm tropical seas, golden beaches and relaxed coastal towns.</p>
                    <a href="#experiencesCollection" class="exp-cat-link">Find Your Beach <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Adventure -->
            <div class="exp-cat-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Adventure">
                <div class="exp-cat-overlay"></div>
                <div class="exp-cat-content">
                    <span class="exp-cat-tag">OUTDOORS</span>
                    <h3>Adventure</h3>
                    <p>Hike mountain trails, ride waves, explore rivers and experience Sri Lanka beyond the ordinary.</p>
                    <a href="#experiencesCollection" class="exp-cat-link">Find Adventure <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Food & Culinary -->
            <div class="exp-cat-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1596797038530-2c107229654b?auto=format&fit=crop&w=600&q=80" alt="Food & Culinary">
                <div class="exp-cat-overlay"></div>
                <div class="exp-cat-content">
                    <span class="exp-cat-tag">FLAVOURS</span>
                    <h3>Food &amp; Culinary</h3>
                    <p>Taste the island through local markets, traditional cooking and clay-pot spices.</p>
                    <a href="#experiencesCollection" class="exp-cat-link">Taste Sri Lanka <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Wellness & Relaxation -->
            <div class="exp-cat-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80" alt="Wellness & Relaxation">
                <div class="exp-cat-overlay"></div>
                <div class="exp-cat-content">
                    <span class="exp-cat-tag">AYURVEDA</span>
                    <h3>Wellness</h3>
                    <p>Slow the pace with peaceful retreats, traditional wellness and natural surroundings.</p>
                    <a href="#experiencesCollection" class="exp-cat-link">Discover Wellness <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Romantic Escapes -->
            <div class="exp-cat-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=600&q=80" alt="Romantic Escapes">
                <div class="exp-cat-overlay"></div>
                <div class="exp-cat-content">
                    <span class="exp-cat-tag">BOUTIQUE</span>
                    <h3>Romantic Escapes</h3>
                    <p>Share beautiful journeys through mountain landscapes, boutique stays and sunset oceans.</p>
                    <a href="#experiencesCollection" class="exp-cat-link">Explore Romance <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     05. SECTION 4 — FEATURED EXPERIENCE SPOTLIGHT — WALK AMONG GIANTS
     ========================================================================= -->
<section class="section-padding featured-exp-section">
    <div class="container">
        <div class="featured-exp-card" data-reveal>
            <div class="featured-exp-grid">
                <div class="featured-exp-media">
                    <img src="<?= asset_url('images/experiences/hero-experiences-safari.jpg') ?>" alt="Walk Among Giants Elephant Experience" class="featured-exp-img">
                    <span class="featured-exp-badge"><i class="fa-solid fa-star"></i> Signature Experience</span>
                </div>
                <div class="featured-exp-content">
                    <span class="featured-exp-eyebrow">SPOTLIGHT MOMENT</span>
                    <h2 class="featured-exp-title">Walk Among Giants</h2>
                    <h3 class="featured-exp-subtitle">A Wild Encounter You'll Never Forget.</h3>
                    <p class="featured-exp-desc">
                        Experience the thrill of seeing Sri Lankan elephants in their natural environment, surrounded by open landscapes, reservoir lakes and the remarkable atmosphere of the island's national parks.
                    </p>

                    <div class="featured-exp-highlights">
                        <div class="exp-highlight-item"><i class="fa-solid fa-paw"></i> Wildlife Encounters</div>
                        <div class="exp-highlight-item"><i class="fa-solid fa-tree"></i> National Park Landscapes</div>
                        <div class="exp-highlight-item"><i class="fa-solid fa-user-shield"></i> Local Naturalist Guidance</div>
                        <div class="exp-highlight-item"><i class="fa-solid fa-shield-heart"></i> Responsible Travel</div>
                    </div>

                    <div class="featured-exp-actions">
                        <a href="<?= base_url('contact') ?>" class="btn btn-primary">
                            Explore Wildlife Experiences <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp-card">
                            <i class="fa-brands fa-whatsapp"></i> Ask Mewa Tours
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     06. SECTION 5 — MAIN EXPERIENCES COLLECTION & FILTERING
     ========================================================================= -->
<section class="section-padding main-experiences-section bg-light" id="experiencesCollection">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">DISCOVER MORE</span>
            <h2 class="section-title">Moments Worth Travelling For</h2>
            <p class="section-subtitle">Build your journey around the experiences that matter most to you.</p>
        </div>

        <!-- Experience Filter Tabs -->
        <div class="exp-filter-wrapper" data-reveal>
            <div class="exp-filter-tabs" id="expFilterTabs" role="tablist">
                <button type="button" class="exp-filter-btn active" data-filter="all" role="tab" aria-selected="true">All Moments</button>
                <button type="button" class="exp-filter-btn" data-filter="wildlife" role="tab" aria-selected="false">Wildlife</button>
                <button type="button" class="exp-filter-btn" data-filter="culture" role="tab" aria-selected="false">Culture</button>
                <button type="button" class="exp-filter-btn" data-filter="nature" role="tab" aria-selected="false">Nature &amp; Hills</button>
                <button type="button" class="exp-filter-btn" data-filter="adventure" role="tab" aria-selected="false">Adventure</button>
                <button type="button" class="exp-filter-btn" data-filter="food" role="tab" aria-selected="false">Food</button>
                <button type="button" class="exp-filter-btn" data-filter="beaches" role="tab" aria-selected="false">Beaches</button>
            </div>
            <div class="exp-count-badge" id="expCountBadge">
                Showing <strong id="visibleExpCount"><?= count($experiences) ?></strong> Moments
            </div>
        </div>

        <!-- Main Experiences Grid -->
        <div class="experiences-collection-grid" id="mainExpGrid">
            <?php if (!empty($experiences)): ?>
                <?php foreach ($experiences as $exp): 
                    $slug = $exp['slug'];
                    $catTag = 'culture';
                    if (in_array($slug, ['walk-among-giants', 'safari-through-yala'], true)) $catTag = 'wildlife';
                    elseif (in_array($slug, ['ride-through-the-hill-country', 'walk-through-tea-country'], true)) $catTag = 'nature';
                    elseif (in_array($slug, ['surf-the-east-coast'], true)) $catTag = 'adventure';
                    elseif (in_array($slug, ['taste-a-sri-lankan-kitchen'], true)) $catTag = 'food';
                    elseif (in_array($slug, ['watch-the-sunset-in-mirissa'], true)) $catTag = 'beaches';
                ?>
                    <article class="exp-collection-card" data-category="<?= e($catTag) ?>" data-reveal>
                        <div class="exp-card-image-wrap">
                            <?php 
                                $imgSrc = (strpos($exp['featured_image'], 'http') === 0) 
                                    ? $exp['featured_image'] 
                                    : asset_url('images/' . e($exp['featured_image']));
                            ?>
                            <img src="<?= e($imgSrc) ?>" alt="<?= e($exp['name']) ?>" class="exp-card-img" onerror="this.src='https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80'">
                            <span class="exp-card-tag"><?= e($exp['category_name'] ?? 'Experience') ?></span>
                        </div>

                        <div class="exp-card-body">
                            <h3 class="exp-card-title"><?= e($exp['name']) ?></h3>
                            <p class="exp-card-desc"><?= e($exp['description'] ?? $exp['short_description'] ?? '') ?></p>

                            <div class="exp-card-action-bar">
                                <a href="<?= base_url('experiences/' . e($exp['slug'])) ?>" class="link-explore-exp">
                                    Explore Experience <i class="fa-solid fa-arrow-right"></i>
                                </a>
                                <a href="<?= e($exp['whatsapp_url'] ?? $generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="link-wa-icon" title="Inquire about <?= e($exp['name']) ?>">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Empty Filter State -->
        <div class="empty-exp-filter-state" id="emptyExpFilterState" style="display: none;">
            <div class="empty-state-icon"><i class="fa-solid fa-sparkles"></i></div>
            <h3>No Moments Found in This Category</h3>
            <p>Explore another experience type above or speak with Mewa Tours to curate a custom itinerary.</p>
            <div class="empty-state-actions">
                <button type="button" class="btn btn-primary" id="resetExpFilterBtn">View All Moments</button>
                <a href="<?= base_url('contact') ?>" class="btn btn-outline">Plan My Journey</a>
            </div>
        </div>

    </div>
</section>


<!-- =========================================================================
     07. SECTION 6 — IMMERSIVE STORYTELLING BANNER
     ========================================================================= -->
<section class="story-banner-section">
    <div class="story-banner-bg">
        <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Live Sri Lanka Experience" class="story-banner-img">
        <div class="story-banner-overlay"></div>
    </div>

    <div class="container story-banner-container text-center" data-reveal>
        <span class="story-banner-eyebrow">LIVE THE ISLAND</span>
        <h2 class="story-banner-title">See It. Taste It. Feel It.</h2>
        <p class="story-banner-text">
            The best memories often come from the moments you never expected — a conversation in a village, a meal prepared with a local family, a mountain sunrise or a quiet road through the countryside.
        </p>
        <a href="<?= base_url('contact') ?>" class="btn btn-cta-white">
            Start Planning <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</section>


<!-- =========================================================================
     08. SECTION 7 — LOCAL & AUTHENTIC EXPERIENCES
     ========================================================================= -->
<section class="section-padding local-authentic-section bg-light">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">BEYOND THE LANDMARKS</span>
            <h2 class="section-title">Discover the Real Sri Lanka.</h2>
            <p class="section-subtitle">Connect with authentic island culture, local communities, and traditional ways of life.</p>
        </div>

        <div class="local-cards-grid">
            <div class="local-card" data-reveal>
                <div class="local-icon-badge"><i class="fa-solid fa-basket-shopping"></i></div>
                <h3>Local Markets</h3>
                <p>Walk through colourful local markets filled with tropical produce, aromatic spices and everyday Sri Lankan life.</p>
            </div>

            <div class="local-card" data-reveal>
                <div class="local-icon-badge"><i class="fa-solid fa-house-chimney-window"></i></div>
                <h3>Village Life</h3>
                <p>Experience a slower side of the island through rural landscapes, local communities and traditional ways of life.</p>
            </div>

            <div class="local-card" data-reveal>
                <div class="local-icon-badge"><i class="fa-solid fa-utensils"></i></div>
                <h3>Traditional Cuisine</h3>
                <p>Discover the stories and flavours behind authentic clay-pot cooking, coconut sambols, and family recipes.</p>
            </div>

            <div class="local-card" data-reveal>
                <div class="local-icon-badge"><i class="fa-solid fa-palette"></i></div>
                <h3>Arts &amp; Craft</h3>
                <p>Explore traditional crafts, Kandyan drumming, mask carving and artisanal techniques passed through generations.</p>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     09. SECTION 8 — BUILD YOUR OWN EXPERIENCE CTA
     ========================================================================= -->
<section class="custom-exp-cta-section">
    <div class="container text-center" data-reveal>
        <span class="custom-exp-eyebrow">MAKE IT YOUR OWN</span>
        <h2 class="custom-exp-title">Build a Journey<br>Around What You Love.</h2>
        <p class="custom-exp-text">
            Love wildlife and food? Prefer mountains and culture? Tell Mewa Tours what inspires you and we'll help shape a Sri Lankan journey around the experiences that matter most.
        </p>
        <div class="custom-exp-buttons">
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
        <h2 class="final-cta-title">Which Sri Lankan Experience Will Be Yours?</h2>
        <p class="final-cta-text">
            Tell us what inspires you and let Mewa Tours help turn those ideas into an unforgettable journey.
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

<!-- Include Experiences Page Specific JS -->
<script src="<?= asset_url('js/experiences.js') ?>"></script>

<?php render_partial('footer'); ?>
