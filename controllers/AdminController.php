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
    private SettingBLL $settingBLL;
    private AdminAuthBLL $adminAuthBLL;
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
        $this->settingBLL = new SettingBLL();
        $this->adminAuthBLL = new AdminAuthBLL();
        $this->fileUploadService = new FileUploadService();
    }

    /**
     * Admin Dashboard View
     */
    public function dashboard(): void
    {
        $toursCount = count($this->tourBLL->getAdminTours());
        $destinationsCount = count($this->destinationBLL->getAdminDestinations());
        $experiencesCount = count($this->experienceBLL->getAdminExperiences());
        $galleryCount = count($this->galleryBLL->getAdminGalleryItems());
        $inquiries = $this->inquiryBLL->getAdminInquiries();

        $pendingInquiriesCount = count(array_filter($inquiries, function($inq) {
            return $inq['status'] === 'NEW';
        }));

        render_view('admin/dashboard', [
            'page_title' => 'Admin Dashboard - Mewa Tours Portal',
            'tours_count' => $toursCount,
            'destinations_count' => $destinationsCount,
            'experiences_count' => $experiencesCount,
            'gallery_count' => $galleryCount,
            'inquiries_count' => count($inquiries),
            'pending_inquiries_count' => $pendingInquiriesCount,
            'recent_inquiries' => array_slice($inquiries, 0, 5)
        ]);
    }

    // =========================================================================
    // TOUR PACKAGES MANAGEMENT
    // =========================================================================

    public function tours(): void
    {
        $tours = $this->tourBLL->getAdminTours();
        render_view('admin/tours/index', [
            'page_title' => 'Manage Tours - Admin Portal',
            'tours' => $tours
        ]);
    }

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

    // =========================================================================
    // DESTINATIONS MANAGEMENT
    // =========================================================================

    public function destinations(): void
    {
        $destinations = $this->destinationBLL->getAdminDestinations();
        render_view('admin/destinations/index', [
            'page_title' => 'Manage Destinations - Admin Portal',
            'destinations' => $destinations
        ]);
    }

    public function destinationsCreate(): void
    {
        render_view('admin/destinations/form', [
            'page_title' => 'Add Destination - Admin Portal',
            'action' => 'create',
            'destination' => null
        ]);
    }

    public function destinationsStore(): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token. Please try submitting again.', 'danger');
            redirect('admin/destinations/create');
        }

        $input = $_POST;
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->fileUploadService->uploadImage($_FILES['featured_image'], 'destinations');
            if ($uploadResult['success']) {
                $input['featured_image'] = 'uploads/' . $uploadResult['relative_path'];
            } else {
                set_flash('error', 'Image Upload Error: ' . $uploadResult['error'], 'danger');
                set_old_input($_POST);
                redirect('admin/destinations/create');
            }
        }

        $result = $this->destinationBLL->saveDestination($input, null);
        if ($result['success']) {
            set_flash('success', $result['message'], 'success');
            redirect('admin/destinations');
        } else {
            set_flash('error', $result['message'], 'danger');
            set_old_input($_POST);
            redirect('admin/destinations/create');
        }
    }

    public function destinationsEdit(int $id): void
    {
        $dest = $this->destinationBLL->getDestinationById($id);
        if (!$dest) {
            set_flash('error', 'Destination not found.', 'danger');
            redirect('admin/destinations');
        }

        render_view('admin/destinations/form', [
            'page_title' => 'Edit Destination - ' . $dest['name'],
            'action' => 'edit',
            'destination' => $dest
        ]);
    }

    public function destinationsUpdate(int $id): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token. Please try submitting again.', 'danger');
            redirect('admin/destinations/edit/' . $id);
        }

        $input = $_POST;
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->fileUploadService->uploadImage($_FILES['featured_image'], 'destinations');
            if ($uploadResult['success']) {
                $input['featured_image'] = 'uploads/' . $uploadResult['relative_path'];
            } else {
                set_flash('error', 'Image Upload Error: ' . $uploadResult['error'], 'danger');
                set_old_input($_POST);
                redirect('admin/destinations/edit/' . $id);
            }
        }

        $result = $this->destinationBLL->saveDestination($input, $id);
        if ($result['success']) {
            set_flash('success', $result['message'], 'success');
            redirect('admin/destinations');
        } else {
            set_flash('error', $result['message'], 'danger');
            set_old_input($_POST);
            redirect('admin/destinations/edit/' . $id);
        }
    }

    public function destinationsDelete(int $id): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token.', 'danger');
            redirect('admin/destinations');
        }

        $result = $this->destinationBLL->deleteDestination($id);
        set_flash($result['success'] ? 'success' : 'error', $result['message'], $result['success'] ? 'success' : 'danger');
        redirect('admin/destinations');
    }

    // =========================================================================
    // EXPERIENCES MANAGEMENT
    // =========================================================================

    public function experiences(): void
    {
        $experiences = $this->experienceBLL->getAdminExperiences();
        render_view('admin/experiences/index', [
            'page_title' => 'Manage Experiences - Admin Portal',
            'experiences' => $experiences
        ]);
    }

    public function experiencesCreate(): void
    {
        $categories = $this->experienceBLL->getCategories();
        render_view('admin/experiences/form', [
            'page_title' => 'Add Experience - Admin Portal',
            'action' => 'create',
            'experience' => null,
            'categories' => $categories
        ]);
    }

    public function experiencesStore(): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token. Please try submitting again.', 'danger');
            redirect('admin/experiences/create');
        }

        $input = $_POST;
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->fileUploadService->uploadImage($_FILES['featured_image'], 'experiences');
            if ($uploadResult['success']) {
                $input['featured_image'] = 'uploads/' . $uploadResult['relative_path'];
            } else {
                set_flash('error', 'Image Upload Error: ' . $uploadResult['error'], 'danger');
                set_old_input($_POST);
                redirect('admin/experiences/create');
            }
        }

        $result = $this->experienceBLL->saveExperience($input, null);
        if ($result['success']) {
            set_flash('success', $result['message'], 'success');
            redirect('admin/experiences');
        } else {
            set_flash('error', $result['message'], 'danger');
            set_old_input($_POST);
            redirect('admin/experiences/create');
        }
    }

    public function experiencesEdit(int $id): void
    {
        $exp = $this->experienceBLL->getExperienceById($id);
        if (!$exp) {
            set_flash('error', 'Experience not found.', 'danger');
            redirect('admin/experiences');
        }

        $categories = $this->experienceBLL->getCategories();
        render_view('admin/experiences/form', [
            'page_title' => 'Edit Experience - ' . $exp['name'],
            'action' => 'edit',
            'experience' => $exp,
            'categories' => $categories
        ]);
    }

    public function experiencesUpdate(int $id): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token. Please try submitting again.', 'danger');
            redirect('admin/experiences/edit/' . $id);
        }

        $input = $_POST;
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->fileUploadService->uploadImage($_FILES['featured_image'], 'experiences');
            if ($uploadResult['success']) {
                $input['featured_image'] = 'uploads/' . $uploadResult['relative_path'];
            } else {
                set_flash('error', 'Image Upload Error: ' . $uploadResult['error'], 'danger');
                set_old_input($_POST);
                redirect('admin/experiences/edit/' . $id);
            }
        }

        $result = $this->experienceBLL->saveExperience($input, $id);
        if ($result['success']) {
            set_flash('success', $result['message'], 'success');
            redirect('admin/experiences');
        } else {
            set_flash('error', $result['message'], 'danger');
            set_old_input($_POST);
            redirect('admin/experiences/edit/' . $id);
        }
    }

    public function experiencesDelete(int $id): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token.', 'danger');
            redirect('admin/experiences');
        }

        $result = $this->experienceBLL->deleteExperience($id);
        set_flash($result['success'] ? 'success' : 'error', $result['message'], $result['success'] ? 'success' : 'danger');
        redirect('admin/experiences');
    }

    // =========================================================================
    // GALLERY MANAGEMENT
    // =========================================================================

    public function gallery(): void
    {
        $galleryItems = $this->galleryBLL->getAdminGalleryItems();
        render_view('admin/gallery/index', [
            'page_title' => 'Manage Gallery - Admin Portal',
            'gallery_items' => $galleryItems
        ]);
    }

    public function galleryStore(): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token.', 'danger');
            redirect('admin/gallery');
        }

        $input = $_POST;
        if (isset($_FILES['gallery_image']) && $_FILES['gallery_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->fileUploadService->uploadImage($_FILES['gallery_image'], 'gallery');
            if ($uploadResult['success']) {
                $input['image'] = 'uploads/' . $uploadResult['relative_path'];
            } else {
                set_flash('error', 'Image Upload Error: ' . $uploadResult['error'], 'danger');
                redirect('admin/gallery');
            }
        } elseif (!empty($_POST['image_url'])) {
            $input['image'] = sanitize_string($_POST['image_url']);
        } else {
            set_flash('error', 'Please select an image file to upload.', 'danger');
            redirect('admin/gallery');
        }

        $result = $this->galleryBLL->saveGalleryItem($input);
        set_flash($result['success'] ? 'success' : 'error', $result['message'], $result['success'] ? 'success' : 'danger');
        redirect('admin/gallery');
    }

    public function galleryDelete(int $id): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token.', 'danger');
            redirect('admin/gallery');
        }

        $result = $this->galleryBLL->deleteGalleryItem($id);
        set_flash($result['success'] ? 'success' : 'error', $result['message'], $result['success'] ? 'success' : 'danger');
        redirect('admin/gallery');
    }

    // =========================================================================
    // CUSTOMER INQUIRIES MANAGEMENT
    // =========================================================================

    public function inquiries(): void
    {
        $inquiries = $this->inquiryBLL->getAdminInquiries();
        render_view('admin/inquiries/index', [
            'page_title' => 'Customer Inquiries - Admin Portal',
            'inquiries' => $inquiries
        ]);
    }

    public function inquiriesShow(int $id): void
    {
        $inquiry = $this->inquiryBLL->getInquiryById($id);
        if (!$inquiry) {
            set_flash('error', 'Inquiry not found.', 'danger');
            redirect('admin/inquiries');
        }

        render_view('admin/inquiries/show', [
            'page_title' => 'Inquiry #' . $inquiry['id'] . ' - Admin Portal',
            'inquiry' => $inquiry
        ]);
    }

    public function inquiriesUpdateStatus(int $id): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token.', 'danger');
            redirect('admin/inquiries');
        }

        $status = $_POST['status'] ?? 'NEW';
        $success = $this->inquiryBLL->updateInquiryStatus($id, $status);

        set_flash($success ? 'success' : 'error', $success ? 'Inquiry status updated to ' . $status : 'Failed to update status.', $success ? 'success' : 'danger');
        
        $redirectUrl = $_POST['redirect_to_show'] ?? false ? 'admin/inquiries/show/' . $id : 'admin/inquiries';
        redirect($redirectUrl);
    }

    public function inquiriesDelete(int $id): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token.', 'danger');
            redirect('admin/inquiries');
        }

        $result = $this->inquiryBLL->deleteInquiry($id);
        set_flash($result['success'] ? 'success' : 'error', $result['message'], $result['success'] ? 'success' : 'danger');
        redirect('admin/inquiries');
    }

    // =========================================================================
    // SITE SETTINGS & ADMIN SECURITY PROFILE MANAGEMENT
    // =========================================================================

    public function settings(): void
    {
        $settings = $this->settingBLL->getSettings();
        $adminId = (int)($_SESSION['admin']['id'] ?? $_SESSION['admin_id'] ?? 1);
        $adminDAL = new AdminDAL();
        $adminUser = $adminDAL->findById($adminId);

        render_view('admin/settings/index', [
            'page_title' => 'Site Settings & Admin Security - Admin Portal',
            'settings' => $settings,
            'adminUser' => $adminUser
        ]);
    }

    public function settingsUpdate(): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token.', 'danger');
            redirect('admin/settings');
        }

        $result = $this->settingBLL->updateSettings($_POST);
        set_flash($result['success'] ? 'success' : 'error', $result['message'], $result['success'] ? 'success' : 'danger');
        redirect('admin/settings');
    }

    public function profileUpdate(): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token.', 'danger');
            redirect('admin/settings');
        }

        $adminId = (int)($_SESSION['admin']['id'] ?? $_SESSION['admin_id'] ?? 1);
        $result = $this->adminAuthBLL->updateProfile($adminId, $_POST['name'] ?? '', $_POST['email'] ?? '');
        
        set_flash($result['success'] ? 'success' : 'error', $result['message'], $result['success'] ? 'success' : 'danger');
        redirect('admin/settings');
    }

    public function passwordUpdate(): void
    {
        if (!CsrfService::validateToken($_POST['csrf_token'] ?? null)) {
            set_flash('error', 'Invalid security token.', 'danger');
            redirect('admin/settings');
        }

        $adminId = (int)($_SESSION['admin']['id'] ?? $_SESSION['admin_id'] ?? 1);
        $result = $this->adminAuthBLL->updatePassword(
            $adminId,
            $_POST['current_password'] ?? '',
            $_POST['new_password'] ?? '',
            $_POST['confirm_password'] ?? ''
        );

        set_flash($result['success'] ? 'success' : 'error', $result['message'], $result['success'] ? 'success' : 'danger');
        redirect('admin/settings');
    }
}
