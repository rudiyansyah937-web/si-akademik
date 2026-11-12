<?php
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json; charset=utf-8');

function respond(int $status, bool $success, string $message, $data = []): never
{
    http_response_code($status);
    echo json_encode(
        ['success' => $success, 'message' => $message, 'data' => $data],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
    );
    exit;
}

function formatRow(array $row): array
{
    $row['id'] = (int)$row['id'];
    return $row;
}

try {
    $pdo    = getConnection();
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if (!ctype_digit((string)$id) || (int)$id < 1) {
                respond(400, false, 'Parameter id harus berupa angka positif.');
            }

            $stmt = $pdo->prepare('SELECT id, nim, nama, email FROM mahasiswa WHERE id = :id');
            $stmt->execute([':id' => (int)$id]);
            $row = $stmt->fetch();

            if (!$row) {
                respond(404, false, 'Data mahasiswa tidak ditemukan.');
            }
            respond(200, true, 'Data berhasil diambil', formatRow($row));
        }

        $stmt = $pdo->prepare('SELECT id, nim, nama, email FROM mahasiswa ORDER BY id');
        $stmt->execute();
        $rows = array_map('formatRow', $stmt->fetchAll());

        respond(200, true, 'Data berhasil diambil', $rows);
    }

    if ($method === 'POST') {

        $input = json_decode(file_get_contents('php://input'), true);

        if (!is_array($input)) {
            respond(400, false, 'Body request harus berupa JSON yang valid.');
        }

        $nim   = trim((string)($input['nim'] ?? ''));
        $nama  = trim((string)($input['nama'] ?? ''));
        $email = trim((string)($input['email'] ?? ''));

        if ($nim === '') {
            respond(422, false, 'NIM tidak boleh kosong.');
        }
        if (!ctype_digit($nim) || strlen($nim) > 20) {
            respond(422, false, 'NIM harus berupa angka (maksimal 20 digit).');
        }
        if ($nama === '' || mb_strlen($nama) > 100) {
            respond(422, false, 'Nama wajib diisi (maksimal 100 karakter).');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 100) {
            respond(422, false, 'Format email tidak valid.');
        }

        $cek = $pdo->prepare('SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim');
        $cek->execute([':nim' => $nim]);
        if ((int)$cek->fetchColumn() > 0) {
            respond(409, false, 'NIM sudah terdaftar.');
        }

        $stmt = $pdo->prepare(
            'INSERT INTO mahasiswa (nim, nama, email) VALUES (:nim, :nama, :email)'
        );
        $stmt->execute([':nim' => $nim, ':nama' => $nama, ':email' => $email]);

        respond(201, true, 'Data berhasil ditambahkan', [
            'id'    => (int)$pdo->lastInsertId(),
            'nim'   => $nim,
            'nama'  => $nama,
            'email' => $email,
        ]);
    }

    header('Allow: GET, POST');
    respond(405, false, 'Method tidak diizinkan. Gunakan GET atau POST.');

} catch (PDOException $e) {
    error_log('[API Mahasiswa] ' . $e->getMessage());
    respond(500, false, 'Terjadi kesalahan pada server.');
}