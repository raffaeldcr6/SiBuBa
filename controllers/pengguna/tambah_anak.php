<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/anakmodel.php';

$anakModel = new AnakModel($koneksi);

include 'views/pengguna/tambah_anak.php';