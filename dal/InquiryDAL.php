<?php
declare(strict_types=1);

/**
 * Mewa Tours - Data Access Layer for Customer Inquiries
 */
class InquiryDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Store new customer inquiry
     */
    public function createInquiry(array $data): int
    {
        $sql = "INSERT INTO inquiries (
                    tour_id, name, email, phone, country, 
                    travel_date, traveller_count, message, source, status, 
                    created_at, updated_at
                ) VALUES (
                    :tour_id, :name, :email, :phone, :country, 
                    :travel_date, :traveller_count, :message, :source, :status, 
                    CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                )";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':tour_id' => $data['tour_id'] ?? null,
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'] ?? null,
            ':country' => $data['country'] ?? null,
            ':travel_date' => $data['travel_date'] ?? null,
            ':traveller_count' => $data['traveller_count'] ?? 1,
            ':message' => $data['message'],
            ':source' => $data['source'] ?? 'CONTACT_FORM',
            ':status' => $data['status'] ?? 'NEW'
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Get all customer inquiries for admin dashboard
     */
    public function getAllInquiries(): array
    {
        $sql = "SELECT i.*, t.title AS tour_title 
                FROM inquiries i 
                LEFT JOIN tours t ON i.tour_id = t.id 
                ORDER BY i.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Find inquiry by ID
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT i.*, t.title AS tour_title 
                FROM inquiries i 
                LEFT JOIN tours t ON i.tour_id = t.id 
                WHERE i.id = :id 
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    /**
     * Update inquiry processing status (NEW, CONTACTED, IN_PROGRESS, CLOSED, CANCELLED)
     */
    public function updateStatus(int $id, string $status): bool
    {
        $sql = "UPDATE inquiries 
                SET status = :status, updated_at = CURRENT_TIMESTAMP 
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':status' => strtoupper($status),
            ':id' => $id
        ]);
    }

    /**
     * Delete inquiry record
     */
    public function deleteInquiry(int $id): bool
    {
        $sql = "DELETE FROM inquiries WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
