<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
   
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/usermodel.php';

$userModel = new UserModel($koneksi);

$queryUsers = $userModel->getAllUsers();

$totalUser = 0;
$totalUserAktif = 0;
$totalKader = 0;
$totalAdmin = 0;
$dataUsers = [];

while ($user = mysqli_fetch_assoc($queryUsers)) {

    $dataUsers[] = $user;
    $totalUser++;

    if ($user['role'] == 'user') {
        $totalUserAktif++;
    }

    if ($user['role'] == 'kader') {
        $totalKader++;
    }

    if ($user['role'] == 'admin') {
        $totalAdmin++;
    }
}

include 'views/admin/dashboard_admin.php';

?>