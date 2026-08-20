<?php
declare(strict_types=1);

/**
 * Mewa Tours - Data Access Layer for Gallery Items
 */
class GalleryDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAllItems(bool $onlyActive = true): array
    {
        $sql = "SELECT * FROM gallery_items";
        if ($onlyActive) {
            $sql .= " WHERE status = 'ACTIVE'";
        }
        $sql .= " ORDER BY display_order ASC, created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByCategory(string $category): array
    {
        $sql = "SELECT * FROM gallery_items WHERE category = :category AND status = 'ACTIVE' ORDER BY display_order ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':category' => $category]);
        return $stmt->fetchAll();
    }

    public function createItem(array $data): int
    {
        $sql = "INSERT INTO gallery_items (title, image, category, alt_text, status, display_order, created_at) 
                VALUES (:title, :image, :category, :alt_text, :status, :display_order, CURRENT_TIMESTAMP)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':title' => $data['title'] ?? null,
            ':image' => $data['image'],
            ':category' => $data['category'] ?? 'general',
            ':alt_text' => $data['alt_text'] ?? null,
            ':status' => $data['status'] ?? 'ACTIVE',
            ':display_order' => $data['display_order'] ?? 0
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function deleteItem(int $id): bool
    {
        $sql = "DELETE FROM gallery_items WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
