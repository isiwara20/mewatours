<?php
declare(strict_types=1);

/**
 * Mewa Tours - Business Logic Layer for Admin Authentication
 */
class AdminAuthBLL
{
    private AdminDAL $adminDAL;
    private AuthService $authService;

    public function __construct()
    {
        $this->adminDAL = new AdminDAL();
        $this->authService = new AuthService();
    }

    /**
     * Process Admin Authentication Request
     * 
     * @param string $email Submitted administrator email
     * @param string $password Submitted plaintext password
     * @return array ['success' => bool, 'message' => string]
     */
    public function authenticate(string $email, string $password): array
    {
        $cleanEmail = trim($email);

        if (empty($cleanEmail) || !validate_email($cleanEmail)) {
            return ['success' => false, 'message' => 'Please enter a valid administrator email address.'];
        }

        if (empty($password)) {
            return ['success' => false, 'message' => 'Please enter your password.'];
        }

        $admin = $this->adminDAL->findByEmail($cleanEmail);

        if (!$admin) {
            return ['success' => false, 'message' => 'Invalid email address or password.'];
        }

        if ($this->authService->login($admin, $password)) {
            $this->adminDAL->updateLastLogin((int)$admin['id']);
            return ['success' => true, 'message' => 'Login successful. Welcome back!'];
        }

        return ['success' => false, 'message' => 'Invalid email address or password.'];
    }

    /**
     * Logout current administrator
     */
    public function logout(): void
    {
        $this->authService->logout();
    }
}
