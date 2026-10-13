
<?php
$pageTitle = 'Our Services | Nexora Digital Solutions';

require_once __DIR__ . '/config/database.php';

try {
    $statement = $pdo->query(
        'SELECT id, title, description FROM services ORDER BY created_at DESC'
    );
    $services = $statement->fetchAll();
} catch (PDOException $e) {
    error_log('Unable to retrieve services: ' . $e->getMessage());
    $services = [];
    $loadError = true;
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-section">
    <h1>Our Services</h1>
    <p>Explore the services offered by Nexora Digital Solutions.</p>

    <?php if (!empty($loadError)): ?>
        <p>Our services are temporarily unavailable. Please try again later.</p>
    <?php elseif (empty($services)): ?>
        <p>No services are available yet. Please check back soon.</p>
    <?php else: ?>
        <div class="services-grid">
            <?php foreach ($services as $service): ?>
                <article class="service-card">
                    <h2><?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p><?= nl2br(htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8')) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
