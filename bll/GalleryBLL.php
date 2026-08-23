<?php
declare(strict_types=1);

/**
 * Mewa Tours - Business Logic Layer for Gallery
 */
class GalleryBLL
{
    private GalleryDAL $galleryDAL;

    public function __construct()
    {
        $this->galleryDAL = new GalleryDAL();
    }

    public function getActiveGalleryItems(): array
    {
        $items = $this->galleryDAL->getAllItems(true);
        if (empty($items)) {
            return $this->getFallbackGalleryItems();
        }
        return $items;
    }

    public function getFallbackGalleryItems(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Guided Wild Elephant Safari',
                'image' => 'Gallery/WhatsApp Image 2026-08-18 at 09.19.55.jpeg',
                'category' => 'wildlife',
                'alt_text' => 'Expert Mewa Tours guide spotting wild elephants on a 4x4 safari.',
                'description' => 'Spot wild elephant herds up close with experienced wildlife guides in Sri Lankan national parks.'
            ],
            [
                'id' => 2,
                'title' => 'Pidurangala Rock Summit Hike',
                'image' => 'Gallery/WhatsApp Image 2026-08-18 at 09.20.58.jpeg',
                'category' => 'highlands',
                'alt_text' => 'Reaching the top of Pidurangala Rock with panoramic views of Sigiriya Fortress.',
                'description' => 'Trek to the summit of Pidurangala for breathtaking sunrise views of Sigiriya Rock Fortress.'
            ],
            [
                'id' => 3,
                'title' => 'Galle Dutch Fort Heritage Tour',
                'image' => 'Gallery/WhatsApp Image 2026-08-18 at 09.20.33.jpeg',
                'category' => 'culture',
                'alt_text' => 'Happy family exploring the ancient stone ramparts of Galle Dutch Fort.',
                'description' => 'Walk along centuries-old colonial bastions and oceanside stone walls in UNESCO Galle Fort.'
            ],
            [
                'id' => 4,
                'title' => 'Traditional Village Cooking Experience',
                'image' => 'Gallery/1.jpeg',
                'category' => 'culinary',
                'alt_text' => 'Guests participating in hands-on Sri Lankan clay-pot cooking in a local village.',
                'description' => 'Learn to prepare traditional Sri Lankan clay pot rice and curry dishes with local village hosts.'
            ],
            [
                'id' => 5,
                'title' => 'Authentic Sri Lankan Claypot Feast',
                'image' => 'Gallery/WhatsApp Image 2026-08-18 at 09.20.59.jpeg',
                'category' => 'culinary',
                'alt_text' => 'Enjoying a traditional Sri Lankan rice and curry feast served in clay pots.',
                'description' => 'Savor an array of traditional aromatic claypot curries served on woven coconut mats.'
            ],
            [
                'id' => 6,
                'title' => 'Wild Elephant Gathering at Minneriya',
                'image' => 'Gallery/WhatsApp Image 2026-08-18 at 09.23.1.jpeg',
                'category' => 'wildlife',
                'alt_text' => 'A massive wild elephant herd gathering near the reservoir lakes.',
                'description' => 'Witness Asia\'s largest natural gathering of wild elephants by scenic reservoir lakes.'
            ],
            [
                'id' => 7,
                'title' => 'Traditional Lotus Lake Boat Safari',
                'image' => 'Gallery/WhatsApp Image 2026-08-18 at 09.23.10.jpeg',
                'category' => 'experiences',
                'alt_text' => 'Scenic catamaran boat ride on a lily-draped lake wearing lotus leaf sun hats.',
                'description' => 'Relax on a tranquil village lake catamaran safari wearing handmade lotus leaf hats.'
            ],
            [
                'id' => 8,
                'title' => 'Fun Island Tuk-Tuk Experience',
                'image' => 'Gallery/WhatsApp Image 2026-08-18 at 09.23.11.jpeg',
                'category' => 'experiences',
                'alt_text' => 'Trying out the driver seat of a Sri Lankan three-wheeler tuk-tuk.',
                'description' => 'Experience the authentic thrill of riding and exploring in Sri Lanka\'s legendary three-wheeler.'
            ],
            [
                'id' => 9,
                'title' => 'Up-Close Safari Encounter',
                'image' => 'Gallery/WhatsApp Image 2026-08-18 at 09.23.12.jpeg',
                'category' => 'wildlife',
                'alt_text' => 'Close-up safari experience with wild elephants in their natural habitat.',
                'description' => 'Unforgettable close-range wildlife encounters during our open-top 4x4 park safaris.'
            ]
        ];
    }

    public function getAdminGalleryItems(): array
    {
        return $this->galleryDAL->getAllItems(false);
    }

    public function getGalleryItemById(int $id): ?array
    {
        return $this->galleryDAL->getItemById($id);
    }

    public function saveGalleryItem(array $input, ?int $id = null): array
    {
        if ($id !== null) {
            $existing = $this->galleryDAL->getItemById($id);
            if (!$existing) {
                return ['success' => false, 'message' => 'Gallery photo item not found.'];
            }
            $imagePath = !empty($input['image']) ? $input['image'] : $existing['image'];
        } else {
            if (empty($input['image'])) {
                return ['success' => false, 'message' => 'Image path or upload file is required for gallery photo.'];
            }
            $imagePath = $input['image'];
        }

        $data = [
            'title' => sanitize_string($input['title'] ?? ''),
            'image' => $imagePath,
            'category' => sanitize_string($input['category'] ?? 'general'),
            'alt_text' => sanitize_string($input['alt_text'] ?? $input['title'] ?? ''),
            'status' => in_array($input['status'] ?? '', ['ACTIVE', 'INACTIVE'], true) ? $input['status'] : 'ACTIVE',
            'display_order' => (int)($input['display_order'] ?? 0)
        ];

        if ($id === null) {
            $newId = $this->galleryDAL->createItem($data);
            return ['success' => true, 'id' => $newId, 'message' => 'Gallery photo added successfully.'];
        } else {
            $updated = $this->galleryDAL->updateItem($id, $data);
            return ['success' => $updated, 'id' => $id, 'message' => $updated ? 'Gallery photo updated successfully.' : 'Failed to update gallery photo.'];
        }
    }

    public function deleteGalleryItem(int $id): array
    {
        if ($id <= 0) {
            return ['success' => false, 'message' => 'Invalid gallery item ID.'];
        }

        $deleted = $this->galleryDAL->deleteItem($id);
        return [
            'success' => $deleted,
            'message' => $deleted ? 'Gallery item deleted successfully.' : 'Failed to delete gallery item.'
        ];
    }
}

