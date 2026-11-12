<h1 class="mb-4">Data Program Studi</h1>

<div class="mb-3">
    <a href="/setoran/acara_13/public/prodi/create" class="btn btn-primary">Tambah Program Studi</a>
</div>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Program Studi</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($prodi)): ?>
            <?php foreach ($prodi as $index => $row): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($row['nama_prodi']); ?></td>
                    <td class="text-center">
                        <a href="/setoran/acara_13/public/prodi/edit?id=<?= (int)$row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>

                        <form action="/setoran/acara_13/public/prodi/delete" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            <input type="hidden" name="id" value="<?= (int)$row['id']; ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center text-muted">Belum ada data program studi.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>