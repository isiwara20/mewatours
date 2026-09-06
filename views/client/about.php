<?php 
$about = $about ?? (new AboutBLL())->getAboutData();

if (!function_exists('about_img_url')) {
    function about_img_url(string $path, string $fallback = ''): string {
        if (empty($path)) $path = $fallback;
        if (empty($path)) return '';
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
            return $path;
        }
        if (strpos($path, 'images/') === 0) {
            return asset_url($path);
        }
        return asset_url('images/' . $path);
    }
}

render_partial('header', [
    'page_title' => $about['about_meta_title'] ?? 'About Us - Mewan Manju Sri Kandearachchi | Mewa Tours Sri Lanka',
    'meta_description' => $about['about_meta_description'] ?? null
]); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildGeneralInquiryMessage());
?>

<!-- =========================================================================
     01. HERO BANNER SECTION
     ========================================================================= -->
<section class="about-hero">
    <div class="about-hero-bg">
        <img src="<?= e(about_img_url($about['about_hero_image'] ?? '', 'tours/hero-tours-ella.jpg')) ?>" alt="Mewa Tours Sri Lanka Scenic Mountain View">
        <div class="about-hero-overlay"></div>
    </div>
    <div class="container">
        <div class="about-hero-content" data-reveal>
            <span class="about-eyebrow"><?= e($about['about_hero_eyebrow'] ?? 'DISCOVER OUR STORY') ?></span>
            <h1 class="about-hero-title"><?= e($about['about_hero_title'] ?? 'Authentic Sri Lankan Hospitality & Custom Private Journeys') ?></h1>
            <p class="about-hero-subtitle">
                <?= nl2br(e($about['about_hero_subtitle'] ?? '')) ?>
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
                <img src="<?= e(about_img_url($about['about_founder_image'] ?? '', 'about/mewan-founder.jpg')) ?>" alt="<?= e($about['about_founder_name'] ?? 'Mewan Manju Sri Kandearachchi') ?> - Founder of Mewa Tours" class="founder-img" onerror="this.src='<?= asset_url('images/home/sigiriya-fortress.jpg') ?>'">
            </div>

            <!-- Right: Founder Message & Vision -->
            <div class="founder-content" data-reveal>
                <span class="section-eyebrow">LEADERSHIP & VISION</span>
                <h2 class="founder-name"><?= e($about['about_founder_name'] ?? 'Mewan Manju Sri Kandearachchi') ?></h2>
                <span class="founder-role"><i class="fa-solid fa-compass" style="color: #0284c7;"></i> <?= e($about['about_founder_role'] ?? 'Founder & Managing Director, Mewa Tours Sri Lanka') ?></span>

                <?php if (!empty($about['about_founder_quote'])): ?>
                    <div class="founder-quote">
                        "<?= e($about['about_founder_quote']) ?>"
                    </div>
                <?php endif; ?>

                <?php if (!empty($about['about_founder_bio_1'])): ?>
                    <p class="founder-text">
                        <?= nl2br(e($about['about_founder_bio_1'])) ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($about['about_founder_bio_2'])): ?>
                    <p class="founder-text">
                        <?= nl2br(e($about['about_founder_bio_2'])) ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($about['about_founder_bio_3'])): ?>
                    <p class="founder-text">
                        <?= nl2br(e($about['about_founder_bio_3'])) ?>
                    </p>
                <?php endif; ?>

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
            <span style="color: #0284c7; font-weight: 800; font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase;"><?= e($about['about_values_eyebrow'] ?? 'WHY TRAVEL WITH US') ?></span>
            <h2 style="font-family: var(--font-heading, 'Playfair Display', Georgia, serif); font-size: 2.6rem; color: #0f172a; margin-top: 8px;"><?= e($about['about_values_title'] ?? 'The Mewa Tours Promise') ?></h2>
            <p style="color: #64748b; font-size: 1.05rem;"><?= e($about['about_values_subtitle'] ?? 'We hold ourselves to the highest standards of safety, personal attention, and transparent travel excellence.') ?></p>
        </div>

        <div class="values-grid">
            <div class="value-card" data-reveal>
                <div class="value-icon">
                    <i class="fa-solid <?= e($about['about_val1_icon'] ?? 'fa-user-shield') ?>"></i>
                </div>
                <h3 class="value-title"><?= e($about['about_val1_title'] ?? '100% Private Tours') ?></h3>
                <p class="value-desc"><?= e($about['about_val1_desc'] ?? 'No crowded group buses. Every tour is exclusive to you, your family, or your private travel group with total schedule flexibility.') ?></p>
            </div>

            <div class="value-card" data-reveal>
                <div class="value-icon">
                    <i class="fa-solid <?= e($about['about_val2_icon'] ?? 'fa-car-side') ?>"></i>
                </div>
                <h3 class="value-title"><?= e($about['about_val2_title'] ?? 'Luxury Private Fleet') ?></h3>
                <p class="value-desc"><?= e($about['about_val2_desc'] ?? 'Modern, fully insured, air-conditioned cars, vans, and luxury SUVs driven by experienced English-speaking tourist drivers.') ?></p>
            </div>

            <div class="value-card" data-reveal>
                <div class="value-icon">
                    <i class="fa-solid <?= e($about['about_val3_icon'] ?? 'fa-hand-holding-heart') ?>"></i>
                </div>
                <h3 class="value-title"><?= e($about['about_val3_title'] ?? 'Authentic Local Insights') ?></h3>
                <p class="value-desc"><?= e($about['about_val3_desc'] ?? 'Experience genuine Sri Lankan culture, village home-cooked meals, sacred rituals, and hidden scenic spots known only to locals.') ?></p>
            </div>

            <div class="value-card" data-reveal>
                <div class="value-icon">
                    <i class="fa-solid <?= e($about['about_val4_icon'] ?? 'fa-headset') ?>"></i>
                </div>
                <h3 class="value-title"><?= e($about['about_val4_title'] ?? '24/7 Personal Support') ?></h3>
                <p class="value-desc"><?= e($about['about_val4_desc'] ?? 'Direct access to Mewan and our travel coordinator team before, during, and after your trip for complete peace of mind.') ?></p>
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
                <div class="stat-number"><?= e($about['about_stat1_num'] ?? '10+') ?></div>
                <div class="stat-label"><?= e($about['about_stat1_label'] ?? 'Years Tourism Experience') ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?= e($about['about_stat2_num'] ?? '1,500+') ?></div>
                <div class="stat-label"><?= e($about['about_stat2_label'] ?? 'Happy Private Travelers') ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?= e($about['about_stat3_num'] ?? '100%') ?></div>
                <div class="stat-label"><?= e($about['about_stat3_label'] ?? 'Custom Tailored Itineraries') ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?= e($about['about_stat4_num'] ?? '4.9 / 5') ?></div>
                <div class="stat-label"><?= e($about['about_stat4_label'] ?? 'Guest Rating Score') ?></div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     05. IMMERSIVE STORYTELLING BANNER
     ========================================================================= -->
<section class="story-banner-section">
    <div class="story-banner-bg">
        <img src="<?= e(about_img_url($about['about_cta_image'] ?? '', 'experiences/ella-train.jpg')) ?>" alt="Sri Lanka Scenic Discovery" class="story-banner-img">
        <div class="story-banner-overlay"></div>
    </div>

    <div class="container story-banner-container text-center" data-reveal>
        <span class="story-banner-eyebrow"><?= e($about['about_cta_eyebrow'] ?? 'YOUR JOURNEY AWAITS') ?></span>
        <h2 class="story-banner-title"><?= e($about['about_cta_title'] ?? 'Let Us Craft Your Dream Sri Lankan Experience') ?></h2>
        <p class="story-banner-text">
            <?= nl2br(e($about['about_cta_text'] ?? '')) ?>
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
