<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    header("Location: index.php?page=login");
    exit;
}

if ($_SESSION['user']['role'] == 'admin') {
    header("Location: index.php?page=dashboard_admin");
    exit;
}

if ($_SESSION['user']['role'] == 'kader') {
    header("Location: index.php?page=dashboard_kader");
    exit;
}

include 'koneksi.php';
include 'models/anakmodel.php';

$anakModel = new AnakModel($koneksi);

$userId = (int)$_SESSION['user']['id'];

$totalAnak = $anakModel->getJumlahAnak($userId);
$queryAnak = $anakModel->getDataAnak($userId);

$queryJadwalTerdekat = mysqli_query(
    $koneksi,
    "SELECT jp.*
    FROM booking b
    LEFT JOIN anak a ON a.id = b.anak_id
    INNER JOIN jadwal_posyandu jp ON jp.id = b.jadwal_id
    WHERE b.user_id = '$userId'
    AND jp.tanggal >= CURDATE()
    ORDER BY jp.tanggal ASC, jp.jam_mulai ASC
    LIMIT 1"
);

$jadwalTerdekat = mysqli_fetch_assoc($queryJadwalTerdekat);

$queryStatusAnak = mysqli_query(
    $koneksi,
    "SELECT
        nama_anak AS nama,
        'Balita' AS kategori,
        status_gizi AS status,
        hasil_pemeriksaan AS catatan
    FROM anak
    WHERE user_id = '$userId'
    AND hasil_pemeriksaan IS NOT NULL
    AND hasil_pemeriksaan != ''
    ORDER BY id DESC
    LIMIT 1"
);

$statusAnak = mysqli_fetch_assoc($queryStatusAnak);

$queryStatusBumil = mysqli_query(
    $koneksi,
    "SELECT
        nama AS nama,
        'Ibu Hamil' AS kategori,
        status_kesehatan AS status,
        hasil_pemeriksaan AS catatan
    FROM users
    WHERE id = '$userId'
    AND status_hamil = 'ya'
    AND hasil_pemeriksaan IS NOT NULL
    AND hasil_pemeriksaan != ''
    LIMIT 1"
);

$statusBumil = mysqli_fetch_assoc($queryStatusBumil);

$statusKesehatan = $statusAnak ?: $statusBumil;

$queryAktivitas = mysqli_query(
    $koneksi,
    "SELECT
        b.id,
        b.status,
        jp.nama_kegiatan,
        jp.tanggal,
        jp.jam_mulai,
        jp.lokasi
    FROM booking b
    INNER JOIN jadwal_posyandu jp ON jp.id = b.jadwal_id
    WHERE b.user_id = '$userId'
    ORDER BY b.id DESC
    LIMIT 5"
);

include 'views/pengguna/dashboard_pengguna.php';

?>
