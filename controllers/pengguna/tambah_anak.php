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
$user_id = $_SESSION['user_id'];

if (isset($_POST['simpan'])) {

    $foto = '';

    if (!empty($_FILES['foto']['name'])) {
        $foto = time() . '_' . $_FILES['foto']['name'];

        move_uploaded_file(
            $_FILES['foto']['tmp_name'],
            'assets/uploads/' . $foto
        );
    }

    $simpan = $anakModel->tambahAnak(
        $user_id,
        $_POST,
        $foto
    );

    if ($simpan) {
        echo "
        <script>
            alert('Data anak berhasil ditambahkan!');
            window.location='index.php?page=data_kesehatan';
        </script>
        ";
        exit;
    }
}

include 'views/pengguna/tambah_anak.php';

?>