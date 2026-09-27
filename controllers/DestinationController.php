<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Destinations Controller
 */
class DestinationController
{
    private DestinationBLL $destinationBLL;

    public function __construct()
    {
        $this->destinationBLL = new DestinationBLL();
    }

    public function index(): void
    {
        $destinations = $this->destinationBLL->getActiveDestinations();
        $featuredDestination = $this->destinationBLL->getSingleFeaturedDestination();

        render_view('client/destinations', [
            'page_title' => 'Unforgettable Sri Lanka Destinations & Places to Visit | Mewa Tours',
            'destinations' => $destinations,
            'featured_destination' => $featuredDestination
        ]);
    }

    public function details(string $slug): void
    {
        $destination = $this->destinationBLL->getDestinationDetailsBySlug($slug);

        if (!$destination) {
            render_view('errors/404', [
                'page_title' => 'Destination Not Found - Mewa Tours'
            ]);
            return;
        }

        $allDestinations = $this->destinationBLL->getActiveDestinations();
        $relatedDestinations = array_filter($allDestinations, fn($d) => (int)$d['id'] !== (int)$destination['id']);
        $relatedDestinations = array_slice($relatedDestinations, 0, 3);

        render_view('client/destination-details', [
            'page_title' => $destination['name'] . ' | Mewa Tours Sri Lanka',
            'destination' => $destination,
            'related_destinations' => $relatedDestinations
        ]);
    }
}
