<?php
declare(strict_types=1);

/**
 * Mewa Tours - Business Logic Layer for Customer Inquiries
 */
class InquiryBLL
{
    private InquiryDAL $inquiryDAL;
    private EmailService $emailService;
    private WhatsAppService $whatsAppService;

    public function __construct()
    {
        $this->inquiryDAL = new InquiryDAL();
        $this->emailService = new EmailService();
        $this->whatsAppService = new WhatsAppService();
    }

    /**
     * Submit and process customer web inquiry form
     */
    public function processWebInquiry(array $input): array
    {
        $name = sanitize_string($input['name'] ?? '');
        $email = trim($input['email'] ?? '');
        $phone = sanitize_string($input['phone'] ?? '');
        $country = sanitize_string($input['country'] ?? '');
        $travelDate = sanitize_string($input['travel_date'] ?? '');
        $travellerCount = max(1, (int)($input['traveller_count'] ?? 1));
        $message = sanitize_string($input['message'] ?? '');
        $tourId = !empty($input['tour_id']) ? (int)$input['tour_id'] : null;

        if (empty($name)) {
            return ['success' => false, 'message' => 'Please provide your full name.'];
        }

        if (empty($email) || !validate_email($email)) {
            return ['success' => false, 'message' => 'Please provide a valid email address.'];
        }

        if (empty($message)) {
            return ['success' => false, 'message' => 'Please include your inquiry message or travel details.'];
        }

        $inquiryData = [
            'tour_id' => $tourId,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'country' => $country,
            'travel_date' => $travelDate,
            'traveller_count' => $travellerCount,
            'message' => $message,
            'source' => 'CONTACT_FORM',
            'status' => 'NEW'
        ];

        // Store inquiry in MySQL database
        $inquiryId = $this->inquiryDAL->createInquiry($inquiryData);

        // Attempt sending email notification to Mewa Tours Admin
        $this->emailService->sendInquiryNotification($inquiryData);

        return [
            'success' => true,
            'inquiry_id' => $inquiryId,
            'message' => 'Thank you for your inquiry! The Mewa Tours team will contact you shortly.'
        ];
    }

    /**
     * Retrieve list of all customer inquiries for Admin Portal
     */
    public function getAdminInquiries(): array
    {
        return $this->inquiryDAL->getAllInquiries();
    }

    /**
     * Update inquiry processing status
     */
    public function updateInquiryStatus(int $id, string $status): bool
    {
        $allowedStatuses = ['NEW', 'CONTACTED', 'IN_PROGRESS', 'CLOSED', 'CANCELLED'];
        if (!in_array(strtoupper($status), $allowedStatuses, true)) {
            return false;
        }

        return $this->inquiryDAL->updateStatus($id, $status);
    }
}
