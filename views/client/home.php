<?php 
render_partial('header', [
    'page_title' => 'Mewa Tours - Discover Sri Lanka, Your Way | Authentic Tour Packages'
]); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildGeneralInquiryMessage());
?>

<!-- =========================================================================
     02. HERO SECTION — DAYTIME TEMPLE OF THE SACRED TOOTH RELIC (KANDY)
     ========================================================================= -->
<section class="hero-section" id="heroSection">
    <div class="hero-bg-container" id="heroBgContainer">
        <!-- Landing Video (Plays once on page load, then smoothly transitions to current background photo) -->
        <video id="heroLandingVideo" class="hero-bg-video" autoplay muted playsinline preload="auto">
            <source src="<?= base_url('assets/video/Landing%20Videos.mp4') ?>" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>

        <!-- Current Background Photo -->
        <img src="<?= asset_url('images/home/hero-dalada-maligawa.jpg') ?>" alt="Temple of the Sacred Tooth Relic Sri Dalada Maligawa Kandy Sri Lanka" class="hero-bg-img" id="heroBgImg">
        <div class="hero-overlay"></div>
    </div>

    <div class="container hero-container">
        <div class="hero-content" data-reveal>
            <span class="hero-eyebrow"><i class="fa-solid fa-compass"></i> DISCOVER SRI LANKA WITH MEWA TOURS</span>
            <h1 class="hero-title">Discover Sri Lanka,<br>Your Way.</h1>
            <p class="hero-description">
                From ancient heritage and misty mountains to golden beaches and unforgettable wildlife, discover Sri Lanka through journeys thoughtfully created around you.
            </p>

            <div class="hero-actions">
                <a href="#signatureTours" class="btn btn-hero-primary">
                    Explore Our Tours <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="<?= base_url('contact') ?>" class="btn btn-hero-secondary">
                    Plan My Journey
                </a>
            </div>

            <!-- Trust Indicators -->
            <div class="hero-trust-bar">
                <div class="trust-item"><i class="fa-solid fa-shield-halved"></i> Authentic Experiences</div>
                <div class="trust-item"><i class="fa-solid fa-award"></i> Local Expertise</div>
                <div class="trust-item"><i class="fa-solid fa-heart"></i> Personalised Journeys</div>
            </div>
        </div>
    </div>

    <a href="#mewaIntro" class="scroll-indicator" aria-label="Scroll to content">
        <span class="scroll-text">Scroll to Explore</span>
        <i class="fa-solid fa-chevron-down scroll-arrow"></i>
    </a>
</section>


<!-- =========================================================================
     03. SECTION 2 — MEWA TOURS EDITORIAL INTRODUCTION
     ========================================================================= -->
<section class="section-padding intro-section" id="mewaIntro">
    <div class="container">
        <div class="intro-grid">
            <div class="intro-image-wrapper" data-reveal>
                <img src="<?= asset_url('images/home/sigiriya-fortress.jpg') ?>" alt="Sigiriya Rock Fortress Sri Lanka" class="intro-main-img">
                <div class="intro-img-badge">
                    <i class="fa-solid fa-location-dot"></i> Sigiriya, Sri Lanka
                </div>
            </div>

            <div class="intro-content" data-reveal>
                <span class="section-eyebrow">YOUR JOURNEY, OUR PASSION</span>
                <h2 class="section-title">The Heart of Sri Lanka,<br>Curated for You.</h2>
                <p class="intro-text-lead">
                    At Mewa Tours, travel is more than simply visiting places. It is about discovering the stories, landscapes, people and traditions that make Sri Lanka unforgettable.
                </p>
                <p class="intro-text-body">
                    With local knowledge and personal care, we create meaningful journeys designed around every traveller — whether you seek ancient heritage, serene tea hills, wildlife safaris, or tropical beach escapes.
                </p>
                <div class="intro-cta-wrapper">
                    <a href="<?= base_url('about') ?>" class="btn btn-outline">
                        Discover Our Story <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     04. SECTION 3 — WHY TRAVEL WITH MEWA TOURS
     ========================================================================= -->
