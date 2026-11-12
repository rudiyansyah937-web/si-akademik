<?php
require_once __DIR__ . '/../config/database.php';

ini_set('display_errors', '1');
error_reporting(E_ALL);

try {
    $pdo = getConnection();
    echo "<p style='color:green'>Koneksi berhasil.</p>";

    $jumlah = $pdo->query('SELECT COUNT(*) FROM mahasiswa')->fetchColumn();
    echo "<p style='color:green'>Tabel mahasiswa ditemukan, jumlah data: {$jumlah}</p>";

    $kolom = $pdo->query('SHOW COLUMNS FROM mahasiswa')->fetchAll(PDO::FETCH_COLUMN);
    echo '<p>Kolom: ' . implode(', ', $kolom) . '</p>';
} catch (Throwable $e) {
    echo "<p style='color:red'>Gagal: " . htmlspecialchars($e->getMessage()) . '</p>';
}