<?php
declare(strict_types=1);

/**
 * Mewa Tours - Business Logic Layer for Experiences
 */
class ExperienceBLL
{
    private ExperienceDAL $experienceDAL;

    public function __construct()
    {
        $this->experienceDAL = new ExperienceDAL();
    }

    public function getActiveExperiences(): array
    {
        return $this->experienceDAL->getAllExperiences(true);
    }

    public function getFeaturedExperiences(int $limit = 6): array
    {
        return $this->experienceDAL->getFeaturedExperiences($limit);
    }

    public function getExperienceDetailsBySlug(string $slug): ?array
    {
        return $this->experienceDAL->findBySlug($slug);
    }

    public function saveExperience(array $input, ?int $id = null): array
    {
        $name = sanitize_string($input['name'] ?? '');
        if (empty($name)) {
            return ['success' => false, 'message' => 'Experience name is required.'];
        }

        $slug = !empty($input['slug']) ? generate_slug($input['slug']) : generate_slug($name);

        $data = [
            'category_id' => !empty($input['category_id']) ? (int)$input['category_id'] : null,
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
            $newId = $this->experienceDAL->createExperience($data);
            return ['success' => true, 'id' => $newId, 'message' => 'Experience created successfully.'];
        } else {
            $updated = $this->experienceDAL->updateExperience($id, $data);
            return ['success' => $updated, 'message' => $updated ? 'Experience updated successfully.' : 'Failed to update experience.'];
        }
    }
}
