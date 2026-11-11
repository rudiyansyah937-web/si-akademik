<?php $warna = ['aktif' => 'success', 'cuti' => 'warning', 'lulus' => 'secondary']; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Data Mahasiswa</h2>
    <a href="#" class="btn btn-primary btn-sm">+ Tambah Mahasiswa</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-bordered table-striped mb-0">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Angkatan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($mahasiswaList)): ?>
                    <tr><td colspan="6" class="text-center text-muted">Belum ada data mahasiswa.</td></tr>
                <?php endif; ?>
                <?php foreach ($mahasiswaList as $i => $m): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($m['nim']) ?></td>
                        <td><?= htmlspecialchars($m['nama']) ?></td>
                        <td><?= htmlspecialchars($m['nama_prodi']) ?></td>
                        <td><?= '20' . htmlspecialchars(substr($m['nim'], 0, 2)) ?></td>
                        <td>
                            <span class="badge bg-<?= $warna[$m['status']] ?? 'secondary' ?>">
                                <?= htmlspecialchars(ucfirst($m['status'])) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>