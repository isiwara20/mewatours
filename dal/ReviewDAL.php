<?php
declare(strict_types=1);

/**
 * Mewa Tours - Customer Review Data Access Layer (DAL)
 */
class ReviewDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
        $this->ensureTableExists();
    }

    /**
     * Auto-ensure table exists in MySQL database
     */
    private function ensureTableExists(): void
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS `reviews` (
              `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              `customer_name` VARCHAR(150) NOT NULL,
              `customer_email` VARCHAR(150) NOT NULL,
              `customer_country` VARCHAR(100) DEFAULT 'Sri Lanka',
              `tour_id` BIGINT UNSIGNED DEFAULT NULL,
              `rating` TINYINT UNSIGNED NOT NULL CHECK (`rating` BETWEEN 1 AND 5),
              `category` VARCHAR(100) DEFAULT 'General Experience',
              `title` VARCHAR(255) NOT NULL,
              `comment` TEXT NOT NULL,
              `photo_path` VARCHAR(255) DEFAULT NULL,
              `status` ENUM('PENDING', 'APPROVED', 'REJECTED') NOT NULL DEFAULT 'APPROVED',
              `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
              `admin_reply` TEXT DEFAULT NULL,
              `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              INDEX `idx_reviews_status` (`status`),
              INDEX `idx_reviews_rating` (`rating`),
              INDEX `idx_reviews_featured` (`is_featured`),
              INDEX `idx_reviews_tour` (`tour_id`),
              CONSTRAINT `fk_reviews_tour` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
            
            $this->db->exec($sql);
        } catch (PDOException $e) {
            // Ignore if table or foreign key already exists
        }
    }

    /**
     * Get approved customer reviews with pagination/filtering
     */
    public function getApprovedReviews(?int $tourId = null, int $limit = 20, int $offset = 0): array
    {
        $sql = "SELECT r.*, t.title as tour_title, t.slug as tour_slug 
                FROM `reviews` r
                LEFT JOIN `tours` t ON r.tour_id = t.id
                WHERE r.status = 'APPROVED'";
        
        $params = [];
        if ($tourId !== null && $tourId > 0) {
            $sql .= " AND r.tour_id = :tour_id";
            $params[':tour_id'] = $tourId;
        }

        $sql .= " ORDER BY r.created_at DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val, PDO::PARAM_INT);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get top featured 5-star reviews for homepage slider
     */
    public function getFeaturedReviews(int $limit = 6): array
    {
        $sql = "SELECT r.*, t.title as tour_title, t.slug as tour_slug 
                FROM `reviews` r
                LEFT JOIN `tours` t ON r.tour_id = t.id
                WHERE r.status = 'APPROVED' AND r.rating >= 4
                ORDER BY r.is_featured DESC, r.created_at DESC 
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get rating statistics (overall average, total count, rating distribution)
     */
    public function getRatingStatistics(): array
    {
        $sql = "SELECT 
                    COUNT(*) as total_reviews,
                    COALESCE(AVG(rating), 5.0) as average_rating,
                    SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as count_5,
                    SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as count_4,
                    SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as count_3,
                    SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as count_2,
                    SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as count_1
                FROM `reviews` 
                WHERE status = 'APPROVED'";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats = $stmt->fetch();

        if (!$stats || $stats['total_reviews'] == 0) {
            return [
                'total_reviews' => 0,
                'average_rating' => 5.0,
                'count_5' => 0,
                'count_4' => 0,
                'count_3' => 0,
                'count_2' => 0,
                'count_1' => 0,
            ];
        }

        $stats['average_rating'] = round((float)$stats['average_rating'], 1);
        return $stats;
    }

    /**
     * Insert new customer review
     */
    public function createReview(array $data): bool
    {
        $sql = "INSERT INTO `reviews` 
                (`customer_name`, `customer_email`, `customer_country`, `tour_id`, `rating`, `category`, `title`, `comment`, `photo_path`, `status`, `is_featured`, `created_at`) 
                VALUES 
                (:customer_name, :customer_email, :customer_country, :tour_id, :rating, :category, :title, :comment, :photo_path, :status, :is_featured, NOW())";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':customer_name' => $data['customer_name'],
            ':customer_email' => $data['customer_email'],
            ':customer_country' => $data['customer_country'] ?? 'Sri Lanka',
            ':tour_id' => !empty($data['tour_id']) ? (int)$data['tour_id'] : null,
            ':rating' => (int)$data['rating'],
            ':category' => $data['category'] ?? 'General Experience',
            ':title' => $data['title'],
            ':comment' => $data['comment'],
            ':photo_path' => $data['photo_path'] ?? null,
            ':status' => $data['status'] ?? 'APPROVED',
            ':is_featured' => !empty($data['is_featured']) ? 1 : 0
        ]);
    }
}
