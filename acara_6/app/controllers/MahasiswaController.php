<?php

class MahasiswaController
{
    public function index(): void
    {
        echo 'MahasiswaController::index() - Daftar mahasiswa';
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