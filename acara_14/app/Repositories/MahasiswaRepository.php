<?php

class MahasiswaRepository
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    private function pdo(): PDO
    {
        return $this->database->getConnection();
    }

    public function all(string $keyword = ''): array
    {
        if ($keyword !== '') {
            $stmt = $this->pdo()->prepare(
                'SELECT id, nim, nama, email, angkatan FROM mahasiswa
                 WHERE nim LIKE :kw1 OR nama LIKE :kw2
                 ORDER BY nim'
            );
            $stmt->execute([
                ':kw1' => "%$keyword%",
                ':kw2' => "%$keyword%",
            ]);
        } else {
            $stmt = $this->pdo()->prepare(
                'SELECT id, nim, nama, email, angkatan FROM mahasiswa ORDER BY nim'
            );
            $stmt->execute();
        }

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo()->prepare(
            'SELECT id, nim, nama, email, angkatan FROM mahasiswa WHERE id = :id'
        );
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo()->prepare(
            'INSERT INTO mahasiswa (nim, nama, email, angkatan)
             VALUES (:nim, :nama, :email, :angkatan)'
        );
        $stmt->execute([
            ':nim'      => $data['nim'],
            ':nama'     => $data['nama'],
            ':email'    => $data['email'],
            ':angkatan' => $data['angkatan'],
        ]);

        return (int)$this->pdo()->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo()->prepare(
            'UPDATE mahasiswa
             SET nim = :nim, nama = :nama, email = :email, angkatan = :angkatan
             WHERE id = :id'
        );

        return $stmt->execute([
            ':nim'      => $data['nim'],
            ':nama'     => $data['nama'],
            ':email'    => $data['email'],
            ':angkatan' => $data['angkatan'],
            ':id'       => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo()->prepare('DELETE FROM mahasiswa WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function existsByNim(string $nim, ?int $exceptId = null): bool
    {
        if ($exceptId !== null) {
            $stmt = $this->pdo()->prepare(
                'SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim AND id <> :id'
            );
            $stmt->execute([':nim' => $nim, ':id' => $exceptId]);
        } else {
            $stmt = $this->pdo()->prepare('SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim');
            $stmt->execute([':nim' => $nim]);
        }

        return (int)$stmt->fetchColumn() > 0;
    }
}