<section class="section-padding why-section bg-light">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">WHY TRAVEL WITH MEWA TOURS?</span>
            <h2 class="section-title">Travel Better. Travel Local.</h2>
            <p class="section-subtitle">Personalised care, local expertise, and authentic island discovery on every journey.</p>
        </div>

        <div class="feature-grid">
            <div class="feature-card" data-reveal>
                <div class="feature-icon-box"><i class="fa-solid fa-map-location-dot"></i></div>
                <h3>Local Expertise</h3>
                <p>Discover Sri Lanka with local experts who understand the island's culture, heritage, and hidden treasures.</p>
            </div>

            <div class="feature-card" data-reveal>
                <div class="feature-icon-box"><i class="fa-solid fa-sliders"></i></div>
                <h3>Tailor-Made Journeys</h3>
                <p>Every traveller is unique, so every itinerary can be custom-shaped around your personal style and preferences.</p>
            </div>

            <div class="feature-card" data-reveal>
                <div class="feature-icon-box"><i class="fa-solid fa-handshake"></i></div>
                <h3>Trusted Service</h3>
                <p>Friendly, dedicated, and transparent support from your very first inquiry until the completion of your trip.</p>
            </div>

            <div class="feature-card" data-reveal>
                <div class="feature-icon-box"><i class="fa-solid fa-gem"></i></div>
                <h3>Authentic Experiences</h3>
                <p>Go beyond ordinary sightseeing to connect genuinely with local communities, traditions, and natural beauty.</p>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     05. SECTION 4 — EXPERIENCES FOR EVERY TRAVELLER
     ========================================================================= -->
<section class="section-padding experiences-section">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">EXPERIENCES FOR EVERY TRAVELLER</span>
            <h2 class="section-title">Find Your Perfect Experience</h2>
            <p class="section-subtitle">Immerse yourself in the diverse beauty of Sri Lanka's wildlife, heritage, and coasts.</p>
        </div>

        <div class="experiences-grid">
            <!-- Experience 1: Wildlife -->
            <div class="experience-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80" alt="Sri Lankan Elephant Safari" class="experience-img">
                <div class="experience-gradient"></div>
                <div class="experience-content">
                    <span class="exp-tag"><i class="fa-solid fa-paw"></i> Wildlife</span>
                    <h3>Leopard & Elephant Safaris</h3>
                    <a href="<?= base_url('experiences') ?>" class="exp-link">Explore Experience <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Experience 2: Culture -->
            <div class="experience-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80" alt="Sri Lankan Ancient Culture & Temples" class="experience-img">
                <div class="experience-gradient"></div>
                <div class="experience-content">
                    <span class="exp-tag"><i class="fa-solid fa-landmark"></i> Culture</span>
                    <h3>Ancient Kingdoms & Temples</h3>
                    <a href="<?= base_url('experiences') ?>" class="exp-link">Explore Experience <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Experience 3: Beaches -->
            <div class="experience-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=800&q=80" alt="Sri Lanka Tropical Beaches" class="experience-img">
                <div class="experience-gradient"></div>
                <div class="experience-content">
                    <span class="exp-tag"><i class="fa-solid fa-umbrella-beach"></i> Beaches</span>
                    <h3>Golden Palms & Coastal Escapes</h3>
                    <a href="<?= base_url('experiences') ?>" class="exp-link">Explore Experience <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Experience 4: Hill Country -->
            <div class="experience-card" data-reveal>
                <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Ella Nine Arch Bridge Train Journey" class="experience-img">
                <div class="experience-gradient"></div>
                <div class="experience-content">
                    <span class="exp-tag"><i class="fa-solid fa-train"></i> Hill Country</span>
                    <h3>Scenic Tea Country & Train Rides</h3>
                    <a href="<?= base_url('experiences') ?>" class="exp-link">Explore Experience <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Experience 5: Adventure -->
            <div class="experience-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Highland Trekking Adventure" class="experience-img">
                <div class="experience-gradient"></div>
                <div class="experience-content">
                    <span class="exp-tag"><i class="fa-solid fa-person-hiking"></i> Adventure</span>
                    <h3>Highland Trekking & Waterfalls</h3>
                    <a href="<?= base_url('experiences') ?>" class="exp-link">Explore Experience <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Experience 6: Romantic Escapes -->
            <div class="experience-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80" alt="Luxury Sunset Resort Sri Lanka" class="experience-img">
                <div class="experience-gradient"></div>
                <div class="experience-content">
                    <span class="exp-tag"><i class="fa-solid fa-heart"></i> Romance</span>
                    <h3>Boutique Escapes & Honeymoons</h3>
                    <a href="<?= base_url('experiences') ?>" class="exp-link">Explore Experience <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     06. SECTION 5 — SIGNATURE TOURS
     ========================================================================= -->
