
<?php

declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';

$errors = [];
$title = '';
$description = '';

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
                'INSERT INTO services (title, description)
                 VALUES (:title, :description)'
            );

            $statement->execute([
                ':title' => $title,
                ':description' => $description,
            ]);

            header('Location: services.php');
            exit;
        } catch (PDOException $e) {
            error_log('Unable to add service: ' . $e->getMessage());
            $errors[] = 'The service could not be saved. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service | Nexora Digital Solutions</title>
</head>
<body>
    <main>
        <h1>Add New Service</h1>

        <?php if (!empty($errors)): ?>
            <div role="alert">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="add-service.php">
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

            <button type="submit">Save Service</button>
        </form>

        <p><a href="services.php">Back to Services</a></p>
    </main>
</body>
</html>
