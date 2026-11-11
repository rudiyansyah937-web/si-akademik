<?php
$method = $_SERVER['REQUEST_METHOD'];
$Kunci = '';
$username = '';

if ($method === 'POST') {
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
} else {
    $Kunci = htmlspecialchars(trim($_GET['Kunci'] ?? ''));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">

    <h1 class="h3 mb-1">Selamat datang di SI Akademik</h1>
    <p class="text-muted">
        Method request saat ini:
        <span class="badge <?= $method === 'POST' ? 'bg-success' : 'bg-primary' ?>"><?= $method ?></span>
    </p>

    <?php if ($method === 'POST'): ?>
        <div class="alert alert-success">
            Halaman ini diakses dengan <strong>POST</strong>. Data dikirim lewat body request, tidak tampil di URL.
            <?php if ($username !== ''): ?>Login diterima untuk: <strong><?= $username ?></strong>.<?php endif; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-primary">
            Halaman ini diakses dengan <strong>GET</strong>. Data tampil di URL.
            <?php if ($Kunci !== ''): ?>Kunci: <strong><?= $Kunci ?></strong>.<?php endif; ?>
        </div>
    <?php endif; ?>

    <hr class="my-4">

    <h2 class="h4 mb-3">Form Uji Coba Pengujian Method</h2>

    <div class="row g-3">
        <!-- GET -->
        <div class="col-md-6">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h3 class="h5 text-primary mb-3">Uji Form GET</h3>
                    <form method="GET" action="">
                        <label for="Kunci" class="form-label">Kunci:</label>
                        <input type="text" class="form-control mb-3" id="Kunci" name="Kunci"
                               placeholder="Contoh: pemograman web" value="<?= $Kunci ?>">
                        <button type="submit" class="btn btn-primary w-100">Kirim via GET</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- POST -->
        <div class="col-md-6">
            <div class="card border-success h-100">
                <div class="card-body">
                    <h3 class="h5 text-success mb-3">Uji Form POST</h3>
                    <form method="POST" action="">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control mb-2" id="username" name="username"
                               placeholder="Contoh: admin" required>
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control mb-3" id="password" name="password" required>
                        <button type="submit" class="btn btn-success w-100">Kirim via POST</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>