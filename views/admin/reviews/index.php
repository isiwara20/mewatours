<?php render_partial('admin-header', ['page_title' => 'Manage Customer Reviews - Admin Portal']); ?>

<div class="admin-page-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 25px;">
    <div>
        <h2 style="color: #0f172a; margin: 0;"><i class="fa-solid fa-star" style="color: #f59e0b;"></i> Customer Reviews Management</h2>
        <p class="text-muted" style="margin: 5px 0 0 0;">Moderate traveler ratings, manage review approval statuses, toggle featured showcases, and post official administrator responses.</p>
    </div>
</div>

<!-- Stats Counter Grid -->
<div class="stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 25px;">
    <div style="background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-left: 4px solid #f59e0b;">
        <span style="font-size: 0.8rem; text-transform: uppercase; font-weight: 700; color: #64748b;">Average Score</span>
        <h3 style="font-size: 1.8rem; color: #0f172a; margin: 5px 0 0 0; display: flex; align-items: center; gap: 8px;">
            <?= number_format((float)($stats['average_rating'] ?? 5.0), 1) ?> <span style="font-size: 1.2rem; color: #f59e0b;">★</span>
        </h3>
    </div>

    <div style="background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-left: 4px solid #004080;">
        <span style="font-size: 0.8rem; text-transform: uppercase; font-weight: 700; color: #64748b;">Total Published</span>
        <h3 style="font-size: 1.8rem; color: #0f172a; margin: 5px 0 0 0;"><?= (int)($stats['total_reviews'] ?? 0) ?></h3>
    </div>

    <div style="background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-left: 4px solid #16a34a;">
        <span style="font-size: 0.8rem; text-transform: uppercase; font-weight: 700; color: #64748b;">5-Star Reviews</span>
        <h3 style="font-size: 1.8rem; color: #16a34a; margin: 5px 0 0 0;"><?= (int)($stats['count_5'] ?? 0) ?></h3>
    </div>

    <div style="background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-left: 4px solid #8b5cf6;">
        <span style="font-size: 0.8rem; text-transform: uppercase; font-weight: 700; color: #64748b;">Total Reviews Count</span>
        <h3 style="font-size: 1.8rem; color: #8b5cf6; margin: 5px 0 0 0;"><?= count($reviews) ?></h3>
    </div>
</div>

<!-- Filter Tabs Bar -->
<div style="display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap;">
    <a href="<?= base_url('admin/reviews.php') ?>" style="padding: 8px 16px; border-radius: 20px; font-size: 0.88rem; font-weight: 600; text-decoration: none; <?= empty($currentFilter) ? 'background: #004080; color: #fff;' : 'background: #e2e8f0; color: #475569;' ?>">
        All Reviews (<?= count($reviews) ?>)
    </a>
    <a href="<?= base_url('admin/reviews.php?status=APPROVED') ?>" style="padding: 8px 16px; border-radius: 20px; font-size: 0.88rem; font-weight: 600; text-decoration: none; <?= ($currentFilter === 'APPROVED') ? 'background: #16a34a; color: #fff;' : 'background: #e2e8f0; color: #475569;' ?>">
        Approved
    </a>
    <a href="<?= base_url('admin/reviews.php?status=PENDING') ?>" style="padding: 8px 16px; border-radius: 20px; font-size: 0.88rem; font-weight: 600; text-decoration: none; <?= ($currentFilter === 'PENDING') ? 'background: #d97706; color: #fff;' : 'background: #e2e8f0; color: #475569;' ?>">
        Pending
    </a>
    <a href="<?= base_url('admin/reviews.php?status=REJECTED') ?>" style="padding: 8px 16px; border-radius: 20px; font-size: 0.88rem; font-weight: 600; text-decoration: none; <?= ($currentFilter === 'REJECTED') ? 'background: #dc2626; color: #fff;' : 'background: #e2e8f0; color: #475569;' ?>">
        Rejected
    </a>
    <a href="<?= base_url('admin/reviews.php?status=FEATURED') ?>" style="padding: 8px 16px; border-radius: 20px; font-size: 0.88rem; font-weight: 600; text-decoration: none; <?= ($currentFilter === 'FEATURED') ? 'background: #f59e0b; color: #fff;' : 'background: #e2e8f0; color: #475569;' ?>">
        ★ Featured Only
    </a>
</div>

