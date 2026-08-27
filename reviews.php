<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Customer Reviews & Feedback Entry Point
 */
require_once __DIR__ . '/config/init.php';

$controller = new ReviewController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->submitReview();
} else {
    $controller->index();
}
