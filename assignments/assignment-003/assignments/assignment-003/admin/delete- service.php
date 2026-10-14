
<?php

declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = '';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    http_response_code(400);
    exit('Invalid service ID.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';

    if (
        !is_string($token) ||
        !hash_equals($_SESSION['csrf_token'], $token)
    ) {
        http_response_code(403);
        exit('Invalid form submission. Please return and try again.');
    }

    try {
        $statement = $pdo->prepare(
            'DELETE FROM services WHERE id = :id'
        );
        $statement->execute([':id' => $id]);

        header('Location: services.php');
        exit;
    } catch (PDOException $e) {
        error_log('Unable to delete service: ' . $e->getMessage());
        http_response_code(500);
        $error = 'The service could not be deleted. Please try again.';
    }
}

try {
    $statement = $pdo->prepare(
        'SELECT id, title FROM services WHERE id = :id'
    );
    $statement->execute([':id' => $id]);
    $service = $statement->fetch();
} catch (PDOException $e) {
    error_log('Unable to retrieve service for deletion: ' . $e->getMessage());
    http_response_code(500);
    exit('Unable to load the service.');
}

if (!$service) {
    http_response_code(404);
    exit('Service not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Service | Nexora Digital Solutions</title>
</head>
<body>
    <main>
        <h1>Delete Service</h1>

        <p>
            Are you sure you want to delete
            <strong><?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8') ?></strong>?
        </p>

        <?php if ($error !== ''): ?>
            <p role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <form method="post" action="delete-service.php?id=<?= (int) $id ?>">
            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>"
            >
            <button type="submit">Confirm Delete</button>
            <a href="services.php">Cancel</a>
        </form>
    </main>
</body>
</html>
