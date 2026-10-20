
<?php
$pageTitle = $pageTitle ?? 'Nexora Digital Solutions';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<header class="site-header">
    <nav class="navbar">
        <a class="logo" href="index.php">Nexora Digital Solutions</a>

        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<main class="container">
