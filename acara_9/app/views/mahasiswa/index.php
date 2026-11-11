<h1 class="mb-4">Daftar Mahasiswa</h1>

<div class="row mb-3">
    <div class="col-md-6">
        <a href="/setoran/acara_9/public/mahasiswa/create" class="btn btn-primary">Tambah Mahasiswa</a>
    </div>
    <div class="col-md-6">
        <form action="/setoran/acara_9/public/mahasiswa" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari NIM atau Nama..." value="<?= htmlspecialchars($_GET['search'] ?? ''); ?>">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </form>
    </div>
</div>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Angkatan</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($mahasiswaList)): ?>
            <?php foreach ($mahasiswaList as $index => $mhs): ?>
                <?php $angkatan = "20" . substr($mhs['nim'], 0, 2); ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($mhs['nim']); ?></td>
                    <td><?= htmlspecialchars($mhs['nama']); ?></td>
                    <td><?= htmlspecialchars($mhs['nama_prodi']); ?></td>
                    <td><span class="badge bg-info text-dark"><?= $angkatan; ?></span></td>
                    <td>
                        <span class="badge bg-<?= $mhs['status'] == 'aktif' ? 'success' : ($mhs['status'] == 'cuti' ? 'warning' : 'secondary'); ?>">
                            <?= ucfirst($mhs['status']); ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="/setoran/acara_9/public/mahasiswa/edit?nim=<?= $mhs['nim']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="/setoran/acara_9/public/mahasiswa/delete?nim=<?= $mhs['nim']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center text-muted">Data mahasiswa tidak ditemukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>