<section class="section-padding tours-section bg-light" id="signatureTours">
    <div class="container">
        <div class="section-header-flex" data-reveal>
            <div>
                <span class="section-eyebrow">CURATED JOURNEYS</span>
                <h2 class="section-title">Handpicked Journeys for You</h2>
            </div>
            <a href="<?= base_url('tours') ?>" class="btn btn-outline">
                View All Tours <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="tours-grid">
            <!-- Tour 1 -->
            <div class="tour-card" data-reveal>
                <div class="tour-image-container">
                    <img src="<?= asset_url('images/home/sigiriya-fortress.jpg') ?>" alt="Cultural Triangle Explorer Tour" class="tour-img">
                    <span class="tour-badge">7 Days / 6 Nights</span>
                </div>
                <div class="tour-body">
                    <span class="tour-category">Heritage & Culture</span>
                    <h3 class="tour-title">Cultural Triangle Explorer</h3>
                    <p class="tour-locations"><i class="fa-solid fa-location-dot"></i> Sigiriya • Dambulla • Polonnaruwa • Kandy</p>
                    <p class="tour-desc">Immerse yourself in UNESCO World Heritage fortresses, ancient cave temples, and sacred hill capital traditions.</p>
                    <div class="tour-footer">
                        <a href="<?= base_url('tours/sri-lanka-highlights-tour') ?>" class="tour-action">Explore Journey <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Tour 2 -->
            <div class="tour-card" data-reveal>
                <div class="tour-image-container">
                    <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Hill Country Escape Tour" class="tour-img">
                    <span class="tour-badge">5 Days / 4 Nights</span>
                </div>
                <div class="tour-body">
                    <span class="tour-category">Scenic Highlands</span>
                    <h3 class="tour-title">Hill Country Escape</h3>
                    <p class="tour-locations"><i class="fa-solid fa-location-dot"></i> Kandy • Nuwara Eliya • Ella</p>
                    <p class="tour-desc">Ride scenic mountain railways through emerald tea estates, mist-covered valleys, and dramatic waterfalls.</p>
                    <div class="tour-footer">
                        <a href="<?= base_url('tours') ?>" class="tour-action">Explore Journey <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Tour 3 -->
            <div class="tour-card" data-reveal>
                <div class="tour-image-container">
                    <img src="https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80" alt="Wild Sri Lanka Safari Tour" class="tour-img">
                    <span class="tour-badge">6 Days / 5 Nights</span>
                </div>
                <div class="tour-body">
                    <span class="tour-category">Wildlife Safari</span>
                    <h3 class="tour-title">Wild Sri Lanka Safari</h3>
                    <p class="tour-locations"><i class="fa-solid fa-location-dot"></i> Yala • Udawalawe • Wilpattu</p>
                    <p class="tour-desc">Thrilling game drives with naturalists tracking wild leopards, herds of elephants, and rare endemic birds.</p>
                    <div class="tour-footer">
                        <a href="<?= base_url('tours/wild-sri-lanka-leopard-safari') ?>" class="tour-action">Explore Journey <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Tour 4 -->
            <div class="tour-card" data-reveal>
                <div class="tour-image-container">
                    <img src="https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=800&q=80" alt="Southern Coast Getaway Tour" class="tour-img">
                    <span class="tour-badge">4 Days / 3 Nights</span>
                </div>
                <div class="tour-body">
                    <span class="tour-category">Beach & Coast</span>
                    <h3 class="tour-title">Southern Coast Getaway</h3>
                    <p class="tour-locations"><i class="fa-solid fa-location-dot"></i> Galle • Mirissa • Unawatuna</p>
                    <p class="tour-desc">Walk historic colonial fort ramparts, enjoy whale watching, and unwind on pristine tropical palm beaches.</p>
                    <div class="tour-footer">
                        <a href="<?= base_url('tours') ?>" class="tour-action">Explore Journey <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     07. SECTION 6 — FEATURED DESTINATIONS
     ========================================================================= -->
