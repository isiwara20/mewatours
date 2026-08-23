<?php
declare(strict_types=1);

/**
 * Mewa Tours - Central Application Configuration
 */
return [
    'app_name' => 'Mewa Tours',
    'app_env' => 'development', // 'development' or 'production'
    'base_url' => '/mewatours', // Automatically dynamic via url_helper if needed
    'timezone' => 'Asia/Colombo',

    'whatsapp' => [
        'number' => '94769695024', // Standardized format without + or leading zeros
        'default_message' => 'Hello Mewa Tours, I would like to inquire about your Sri Lanka tour packages.'
    ],

    'company' => [
        'name' => 'Mewa Tours Sri Lanka',
        'email' => 'mewatours83@gmail.com',
        'phone' => '+94 76 969 5024',
        'address' => 'Kandy, Sri Lanka',
        'operating_hours' => '8:00 AM - 8:00 PM (IST)'
    ],

    'upload' => [
        'max_size' => 10 * 1024 * 1024, // 10MB
        'allowed_mimes' => ['image/jpeg', 'image/png', 'image/webp'],
        'allowed_extensions' => ['jpg', 'jpeg', 'png', 'webp'],
        'path' => __DIR__ . '/../assets/images/uploads/'
    ],

    'session' => [
        'lifetime' => 7200, // 2 hours
        'name' => 'MEWA_SESS_ID'
    ]
];
