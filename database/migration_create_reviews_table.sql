-- =============================================================================
-- MEWA TOURS - MIGRATION: CREATE REVIEWS TABLE
-- Table for storing customer feedback, tour ratings, and traveler reviews
-- =============================================================================

USE `mewa_tours`;

CREATE TABLE IF NOT EXISTS `reviews` (
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
  FOREIGN KEY (`tour_id`) REFERENCES `tours`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
