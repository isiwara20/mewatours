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
        $categories = $this->experienceBLL->getCategories();
        $featuredExperience = $this->experienceBLL->getSingleFeaturedExperience();

        render_view('client/experiences', [
            'page_title' => 'Authentic Sri Lankan Travel Experiences & Activities | Mewa Tours',
            'experiences' => $experiences,
            'categories' => $categories,
            'featured_experience' => $featuredExperience
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

        $allExperiences = $this->experienceBLL->getActiveExperiences();
        $relatedExperiences = array_filter($allExperiences, fn($e) => (int)$e['id'] !== (int)$experience['id']);
        $relatedExperiences = array_slice($relatedExperiences, 0, 3);

        render_view('client/experience-details', [
            'page_title' => $experience['name'] . ' | Mewa Tours Sri Lanka',
            'experience' => $experience,
            'related_experiences' => $relatedExperiences
        ]);
    }
}
