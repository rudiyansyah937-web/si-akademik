<?php
require_once __DIR__ . '/../app/models/Mahasiswa.php';

$title = 'Daftar Mahasiswa';

$mahasiswaList = [
    new Mahasiswa('E41250942', 'Rudiyansyah Mahendra Nur Rohman', 'Teknik Informatika'),
    new Mahasiswa('E41268865', 'Kairi Jago Ling',     'Teknik Informatika'),
    new Mahasiswa('E41256856', 'Agus Syahrul Galan',       'Sistem Informasi'),
];

$content = __DIR__ . '/../app/views/mahasiswa/index.php';
require __DIR__ . '/../app/views/layouts/main.php';