<!-- Reviews Table Card -->
<div class="admin-table-card" style="background: #ffffff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
    <?php if (empty($reviews)): ?>
        <p class="text-muted" style="text-align: center; padding: 40px;">No reviews found for this selection.</p>
    <?php else: ?>
        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="admin-data-table" style="width: 100%; border-collapse: collapse; text-align: left; min-width: 900px;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0; color: #64748b; font-size: 0.85rem; text-transform: uppercase;">
                        <th style="padding: 12px 10px; width: 50px;">ID</th>
                        <th style="padding: 12px 10px; width: 180px;">Customer Info</th>
                        <th style="padding: 12px 10px; width: 100px;">Rating</th>
                        <th style="padding: 12px 10px;">Review Title & Comment</th>
                        <th style="padding: 12px 10px; width: 100px;">Photo</th>
                        <th style="padding: 12px 10px; width: 100px;">Status</th>
                        <th style="padding: 12px 10px; text-align: right; width: 220px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reviews as $rev): ?>
                        <tr style="border-bottom: 1px solid #f1f5f9; vertical-align: top;">
                            <td style="padding: 14px 10px; font-weight: 600; color: #475569;">#<?= $rev['id'] ?></td>
                            
                            <!-- Customer Info -->
                            <td style="padding: 14px 10px;">
                                <strong style="color: #0f172a; display: block; font-size: 0.95rem;"><?= e($rev['customer_name']) ?></strong>
                                <small style="color: #64748b; display: block; word-break: break-all; margin-bottom: 4px;"><?= e($rev['customer_email']) ?></small>
                                <span style="font-size: 0.75rem; background: #f1f5f9; color: #334155; padding: 2px 6px; border-radius: 4px; font-weight: 600;">
                                    📍 <?= e($rev['customer_country'] ?? 'Sri Lanka') ?>
                                </span>
                            </td>

                            <!-- Rating -->
                            <td style="padding: 14px 10px;">
                                <div style="color: #f59e0b; font-size: 0.9rem; margin-bottom: 4px;">
                                    <?php for ($s = 1; $s <= 5; $s++): ?>
                                        <i class="<?= ($s <= (int)$rev['rating']) ? 'fa-solid fa-star' : 'fa-regular fa-star' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <span style="font-size: 0.75rem; font-weight: 700; color: #334155;"><?= (int)$rev['rating'] ?> / 5 Stars</span>
                            </td>

                            <!-- Title & Comment -->
                            <td style="padding: 14px 10px;">
                                <strong style="color: #0f172a; display: block; font-size: 0.95rem; margin-bottom: 4px;"><?= e($rev['title']) ?></strong>
                                <p style="color: #475569; font-size: 0.88rem; margin: 0 0 8px 0; line-height: 1.5; word-wrap: break-word; overflow-wrap: break-word;">
                                    <?= nl2br(e($rev['comment'])) ?>
                                </p>

                                <?php if (!empty($rev['tour_title'])): ?>
                                    <span style="font-size: 0.75rem; color: #0284c7; background: #e0f2fe; padding: 2px 8px; border-radius: 4px; font-weight: 600; display: inline-block; margin-bottom: 6px;">
                                        Tour: <?= e($rev['tour_title']) ?>
                                    </span>
                                <?php endif; ?>

                                <?php if (!empty($rev['admin_reply'])): ?>
                                    <div style="background: #f8fafc; border-left: 3px solid #004080; padding: 8px 12px; border-radius: 0 6px 6px 0; margin-top: 6px;">
                                        <strong style="color: #004080; font-size: 0.75rem; display: block;"><i class="fa-solid fa-reply"></i> Official Admin Reply:</strong>
                                        <span style="font-size: 0.82rem; color: #334155; display: block;"><?= nl2br(e($rev['admin_reply'])) ?></span>
                                    </div>
                                <?php endif; ?>
                            </td>

                            <!-- Photo Thumbnail -->
                            <td style="padding: 14px 10px;">
                                <?php if (!empty($rev['photo_path'])): ?>
                                    <?php 
                                        $rawPhoto = ltrim($rev['photo_path'], '/');
                                        if (strpos($rawPhoto, 'http://') === 0 || strpos($rawPhoto, 'https://') === 0) {
                                            $imgSrc = $rawPhoto;
                                        } elseif (strpos($rawPhoto, 'images/') === 0) {
                                            $imgSrc = asset_url(substr($rawPhoto, 7));
                                        } else {
                                            $imgSrc = asset_url('images/' . $rawPhoto);
                                        }
                                    ?>
                                    <button type="button" class="btn-open-photo-modal" data-img-url="<?= e($imgSrc) ?>" data-customer="<?= e($rev['customer_name']) ?>" style="background: none; border: none; padding: 0; cursor: pointer; text-align: left;" title="Click to view full photo">
                                        <img src="<?= e($imgSrc) ?>" alt="Trip Photo" style="width: 55px; height: 55px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; transition: transform 0.2s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'" onerror="this.src='https://placehold.co/100x100?text=Photo'">
                                    </button>
                                <?php else: ?>
                                    <span style="font-size: 0.75rem; color: #94a3b8;">No Photo</span>
                                <?php endif; ?>
                            </td>

                            <!-- Status & Featured Badges -->
                            <td style="padding: 14px 10px;">
                                <?php if ($rev['status'] === 'APPROVED'): ?>
                                    <span style="padding: 3px 8px; background: #d1fae5; color: #065f46; border-radius: 12px; font-size: 0.75rem; font-weight: 700; display: inline-block; margin-bottom: 4px;">APPROVED</span>
                                <?php elseif ($rev['status'] === 'PENDING'): ?>
                                    <span style="padding: 3px 8px; background: #fef3c7; color: #92400e; border-radius: 12px; font-size: 0.75rem; font-weight: 700; display: inline-block; margin-bottom: 4px;">PENDING</span>
                                <?php else: ?>
                                    <span style="padding: 3px 8px; background: #fee2e2; color: #991b1b; border-radius: 12px; font-size: 0.75rem; font-weight: 700; display: inline-block; margin-bottom: 4px;">REJECTED</span>
                                <?php endif; ?>

                                <?php if (!empty($rev['is_featured'])): ?>
                                    <span style="padding: 2px 6px; background: #fef3c7; color: #b45309; border-radius: 4px; font-size: 0.7rem; font-weight: 700; display: block;">★ Featured</span>
                                <?php endif; ?>
                            </td>

                            <!-- Action Buttons -->
                            <td style="padding: 14px 10px; text-align: right;">
                                <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 6px;">
                                    <!-- Status Toggle Form -->
                                    <form method="POST" action="<?= base_url('admin/reviews.php?action=update_status') ?>" style="margin: 0;">
                                        <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
                                        <input type="hidden" name="id" value="<?= $rev['id'] ?>">
                                        
                                        <?php if ($rev['status'] !== 'APPROVED'): ?>
                                            <button type="submit" name="status" value="APPROVED" style="padding: 4px 10px; background: #16a34a; color: white; border: none; border-radius: 4px; font-size: 0.75rem; font-weight: 600; cursor: pointer;">
                                                <i class="fa-solid fa-check"></i> Approve
                                            </button>
                                        <?php else: ?>
                                            <button type="submit" name="status" value="REJECTED" style="padding: 4px 10px; background: #dc2626; color: white; border: none; border-radius: 4px; font-size: 0.75rem; font-weight: 600; cursor: pointer;">
                                                <i class="fa-solid fa-xmark"></i> Reject
                                            </button>
                                        <?php endif; ?>
                                    </form>

                                    <!-- Featured Toggle Form -->
                                    <form method="POST" action="<?= base_url('admin/reviews.php?action=toggle_featured') ?>" style="margin: 0;">
                                        <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
                                        <input type="hidden" name="id" value="<?= $rev['id'] ?>">
                                        <button type="submit" style="padding: 4px 10px; background: <?= !empty($rev['is_featured']) ? '#f59e0b' : '#64748b' ?>; color: white; border: none; border-radius: 4px; font-size: 0.75rem; font-weight: 600; cursor: pointer;">
                                            <i class="fa-solid fa-star"></i> <?= !empty($rev['is_featured']) ? 'Unfeature' : 'Feature' ?>
                                        </button>
                                    </form>

                                    <!-- Reply Button -->
                                    <button type="button" class="btn-open-reply-modal"
                                        data-id="<?= $rev['id'] ?>"
                                        data-customer="<?= e($rev['customer_name']) ?>"
                                        data-reply="<?= e($rev['admin_reply'] ?? '') ?>"
                                        style="padding: 4px 10px; background: #0284c7; color: white; border: none; border-radius: 4px; font-size: 0.75rem; font-weight: 600; cursor: pointer;">
                                        <i class="fa-solid fa-reply"></i> Reply
                                    </button>

                                    <!-- Delete Form -->
                                    <form method="POST" action="<?= base_url('admin/reviews.php?action=delete') ?>" onsubmit="return confirm('Are you sure you want to delete this customer review permanently?');" style="margin: 0;">
                                        <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
                                        <input type="hidden" name="id" value="<?= $rev['id'] ?>">
                                        <button type="submit" style="padding: 4px 10px; background: #ef4444; color: white; border: none; border-radius: 4px; font-size: 0.75rem; font-weight: 600; cursor: pointer;">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- =========================================================================
     ADMIN REPLY MODAL
     ========================================================================= -->
