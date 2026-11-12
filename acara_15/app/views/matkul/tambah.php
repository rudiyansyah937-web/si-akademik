<h1 class="mb-4">Tambah Mata Kuliah</h1>

<form action="/setoran/acara_14/public/matkul" method="POST" class="card card-body">

    <div class="mb-3">
        <label class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="nama_matkul" class="form-control"
               placeholder="Masukkan nama mata kuliah" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Program Studi</label>
        <select name="prodi_id" class="form-select" required>
            <option value="">-- Pilih Program Studi --</option>
            <?php foreach ($prodi as $item): ?>
                <option value="<?= htmlspecialchars($item['id']) ?>">
                    <?= htmlspecialchars($item['nama_prodi']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/setoran/acara_14/public/matkul" class="btn btn-secondary">Kembali</a>
    </div>
</form>