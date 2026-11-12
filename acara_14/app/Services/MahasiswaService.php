<?php

class MahasiswaService
{
    private MahasiswaRepository $repository;

    public function __construct(MahasiswaRepository $repository)
    {
        $this->repository = $repository;
    }


    public function all(string $keyword = ''): array
    {
        try {
            return $this->repository->all(trim($keyword));
        } catch (PDOException $e) {
            $this->fail('Gagal mengambil daftar mahasiswa', $e, 'Data gagal dimuat.');
        }
    }

    public function find(int $id): array
    {
        try {
            $mhs = $this->repository->find($id);
        } catch (PDOException $e) {
            $this->fail("Gagal mengambil mahasiswa id=$id", $e, 'Data gagal dimuat.');
        }

        if ($mhs === null) {
            throw new AppException('Data mahasiswa tidak ditemukan.');
        }
        return $mhs;
    }


    public function create(array $input): void
    {
        $data = $this->validate($input);

        try {
            if ($this->repository->existsByNim($data['nim'])) {
                throw new AppException('NIM sudah terdaftar.');
            }
            $this->repository->create($data);
        } catch (PDOException $e) {
            if ((int)($e->errorInfo[1] ?? 0) === 1062) {
                throw new AppException('NIM sudah terdaftar.');
            }
            $this->fail('Gagal menyimpan mahasiswa baru', $e, 'Data gagal disimpan.');
        }
    }

    public function update(int $id, array $input): void
    {
        $data = $this->validate($input);

        try {
            if ($this->repository->find($id) === null) {
                throw new AppException('Data mahasiswa tidak ditemukan.');
            }
            if ($this->repository->existsByNim($data['nim'], $id)) {
                throw new AppException('NIM sudah terdaftar.');
            }
            $this->repository->update($id, $data);
        } catch (PDOException $e) {
            if ((int)($e->errorInfo[1] ?? 0) === 1062) {
                throw new AppException('NIM sudah terdaftar.');
            }
            $this->fail("Gagal mengubah mahasiswa id=$id", $e, 'Data gagal disimpan.');
        }
    }


    public function delete(int $id): void
    {
        try {
            if ($this->repository->find($id) === null) {
                throw new AppException('Data mahasiswa tidak ditemukan.');
            }
            $this->repository->delete($id);
        } catch (PDOException $e) {
            $this->fail("Gagal menghapus mahasiswa id=$id", $e, 'Data gagal dihapus.');
        }
    }


    private function validate(array $input): array
    {
        $nim      = trim((string)($input['nim'] ?? ''));
        $nama     = trim((string)($input['nama'] ?? ''));
        $email    = trim((string)($input['email'] ?? ''));
        $angkatan = trim((string)($input['angkatan'] ?? ''));

        if ($nim === '') {
            throw new AppException('NIM tidak boleh kosong.');
        }
        if (!ctype_digit($nim)) {
            throw new AppException('NIM harus berupa angka.');
        }
        if (strlen($nim) > 20) {
            throw new AppException('NIM maksimal 20 digit.');
        }

        if ($nama === '') {
            throw new AppException('Nama tidak boleh kosong.');
        }
        if (mb_strlen($nama) > 100) {
            throw new AppException('Nama maksimal 100 karakter.');
        }

        if ($email === '') {
            throw new AppException('Email tidak boleh kosong.');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 100) {
            throw new AppException('Format email tidak valid.');
        }

        if (!ctype_digit($angkatan) || strlen($angkatan) !== 4) {
            throw new AppException('Angkatan harus berupa tahun 4 digit.');
        }
        $tahun = (int)$angkatan;
        if ($tahun < 2000 || $tahun > (int)date('Y') + 1) {
            throw new AppException('Angkatan tidak valid.');
        }

        return [
            'nim'      => $nim,
            'nama'     => $nama,
            'email'    => $email,
            'angkatan' => $tahun,
        ];
    }

    private function fail(string $logMessage, Throwable $e, string $userMessage): never
    {
        Logger::error($logMessage, $e);
        throw new AppException($userMessage);
    }
}