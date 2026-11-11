<?php
namespace App\Controllers;

class AuthController
{
    public function loginForm()
    {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === '12345') {
            $_SESSION['user_id'] = 1;
            $_SESSION['user_name'] = 'Admin';
            $_SESSION['logged_in'] = true;
            $_SESSION['flash_message'] = 'Selamat datang, Admin!';

            header('Location: /setoran/acara_9/public/mahasiswa');
            exit;
        } else {
            $_SESSION['flash_error'] = 'Username atau password salah!';
            header('Location: /setoran/acara_9/public/login');
            exit;
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();

        session_start();
        $_SESSION['flash_message'] = 'Anda telah logout.';
        header('Location: /setoran/acara_9/public/login');
        exit;
    }
}