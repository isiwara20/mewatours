<?php
declare(strict_types=1);

/**
 * Mewa Tours - Admin Auth Controller
 */
class AuthController
{
    private AdminAuthBLL $adminAuthBLL;

    public function __construct()
    {
        $this->adminAuthBLL = new AdminAuthBLL();
    }

    /**
     * Show private Admin Login Page (/login or /mewa/login)
     */
    public function showLoginForm(): void
    {
        // If already logged in, redirect directly to admin dashboard
        if (is_admin_logged_in()) {
            redirect('admin/dashboard');
        }

        render_view('auth/login', [
            'page_title' => 'Admin Sign In - Mewa Tours Portal'
        ]);
    }

    /**
     * Handle Admin Login Submission
     */
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('login');
        }

        $token = $_POST['csrf_token'] ?? '';
        if (!CsrfService::validateToken($token)) {
            set_flash('auth_error', 'Invalid security token. Please try submitting again.', 'danger');
            redirect('login');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $result = $this->adminAuthBLL->authenticate($email, $password);

        if ($result['success']) {
            set_flash('admin_notice', $result['message'], 'success');
            redirect('admin/dashboard');
        } else {
            set_flash('auth_error', $result['message'], 'danger');
            set_old_input(['email' => $email]);
            redirect('login');
        }
    }

    /**
     * Logout Admin User
     */
    public function logout(): void
    {
        $this->adminAuthBLL->logout();
        set_flash('auth_success', 'You have been logged out safely.', 'info');
        redirect('login');
    }
}
