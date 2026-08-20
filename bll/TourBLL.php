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

    public function getActiveTours(): array
    {
        $tours = $this->tourDAL->getAllTours(true);
        foreach ($tours as &$tour) {
            $tour['formatted_duration'] = format_duration((int)$tour['duration_days'], (int)$tour['duration_nights']);
            $waMessage = $this->whatsAppService->buildTourInquiryMessage(
                $tour['title'],
                $tour['formatted_duration']
            );
            $tour['whatsapp_url'] = $this->whatsAppService->generateInquiryLink($waMessage);
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
            $tour['formatted_duration'] = format_duration((int)$tour['duration_days'], (int)$tour['duration_nights']);
            $waMessage = $this->whatsAppService->buildTourInquiryMessage(
                $tour['title'],
                $tour['formatted_duration']
            );
            $tour['whatsapp_url'] = $this->whatsAppService->generateInquiryLink($waMessage);
        }
        return $tour;
    }

    public function getFeaturedTours(int $limit = 6): array
    {
        return $this->tourDAL->getFeaturedTours($limit);
    }

    public function getTourDetailsBySlug(string $slug): ?array
    {
        $tour = $this->tourDAL->findBySlug($slug);
        if ($tour) {
            $tour['gallery_images'] = $this->tourDAL->getTourImages((int)$tour['id']);
            $tour['formatted_duration'] = format_duration((int)$tour['duration_days'], (int)$tour['duration_nights']);
            
            // Build WhatsApp deep link for this specific tour
            $waMessage = $this->whatsAppService->buildTourInquiryMessage(
                $tour['title'],
                $tour['formatted_duration']
            );
            $tour['whatsapp_url'] = $this->whatsAppService->generateInquiryLink($waMessage);
        }
        return $tour;
    }

    public function saveTour(array $input, ?int $id = null): array
    {
        $title = sanitize_string($input['title'] ?? '');
        if (empty($title)) {
            return ['success' => false, 'message' => 'Tour title is required.'];
        }

        $slug = !empty($input['slug']) ? generate_slug($input['slug']) : generate_slug($title);
        $durationDays = max(1, (int)($input['duration_days'] ?? 1));
        $durationNights = max(0, (int)($input['duration_nights'] ?? 0));

        $data = [
            'category_id' => !empty($input['category_id']) ? (int)$input['category_id'] : null,
            'title' => $title,
            'slug' => $slug,
            'short_description' => sanitize_string($input['short_description'] ?? ''),
            'description' => $input['description'] ?? '', // Allow HTML formatting for detailed description
            'duration_days' => $durationDays,
            'duration_nights' => $durationNights,
            'locations' => sanitize_string($input['locations'] ?? ''),
            'featured_image' => $input['featured_image'] ?? null,
            'status' => in_array($input['status'] ?? '', ['ACTIVE', 'INACTIVE'], true) ? $input['status'] : 'ACTIVE',
            'is_featured' => isset($input['is_featured']) ? 1 : 0,
            'display_order' => (int)($input['display_order'] ?? 0)
        ];

        if ($id === null) {
            $newId = $this->tourDAL->createTour($data);
            return ['success' => true, 'id' => $newId, 'message' => 'Tour created successfully.'];
        } else {
            $updated = $this->tourDAL->updateTour($id, $data);
            return ['success' => $updated, 'message' => $updated ? 'Tour updated successfully.' : 'Failed to update tour.'];
        }
    }
}
