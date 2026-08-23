<?php
declare(strict_types=1);

/**
 * Mewa Tours - CLI / Setup Helper to Seed / Reset Admin Account
 */
require_once __DIR__ . '/../config/init.php';

echo "<h3>Mewa Tours - Administrator Setup Utility</h3>";

$email = 'mewatours83@gmail.com';
$password = 'Mewa@123';
$name = 'Mewa Administrator';

$adminDAL = new AdminDAL();
$existing = $adminDAL->findByEmail($email);

$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

if ($existing) {
    $db = Database::getConnection();
    $stmt = $db->prepare("UPDATE admins SET password_hash = :hash, status = 'ACTIVE' WHERE id = :id");
    $stmt->execute([':hash' => $hash, ':id' => $existing['id']]);
    echo "<p style='color:green;'>✓ Administrator account password reset successfully!</p>";
} else {
    $adminDAL->createAdmin([
        'name' => $name,
        'email' => $email,
        'password_hash' => $hash,
        'status' => 'ACTIVE'
    ]);
    echo "<p style='color:green;'>✓ Administrator account created successfully!</p>";
}

echo "<table border='1' cellpadding='8' cellspacing='0'>
        <tr><th>Email</th><td>" . e($email) . "</td></tr>
        <tr><th>Password</th><td>" . e($password) . "</td></tr>
        <tr><th>Bcrypt Hash</th><td><code>" . e($hash) . "</code></td></tr>
      </table>";
echo "<p>You can now log in at <a href='" . base_url('login') . "'>" . base_url('login') . "</a></p>";
