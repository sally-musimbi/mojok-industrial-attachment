
<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header('Location: enquiries.php');
    exit;
}

$stmt = $pdo->prepare(
    'SELECT id, name, subject, status
     FROM enquiries
     WHERE id = :id'
);
$stmt->execute(['id' => $id]);
$enquiry = $stmt->fetch();

if (!$enquiry) {
    header('Location: enquiries.php');
    exit;
}

$errors = [];
$allowedStatuses = ['New', 'In Progress', 'Closed'];
$status = $enquiry['status'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';

    if (!hash_equals($_SESSION['csrf_token'], $token)) {
        $errors[] = 'Invalid request. Please refresh the page and try again.';
    }

    $status = $_POST['status'] ?? '';

    if (!in_array($status, $allowedStatuses, true)) {
        $errors[] = 'Please select a valid enquiry status.';
    }

    if (!$errors) {
        $stmt = $pdo->prepare(
            'UPDATE enquiries SET status = :status WHERE id = :id'
        );
        $stmt->execute([
            'status' => $status,
            'id' => $id,
        ]);

        header('Location: enquiries.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Enquiry Status</title>
</head>
<body>
    <h1>Update Enquiry Status</h1>

    <p>
        <strong>Customer:</strong>
        <?= htmlspecialchars($enquiry['name'], ENT_QUOTES, 'UTF-8') ?>
    </p>

    <p>
        <strong>Subject:</strong>
        <?= htmlspecialchars($enquiry['subject'], ENT_QUOTES, 'UTF-8') ?>
    </p>

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

        <label for="status">Status</label>
        <select id="status" name="status" required>
            <?php foreach ($allowedStatuses as $option): ?>
                <option
                    value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"
                    <?= $status === $option ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Save Status</button>
    </form>

    <p><a href="enquiries.php">Back to Enquiries</a></p>
</body>
</html>
