<?php
declare(strict_types=1);

/**
 * Mewa Tours - CSRF Token Service
 */
class CsrfService
{
    private const TOKEN_KEY = '_csrf_token';

    /**
     * Generate or retrieve existing CSRF token for current session
     */
    public static function generateToken(): string
    {
        if (empty($_SESSION[self::TOKEN_KEY])) {
            $_SESSION[self::TOKEN_KEY] = bin2hex(random_bytes(32));
        }

        return $_SESSION[self::TOKEN_KEY];
    }

    /**
     * Get current CSRF token
     */
    public static function getToken(): string
    {
        return self::generateToken();
    }

    /**
     * Validate incoming CSRF token against session token
     */
    public static function validateToken(?string $token): bool
    {
        if (empty($token) || empty($_SESSION[self::TOKEN_KEY])) {
            return false;
        }

        return hash_equals($_SESSION[self::TOKEN_KEY], $token);
    }

    /**
     * Generate HTML hidden input tag for forms
     */
    public static function inputField(): string
    {
        $token = self::getToken();
        return sprintf('<input type="hidden" name="csrf_token" value="%s">', e($token));
    }
}
