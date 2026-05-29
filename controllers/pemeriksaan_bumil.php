<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'kader') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/usermodel.php';

$userModel = new UserModel($koneksi);

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$queryBumil = mysqli_query(
    $koneksi,
    "SELECT *
    FROM users
    WHERE id='$id'
    AND role='user'
    AND status_hamil='ya'"
);

$dataBumil = mysqli_fetch_assoc($queryBumil);

if (!$dataBumil) {
    echo "
    <script>
        alert('Data ibu hamil tidak ditemukan!');
        window.location='index.php?page=data_bumil';
    </script>
    ";
    exit;
}

if (isset($_POST['simpan'])) {

    $hasil_pemeriksaan = $_POST['hasil_pemeriksaan'];
    $status_kesehatan = $_POST['status_kesehatan'];

    $simpan = $userModel->updatePemeriksaanBumil(
        $id,
        $hasil_pemeriksaan,
        $status_kesehatan
    );

    if ($simpan) {
        echo "
        <script>
            alert('Hasil pemeriksaan ibu hamil berhasil disimpan!');
            window.location='index.php?page=data_bumil';
        </script>
        ";
        exit;
    } else {
        echo "
        <script>
            alert('Gagal menyimpan pemeriksaan, coba lagi!');
            history.back();
        </script>
        ";
        exit;
    }
}

include 'views/kader/pemeriksaan_bumil.php';

?>