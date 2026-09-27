<?php 
declare(strict_types=1);

/**
 * Mewa Tours - Destination Details View
 */
render_partial('header', [
    'page_title' => $page_title ?? ($destination['name'] . ' | Mewa Tours Sri Lanka')
]); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildDestinationInquiryMessage($destination['name'] ?? 'Sri Lanka'));

$heroImgSrc = !empty($destination['featured_image']) 
    ? ((strpos($destination['featured_image'], 'http') === 0) ? $destination['featured_image'] : asset_url('images/' . e($destination['featured_image'])))
    : asset_url('images/destinations/hero-destinations-sigiriya.jpg');
?>

<!-- Destination Details Stylesheet & Inline Page System -->
<link rel="stylesheet" href="<?= asset_url('css/destinations.css') ?>">

<style>
/* =========================================================================
   DESTINATION DETAILS PAGE — UNBLOCKED FULL-PICTURE SHOWCASE LAYOUT
   ========================================================================= */

/* Main page wrapper starts cleanly BELOW the 104px fixed header */
.dest-details-page {
    padding-top: 130px;
    padding-bottom: 80px;
    background-color: #fafbfc;
    min-height: 100vh;
}

/* Breadcrumb Navigation */
.dest-page-breadcrumb {
    margin-bottom: 18px;
}

