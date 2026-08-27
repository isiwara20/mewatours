<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Customer Reviews & Feedback Controller
 */
class ReviewController
{
    private ReviewBLL $reviewBLL;
    private TourBLL $tourBLL;

    public function __construct()
    {
        $this->reviewBLL = new ReviewBLL();
        $this->tourBLL = new TourBLL();
    }

    /**
     * Render Public Reviews Page & Submission Form
     */
    public function index(): void
    {
        $selectedTourId = !empty($_GET['tour_id']) ? (int)$_GET['tour_id'] : null;
        $reviews = $this->reviewBLL->getApprovedReviews($selectedTourId, 30);
        $statistics = $this->reviewBLL->getRatingStatistics();
        $tours = $this->tourBLL->getActiveTours();

        render_view('client/reviews', [
            'page_title' => 'Traveler Reviews & Feedback - Mewa Tours Sri Lanka',
            'reviews' => $reviews,
            'statistics' => $statistics,
            'tours' => $tours,
            'selected_tour_id' => $selectedTourId
        ]);
    }

    /**
     * Handle Customer Review Form Submission
     */
    public function submitReview(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('reviews');
        }

        // Verify CSRF Token
        $token = $_POST['csrf_token'] ?? '';
        if (!CsrfService::validateToken($token)) {
            set_flash('review_error', 'Invalid security token session. Please try submitting again.', 'danger');
            set_old_input($_POST);
            redirect('reviews#writeReviewForm');
        }

        $result = $this->reviewBLL->processSubmission($_POST, $_FILES);

        if ($result['success']) {
            set_flash('review_success', $result['message'], 'success');
            redirect('reviews');
        } else {
            set_flash('review_error', $result['message'], 'danger');
            set_old_input($_POST);
            redirect('reviews#writeReviewForm');
        }
    }
}
