<?php
/**
 * Flash Messages Partial Component
 */
$flashKeys = ['contact_success', 'contact_error', 'auth_success', 'auth_error', 'admin_notice'];

foreach ($flashKeys as $key):
    $flash = get_flash($key);
    if ($flash):
?>
    <div class="alert alert-<?= e($flash['type']) ?>" role="alert">
        <?= e($flash['message']) ?>
    </div>
<?php 
    endif;
endforeach; 
?>
