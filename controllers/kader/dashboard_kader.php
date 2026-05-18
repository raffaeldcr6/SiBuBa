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

$totalBalita    = $anakModel->getJumlahAnak($user_id);
$totalBumil     = 32;  
$periksaHariIni = 18;  

$querySemua = $anakModel->getDataAnak($user_id);
$giziBaik   = 0;

while ($row = mysqli_fetch_assoc($querySemua)) {
    $status = strtolower($row['status_gizi'] ?? '');
    if ($status == 'baik' || $status == 'sangat baik') {
        $giziBaik++;
    }
}

$imunisasiLengkap = 78; 
$imunisasiBelum   = 22;

$jadwalMendatang = [
    ['tgl' => '24', 'bln' => 'OKT', 'judul' => 'Posyandu Melati I', 'waktu' => '08:00 - 12:00 WIB'],
    ['tgl' => '26', 'bln' => 'OKT', 'judul' => 'Kunjungan Rumah',    'waktu' => 'Ananda Budi & Caca'],
];

$tips = [
    'judul' => 'Pentingnya ASI Eksklusif untuk 6 Bulan Pertama',
    'isi'   => 'ASI mengandung antibodi yang membantu bayi melawan virus dan bakteri.',
];

include 'views/kader/dashboard_kader.php';