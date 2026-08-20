<?php render_partial('header', ['page_title' => 'Page Not Found - Mewa Tours']); ?>

<div class="error-page-wrapper text-center">
    <h1 class="error-code">404</h1>
    <h2>Destination / Page Not Found</h2>
    <p class="error-text">The page or resource you are looking for may have been moved, renamed, or does not exist.</p>
    <a href="<?= base_url() ?>" class="btn btn-primary">Return to Homepage</a>
</div>

<?php render_partial('footer'); ?>
