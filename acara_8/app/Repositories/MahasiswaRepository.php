<?php
namespace App\Repositories;

use App\Config\Database;
use App\Models\Mahasiswa;
use PDO;

class MahasiswaRepository {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function all($keyword = "") {
        if (!empty($keyword)) {
            $query = "SELECT mahasiswa.*, prodi.nama_prodi FROM mahasiswa 
                      LEFT JOIN prodi ON mahasiswa.prodi_id = prodi.id 
                      WHERE mahasiswa.nim LIKE :kw1 OR mahasiswa.nama LIKE :kw2";
            $stmt = $this->db->prepare($query);
            $like = "%$keyword%";
            $stmt->execute([':kw1' => $like, ':kw2' => $like]);
        } else {
            $query = "SELECT mahasiswa.*, prodi.nama_prodi FROM mahasiswa 
                      LEFT JOIN prodi ON mahasiswa.prodi_id = prodi.id";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function allProdi() {
        $stmt = $this->db->prepare("SELECT id, nama_prodi FROM prodi ORDER BY nama_prodi ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($nim) {
        $query = "SELECT * FROM mahasiswa WHERE nim = :nim";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':nim' => $nim]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(Mahasiswa $mahasiswa) {
        $query = "INSERT INTO mahasiswa (nim, nama, prodi_id, status) VALUES (:nim, :nama, :prodi_id, :status)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':nim' => $mahasiswa->getNim(),
            ':nama' => $mahasiswa->getNama(),
            ':prodi_id' => $mahasiswa->getProdiId(),
            ':status' => $mahasiswa->getStatus()
        ]);
    }

    public function update(Mahasiswa $mahasiswa) {
        $query = "UPDATE mahasiswa SET nama = :nama, prodi_id = :prodi_id, status = :status WHERE nim = :nim";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':nim' => $mahasiswa->getNim(),
            ':nama' => $mahasiswa->getNama(),
            ':prodi_id' => $mahasiswa->getProdiId(),
            ':status' => $mahasiswa->getStatus()
        ]);
    }

    public function delete($nim) {
        $query = "DELETE FROM mahasiswa WHERE nim = :nim";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':nim' => $nim]);
    }
}