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

    public function __construct()
    {
        // Enforce private administrator access control
        require_admin_auth();

        $this->tourBLL = new TourBLL();
        $this->destinationBLL = new DestinationBLL();
        $this->experienceBLL = new ExperienceBLL();
        $this->galleryBLL = new GalleryBLL();
        $this->inquiryBLL = new InquiryBLL();
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
     * Admin Tours Management Placeholder
     */
    public function tours(): void
    {
        $tours = $this->tourBLL->getActiveTours();
        render_view('admin/tours/index', [
            'page_title' => 'Manage Tours - Admin Portal',
            'tours' => $tours
        ]);
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