.dest-page-breadcrumb ol {
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

.dest-page-breadcrumb a {
    color: var(--text-secondary, #475569);
    transition: var(--transition, all 0.25s ease);
    text-decoration: none;
}

.dest-page-breadcrumb a:hover {
    color: var(--brand-blue, #0284c7);
}

.dest-page-breadcrumb i {
    font-size: 0.68rem;
    color: #94a3b8;
}

.dest-page-breadcrumb .active {
    color: var(--brand-blue, #0284c7);
    font-weight: 700;
}

/* Header Info Banner */
.dest-page-header {
    margin-bottom: 24px;
}

.dest-badge-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.dest-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(2, 132, 199, 0.1);
    color: #0284c7;
    font-size: 0.8rem;
    font-weight: 800;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 50px;
}

.dest-page-title {
    font-family: var(--font-heading, 'Playfair Display', serif);
    font-size: 3.2rem;
    font-weight: 800;
    color: var(--deep-navy, #0e1b3d);
    line-height: 1.15;
    margin: 0 0 12px 0;
}

.dest-page-subtitle {
    font-size: 1.2rem;
    color: var(--text-secondary, #475569);
    max-width: 820px;
    line-height: 1.6;
    margin: 0;
}

/* Complete Main Picture Showcase Frame */
.dest-showcase-wrapper {
    position: relative;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 16px 36px rgba(14, 27, 61, 0.12);
    margin-bottom: 35px;
    background: #0e1b3d;
}

.dest-showcase-img {
    width: 100%;
    height: auto;
    max-height: 560px;
    min-height: 380px;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.dest-showcase-wrapper:hover .dest-showcase-img {
    transform: scale(1.015);
}

.dest-showcase-badge {
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

.dest-showcase-badge i {
    color: #38bdf8;
}

/* Quick Information Bar */
.dest-quick-stats {
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
    color: #0284c7;
}

/* Main Layout Grid: Story & Sidebar */
.dest-content-layout {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 40px;
    align-items: start;
    margin-bottom: 60px;
}

/* Left Narrative Column */
.dest-story-column {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid var(--border-light, #e2e8f0);
    padding: 38px 42px;
    box-shadow: 0 4px 16px rgba(14, 27, 61, 0.04);
}

.dest-story-heading {
    font-family: var(--font-heading, 'Playfair Display', serif);
    font-size: 2rem;
    color: var(--deep-navy, #0e1b3d);
    margin: 0 0 20px 0;
    font-weight: 700;
}

.dest-story-body {
    font-size: 1.12rem;
    line-height: 1.85;
    color: #334155;
    margin-bottom: 35px;
}

/* Highlight Features */
.dest-highlights-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--deep-navy, #0e1b3d);
    margin-bottom: 18px;
}

.dest-highlight-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.dest-highlight-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    transition: var(--transition, all 0.25s ease);
}

.dest-highlight-box:hover {
    border-color: #0284c7;
    background: #ffffff;
    box-shadow: 0 4px 14px rgba(2, 132, 199, 0.08);
}

.dest-highlight-box i {
    font-size: 1.3rem;
    color: #0284c7;
    margin-top: 2px;
}

.dest-highlight-box h4 {
    margin: 0 0 4px 0;
    font-size: 1rem;
    font-weight: 700;
    color: var(--deep-navy, #0e1b3d);
}

.dest-highlight-box p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
    line-height: 1.5;
}

/* Right Sticky Booking Card */
.dest-booking-card {
    background: #ffffff;
    border: 1px solid var(--border-light, #e2e8f0);
    border-radius: 16px;
    padding: 32px 28px;
    box-shadow: 0 10px 30px rgba(14, 27, 61, 0.08);
    position: sticky;
    top: 130px;
}

.booking-card-tag {
    color: #0284c7;
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

.btn-dest-wa {
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

.btn-dest-wa:hover {
    background: #1eb954;
    transform: translateY(-2px);
}

.btn-dest-quote {
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

.btn-dest-quote:hover {
    background: #e2e8f0;
    color: #0284c7 !important;
}

.booking-card-help {
    margin-top: 18px;
    font-size: 0.85rem;
    color: #94a3b8;
    text-align: center;
}

/* Related Places Grid */
.dest-related-section {
    padding-top: 40px;
    border-top: 1px solid #e2e8f0;
}

.dest-related-title {
    font-family: var(--font-heading, 'Playfair Display', serif);
    font-size: 2rem;
    color: var(--deep-navy, #0e1b3d);
    margin-bottom: 24px;
}

/* Responsive Rules */
@media (max-width: 1024px) {
    .dest-content-layout {
        grid-template-columns: 1fr;
    }

    .dest-booking-card {
        position: static;
        margin-top: 30px;
    }

    .dest-quick-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .stat-item:nth-child(2) {
        border-right: none;
    }
}

@media (max-width: 768px) {
    .dest-details-page {
        padding-top: 110px;
    }

    .dest-page-title {
        font-size: 2.4rem;
    }

    .dest-showcase-img {
        min-height: 260px;
        max-height: 380px;
    }

    .dest-quick-stats {
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

    .dest-highlight-grid {
        grid-template-columns: 1fr;
    }

    .dest-story-column {
        padding: 24px 20px;
    }
}
</style>

<!-- =========================================================================
     DESTINATION DETAILS MAIN WRAPPER
     ========================================================================= -->
<main class="dest-details-page">
    <div class="container">
        
        <!-- Breadcrumb Navigation (Clear of fixed header) -->
        <nav class="dest-page-breadcrumb" aria-label="Breadcrumb">
            <ol>
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li><a href="<?= base_url('destinations') ?>">Destinations</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li class="active"><?= e($destination['name']) ?></li>
            </ol>
        </nav>

        <!-- Page Intro & Title -->
        <header class="dest-page-header">
            <div class="dest-badge-row">
                <span class="dest-badge-pill">
                    <i class="fa-solid fa-location-dot"></i> <?= e($destination['short_description'] ?? 'Sri Lanka Destination') ?>
                </span>
                <span class="dest-badge-pill" style="background: rgba(16, 185, 129, 0.1); color: #059669;">
                    <i class="fa-solid fa-circle-check"></i> Available on Tour Itineraries
                </span>
            </div>

            <h1 class="dest-page-title"><?= e($destination['name']) ?></h1>
            <p class="dest-page-subtitle">
                <?= e($destination['description'] ? mb_strimwidth($destination['description'], 0, 160, '...') : ($destination['short_description'] ?? 'Explore the timeless wonders of this iconic Sri Lankan destination.')) ?>
            </p>
        </header>

        <!-- =====================================================================
             COMPLETE MAIN PICTURE SHOWCASE (100% UNBLOCKED & FULLY VISIBLE)
             ===================================================================== -->
        <div class="dest-showcase-wrapper">
            <img src="<?= e($heroImgSrc) ?>" 
                 alt="<?= e($destination['name']) ?> - Sri Lanka Destination" 
                 class="dest-showcase-img" 
                 onerror="this.src='https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=1600&q=80'">
            
            <div class="dest-showcase-badge">
                <i class="fa-solid fa-camera"></i> <?= e($destination['name']) ?>, Sri Lanka
            </div>
        </div>

        <!-- Quick Facts & Travel Stats Bar -->
        <div class="dest-quick-stats">
            <div class="stat-item">
                <span class="stat-label">REGION / CATEGORY</span>
                <span class="stat-value">
                    <i class="fa-solid fa-map"></i> <?= e($destination['short_description'] ?? 'Heritage & Nature') ?>
                </span>
            </div>

            <div class="stat-item">
                <span class="stat-label">HOW TO VISIT</span>
                <span class="stat-value">
                    <i class="fa-solid fa-car-side"></i> Private Chauffeur Tour
                </span>
            </div>

            <div class="stat-item">
                <span class="stat-label">BEST SEASON</span>
                <span class="stat-value">
                    <i class="fa-solid fa-sun"></i> Year-Round Destination
                </span>
            </div>

            <div class="stat-item">
                <span class="stat-label">TOUR ACCESS</span>
                <span class="stat-value" style="color: #059669;">
                    <i class="fa-solid fa-shield-heart" style="color: #059669;"></i> Direct Mewa Tours Booking
                </span>
            </div>
        </div>

        <!-- Main Narrative & Booking Action Layout -->
        <div class="dest-content-layout">
            
            <!-- Left: Rich Story & Highlights -->
            <article class="dest-story-column">
                <h2 class="dest-story-heading">About <?= e($destination['name']) ?></h2>
                <div class="dest-story-body">
                    <?= nl2br(e($destination['description'] ?? $destination['short_description'] ?? '')) ?>
                </div>

                <h3 class="dest-highlights-title">Why Visit <?= e($destination['name']) ?> With Mewa Tours</h3>
                <div class="dest-highlight-grid">
                    <div class="dest-highlight-box">
                        <i class="fa-solid fa-monument"></i>
                        <div>
                            <h4>Cultural Authenticity</h4>
                            <p>Discover historic landmarks and sacred sites with personal local insight.</p>
                        </div>
                    </div>

                    <div class="dest-highlight-box">
                        <i class="fa-solid fa-route"></i>
                        <div>
                            <h4>Bespoke Routing</h4>
                            <p>Seamlessly integrate <?= e($destination['name']) ?> into your multi-day island tour.</p>
                        </div>
                    </div>

                    <div class="dest-highlight-box">
                        <i class="fa-solid fa-van-shuttle"></i>
                        <div>
                            <h4>Comfort &amp; Safety</h4>
                            <p>Private, air-conditioned vehicle with a courteous, professional driver-guide.</p>
                        </div>
                    </div>

                    <div class="dest-highlight-box">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <div>
                            <h4>Flexible Pacing</h4>
                            <p>Explore at your own rhythm without crowded schedules or rushed tour buses.</p>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Right: Sticky Booking & WhatsApp Inquiry -->
            <aside class="dest-booking-card">
                <span class="booking-card-tag"><i class="fa-solid fa-compass"></i> Personalised Tour</span>
                <h3 class="booking-card-title">Plan a Journey to <?= e($destination['name']) ?></h3>
                <p class="booking-card-desc">
                    Connect directly with our local Sri Lankan travel specialists. We will craft a bespoke tour tailored to your schedule, group size, and interests.
                </p>

                <ul class="booking-perks-list">
                    <li><i class="fa-solid fa-check"></i> Private driver-guided tour</li>
                    <li><i class="fa-solid fa-check"></i> Custom route &amp; hotel flexibility</li>
                    <li><i class="fa-solid fa-check"></i> Direct WhatsApp communication</li>
                    <li><i class="fa-solid fa-check"></i> No online card payments needed</li>
                </ul>

                <a href="<?= e($destination['whatsapp_url'] ?? $generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn-dest-wa">
                    <i class="fa-brands fa-whatsapp fa-lg"></i> Inquire via WhatsApp
                </a>

                <a href="<?= base_url('contact?destination=' . urlencode($destination['name'])) ?>" class="btn-dest-quote">
                    <i class="fa-solid fa-envelope"></i> Request Custom Itinerary
                </a>

                <p class="booking-card-help">
                    <i class="fa-solid fa-lock"></i> 100% Free Consultation &amp; Itinerary Planning
                </p>
            </aside>
        </div>

        <!-- =====================================================================
             RELATED DESTINATIONS TO EXPLORE NEXT
             ===================================================================== -->
        <?php if (!empty($related_destinations)): ?>
        <section class="dest-related-section">
            <h2 class="dest-related-title">Continue Exploring Sri Lanka</h2>
            <div class="destinations-collection-grid">
                <?php foreach ($related_destinations as $relDest): 
                    $relImg = !empty($relDest['featured_image'])
                        ? ((strpos($relDest['featured_image'], 'http') === 0) ? $relDest['featured_image'] : asset_url('images/' . e($relDest['featured_image'])))
                        : asset_url('images/destinations/hero-destinations-sigiriya.jpg');
                ?>
                    <article class="dest-collection-card" data-reveal>
                        <div class="dest-card-image-wrap">
                            <img src="<?= e($relImg) ?>" alt="<?= e($relDest['name']) ?>" class="dest-card-img" onerror="this.src='https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80'">
                            <span class="dest-card-tag"><?= e($relDest['short_description'] ?? 'Destination') ?></span>
                        </div>

                        <div class="dest-card-body">
                            <h3 class="dest-card-title"><?= e($relDest['name']) ?></h3>
                            <p class="dest-card-desc"><?= e($relDest['description'] ?? '') ?></p>

                            <div class="dest-card-action-bar">
                                <a href="<?= base_url('destinations/' . e($relDest['slug'])) ?>" class="link-explore-dest">
                                    Explore Place <i class="fa-solid fa-arrow-right"></i>
                                </a>
                                <a href="<?= e($relDest['whatsapp_url'] ?? $generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="link-wa-icon" title="Inquire about <?= e($relDest['name']) ?>">
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
