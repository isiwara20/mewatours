<?php render_partial('header', ['page_title' => 'Destinations - Mewa Tours']); ?>

<section class="page-section" style="padding: 40px 0;">
    <h2>Explore Sri Lankan Destinations</h2>
    <p>Discover ancient kingdoms, tea country hills, wildlife reserves, and golden coasts.</p>

    <?php if (empty($destinations)): ?>
        <p class="text-muted">No destination records available yet.</p>
    <?php else: ?>
        <div class="grid-layout" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;">
            <?php foreach ($destinations as $dest): ?>
                <div class="card" style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px;">
                    <h3><?= e($dest['name']) ?></h3>
                    <p><?= e($dest['short_description'] ?? '') ?></p>
                    <a href="<?= base_url('destinations/' . e($dest['slug'])) ?>" class="btn btn-primary" style="display: inline-block; margin-top: 10px;">Explore Destination</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php render_partial('footer'); ?>
