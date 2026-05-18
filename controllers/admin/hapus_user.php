<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (
    !isset($_SESSION['login']) ||
    (
        $_SESSION['user']['role'] != 'admin' &&
        $_SESSION['user']['role'] != 'kader'
    )
) {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/usermodel.php';

$userModel = new UserModel($koneksi);

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if ($id != $_SESSION['user']['id']) {

        $userModel->hapusUser($id);

    }

}

header("Location: index.php?page=dashboard_admin");
exit;

?>
