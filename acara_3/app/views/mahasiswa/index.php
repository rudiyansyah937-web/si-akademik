<?php
$mahasiswaList = $mahasiswaList ?? [
    ['nim' => '2501001', 'nama' => 'Ahmad Fauzi',  'prodi' => 'Teknik Informatika', 'status' => 'aktif'],
    ['nim' => '2501002', 'nama' => 'Siti Aisyah',  'prodi' => 'Sistem Informasi',   'status' => 'aktif'],
    ['nim' => '2401015', 'nama' => 'Budi Santoso', 'prodi' => 'Teknik Elektro',     'status' => 'cuti'],
    ['nim' => '2301020', 'nama' => 'Dewi Lestari', 'prodi' => 'Teknik Informatika', 'status' => 'lulus'],
];
$title = 'Daftar Mahasiswa';
$warna = ['aktif' => 'success', 'cuti' => 'warning', 'lulus' => 'secondary'];

include __DIR__ . '/../partials/header.php';
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="h3 mb-0">Daftar Mahasiswa</h1>
    <a href="tambah.php" class="btn btn-primary">Tambah Mahasiswa</a>
</div>

<form method="GET" class="row g-2 mb-3">
    <div class="col-12 col-md-6 col-lg-4">
        <input type="text" name="search" class="form-control" placeholder="Cari NIM atau nama..."
               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
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
                    <th>Program Studi</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($mahasiswaList)): ?>
                <?php foreach ($mahasiswaList as $i => $m): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($m['nim']) ?></td>
                        <td><?= htmlspecialchars($m['nama']) ?></td>
                        <td><?= htmlspecialchars($m['prodi']) ?></td>
                        <td>
                            <span class="badge bg-<?= $warna[$m['status']] ?? 'secondary' ?>">
                                <?= htmlspecialchars(ucfirst($m['status'])) ?>
                            </span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada data mahasiswa.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>