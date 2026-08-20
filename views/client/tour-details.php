<?php render_partial('header', ['page_title' => $tour['title'] . ' - Mewa Tours']); ?>

<section class="tour-details-section" style="padding: 40px 0;">
    <h2><?= e($tour['title']) ?></h2>
    <p class="meta-duration"><strong>Duration:</strong> <?= e($tour['formatted_duration']) ?></p>
    <p class="meta-locations"><strong>Locations:</strong> <?= e($tour['locations'] ?? 'Sri Lanka') ?></p>

    <div class="description-body" style="margin: 20px 0;">
        <?= nl2br(e($tour['description'] ?? $tour['short_description'] ?? '')) ?>
    </div>

    <!-- Inquiry Action Buttons (No Online Payment Gateway) -->
    <div class="inquiry-actions" style="margin-top: 30px; display: flex; gap: 15px;">
        <a href="<?= e($tour['whatsapp_url']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp" style="background: #25d366; color: white; padding: 12px 20px; border-radius: 6px; text-decoration: none;">
            <i class="fa-brands fa-whatsapp"></i> Inquire via WhatsApp
        </a>
        <a href="<?= base_url('contact') ?>" class="btn btn-primary" style="padding: 12px 20px; border-radius: 6px; text-decoration: none;">
            <i class="fa-solid fa-envelope"></i> Send Email Inquiry
        </a>
    </div>
</section>

<?php render_partial('footer'); ?>
