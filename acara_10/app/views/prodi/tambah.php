<h1 class="mb-4">Tambah Program Studi</h1>

<form action="/setoran/acara_10/public/prodi" method="POST" class="card card-body">

    <div class="mb-3">
        <label class="form-label">Nama Program Studi</label>
        <input type="text" name="nama_prodi" class="form-control"
               placeholder="Masukkan nama program studi" required>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/setoran/acara_10/public/prodi" class="btn btn-secondary">Kembali</a>
    </div>
</form>