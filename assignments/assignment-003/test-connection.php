
<?php

declare(strict_types=1);

require_once __DIR__ . '/config/database.php';

try {
    $statement = $pdo->query('SELECT DATABASE() AS database_name');
    $result = $statement->fetch();

    echo 'Database connection successful. ';
    echo 'Connected database: ' .
        htmlspecialchars(
            (string) $result['database_name'],
            ENT_QUOTES,
            'UTF-8'
        );
} catch (PDOException $e) {
    error_log('Connection test failed: ' . $e->getMessage());
    http_response_code(500);
    echo 'Database test failed. Check the server logs.';
}
