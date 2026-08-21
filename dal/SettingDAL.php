<?php
declare(strict_types=1);

/**
 * Mewa Tours - Data Access Layer for Site Settings
 */
class SettingDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Retrieve all site settings as key-value pairs
     */
    public function getAllSettings(): array
    {
        $sql = "SELECT setting_key, setting_value FROM site_settings";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }

    /**
     * Retrieve single setting by key
     */
    public function getSetting(string $key, ?string $default = null): ?string
    {
        $sql = "SELECT setting_value FROM site_settings WHERE setting_key = :key LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':key' => $key]);
        $row = $stmt->fetch();
        return $row ? $row['setting_value'] : $default;
    }

    /**
     * Set/update setting key value pair
     */
    public function saveSetting(string $key, ?string $value): bool
    {
        $sql = "INSERT INTO site_settings (setting_key, setting_value, updated_at) 
                VALUES (:key, :value, CURRENT_TIMESTAMP) 
                ON DUPLICATE KEY UPDATE setting_value = :value_update, updated_at = CURRENT_TIMESTAMP";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':key' => $key,
            ':value' => $value,
            ':value_update' => $value
        ]);
    }

    /**
     * Bulk save key value pairs
     */
    public function saveMultiple(array $settings): bool
    {
        $this->db->beginTransaction();
        try {
            foreach ($settings as $key => $value) {
                $this->saveSetting((string)$key, $value !== null ? (string)$value : null);
            }
            $this->db->commit();
            return true;
        } catch (\Throwable $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
