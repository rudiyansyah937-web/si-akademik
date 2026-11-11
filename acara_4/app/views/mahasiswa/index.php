<h1 class="h3 mb-4">Daftar Mahasiswa</h1>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-dark">
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
                        <td><span class="badge bg-info text-dark"><?= $mhs->getAngkatan() ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>