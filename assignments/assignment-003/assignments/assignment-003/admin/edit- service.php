
<?php

declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';

$errors = [];
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    http_response_code(400);
    exit('Invalid service ID.');
}

try {
    $statement = $pdo->prepare(
        'SELECT id, title, description FROM services WHERE id = :id'
    );
    $statement->execute([':id' => $id]);
    $service = $statement->fetch();
} catch (PDOException $e) {
    error_log('Unable to retrieve service: ' . $e->getMessage());
    http_response_code(500);
    exit('Unable to load the service.');
}

if (!$service) {
    http_response_code(404);
    exit('Service not found.');
}

$title = $service['title'];
$description = $service['description'];

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (
        !is_string($token) ||
        !hash_equals($_SESSION['csrf_token'], $token)
    ) {
        $errors[] = 'Invalid form submission. Please refresh and try again.';
    }

    if ($title === '' || strlen($title) > 150) {
        $errors[] = 'Enter a title of up to 150 characters.';
    }

    if ($description === '') {
        $errors[] = 'Enter a description.';
    }

    if (empty($errors)) {
        try {
            $statement = $pdo->prepare(
                'UPDATE services
                 SET title = :title, description = :description
                 WHERE id = :id'
            );

            $statement->execute([
                ':title' => $title,
                ':description' => $description,
                ':id' => $id,
            ]);

            header('Location: services.php');
            exit;
        } catch (PDOException $e) {
            error_log('Unable to update service: ' . $e->getMessage());
            $errors[] = 'The service could not be updated. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service | Nexora Digital Solutions</title>
</head>
<body>
    <main>
        <h1>Edit Service</h1>

        <?php if (!empty($errors)): ?>
            <div role="alert">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="edit-service.php?id=<?= (int) $id ?>">
            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>"
            >

            <label for="title">Service Title</label>
            <input
                type="text"
                id="title"
                name="title"
                maxlength="150"
                required
                value="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>"
            >

            <label for="description">Description</label>
            <textarea
                id="description"
                name="description"
                rows="6"
                required
            ><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></textarea>

            <button type="submit">Update Service</button>
        </form>

        <p><a href="services.php">Back to Services</a></p>
    </main>
</body>
</html>
