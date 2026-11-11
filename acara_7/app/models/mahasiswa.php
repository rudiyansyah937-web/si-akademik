<?php

require_once __DIR__ . '/Model.php';

class MahasiswaModel extends Model
{
    // Ambil semua mahasiswa beserta nama prodinya
    public function all(): array
    {
        $sql = 'SELECT m.nim, m.nama, p.nama_prodi, m.status
                FROM mahasiswa m
                JOIN prodi p ON p.id = m.prodi_id
                ORDER BY m.nim';

        return $this->db->query($sql)->fetchAll();
    }
}