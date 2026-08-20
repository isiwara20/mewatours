<?php
declare(strict_types=1);

/**
 * Mewa Tours - Admin Authentication Service
 */
class AuthService
{
    private LoggerService $logger;

    public function __construct()
    {
        $this->logger = new LoggerService();
    }

    /**
     * Authenticate Administrator credentials
     */
    public function login(array $adminRecord, string $providedPassword): bool
    {
        if (empty($adminRecord) || empty($adminRecord['password_hash'])) {
            return false;
        }

        if (($adminRecord['status'] ?? 'INACTIVE') !== 'ACTIVE') {
            $this->logger->warning('Admin login attempted for inactive account', ['email' => $adminRecord['email'] ?? 'unknown']);
            return false;
        }

        if (password_verify($providedPassword, $adminRecord['password_hash'])) {
            // Prevent Session Fixation
            session_regenerate_id(true);

            $_SESSION['admin'] = [
                'id' => (int) $adminRecord['id'],
                'name' => $adminRecord['name'],
                'email' => $adminRecord['email'],
                'logged_in_at' => date('Y-m-d H:i:s')
            ];

            $this->logger->info('Admin login successful', ['admin_id' => $adminRecord['id'], 'email' => $adminRecord['email']]);
            return true;
        }

        $this->logger->warning('Admin login failed: invalid password', ['email' => $adminRecord['email'] ?? 'unknown']);
        return false;
    }

    /**
     * Terminate Administrator Session
     */
    public function logout(): void
    {
        if (isset($_SESSION['admin'])) {
            $this->logger->info('Admin logged out', ['admin_id' => $_SESSION['admin']['id'] ?? null]);
            unset($_SESSION['admin']);
        }

        // Clear session array & cookie
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
    }

    /**
     * Get current logged-in admin payload
     */
    public function getCurrentAdmin(): ?array
    {
        return $_SESSION['admin'] ?? null;
    }
}
