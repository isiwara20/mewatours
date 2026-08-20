<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Experiences Controller
 */
class ExperienceController
{
    private ExperienceBLL $experienceBLL;

    public function __construct()
    {
        $this->experienceBLL = new ExperienceBLL();
    }

    public function index(): void
    {
        $experiences = $this->experienceBLL->getActiveExperiences();

        render_view('client/experiences', [
            'page_title' => 'Sri Lankan Travel Experiences & Activities - Mewa Tours',
            'experiences' => $experiences
        ]);
    }

    public function details(string $slug): void
    {
        $experience = $this->experienceBLL->getExperienceDetailsBySlug($slug);

        if (!$experience) {
            render_view('errors/404', [
                'page_title' => 'Experience Not Found - Mewa Tours'
            ]);
            return;
        }

        render_view('client/experience-details', [
            'page_title' => $experience['name'] . ' - Mewa Tours',
            'experience' => $experience
        ]);
    }
}
