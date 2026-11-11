<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include __DIR__ . '/../partials/header.php'; 
include __DIR__ . '/../partials/navbar.php'; 
?>

<main class="container my-4">
    <?php 
    if (!empty($_SESSION['flash_message'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['flash_message']) . '</div>';
        unset($_SESSION['flash_message']);
    }
    if (!empty($_SESSION['flash_error'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['flash_error']) . '</div>';
        unset($_SESSION['flash_error']);
    }
    require $content; 
    ?>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>