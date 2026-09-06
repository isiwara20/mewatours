<?php
declare(strict_types=1);

/**
 * Mewa Tours - Business Logic Layer for About Us Page Management
 */
class AboutBLL
{
    private SettingDAL $settingDAL;
    private FileUploadService $fileUploadService;

    public function __construct()
    {
        $this->settingDAL = new SettingDAL();
        $this->fileUploadService = new FileUploadService();
    }

    /**
     * Default fallback values matching the current design
     */
    public function getDefaults(): array
    {
        return [
            // SEO Meta
            'about_meta_title' => 'About Us - Mewan Manju Sri Kandearachchi | Mewa Tours Sri Lanka',
            'about_meta_description' => 'Discover the story of Mewa Tours, founded by Mewan Manju Sri Kandearachchi. 100% private, custom Sri Lanka journeys with local expertise and genuine hospitality.',

            // Section 1: Hero Banner
            'about_hero_eyebrow' => 'DISCOVER OUR STORY',
            'about_hero_title' => 'Authentic Sri Lankan Hospitality & Custom Private Journeys',
            'about_hero_subtitle' => "Founded by Mewan Manju Sri Kandearachchi, Mewa Tours is dedicated to creating memorable, 100% private travel experiences across Sri Lanka's sacred heritage, wildlife safaris, misty tea mountains, and tropical coastlines.",
            'about_hero_image' => 'tours/hero-tours-ella.jpg',

            // Section 2: Founder & Leadership
            'about_founder_name' => 'Mewan Manju Sri Kandearachchi',
            'about_founder_role' => 'Founder & Managing Director, Mewa Tours Sri Lanka',
            'about_founder_badge_title' => 'Mewan Manju Sri Kandearachchi',
            'about_founder_badge_sub' => 'Founder & Managing Director - Mewa Tours',
            'about_founder_quote' => 'Travel in Sri Lanka is not just about visiting famous landmarks — it is about genuine warmth, local culture, breathtaking scenery, and creating private memories that stay with you forever.',
            'about_founder_bio_1' => 'Welcome to Mewa Tours! I am Mewan Manju Sri Kandearachchi, founder of Mewa Tours Sri Lanka. My lifelong passion has been sharing the authentic magic, rich heritage, and unmatched beauty of our paradise island with travelers from around the globe.',
            'about_founder_bio_2' => 'We believe every journey should be as unique as the traveler taking it. That is why Mewa Tours specializes in 100% private, custom-tailored itineraries — complete with luxury air-conditioned vehicles, professional English-speaking tourist drivers, and carefully curated hotel stays.',
            'about_founder_bio_3' => 'Whether you wish to climb the ancient rock fortress of Sigiriya, track leopards in Yala National Park, ride the iconic highland railway through Ella\'s tea country, or relax on golden palm-fringed beaches, my team and I are personally committed to ensuring your holiday in Sri Lanka is seamless, safe, and truly unforgettable.',
            'about_founder_image' => 'about/mewan-founder.jpg',

            // Section 3: Core Values / Why Travel With Us
            'about_values_eyebrow' => 'WHY TRAVEL WITH US',
            'about_values_title' => 'The Mewa Tours Promise',
            'about_values_subtitle' => 'We hold ourselves to the highest standards of safety, personal attention, and transparent travel excellence.',
            
            'about_val1_title' => '100% Private Tours',
            'about_val1_desc' => 'No crowded group buses. Every tour is exclusive to you, your family, or your private travel group with total schedule flexibility.',
            'about_val1_icon' => 'fa-user-shield',

            'about_val2_title' => 'Luxury Private Fleet',
            'about_val2_desc' => 'Modern, fully insured, air-conditioned cars, vans, and luxury SUVs driven by experienced English-speaking tourist drivers.',
            'about_val2_icon' => 'fa-car-side',

            'about_val3_title' => 'Authentic Local Insights',
            'about_val3_desc' => 'Experience genuine Sri Lankan culture, village home-cooked meals, sacred rituals, and hidden scenic spots known only to locals.',
            'about_val3_icon' => 'fa-hand-holding-heart',

            'about_val4_title' => '24/7 Personal Support',
            'about_val4_desc' => 'Direct access to Mewan and our travel coordinator team before, during, and after your trip for complete peace of mind.',
            'about_val4_icon' => 'fa-headset',

            // Section 4: Stats Counter
            'about_stat1_num' => '10+',
            'about_stat1_label' => 'Years Tourism Experience',
            'about_stat2_num' => '1,500+',
            'about_stat2_label' => 'Happy Private Travelers',
            'about_stat3_num' => '100%',
            'about_stat3_label' => 'Custom Tailored Itineraries',
            'about_stat4_num' => '4.9 / 5',
            'about_stat4_label' => 'Guest Rating Score',

            // Section 5: Story Banner & CTA
            'about_cta_eyebrow' => 'YOUR JOURNEY AWAITS',
            'about_cta_title' => 'Let Us Craft Your Dream Sri Lankan Experience',
            'about_cta_text' => 'From the moment you touch down at Bandaranaike International Airport until your final departure, Mewan Manju Sri Kandearachchi and the Mewa Tours team will ensure every single day is filled with wonder, comfort, and joy.',
            'about_cta_image' => 'experiences/ella-train.jpg',
        ];
    }

    /**
     * Get compiled About Us page data (database merged with defaults)
     */
    public function getAboutData(): array
    {
        $defaults = $this->getDefaults();
        $stored = $this->settingDAL->getAllSettings();

        $data = [];
        foreach ($defaults as $key => $defaultVal) {
            $val = $stored[$key] ?? null;
            $data[$key] = ($val !== null && trim($val) !== '') ? $val : $defaultVal;
        }

        return $data;
    }

    /**
     * Update About Us page content & images
     */
    public function updateAboutData(array $input, array $files = []): array
    {
        $defaults = $this->getDefaults();
        $settingsToSave = [];

        // 1. Process text inputs
        foreach ($defaults as $key => $defaultVal) {
            // Images are handled separately via file uploads or existing value
            if (in_array($key, ['about_hero_image', 'about_founder_image', 'about_cta_image'], true)) {
                continue;
            }

            if (isset($input[$key])) {
                $settingsToSave[$key] = trim($input[$key]);
            }
        }

        // 2. Process image uploads
        $imageFields = [
            'about_hero_image' => 'hero_image_file',
            'about_founder_image' => 'founder_image_file',
            'about_cta_image' => 'cta_image_file'
        ];

        foreach ($imageFields as $settingKey => $fileInputName) {
            if (isset($files[$fileInputName]) && $files[$fileInputName]['error'] === UPLOAD_ERR_OK) {
                $upload = $this->fileUploadService->uploadImage($files[$fileInputName], 'about');
                if ($upload['success'] && !empty($upload['filepath'])) {
                    $settingsToSave[$settingKey] = $upload['filepath'];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Image upload failed for ' . str_replace('_', ' ', $settingKey) . ': ' . ($upload['error'] ?? 'Unknown error')
                    ];
                }
            } elseif (!empty($input[$settingKey])) {
                // Keep previous/existing image string if supplied
                $settingsToSave[$settingKey] = trim($input[$settingKey]);
            }
        }

        // 3. Save all updated key-values
        if (!empty($settingsToSave)) {
            $saved = $this->settingDAL->saveMultiple($settingsToSave);
            return [
                'success' => $saved,
                'message' => $saved ? 'About Us page content updated successfully!' : 'Failed to save About Us settings.'
            ];
        }

        return [
            'success' => false,
            'message' => 'No changes were submitted.'
        ];
    }
}
