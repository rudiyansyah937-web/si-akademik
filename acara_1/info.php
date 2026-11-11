<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Server & Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Workshop SI Web Server</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 35%;">Informasi</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Nama Anda</strong></td>
                                    <td>Rudiyansyah Mahendra Nur Rohman</td>
                                </tr>
                                <tr>
                                    <td><strong>NIM</strong></td>
                                    <td>E41250942</td>
                                </tr>
                                <tr>
                                    <td><strong>Waktu Server</strong></td>
                                    <td><?php echo date('Y-m-d H:i:s') . ''; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Versi PHP</strong></td>
                                    <td><?php echo phpversion(); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Sistem Operasi Server</strong></td>
                                    <td><?php echo PHP_OS; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Politeknik Negeri Jember - PSDKU Nganjuk</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>