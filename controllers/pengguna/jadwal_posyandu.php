<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'pengguna') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';


$resJadwal = mysqli_query($koneksi,
    "SELECT j.*, u.nama AS nama_kader
     FROM jadwal_posyandu j
     LEFT JOIN users u ON u.id = j.kader_id
     WHERE j.tanggal >= CURDATE()
     ORDER BY j.tanggal ASC, j.jam_mulai ASC"
);

$dataJadwal = [];
while ($row = mysqli_fetch_assoc($resJadwal)) {
    $dataJadwal[] = $row;
}

include 'views/pengguna/jadwal_posyandu.php';