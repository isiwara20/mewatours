<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Gallery Controller
 */
class GalleryController
{
    private GalleryBLL $galleryBLL;

    public function __construct()
    {
        $this->galleryBLL = new GalleryBLL();
    }

    public function index(): void
    {
        $items = $this->galleryBLL->getActiveGalleryItems();

        render_view('client/gallery', [
            'page_title' => 'Photo Gallery - Mewa Tours Sri Lanka',
            'gallery_items' => $items
        ]);
    }
}
