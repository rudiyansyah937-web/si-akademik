<?php
namespace App\Controllers;

class HomeController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['logged_in'])) {
            header('Location: /setoran/acara_8/public/login');
        } else {
            header('Location: /setoran/acara_8/public/mahasiswa');
        }
        exit;
    }
}