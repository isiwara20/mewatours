<?php
declare(strict_types=1);

/**
 * Mewa Tours - Security & Escaping Helpers
 */

if (!function_exists('e')) {
    /**
     * Escape HTML output safely for UTF-8 string rendering
     */
    function e(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('generate_slug')) {
    /**
     * Generate URL-friendly slug from string
     */
    function generate_slug(string $text): string
    {
        // Replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // Transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // Remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // Trim
        $text = trim($text, '-');
        // Remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // Lowercase
        $text = strtolower($text);

        return empty($text) ? 'n-a' : $text;
    }
}
