<?php
declare(strict_types=1);

/**
 * Mewa Tours - Validation & Sanitization Helpers
 */

if (!function_exists('sanitize_string')) {
    function sanitize_string(?string $str): string
    {
        return trim(strip_tags($str ?? ''));
    }
}

if (!function_exists('validate_email')) {
    function validate_email(string $email): bool
    {
        return (bool) filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    }
}

if (!function_exists('validate_phone')) {
    function validate_phone(string $phone): bool
    {
        // Simple Sri Lanka / International phone regex allowing +, digits, spaces, hyphens
        return (bool) preg_match('/^[0-9+\s\-()]{7,20}$/', trim($phone));
    }
}

if (!function_exists('is_required')) {
    function is_required(mixed $value): bool
    {
        if (is_string($value)) {
            return trim($value) !== '';
        }
        return !empty($value);
    }
}
