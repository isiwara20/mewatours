<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Experiences Entry Point
 */
require_once __DIR__ . '/config/init.php';

$controller = new ExperienceController();
$controller->index();
