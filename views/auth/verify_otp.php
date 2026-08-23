<?php
/**
 * Admin Forgot Password - WhatsApp OTP Verification View
 */
$pageTitle = $page_title ?? 'Verify WhatsApp OTP - Mewa Tours';
$waUrl = $wa_url ?? '#';
$resetData = $reset_data ?? [];
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

    <div class="auth-card" style="max-width: 480px;">
        <div class="auth-header text-center">
            <img src="<?= asset_url('images/branding/logo.png') ?>" alt="Mewa Tours" class="auth-logo" onerror="this.src='https://placehold.co/180x60/ffffff/004080?text=MEWA+TOURS'">
            <h1 class="auth-title">WhatsApp OTP Verification</h1>
            <p class="auth-subtitle">Verification code sent for <strong><?= e($resetData['email'] ?? '') ?></strong></p>
        </div>

        <?php render_partial('flash-messages'); ?>

        <!-- STEP 1: Direct WhatsApp Transmission Button -->
        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 18px; border-radius: 10px; margin-bottom: 25px; text-align: center;">
            <p style="color: #166534; font-size: 0.9rem; margin-bottom: 12px; font-weight: 500;">
                <i class="fa-solid fa-circle-info"></i> Click below to open WhatsApp with your pre-filled verification code:
            </p>
            <a href="<?= e($waUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn" style="background: #25d366; color: white; padding: 12px 20px; border-radius: 6px; text-decoration: none; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);">
                <i class="fa-brands fa-whatsapp" style="font-size: 1.2rem;"></i> Send OTP Code to WhatsApp Support
            </a>
            <small style="display: block; margin-top: 10px; color: #15803d; font-size: 0.78rem;">
                Your Generated 6-Digit OTP Code is: <strong style="font-size: 1rem; color: #166534; letter-spacing: 2px;"><?= e($resetData['otp'] ?? '') ?></strong>
            </small>
        </div>

        <!-- STEP 2: Submit 6-digit OTP -->
        <form action="<?= base_url('verify-otp') ?>" method="POST" class="auth-form">
            <?= CsrfService::inputField() ?>

            <div class="form-group">
                <label for="otp_code" style="font-weight: 700;"><i class="fa-solid fa-shield-halved" style="color: #0284c7;"></i> Enter 6-Digit Verification Code</label>
                <input type="text" id="otp_code" name="otp_code" maxlength="6" pattern="[0-9]{6}" class="form-control" required autofocus placeholder="e.g. <?= e($resetData['otp'] ?? '123456') ?>" style="font-size: 1.4rem; letter-spacing: 6px; text-align: center; font-weight: 800; color: #0f172a;">
            </div>

            <button type="submit" class="btn btn-auth-submit" style="background: #0284c7 !important; color: white !important;">
                <i class="fa-solid fa-key"></i> Verify & Proceed to Reset Password
            </button>
        </form>

        <div class="auth-footer text-center" style="margin-top: 20px; display: flex; justify-content: space-between;">
            <a href="<?= base_url('forgot-password') ?>" class="back-home-link"><i class="fa-solid fa-rotate-left"></i> Resend Code</a>
            <a href="<?= base_url('login') ?>" class="back-home-link">Back to Login <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>

</body>
</html>
