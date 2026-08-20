<?php render_partial('header', ['page_title' => $destination['name'] . ' - Mewa Tours']); ?>

<section class="destination-details-section" style="padding: 40px 0;">
    <h2><?= e($destination['name']) ?></h2>
    <div class="description-body" style="margin: 20px 0;">
        <?= nl2br(e($destination['description'] ?? $destination['short_description'] ?? '')) ?>
    </div>
    <a href="<?= base_url('contact') ?>" class="btn btn-primary">Plan a Trip to <?= e($destination['name']) ?></a>
</section>

<?php render_partial('footer'); ?>
