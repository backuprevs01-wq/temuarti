<?php
session_start();
require __DIR__ . '/../includes/functions.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$basePath = '../';
$pageTitle = 'Login Admin';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
        $loginError = 'Token keamanan tidak valid.';
    } else {
        $username = trim((string) ($_POST['username'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');

        if ($username === '' || $password === '') {
            $loginError = 'Username dan password wajib diisi.';
        } else {
            $stmt = db()->prepare('SELECT * FROM admins WHERE username = :username LIMIT 1');
            $stmt->execute([':username' => $username]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password'])) {
                session_regenerate_id(true);
                $_SESSION['admin_id'] = (int) $admin['id'];
                $_SESSION['admin_name'] = $admin['name'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                redirect('index.php');
            }

            $loginError = 'Username atau password tidak valid.';
        }
    }
}

require __DIR__ . '/../includes/header.php';
?>
<div class="login-wrap">
    <div class="login-box">
        <span class="kicker">Admin Access</span>
        <h1>Masuk ke dashboard</h1>
        <?php if (!empty($loginError)): ?>
            <p style="color:#991b1b; font-weight:600; margin-bottom:16px;"><?= e($loginError) ?></p>
        <?php endif; ?>
        <form method="post" class="filter-form">
            <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
            <input type="text" name="username" placeholder="Username" value="" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
