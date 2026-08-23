<?php
/**
 * Admin Forgot Password - Request Form View
 */
$pageTitle = $page_title ?? 'Reset Admin Password - Mewa Tours';
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
            <h1 class="auth-title">Reset Admin Password</h1>
            <p class="auth-subtitle"><i class="fa-brands fa-whatsapp" style="color: #25d366;"></i> WhatsApp OTP Verification System</p>
        </div>

        <?php render_partial('flash-messages'); ?>

        <form action="<?= base_url('forgot-password') ?>" method="POST" class="auth-form">
            <?= CsrfService::inputField() ?>

            <div class="form-group">
                <label for="email"><i class="fa-solid fa-envelope"></i> Registered Admin Email</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>" class="form-control" required autofocus placeholder="mewatours83@gmail.com">
                <small style="color: #64748b; margin-top: 6px; display: block; font-size: 0.8rem;">Enter your email to receive a 6-digit WhatsApp OTP verification code.</small>
            </div>

            <button type="submit" class="btn btn-auth-submit" style="background: #25d366 !important; color: white !important;">
                <i class="fa-brands fa-whatsapp"></i> Generate WhatsApp Verification OTP
            </button>
        </form>

        <div class="auth-footer text-center" style="margin-top: 20px; display: flex; justify-content: space-between;">
            <a href="<?= base_url('login') ?>" class="back-home-link"><i class="fa-solid fa-arrow-left"></i> Back to Login</a>
            <a href="<?= base_url() ?>" class="back-home-link">Public Site <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>

</body>
</html>
