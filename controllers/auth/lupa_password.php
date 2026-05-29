<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';
include 'models/usermodel.php';

$userModel = new UserModel($koneksi);

if (isset($_POST['reset'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password != $confirm) {
        echo "
        <script>
            alert('Konfirmasi password tidak sama!');
            window.location='index.php?page=lupa_password';
        </script>
        ";
        exit;
    }

    $user = $userModel->cekEmail($email);

    if (!$user) {
        echo "
        <script>
            alert('Email tidak ditemukan!');
            window.location='index.php?page=lupa_password';
        </script>
        ";
        exit;
    }

    $update = $userModel->ubahPassword($email, $password);

    if ($update) {
        echo "
        <script>
            alert('Password berhasil diganti! Silakan login.');
            window.location='index.php?page=login';
        </script>
        ";
        exit;
    }
}

include 'views/auth/lupa_password.php';
?>