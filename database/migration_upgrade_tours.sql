-- =============================================================================
-- MEWA TOURS - DATABASE MIGRATION SCRIPT (UPGRADE TOURS & CHILD TABLES)
-- Target RDBMS: MySQL / MariaDB (XAMPP Compatible)
-- Engine: InnoDB | Character Set: utf8mb4 | Collation: utf8mb4_unicode_ci
-- =============================================================================

USE `mewa_tours`;

-- -----------------------------------------------------------------------------
-- 1. SAFE ALTER FOR TOURS TABLE (COLUMNS: tour_type, route)
-- -----------------------------------------------------------------------------
SET @dbname = DATABASE();
SET @tablename = "tours";

SET @columnname = "tour_type";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = @columnname
  ) > 0,
  "SELECT 1",
  "ALTER TABLE `tours` ADD COLUMN `tour_type` VARCHAR(150) NULL DEFAULT NULL AFTER `description`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

SET @columnname = "route";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = @columnname
  ) > 0,
  "SELECT 1",
  "ALTER TABLE `tours` ADD COLUMN `route` TEXT NULL DEFAULT NULL AFTER `tour_type`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- -----------------------------------------------------------------------------
-- 2. CREATE TOUR INCLUSIONS CHILD TABLE
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tour_inclusions` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tour_id` BIGINT UNSIGNED NOT NULL,
  `inclusion` VARCHAR(255) NOT NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_tour_inc_tour_id` (`tour_id`),
  CONSTRAINT `fk_tour_inclusions_tour` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 3. CREATE TOUR HIGHLIGHTS CHILD TABLE
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tour_highlights` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tour_id` BIGINT UNSIGNED NOT NULL,
  `highlight` VARCHAR(255) NOT NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_tour_hl_tour_id` (`tour_id`),
  CONSTRAINT `fk_tour_highlights_tour` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
