<?php
$title = 'Tambah Mahasiswa';
$prodiList = $prodiList ?? [
    1 => 'Teknik Informatika',
    2 => 'Sistem Informasi',
    3 => 'Teknik Elektro',
];

include __DIR__ . '/../partials/header.php';
?>

<div class="card shadow-sm col-lg-8 mx-auto">
    <div class="card-header bg-primary text-white">
        <h1 class="h5 mb-0">Form Tambah Mahasiswa</h1>
    </div>
    <div class="card-body">
        <form action="#" method="POST">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="Contoh: 2501001" required>
                </div>
                <div class="col-md-8">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="col-md-8">
                    <label for="prodi_id" class="form-label">Program Studi</label>
                    <select class="form-select" id="prodi_id" name="prodi_id" required>
                        <option value="" disabled selected>Pilih program studi</option>
                        <?php foreach ($prodiList as $id => $nama): ?>
                            <option value="<?= (int)$id ?>"><?= htmlspecialchars($nama) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="aktif" selected>Aktif</option>
                        <option value="cuti">Cuti</option>
                        <option value="lulus">Lulus</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="index.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>