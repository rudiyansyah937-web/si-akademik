<?php
namespace App\Models;

class Mahasiswa
{
    private string $nim;
    private string $nama;
    private int $prodi_id;
    private string $status;

    public function __construct(string $nim = "", string $nama = "", int $prodi_id = 1, string $status = "aktif")
    {
        $this->setNim($nim);
        $this->setNama($nama);
        $this->setProdiId($prodi_id);
        $this->setStatus($status);
    }


    public function setNim(string $nim): void
    {
        $nim = trim($nim);

        if ($nim === '') {
            throw new \InvalidArgumentException("NIM mahasiswa tidak boleh kosong.");
        }
        if (!ctype_digit($nim)) {
            throw new \InvalidArgumentException("NIM harus berupa angka.");
        }
        $this->nim = $nim;
    }

    public function setNama(string $nama): void
    {
        $nama = trim($nama);

        if ($nama === '') {
            throw new \InvalidArgumentException("Nama mahasiswa tidak boleh kosong.");
        }
        $this->nama = $nama;
    }

    public function setProdiId(int $prodi_id): void
    {
        if ($prodi_id <= 0) {
            throw new \InvalidArgumentException("Program studi tidak valid.");
        }
        $this->prodi_id = $prodi_id;
    }

    public function setStatus(string $status): void
    {
        $diizinkan = ['aktif', 'cuti', 'lulus'];

        if (!in_array($status, $diizinkan, true)) {
            throw new \InvalidArgumentException("Status harus aktif, cuti, atau lulus.");
        }
        $this->status = $status;
    }


    public function getNim(): string
    {
        return $this->nim;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getProdiId(): int
    {
        return $this->prodi_id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getAngkatan(): string
    {
        preg_match_all('!\d+!', $this->nim, $matches);
        $angkaGabungan = implode('', $matches[0]);
        $twoDigits = substr($angkaGabungan, 0, 2);
        return "20" . ($twoDigits ?: '25');
    }
}