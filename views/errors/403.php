<?php render_partial('header', ['page_title' => 'Access Forbidden - Mewa Tours']); ?>

<div class="error-page-wrapper text-center">
    <h1 class="error-code">403</h1>
    <h2>Access Forbidden</h2>
    <p class="error-text">You do not have permission to access this resource.</p>
    <a href="<?= base_url() ?>" class="btn btn-primary">Return to Homepage</a>
</div>

<?php render_partial('footer'); ?>
