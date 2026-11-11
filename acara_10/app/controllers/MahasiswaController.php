<?php
namespace App\Controllers;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/mahasiswa.php';
require_once __DIR__ . '/../Repositories/MahasiswaRepository.php';

use App\Models\Mahasiswa;
use App\Repositories\MahasiswaRepository;

class MahasiswaController extends BaseController
{
    private MahasiswaRepository $repository;

    public function __construct(MahasiswaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $keyword = $_GET['search'] ?? '';

        $this->view('mahasiswa/index', [
            'mahasiswaList' => $this->repository->all($keyword),
        ]);
    }

    public function create()
    {
        $this->view('mahasiswa/tambah', [
            'prodiList' => $this->repository->allProdi(),
        ]);
    }

    public function store()
    {
        try {
            $mhs = new Mahasiswa(
                $_POST['nim'] ?? '',
                $_POST['nama'] ?? '',
                (int)($_POST['prodi_id'] ?? 0),
                $_POST['status'] ?? 'aktif'
            );

            $this->repository->insert($mhs);
            $_SESSION['flash_message'] = "Data mahasiswa berhasil ditambahkan!";
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = "Gagal: " . $e->getMessage();
        }

        $this->redirect('/mahasiswa');
    }

    public function edit()
    {
        $nim = $_GET['nim'] ?? '';
        $mhs = $this->repository->find($nim);

        if (!$mhs) {
            $_SESSION['flash_error'] = "Data tidak ditemukan!";
            $this->redirect('/mahasiswa');
        }

        $this->view('mahasiswa/edit', [
            'mhs'       => $mhs,
            'prodiList' => $this->repository->allProdi(),
        ]);
    }

    public function update()
    {
        try {
            $mhs = new Mahasiswa(
                $_POST['nim'] ?? '',
                $_POST['nama'] ?? '',
                (int)($_POST['prodi_id'] ?? 0),
                $_POST['status'] ?? 'aktif'
            );

            $this->repository->update($mhs);
            $_SESSION['flash_message'] = "Data mahasiswa berhasil diperbarui!";
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = "Gagal: " . $e->getMessage();
        }

        $this->redirect('/mahasiswa');
    }

    public function delete()
    {
        $nim = $_GET['nim'] ?? '';
        $this->repository->delete($nim);

        $_SESSION['flash_message'] = "Data mahasiswa berhasil dihapus!";
        $this->redirect('/mahasiswa');
    }
}