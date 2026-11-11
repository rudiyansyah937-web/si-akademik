<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Form Tambah Mahasiswa</h4>
    </div>
    <div class="card-body">
        <form action="/setoran/acara_8/public/mahasiswa" method="POST">
            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" class="form-control" name="nim" placeholder="" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Program Studi</label>
                <select class="form-select" name="prodi_id" required>
                    <option value="" disabled selected>Pilih Program Studi</option>
                    <?php foreach ($prodiList as $p): ?>
                        <option value="<?= (int)$p['id'] ?>"><?= htmlspecialchars($p['nama_prodi']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status" required>
                    <option value="aktif" selected>Aktif</option>
                    <option value="cuti">Cuti</option>
                    <option value="lulus">Lulus</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <a href="/setoran/acara_8/public/mahasiswa" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>