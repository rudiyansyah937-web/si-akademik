<?php
namespace App\Controllers;

use App\Repositories\MatkulRepository;

class MatkulController
{
    private MatkulRepository $repository;

    public function __construct(MatkulRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $keyword = trim($_GET['search'] ?? '');
        $matkul = $this->repository->all($keyword);

        $content = __DIR__ . '/../views/matkul/index.php';
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function create()
    {
        $prodi = $this->repository->allProdi();

        $content = __DIR__ . '/../views/matkul/tambah.php';
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function store()
    {
        $nama_matkul = trim($_POST['nama_matkul'] ?? '');
        $prodi_id = (int) ($_POST['prodi_id'] ?? 0);

        if (
            $nama_matkul === '' ||
            $prodi_id <= 0 ||
            !$this->repository->prodiExists($prodi_id)
        ) {
            $_SESSION['flash_error'] = "Nama mata kuliah dan program studi wajib diisi.";
            header("Location: /setoran/acara_10/public/matkul/create");
            exit;
        }

        $this->repository->insert($nama_matkul, $prodi_id);
        $_SESSION['flash_message'] = "Data mata kuliah berhasil ditambahkan!";

        header("Location: /setoran/acara_10/public/matkul");
        exit;
    }

    public function edit()
    {
        $id = (int) ($_GET['id'] ?? 0);

        $data = $this->repository->find($id);

        if (!$data) {
            $_SESSION['flash_error'] = "Data mata kuliah tidak ditemukan!";
            header("Location: /setoran/acara_10/public/matkul");
            exit;
        }

        $prodi = $this->repository->allProdi();

        $content = __DIR__ . '/../views/matkul/edit.php';
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function update()
    {
        $id = (int) ($_POST['id'] ?? 0);
        $nama_matkul = trim($_POST['nama_matkul'] ?? '');
        $prodi_id = (int) ($_POST['prodi_id'] ?? 0);

        if (
            $id <= 0 ||
            $nama_matkul === '' ||
            $prodi_id <= 0 ||
            !$this->repository->prodiExists($prodi_id)
        ) {
            $_SESSION['flash_error'] = "Data mata kuliah tidak valid.";
            header("Location: /setoran/acara_10/public/matkul");
            exit;
        }

        if (!$this->repository->find($id)) {
            $_SESSION['flash_error'] = "Data mata kuliah tidak ditemukan!";
            header("Location: /setoran/acara_10/public/matkul");
            exit;
        }

        $this->repository->update($id, $nama_matkul, $prodi_id);
        $_SESSION['flash_message'] = "Data mata kuliah berhasil diperbarui!";

        header("Location: /setoran/acara_10/public/matkul");
        exit;
    }

    public function delete()
    {
        $id = (int) ($_POST['id'] ?? 0);

        if ($id > 0 && $this->repository->find($id)) {
            $this->repository->delete($id);
            $_SESSION['flash_message'] = "Data mata kuliah berhasil dihapus!";
        } else {
            $_SESSION['flash_error'] = "Data mata kuliah tidak ditemukan!";
        }

        header("Location: /setoran/acara_10/public/matkul");
        exit;
    }
}