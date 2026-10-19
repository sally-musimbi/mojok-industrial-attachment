
<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

$stmt = $pdo->query(
    'SELECT id, name, email, subject, message, status, created_at
     FROM enquiries
     ORDER BY created_at DESC'
);

$enquiries = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Enquiries</title>
</head>
<body>
    <h1>Customer Enquiries</h1>

    <p><a href="dashboard.php">Back to Dashboard</a></p>

    <?php if (empty($enquiries)): ?>
        <p>No enquiries have been received yet.</p>
    <?php else: ?>
        <?php foreach ($enquiries as $enquiry): ?>
            <article>
                <hr>
                <h2>
                    <?= htmlspecialchars($enquiry['subject'], ENT_QUOTES, 'UTF-8') ?>
                </h2>

                <p>
                    <strong>From:</strong>
                    <?= htmlspecialchars($enquiry['name'], ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    <strong>Email:</strong>
                    <?= htmlspecialchars($enquiry['email'], ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    <strong>Message:</strong><br>
                    <?= nl2br(htmlspecialchars($enquiry['message'], ENT_QUOTES, 'UTF-8')) ?>
                </p>

                <p>
                    <strong>Status:</strong>
                    <?= htmlspecialchars($enquiry['status'], ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    <strong>Received:</strong>
                    <?= htmlspecialchars($enquiry['created_at'], ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    <a href="update-enquiry.php?id=<?= (int) $enquiry['id'] ?>">
                        Update Status
                    </a>
                </p>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
