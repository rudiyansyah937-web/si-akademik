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

function findById(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare('SELECT id, nim, nama, email FROM mahasiswa WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();

    return $row ? formatRow($row) : null;
}

function nimExists(PDO $pdo, string $nim, ?int $exceptId = null): bool
{
    if ($exceptId !== null) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim AND id <> :id');
        $stmt->execute([':nim' => $nim, ':id' => $exceptId]);
    } else {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim');
        $stmt->execute([':nim' => $nim]);
    }
    return (int)$stmt->fetchColumn() > 0;
}

function readJsonBody(): array
{
    $raw = file_get_contents('php://input');

    if (trim((string)$raw) === '') {
        respond(400, false, 'Body request kosong. Kirim data dalam format JSON.');
    }

    $input = json_decode($raw, true);
    if (!is_array($input)) {
        respond(400, false, 'Body request bukan JSON yang valid.');
    }
    return $input;
}

function validatePayload(array $input): array
{
    foreach (['nim', 'nama', 'email'] as $field) {
        if (!array_key_exists($field, $input)) {
            respond(422, false, 'Data JSON tidak lengkap. Field wajib: nim, nama, email.');
        }
        if (is_array($input[$field])) {
            respond(422, false, "Nilai field $field harus berupa teks.");
        }
    }

    $nim   = trim((string)$input['nim']);
    $nama  = trim((string)$input['nama']);
    $email = trim((string)$input['email']);

    if ($nim === '') {
        respond(422, false, 'NIM tidak boleh kosong.');
    }
    if (!ctype_digit($nim) || strlen($nim) > 20) {
        respond(422, false, 'NIM harus berupa angka (maksimal 20 digit).');
    }
    if ($nama === '' || mb_strlen($nama) > 100) {
        respond(422, false, 'Nama wajib diisi (maksimal 100 karakter).');
    }
    if ($email === '') {
        respond(422, false, 'Email tidak boleh kosong.');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 100) {
        respond(422, false, 'Format email tidak valid.');
    }

    return ['nim' => $nim, 'nama' => $nama, 'email' => $email];
}

function validId(string $raw): int
{
    if (!ctype_digit($raw) || (int)$raw < 1) {
        respond(400, false, 'ID harus berupa angka positif.');
    }
    return (int)$raw;
}


try {
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($base !== '' && str_starts_with($path, $base)) {
        $path = substr($path, strlen($base));
    }
    $path = '/' . trim($path, '/');

    if (!preg_match('#^/mahasiswa(?:/([^/]+))?$#', $path, $match)) {
        respond(404, false, 'Endpoint tidak ditemukan.');
    }

    $idParam = $match[1] ?? null;
    $method  = $_SERVER['REQUEST_METHOD'];
    $pdo     = getConnection();

    if ($idParam === null) {

        if ($method === 'GET') {
            $stmt = $pdo->prepare('SELECT id, nim, nama, email FROM mahasiswa ORDER BY id');
            $stmt->execute();
            respond(200, true, 'Data berhasil diambil', array_map('formatRow', $stmt->fetchAll()));
        }

        if ($method === 'POST') {
            $data = validatePayload(readJsonBody());

            if (nimExists($pdo, $data['nim'])) {
                respond(409, false, 'NIM sudah terdaftar.');
            }

            $stmt = $pdo->prepare(
                'INSERT INTO mahasiswa (nim, nama, email) VALUES (:nim, :nama, :email)'
            );
            $stmt->execute([
                ':nim'   => $data['nim'],
                ':nama'  => $data['nama'],
                ':email' => $data['email'],
            ]);
            $newId = (int)$pdo->lastInsertId();

            header('Location: ' . $base . '/mahasiswa/' . $newId);
            respond(201, true, 'Data berhasil ditambahkan', ['id' => $newId] + $data);
        }

        header('Allow: GET, POST');
        respond(405, false, 'Method tidak diizinkan. Gunakan GET atau POST.');
    }

    $id = validId($idParam);

    if ($method === 'GET') {
        $mhs = findById($pdo, $id);
        if ($mhs === null) {
            respond(404, false, 'Data mahasiswa tidak ditemukan.');
        }
        respond(200, true, 'Data berhasil diambil', $mhs);
    }

    if ($method === 'PUT') {
        if (findById($pdo, $id) === null) {
            respond(404, false, 'Data mahasiswa tidak ditemukan.');
        }

        $data = validatePayload(readJsonBody());

        if (nimExists($pdo, $data['nim'], $id)) {
            respond(409, false, 'NIM sudah terdaftar.');
        }

        $stmt = $pdo->prepare(
            'UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email WHERE id = :id'
        );
        $stmt->execute([
            ':nim'   => $data['nim'],
            ':nama'  => $data['nama'],
            ':email' => $data['email'],
            ':id'    => $id,
        ]);

        respond(200, true, 'Data berhasil diubah', ['id' => $id] + $data);
    }

    if ($method === 'DELETE') {
        if (findById($pdo, $id) === null) {
            respond(404, false, 'Data mahasiswa tidak ditemukan.');
        }

        $stmt = $pdo->prepare('DELETE FROM mahasiswa WHERE id = :id');
        $stmt->execute([':id' => $id]);

        respond(200, true, 'Data berhasil dihapus', ['id' => $id]);
    }

    header('Allow: GET, PUT, DELETE');
    respond(405, false, 'Method tidak diizinkan. Gunakan GET, PUT, atau DELETE.');

} catch (PDOException $e) {
    error_log('[API Mahasiswa] ' . $e->getMessage());
    respond(500, false, 'Terjadi kesalahan pada server.');
}