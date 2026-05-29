<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'kader') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/anakmodel.php';

$anakModel = new AnakModel($koneksi);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$queryAnak = mysqli_query(
    $koneksi,
    "SELECT a.*, u.nama AS nama_ibu
    FROM anak a
    LEFT JOIN users u ON a.user_id = u.id
    WHERE a.id='$id'"
);

$dataAnak = mysqli_fetch_assoc($queryAnak);

if (!$dataAnak) {
    echo "
    <script>
        alert('Data balita tidak ditemukan!');
        window.location='index.php?page=data_balita';
    </script>
    ";
    exit;
}

if (isset($_POST['simpan'])) {

    $simpan = $anakModel->updatePemeriksaanBalita(
        $id,
        $_POST['hasil_pemeriksaan'],
        $_POST['status_gizi'],
        $_POST['status_imunisasi'],
        $_POST['keterangan_imunisasi'] ?? ''
    );

    if ($simpan) {
        echo "
        <script>
            alert('Hasil pemeriksaan berhasil disimpan!');
            window.location='index.php?page=data_balita';
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

include 'views/kader/pemeriksaan_balita.php';

?>