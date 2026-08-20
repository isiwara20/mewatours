<?php
declare(strict_types=1);

/**
 * Mewa Tours - Data Formatting Helpers
 */

if (!function_exists('format_date')) {
    function format_date(?string $dateStr, string $format = 'M d, Y'): string
    {
        if (empty($dateStr)) {
            return 'N/A';
        }
        $timestamp = strtotime($dateStr);
        return $timestamp ? date($format, $timestamp) : 'N/A';
    }
}

if (!function_exists('format_duration')) {
    function format_duration(int $days, int $nights): string
    {
        if ($days <= 0) {
            return 'Day Tour';
        }
        return sprintf('%d %s / %d %s', 
            $days, 
            $days === 1 ? 'Day' : 'Days', 
            $nights, 
            $nights === 1 ? 'Night' : 'Nights'
        );
    }
}

if (!function_exists('format_price')) {
    function format_price(?float $amount, string $currency = 'USD'): string
    {
        if ($amount === null || $amount <= 0) {
            return 'Inquire for price';
        }
        return sprintf('%s %.2f', $currency, $amount);
    }
}
