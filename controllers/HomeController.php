<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Home Controller
 */
class HomeController
{
    private TourBLL $tourBLL;
    private DestinationBLL $destinationBLL;
    private ExperienceBLL $experienceBLL;

    public function __construct()
    {
        $this->tourBLL = new TourBLL();
        $this->destinationBLL = new DestinationBLL();
        $this->experienceBLL = new ExperienceBLL();
    }

    /**
     * Render Home Page Foundation
     */
    public function index(): void
    {
        $featuredTours = $this->tourBLL->getFeaturedTours(6);
        $featuredDestinations = $this->destinationBLL->getFeaturedDestinations(6);
        $featuredExperiences = $this->experienceBLL->getFeaturedExperiences(4);

        render_view('client/home', [
            'page_title' => 'Mewa Tours - Authentic Sri Lankan Travel & Tour Packages',
            'featured_tours' => $featuredTours,
            'featured_destinations' => $featuredDestinations,
            'featured_experiences' => $featuredExperiences
        ]);
    }
}
