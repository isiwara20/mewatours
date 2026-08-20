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

-- Experience Categories
INSERT INTO `experience_categories` (`id`, `name`, `slug`, `description`) VALUES
(1, 'Wildlife & Safaris', 'wildlife', 'Encounter elephants, leopards, sloth bears, and wild natural park sanctuaries.'),
(2, 'Culture & Heritage', 'culture', 'Ancient kingdoms, sacred temples, traditional dance, and living history.'),
(3, 'Hill Country', 'hill-country', 'Scenic mountain trains, emerald tea estates, mist-covered hills, and waterfalls.'),
(4, 'Tropical Beaches', 'beaches', 'Golden palm-lined coasts, ocean whale safaris, and turquoise waters.'),
(5, 'Adventure', 'adventure', 'Highland trekking, white-water rafting, point-break surfing, and mountain hikes.'),
(6, 'Food & Culinary', 'food', 'Local markets, traditional rice & curry, aromatic spices, and cooking classes.'),
(7, 'Wellness & Relaxation', 'wellness', 'Peaceful retreats, traditional Ayurveda, yoga, and quiet natural surroundings.'),
(8, 'Romantic Escapes', 'romance', 'Boutique stays, candlelit coastal dining, and scenic highland moments.')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- Sample Experiences
INSERT INTO `experiences` (`id`, `category_id`, `name`, `slug`, `short_description`, `description`, `featured_image`, `status`, `is_featured`, `display_order`) VALUES
(1, 1, 'Walk Among Giants', 'walk-among-giants', 'A Wild Encounter You\'ll Never Forget.', 'Experience the thrill of seeing Sri Lankan wild elephants in their natural habitat, surrounded by open grasslands, reservoir lakes, and national park wilderness.', 'experiences/hero-experiences-safari.jpg', 'ACTIVE', 1, 1),
(2, 3, 'Ride Through the Hill Country', 'ride-through-the-hill-country', 'Travel through tea-covered mountains on one of Sri Lanka\'s most iconic scenic railway journeys.', 'Board the legendary blue train through Kandy, Nuwara Eliya, and Ella as it winds over Nine Arch Bridge and mist-draped tea estates.', 'experiences/ella-train.jpg', 'ACTIVE', 0, 2),
(3, 2, 'Explore an Ancient Kingdom', 'explore-an-ancient-kingdom', 'Walk among temples, ruins, and extraordinary stone monuments that have stood for centuries.', 'Discover the royal palaces, stone Gal Vihara Buddhas, and medieval hydraulic wonders of Polonnaruwa and Anuradhapura.', 'home/sigiriya-fortress.jpg', 'ACTIVE', 0, 3),
(4, 2, 'Climb Sigiriya at Sunrise', 'climb-sigiriya-at-sunrise', 'Rise above the tropical landscape from one of Sri Lanka\'s most remarkable ancient landmarks.', 'Ascend King Kashyapa\'s 5th-century rock fortress at golden dawn to admire water gardens, mirror walls, and panoramic jungle vistas.', 'home/sigiriya-fortress.jpg', 'ACTIVE', 0, 4),
(5, 1, 'Safari Through Yala', 'safari-through-yala', 'Travel through wild forests, lagoons, and open plains in one of Sri Lanka\'s best-known national parks.', 'Guided 4x4 open-top safari tracking wild leopards, sloth bears, spotted deer, crocodiles, and endemic bird species.', 'https://images.unsplash.com/photo-1544979590-37e9b47eb705?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 5),
(6, 6, 'Taste a Sri Lankan Kitchen', 'taste-a-sri-lankan-kitchen', 'Discover traditional spices, recipes, and local flavours through an authentic culinary experience.', 'Join a Sri Lankan family for a market spice walk and hands-on preparation of aromatic clay-pot rice and curry dishes.', 'https://images.unsplash.com/photo-1596797038530-2c107229654b?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 6),
(7, 5, 'Surf the East Coast', 'surf-the-east-coast', 'Experience the relaxed surf culture and tropical coastline of Sri Lanka\'s east.', 'Catch world-famous point-break waves along the sun-drenched shores of Arugam Bay and Whispering Palms.', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 7),
(8, 3, 'Walk Through Tea Country', 'walk-through-tea-country', 'Explore lush plantations, mountain villages, and the story behind Ceylon tea.', 'Stroll emerald tea gardens, learn tea plucking techniques from estate workers, and sample single-origin Ceylon tea.', 'tours/hero-tours-ella.jpg', 'ACTIVE', 0, 8),
(9, 4, 'Watch the Sunset in Mirissa', 'watch-the-sunset-in-mirissa', 'End the day beside the Indian Ocean with warm skies and relaxed southern-coast atmosphere.', 'Unwind on golden coconut palm beaches, enjoy fresh seafood, and watch brilliant orange sunsets over Mirissa Bay.', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80', 'ACTIVE', 0, 9),
(10, 2, 'Discover Kandyan Culture', 'discover-kandyan-culture', 'Experience traditional performance, sacred heritage, and one of Sri Lanka\'s most important cultural cities.', 'Witness sacred rituals at Sri Dalada Maligawa and watch rhythmic Kandyan drumming and fire-walking performances.', 'home/hero-dalada-maligawa.jpg', 'ACTIVE', 0, 10)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `short_description` = VALUES(`short_description`), `description` = VALUES(`description`), `featured_image` = VALUES(`featured_image`);

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
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- Sample Site Settings
INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('whatsapp_number', '94771234567'),
('company_email', 'info@mewatours.com'),
('company_phone', '+94 77 123 4567'),
('company_address', 'Kandy, Sri Lanka')
ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`);
