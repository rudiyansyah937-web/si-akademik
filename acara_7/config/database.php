<?php

class Database
{
    private const HOST = 'localhost';
    private const NAME = 'si_akademik';
    private const USER = 'root';
    private const PASS = '';

    private static ?PDO $conn = null;

    public static function getConnection(): PDO
    {
        if (self::$conn === null) {
            try {
                $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::NAME . ';charset=utf8mb4';
                self::$conn = new PDO($dsn, self::USER, self::PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die('Koneksi database gagal: ' . $e->getMessage());
            }
        }
        return self::$conn;
    }
}