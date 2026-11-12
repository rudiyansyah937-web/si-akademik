<h1 class="mb-4">Edit Program Studi</h1>

<form action="/setoran/acara_13/public/prodi/update" method="POST" class="card card-body">

    <input type="hidden" name="id" value="<?= (int)$data['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Nama Program Studi</label>
        <input type="text" name="nama_prodi" class="form-control"
               value="<?= htmlspecialchars($data['nama_prodi']) ?>" required>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/setoran/acara_13/public/prodi" class="btn btn-secondary">Kembali</a>
    </div>
</form>