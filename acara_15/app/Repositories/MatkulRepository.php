<?php
namespace App\Repositories;

use App\Config\Database;
use PDO;

class MatkulRepository
{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database->getConnection();
    }

    public function all($keyword = '')
    {
        $query = "SELECT matkul.*, prodi.nama_prodi
                  FROM matkul
                  LEFT JOIN prodi ON matkul.prodi_id = prodi.id";

        $params = [];

        if ($keyword !== '') {
            $query .= " WHERE matkul.nama_matkul LIKE :keyword
                        OR prodi.nama_prodi LIKE :keyword";
            $params[':keyword'] = '%' . $keyword . '%';
        }

        $query .= " ORDER BY matkul.id ASC";

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function allProdi()
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM prodi ORDER BY id ASC"
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function prodiExists($id)
    {
        $stmt = $this->db->prepare(
            "SELECT id FROM prodi WHERE id = :id"
        );

        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    public function find($id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM matkul WHERE id = :id"
        );

        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($nama_matkul, $prodi_id)
    {
        $sql = "INSERT INTO matkul (nama_matkul, prodi_id)
                VALUES (:nama_matkul, :prodi_id)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nama_matkul' => $nama_matkul,
            ':prodi_id' => $prodi_id
        ]);
    }

    public function update($id, $nama_matkul, $prodi_id)
    {
        $stmt = $this->db->prepare(
            "UPDATE matkul
             SET nama_matkul = :nama_matkul,
                 prodi_id = :prodi_id
             WHERE id = :id"
        );

        return $stmt->execute([
            ':id' => $id,
            ':nama_matkul' => $nama_matkul,
            ':prodi_id' => $prodi_id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM matkul WHERE id = :id"
        );

        return $stmt->execute([':id' => $id]);
    }
}