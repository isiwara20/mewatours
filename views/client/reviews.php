<?php
/**
 * Mewa Tours - Public Customer Reviews & Feedback View
 */
require_once ROOT_PATH . '/views/partials/header.php';

$stats = $statistics ?? [
    'total_reviews' => 0,
    'average_rating' => 5.0,
    'count_5' => 0,
    'count_4' => 0,
    'count_3' => 0,
    'count_2' => 0,
    'count_1' => 0
];
$totalCount = max(1, (int)$stats['total_reviews']);
?>
<link rel="stylesheet" href="<?= asset_url('css/reviews.css') ?>">

<!-- Reviews Hero Banner -->
<section class="reviews-hero-section">
    <div class="container">
        <h1 class="reviews-hero-title">Traveler Reviews & Experiences</h1>
        <p class="reviews-hero-subtitle">
            Read real stories and feedback from guests who explored Sri Lanka with Mewa Tours, or share your own journey experience with us!
        </p>
    </div>
</section>

<!-- Rating Summary Header -->
<div class="container">
    <div class="rating-summary-wrapper">
        <!-- Average Score Box -->
        <div class="score-badge-box">
            <span class="score-big"><?= number_format((float)$stats['average_rating'], 1) ?></span>
            <div class="stars-row">
                <?php
                $fullStars = floor((float)$stats['average_rating']);
                for ($i = 1; $i <= 5; $i++):
                    if ($i <= $fullStars):
                ?>
                        <i class="fa-solid fa-star"></i>
                    <?php else: ?>
                        <i class="fa-regular fa-star"></i>
                <?php
                    endif;
                endfor;
                ?>
            </div>
            <span class="total-count-label">Based on <?= $stats['total_reviews'] ?> traveler reviews</span>
        </div>

        <!-- Rating Progress Bars -->
        <div class="rating-bars-container">
            <?php for ($star = 5; $star >= 1; $star--):
                $starCount = (int)($stats['count_' . $star] ?? 0);
                $percent = round(($starCount / $totalCount) * 100);
            ?>
                <div class="bar-row">
                    <div class="bar-star-label">
                        <span><?= $star ?></span> <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="bar-track">
                        <div class="bar-fill" style="width: <?= $percent ?>%;"></div>
                    </div>
                    <div class="bar-count-num"><?= $starCount ?></div>
                </div>
            <?php endfor; ?>
        </div>

        <!-- Write Feedback CTA -->
        <div class="write-cta-box">
            <h4 style="font-weight: 700; color: var(--brand-blue); margin-bottom: 8px;">Traveled With Us?</h4>
            <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 16px;">We would love to hear about your experience!</p>
            <a href="#writeReviewForm" class="btn btn-write-review">
                <i class="fa-solid fa-pen-to-square"></i> Share Your Review
            </a>
        </div>
    </div>
</div>

