<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'kader') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';

$queryBalita = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
    FROM anak"
);
$dataBalita = mysqli_fetch_assoc($queryBalita);
$totalBalita = $dataBalita['total'] ?? 0;

$queryBumil = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
    FROM users
    WHERE role='user'
    AND status_hamil='ya'"
);
$dataBumil = mysqli_fetch_assoc($queryBumil);
$totalBumil = $dataBumil['total'] ?? 0;

$queryGiziBaik = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
    FROM anak
    WHERE status_gizi='Baik'"
);
$dataGiziBaik = mysqli_fetch_assoc($queryGiziBaik);
$giziBaik = $dataGiziBaik['total'] ?? 0;

$giziBuruk = $totalBalita - $giziBaik;

$pctGiziBaik = $totalBalita > 0
    ? round(($giziBaik / $totalBalita) * 100)
    : 0;

$pctGiziBuruk = $totalBalita > 0
    ? 100 - $pctGiziBaik
    : 0;

$queryBumilSehat = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
    FROM users
    WHERE role='user'
    AND status_hamil='ya'
    AND status_kesehatan='Sehat'"
);
$dataBumilSehat = mysqli_fetch_assoc($queryBumilSehat);
$bumilSehat = $dataBumilSehat['total'] ?? 0;

$bumilPerlu = $totalBumil - $bumilSehat;

$pctBumilSehat = $totalBumil > 0
    ? round(($bumilSehat / $totalBumil) * 100)
    : 0;

$pctBumilPerlu = $totalBumil > 0
    ? 100 - $pctBumilSehat
    : 0;

$queryPemeriksaanBalita = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
    FROM anak
    WHERE hasil_pemeriksaan IS NOT NULL
    AND hasil_pemeriksaan != ''"
);
$dataPemeriksaanBalita = mysqli_fetch_assoc($queryPemeriksaanBalita);
$totalPemeriksaanBalita = $dataPemeriksaanBalita['total'] ?? 0;

$queryPemeriksaanBumil = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
    FROM users
    WHERE hasil_pemeriksaan IS NOT NULL
    AND hasil_pemeriksaan != ''
    AND status_hamil='ya'"
);
$dataPemeriksaanBumil = mysqli_fetch_assoc($queryPemeriksaanBumil);
$totalPemeriksaanBumil = $dataPemeriksaanBumil['total'] ?? 0;

$periksaHariIni = $totalPemeriksaanBalita + $totalPemeriksaanBumil;

$queryJadwal = mysqli_query(
    $koneksi,
    "SELECT *
    FROM jadwal_posyandu
    WHERE tanggal >= CURDATE()
    ORDER BY tanggal ASC, jam_mulai ASC
    LIMIT 3"
);

$jadwalMendatang = [];

while ($row = mysqli_fetch_assoc($queryJadwal)) {
    $jadwalMendatang[] = [
        'tgl'   => date('d', strtotime($row['tanggal'])),
        'bln'   => strtoupper(date('M', strtotime($row['tanggal']))),
        'judul' => $row['nama_kegiatan'],
        'waktu' => substr($row['jam_mulai'], 0, 5) . ' - ' . substr($row['jam_selesai'], 0, 5) . ' WIB'
    ];
}

include 'views/kader/dashboard_kader.php';

?>