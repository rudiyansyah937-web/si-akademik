<?php

class MahasiswaController extends BaseController
{
    private MahasiswaService $service;

    public function __construct(MahasiswaService $service)
    {
        $this->service = $service;
    }

    public function index(): void
    {
        $keyword = trim($_GET['search'] ?? '');

        try {
            $mahasiswaList = $this->service->all($keyword);
        } catch (AppException $e) {
            $this->flash('error', $e->getMessage());
            $mahasiswaList = [];
        }

        $this->view('mahasiswa/index', [
            'mahasiswaList' => $mahasiswaList,
            'keyword'       => $keyword,
        ]);
    }

    public function create(): void
    {
        $this->view('mahasiswa/create', [
            'old' => $this->pullOldInput(),
        ]);
    }

    public function store(): void
    {
        try {
            $this->service->create($_POST);
            $this->flash('success', 'Data mahasiswa berhasil ditambahkan.');
            $this->redirect('/mahasiswa');
        } catch (AppException $e) {
            $this->flash('error', $e->getMessage());
            $this->rememberInput($_POST);
            $this->redirect('/mahasiswa/create');
        }
    }

    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);

        try {
            $mhs = $this->service->find($id);
        } catch (AppException $e) {
            $this->flash('error', $e->getMessage());
            $this->redirect('/mahasiswa');
        }

        $mhs = array_merge($mhs, $this->pullOldInput());

        $this->view('mahasiswa/edit', ['mhs' => $mhs]);
    }

    public function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);

        try {
            $this->service->update($id, $_POST);
            $this->flash('success', 'Data mahasiswa berhasil diubah.');
            $this->redirect('/mahasiswa');
        } catch (AppException $e) {
            $this->flash('error', $e->getMessage());
            $this->rememberInput($_POST);
            $this->redirect('/mahasiswa/edit?id=' . $id);
        }
    }

    public function delete(): void
    {
        $id = (int)($_POST['id'] ?? 0);

        try {
            $this->service->delete($id);
            $this->flash('success', 'Data mahasiswa berhasil dihapus.');
        } catch (AppException $e) {
            $this->flash('error', $e->getMessage());
        }

        $this->redirect('/mahasiswa');
    }
}