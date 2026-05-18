<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';

$cari    = trim($_GET['cari'] ?? '');
$where   = '1=1';

if ($cari !== '') {
    $cariEsc = mysqli_real_escape_string($koneksi, $cari);
    $where  .= " AND (j.nama_kegiatan LIKE '%$cariEsc%' OR j.lokasi LIKE '%$cariEsc%' OR u.nama LIKE '%$cariEsc%')";
}

$resJadwal = mysqli_query($koneksi,
    "SELECT j.*, u.nama AS nama_kader
     FROM jadwal_posyandu j
     LEFT JOIN users u ON u.id = j.kader_id
     WHERE $where
     ORDER BY j.tanggal ASC, j.jam_mulai ASC"
);

$dataJadwal = [];
while ($row = mysqli_fetch_assoc($resJadwal)) {
    $dataJadwal[] = $row;
}

$totalItem    = count($dataJadwal);
$perHalaman   = 10;
$halamanNow   = max(1, (int)($_GET['hal'] ?? 1));
$totalHalaman = max(1, (int)ceil($totalItem / $perHalaman));
$halamanNow   = min($halamanNow, $totalHalaman);
$offset       = ($halamanNow - 1) * $perHalaman;
$dataHalaman  = array_slice($dataJadwal, $offset, $perHalaman);


$totalMendatang = 0;
foreach ($dataJadwal as $j) {
    if ($j['tanggal'] >= date('Y-m-d')) $totalMendatang++;
}

include 'views/admin/jadwal_admin.php';
