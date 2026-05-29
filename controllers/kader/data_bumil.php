<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'kader') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';

if (isset($_GET['hapus'])) {

    $hapus_id = (int) $_GET['hapus'];

    mysqli_query(
        $koneksi,
        "UPDATE users SET
            status_hamil='tidak',
            usia_kehamilan=''
        WHERE id='$hapus_id'"
    );

    echo "
    <script>
        alert('Data ibu hamil berhasil dihapus dari daftar bumil!');
        window.location='index.php?page=data_bumil';
    </script>
    ";
    exit;
}

$cari = trim($_GET['cari'] ?? '');

$where = "
WHERE role='user'
AND status_hamil='ya'
";

if ($cari != '') {

    $cariEsc = mysqli_real_escape_string($koneksi, $cari);

    $where .= "
    AND (
        nama LIKE '%$cariEsc%'
        OR nik LIKE '%$cariEsc%'
        OR nohp LIKE '%$cariEsc%'
        OR email LIKE '%$cariEsc%'
    )";
}

$queryBumil = mysqli_query(
    $koneksi,
    "SELECT *
    FROM users
    $where
    ORDER BY id DESC"
);

$dataBumil = [];

while ($row = mysqli_fetch_assoc($queryBumil)) {
    $dataBumil[] = $row;
}

$totalItem = count($dataBumil);

$bumilSehatCount = 0;

foreach ($dataBumil as $bumil) {
    if (strtolower($bumil['status_kesehatan'] ?? '') == 'sehat') {
        $bumilSehatCount++;
    }
}

$totalBumil = $totalItem;

$perHalaman = 10;

$halamanNow = max(
    1,
    (int)($_GET['hal'] ?? 1)
);

$totalHalaman = max(
    1,
    (int)ceil($totalItem / $perHalaman)
);

$halamanNow = min(
    $halamanNow,
    $totalHalaman
);

$offset = ($halamanNow - 1) * $perHalaman;

$dataHalaman = array_slice(
    $dataBumil,
    $offset,
    $perHalaman
);

include 'views/kader/data_bumil.php';

?>