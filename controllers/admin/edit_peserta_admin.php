<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/anakmodel.php';

$id   = isset($_GET['id'])   ? (int)$_GET['id']   : 0;
$tipe = isset($_GET['tipe']) ? $_GET['tipe']       : '';

if (!$id || !in_array($tipe, ['anak', 'ibu'])) {
    echo "<script>alert('Parameter tidak valid!'); window.location='index.php?page=data_peserta';</script>";
    exit;
}

if ($tipe === 'anak') {
    $anakModel = new AnakModel($koneksi);
    $data = $anakModel->getAnakByIdKader($id);
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id' AND role='user'");
    $data  = mysqli_fetch_assoc($query);
}

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php?page=data_peserta';</script>";
    exit;
}

include 'views/admin/edit_peserta_admin.php';