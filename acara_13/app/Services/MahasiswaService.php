<?php
namespace App\Services;

require_once __DIR__ . '/../models/mahasiswa.php';
require_once __DIR__ . '/../Repositories/MahasiswaRepository.php';

use App\Models\Mahasiswa;
use App\Repositories\MahasiswaRepository;

class MahasiswaService
{
    private MahasiswaRepository $repository;

    public function __construct(MahasiswaRepository $repository)
    {
        $this->repository = $repository;
    }


    public function all(string $keyword = ''): array
    {
        return $this->repository->all($keyword);
    }

    public function allProdi(): array
    {
        return $this->repository->allProdi();
    }

    public function find(string $nim)
    {
        return $this->repository->find($nim);
    }


    public function create(array $data): array
    {
        $nim      = trim($data['nim'] ?? '');
        $nama     = trim($data['nama'] ?? '');
        $prodiId  = (int)($data['prodi_id'] ?? 0);
        $status   = $data['status'] ?? 'aktif';

        $error = $this->validate($nim, $nama, $prodiId, $status);
        if ($error !== null) {
            return $this->result(false, $error);
        }

        if ($this->repository->find($nim)) {
            return $this->result(false, 'NIM sudah terdaftar!');
        }

        try {
            $this->repository->insert(new Mahasiswa($nim, $nama, $prodiId, $status));
            return $this->result(true, 'Data mahasiswa berhasil ditambahkan!');
        } catch (\InvalidArgumentException $e) {
            return $this->result(false, $e->getMessage());
        } catch (\PDOException $e) {
            if (($e->errorInfo[1] ?? 0) === 1062) {
                return $this->result(false, 'NIM sudah terdaftar!');
            }
            return $this->result(false, 'Data gagal disimpan.');
        }
    }


    public function update(array $data): array
    {
        $nim      = trim($data['nim'] ?? '');
        $nama     = trim($data['nama'] ?? '');
        $prodiId  = (int)($data['prodi_id'] ?? 0);
        $status   = $data['status'] ?? 'aktif';

        $error = $this->validate($nim, $nama, $prodiId, $status);
        if ($error !== null) {
            return $this->result(false, $error);
        }

        if (!$this->repository->find($nim)) {
            return $this->result(false, 'Data mahasiswa tidak ditemukan!');
        }

        try {
            $this->repository->update(new Mahasiswa($nim, $nama, $prodiId, $status));
            return $this->result(true, 'Data mahasiswa berhasil diubah!');
        } catch (\InvalidArgumentException $e) {
            return $this->result(false, $e->getMessage());
        } catch (\PDOException $e) {
            return $this->result(false, 'Data gagal disimpan.');
        }
    }


    public function delete(string $nim): array
    {
        try {
            $this->repository->delete($nim);
            return $this->result(true, 'Data mahasiswa berhasil dihapus!');
        } catch (\PDOException $e) {
            return $this->result(false, 'Data gagal dihapus.');
        }
    }


    private function validate(string $nim, string $nama, int $prodiId, string $status): ?string
    {
        if ($nim === '') {
            return 'NIM tidak boleh kosong.';
        }
        if (!ctype_digit($nim)) {
            return 'NIM harus berupa angka.';
        }
        if ($nama === '') {
            return 'Nama mahasiswa tidak boleh kosong.';
        }
        if ($prodiId <= 0) {
            return 'Program studi wajib dipilih.';
        }
        if (!in_array($status, ['aktif', 'cuti', 'lulus'], true)) {
            return 'Status harus aktif, cuti, atau lulus.';
        }
        return null;
    }

    private function result(bool $success, string $message): array
    {
        return ['success' => $success, 'message' => $message];
    }
}