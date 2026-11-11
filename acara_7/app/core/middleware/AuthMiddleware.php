<?php

class AuthMiddleware
{    public function handle(): void
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['flash_error'] = 'Silakan login terlebih dahulu';
            redirect('/login');
        }
    }
}