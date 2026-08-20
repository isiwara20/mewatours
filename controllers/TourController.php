<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Tours Controller
 */
class TourController
{
    private TourBLL $tourBLL;

    public function __construct()
    {
        $this->tourBLL = new TourBLL();
    }

    /**
     * List all public tours
     */
    public function index(): void
    {
        $tours = $this->tourBLL->getActiveTours();
        $categories = $this->tourBLL->getCategories();
        $featuredTour = $this->tourBLL->getSingleFeaturedTour();

        render_view('client/tours', [
            'page_title' => 'Curated Sri Lanka Tours & Tailor-Made Packages | Mewa Tours',
            'tours' => $tours,
            'categories' => $categories,
            'featured_tour' => $featuredTour
        ]);
    }

    /**
     * View individual tour package details
     */
    public function details(string $slug): void
    {
        $tour = $this->tourBLL->getTourDetailsBySlug($slug);

        if (!$tour) {
            render_view('errors/404', [
                'page_title' => 'Tour Not Found - Mewa Tours'
            ]);
            return;
        }

        render_view('client/tour-details', [
            'page_title' => $tour['title'] . ' - Mewa Tours',
            'tour' => $tour
        ]);
    }
}
