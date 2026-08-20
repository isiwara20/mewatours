<?php
declare(strict_types=1);

/**
 * Mewa Tours - Business Logic Layer for Destinations
 */
class DestinationBLL
{
    private DestinationDAL $destinationDAL;

    public function __construct()
    {
        $this->destinationDAL = new DestinationDAL();
    }

    public function getActiveDestinations(): array
    {
        $destinations = $this->destinationDAL->getAllDestinations(true);
        $wa = new WhatsAppService();
        foreach ($destinations as &$dest) {
            $msg = "Hello Mewa Tours,\n\nI am interested in exploring " . $dest['name'] . ".\nDestination: " . $dest['name'] . "\n\nPlease send me details and tour recommendations including this destination. Thank you!";
            $dest['whatsapp_url'] = $wa->generateInquiryLink($msg);
        }
        return $destinations;
    }

    public function getFeaturedDestinations(int $limit = 6): array
    {
        return $this->destinationDAL->getFeaturedDestinations($limit);
    }

    public function getSingleFeaturedDestination(): ?array
    {
        $dest = $this->destinationDAL->getSingleFeaturedDestination();
        if ($dest) {
            $wa = new WhatsAppService();
            $msg = "Hello Mewa Tours,\n\nI am interested in exploring " . $dest['name'] . ".\nDestination: " . $dest['name'] . "\n\nPlease send me details and tour recommendations including this destination. Thank you!";
            $dest['whatsapp_url'] = $wa->generateInquiryLink($msg);
        }
        return $dest;
    }

    public function getDestinationDetailsBySlug(string $slug): ?array
    {
        return $this->destinationDAL->findBySlug($slug);
    }

    public function saveDestination(array $input, ?int $id = null): array
    {
        $name = sanitize_string($input['name'] ?? '');
        if (empty($name)) {
            return ['success' => false, 'message' => 'Destination name is required.'];
        }

        $slug = !empty($input['slug']) ? generate_slug($input['slug']) : generate_slug($name);

        $data = [
            'name' => $name,
            'slug' => $slug,
            'short_description' => sanitize_string($input['short_description'] ?? ''),
            'description' => $input['description'] ?? '',
            'featured_image' => $input['featured_image'] ?? null,
            'status' => in_array($input['status'] ?? '', ['ACTIVE', 'INACTIVE'], true) ? $input['status'] : 'ACTIVE',
            'is_featured' => isset($input['is_featured']) ? 1 : 0,
            'display_order' => (int)($input['display_order'] ?? 0)
        ];

        if ($id === null) {
            $newId = $this->destinationDAL->createDestination($data);
            return ['success' => true, 'id' => $newId, 'message' => 'Destination created successfully.'];
        } else {
            $updated = $this->destinationDAL->updateDestination($id, $data);
            return ['success' => $updated, 'message' => $updated ? 'Destination updated successfully.' : 'Failed to update destination.'];
        }
    }
}
