<?php
declare(strict_types=1);

/**
 * Mewa Tours - Email Service using Native PHP mail()
 */
class EmailService
{
    private array $config;
    private LoggerService $logger;

    public function __construct()
    {
        $this->config = require ROOT_PATH . '/config/mail.php';
        $this->logger = new LoggerService($this->config['log_path'] ?? null);
    }

    /**
     * Send an HTML formatted email
     */
    public function sendHtmlEmail(string $toEmail, string $subject, string $htmlBody, ?string $replyTo = null): bool
    {
        $fromEmail = $this->config['from_email'] ?? 'mewatours83@gmail.com';
        $fromName  = $this->config['from_name'] ?? 'Mewa Tours Sri Lanka';
        $prefix    = $this->config['subject_prefix'] ?? '';

        $fullSubject = $prefix . $subject;

        $headers   = [];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        $headers[] = sprintf('From: %s <%s>', $fromName, $fromEmail);

        if (!empty($replyTo) && validate_email($replyTo)) {
            $headers[] = sprintf('Reply-To: %s', $replyTo);
        }

        $headers[] = 'X-Mailer: PHP/' . phpversion();
        $headerString = implode("\r\n", $headers);

        $sent = @mail($toEmail, $fullSubject, $htmlBody, $headerString);

        if ($sent) {
            $this->logger->info('Email sent successfully', [
                'to' => $toEmail,
                'subject' => $fullSubject
            ]);
            return true;
        }

        $this->logger->error('Email delivery failed', [
            'to' => $toEmail,
            'subject' => $fullSubject
        ]);
        return false;
    }

    /**
     * Send Inquiry Notification to Admin
     */
    public function sendInquiryNotification(array $inquiryData): bool
    {
        $adminEmail = $this->config['admin_email'] ?? 'mewatours83@gmail.com';
        $subject = 'New Web Inquiry Received from ' . ($inquiryData['name'] ?? 'Visitor');

        $body = sprintf("
            <h2>New Inquiry Received</h2>
            <p><strong>Name:</strong> %s</p>
            <p><strong>Email:</strong> %s</p>
            <p><strong>Phone:</strong> %s</p>
            <p><strong>Country:</strong> %s</p>
            <p><strong>Travel Date:</strong> %s</p>
            <p><strong>Travellers:</strong> %s</p>
            <p><strong>Message:</strong><br>%s</p>
        ",
            e($inquiryData['name'] ?? ''),
            e($inquiryData['email'] ?? ''),
            e($inquiryData['phone'] ?? ''),
            e($inquiryData['country'] ?? ''),
            e($inquiryData['travel_date'] ?? ''),
            e((string)($inquiryData['traveller_count'] ?? '')),
            nl2br(e($inquiryData['message'] ?? ''))
        );

        return $this->sendHtmlEmail($adminEmail, $subject, $body, $inquiryData['email'] ?? null);
    }
}
