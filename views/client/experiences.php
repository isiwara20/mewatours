<?php render_partial('header', ['page_title' => 'Experiences - Mewa Tours']); ?>

<section class="page-section" style="padding: 40px 0;">
    <h2>Unique Sri Lankan Experiences</h2>
    <p>Whale watching, Leopard safaris, Train journeys, Ayurveda wellness, and Culinary tours.</p>

    <?php if (empty($experiences)): ?>
        <p class="text-muted">No experience items registered yet.</p>
    <?php else: ?>
        <div class="grid-layout" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;">
            <?php foreach ($experiences as $exp): ?>
                <div class="card" style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px;">
                    <h3><?= e($exp['name']) ?></h3>
                    <p><?= e($exp['short_description'] ?? '') ?></p>
                    <a href="<?= base_url('experiences/' . e($exp['slug'])) ?>" class="btn btn-primary" style="display: inline-block; margin-top: 10px;">View Experience</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php render_partial('footer'); ?>
