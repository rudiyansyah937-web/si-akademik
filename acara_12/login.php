<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === '12345') {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_name'] = 'Admin';
        header('Location: login.php');
        exit;
    }
    $error = 'Username atau password salah!';
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 400px;">
        <div class="card-header bg-primary text-white text-center">
            <h1 class="h5 mb-0">Login SI Akademik</h1>
        </div>
        <div class="card-body">
            <?php if (!empty($_SESSION['logged_in'])): ?>
                <div class="alert alert-success">
                    Selamat datang, <?= htmlspecialchars($_SESSION['user_name']) ?>!
                </div>
                <a href="login.php?logout=1" class="btn btn-outline-danger w-100">Logout</a>
            <?php else: ?>
                <?php if ($error !== ''): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>