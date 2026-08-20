<?php
declare(strict_types=1);

/**
 * Mewa Tours - Data Access Layer for Experiences & Activities
 */
class ExperienceDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAllExperiences(bool $onlyActive = true): array
    {
        $sql = "SELECT e.*, c.name AS category_name 
                FROM experiences e 
                LEFT JOIN experience_categories c ON e.category_id = c.id";

        if ($onlyActive) {
            $sql .= " WHERE e.status = 'ACTIVE'";
        }
        $sql .= " ORDER BY e.display_order ASC, e.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getFeaturedExperiences(int $limit = 6): array
    {
        $sql = "SELECT e.*, c.name AS category_name 
                FROM experiences e 
                LEFT JOIN experience_categories c ON e.category_id = c.id 
                WHERE e.status = 'ACTIVE' AND e.is_featured = 1 
                ORDER BY e.display_order ASC, e.created_at DESC 
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findBySlug(string $slug): ?array
    {
        $sql = "SELECT e.*, c.name AS category_name 
                FROM experiences e 
                LEFT JOIN experience_categories c ON e.category_id = c.id 
                WHERE e.slug = :slug AND e.status = 'ACTIVE' 
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':slug' => $slug]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT e.*, c.name AS category_name 
                FROM experiences e 
                LEFT JOIN experience_categories c ON e.category_id = c.id 
                WHERE e.id = :id 
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    public function createExperience(array $data): int
    {
        $sql = "INSERT INTO experiences (category_id, name, slug, short_description, description, featured_image, status, is_featured, display_order, created_at, updated_at) 
                VALUES (:category_id, :name, :slug, :short_description, :description, :featured_image, :status, :is_featured, :display_order, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':category_id' => $data['category_id'] ?? null,
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':short_description' => $data['short_description'] ?? null,
            ':description' => $data['description'] ?? null,
            ':featured_image' => $data['featured_image'] ?? null,
            ':status' => $data['status'] ?? 'ACTIVE',
            ':is_featured' => $data['is_featured'] ?? 0,
            ':display_order' => $data['display_order'] ?? 0
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function updateExperience(int $id, array $data): bool
    {
        $sql = "UPDATE experiences SET 
                    category_id = :category_id,
                    name = :name,
                    slug = :slug,
                    short_description = :short_description,
                    description = :description,
                    featured_image = :featured_image,
                    status = :status,
                    is_featured = :is_featured,
                    display_order = :display_order,
                    updated_at = CURRENT_TIMESTAMP 
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':category_id' => $data['category_id'] ?? null,
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':short_description' => $data['short_description'] ?? null,
            ':description' => $data['description'] ?? null,
            ':featured_image' => $data['featured_image'] ?? null,
            ':status' => $data['status'] ?? 'ACTIVE',
            ':is_featured' => $data['is_featured'] ?? 0,
            ':display_order' => $data['display_order'] ?? 0,
            ':id' => $id
        ]);
    }

    public function deleteExperience(int $id): bool
    {
        $sql = "DELETE FROM experiences WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
