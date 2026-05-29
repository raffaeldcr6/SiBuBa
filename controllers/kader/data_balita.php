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
        "DELETE FROM anak
        WHERE id='$hapus_id'"
    );

    echo "
    <script>
        alert('Data balita berhasil dihapus!');
        window.location='index.php?page=data_balita';
    </script>
    ";
    exit;
}

$cari = trim($_GET['cari'] ?? '');

$where = "";

if ($cari != '') {

    $cariEsc = mysqli_real_escape_string($koneksi, $cari);

    $where = "
    WHERE
    a.nama_anak LIKE '%$cariEsc%'
    OR a.nik_anak LIKE '%$cariEsc%'
    OR u.nama LIKE '%$cariEsc%'
    ";
}

$queryBalita = mysqli_query(
    $koneksi,
    "SELECT
        a.*,
        u.nama AS nama_ibu,
        TIMESTAMPDIFF(YEAR, a.tanggal_lahir, CURDATE()) AS umur_tahun,
        TIMESTAMPDIFF(MONTH, a.tanggal_lahir, CURDATE()) AS umur_bulan
    FROM anak a
    LEFT JOIN users u ON a.user_id = u.id
    $where
    ORDER BY a.id DESC"
);

$dataJadwal = [];

while ($row = mysqli_fetch_assoc($queryBalita)) {
    $dataJadwal[] = $row;
}

$totalItem = count($dataJadwal);

$giziBaikCount = 0;

foreach ($dataJadwal as $anak) {

    $statusGizi = strtolower(trim($anak['status_gizi'] ?? ''));

    if ($statusGizi == 'baik') {
        $giziBaikCount++;
    }
}

$totalBalita = $totalItem;

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
    $dataJadwal,
    $offset,
    $perHalaman
);

include 'views/kader/data_balita.php';

?>