<div id="adminReplyModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(6px); z-index: 99999; justify-content: center; align-items: center; padding: 20px;">
    <div style="background: #ffffff; width: 100%; max-width: 520px; border-radius: 12px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="background: #0f172a; color: white; padding: 18px 24px; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-reply" style="color: #0284c7;"></i> Post Official Admin Response
            </h3>
            <button type="button" id="closeReplyModalBtn" style="background: transparent; border: none; color: #94a3b8; font-size: 1.4rem; cursor: pointer; line-height: 1;">&times;</button>
        </div>

        <form method="POST" action="<?= base_url('admin/reviews.php?action=reply') ?>" style="padding: 24px;">
            <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
            <input type="hidden" name="id" id="reply_review_id" value="">

            <p style="margin: 0 0 15px 0; color: #475569; font-size: 0.95rem;">
                Replying to customer review by: <strong id="reply_customer_name" style="color: #0f172a;"></strong>
            </p>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Administrator Reply Message</label>
                <textarea name="admin_reply" id="reply_message" rows="4" required class="form-control" placeholder="e.g. Thank you so much for traveling with Mewa Tours! We are delighted to hear you enjoyed your trip." style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; font-family: inherit;"></textarea>
                <small style="color: #64748b; font-size: 0.75rem; margin-top: 4px; display: block;">This official response will be publicly displayed underneath the traveler's review on the public reviews page.</small>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid #e2e8f0; padding-top: 16px;">
                <button type="button" id="cancelReplyModalBtn" style="padding: 10px 20px; background: #e2e8f0; color: #334155; border: none; border-radius: 6px; font-weight: 600; font-size: 0.9rem; cursor: pointer;">
                    Cancel
                </button>
                <button type="submit" style="padding: 10px 24px; background: #0284c7; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 0.9rem; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-paper-plane"></i> Save & Publish Reply
                </button>
            </div>
        </form>
    </div>
