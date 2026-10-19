
<?php
$pageTitle = 'Our Portfolio | Nexora Digital Solutions';

require_once __DIR__ . '/config/database.php';

try {
    $statement = $pdo->query(
        'SELECT id, title, description, image_url FROM projects ORDER BY created_at DESC'
    );
    $projects = $statement->fetchAll();
} catch (PDOException $e) {
    error_log('Unable to retrieve projects: ' . $e->getMessage());
    $projects = [];
    $loadError = true;
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-section">
    <h1>Our Portfolio</h1>
    <p>Explore selected projects by Nexora Digital Solutions.</p>

    <?php if (!empty($loadError)): ?>
        <p>Our portfolio is temporarily unavailable. Please try again later.</p>
    <?php elseif (empty($projects)): ?>
        <p>No projects are available yet. Please check back soon.</p>
    <?php else: ?>
        <div class="portfolio-grid">
            <?php foreach ($projects as $project): ?>
                <article class="portfolio-card">
                    <?php if (!empty($project['image_url'])): ?>
                        <img
                            src="<?= htmlspecialchars($project['image_url'], ENT_QUOTES, 'UTF-8') ?>"
                            alt="<?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?>"
                            loading="lazy"
                        >
                    <?php endif; ?>

                    <div class="portfolio-content">
                        <h2><?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?></h2>
                        <p><?= nl2br(htmlspecialchars($project['description'], ENT_QUOTES, 'UTF-8')) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