<section class="section-padding destinations-section">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">DISCOVER THE ISLAND</span>
            <h2 class="section-title">Places You'll Never Forget.</h2>
            <p class="section-subtitle">Explore the iconic landmarks and secret corners that define Sri Lanka.</p>
        </div>

        <div class="destinations-masonry">
            <!-- Featured Large Destination: Kandy -->
            <div class="dest-card dest-card-featured" data-reveal>
                <img src="<?= asset_url('images/home/hero-dalada-maligawa.jpg') ?>" alt="Kandy Sri Lanka" class="dest-img">
                <div class="dest-gradient"></div>
                <div class="dest-content">
                    <span class="dest-badge">Sacred Hill Capital</span>
                    <h3>Kandy</h3>
                    <p>Culture, heritage and the sacred heart of Sri Lanka.</p>
                    <a href="<?= base_url('destinations/kandy') ?>" class="btn btn-sm btn-white">Explore Destination</a>
                </div>
            </div>

            <!-- Smaller Destination 1: Ella -->
            <div class="dest-card" data-reveal>
                <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Ella Sri Lanka" class="dest-img">
                <div class="dest-gradient"></div>
                <div class="dest-content">
                    <h3>Ella</h3>
                    <p>Misty mountains, waterfalls and train journeys.</p>
                </div>
            </div>

            <!-- Smaller Destination 2: Sigiriya -->
            <div class="dest-card" data-reveal>
                <img src="<?= asset_url('images/home/sigiriya-fortress.jpg') ?>" alt="Sigiriya Sri Lanka" class="dest-img">
                <div class="dest-gradient"></div>
                <div class="dest-content">
                    <h3>Sigiriya</h3>
                    <p>Ancient rock fortress rising above green jungle.</p>
                </div>
            </div>

            <!-- Smaller Destination 3: Yala -->
            <div class="dest-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80" alt="Yala National Park" class="dest-img">
                <div class="dest-gradient"></div>
                <div class="dest-content">
                    <h3>Yala</h3>
                    <p>Wild landscapes and leopard safari encounters.</p>
                </div>
            </div>

            <!-- Smaller Destination 4: Galle -->
            <div class="dest-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80" alt="Galle Fort Sri Lanka" class="dest-img">
                <div class="dest-gradient"></div>
                <div class="dest-content">
                    <h3>Galle</h3>
                    <p>Colonial Dutch heritage and coastal charm.</p>
                </div>
            </div>

            <!-- Smaller Destination 5: Mirissa -->
            <div class="dest-card" data-reveal>
                <img src="https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=800&q=80" alt="Mirissa Beach Sri Lanka" class="dest-img">
                <div class="dest-gradient"></div>
                <div class="dest-content">
                    <h3>Mirissa</h3>
                    <p>Tropical palm beaches & ocean whale watching.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     08. SECTION 7 — TAILOR-MADE JOURNEY BANNER CTA
     ========================================================================= -->
<section class="banner-cta-section">
    <div class="banner-bg-wrapper">
        <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Sri Lanka Tea Country Highlands" class="banner-bg-img">
        <div class="banner-overlay"></div>
    </div>

    <div class="container banner-container text-center" data-reveal>
        <span class="banner-eyebrow">MADE JUST FOR YOU</span>
        <h2 class="banner-title">Your Dream Trip,<br>Designed Your Way.</h2>
        <p class="banner-text">
            Tell us what inspires you and we'll help shape a Sri Lankan journey around your interests, travel dates, and personal style.
        </p>
        <div class="banner-actions">
            <a href="<?= base_url('contact') ?>" class="btn btn-banner-primary">
                Plan My Journey <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-banner-whatsapp">
                <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
            </a>
        </div>
    </div>
</section>


<!-- =========================================================================
     09. SECTION 8 — SIGNATURE EXPERIENCES / STORYTELLING
     ========================================================================= -->
<section class="section-padding storytelling-section">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">AUTHENTIC ISLAND MOMENTS</span>
            <h2 class="section-title">More Than Just a Holiday.</h2>
            <p class="section-subtitle">Deepen your connection with Sri Lanka through hand-crafted experiences.</p>
        </div>

        <div class="story-grid">
            <div class="story-card" data-reveal>
                <div class="story-img-card">
                    <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Ride Through Hill Country Train" class="story-img">
                </div>
                <div class="story-content">
                    <h3>Ride Through the Hill Country</h3>
                    <p>Experience one of the world's most scenic railway journeys through tea-covered mountain ranges and misty viaducts.</p>
                </div>
            </div>

            <div class="story-card" data-reveal>
                <div class="story-img-card">
                    <img src="https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80" alt="Walk Among Wild Elephants" class="story-img">
                </div>
                <div class="story-content">
                    <h3>Walk Among Giants</h3>
                    <p>Discover Sri Lanka's extraordinary biodiversity through ethical, responsible safari tours with experienced local naturalists.</p>
                </div>
            </div>

            <div class="story-card" data-reveal>
                <div class="story-img-card">
                    <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80" alt="Authentic Sri Lankan Culinary Experience" class="story-img">
                </div>
                <div class="story-content">
                    <h3>Taste Authentic Sri Lanka</h3>
                    <p>Explore vibrant local spice markets, traditional home-cooked curries, and the rich flavors behind island culture.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     10. SECTION 9 — TRAVELLER STORIES (TESTIMONIALS & FEEDBACK)
     ========================================================================= -->
