<?php

session_start();
include '../koneksi.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php?page=login");
    exit;
}

$id = $_GET['id'];
$user_id = $_SESSION['user']['id'];

$queryFoto = mysqli_query($koneksi, "
    SELECT foto FROM anak
    WHERE id='$id' AND user_id='$user_id'
");

$data = mysqli_fetch_assoc($queryFoto);

if ($data) {

    $foto = $data['foto'];
    $path = "../uploads/" . $foto;

    if (!empty($foto) && file_exists($path)) {
        unlink($path);
    }

    mysqli_query($koneksi, "
        DELETE FROM anak
        WHERE id='$id' AND user_id='$user_id'
    ");
}

header("Location: ../index.php?page=data_kesehatan");
exit;