<!-- Main Reviews Section -->
<section class="reviews-section-content">
    <div class="container">

        <!-- Flash Messages -->
        <?php if (has_flash('review_success')): ?>
            <div class="alert alert-success" style="margin-bottom: 30px;">
                <i class="fa-solid fa-circle-check"></i> <?= get_flash('review_success') ?>
            </div>
        <?php endif; ?>

        <?php if (has_flash('review_error')): ?>
            <div class="alert alert-danger" style="margin-bottom: 30px;">
                <i class="fa-solid fa-circle-exclamation"></i> <?= get_flash('review_error') ?>
            </div>
        <?php endif; ?>

        <!-- Write Review Form Card -->
        <div class="review-form-card" id="writeReviewForm">
            <h3 class="form-header-title"><i class="fa-solid fa-heart" style="color: var(--brand-coral);"></i> Leave Your Traveler Feedback</h3>
            <p class="form-header-sub">Your review helps future travelers plan their dream holiday in Sri Lanka.</p>

            <form action="<?= base_url('reviews') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">

                <div class="form-row" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; margin-bottom: 20px;">
                    <div class="form-group">
                        <label for="customer_name">Your Full Name <span style="color: red;">*</span></label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control" required placeholder="e.g. David Miller" value="<?= old_input('customer_name') ?>">
                    </div>
                    <div class="form-group">
                        <label for="customer_email">Email Address <span style="color: red;">*</span></label>
                        <input type="email" id="customer_email" name="customer_email" class="form-control" required placeholder="e.g. david@example.com" value="<?= old_input('customer_email') ?>">
                    </div>
                    <div class="form-group">
                        <label for="customer_country">Your Country / Nationality</label>
                        <input type="text" id="customer_country" name="customer_country" class="form-control" placeholder="e.g. Australia, Germany, UK" value="<?= old_input('customer_country') ?>">
                    </div>
                </div>

                <div class="form-row" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; margin-bottom: 20px;">
                    <div class="form-group">
                        <label for="tour_id">Tour Package Experienced (Optional)</label>
                        <select id="tour_id" name="tour_id" class="form-control">
                            <option value="">-- General Sri Lanka Tour Experience --</option>
                            <?php if (!empty($tours)): foreach ($tours as $t): ?>
                                <option value="<?= $t['id'] ?>" <?= (old_input('tour_id') == $t['id'] || ($selected_tour_id == $t['id'])) ? 'selected' : '' ?>>
                                    <?= e($t['title']) ?> (<?= $t['duration_days'] ?> Days)
                                </option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Feedback Category</label>
                        <select id="category" name="category" class="form-control">
                            <option value="Tour Experience">Tour Experience & Itinerary</option>
                            <option value="Driver & Guide">Driver & Tour Guide Service</option>
                            <option value="Wildlife & Safaris">Wildlife & Safaris</option>
                            <option value="Heritage & Culture">Heritage & Cultural Sites</option>
                            <option value="Accommodation">Hotels & Accommodation</option>
                            <option value="General Suggestion">General Website Feedback</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Your Overall Rating <span style="color: red;">*</span></label>
                        <div class="interactive-rating-picker">
                            <input type="radio" id="star5" name="rating" value="5" checked>
                            <label for="star5" title="5 Stars - Outstanding"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" title="4 Stars - Very Good"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" title="3 Stars - Good"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" title="2 Stars - Fair"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" title="1 Star - Poor"><i class="fa-solid fa-star"></i></label>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="title">Review Title / Headline <span style="color: red;">*</span></label>
                    <input type="text" id="title" name="title" class="form-control" required placeholder="e.g. Unforgettable 10-day tour with incredible hospitality!" value="<?= old_input('title') ?>">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="comment">Your Detailed Feedback & Memories <span style="color: red;">*</span></label>
                    <textarea id="comment" name="comment" rows="4" class="form-control" required placeholder="Tell us what you enjoyed most about your trip, tour guide, places visited..."><?= old_input('comment') ?></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 25px;">
                    <label for="review_photo">Upload Trip Photo (Optional JPG/PNG)</label>
                    <input type="file" id="review_photo" name="review_photo" class="form-control" accept="image/jpeg,image/png,image/webp">
                </div>

                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-weight: 700;">
                    <i class="fa-solid fa-paper-plane"></i> Submit Feedback
                </button>
            </form>
        </div>

        <!-- Traveler Reviews Grid Header -->
        <div class="reviews-grid-header">
            <h3 class="reviews-grid-title"><i class="fa-solid fa-comments"></i> Verified Traveler Reviews</h3>
            <span style="font-size: 0.95rem; color: var(--text-muted);">Showing <?= count($reviews) ?> reviews</span>
        </div>

        <!-- Reviews Grid Cards -->
        <?php if (!empty($reviews)): ?>
            <div class="reviews-grid">
                <?php foreach ($reviews as $rev): ?>
                    <div class="review-card">
                        <div>
                            <div class="review-card-top">
                                <div class="traveler-info">
                                    <div class="avatar-circle">
                                        <?= strtoupper(substr($rev['customer_name'], 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div class="traveler-name"><?= e($rev['customer_name']) ?></div>
                                        <div class="traveler-country">
                                            <i class="fa-solid fa-location-dot" style="color: var(--brand-coral);"></i> <?= e($rev['customer_country'] ?: 'Traveler') ?>
                                        </div>
                                    </div>
                                </div>
                                <span class="verified-badge">
                                    <i class="fa-solid fa-circle-check"></i> Verified
                                </span>
                            </div>

                            <!-- Star Rating -->
                            <div class="review-card-stars">
                                <?php for ($s = 1; $s <= 5; $s++): ?>
                                    <?php if ($s <= $rev['rating']): ?>
                                        <i class="fa-solid fa-star"></i>
                                    <?php else: ?>
                                        <i class="fa-regular fa-star"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>

                            <?php if (!empty($rev['tour_title'])): ?>
                                <div class="tour-tag-pill">
                                    <i class="fa-solid fa-route"></i> <?= e($rev['tour_title']) ?>
                                </div>
                            <?php endif; ?>

                            <h4 class="review-card-headline"><?= e($rev['title']) ?></h4>
                            <p class="review-card-text"><?= nl2br(e($rev['comment'])) ?></p>

                            <?php if (!empty($rev['photo_path'])): ?>
                                <img src="<?= asset_url($rev['photo_path']) ?>" alt="Traveler Photo" class="review-photo-thumbnail">
                            <?php endif; ?>
                        </div>

                        <div>
                            <div style="font-size: 0.8rem; color: #94a3b8; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 12px; margin-top: 10px;">
                                <span><i class="fa-regular fa-calendar-check"></i> <?= date('M d, Y', strtotime($rev['created_at'])) ?></span>
                                <span><i class="fa-solid fa-tag"></i> <?= e($rev['category']) ?></span>
                            </div>

                            <?php if (!empty($rev['admin_reply'])): ?>
                                <div class="admin-response-quote">
                                    <div class="admin-response-title"><i class="fa-solid fa-reply"></i> Mewa Tours Response:</div>
                                    <div><?= e($rev['admin_reply']) ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center" style="padding: 50px; background: #ffffff; border-radius: var(--radius-md); box-shadow: 0 4px 16px rgba(0,0,0,0.05);">
                <i class="fa-solid fa-star-half-stroke" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 15px;"></i>
                <h4>Be the first to leave a review!</h4>
                <p style="color: var(--text-muted);">Share your feedback about your Sri Lanka tour with Mewa Tours above.</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once ROOT_PATH . '/views/partials/footer.php'; ?>
