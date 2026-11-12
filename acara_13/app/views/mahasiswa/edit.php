<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0">Form Edit Mahasiswa</h4>
    </div>
    <div class="card-body">
        <form action="/setoran/acara_13/public/mahasiswa/update" method="POST">
            <input type="hidden" name="nim" value="<?= htmlspecialchars($mhs['nim']); ?>">
            
            <div class="mb-3">
                <label class="form-label">NIM (Tidak dapat diubah)</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($mhs['nim']); ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($mhs['nama']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Program Studi</label>
                <select class="form-select" name="prodi_id" required>
                    <?php foreach ($prodiList as $p): ?>
                        <option value="<?= (int)$p['id'] ?>" <?= $mhs['prodi_id'] == $p['id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($p['nama_prodi']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status" required>
                    <option value="aktif" <?= $mhs['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                    <option value="cuti" <?= $mhs['status'] == 'cuti' ? 'selected' : ''; ?>>Cuti</option>
                    <option value="lulus" <?= $mhs['status'] == 'lulus' ? 'selected' : ''; ?>>Lulus</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <a href="/setoran/acara_13/public/mahasiswa" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-warning">Update Data</button>
            </div>
        </form>
    </div>
</div>