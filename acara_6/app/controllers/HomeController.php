<?php

class HomeController
{
    public function index(): void
    {
        redirect(empty($_SESSION['user']) ? '/login' : '/dashboard');
    }

    public function dashboard(): void
    {
        $title = 'Dashboard';
        $pesan = flash('flash_success');
        $content = __DIR__ . '/../views/dashboard/index.php';
        require __DIR__ . '/../views/layouts/main.php';
    }
}