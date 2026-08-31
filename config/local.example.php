<?php
declare(strict_types=1);

/**
 * Mewa Tours - Local Configuration Override Example
 * Copy this file to `config/local.php` to set local or production credentials safely.
 * Note: `config/local.php` is ignored by Git and will NEVER be pushed to GitHub.
 */
return [
    'db_host' => 'localhost',
    'db_port' => '3306',
    'db_name' => 'mewa_tours',
    'db_user' => 'root',
    'db_pass' => '',
    'db_charset' => 'utf8mb4'
];
