<?php

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (
    !isset($_SESSION['admin_id']) ||
    !is_int($_SESSION['admin_id']) ||
    $_SESSION['admin_id'] <= 0
) {
    $_SESSION = [];

    header('Location: login.php');
    exit;
}
