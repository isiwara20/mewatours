<?php render_partial('header', ['page_title' => 'Photo Gallery - Mewa Tours']); ?>

<section class="gallery-section" style="padding: 40px 0;">
    <h2>Sri Lanka Travel Gallery</h2>
    <p>Visual highlights of pristine beaches, lush hills, and cultural heritage.</p>

    <?php if (empty($gallery_items)): ?>
        <p class="text-muted" style="margin-top: 20px;">No gallery photos uploaded yet.</p>
    <?php else: ?>
        <div class="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 15px; margin-top: 20px;">
            <?php foreach ($gallery_items as $item): ?>
                <div class="gallery-item">
                    <img src="<?= asset_url('images/gallery/' . e($item['image'])) ?>" alt="<?= e($item['alt_text'] ?? 'Mewa Tours Gallery') ?>" style="width: 100%; border-radius: 8px;">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php render_partial('footer'); ?>
