
<?php

declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';

try {
    $statement = $pdo->query(
        'SELECT id, title, description, created_at
         FROM services
         ORDER BY created_at DESC'
    );
    $services = $statement->fetchAll();
} catch (PDOException $e) {
    error_log('Unable to load admin services: ' . $e->getMessage());
    $services = [];
    $loadError = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services | Nexora Digital Solutions</title>
</head>
<body>
    <header>
        <h1>Manage Services</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a> |
            <a href="services.php">Services</a> |
            <a href="projects.php">Projects</a> |
            <a href="enquiries.php">Enquiries</a> |
            <a href="logout.php">Log Out</a>
        </nav>
    </header>

    <main>
        <p><a href="add-service.php">+ Add New Service</a></p>

        <?php if (!empty($loadError)): ?>
            <p role="alert">Services could not be loaded. Please try again later.</p>
        <?php elseif (empty($services)): ?>
            <p>No services have been added yet.</p>
        <?php else: ?>
            <table border="1" cellpadding="8">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?= (int) $service['id'] ?></td>
                            <td><?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($service['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <a href="edit-service.php?id=<?= (int) $service['id'] ?>">Edit</a>
                                |
                                <a href="delete-service.php?id=<?= (int) $service['id'] ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </main>
</body>
</html>
