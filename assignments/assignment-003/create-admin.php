<?php

declare(strict_types=1);

require_once __DIR__ . '/config/database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (
        $username === '' ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        !is_string($password) ||
        strlen($password) < 12
    ) {
        $message = 'Enter a username, a valid email, and a password of at least 12 characters.';
    } else {
        try {
            $check = $pdo->query('SELECT COUNT(*) FROM admin_users');
            $adminCount = (int) $check->fetchColumn();

            if ($adminCount > 0) {
                $message = 'An administrator already exists. Account creation is disabled.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $statement = $pdo->prepare(
                    'INSERT INTO admin_users (username, email, password_hash)
                     VALUES (:username, :email, :password_hash)'
                );

                $statement->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':password_hash' => $hash,
                ]);

                $message = 'Administrator created. Remove or disable this setup file before deployment.';
            }
        } catch (PDOException $e) {
            error_log('Administrator setup failed: ' . $e->getMessage());
            $message = 'Setup failed. Check the server configuration.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Initial Administrator Setup</title>
</head>
<body>
    <main>
        <h1>Initial Administrator Setup</h1>

        <p>
            Use this page only in a trusted local development environment.
            Disable or remove it after creating the first administrator.
        </p>

        <?php if ($message !== ''): ?>
            <p role="alert">
                <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <form method="post">
            <label for="username">Username</label>
            <input
                id="username"
                name="username"
                type="text"
                maxlength="100"
                required
            >

            <label for="email">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                maxlength="150"
                required
            >

            <label for="password">Password (at least 12 characters)</label>
            <input
                id="password"
                name="password"
                type="password"
                minlength="12"
                autocomplete="new-password"
                required
            >

            <button type="submit">Create Administrator</button>
        </form>
    </main>
</body>
</html>
