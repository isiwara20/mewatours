<?php
/**
 * Private Admin Login View
 */
$pageTitle = $page_title ?? 'Admin Sign In - Mewa Tours';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    
    <!-- Favicon / Title Logo (Browser Search Bar / Tab Icon with White Background) -->
    <link rel="icon" type="image/png" href="<?= asset_url('images/branding/favicon.png') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= asset_url('images/branding/favicon.ico') ?>">
    <link rel="apple-touch-icon" href="<?= asset_url('images/branding/favicon.png') ?>">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    <!-- Styles -->
    <link rel="stylesheet" href="<?= asset_url('css/variables.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/reset.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/auth.css') ?>">
</head>
<body class="auth-body">

    <div class="auth-card">
        <div class="auth-header text-center">
            <img src="<?= asset_url('images/branding/logo.png') ?>" alt="Mewa Tours" class="auth-logo" onerror="this.src='https://placehold.co/180x60/ffffff/004080?text=MEWA+TOURS'">
            <h1 class="auth-title">Admin Portal Login</h1>
            <p class="auth-subtitle">Restricted Administrative Access</p>
        </div>

        <?php render_partial('flash-messages'); ?>

        <form action="<?= base_url('login') ?>" method="POST" class="auth-form" id="adminLoginForm">
            <?= CsrfService::inputField() ?>

            <div class="form-group">
                <label for="email"><i class="fa-solid fa-envelope"></i> Email Address</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>" class="form-control" required autofocus placeholder="mewatours83@gmail.com">
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <label for="password" style="margin-bottom: 0;"><i class="fa-solid fa-lock"></i> Password</label>
                    <a href="<?= base_url('forgot-password') ?>" style="font-size: 0.8rem; color: #4f46e5; font-weight: 600; text-decoration: none;">Forgot Password?</a>
                </div>
                <div class="password-input-wrapper">
                    <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••••••">
                    <button type="button" class="password-toggle-btn" id="togglePassword" aria-label="Toggle Password Visibility">
                        <i class="fa-regular fa-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-auth-submit"><i class="fa-solid fa-right-to-bracket"></i> Sign In to Dashboard</button>
        </form>

        <div class="auth-footer text-center">
            <a href="<?= base_url() ?>" class="back-home-link"><i class="fa-solid fa-arrow-left"></i> Return to Public Site</a>
            <div class="auth-security-note">
                <i class="fa-solid fa-shield-halved"></i> 256-Bit Encrypted Secure Session
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            if (togglePasswordBtn && passwordInput && toggleIcon) {
                togglePasswordBtn.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    toggleIcon.classList.toggle('fa-eye');
                    toggleIcon.classList.toggle('fa-eye-slash');
                });
            }
        });
    </script>

</body>
</html>
