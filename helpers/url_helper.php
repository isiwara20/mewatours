<?php
declare(strict_types=1);

/**
 * Mewa Tours - URL Helpers
 */

if (!function_exists('base_url')) {
    /**
     * Get absolute or relative base URL for application routing
     */
    function base_url(string $path = ''): string
    {
        static $baseUrl = null;

        if ($baseUrl === null) {
            $config = require ROOT_PATH . '/config/app.php';
            $baseUrl = rtrim($config['base_url'] ?? '/mewatours', '/');
        }

        $cleanPath = ltrim($path, '/');
        return $cleanPath === '' ? $baseUrl : $baseUrl . '/' . $cleanPath;
    }
}

if (!function_exists('asset_url')) {
    /**
     * Get public asset URL for CSS, JS, Images, Icons
     */
    function asset_url(string $path = ''): string
    {
        return base_url('assets/' . ltrim($path, '/'));
    }
}

if (!function_exists('redirect')) {
    /**
     * Perform HTTP header redirect safely
     */
    function redirect(string $path): void
    {
        $target = (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0)
            ? $path
            : base_url($path);

        header('Location: ' . $target);
        exit;
    }
}

if (!function_exists('current_url')) {
    /**
     * Get current request URL path
     */
    function current_url(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '/';
    }
}
