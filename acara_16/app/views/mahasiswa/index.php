<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Daftar Mahasiswa</h1>
    <a href="<?= BASE_URL ?>/mahasiswa/create" class="btn btn-primary">Tambah Mahasiswa</a>
</div>

<form method="GET" action="<?= BASE_URL ?>/mahasiswa" class="row g-2 mb-3">
    <div class="col-12 col-md-6 col-lg-4">
        <input type="text" name="search" class="form-control" placeholder="Cari NIM atau nama..."
               value="<?= htmlspecialchars($keyword) ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-outline-secondary">Cari</button>
    </div>
</form>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Angkatan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($mahasiswaList)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data mahasiswa.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($mahasiswaList as $i => $m): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($m['nim']) ?></td>
                        <td><?= htmlspecialchars($m['nama']) ?></td>
                        <td><?= htmlspecialchars($m['email']) ?></td>
                        <td><span class="badge bg-info text-dark"><?= htmlspecialchars((string)$m['angkatan']) ?></span></td>
                        <td class="text-center text-nowrap">
                            <a href="<?= BASE_URL ?>/mahasiswa/edit?id=<?= (int)$m['id'] ?>"
                               class="btn btn-sm btn-warning">Edit</a>

                            <form action="<?= BASE_URL ?>/mahasiswa/delete" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>