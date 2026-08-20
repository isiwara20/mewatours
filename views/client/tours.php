<?php render_partial('header', ['page_title' => 'Tour Packages - Mewa Tours']); ?>

<section class="page-section" style="padding: 40px 0;">
    <h2>Sri Lanka Tour Packages</h2>
    <p>Discover customized luxury and authentic travel itineraries across Sri Lanka.</p>

    <?php if (empty($tours)): ?>
        <p class="text-muted">No tour packages available yet. Import `database/seed.sql` to view sample tours.</p>
    <?php else: ?>
        <div class="grid-layout" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;">
            <?php foreach ($tours as $tour): ?>
                <div class="card" style="border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; padding: 15px;">
                    <h3><?= e($tour['title']) ?></h3>
                    <p><?= e($tour['short_description'] ?? '') ?></p>
                    <a href="<?= base_url('tours/' . e($tour['slug'])) ?>" class="btn btn-primary" style="display: inline-block; margin-top: 10px;">View Details</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php render_partial('footer'); ?>
