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
     * Transaction Control Methods
     */
    public function beginTransaction(): void
    {
        if (!$this->db->inTransaction()) {
            $this->db->beginTransaction();
        }
    }

    public function commit(): void
    {
        if ($this->db->inTransaction()) {
            $this->db->commit();
        }
    }

    public function rollBack(): void
    {
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }
    }

    /**
     * Retrieve all tours with optional status filter
     */
    public function getAllTours(bool $onlyActive = true): array
    {
        $sql = "SELECT t.*, c.name AS category_name, c.slug AS category_slug 
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
     * Get related tours excluding current tour ID
     */
    public function getRelatedTours(int $currentTourId, ?int $categoryId = null, int $limit = 3): array
    {
        $sql = "SELECT t.*, c.name AS category_name 
                FROM tours t 
                LEFT JOIN tour_categories c ON t.category_id = c.id 
                WHERE t.status = 'ACTIVE' AND t.id != :current_id";

        if ($categoryId !== null && $categoryId > 0) {
            $sql .= " ORDER BY (t.category_id = :cat_id) DESC, t.is_featured DESC, t.display_order ASC";
        } else {
            $sql .= " ORDER BY t.is_featured DESC, t.display_order ASC";
        }

        $sql .= " LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':current_id', $currentTourId, PDO::PARAM_INT);
        if ($categoryId !== null && $categoryId > 0) {
            $stmt->bindValue(':cat_id', $categoryId, PDO::PARAM_INT);
        }
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
     * Get itinerary days for a single tour
     */
    public function getTourItineraryDays(int $tourId): array
    {
        $sql = "SELECT * FROM tour_itinerary_days 
                WHERE tour_id = :tour_id 
                ORDER BY day_number ASC, display_order ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':tour_id' => $tourId]);
        return $stmt->fetchAll();
    }

    /**
     * Get inclusions for a single tour
     */
    public function getTourInclusions(int $tourId): array
    {
        $sql = "SELECT * FROM tour_inclusions 
                WHERE tour_id = :tour_id 
                ORDER BY display_order ASC, id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':tour_id' => $tourId]);
        return $stmt->fetchAll();
    }

    /**
     * Get highlights for a single tour
     */
    public function getTourHighlights(int $tourId): array
    {
        $sql = "SELECT * FROM tour_highlights 
                WHERE tour_id = :tour_id 
                ORDER BY display_order ASC, id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':tour_id' => $tourId]);
        return $stmt->fetchAll();
    }

    /**
     * Eager-load inclusions for multiple tour IDs
     */
    public function getInclusionsForTourIds(array $tourIds): array
    {
        if (empty($tourIds)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($tourIds), '?'));
        $sql = "SELECT * FROM tour_inclusions 
                WHERE tour_id IN ($placeholders) 
                ORDER BY display_order ASC, id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($tourIds));
        $rows = $stmt->fetchAll();

        $result = [];
        foreach ($rows as $row) {
            $result[$row['tour_id']][] = $row;
        }

        return $result;
    }

    /**
     * Eager-load highlights for multiple tour IDs
     */
    public function getHighlightsForTourIds(array $tourIds): array
    {
        if (empty($tourIds)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($tourIds), '?'));
        $sql = "SELECT * FROM tour_highlights 
                WHERE tour_id IN ($placeholders) 
                ORDER BY display_order ASC, id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($tourIds));
        $rows = $stmt->fetchAll();

        $result = [];
        foreach ($rows as $row) {
            $result[$row['tour_id']][] = $row;
        }

        return $result;
    }

    /**
     * Replace tour itinerary days inside transaction
     */
    public function replaceTourItineraryDays(int $tourId, array $itineraryDays): bool
    {
        $delStmt = $this->db->prepare("DELETE FROM tour_itinerary_days WHERE tour_id = :tour_id");
        $delStmt->execute([':tour_id' => $tourId]);

        if (empty($itineraryDays)) {
            return true;
        }

        $insStmt = $this->db->prepare("
            INSERT INTO tour_itinerary_days (tour_id, day_number, title, description, display_order) 
            VALUES (:tour_id, :day_number, :title, :description, :display_order)
        ");

        $order = 1;
        foreach ($itineraryDays as $day) {
            $dayNumber = max(1, (int)($day['day_number'] ?? $order));
            $title = trim((string)($day['title'] ?? ''));
            $desc = trim((string)($day['description'] ?? ''));

            if (!empty($title) || !empty($desc)) {
                $insStmt->execute([
                    ':tour_id' => $tourId,
                    ':day_number' => $dayNumber,
                    ':title' => !empty($title) ? $title : ('Day ' . $dayNumber),
                    ':description' => $desc,
                    ':display_order' => $order++
                ]);
            }
        }

        return true;
    }

    /**
     * Replace tour inclusions inside transaction
     */
    public function replaceTourInclusions(int $tourId, array $inclusions): bool
    {
        $delStmt = $this->db->prepare("DELETE FROM tour_inclusions WHERE tour_id = :tour_id");
        $delStmt->execute([':tour_id' => $tourId]);

        if (empty($inclusions)) {
            return true;
        }

        $insStmt = $this->db->prepare("
            INSERT INTO tour_inclusions (tour_id, inclusion, display_order) 
            VALUES (:tour_id, :inclusion, :display_order)
        ");

        $order = 1;
        foreach ($inclusions as $item) {
            $cleanItem = trim((string)$item);
            if (!empty($cleanItem)) {
                $insStmt->execute([
                    ':tour_id' => $tourId,
                    ':inclusion' => $cleanItem,
                    ':display_order' => $order++
                ]);
            }
        }

        return true;
    }

    /**
     * Replace tour highlights inside transaction
     */
    public function replaceTourHighlights(int $tourId, array $highlights): bool
    {
        $delStmt = $this->db->prepare("DELETE FROM tour_highlights WHERE tour_id = :tour_id");
        $delStmt->execute([':tour_id' => $tourId]);

        if (empty($highlights)) {
            return true;
        }

        $insStmt = $this->db->prepare("
            INSERT INTO tour_highlights (tour_id, highlight, display_order) 
            VALUES (:tour_id, :highlight, :display_order)
        ");

        $order = 1;
        foreach ($highlights as $item) {
            $cleanItem = trim((string)$item);
            if (!empty($cleanItem)) {
                $insStmt->execute([
                    ':tour_id' => $tourId,
                    ':highlight' => $cleanItem,
                    ':display_order' => $order++
                ]);
            }
        }

        return true;
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
                    tour_type, route, location_summary, duration_days, duration_nights, locations, featured_image, 
                    status, booking_status, is_featured, display_order, created_at, updated_at
                ) VALUES (
                    :category_id, :title, :slug, :short_description, :description, 
                    :tour_type, :route, :location_summary, :duration_days, :duration_nights, :locations, :featured_image, 
                    :status, :booking_status, :is_featured, :display_order, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                )";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':category_id' => $data['category_id'] ?? null,
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':short_description' => $data['short_description'] ?? null,
            ':description' => $data['description'] ?? null,
            ':tour_type' => $data['tour_type'] ?? null,
            ':route' => $data['route'] ?? null,
            ':location_summary' => $data['location_summary'] ?? null,
            ':duration_days' => $data['duration_days'] ?? 1,
            ':duration_nights' => $data['duration_nights'] ?? 0,
            ':locations' => $data['locations'] ?? null,
            ':featured_image' => $data['featured_image'] ?? null,
            ':status' => $data['status'] ?? 'ACTIVE',
            ':booking_status' => $data['booking_status'] ?? 'AVAILABLE',
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
                    tour_type = :tour_type,
                    route = :route,
                    location_summary = :location_summary,
                    duration_days = :duration_days,
                    duration_nights = :duration_nights,
                    locations = :locations,
                    featured_image = :featured_image,
                    status = :status,
                    booking_status = :booking_status,
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
            ':tour_type' => $data['tour_type'] ?? null,
            ':route' => $data['route'] ?? null,
            ':location_summary' => $data['location_summary'] ?? null,
            ':duration_days' => $data['duration_days'] ?? 1,
            ':duration_nights' => $data['duration_nights'] ?? 0,
            ':locations' => $data['locations'] ?? null,
            ':featured_image' => $data['featured_image'] ?? null,
            ':status' => $data['status'] ?? 'ACTIVE',
            ':booking_status' => $data['booking_status'] ?? 'AVAILABLE',
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
