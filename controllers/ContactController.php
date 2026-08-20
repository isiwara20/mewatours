<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Contact & Inquiry Controller
 */
class ContactController
{
    private InquiryBLL $inquiryBLL;
    private TourBLL $tourBLL;

    public function __construct()
    {
        $this->inquiryBLL = new InquiryBLL();
        $this->tourBLL = new TourBLL();
    }

    /**
     * Render Contact Us / Inquiry Form Page
     */
    public function index(): void
    {
        $tourSlug = sanitize_string($_GET['tour'] ?? '');
        $selectedTour = null;
        if (!empty($tourSlug)) {
            $selectedTour = $this->tourBLL->getTourDetailsBySlug($tourSlug);
        }

        render_view('client/contact', [
            'page_title' => $selectedTour ? ('Book ' . $selectedTour['title'] . ' - Mewa Tours') : 'Contact Us & Plan Your Trip - Mewa Tours',
            'selected_tour' => $selectedTour
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
