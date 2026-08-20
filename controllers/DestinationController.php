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

        render_view('client/destinations', [
            'page_title' => 'Sri Lankan Destinations - Mewa Tours',
            'destinations' => $destinations
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

        render_view('client/destination-details', [
            'page_title' => $destination['name'] . ' - Mewa Tours',
            'destination' => $destination
        ]);
    }
}
