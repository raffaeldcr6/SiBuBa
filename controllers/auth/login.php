<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';
include 'models/usermodel.php';

$userModel = new UserModel($koneksi);

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $userModel->login($email, $password);

    if ($user) {

        $_SESSION['user'] = $user;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['login'] = true;

        if ($user['role'] == 'admin') {
            header("Location: index.php?page=dashboard_admin");
        } elseif ($user['role'] == 'kader') {
            header("Location: index.php?page=dashboard_kader");
        } else {
            header("Location: index.php?page=dashboard_pengguna");
        }

        exit;

    } else {

        echo "
        <script>
            alert('Email atau password salah!');
            window.location='index.php?page=login';
        </script>
        ";
        exit;
    }
}

include 'views/auth/login_pengguna.php';
?>
