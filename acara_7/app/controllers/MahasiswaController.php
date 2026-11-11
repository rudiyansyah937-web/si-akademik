<?php

class MahasiswaController
{
    public function index(): void
    {
        $model = new MahasiswaModel();
        $mahasiswaList = $model->all();

        $title = 'Daftar Mahasiswa';
        $content = __DIR__ . '/../views/mahasiswa/index.php';
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function create(): void
    {
        echo 'MahasiswaController::create() - Form tambah mahasiswa';
    }

    public function store(): void
    {
        echo 'MahasiswaController::store() - Simpan mahasiswa (POST)';
    }

    public function show(int $id): void
    {
        echo "MahasiswaController::show($id) - Detail mahasiswa dengan id = $id";
    }

    public function edit(int $id): void
    {
        echo "MahasiswaController::edit($id) - Form edit mahasiswa dengan id = $id";
    }
}