<?php
declare(strict_types=1);

/**
 * Mewa Tours - Session & Auth Helper Functions
 */

if (!function_exists('set_flash')) {
    /**
     * Set a flash notification message
     */
    function set_flash(string $key, string $message, string $type = 'info'): void
    {
        $_SESSION['_flash'][$key] = [
            'message' => $message,
            'type' => $type
        ];
    }
}

if (!function_exists('get_flash')) {
    /**
     * Retrieve and clear a flash notification message
     */
    function get_flash(string $key): ?array
    {
        if (isset($_SESSION['_flash'][$key])) {
            $flash = $_SESSION['_flash'][$key];
            unset($_SESSION['_flash'][$key]);
            return $flash;
        }
        return null;
    }
}

if (!function_exists('is_admin_logged_in')) {
    /**
     * Check if administrator session is active
     */
    function is_admin_logged_in(): bool
    {
        return isset($_SESSION['admin']) && !empty($_SESSION['admin']['id']);
    }
}

if (!function_exists('require_admin_auth')) {
    /**
     * Enforce administrator access control for private routes
     */
    function require_admin_auth(): void
    {
        if (!is_admin_logged_in()) {
            set_flash('auth_error', 'Please log in to access the administrator portal.', 'warning');
            redirect('login');
        }
    }
}

if (!function_exists('set_old_input')) {
    /**
     * Store submitted form input for redisplay upon validation failure
     */
    function set_old_input(array $data): void
    {
        $_SESSION['_old_input'] = $data;
    }
}

if (!function_exists('old')) {
    /**
     * Retrieve stored form field input value
     */
    function old(string $field, string $default = ''): string
    {
        $val = $_SESSION['_old_input'][$field] ?? $default;
        if (isset($_SESSION['_old_input'][$field])) {
            unset($_SESSION['_old_input'][$field]);
        }
        return e($val);
    }
}
