<?php
require_once __DIR__ . '/../app/models/Mahasiswa.php';

$title = 'Daftar Mahasiswa';

$mahasiswaList = [
    new Mahasiswa('2501001', 'Ahmad Fauzi',  'Teknik Informatika'),
    new Mahasiswa('2501002', 'Siti Aisyah',  'Sistem Informasi'),
    new Mahasiswa('2401015', 'Budi Santoso', 'Teknik Elektro'),
    new Mahasiswa('2301020', 'Dewi Lestari', 'Teknik Informatika'),
];

$content = __DIR__ . '/../app/views/mahasiswa/index.php';
require __DIR__ . '/../app/views/layouts/main.php';