<?php
declare(strict_types=1);

/**
 * Mewa Tours - Business Logic Layer for Site Settings
 */
class SettingBLL
{
    private SettingDAL $settingDAL;

    public function __construct()
    {
        $this->settingDAL = new SettingDAL();
    }

    public function getSettings(): array
    {
        return $this->settingDAL->getAllSettings();
    }

    public function getSetting(string $key, ?string $default = null): ?string
    {
        return $this->settingDAL->getSetting($key, $default);
    }

    public function updateSettings(array $input): array
    {
        $allowedKeys = [
            'whatsapp_number',
            'company_email',
            'company_phone',
            'company_address',
            'site_title',
            'meta_description',
            'social_facebook',
            'social_instagram',
            'social_tripadvisor'
        ];

        $settingsToSave = [];
        foreach ($allowedKeys as $key) {
            if (array_key_exists($key, $input)) {
                $settingsToSave[$key] = sanitize_string($input[$key] ?? '');
            }
        }

        if (empty($settingsToSave)) {
            return ['success' => false, 'message' => 'No valid setting parameters submitted.'];
        }

        $saved = $this->settingDAL->saveMultiple($settingsToSave);
        return [
            'success' => $saved,
            'message' => $saved ? 'Site settings updated successfully.' : 'Failed to update site settings.'
        ];
    }
}
