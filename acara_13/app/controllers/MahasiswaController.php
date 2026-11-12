<?php
namespace App\Controllers;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Services/MahasiswaService.php';

use App\Services\MahasiswaService;

class MahasiswaController extends BaseController
{
    private MahasiswaService $service;

    public function __construct(MahasiswaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $keyword = $_GET['search'] ?? '';

        $this->view('mahasiswa/index', [
            'mahasiswaList' => $this->service->all($keyword),
        ]);
    }

    public function create()
    {
        $this->view('mahasiswa/tambah', [
            'prodiList' => $this->service->allProdi(),
        ]);
    }

    public function store()
    {
        $result = $this->service->create($_POST);

        $this->flash($result['success'] ? 'success' : 'error', $result['message']);

        $this->redirect($result['success'] ? '/mahasiswa' : '/mahasiswa/create');
    }

    public function edit()
    {
        $nim = $_GET['nim'] ?? '';
        $mhs = $this->service->find($nim);

        if (!$mhs) {
            $this->flash('error', 'Data tidak ditemukan!');
            $this->redirect('/mahasiswa');
        }

        $this->view('mahasiswa/edit', [
            'mhs'       => $mhs,
            'prodiList' => $this->service->allProdi(),
        ]);
    }

    public function update()
    {
        $result = $this->service->update($_POST);

        $this->flash($result['success'] ? 'success' : 'error', $result['message']);

        if ($result['success']) {
            $this->redirect('/mahasiswa');
        }
        $this->redirect('/mahasiswa/edit?nim=' . urlencode($_POST['nim'] ?? ''));
    }

    public function delete()
    {
        $result = $this->service->delete($_GET['nim'] ?? '');

        $this->flash($result['success'] ? 'success' : 'error', $result['message']);
        $this->redirect('/mahasiswa');
    }
}