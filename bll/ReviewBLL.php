<?php
declare(strict_types=1);

/**
 * Mewa Tours - Customer Review Business Logic Layer (BLL)
 */
class ReviewBLL
{
    private ReviewDAL $reviewDAL;
    private FileUploadService $fileUploadService;

    public function __construct()
    {
        $this->reviewDAL = new ReviewDAL();
        $this->fileUploadService = new FileUploadService();
    }

    /**
     * Get approved customer reviews
     */
    public function getApprovedReviews(?int $tourId = null, int $limit = 20, int $offset = 0): array
    {
        return $this->reviewDAL->getApprovedReviews($tourId, $limit, $offset);
    }

    /**
     * Get top featured reviews for homepage
     */
    public function getFeaturedReviews(int $limit = 6): array
    {
        return $this->reviewDAL->getFeaturedReviews($limit);
    }

    /**
     * Get rating statistics summary
     */
    public function getRatingStatistics(): array
    {
        return $this->reviewDAL->getRatingStatistics();
    }

    /**
     * Process user review submission form
     */
    public function processSubmission(array $postData, array $files = []): array
    {
        $name = sanitize_string($postData['customer_name'] ?? '');
        $email = filter_var(trim($postData['customer_email'] ?? ''), FILTER_VALIDATE_EMAIL);
        $country = sanitize_string($postData['customer_country'] ?? 'Sri Lanka');
        $rating = filter_var($postData['rating'] ?? 5, FILTER_VALIDATE_INT);
        $category = sanitize_string($postData['category'] ?? 'General Experience');
        $tourId = !empty($postData['tour_id']) ? (int)$postData['tour_id'] : null;
        $title = sanitize_string($postData['title'] ?? '');
        $comment = sanitize_string($postData['comment'] ?? '');

        // Validation Rules
        if (empty($name)) {
            return ['success' => false, 'message' => 'Please provide your full name.'];
        }

        if (!$email) {
            return ['success' => false, 'message' => 'Please provide a valid email address.'];
        }

        if ($rating < 1 || $rating > 5) {
            return ['success' => false, 'message' => 'Rating must be between 1 and 5 stars.'];
        }

        if (empty($title) || strlen($title) < 3) {
            return ['success' => false, 'message' => 'Please enter a short headline title for your feedback.'];
        }

        if (empty($comment) || strlen($comment) < 10) {
            return ['success' => false, 'message' => 'Feedback message must be at least 10 characters long.'];
        }

        // Handle optional photo upload
        $photoPath = null;
        if (!empty($files['review_photo']) && $files['review_photo']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->fileUploadService->uploadImage($files['review_photo'], 'reviews');
            if ($uploadResult['success']) {
                $photoPath = $uploadResult['filepath'];
            }
        }

        // Prepare data record
        $reviewData = [
            'customer_name' => $name,
            'customer_email' => $email,
            'customer_country' => !empty($country) ? $country : 'Sri Lanka',
            'tour_id' => $tourId,
            'rating' => $rating,
            'category' => $category,
            'title' => $title,
            'comment' => $comment,
            'photo_path' => $photoPath,
            'status' => 'APPROVED', // Default approved for direct customer engagement
            'is_featured' => ($rating === 5) ? 1 : 0
        ];

        $saved = $this->reviewDAL->createReview($reviewData);

        if ($saved) {
            return [
                'success' => true,
                'message' => 'Thank you so much! Your review and feedback has been published successfully.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Unable to save your review at this moment. Please try again later.'
        ];
    }
}