<section class="section-padding testimonials-section bg-light">
    <div class="container">
        <div class="section-header text-center" data-reveal>
            <span class="section-eyebrow">TRAVELLER STORIES</span>
            <h2 class="section-title">Memories Shared by Our Guests</h2>
            <p class="section-subtitle">Real experiences from travellers who explored Sri Lanka with Mewa Tours.</p>
        </div>

        <div class="testimonials-grid">
            <?php if (!empty($featured_reviews)): ?>
                <?php foreach ($featured_reviews as $rev): ?>
                    <div class="testimonial-card" data-reveal>
                        <div class="rating-stars">
                            <?php for ($s = 1; $s <= 5; $s++): ?>
                                <?php if ($s <= $rev['rating']): ?>
                                    <i class="fa-solid fa-star"></i>
                                <?php else: ?>
                                    <i class="fa-regular fa-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <h4 style="font-weight: 700; color: var(--brand-blue); margin: 10px 0 6px; font-size: 1.05rem;"><?= e($rev['title']) ?></h4>
                        <p class="review-text">
                            "<?= e($rev['comment']) ?>"
                        </p>
                        <div class="reviewer-meta" style="margin-top: 15px;">
                            <strong><?= e($rev['customer_name']) ?></strong>
                            <span><?= e($rev['customer_country'] ?: 'Traveler') ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="testimonial-card" data-reveal>
                    <div class="rating-stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="review-text">
                        "Mewa Tours organized an unforgettable trip for our family. The private driver, hotel choices, and Sigiriya visit were seamless. Highly recommended!"
                    </p>
                    <div class="reviewer-meta">
                        <strong>David &amp; Sarah M.</strong>
                        <span>United Kingdom</span>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center" style="margin-top: 40px;" data-reveal>
            <a href="<?= base_url('reviews') ?>" class="btn btn-outline-primary" style="padding: 12px 28px; font-weight: 700;">
                <i class="fa-solid fa-comments"></i> Read All Traveler Reviews & Share Yours <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>


<!-- =========================================================================
     11. SECTION 10 — MOMENTS FROM SRI LANKA (GALLERY STRIP)
     ========================================================================= -->
<section class="section-padding gallery-strip-section">
    <div class="container">
        <div class="section-header-flex" data-reveal>
            <div>
                <span class="section-eyebrow">MOMENTS FROM SRI LANKA</span>
                <h2 class="section-title">A Glimpse of the Journey.</h2>
            </div>
            <a href="<?= base_url('gallery') ?>" class="btn btn-outline">
                View Full Gallery <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="gallery-strip-grid" data-reveal>
            <div class="strip-item"><img src="<?= asset_url('images/home/hero-dalada-maligawa.jpg') ?>" alt="Temple of Tooth Kandy"></div>
            <div class="strip-item"><img src="<?= asset_url('images/home/sigiriya-fortress.jpg') ?>" alt="Sigiriya Fortress"></div>
            <div class="strip-item"><img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Ella Train"></div>
            <div class="strip-item"><img src="https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=600&q=80" alt="Yala Safari Elephant"></div>
        </div>
    </div>
</section>


<!-- =========================================================================
     12. SECTION 11 — FINAL CONVERSION CTA
     ========================================================================= -->
<section class="final-cta-section">
    <div class="container text-center" data-reveal>
        <h2 class="final-cta-title">Ready to Discover Sri Lanka?</h2>
        <p class="final-cta-text">
            Let Mewa Tours help create a journey you'll remember long after you return home.
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

<!-- Single-Play Landing Video Transition Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const video = document.getElementById('heroLandingVideo');
    if (!video) return;

    // Ensure video plays exactly ONE time
    video.loop = false;

    const transitionToImage = () => {
        if (!video.classList.contains('ended')) {
            video.classList.add('ended');
            setTimeout(() => {
                video.style.display = 'none';
            }, 1200);
        }
    };

    // When video completes playing once:
    video.addEventListener('ended', transitionToImage);

    // Fallback if video fails to play or load
    video.addEventListener('error', transitionToImage);

    // Autoplay execution
    const playPromise = video.play();
    if (playPromise !== undefined) {
        playPromise.catch(() => {
            // If browser autoplay policy blocks video, transition to background photo smoothly
            transitionToImage();
        });
    }
});
</script>

<?php render_partial('footer'); ?>
