<?php
declare(strict_types=1);

/**
 * Mewa Tours - Data Access Layer for Destinations
 */
class DestinationDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAllDestinations(bool $onlyActive = true): array
    {
        $sql = "SELECT * FROM destinations";
        if ($onlyActive) {
            $sql .= " WHERE status = 'ACTIVE'";
        }
        $sql .= " ORDER BY display_order ASC, created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getFeaturedDestinations(int $limit = 6): array
    {
        $sql = "SELECT * FROM destinations 
                WHERE status = 'ACTIVE' AND is_featured = 1 
                ORDER BY display_order ASC, created_at DESC 
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getSingleFeaturedDestination(): ?array
    {
        $sql = "SELECT * FROM destinations 
                WHERE status = 'ACTIVE' AND slug = 'ella' 
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch();

        if (!$record) {
            $sql = "SELECT * FROM destinations WHERE status = 'ACTIVE' AND is_featured = 1 LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $record = $stmt->fetch();
        }

        return $record ?: null;
    }

    public function findBySlug(string $slug): ?array
    {
        $sql = "SELECT * FROM destinations WHERE slug = :slug AND status = 'ACTIVE' LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':slug' => $slug]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM destinations WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    public function createDestination(array $data): int
    {
        $sql = "INSERT INTO destinations (name, slug, short_description, description, featured_image, status, is_featured, display_order, created_at, updated_at) 
                VALUES (:name, :slug, :short_description, :description, :featured_image, :status, :is_featured, :display_order, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
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

    public function updateDestination(int $id, array $data): bool
    {
        $sql = "UPDATE destinations SET 
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

    public function deleteDestination(int $id): bool
    {
        $sql = "DELETE FROM destinations WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
