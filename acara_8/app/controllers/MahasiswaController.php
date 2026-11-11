<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/mahasiswa.php';
require_once __DIR__ . '/../Repositories/MahasiswaRepository.php';

use App\Models\Mahasiswa;
use App\Repositories\MahasiswaRepository;

class MahasiswaController {
    private MahasiswaRepository $repository;

    public function __construct(MahasiswaRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        $keyword = $_GET['search'] ?? '';
        $mahasiswaList = $this->repository->all($keyword);

        $content = __DIR__ . '/../views/mahasiswa/index.php';
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    public function create() {
        $prodiList = $this->repository->allProdi();

        $content = __DIR__ . '/../views/mahasiswa/tambah.php';
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    public function store() {
        try {
            $mhs = new Mahasiswa(
                $_POST['nim'], 
                $_POST['nama'], 
                (int)$_POST['prodi_id'], 
                $_POST['status']
            );

            $this->repository->insert($mhs);
            $_SESSION['flash_message'] = "Data mahasiswa berhasil ditambahkan!";
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = "Gagal: " . $e->getMessage();
        }

        header('Location: /setoran/acara_8/public/mahasiswa');
        exit;
    }

    public function edit() {
        $nim = $_GET['nim'] ?? '';
        $mhs = $this->repository->find($nim);

        if (!$mhs) {
            $_SESSION['flash_error'] = "Data tidak ditemukan!";
            header('Location: /setoran/acara_8/public/mahasiswa');
            exit;
        }

        $prodiList = $this->repository->allProdi();

        $content = __DIR__ . '/../views/mahasiswa/edit.php';
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    public function update() {
        try {
            $mhs = new Mahasiswa(
                $_POST['nim'], 
                $_POST['nama'], 
                (int)$_POST['prodi_id'], 
                $_POST['status']
            );

            $this->repository->update($mhs);
            $_SESSION['flash_message'] = "Data mahasiswa berhasil diperbarui!";
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = "Gagal: " . $e->getMessage();
        }

        header('Location: /setoran/acara_8/public/mahasiswa');
        exit;
    }

    public function delete() {
        $nim = $_GET['nim'] ?? '';
        $this->repository->delete($nim);

        $_SESSION['flash_message'] = "Data mahasiswa berhasil dihapus!";
        header('Location: /setoran/acara_8/public/mahasiswa');
        exit;
    }
}