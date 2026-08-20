<?php render_partial('header', ['page_title' => $experience['name'] . ' - Mewa Tours']); ?>

<section class="experience-details-section" style="padding: 40px 0;">
    <h2><?= e($experience['name']) ?></h2>
    <div class="description-body" style="margin: 20px 0;">
        <?= nl2br(e($experience['description'] ?? $experience['short_description'] ?? '')) ?>
    </div>
    <a href="<?= base_url('contact') ?>" class="btn btn-primary">Book Experience Inquiry</a>
</section>

<?php render_partial('footer'); ?>
