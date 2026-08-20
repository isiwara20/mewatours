<?php render_partial('header', ['page_title' => 'Server Error - Mewa Tours']); ?>

<div class="error-page-wrapper text-center">
    <h1 class="error-code">500</h1>
    <h2>System Exception</h2>
    <p class="error-text">An unexpected error occurred. Please try again later or contact customer support.</p>
    <a href="<?= base_url() ?>" class="btn btn-primary">Return to Homepage</a>
</div>

<?php render_partial('footer'); ?>
