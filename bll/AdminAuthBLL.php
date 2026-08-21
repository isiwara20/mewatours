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

    /**
     * Update administrator profile (Name and Email)
     */
    public function updateProfile(int $id, string $name, string $email): array
    {
        $name = sanitize_string($name);
        $email = trim($email);

        if (empty($name)) {
            return ['success' => false, 'message' => 'Name cannot be empty.'];
        }
        if (empty($email) || !validate_email($email)) {
            return ['success' => false, 'message' => 'Please enter a valid email address.'];
        }

        $existing = $this->adminDAL->findByEmail($email);
        if ($existing && (int)$existing['id'] !== $id) {
            return ['success' => false, 'message' => 'This email address is already in use by another account.'];
        }

        $updated = $this->adminDAL->updateProfile($id, $name, $email);
        if ($updated) {
            if (isset($_SESSION['admin'])) {
                $_SESSION['admin']['name'] = $name;
                $_SESSION['admin']['email'] = $email;
            }
            $_SESSION['admin_name'] = $name;
            $_SESSION['admin_email'] = $email;
            return ['success' => true, 'message' => 'Admin profile updated successfully.'];
        }

        return ['success' => false, 'message' => 'Failed to update admin profile.'];
    }

    /**
     * Update administrator password
     */
    public function updatePassword(int $id, string $currentPassword, string $newPassword, string $confirmPassword): array
    {
        if (empty($currentPassword) || empty($newPassword)) {
            return ['success' => false, 'message' => 'Please provide both current and new password.'];
        }
        if ($newPassword !== $confirmPassword) {
            return ['success' => false, 'message' => 'New password and confirmation do not match.'];
        }
        if (strlen($newPassword) < 6) {
            return ['success' => false, 'message' => 'New password must be at least 6 characters long.'];
        }

        $currentHash = $this->adminDAL->getPasswordHash($id);
        if (!$currentHash || !password_verify($currentPassword, $currentHash)) {
            return ['success' => false, 'message' => 'Current password is incorrect.'];
        }

        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $updated = $this->adminDAL->updatePassword($id, $newHash);
        return [
            'success' => $updated,
            'message' => $updated ? 'Password changed successfully.' : 'Failed to change password.'
        ];
    }
}

