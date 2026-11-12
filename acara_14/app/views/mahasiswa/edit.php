<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-warning text-dark">
        <h1 class="h5 mb-0">Form Edit Mahasiswa</h1>
    </div>
    <div class="card-body">
        <form action="<?= BASE_URL ?>/mahasiswa/update" method="POST" novalidate>
            <input type="hidden" name="id" value="<?= (int)$mhs['id'] ?>">

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim"
                       value="<?= htmlspecialchars((string)$mhs['nim']) ?>">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama"
                       value="<?= htmlspecialchars((string)$mhs['nama']) ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="<?= htmlspecialchars((string)$mhs['email']) ?>">
            </div>
            <div class="mb-3">
                <label for="angkatan" class="form-label">Angkatan</label>
                <input type="number" class="form-control" id="angkatan" name="angkatan"
                       value="<?= htmlspecialchars((string)$mhs['angkatan']) ?>">
            </div>
            <div class="d-flex justify-content-between">
                <a href="<?= BASE_URL ?>/mahasiswa" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-warning">Update Data</button>
            </div>
        </form>
    </div>
</div>