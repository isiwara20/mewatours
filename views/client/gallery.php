<?php 
render_partial('header', ['page_title' => 'Photo Gallery - Mewa Tours Sri Lanka']); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildGeneralInquiryMessage());

$categoryLabels = [
    'all' => 'All Moments',
    'wildlife' => 'Wildlife & Safaris',
    'culture' => 'Cultural Heritage',
    'culinary' => 'Culinary & Village',
    'highlands' => 'Highlands & Hikes',
    'experiences' => 'Island Experiences'
];
?>

<!-- Hero Banner Section -->
<section class="gallery-hero">
    <div class="container">
        <h1 class="gallery-hero-title">Moments From Sri Lanka</h1>
        <p class="gallery-hero-subtitle">
            Explore authentic guest experiences, wild safari encounters, ancient heritage sites, and local village life across the island.
        </p>
    </div>
</section>

<div class="container" style="padding: 20px 0 60px 0;">
    <!-- Category Filter Tabs -->
    <div class="gallery-filter-wrapper">
        <button class="filter-btn active" data-filter="all">
            <i class="fa-solid fa-layer-group"></i> All Moments (<?= count($gallery_items ?? []) ?>)
        </button>
        <button class="filter-btn" data-filter="wildlife">
            <i class="fa-solid fa-hippo"></i> Wildlife & Safaris
        </button>
        <button class="filter-btn" data-filter="culture">
            <i class="fa-solid fa-landmark"></i> Cultural Heritage
        </button>
        <button class="filter-btn" data-filter="culinary">
            <i class="fa-solid fa-utensils"></i> Culinary & Village
        </button>
        <button class="filter-btn" data-filter="highlands">
            <i class="fa-solid fa-mountain"></i> Highlands & Hikes
        </button>
        <button class="filter-btn" data-filter="experiences">
            <i class="fa-solid fa-compass"></i> Island Experiences
        </button>
    </div>

    <!-- Gallery Grid -->
    <?php if (empty($gallery_items)): ?>
        <div style="text-align: center; padding: 60px 20px; background: #f8fafc; border-radius: 16px; border: 1px dashed #cbd5e1;">
            <i class="fa-solid fa-images" style="font-size: 3rem; color: #94a3b8; margin-bottom: 15px;"></i>
            <h3 style="color: #334155; font-weight: 600;">No Gallery Photos Available</h3>
            <p style="color: #64748b;">Check back soon for new travel highlights from Sri Lanka.</p>
        </div>
    <?php else: ?>
        <div class="gallery-grid-container" id="galleryGrid">
            <?php foreach ($gallery_items as $index => $item): ?>
                <?php
                    $img = $item['image'];
                    // Format asset image URL properly
                    if (strpos($img, 'http') === 0) {
                        $imgUrl = $img;
                    } elseif (strpos($img, '/') !== false) {
                        $imgUrl = asset_url('images/' . ltrim($img, '/'));
                    } else {
                        $imgUrl = asset_url('images/Gallery/' . $img);
                    }

                    $cat = strtolower($item['category'] ?? 'experiences');
                    $badgeName = $categoryLabels[$cat] ?? ucfirst($cat);
                    $title = $item['title'] ?? 'Mewa Tours Moment';
                    $desc = $item['description'] ?? $item['alt_text'] ?? 'Authentic travel experience in Sri Lanka with Mewa Tours.';
                ?>
                <div class="gallery-card" 
                     data-category="<?= e($cat) ?>" 
                     data-full-img="<?= e($imgUrl) ?>"
                     data-title="<?= e($title) ?>"
                     data-desc="<?= e($desc) ?>">
                    
                    <div class="gallery-card-img-wrapper">
                        <span class="gallery-category-badge"><?= e($badgeName) ?></span>
                        <img src="<?= e($imgUrl) ?>" alt="<?= e($item['alt_text'] ?? $title) ?>" class="gallery-card-img" loading="lazy">
                        <div class="gallery-card-overlay">
                            <div class="zoom-icon-btn" title="View Photo Fullscreen">
                                <i class="fa-solid fa-expand"></i>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-card-content">
                        <h3 class="gallery-card-title"><?= e($title) ?></h3>
                        <p class="gallery-card-desc"><?= e($desc) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Interactive Lightbox Modal -->
<div class="lightbox-modal" id="lightboxModal">
    <button class="lightbox-close-btn" id="lightboxCloseBtn" title="Close (Esc)">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <button class="lightbox-nav-btn lightbox-prev-btn" id="lightboxPrevBtn" title="Previous (Left Arrow)">
        <i class="fa-solid fa-chevron-left"></i>
    </button>
    <button class="lightbox-nav-btn lightbox-next-btn" id="lightboxNextBtn" title="Next (Right Arrow)">
        <i class="fa-solid fa-chevron-right"></i>
    </button>

    <div class="lightbox-content-box">
        <div class="lightbox-img-container">
            <img src="" alt="" id="lightboxImg" class="lightbox-img">
        </div>
        <div class="lightbox-info-bar">
            <div class="lightbox-text-group">
                <h3 id="lightboxTitle" class="lightbox-title"></h3>
                <p id="lightboxCaption" class="lightbox-caption"></p>
            </div>
            <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="lightbox-wa-cta" id="lightboxWaCta">
                <i class="fa-brands fa-whatsapp"></i> Inquire About This Experience
            </a>
        </div>
    </div>
</div>

<script src="<?= asset_url('js/gallery.js') ?>"></script>

<?php render_partial('footer'); ?>
