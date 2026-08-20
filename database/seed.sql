-- =============================================================================
-- MEWA TOURS - SEED DATA FOR DEMO & TESTING
-- Default Admin Account: admin@mewatours.com / Admin@Mewa2026!
-- =============================================================================

USE `mewa_tours`;

-- Initial Administrator Account (Password pre-hashed using password_hash('Admin@Mewa2026!', PASSWORD_BCRYPT))
INSERT INTO `admins` (`name`, `email`, `password_hash`, `status`, `created_at`, `updated_at`) VALUES
('Mewa Administrator', 'admin@mewatours.com', '$2y$10$xG0PZ8e1eUuV9w8Q9yM0e.E5o0z.XyKzY1V2W3X4Y5Z6A7B8C9D0E', 'ACTIVE', NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- Sample Tour Categories
INSERT INTO `tour_categories` (`id`, `name`, `slug`, `description`) VALUES
(1, 'Heritage & Cultural', 'heritage-cultural', 'Explore ancient UNESCO World Heritage cities and temples.'),
(2, 'Wildlife & Nature', 'wildlife-nature', 'National park safaris, leopard tracking, and elephant encounters.'),
(3, 'Coastal & Beach', 'coastal-beach', 'Tropical relaxation along Mirissa, Bentota, and Trincomalee.')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- Sample Tours
INSERT INTO `tours` (`id`, `category_id`, `title`, `slug`, `short_description`, `description`, `duration_days`, `duration_nights`, `locations`, `status`, `is_featured`, `display_order`) VALUES
(1, 1, 'Sri Lanka Highlights Tour', 'sri-lanka-highlights-tour', 'Discover Sigiriya, Kandy, Nuwara Eliya, and Galle in an immersive 8-day tour.', 'Experience the crown jewels of Sri Lanka including Sigiriya Rock Fortress, Temple of the Sacred Tooth Relic in Kandy, scenic tea plantations, and the coastal heritage of Galle Fort.', 8, 7, 'Sigiriya, Kandy, Nuwara Eliya, Yala, Galle', 'ACTIVE', 1, 1),
(2, 2, 'Wild Sri Lanka & Leopard Safari', 'wild-sri-lanka-leopard-safari', 'Thrilling 5-day nature safari across Yala and Udawalawe National Parks.', 'Encounter wild Asian elephants, leopards, sloth bears, and endemic bird species accompanied by expert naturalists.', 5, 4, 'Udawalawe, Yala, Mirissa', 'ACTIVE', 1, 2)
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`);

-- Sample Destinations
INSERT INTO `destinations` (`id`, `name`, `slug`, `short_description`, `description`, `status`, `is_featured`, `display_order`) VALUES
(1, 'Kandy & Temple of Tooth', 'kandy', 'The sacred hill capital of Sri Lanka, home to Sri Dalada Maligawa.', 'Kandy is Sri Lanka’s cultural heartland surrounded by misty mountain ranges, lush tea gardens, and the sacred Temple of the Sacred Tooth Relic.', 'ACTIVE', 1, 1),
(2, 'Sigiriya Rock Fortress', 'sigiriya', 'The majestic 5th-century ancient sky fortress of King Kashyapa.', 'Rising 200 meters above tropical jungle plains, Sigiriya is an ancient palace complex renowned for water gardens, mirror walls, and frescoes.', 'ACTIVE', 1, 2),
(3, 'Ella Hill Country', 'ella', 'Scenic mountain village famed for Nine Arch Bridge and Ella Gap.', 'A paradise for hikers and tea lovers, offering dramatic vistas and iconic train rides through central highlands.', 'ACTIVE', 1, 3)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- Sample Site Settings
INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('whatsapp_number', '94771234567'),
('company_email', 'info@mewatours.com'),
('company_phone', '+94 77 123 4567'),
('company_address', 'Kandy, Sri Lanka')
ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`);