<!-- =========================================================================
     ADMIN PHOTO PREVIEW MODAL
     ========================================================================= -->
<div id="adminPhotoModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(8px); z-index: 999999; justify-content: center; align-items: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: 12px; max-width: 700px; width: 100%; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
        <div style="background: #0f172a; color: #ffffff; padding: 14px 20px; display: flex; justify-content: space-between; align-items: center;">
            <span style="font-weight: 700; font-size: 0.95rem;" id="photoModalCustomerTitle">Traveler Trip Photo</span>
            <button type="button" id="closePhotoModalBtn" style="background: none; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>
        <div style="padding: 20px; text-align: center; background: #090d16;">
            <img id="photoModalImage" src="" alt="Enlarged Trip Photo" style="max-width: 100%; max-height: 70vh; object-fit: contain; border-radius: 6px;">
        </div>
        <div style="padding: 12px 20px; background: #f8fafc; text-align: right; border-top: 1px solid #e2e8f0;">
            <a id="photoModalFullLink" href="" target="_blank" class="btn" style="padding: 6px 16px; background: #0284c7; color: white; border-radius: 6px; font-size: 0.85rem; font-weight: 600; text-decoration: none;">
                <i class="fa-solid fa-up-right-from-square"></i> Open Full Image
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reply Modal Logic
    const modal = document.getElementById('adminReplyModal');
    const closeBtn = document.getElementById('closeReplyModalBtn');
    const cancelBtn = document.getElementById('cancelReplyModalBtn');
    const replyBtns = document.querySelectorAll('.btn-open-reply-modal');

    const reviewIdInput = document.getElementById('reply_review_id');
    const customerNameDisplay = document.getElementById('reply_customer_name');
    const replyMessageInput = document.getElementById('reply_message');

    replyBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-id');
            const customer = btn.getAttribute('data-customer');
            const reply = btn.getAttribute('data-reply');

            reviewIdInput.value = id;
            customerNameDisplay.textContent = customer;
            replyMessageInput.value = reply;

            modal.style.display = 'flex';
        });
    });

    const closeModal = () => {
        modal.style.display = 'none';
    };

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

    // Photo Preview Modal Logic
    const photoModal = document.getElementById('adminPhotoModal');
    const closePhotoBtn = document.getElementById('closePhotoModalBtn');
    const photoBtns = document.querySelectorAll('.btn-open-photo-modal');
    const photoImg = document.getElementById('photoModalImage');
    const photoTitle = document.getElementById('photoModalCustomerTitle');
    const photoLink = document.getElementById('photoModalFullLink');

    photoBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const url = btn.getAttribute('data-img-url');
            const customer = btn.getAttribute('data-customer');

            photoImg.src = url;
            photoTitle.textContent = customer + "'s Trip Photo";
            photoLink.href = url;

            photoModal.style.display = 'flex';
        });
    });

    if (closePhotoBtn) {
        closePhotoBtn.addEventListener('click', () => {
            photoModal.style.display = 'none';
        });
    }

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
        if (e.target === photoModal) {
            photoModal.style.display = 'none';
        }
    });
});
</script>

<?php render_partial('admin-footer'); ?>
