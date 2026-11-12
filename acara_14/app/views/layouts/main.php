<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>/mahasiswa">SI AKADEMIK</a>
    </div>
</nav>

<main class="container my-4">
    <?php if (!empty($_SESSION['flash'])): ?>
        <?php
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        $sukses = ($flash['type'] ?? '') === 'success';
        ?>
        <div class="alert alert-<?= $sukses ? 'success' : 'danger' ?>" role="alert">
            <?= $sukses ? '✓' : '✕' ?> <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

    <?php require $content; ?>
</main>

<footer class="bg-white text-center text-muted py-3 border-top mt-5">
    <small>&copy; <?= date('Y') ?> SI Akademik</small>
</footer>

</body>
</html>