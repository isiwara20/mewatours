<?php
declare(strict_types=1);

/**
 * Mewa Tours - Business Logic Layer for Tour Packages
 */
class TourBLL
{
    private TourDAL $tourDAL;
    private WhatsAppService $whatsAppService;

    public function __construct()
    {
        $this->tourDAL = new TourDAL();
        $this->whatsAppService = new WhatsAppService();
    }

    /**
     * Get all active tours for public listing with batch-loaded inclusions and highlights
     */
    public function getActiveTours(): array
    {
        $tours = $this->tourDAL->getAllTours(true);
        if (empty($tours)) {
            return [];
        }

        $tourIds = array_column($tours, 'id');
        $inclusionsMap = $this->tourDAL->getInclusionsForTourIds($tourIds);
        $highlightsMap = $this->tourDAL->getHighlightsForTourIds($tourIds);

        foreach ($tours as &$tour) {
            $tId = (int)$tour['id'];
            $tour['inclusions'] = $inclusionsMap[$tId] ?? [];
            $tour['highlights'] = $highlightsMap[$tId] ?? [];
            $tour['formatted_duration'] = format_duration((int)$tour['duration_days'], (int)$tour['duration_nights']);
            
            $waMessage = $this->whatsAppService->buildTourInquiryMessage(
                $tour['title'],
                $tour['formatted_duration'],
                $tour['tour_type'] ?? null,
                $tour['route'] ?? null
            );
            $tour['whatsapp_url'] = $this->whatsAppService->generateInquiryLink($waMessage);
        }
        return $tours;
    }

    /**
     * Get all tours for admin management (both ACTIVE and INACTIVE)
     */
    public function getAdminTours(): array
    {
        $tours = $this->tourDAL->getAllTours(false);
        if (empty($tours)) {
            return [];
        }

        $tourIds = array_column($tours, 'id');
        $inclusionsMap = $this->tourDAL->getInclusionsForTourIds($tourIds);
        $highlightsMap = $this->tourDAL->getHighlightsForTourIds($tourIds);

        foreach ($tours as &$tour) {
            $tId = (int)$tour['id'];
            $tour['inclusions'] = $inclusionsMap[$tId] ?? [];
            $tour['highlights'] = $highlightsMap[$tId] ?? [];
            $tour['formatted_duration'] = format_duration((int)$tour['duration_days'], (int)$tour['duration_nights']);
        }
        return $tours;
    }

    public function getCategories(): array
    {
        return $this->tourDAL->getCategories();
    }

    public function getSingleFeaturedTour(): ?array
    {
        $tour = $this->tourDAL->getSingleFeaturedTour();
        if ($tour) {
            $tId = (int)$tour['id'];
            $tour['inclusions'] = $this->tourDAL->getTourInclusions($tId);
            $tour['highlights'] = $this->tourDAL->getTourHighlights($tId);
            $tour['formatted_duration'] = format_duration((int)$tour['duration_days'], (int)$tour['duration_nights']);
            
            $waMessage = $this->whatsAppService->buildTourInquiryMessage(
                $tour['title'],
                $tour['formatted_duration'],
                $tour['tour_type'] ?? null,
                $tour['route'] ?? null
            );
            $tour['whatsapp_url'] = $this->whatsAppService->generateInquiryLink($waMessage);
        }
        return $tour;
    }

    public function getFeaturedTours(int $limit = 6): array
    {
        $tours = $this->tourDAL->getFeaturedTours($limit);
        if (empty($tours)) {
            return [];
        }

        $tourIds = array_column($tours, 'id');
        $inclusionsMap = $this->tourDAL->getInclusionsForTourIds($tourIds);
        $highlightsMap = $this->tourDAL->getHighlightsForTourIds($tourIds);

        foreach ($tours as &$tour) {
            $tId = (int)$tour['id'];
            $tour['inclusions'] = $inclusionsMap[$tId] ?? [];
            $tour['highlights'] = $highlightsMap[$tId] ?? [];
            $tour['formatted_duration'] = format_duration((int)$tour['duration_days'], (int)$tour['duration_nights']);
            
            $waMessage = $this->whatsAppService->buildTourInquiryMessage(
                $tour['title'],
                $tour['formatted_duration'],
                $tour['tour_type'] ?? null,
                $tour['route'] ?? null
            );
            $tour['whatsapp_url'] = $this->whatsAppService->generateInquiryLink($waMessage);
        }
        return $tours;
    }

