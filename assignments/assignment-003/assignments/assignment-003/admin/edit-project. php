
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

$errors = [];
$title = $project['title'];
$description = $project['description'];
$imageUrl = $project['image_url'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';

    if (!hash_equals($_SESSION['csrf_token'], $token)) {
        $errors[] = 'Invalid request. Please refresh the page and try again.';
    }

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $imageUrl = trim($_POST['image_url'] ?? '');

    if ($title === '' || strlen($title) > 150) {
        $errors[] = 'Title is required and must not exceed 150 characters.';
    }

    if ($description === '') {
        $errors[] = 'Description is required.';
    }

    if ($imageUrl !== '' && !filter_var($imageUrl, FILTER_VALIDATE_URL)) {
        $errors[] = 'Enter a valid image URL or leave it blank.';
    }

    if (!$errors) {
        $stmt = $pdo->prepare(
            'UPDATE projects
             SET title = :title,
                 description = :description,
                 image_url = :image_url
             WHERE id = :id'
        );

        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'image_url' => $imageUrl !== '' ? $imageUrl : null,
            'id' => $id,
        ]);

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
    <title>Edit Project</title>
</head>
<body>
    <h1>Edit Portfolio Project</h1>

    <?php foreach ($errors as $error): ?>
        <p style="color: red;">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endforeach; ?>

    <form method="POST">
        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="title">Project Title</label><br>
        <input
            type="text"
            id="title"
            name="title"
            maxlength="150"
            required
            value="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>"
        ><br><br>

        <label for="description">Description</label><br>
        <textarea id="description" name="description" required><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></textarea><br><br>

        <label for="image_url">Image URL (optional)</label><br>
        <input
            type="url"
            id="image_url"
            name="image_url"
            value="<?= htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') ?>"
        ><br><br>

        <button type="submit">Update Project</button>
    </form>

    <p><a href="projects.php">Back to Projects</a></p>
</body>
</html>
