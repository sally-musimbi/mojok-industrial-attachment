
<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header('Location: projects.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM projects WHERE id = :id');
$stmt->execute(['id' => $id]);
$project = $stmt->fetch();

if (!$project) {
    header('Location: projects.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';

    if (!hash_equals($_SESSION['csrf_token'], $token)) {
        $error = 'Invalid request. Please try again.';
    } else {
        $stmt = $pdo->prepare('DELETE FROM projects WHERE id = :id');
        $stmt->execute(['id' => $id]);

        header('Location: projects.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Project</title>
</head>
<body>
    <h1>Delete Portfolio Project</h1>

    <?php if ($error !== ''): ?>
        <p style="color: red;">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <p>
        Are you sure you want to delete
        <strong><?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?></strong>?
    </p>

    <form method="POST">
        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>"
        >
        <button type="submit">Yes, Delete Project</button>
    </form>

    <p><a href="projects.php">Cancel</a></p>
</body>
</html>