    /**
     * Get full published tour package details for client page (including itinerary days, inclusions, highlights, gallery, and related tours)
     */
    public function getTourDetailsBySlug(string $slug): ?array
    {
        $tour = $this->tourDAL->findBySlug($slug);
        if ($tour) {
            $tId = (int)$tour['id'];
            $tour['itinerary'] = $this->tourDAL->getTourItineraryDays($tId);
            $tour['inclusions'] = $this->tourDAL->getTourInclusions($tId);
            $tour['highlights'] = $this->tourDAL->getTourHighlights($tId);
            $tour['gallery_images'] = $this->tourDAL->getTourImages($tId);
            $tour['formatted_duration'] = format_duration((int)$tour['duration_days'], (int)$tour['duration_nights']);
            $tour['related_tours'] = $this->getRelatedToursForClient($tId, !empty($tour['category_id']) ? (int)$tour['category_id'] : null);
            
            $waMessage = $this->whatsAppService->buildTourInquiryMessage(
                $tour['title'],
                $tour['formatted_duration'],
                $tour['tour_type'] ?? null,
                $tour['route'] ?? null
            );
            $tour['whatsapp_url'] = $this->whatsAppService->generateInquiryLink($waMessage);
        }
        return $tour;
    }

    /**
     * Get related tours enriched with duration and whatsapp links
     */
    public function getRelatedToursForClient(int $currentTourId, ?int $categoryId = null, int $limit = 3): array
    {
        $tours = $this->tourDAL->getRelatedTours($currentTourId, $categoryId, $limit);
        if (empty($tours)) {
            return [];
        }

        $tourIds = array_column($tours, 'id');
        $inclusionsMap = $this->tourDAL->getInclusionsForTourIds($tourIds);
        $highlightsMap = $this->tourDAL->getHighlightsForTourIds($tourIds);

        foreach ($tours as &$tour) {
            $tId = (int)$tour['id'];
            $tour['inclusions'] = $inclusionsMap[$tId] ?? [];
            $tour['highlights'] = $highlightsMap[$tId] ?? [];
            $tour['formatted_duration'] = format_duration((int)$tour['duration_days'], (int)$tour['duration_nights']);
            
            $waMessage = $this->whatsAppService->buildTourInquiryMessage(
                $tour['title'],
                $tour['formatted_duration'],
                $tour['tour_type'] ?? null,
                $tour['route'] ?? null
            );
            $tour['whatsapp_url'] = $this->whatsAppService->generateInquiryLink($waMessage);
        }
        return $tours;
    }

    /**
     * Get single tour package by ID for Admin Edit
     */
    public function getTourById(int $id): ?array
    {
        $tour = $this->tourDAL->findById($id);
        if ($tour) {
            $tId = (int)$tour['id'];
            $tour['itinerary'] = $this->tourDAL->getTourItineraryDays($tId);
            $tour['inclusions'] = $this->tourDAL->getTourInclusions($tId);
            $tour['highlights'] = $this->tourDAL->getTourHighlights($tId);
            $tour['formatted_duration'] = format_duration((int)$tour['duration_days'], (int)$tour['duration_nights']);
        }
        return $tour;
    }

