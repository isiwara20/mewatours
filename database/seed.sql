-- =============================================================================
-- MEWA TOURS - SEED DATA FOR DEMO & TESTING
-- Default Admin Account: admin@mewatours.com / Admin@Mewa2026!
-- =============================================================================

USE `mewa_tours`;

-- Initial Administrator Account
INSERT INTO `admins` (`name`, `email`, `password_hash`, `status`, `created_at`, `updated_at`) VALUES
('Mewa Administrator', 'admin@mewatours.com', '$2y$10$xG0PZ8e1eUuV9w8Q9yM0e.E5o0z.XyKzY1V2W3X4Y5Z6A7B8C9D0E', 'ACTIVE', NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- Sample Tour Categories
INSERT INTO `tour_categories` (`id`, `name`, `slug`, `description`) VALUES
(1, 'Heritage & Culture', 'heritage-culture', 'Explore ancient UNESCO World Heritage cities, temples, and sacred shrines.'),
(2, 'Wildlife & Nature', 'wildlife-nature', 'National park safaris, leopard tracking, elephant herds, and endemic birding.'),
(3, 'Hill Country', 'hill-country', 'Misty tea plantations, waterfalls, and scenic mountain railway journeys.'),
(4, 'Coastal & Beach', 'coastal-beach', 'Tropical relaxation along Mirissa, Bentota, Galle, and Trincomalee.'),
(5, 'Adventure', 'adventure', 'Highland trekking, white-water rafting, wildlife hikes, and surfing.'),
(6, 'Romantic', 'romantic', 'Boutique retreats, luxury beach resorts, and private couple escapes.')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- Sample Tour Packages
INSERT INTO `tours` (`id`, `category_id`, `title`, `slug`, `short_description`, `description`, `duration_days`, `duration_nights`, `locations`, `featured_image`, `status`, `is_featured`, `display_order`) VALUES
(1, 1, 'Cultural Triangle Explorer', 'cultural-triangle-explorer', 'Walk through Sri Lanka\'s ancient kingdoms, sacred caves, and iconic rock fortress.', 'Experience the crown jewels of Sri Lanka including Sigiriya Rock Fortress, Dambulla Cave Temple, Polonnaruwa ancient ruins, and Temple of the Tooth in Kandy.', 7, 6, 'Sigiriya • Dambulla • Polonnaruwa • Kandy', 'home/sigiriya-fortress.jpg', 'ACTIVE', 0, 1),
(2, 3, 'Hill Country Escape', 'hill-country-escape', 'Experience tea-covered mountains, cool highland towns, and scenic train rides.', 'Ride scenic mountain railways through emerald tea estates, mist-covered valleys, Nine Arch Bridge, and dramatic waterfalls.', 5, 4, 'Kandy • Nuwara Eliya • Ella', 'experiences/ella-train.jpg', 'ACTIVE', 0, 2),
(3, 2, 'Wild Sri Lanka Safari', 'wild-sri-lanka-safari', 'Discover elephants, leopards, and the extraordinary national park wilderness.', 'Thrilling 4x4 game drives with naturalists tracking wild leopards, herds of elephants, sloth bears, and endemic bird species.', 6, 5, 'Yala • Udawalawe • Wilpattu', 'https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 3),
(4, 4, 'Southern Coast Escape', 'southern-coast-escape', 'Slow down along Sri Lanka\'s tropical southern coast, where heritage meets beach life.', 'Walk historic colonial Galle Fort ramparts, enjoy ocean whale watching in Mirissa, and unwind on pristine palm beaches.', 4, 3, 'Galle • Mirissa • Unawatuna', 'https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 4),
(5, 5, 'Island Adventure Expedition', 'island-adventure-expedition', 'Combine hiking, rafting, surfing, and beautiful landscapes in one active journey.', 'Conquer Ella Rock, white-water raft down the Kelani River, hike central highlands, and surf tropical Indian Ocean breaks.', 7, 6, 'Ella • Kitulgala • Arugam Bay', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 5),
(6, 6, 'Romantic Ceylon Escapes', 'romantic-ceylon-escapes', 'A relaxed journey of scenic highlands, boutique stays, and tropical coastal sunsets.', 'Tailored for couples seeking luxury boutique accommodation, private candlelit dining, scenic tea country, and sunset ocean views.', 8, 7, 'Kandy • Ella • Bentota', 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 6),
(7, 1, 'The Essence of Sri Lanka', 'the-essence-of-sri-lanka', 'A beautifully balanced signature journey through Sri Lanka\'s cultural heart, misty highlands, wild landscapes and southern coast.', 'Our premier 10-day signature itinerary encompassing ancient UNESCO heritage, tea estate mountain railways, Yala leopard safari, and colonial Galle Fort.', 10, 9, 'Kandy • Nuwara Eliya • Ella • Yala • Galle', 'home/hero-dalada-maligawa.jpg', 'ACTIVE', 1, 0)
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`), `short_description` = VALUES(`short_description`), `featured_image` = VALUES(`featured_image`), `is_featured` = VALUES(`is_featured`);

-- Full Collection of 12 Iconic Destinations
INSERT INTO `destinations` (`id`, `name`, `slug`, `short_description`, `description`, `featured_image`, `status`, `is_featured`, `display_order`) VALUES
(1, 'Kandy', 'kandy', 'Cultural Heart', 'Sacred heritage, traditional culture, and the peaceful beauty of Sri Lanka\'s central hill capital.', 'home/hero-dalada-maligawa.jpg', 'ACTIVE', 1, 1),
(2, 'Sigiriya', 'sigiriya', 'Ancient Wonder', 'Climb King Kashyapa\'s majestic 5th-century ancient rock fortress above a vast tropical forest.', 'home/sigiriya-fortress.jpg', 'ACTIVE', 1, 2),
(3, 'Ella', 'ella', 'Hill Country', 'Misty tea-covered mountains, Nine Arch Bridge, cascading waterfalls, and legendary train rides.', 'experiences/ella-train.jpg', 'ACTIVE', 1, 3),
(4, 'Nuwara Eliya', 'nuwara-eliya', 'Tea Country', 'Cool mountain air, rolling tea estates, colonial architecture, and timeless highland charm.', 'tours/hero-tours-ella.jpg', 'ACTIVE', 0, 4),
(5, 'Yala National Park', 'yala', 'Wildlife & Safaris', 'Explore wild scrub jungles famous for dense leopard populations, wild elephants, and sloth bears.', 'https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 1, 5),
(6, 'Galle Fort', 'galle', 'Southern Heritage', 'Historic Dutch colonial cobblestone streets, ramparts, ocean bastions, and boutique cafes.', 'https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 1, 6),
(7, 'Mirissa', 'mirissa', 'Beach & Whales', 'Golden tropical palm beaches, ocean blue whale watching, and relaxed coastal living.', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 7),
(8, 'Bentota', 'bentota', 'Coastal Retreat', 'A peaceful combination of golden beaches, river bentota safaris, and luxury tropical relaxation.', 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 8),
(9, 'Arugam Bay', 'arugam-bay', 'Surf & Adventure', 'A laid-back east-coast haven world-famous for point-break surfing, lagoons, and outdoor adventures.', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 9),
(10, 'Trincomalee', 'trincomalee', 'East Coast', 'Turquoise natural harbors, Pigeon Island snorkeling, quiet beaches, and ancient Koneswaram Kovil.', 'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 10),
(11, 'Anuradhapura', 'anuradhapura', 'Ancient City', 'Gigantic ancient stupas, sacred Jaya Sri Maha Bodhi tree, and centuries of Buddhist heritage.', 'home/sigiriya-fortress.jpg', 'ACTIVE', 0, 11),
(12, 'Polonnaruwa', 'polonnaruwa', 'Ancient Kingdom', 'Explore royal palace ruins, stone Gal Vihara Buddhas, and medieval hydraulic engineering marvels.', 'home/sigiriya-fortress.jpg', 'ACTIVE', 0, 12)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `short_description` = VALUES(`short_description`), `description` = VALUES(`description`), `featured_image` = VALUES(`featured_image`);

-- Sample Site Settings
INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('whatsapp_number', '94771234567'),
('company_email', 'info@mewatours.com'),
('company_phone', '+94 77 123 4567'),
('company_address', 'Kandy, Sri Lanka')
ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`);
