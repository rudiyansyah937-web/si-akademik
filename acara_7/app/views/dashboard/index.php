<?php if (!empty($pesan)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($pesan) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Dashboard</h2>
    <a href="<?= BASE_URL ?>/logout" class="btn btn-outline-danger btn-sm">Logout</a>
</div>

<p>Anda login sebagai <strong><?= htmlspecialchars($_SESSION['user']) ?></strong>.</p>
<a href="<?= BASE_URL ?>/mahasiswa" class="btn btn-primary btn-sm">Lihat Mahasiswa</a>