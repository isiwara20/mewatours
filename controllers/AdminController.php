<?php
declare(strict_types=1);

/**
 * Mewa Tours - Central Administrator Controller
 */
class AdminController
{
    private TourBLL $tourBLL;
    private DestinationBLL $destinationBLL;
    private ExperienceBLL $experienceBLL;
    private GalleryBLL $galleryBLL;
    private InquiryBLL $inquiryBLL;
    private FileUploadService $fileUploadService;

    public function __construct()
    {
        // Enforce private administrator access control
        require_admin_auth();

        $this->tourBLL = new TourBLL();
        $this->destinationBLL = new DestinationBLL();
        $this->experienceBLL = new ExperienceBLL();
        $this->galleryBLL = new GalleryBLL();
        $this->inquiryBLL = new InquiryBLL();
        $this->fileUploadService = new FileUploadService();
    }

    /**
     * Admin Dashboard View
     */
    public function dashboard(): void
    {
        $toursCount = count($this->tourBLL->getActiveTours());
        $destinationsCount = count($this->destinationBLL->getActiveDestinations());
        $inquiries = $this->inquiryBLL->getAdminInquiries();

        render_view('admin/dashboard', [
            'page_title' => 'Admin Dashboard - Mewa Tours Portal',
            'tours_count' => $toursCount,
            'destinations_count' => $destinationsCount,
            'inquiries_count' => count($inquiries),
            'recent_inquiries' => array_slice($inquiries, 0, 5)
        ]);
    }

    /**
     * Admin Tours Listing
     */
    public function tours(): void
    {
        $tours = $this->tourBLL->getAdminTours();
        render_view('admin/tours/index', [
            'page_title' => 'Manage Tours - Admin Portal',
            'tours' => $tours
        ]);
    }

    /**
     * Admin Show Add Tour Form
     */
    public function toursCreate(): void
    {
        $categories = $this->tourBLL->getCategories();
        render_view('admin/tours/form', [
            'page_title' => 'Add New Tour Package - Admin Portal',
            'action' => 'create',
            'tour' => null,
            'categories' => $categories
        ]);
    }

    /**
     * Admin Store New Tour
     */
    public function toursStore(): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token. Please try submitting again.', 'danger');
            redirect('admin/tours/create');
        }

        $input = $_POST;
        $itineraryDays = $_POST['itinerary'] ?? [];
        $inclusions = $_POST['inclusions'] ?? [];
        $highlights = $_POST['highlights'] ?? [];

        // Handle featured image upload
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->fileUploadService->uploadImage($_FILES['featured_image'], 'tours');
            if ($uploadResult['success']) {
                $input['featured_image'] = 'uploads/' . $uploadResult['relative_path'];
            } else {
                set_flash('error', 'Image Upload Error: ' . $uploadResult['error'], 'danger');
                set_old_input($_POST);
                redirect('admin/tours/create');
            }
        }

        $result = $this->tourBLL->saveTour($input, $itineraryDays, $inclusions, $highlights, null);

        if ($result['success']) {
            set_flash('success', $result['message'], 'success');
            redirect('admin/tours');
        } else {
            set_flash('error', $result['message'], 'danger');
            set_old_input($_POST);
            redirect('admin/tours/create');
        }
    }

    /**
     * Admin Show Edit Tour Form
     */
    public function toursEdit(int $id): void
    {
        $tour = $this->tourBLL->getTourById($id);
        if (!$tour) {
            set_flash('error', 'Tour package not found.', 'danger');
            redirect('admin/tours');
        }

        $categories = $this->tourBLL->getCategories();
        render_view('admin/tours/form', [
            'page_title' => 'Edit Tour Package - ' . $tour['title'],
            'action' => 'edit',
            'tour' => $tour,
            'categories' => $categories
        ]);
    }

    /**
     * Admin Update Existing Tour
     */
    public function toursUpdate(int $id): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token. Please try submitting again.', 'danger');
            redirect('admin/tours/edit/' . $id);
        }

        $input = $_POST;
        $itineraryDays = $_POST['itinerary'] ?? [];
        $inclusions = $_POST['inclusions'] ?? [];
        $highlights = $_POST['highlights'] ?? [];

        // Handle featured image update if provided
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->fileUploadService->uploadImage($_FILES['featured_image'], 'tours');
            if ($uploadResult['success']) {
                $input['featured_image'] = 'uploads/' . $uploadResult['relative_path'];
            } else {
                set_flash('error', 'Image Upload Error: ' . $uploadResult['error'], 'danger');
                set_old_input($_POST);
                redirect('admin/tours/edit/' . $id);
            }
        }

        $result = $this->tourBLL->saveTour($input, $itineraryDays, $inclusions, $highlights, $id);

        if ($result['success']) {
            set_flash('success', $result['message'], 'success');
            redirect('admin/tours');
        } else {
            set_flash('error', $result['message'], 'danger');
            set_old_input($_POST);
            redirect('admin/tours/edit/' . $id);
        }
    }

    /**
     * Admin Delete Tour Package
     */
    public function toursDelete(int $id): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token.', 'danger');
            redirect('admin/tours');
        }

        $result = $this->tourBLL->deleteTour($id);
        set_flash($result['success'] ? 'success' : 'error', $result['message'], $result['success'] ? 'success' : 'danger');
        redirect('admin/tours');
    }

    /**
     * Admin Destinations Management Placeholder
     */
    public function destinations(): void
    {
        $destinations = $this->destinationBLL->getActiveDestinations();
        render_view('admin/destinations/index', [
            'page_title' => 'Manage Destinations - Admin Portal',
            'destinations' => $destinations
        ]);
    }

    /**
     * Admin Experiences Management Placeholder
     */
    public function experiences(): void
    {
        $experiences = $this->experienceBLL->getActiveExperiences();
        render_view('admin/experiences/index', [
            'page_title' => 'Manage Experiences - Admin Portal',
            'experiences' => $experiences
        ]);
    }

    /**
     * Admin Gallery Management Placeholder
     */
    public function gallery(): void
    {
        $galleryItems = $this->galleryBLL->getActiveGalleryItems();
        render_view('admin/gallery/index', [
            'page_title' => 'Manage Gallery - Admin Portal',
            'gallery_items' => $galleryItems
        ]);
    }

    /**
     * Admin Inquiries Management Placeholder
     */
    public function inquiries(): void
    {
        $inquiries = $this->inquiryBLL->getAdminInquiries();
        render_view('admin/inquiries/index', [
            'page_title' => 'Customer Inquiries - Admin Portal',
            'inquiries' => $inquiries
        ]);
    }

    /**
     * Admin Settings Management Placeholder
     */
    public function settings(): void
    {
        render_view('admin/settings/index', [
            'page_title' => 'Site Settings - Admin Portal'
        ]);
    }
}
