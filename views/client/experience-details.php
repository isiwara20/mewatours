<?php 
declare(strict_types=1);

/**
 * Mewa Tours - Experience Details View
 */
render_partial('header', [
    'page_title' => $page_title ?? ($experience['name'] . ' | Mewa Tours Sri Lanka')
]); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildExperienceInquiryMessage($experience['name'] ?? 'Sri Lanka Experience'));

$heroImgSrc = !empty($experience['featured_image']) 
    ? ((strpos($experience['featured_image'], 'http') === 0) ? $experience['featured_image'] : asset_url('images/' . e($experience['featured_image'])))
    : asset_url('images/experiences/hero-experiences-safari.jpg');
?>

<!-- Experience Details Stylesheet & Inline Page System -->
<link rel="stylesheet" href="<?= asset_url('css/experiences.css') ?>">

<style>
/* =========================================================================
   EXPERIENCE DETAILS PAGE — UNBLOCKED FULL-PICTURE SHOWCASE LAYOUT
   ========================================================================= */

/* Main page wrapper starts cleanly BELOW the 104px fixed header */
.exp-details-page {
    padding-top: 130px;
    padding-bottom: 80px;
    background-color: #fafbfc;
    min-height: 100vh;
}

/* Breadcrumb Navigation */
.exp-page-breadcrumb {
    margin-bottom: 18px;
}

.exp-page-breadcrumb ol {
    display: flex;
    align-items: center;
    gap: 10px;
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-muted, #64748b);
}

.exp-page-breadcrumb a {
    color: var(--text-secondary, #475569);
    transition: var(--transition, all 0.25s ease);
    text-decoration: none;
}

.exp-page-breadcrumb a:hover {
    color: #8b5cf6;
}

.exp-page-breadcrumb i {
    font-size: 0.68rem;
    color: #94a3b8;
}

.exp-page-breadcrumb .active {
    color: #8b5cf6;
    font-weight: 700;
}

/* Header Info Banner */
.exp-page-header {
    margin-bottom: 24px;
}

.exp-badge-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.exp-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(139, 92, 246, 0.1);
    color: #8b5cf6;
    font-size: 0.8rem;
    font-weight: 800;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 50px;
}

