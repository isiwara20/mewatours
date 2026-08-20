-- =============================================================================
-- MEWA TOURS - DATABASE MIGRATION SCRIPT (TOUR ITINERARY & BOOKING STATUS)
-- Target RDBMS: MySQL / MariaDB (XAMPP Compatible)
-- Engine: InnoDB | Character Set: utf8mb4 | Collation: utf8mb4_unicode_ci
-- =============================================================================

USE `mewa_tours`;

-- -----------------------------------------------------------------------------
-- 1. ADD location_summary & booking_status COLUMNS TO TOURS TABLE
-- -----------------------------------------------------------------------------
SET @dbname = DATABASE();
SET @tablename = "tours";

SET @columnname = "location_summary";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = @columnname
  ) > 0,
  "SELECT 1",
  "ALTER TABLE `tours` ADD COLUMN `location_summary` VARCHAR(255) NULL DEFAULT NULL AFTER `route`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

SET @columnname = "booking_status";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = @columnname
  ) > 0,
  "SELECT 1",
  "ALTER TABLE `tours` ADD COLUMN `booking_status` ENUM('AVAILABLE', 'ON_REQUEST', 'UNAVAILABLE') NOT NULL DEFAULT 'AVAILABLE' AFTER `status`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- -----------------------------------------------------------------------------
-- 2. CREATE TOUR ITINERARY DAYS CHILD TABLE
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tour_itinerary_days` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tour_id` BIGINT UNSIGNED NOT NULL,
  `day_number` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_tour_itinerary_tour_id` (`tour_id`),
  CONSTRAINT `fk_tour_itinerary_tour` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
