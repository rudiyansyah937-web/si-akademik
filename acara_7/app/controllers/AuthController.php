<?php

class AuthController
{
    private const USERNAME = 'admin';
    private const PASSWORD = '12345';

    public function loginForm(): void
    {
        if (!empty($_SESSION['user'])) {
            redirect('/dashboard');
        }
        $success = flash('flash_success');
        $error   = flash('flash_error');
        require __DIR__ . '/../views/auth/login.php';
    }

    public function login(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === self::USERNAME && $password === self::PASSWORD) {
            session_regenerate_id(true);
            $_SESSION['user'] = $username;
            $_SESSION['flash_success'] = 'Selamat datang, Admin';
            redirect('/dashboard');
        }

        $_SESSION['flash_error'] = 'Username atau password salah';
        redirect('/login');
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        session_regenerate_id(true);
        $_SESSION['flash_success'] = 'Anda telah logout';
        redirect('/login');
    }
}