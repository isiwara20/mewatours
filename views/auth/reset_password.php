<?php
/**
 * Admin Reset Password - Set New Password View
 */
$pageTitle = $page_title ?? 'Set New Password - Mewa Tours';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    
    <link rel="icon" type="image/png" href="<?= asset_url('images/branding/favicon.png') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= asset_url('images/branding/favicon.ico') ?>">
    <link rel="apple-touch-icon" href="<?= asset_url('images/branding/favicon.png') ?>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    <link rel="stylesheet" href="<?= asset_url('css/variables.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/reset.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/auth.css') ?>">
</head>
<body class="auth-body">

    <div class="auth-card">
        <div class="auth-header text-center">
            <img src="<?= asset_url('images/branding/logo.png') ?>" alt="Mewa Tours" class="auth-logo" onerror="this.src='https://placehold.co/180x60/ffffff/004080?text=MEWA+TOURS'">
            <h1 class="auth-title">Set New Password</h1>
            <p class="auth-subtitle">WhatsApp OTP Verified Successfully</p>
        </div>

        <?php render_partial('flash-messages'); ?>

        <form action="<?= base_url('reset-password') ?>" method="POST" class="auth-form">
            <?= CsrfService::inputField() ?>

            <div class="form-group">
                <label for="new_password"><i class="fa-solid fa-lock"></i> New Admin Password</label>
                <input type="password" id="new_password" name="new_password" required minlength="6" autofocus placeholder="••••••••••••" class="form-control">
                <small style="color: #64748b; font-size: 0.78rem; margin-top: 4px; display: block;">Must be at least 6 characters long.</small>
            </div>

            <div class="form-group">
                <label for="confirm_password"><i class="fa-solid fa-lock-check"></i> Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required minlength="6" placeholder="••••••••••••" class="form-control">
            </div>

            <button type="submit" class="btn btn-auth-submit" style="background: #10b981 !important; color: white !important;">
                <i class="fa-solid fa-circle-check"></i> Update Password & Sign In
            </button>
        </form>

        <div class="auth-footer text-center" style="margin-top: 20px;">
            <a href="<?= base_url('login') ?>" class="back-home-link"><i class="fa-solid fa-arrow-left"></i> Cancel & Back to Login</a>
        </div>
    </div>

</body>
</html>
