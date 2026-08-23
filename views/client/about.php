<?php 
render_partial('header', [
    'page_title' => 'About Us - Mewan Manju Sri Kandearachchi | Mewa Tours Sri Lanka'
]); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildGeneralInquiryMessage());
?>

<!-- =========================================================================
     01. HERO BANNER SECTION
     ========================================================================= -->
<section class="about-hero">
    <div class="about-hero-bg">
        <img src="<?= asset_url('images/tours/hero-tours-ella.jpg') ?>" alt="Mewa Tours Sri Lanka Scenic Mountain View">
        <div class="about-hero-overlay"></div>
    </div>
    <div class="container">
        <div class="about-hero-content" data-reveal>
            <span class="about-eyebrow">DISCOVER OUR STORY</span>
            <h1 class="about-hero-title">Authentic Sri Lankan Hospitality & Custom Private Journeys</h1>
            <p class="about-hero-subtitle">
                Founded by <strong>Mewan Manju Sri Kandearachchi</strong>, Mewa Tours is dedicated to creating memorable, 100% private travel experiences across Sri Lanka's sacred heritage, wildlife safaris, misty tea mountains, and tropical coastlines.
            </p>
        </div>
    </div>
</section>


<!-- =========================================================================
     02. FOUNDER & OWNER SPOTLIGHT SECTION
     ========================================================================= -->
<section class="founder-section">
    <div class="container">
        <div class="founder-grid">
            
            <!-- Left: Founder Image Showcase -->
            <div class="founder-image-wrapper" data-reveal>
                <img src="<?= asset_url('images/about/mewan-founder.jpg') ?>" alt="Mewan Manju Sri Kandearachchi - Founder of Mewa Tours" class="founder-img" onerror="this.src='<?= asset_url('images/home/sigiriya-fortress.jpg') ?>'">
                <div class="founder-badge">
                    <i class="fa-solid fa-award"></i>
                    <div>
                        <span class="founder-badge-title">Mewan Manju Sri Kandearachchi</span>
                        <span class="founder-badge-sub">Founder & Managing Director - Mewa Tours</span>
                    </div>
                </div>
            </div>

            <!-- Right: Founder Message & Vision -->
            <div class="founder-content" data-reveal>
                <span class="section-eyebrow">LEADERSHIP & VISION</span>
                <h2 class="founder-name">Mewan Manju Sri Kandearachchi</h2>
                <span class="founder-role"><i class="fa-solid fa-compass" style="color: #0284c7;"></i> Founder & Managing Director, Mewa Tours Sri Lanka</span>

                <div class="founder-quote">
                    "Travel in Sri Lanka is not just about visiting famous landmarks — it is about genuine warmth, local culture, breathtaking scenery, and creating private memories that stay with you forever."
                </div>

                <p class="founder-text">
                    Welcome to Mewa Tours! I am <strong>Mewan Manju Sri Kandearachchi</strong>, founder of Mewa Tours Sri Lanka. My lifelong passion has been sharing the authentic magic, rich heritage, and unmatched beauty of our paradise island with travelers from around the globe.
                </p>

                <p class="founder-text">
                    We believe every journey should be as unique as the traveler taking it. That is why Mewa Tours specializes in <strong>100% private, custom-tailored itineraries</strong> — complete with luxury air-conditioned vehicles, professional English-speaking tourist drivers, and carefully curated hotel stays.
                </p>

                <p class="founder-text">
                    Whether you wish to climb the ancient rock fortress of Sigiriya, track leopards in Yala National Park, ride the iconic highland railway through Ella's tea country, or relax on golden palm-fringed beaches, my team and I are personally committed to ensuring your holiday in Sri Lanka is seamless, safe, and truly unforgettable.
                </p>

                <div style="display: flex; gap: 15px; margin-top: 30px; flex-wrap: wrap;">
                    <a href="<?= base_url('contact') ?>" class="btn btn-primary" style="padding: 12px 26px; border-radius: 8px; font-weight: 700;">
                        <i class="fa-solid fa-paper-plane"></i> Contact Mewan & Team
                    </a>
                    <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn" style="background: #25d366; color: white; padding: 12px 26px; border-radius: 8px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp Now
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- =========================================================================
     03. CORE VALUES & WHY CHOOSE US
     ========================================================================= -->
