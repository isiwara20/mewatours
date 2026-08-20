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
        return $this->galleryDAL->getAllItems(true);
    }

    public function saveGalleryItem(array $input): array
    {
        if (empty($input['image'])) {
            return ['success' => false, 'message' => 'Image path is required for gallery item.'];
        }

        $data = [
            'title' => sanitize_string($input['title'] ?? ''),
            'image' => $input['image'],
            'category' => sanitize_string($input['category'] ?? 'general'),
            'alt_text' => sanitize_string($input['alt_text'] ?? $input['title'] ?? ''),
            'status' => 'ACTIVE',
            'display_order' => (int)($input['display_order'] ?? 0)
        ];

        $id = $this->galleryDAL->createItem($data);
        return ['success' => true, 'id' => $id, 'message' => 'Gallery item added successfully.'];
    }
}
