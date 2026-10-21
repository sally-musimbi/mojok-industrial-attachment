
<?php

declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';

try {
    $servicesCount = (int) $pdo->query(
        'SELECT COUNT(*) FROM services'
    )->fetchColumn();

    $projectsCount = (int) $pdo->query(
        'SELECT COUNT(*) FROM projects'
    )->fetchColumn();

    $enquiriesCount = (int) $pdo->query(
        'SELECT COUNT(*) FROM enquiries'
    )->fetchColumn();
} catch (PDOException $e) {
    error_log('Dashboard statistics failed: ' . $e->getMessage());
    $servicesCount = 0;
    $projectsCount = 0;
    $enquiriesCount = 0;
    $loadError = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Nexora Digital Solutions</title>
</head>
<body>
    <header>
        <h1>Administrator Dashboard</h1>
        <p>
            Welcome,
            <?= htmlspecialchars(
                (string) ($_SESSION['admin_username'] ?? 'Administrator'),
                ENT_QUOTES,
                'UTF-8'
            ) ?>!
        </p>
        <nav>
            <a href="dashboard.php">Dashboard</a> |
            <a href="services.php">Manage Services</a> |
            <a href="projects.php">Manage Projects</a> |
            <a href="enquiries.php">View Enquiries</a> |
            <a href="enquiries.php">Manage Enquiries</a>
            <?php
if (empty($_SESSION['logout_csrf_token'])) {
    $_SESSION['logout_csrf_token'] = bin2hex(random_bytes(32));
}
?>

<form method="post" action="logout.php">
    <input
        type="hidden"
        name="csrf_token"
        value="<?= htmlspecialchars(
            $_SESSION['logout_csrf_token'],
            ENT_QUOTES,
            'UTF-8'
        ) ?>"
    >
    <button type="submit">Logout</button>
</form>
        </nav>
    </header>

    <main>
        <?php if (!empty($loadError)): ?>
            <p role="alert">
                Dashboard statistics are temporarily unavailable.
            </p>
        <?php endif; ?>

        <section>
            <h2>Overview</h2>

            <article>
                <h3>Services</h3>
                <p><?= $servicesCount ?></p>
            </article>

            <article>
                <h3>Projects</h3>
                <p><?= $projectsCount ?></p>
            </article>

            <article>
                <h3>Enquiries</h3>
                <p><?= $enquiriesCount ?></p>
            </article>
        </section>
    </main>
</body>
</html>