<section class="values-section">
    <div class="container">
        <div style="text-align: center; max-width: 700px; margin: 0 auto;" data-reveal>
            <span style="color: #0284c7; font-weight: 800; font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase;">WHY TRAVEL WITH US</span>
            <h2 style="font-family: var(--font-heading, 'Playfair Display', Georgia, serif); font-size: 2.6rem; color: #0f172a; margin-top: 8px;">The Mewa Tours Promise</h2>
            <p style="color: #64748b; font-size: 1.05rem;">We hold ourselves to the highest standards of safety, personal attention, and transparent travel excellence.</p>
        </div>

        <div class="values-grid">
            <div class="value-card" data-reveal>
                <div class="value-icon">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <h3 class="value-title">100% Private Tours</h3>
                <p class="value-desc">No crowded group buses. Every tour is exclusive to you, your family, or your private travel group with total schedule flexibility.</p>
            </div>

            <div class="value-card" data-reveal>
                <div class="value-icon">
                    <i class="fa-solid fa-car-side"></i>
                </div>
                <h3 class="value-title">Luxury Private Fleet</h3>
                <p class="value-desc">Modern, fully insured, air-conditioned cars, vans, and luxury SUVs driven by experienced English-speaking tourist drivers.</p>
            </div>

            <div class="value-card" data-reveal>
                <div class="value-icon">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                <h3 class="value-title">Authentic Local Insights</h3>
                <p class="value-desc">Experience genuine Sri Lankan culture, village home-cooked meals, sacred rituals, and hidden scenic spots known only to locals.</p>
            </div>

            <div class="value-card" data-reveal>
                <div class="value-icon">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h3 class="value-title">24/7 Personal Support</h3>
                <p class="value-desc">Direct access to Mewan and our travel coordinator team before, during, and after your trip for complete peace of mind.</p>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     04. STATS COUNTER SECTION
     ========================================================================= -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid" data-reveal>
            <div class="stat-box">
                <div class="stat-number">10+</div>
                <div class="stat-label">Years Tourism Experience</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">1,500+</div>
                <div class="stat-label">Happy Private Travelers</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">100%</div>
                <div class="stat-label">Custom Tailored Itineraries</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">4.9 / 5</div>
                <div class="stat-label">Guest Rating Score</div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     05. IMMERSIVE STORYTELLING BANNER
     ========================================================================= -->
<section class="story-banner-section">
    <div class="story-banner-bg">
        <img src="<?= asset_url('images/experiences/ella-train.jpg') ?>" alt="Sri Lanka Scenic Discovery" class="story-banner-img">
        <div class="story-banner-overlay"></div>
    </div>

    <div class="container story-banner-container text-center" data-reveal>
        <span class="story-banner-eyebrow">YOUR JOURNEY AWAITS</span>
        <h2 class="story-banner-title">Let Us Craft Your Dream Sri Lankan Experience</h2>
        <p class="story-banner-text">
            From the moment you touch down at Bandaranaike International Airport until your final departure, Mewan Manju Sri Kandearachchi and the Mewa Tours team will ensure every single day is filled with wonder, comfort, and joy.
        </p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="<?= base_url('tours') ?>" class="btn btn-cta-white">
                Explore Tour Packages <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="<?= base_url('contact') ?>" class="btn" style="background: #25d366; color: white; padding: 14px 28px; border-radius: 8px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 10px;">
                <i class="fa-brands fa-whatsapp"></i> Plan Trip via WhatsApp
            </a>
        </div>
    </div>
</section>

<?php render_partial('footer'); ?>
