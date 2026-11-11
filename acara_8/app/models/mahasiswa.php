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
        if (empty(trim($nim))) {
            throw new \InvalidArgumentException("NIM mahasiswa tidak boleh kosong.");
        }
        $this->nim = $nim;
    }

    public function setNama(string $nama): void
    {
        if (empty(trim($nama))) {
            throw new \InvalidArgumentException("Nama mahasiswa tidak boleh kosong.");
        }
        $this->nama = $nama;
    }

    public function setProdiId(int $prodi_id): void
    {
        $this->prodi_id = $prodi_id;
    }

    public function setStatus(string $status): void
    {
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
        $twoDigits = substr($angkaGabungan, 3, 2);
        return "20" . ($twoDigits ?: '25'); 
    }
}