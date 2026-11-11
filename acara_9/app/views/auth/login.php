<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-sm p-4" style="width: 350px;">
        <h3 class="text-center mb-3">Login SI Akademik</h3>
        <?php
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!empty($_SESSION['flash_error'])) {
            echo '<div class="alert alert-danger p-2">' . $_SESSION['flash_error'] . '</div>';
            unset($_SESSION['flash_error']);
        }
        if (!empty($_SESSION['flash_message'])) {
            echo '<div class="alert alert-success p-2">' . $_SESSION['flash_message'] . '</div>';
            unset($_SESSION['flash_message']);
        }
        ?>
        <form action="/setoran/acara_9/public/login" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>