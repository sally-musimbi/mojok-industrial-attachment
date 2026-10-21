
<?php

declare(strict_types=1);

// Strengthen session cookie security before starting the session.
if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_samesite', 'Lax');

    // Enable this when the site is running over HTTPS.
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        ini_set('session.cookie_secure', '1');
    }

    session_start();
}

require_once __DIR__ . '/../config/database.php';


$error = '';

if (empty($_SESSION['login_csrf_token'])) {
    $_SESSION['login_csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $token = $_POST['csrf_token'] ?? '';

    if (
        !is_string($token) ||
        !hash_equals($_SESSION['login_csrf_token'], $token)
    ) {
        $error = 'Invalid form submission. Please refresh and try again.';
    } elseif ($username === '' || !is_string($password) || $password === '') {
        $error = 'Please enter your username and password.';
    } else {
        try {
            $statement = $pdo->prepare(
                'SELECT id, username, password_hash
                 FROM admin_users
                 WHERE username = :username
                 LIMIT 1'
            );

            $statement->execute([':username' => $username]);
            $admin = $statement->fetch();

            if ($admin && password_verify($password, $admin['password_hash'])) {
                session_regenerate_id(true);

                $_SESSION['admin_id'] = (int) $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];

                unset($_SESSION['login_csrf_token']);

                header('Location: dashboard.php');
                exit;
            }

            $error = 'Invalid username or password.';
        } catch (PDOException $e) {
            error_log('Admin login failed: ' . $e->getMessage());
            $error = 'Login is temporarily unavailable. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Nexora Digital Solutions</title>
</head>
<body>
    <main>
        <h1>Administrator Login</h1>

        <?php if ($error !== ''): ?>
            <p role="alert">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <form method="post" action="login.php">
            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars($_SESSION['login_csrf_token'], ENT_QUOTES, 'UTF-8') ?>"
            >

            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                maxlength="100"
                autocomplete="username"
                required
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="current-password"
                required
            >

            <button type="submit">Log In</button>
        </form>
    </main>
</body>
</html>
