<?php
declare(strict_types=1);

/**
 * Mewa Tours - Data Access Layer for Tour Packages
 */
class TourDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Retrieve all tours with optional status filter
     */
    public function getAllTours(bool $onlyActive = true): array
    {
        $sql = "SELECT t.*, c.name AS category_name 
                FROM tours t 
                LEFT JOIN tour_categories c ON t.category_id = c.id";

        if ($onlyActive) {
            $sql .= " WHERE t.status = 'ACTIVE'";
        }

        $sql .= " ORDER BY t.display_order ASC, t.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get all tour categories
     */
    public function getCategories(): array
    {
        $sql = "SELECT * FROM tour_categories ORDER BY id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get single featured tour for signature highlight
     */
    public function getSingleFeaturedTour(): ?array
    {
        $sql = "SELECT t.*, c.name AS category_name, c.slug AS category_slug 
                FROM tours t 
                LEFT JOIN tour_categories c ON t.category_id = c.id 
                WHERE t.status = 'ACTIVE' AND t.is_featured = 1 
                ORDER BY t.display_order ASC, t.created_at DESC 
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch();
        return $record ?: null;
    }

    /**
     * Get featured tours for public landing page
     */
    public function getFeaturedTours(int $limit = 6): array
    {
        $sql = "SELECT t.*, c.name AS category_name 
                FROM tours t 
                LEFT JOIN tour_categories c ON t.category_id = c.id 
                WHERE t.status = 'ACTIVE' AND t.is_featured = 1 
                ORDER BY t.display_order ASC, t.created_at DESC 
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Find tour by unique URL slug
     */
    public function findBySlug(string $slug): ?array
    {
        $sql = "SELECT t.*, c.name AS category_name 
                FROM tours t 
                LEFT JOIN tour_categories c ON t.category_id = c.id 
                WHERE t.slug = :slug AND t.status = 'ACTIVE' 
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':slug' => $slug]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    /**
     * Find tour by ID
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT t.*, c.name AS category_name 
                FROM tours t 
                LEFT JOIN tour_categories c ON t.category_id = c.id 
                WHERE t.id = :id 
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    /**
     * Get additional gallery images for a tour
     */
    public function getTourImages(int $tourId): array
    {
        $sql = "SELECT * FROM tour_images 
                WHERE tour_id = :tour_id 
                ORDER BY display_order ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':tour_id' => $tourId]);
        return $stmt->fetchAll();
    }

    /**
     * Create new tour record
     */
    public function createTour(array $data): int
    {
        $sql = "INSERT INTO tours (
                    category_id, title, slug, short_description, description, 
                    duration_days, duration_nights, locations, featured_image, 
                    status, is_featured, display_order, created_at, updated_at
                ) VALUES (
                    :category_id, :title, :slug, :short_description, :description, 
                    :duration_days, :duration_nights, :locations, :featured_image, 
                    :status, :is_featured, :display_order, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                )";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':category_id' => $data['category_id'] ?? null,
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':short_description' => $data['short_description'] ?? null,
            ':description' => $data['description'] ?? null,
            ':duration_days' => $data['duration_days'] ?? 1,
            ':duration_nights' => $data['duration_nights'] ?? 0,
            ':locations' => $data['locations'] ?? null,
            ':featured_image' => $data['featured_image'] ?? null,
            ':status' => $data['status'] ?? 'ACTIVE',
            ':is_featured' => $data['is_featured'] ?? 0,
            ':display_order' => $data['display_order'] ?? 0
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Update existing tour record
     */
    public function updateTour(int $id, array $data): bool
    {
        $sql = "UPDATE tours SET 
                    category_id = :category_id,
                    title = :title,
                    slug = :slug,
                    short_description = :short_description,
                    description = :description,
                    duration_days = :duration_days,
                    duration_nights = :duration_nights,
                    locations = :locations,
                    featured_image = :featured_image,
                    status = :status,
                    is_featured = :is_featured,
                    display_order = :display_order,
                    updated_at = CURRENT_TIMESTAMP 
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':category_id' => $data['category_id'] ?? null,
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':short_description' => $data['short_description'] ?? null,
            ':description' => $data['description'] ?? null,
            ':duration_days' => $data['duration_days'] ?? 1,
            ':duration_nights' => $data['duration_nights'] ?? 0,
            ':locations' => $data['locations'] ?? null,
            ':featured_image' => $data['featured_image'] ?? null,
            ':status' => $data['status'] ?? 'ACTIVE',
            ':is_featured' => $data['is_featured'] ?? 0,
            ':display_order' => $data['display_order'] ?? 0,
            ':id' => $id
        ]);
    }

    /**
     * Delete tour record
     */
    public function deleteTour(int $id): bool
    {
        $sql = "DELETE FROM tours WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
