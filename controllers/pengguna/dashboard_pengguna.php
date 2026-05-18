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

$user_id = $_SESSION['user']['id'];

$totalAnak = $anakModel->getJumlahAnak($user_id);
$queryAnak = $anakModel->getDataAnak($user_id);

include 'views/pengguna/dashboard_pengguna.php';

?>