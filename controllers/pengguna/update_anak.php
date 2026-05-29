<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';
include 'models/anakmodel.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

$id = $_POST['id'];
$user_id = $_SESSION['user']['id'];

$anakModel = new AnakModel($koneksi);

$cekNik = $anakModel->cekNikAnakUpdate($_POST['nik_anak'], $id);

if ($cekNik > 0) {

    echo "
        <script>
            alert('NIK Anak sudah digunakan!');
            window.history.back();
        </script>
    ";

    exit;
}

$dataFoto = $anakModel->getFotoAnak($id);

$foto = $dataFoto['foto'];

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {

    $namaFile = $_FILES['foto']['name'];
    $tmpFile = $_FILES['foto']['tmp_name'];

    $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    $namaBaru = uniqid() . '.' . $ext;

    $folderUpload = "uploads/";

    move_uploaded_file($tmpFile, $folderUpload . $namaBaru);

    if (!empty($foto) && file_exists($folderUpload . $foto)) {
        unlink($folderUpload . $foto);
    }

    $foto = $namaBaru;
}

$update = $anakModel->updateAnak(
    $id,
    $user_id,
    $_POST,
    $foto
);

if ($update) {

    header("Location: index.php?page=data_kesehatan");
    exit;

} else {

    echo "
        <script>
            alert('Gagal mengupdate data anak!');
            window.history.back();
        </script>
    ";
}