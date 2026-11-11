<h1 class="mb-4">Data Mata Kuliah</h1>

<div class="mb-3">
    <a href="/setoran/acara_9/public/matkul/create" class="btn btn-primary">Tambah Mata Kuliah</a>
</div>

<?php $adaKode = !empty($matkul) && isset($matkul[0]['kode_matkul']); ?>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <?php if ($adaKode): ?><th>Kode</th><?php endif; ?>
            <th>Nama Mata Kuliah</th>
            <th>Prodi</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($matkul)): ?>
            <?php foreach ($matkul as $index => $row): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <?php if ($adaKode): ?>
                        <td><?= htmlspecialchars($row['kode_matkul'] ?? ''); ?></td>
                    <?php endif; ?>
                    <td><?= htmlspecialchars($row['nama_matkul']); ?></td>
                    <td><?= htmlspecialchars($row['nama_prodi'] ?? $row['prodi_id'] ?? '-'); ?></td>
                    <td class="text-center">
                        <a href="/setoran/acara_9/public/matkul/edit?id=<?= (int)$row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>

                        <form action="/setoran/acara_9/public/matkul/delete" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            <input type="hidden" name="id" value="<?= (int)$row['id']; ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="<?= $adaKode ? 5 : 4; ?>" class="text-center text-muted">Belum ada data mata kuliah.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>