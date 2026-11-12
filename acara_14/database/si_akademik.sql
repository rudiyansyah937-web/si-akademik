CREATE DATABASE IF NOT EXISTS si_akademik_final
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE si_akademik_final;

CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    angkatan YEAR NOT NULL
);

INSERT INTO mahasiswa (nim, nama, email, angkatan) VALUES
('2501001', 'Ahmad Fauzi',  'ahmad.fauzi@example.com',  2025),
('2501002', 'Siti Aisyah',  'siti.aisyah@example.com',  2025),
('2401003', 'Budi Santoso', 'budi.santoso@example.com', 2024);