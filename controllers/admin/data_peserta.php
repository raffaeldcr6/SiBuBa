<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';

$queryBalita = mysqli_query($koneksi, "
    SELECT 
        anak.*,
        users.nama AS nama_orang_tua
    FROM anak
    LEFT JOIN users ON anak.user_id = users.id
    ORDER BY anak.id DESC
");



$queryIbu = mysqli_query($koneksi, "
    SELECT * FROM users
    WHERE role='user'
    ORDER BY nama ASC
");

$dataIbu = [];

while ($ibu = mysqli_fetch_assoc($queryIbu)) {
    $dataIbu[] = $ibu;
}

include 'views/admin/data_peserta.php';

?>