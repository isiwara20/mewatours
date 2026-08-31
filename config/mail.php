<?php
declare(strict_types=1);

/**
 * Mewa Tours - Native PHP Email Configuration
 */
return [
    'from_email' => 'mewatours83@gmail.com',
    'from_name' => 'Mewa Tours Sri Lanka',
    'admin_email' => 'mewatours83@gmail.com',
    'subject_prefix' => '[Mewa Tours] ',

    'log_path' => __DIR__ . '/../storage/logs/mail.log',
    'log_emails' => true // Always log sent email headers and content for auditing
];
