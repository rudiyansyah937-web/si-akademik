<?php

namespace App\Repositories;

use App\Config\Database;
use PDO;

class ProdiRepository
{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database->getConnection();
    }

    public function all()
    {
        $query = "SELECT * FROM prodi ORDER BY id ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $query = "SELECT * FROM prodi WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($nama_prodi)
    {
        $query = "INSERT INTO prodi (nama_prodi) VALUES (:nama_prodi)";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':nama_prodi' => $nama_prodi
        ]);
    }
    public function update($id, $nama_prodi)
    {
        $query = "UPDATE prodi
                  SET nama_prodi = :nama_prodi
                  WHERE id = :id";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':id' => $id,
            ':nama_prodi' => $nama_prodi
        ]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM prodi WHERE id = :id";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
