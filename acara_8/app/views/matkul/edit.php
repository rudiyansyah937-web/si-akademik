<h1 class="mb-4">Edit Mata Kuliah</h1>

<form action="/setoran/acara_8/public/matkul/update" method="POST" class="card card-body">

    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

    <?php if (isset($data['kode_matkul'])): ?>
        <div class="mb-3">
            <label class="form-label">Kode Mata Kuliah</label>
            <input type="text" class="form-control"
                   value="<?= htmlspecialchars($data['kode_matkul']) ?>" readonly>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="nama_matkul" class="form-control"
               value="<?= htmlspecialchars($data['nama_matkul']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Program Studi</label>
        <select name="prodi_id" class="form-select" required>
            <option value="">-- Pilih Program Studi --</option>
            <?php foreach ($prodi as $item): ?>
                <option value="<?= htmlspecialchars($item['id']) ?>"
                    <?= $data['prodi_id'] == $item['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($item['nama_prodi']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/setoran/acara_8/public/matkul" class="btn btn-secondary">Kembali</a>
    </div>
</form>