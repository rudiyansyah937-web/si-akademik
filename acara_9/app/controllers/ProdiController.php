<?php

namespace App\Controllers;

use App\Repositories\ProdiRepository;

class ProdiController
{
    private $repository;

    public function __construct(ProdiRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $prodi = $this->repository->all();

        $content = __DIR__ . '/../views/prodi/index.php';
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function create()
    {
        $content = __DIR__ . '/../views/prodi/tambah.php';
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function store()
    {
        $nama_prodi = trim($_POST['nama_prodi'] ?? '');

        if ($nama_prodi === '') {
            $_SESSION['flash_error'] = "Nama program studi wajib diisi.";
            header("Location: /setoran/acara_9/public/prodi/create");
            exit;
        }

        $this->repository->insert($nama_prodi);
        $_SESSION['flash_message'] = "Data program studi berhasil ditambahkan!";

        header("Location: /setoran/acara_9/public/prodi");
        exit;
    }

    public function edit()
    {
        $id = (int) ($_GET['id'] ?? 0);
        $data = $this->repository->find($id);

        if (!$data) {
            $_SESSION['flash_error'] = "Data program studi tidak ditemukan!";
            header("Location: /setoran/acara_9/public/prodi");
            exit;
        }

        $content = __DIR__ . '/../views/prodi/edit.php';
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function update()
    {
        $id = (int) ($_POST['id'] ?? 0);
        $nama_prodi = trim($_POST['nama_prodi'] ?? '');

        if ($id <= 0 || $nama_prodi === '') {
            $_SESSION['flash_error'] = "Data program studi tidak valid.";
            header("Location: /setoran/acara_9/public/prodi");
            exit;
        }

        if (!$this->repository->find($id)) {
            $_SESSION['flash_error'] = "Data program studi tidak ditemukan!";
            header("Location: /setoran/acara_9/public/prodi");
            exit;
        }

        $this->repository->update($id, $nama_prodi);
        $_SESSION['flash_message'] = "Data program studi berhasil diperbarui!";

        header("Location: /setoran/acara_9/public/prodi");
        exit;
    }

    public function delete()
    {
        $id = (int) ($_POST['id'] ?? 0);

        if ($id > 0) {
            $this->repository->delete($id);
            $_SESSION['flash_message'] = "Data program studi berhasil dihapus!";
        }

        header("Location: /setoran/acara_9/public/prodi");
        exit;
    }
}