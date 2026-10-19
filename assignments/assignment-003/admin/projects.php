
<?php

declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';

try {
    $statement = $pdo->query(
        'SELECT id, title, description, image_url, created_at
         FROM projects
         ORDER BY created_at DESC'
    );
    $projects = $statement->fetchAll();
} catch (PDOException $e) {
    error_log('Unable to load admin projects: ' . $e->getMessage());
    $projects = [];
    $loadError = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Projects | Nexora Digital Solutions</title>
</head>
<body>
    <header>
        <h1>Manage Portfolio Projects</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a> |
            <a href="services.php">Services</a> |
            <a href="projects.php">Projects</a> |
            <a href="enquiries.php">Enquiries</a> |
            <a href="logout.php">Log Out</a>
        </nav>
    </header>

    <main>
        <p><a href="add-project.php">+ Add New Project</a></p>

        <?php if (!empty($loadError)): ?>
            <p role="alert">Projects could not be loaded. Please try again later.</p>
        <?php elseif (empty($projects)): ?>
            <p>No projects have been added yet.</p>
        <?php else: ?>
            <table border="1" cellpadding="8">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image URL</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?= (int) $project['id'] ?></td>
                            <td><?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($project['description'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($project['image_url'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($project['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <a href="edit-project.php?id=<?= (int) $project['id'] ?>">Edit</a>
                                |
                                <a href="delete-project.php?id=<?= (int) $project['id'] ?>">Delete</a>
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
