<?php
declare(strict_types=1);

/**
 * Mewa Tours - Data Access Layer for Admin Accounts
 */
class AdminDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Find Admin by unique Email address
     */
    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT id, name, email, password_hash, status, last_login_at, created_at, updated_at 
                FROM admins 
                WHERE email = :email 
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => strtolower(trim($email))]);
        $record = $stmt->fetch();

        return $record ?: null;
    }

    /**
     * Find Admin by ID
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT id, name, email, status, last_login_at, created_at, updated_at 
                FROM admins 
                WHERE id = :id 
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $record = $stmt->fetch();

        return $record ?: null;
    }

    /**
     * Update Administrator last login timestamp
     */
    public function updateLastLogin(int $id): bool
    {
        $sql = "UPDATE admins 
                SET last_login_at = CURRENT_TIMESTAMP 
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Create new Administrator record
     */
    public function createAdmin(array $data): int
    {
        $sql = "INSERT INTO admins (name, email, password_hash, status, created_at, updated_at) 
                VALUES (:name, :email, :password_hash, :status, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => strtolower(trim($data['email'])),
            ':password_hash' => $data['password_hash'],
            ':status' => $data['status'] ?? 'ACTIVE'
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Update Admin Password Hash
     */
    public function updatePassword(int $id, string $passwordHash): bool
    {
        $sql = "UPDATE admins 
                SET password_hash = :password_hash, updated_at = CURRENT_TIMESTAMP 
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':password_hash' => $passwordHash,
            ':id' => $id
        ]);
    }
}
