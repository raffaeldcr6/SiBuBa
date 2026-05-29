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

$user_id = $_SESSION['user']['id'];

$anakModel = new AnakModel($koneksi);

$queryAnak = $anakModel->getDataAnakLengkap($user_id);

include 'views/pengguna/data_kesehatan.php';

?>