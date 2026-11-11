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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswaList as $i => $mhs): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($mhs->getNim()) ?></td>
                        <td><?= htmlspecialchars($mhs->getNama()) ?></td>
                        <td><?= htmlspecialchars($mhs->getProdi()) ?></td>
                        <td><?= $mhs->getAngkatan() ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>