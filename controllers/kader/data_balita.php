<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'kader') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
require_once 'models/anakmodel.php';

$anakModel = new AnakModel($koneksi);

$user_id = $_SESSION['user']['id'];

if (isset($_GET['hapus'])) {
    include 'controllers/kader/hapus_anak.php';
    exit;
}

if (isset($_GET['edit'])) {
    include 'controllers/kader/edit_anak.php';
    exit;
}

$queryBalita = $anakModel->getDataAnakLengkap(null);

$dataBalita   = [];
$totalBalita  = 0;
$giziBaikCount = 0;

while ($row = mysqli_fetch_assoc($queryBalita)) {
    $dataBalita[] = $row;
    $totalBalita++;

    $status = strtolower($row['status_gizi'] ?? '');
    if ($status == 'baik' || $status == 'sangat baik') {
        $giziBaikCount++;
    }
}

$cari = trim($_GET['cari'] ?? '');

if ($cari !== '') {
    $dataBalita = array_filter($dataBalita, function ($row) use ($cari) {
        $cariLower = strtolower($cari);
        return str_contains(strtolower($row['nama_anak'] ?? ''), $cariLower)
            || str_contains($row['nik_anak'] ?? '', $cari);
    });
    $dataBalita = array_values($dataBalita);
}

$perHalaman  = 10;
$halamanNow  = max(1, (int)($_GET['hal'] ?? 1));
$totalItem   = count($dataBalita);
$totalHalaman = max(1, (int)ceil($totalItem / $perHalaman));
$halamanNow  = min($halamanNow, $totalHalaman);

$offset      = ($halamanNow - 1) * $perHalaman;
$dataHalaman = array_slice($dataBalita, $offset, $perHalaman);

include 'views/kader/data_balita.php';