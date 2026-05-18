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

$id = $_GET['id'];
$user_id = $_SESSION['user']['id'];

$anakModel = new AnakModel($koneksi);

$data = $anakModel->getAnakById($id, $user_id);

if (!$data) {

    echo "
    <script>
        alert('Data tidak ditemukan!');
        window.location='index.php?page=data_kesehatan';
    </script>
    ";

    exit;
}

include 'views/pengguna/edit_anak.php';