.exp-page-title {
    font-family: var(--font-heading, 'Playfair Display', serif);
    font-size: 3.2rem;
    font-weight: 800;
    color: var(--deep-navy, #0e1b3d);
    line-height: 1.15;
    margin: 0 0 12px 0;
}

.exp-page-subtitle {
    font-size: 1.2rem;
    color: var(--text-secondary, #475569);
    max-width: 820px;
    line-height: 1.6;
    margin: 0;
}

/* Complete Main Picture Showcase Frame */
.exp-showcase-wrapper {
    position: relative;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 16px 36px rgba(14, 27, 61, 0.12);
    margin-bottom: 35px;
    background: #0e1b3d;
}

.exp-showcase-img {
    width: 100%;
    height: auto;
    max-height: 560px;
    min-height: 380px;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.exp-showcase-wrapper:hover .exp-showcase-img {
    transform: scale(1.015);
}

.exp-showcase-badge {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: rgba(14, 27, 61, 0.85);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    color: #ffffff;
    padding: 8px 18px;
    border-radius: 50px;
    font-size: 0.88rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    z-index: 2;
}

.exp-showcase-badge i {
    color: #c084fc;
}

/* Quick Information Bar */
.exp-quick-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid var(--border-light, #e2e8f0);
    box-shadow: 0 4px 16px rgba(14, 27, 61, 0.04);
    padding: 20px 28px;
    margin-bottom: 45px;
    gap: 20px;
}

.stat-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
    border-right: 1px solid var(--border-light, #e2e8f0);
    padding-right: 15px;
}

.stat-item:last-child {
    border-right: none;
    padding-right: 0;
}

.stat-label {
    font-size: 0.75rem;
    font-weight: 800;
    color: #64748b;
    letter-spacing: 1.1px;
    text-transform: uppercase;
}

.stat-value {
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--deep-navy, #0e1b3d);
    display: flex;
    align-items: center;
    gap: 8px;
}

.stat-value i {
    color: #8b5cf6;
}

/* Main Layout Grid: Story & Sidebar */
.exp-content-layout {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 40px;
    align-items: start;
    margin-bottom: 60px;
}

/* Left Narrative Column */
.exp-story-column {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid var(--border-light, #e2e8f0);
    padding: 38px 42px;
    box-shadow: 0 4px 16px rgba(14, 27, 61, 0.04);
}

.exp-story-heading {
    font-family: var(--font-heading, 'Playfair Display', serif);
    font-size: 2rem;
    color: var(--deep-navy, #0e1b3d);
    margin: 0 0 20px 0;
    font-weight: 700;
}

.exp-story-body {
    font-size: 1.12rem;
    line-height: 1.85;
    color: #334155;
    margin-bottom: 35px;
}

/* Highlight Features */
.exp-highlights-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--deep-navy, #0e1b3d);
    margin-bottom: 18px;
}

.exp-highlight-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.exp-highlight-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    transition: var(--transition, all 0.25s ease);
}

.exp-highlight-box:hover {
    border-color: #8b5cf6;
    background: #ffffff;
    box-shadow: 0 4px 14px rgba(139, 92, 246, 0.08);
}

.exp-highlight-box i {
    font-size: 1.3rem;
    color: #8b5cf6;
    margin-top: 2px;
}

.exp-highlight-box h4 {
    margin: 0 0 4px 0;
    font-size: 1rem;
    font-weight: 700;
    color: var(--deep-navy, #0e1b3d);
}

.exp-highlight-box p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
    line-height: 1.5;
}

/* Right Sticky Booking Card */
.exp-booking-card {
    background: #ffffff;
    border: 1px solid var(--border-light, #e2e8f0);
    border-radius: 16px;
    padding: 32px 28px;
    box-shadow: 0 10px 30px rgba(14, 27, 61, 0.08);
    position: sticky;
    top: 130px;
}

.booking-card-tag {
    color: #8b5cf6;
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    display: block;
    margin-bottom: 8px;
}

.booking-card-title {
    font-family: var(--font-heading, 'Playfair Display', serif);
    font-size: 1.6rem;
    color: var(--deep-navy, #0e1b3d);
    margin: 0 0 12px 0;
    font-weight: 700;
}

.booking-card-desc {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 22px;
}

.booking-perks-list {
    list-style: none;
    padding: 0;
    margin: 0 0 26px 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.booking-perks-list li {
    font-size: 0.92rem;
    color: #334155;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
}

.booking-perks-list li i {
    color: #10b981;
    font-size: 1rem;
}

.btn-exp-wa {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    background: #25d366;
    color: #ffffff !important;
    padding: 14px 20px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(37, 211, 102, 0.3);
    margin-bottom: 12px;
    transition: var(--transition, all 0.25s ease);
}

.btn-exp-wa:hover {
    background: #1eb954;
    transform: translateY(-2px);
}

.btn-exp-quote {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    background: #f1f5f9;
    color: var(--deep-navy, #0e1b3d) !important;
    padding: 13px 20px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.95rem;
    text-decoration: none;
    border: 1px solid #cbd5e1;
    transition: var(--transition, all 0.25s ease);
}

.btn-exp-quote:hover {
    background: #e2e8f0;
    color: #8b5cf6 !important;
}

.booking-card-help {
    margin-top: 18px;
    font-size: 0.85rem;
    color: #94a3b8;
    text-align: center;
}

/* Related Places Grid */
.exp-related-section {
    padding-top: 40px;
    border-top: 1px solid #e2e8f0;
}

.exp-related-title {
    font-family: var(--font-heading, 'Playfair Display', serif);
    font-size: 2rem;
    color: var(--deep-navy, #0e1b3d);
    margin-bottom: 24px;
}

/* Responsive Rules */
@media (max-width: 1024px) {
    .exp-content-layout {
        grid-template-columns: 1fr;
    }

    .exp-booking-card {
        position: static;
        margin-top: 30px;
    }

    .exp-quick-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .stat-item:nth-child(2) {
        border-right: none;
    }
}

@media (max-width: 768px) {
    .exp-details-page {
        padding-top: 110px;
    }

    .exp-page-title {
        font-size: 2.4rem;
    }

    .exp-showcase-img {
        min-height: 260px;
        max-height: 380px;
    }

    .exp-quick-stats {
        grid-template-columns: 1fr;
    }

    .stat-item {
        border-right: none;
        border-bottom: 1px solid var(--border-light, #e2e8f0);
        padding-bottom: 12px;
    }

    .stat-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .exp-highlight-grid {
        grid-template-columns: 1fr;
    }

    .exp-story-column {
        padding: 24px 20px;
    }
}
</style>

<!-- =========================================================================
     EXPERIENCE DETAILS MAIN WRAPPER
     ========================================================================= -->
<main class="exp-details-page">
    <div class="container">
        
        <!-- Breadcrumb Navigation (Clear of fixed header) -->
        <nav class="exp-page-breadcrumb" aria-label="Breadcrumb">
            <ol>
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li><a href="<?= base_url('experiences') ?>">Experiences</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li class="active"><?= e($experience['name']) ?></li>
            </ol>
        </nav>

        <!-- Page Intro & Title -->
        <header class="exp-page-header">
            <div class="exp-badge-row">
                <span class="exp-badge-pill">
                    <i class="fa-solid fa-compass"></i> <?= e($experience['category_name'] ?? 'Curated Activity') ?>
                </span>
                <span class="exp-badge-pill" style="background: rgba(16, 185, 129, 0.1); color: #059669;">
                    <i class="fa-solid fa-circle-check"></i> Available on Tour Itineraries
                </span>
            </div>

            <h1 class="exp-page-title"><?= e($experience['name']) ?></h1>
            <p class="exp-page-subtitle">
                <?= e($experience['short_description'] ?? 'Authentic handpicked Sri Lankan travel experience.') ?>
            </p>
        </header>

        <!-- =====================================================================
             COMPLETE MAIN PICTURE SHOWCASE (100% UNBLOCKED & FULLY VISIBLE)
             ===================================================================== -->
        <div class="exp-showcase-wrapper">
            <img src="<?= e($heroImgSrc) ?>" 
                 alt="<?= e($experience['name']) ?> - Sri Lanka Experience" 
                 class="exp-showcase-img" 
                 onerror="this.src='https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=1600&q=80'">
            
            <div class="exp-showcase-badge">
                <i class="fa-solid fa-camera"></i> <?= e($experience['name']) ?>, Sri Lanka
            </div>
        </div>

        <!-- Quick Facts & Travel Stats Bar -->
        <div class="exp-quick-stats">
            <div class="stat-item">
                <span class="stat-label">CATEGORY</span>
                <span class="stat-value">
                    <i class="fa-solid fa-layer-group"></i> <?= e($experience['category_name'] ?? 'Adventure & Culture') ?>
                </span>
            </div>

            <div class="stat-item">
                <span class="stat-label">STYLE</span>
                <span class="stat-value">
                    <i class="fa-solid fa-person-walking"></i> Private Guided Experience
                </span>
            </div>

            <div class="stat-item">
                <span class="stat-label">AVAILABILITY</span>
                <span class="stat-value">
                    <i class="fa-solid fa-calendar-check"></i> Daily on Request
                </span>
            </div>

            <div class="stat-item">
                <span class="stat-label">BOOKING</span>
                <span class="stat-value" style="color: #059669;">
                    <i class="fa-solid fa-shield-heart" style="color: #059669;"></i> Direct Mewa Tours Booking
                </span>
            </div>
        </div>

        <!-- Main Narrative & Booking Action Layout -->
        <div class="exp-content-layout">
            
            <!-- Left: Rich Story & Highlights -->
            <article class="exp-story-column">
                <h2 class="exp-story-heading">About This Experience</h2>
                <div class="exp-story-body">
                    <?= nl2br(e($experience['description'] ?? $experience['short_description'] ?? '')) ?>
                </div>

                <h3 class="exp-highlights-title">What Makes This Experience Special</h3>
                <div class="exp-highlight-grid">
                    <div class="exp-highlight-box">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        <div>
                            <h4>Authentic Encounters</h4>
                            <p>Engage with local hosts, natural wonders, and cultural traditions in person.</p>
                        </div>
                    </div>

                    <div class="exp-highlight-box">
                        <i class="fa-solid fa-heart"></i>
                        <div>
                            <h4>Personalised Pacing</h4>
                            <p>Tailored around your schedule without rush or crowded tour groups.</p>
                        </div>
                    </div>

                    <div class="exp-highlight-box">
                        <i class="fa-solid fa-shield-halved"></i>
                        <div>
                            <h4>Local Knowledge</h4>
                            <p>Guided by experienced professionals passionate about sharing Sri Lanka.</p>
                        </div>
                    </div>

                    <div class="exp-highlight-box">
                        <i class="fa-solid fa-route"></i>
                        <div>
                            <h4>Custom Package Add-on</h4>
                            <p>Can be included seamlessly in any Mewa Tours multi-day itinerary.</p>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Right: Sticky Booking & WhatsApp Inquiry -->
            <aside class="exp-booking-card">
                <span class="booking-card-tag"><i class="fa-solid fa-compass"></i> Handcrafted Experience</span>
                <h3 class="booking-card-title">Book This Experience</h3>
                <p class="booking-card-desc">
                    Connect directly with our local Sri Lankan travel specialists to book or incorporate this experience into your personalized itinerary.
                </p>

                <ul class="booking-perks-list">
                    <li><i class="fa-solid fa-check"></i> Private driver-guided activity</li>
                    <li><i class="fa-solid fa-check"></i> Flexible timing &amp; custom route</li>
                    <li><i class="fa-solid fa-check"></i> Direct WhatsApp communication</li>
                    <li><i class="fa-solid fa-check"></i> No upfront credit card fees</li>
                </ul>

                <a href="<?= e($experience['whatsapp_url'] ?? $generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn-exp-wa">
                    <i class="fa-brands fa-whatsapp fa-lg"></i> Inquire via WhatsApp
                </a>

                <a href="<?= base_url('contact?experience=' . urlencode($experience['name'])) ?>" class="btn-exp-quote">
                    <i class="fa-solid fa-envelope"></i> Request Custom Quote
                </a>

                <p class="booking-card-help">
                    <i class="fa-solid fa-lock"></i> 100% Free Consultation &amp; Itinerary Planning
                </p>
            </aside>
        </div>

        <!-- =====================================================================
             RELATED EXPERIENCES TO EXPLORE NEXT
             ===================================================================== -->
        <?php if (!empty($related_experiences)): ?>
        <section class="exp-related-section">
            <h2 class="exp-related-title">More Experiences to Enjoy</h2>
            <div class="experiences-collection-grid">
                <?php foreach ($related_experiences as $relExp): 
                    $relImg = !empty($relExp['featured_image'])
                        ? ((strpos($relExp['featured_image'], 'http') === 0) ? $relExp['featured_image'] : asset_url('images/' . e($relExp['featured_image'])))
                        : asset_url('images/experiences/hero-experiences-safari.jpg');
                ?>
                    <article class="exp-collection-card" data-reveal>
                        <div class="exp-card-image-wrap">
                            <img src="<?= e($relImg) ?>" alt="<?= e($relExp['name']) ?>" class="exp-card-img" onerror="this.src='https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80'">
                            <span class="exp-card-tag"><?= e($relExp['category_name'] ?? 'Experience') ?></span>
                        </div>

                        <div class="exp-card-body">
                            <h3 class="exp-card-title"><?= e($relExp['name']) ?></h3>
                            <p class="exp-card-desc"><?= e($relExp['description'] ?? $relExp['short_description'] ?? '') ?></p>

                            <div class="exp-card-action-bar">
                                <a href="<?= base_url('experiences/' . e($relExp['slug'])) ?>" class="link-explore-exp">
                                    Explore Experience <i class="fa-solid fa-arrow-right"></i>
                                </a>
                                <a href="<?= e($relExp['whatsapp_url'] ?? $generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="link-wa-icon" title="Inquire about <?= e($relExp['name']) ?>">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

    </div>
</main>

<?php render_partial('footer'); ?>
