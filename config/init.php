<?php
declare(strict_types=1);

/**
 * Mewa Tours - Application Bootstrap & Initialization File
 */

// Set application timezone to Sri Lanka
date_default_timezone_set('Asia/Colombo');

// Load application configuration
$appConfig = require_once __DIR__ . '/app.php';

// Define base root path constant
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}

// -----------------------------------------------------------------------------
// SECURE SESSION BOOTSTRAP
// -----------------------------------------------------------------------------
if (session_status() === PHP_SESSION_NONE) {
    $sessionName = $appConfig['session']['name'] ?? 'MEWA_SESS_ID';
    session_name($sessionName);

    $isSecure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';

    session_set_cookie_params([
        'lifetime' => $appConfig['session']['lifetime'] ?? 7200,
        'path' => '/',
        'domain' => '',
        'secure' => $isSecure,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}

// -----------------------------------------------------------------------------
// SPL AUTOLOADER FOR MVC LAYERS & SERVICES
// -----------------------------------------------------------------------------
spl_autoload_register(function (string $className) {
    $directories = [
        ROOT_PATH . '/controllers/',
        ROOT_PATH . '/bll/',
        ROOT_PATH . '/dal/',
        ROOT_PATH . '/services/'
    ];

    foreach ($directories as $directory) {
        $file = $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Load Database Singleton Class
require_once __DIR__ . '/db.php';

// -----------------------------------------------------------------------------
// LOAD REUSABLE HELPERS
// -----------------------------------------------------------------------------
require_once ROOT_PATH . '/helpers/url_helper.php';
require_once ROOT_PATH . '/helpers/security_helper.php';
require_once ROOT_PATH . '/helpers/session_helper.php';
require_once ROOT_PATH . '/helpers/view_helper.php';
require_once ROOT_PATH . '/helpers/validation_helper.php';
require_once ROOT_PATH . '/helpers/format_helper.php';
