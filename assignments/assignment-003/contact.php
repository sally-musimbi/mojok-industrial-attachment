
<?php

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_samesite', 'Lax');

    // Enable secure cookies when the site uses HTTPS.
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        ini_set('session.cookie_secure', '1');
    }

    session_start();
}

$pageTitle = 'Contact Us | Nexora Digital Solutions';
$errors = [];
$success = '';

$name = '';
$email = '';
$subject = '';
$message = '';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $token = $_POST['csrf_token'] ?? '';

    if (!is_string($token) ||
        !hash_equals($_SESSION['csrf_token'], $token)) {
        $errors[] = 'Invalid form submission. Please refresh and try again.';
    }

    if ($name === '' || strlen($name) > 100) {
        $errors[] = 'Please enter your name (maximum 100 characters).';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) ||
        strlen($email) > 150) {
        $errors[] = 'Please enter a valid email address.';
    }

    if ($subject === '' || strlen($subject) > 200) {
        $errors[] = 'Please enter a subject (maximum 200 characters).';
    }

    
if ($message === '' || strlen($message) > 5000) {
    $errors[] = 'Please enter a message (maximum 5000 characters).';
}


    if (empty($errors)) {
        require_once __DIR__ . '/config/database.php';

        try {
            $statement = $pdo->prepare(
                'INSERT INTO enquiries (name, email, subject, message)
                 VALUES (:name, :email, :subject, :message)'
            );

            $statement->execute([
                ':name' => $name,
                ':email' => $email,
                ':subject' => $subject,
                ':message' => $message,
            ]);

            $success = 'Thank you! Your enquiry has been submitted successfully.';
            $name = $email = $subject = $message = '';
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } catch (PDOException $e) {
            error_log('Enquiry submission failed: ' . $e->getMessage());
            $errors[] = 'We could not submit your enquiry. Please try again later.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-section">
    <h1>Contact Us</h1>
    <p>Send us a message using the form below.</p>

    <?php if ($success !== ''): ?>
        <p role="status">
            <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div role="alert">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="contact.php">
        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="name">Full Name</label>
        <input
            type="text"
            id="name"
            name="name"
            maxlength="100"
            required
            value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            maxlength="150"
            required
            value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="subject">Subject</label>
        <input
            type="text"
            id="subject"
            name="subject"
            maxlength="200"
            required
            value="<?= htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="message">Message</label>
        <textarea
            id="message"
            name="message"
            rows="6"
            required
        ><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></textarea>

        <button type="submit">Send Message</button>
    </form>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