    /**
     * Save (Create or Update) a tour with child itinerary days, inclusions, and highlights inside a transaction
     */
    public function saveTour(
        array $input, 
        array $itineraryDays = [], 
        array $inclusions = [], 
        array $highlights = [], 
        ?int $id = null
    ): array {
        $title = sanitize_string($input['title'] ?? '');
        if (empty($title)) {
            return ['success' => false, 'message' => 'Tour title is required.'];
        }

        $slug = !empty($input['slug']) ? generate_slug($input['slug']) : generate_slug($title);
        $durationDays = max(1, (int)($input['duration_days'] ?? 1));
        $durationNights = max(0, (int)($input['duration_nights'] ?? 0));

        // Clean inclusions & highlights
        $cleanInclusions = array_values(array_filter(array_map('trim', $inclusions), fn($val) => $val !== ''));
        $cleanHighlights = array_values(array_filter(array_map('trim', $highlights), fn($val) => $val !== ''));

        // Clean and normalize itinerary days
        $cleanItinerary = [];
        $daySeq = 1;
        if (!empty($itineraryDays) && is_array($itineraryDays)) {
            foreach ($itineraryDays as $dayItem) {
                $dayNum = !empty($dayItem['day_number']) ? max(1, (int)$dayItem['day_number']) : $daySeq;
                $dayTitle = sanitize_string($dayItem['title'] ?? '');
                $dayDesc = sanitize_string($dayItem['description'] ?? '');

                if (!empty($dayTitle) || !empty($dayDesc)) {
                    $cleanItinerary[] = [
                        'day_number' => $dayNum,
                        'title' => !empty($dayTitle) ? $dayTitle : ('Day ' . $dayNum),
                        'description' => $dayDesc
                    ];
                    $daySeq = $dayNum + 1;
                }
            }
        }

        $bookingStatus = in_array($input['booking_status'] ?? '', ['AVAILABLE', 'ON_REQUEST', 'UNAVAILABLE'], true) 
            ? $input['booking_status'] 
            : 'AVAILABLE';

        $data = [
            'category_id' => !empty($input['category_id']) ? (int)$input['category_id'] : null,
            'title' => $title,
            'slug' => $slug,
            'short_description' => sanitize_string($input['short_description'] ?? ''),
            'description' => $input['description'] ?? '', // Allow full overview html/formatting
            'tour_type' => sanitize_string($input['tour_type'] ?? ''),
            'route' => sanitize_string($input['route'] ?? ''),
            'location_summary' => sanitize_string($input['location_summary'] ?? ''),
            'duration_days' => $durationDays,
            'duration_nights' => $durationNights,
            'locations' => sanitize_string($input['locations'] ?? ''),
            'featured_image' => $input['featured_image'] ?? null,
            'status' => in_array($input['status'] ?? '', ['ACTIVE', 'INACTIVE'], true) ? $input['status'] : 'ACTIVE',
            'booking_status' => $bookingStatus,
            'is_featured' => isset($input['is_featured']) && ($input['is_featured'] == 1 || $input['is_featured'] === 'on') ? 1 : 0,
            'display_order' => (int)($input['display_order'] ?? 0)
        ];

        try {
            $this->tourDAL->beginTransaction();

            if ($id === null) {
                $tourId = $this->tourDAL->createTour($data);
            } else {
                $tourId = $id;
                // Retain existing featured_image if none uploaded during edit
                if (empty($data['featured_image'])) {
                    $existing = $this->tourDAL->findById($id);
                    if ($existing && !empty($existing['featured_image'])) {
                        $data['featured_image'] = $existing['featured_image'];
                    }
                }
                $this->tourDAL->updateTour($tourId, $data);
            }

            // Save child tables atomically
            $this->tourDAL->replaceTourItineraryDays($tourId, $cleanItinerary);
            $this->tourDAL->replaceTourInclusions($tourId, $cleanInclusions);
            $this->tourDAL->replaceTourHighlights($tourId, $cleanHighlights);

            $this->tourDAL->commit();

            return [
                'success' => true,
                'id' => $tourId,
                'message' => ($id === null) ? 'Tour package created successfully.' : 'Tour package updated successfully.'
            ];
        } catch (Exception $ex) {
            $this->tourDAL->rollBack();
            return [
                'success' => false,
                'message' => 'Failed to save tour package: ' . $ex->getMessage()
            ];
        }
    }

    /**
     * Delete a tour package
     */
    public function deleteTour(int $id): array
    {
        try {
            $deleted = $this->tourDAL->deleteTour($id);
            if ($deleted) {
                return ['success' => true, 'message' => 'Tour package deleted successfully.'];
            }
            return ['success' => false, 'message' => 'Failed to delete tour package.'];
        } catch (Exception $ex) {
            return ['success' => false, 'message' => 'Error deleting tour package: ' . $ex->getMessage()];
        }
    }
}
