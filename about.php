<?php
declare(strict_types=1);

/**
 * Mewa Tours - About Us Page Entry Point
 */
require_once __DIR__ . '/config/init.php';

render_view('client/about', [
    'page_title' => 'About Us - Mewa Tours Sri Lanka'
]);
