<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Contact & Inquiry Controller
 */
class ContactController
{
    private InquiryBLL $inquiryBLL;

    public function __construct()
    {
        $this->inquiryBLL = new InquiryBLL();
    }

    /**
     * Render Contact Us / Inquiry Form Page
     */
    public function index(): void
    {
        render_view('client/contact', [
            'page_title' => 'Contact Us & Plan Your Trip - Mewa Tours'
        ]);
    }

    /**
     * Process submitted Contact / Booking Inquiry Form
     */
    public function submitInquiry(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('contact');
        }

        // Verify CSRF Token
        $token = $_POST['csrf_token'] ?? '';
        if (!CsrfService::validateToken($token)) {
            set_flash('contact_error', 'Invalid or expired security session. Please try again.', 'danger');
            set_old_input($_POST);
            redirect('contact');
        }

        $result = $this->inquiryBLL->processWebInquiry($_POST);

        if ($result['success']) {
            set_flash('contact_success', $result['message'], 'success');
            redirect('contact');
        } else {
            set_flash('contact_error', $result['message'], 'danger');
            set_old_input($_POST);
            redirect('contact');
        }
    }
}
