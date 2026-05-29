<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';
include 'models/usermodel.php';

$userModel = new UserModel($koneksi);

if (isset($_POST['register'])) {

    $password = trim($_POST['password']);
$confirm  = trim($_POST['confirm']);

        if (strlen($password) < 6) {

            echo "
            <script>
                alert('Password minimal 6 karakter!');
                window.location='index.php?page=register';
            </script>
            ";
            exit;
        }

        if ($password != $confirm) {

            echo "
            <script>
                alert('Konfirmasi password tidak sama!');
                window.location='index.php?page=register';
            </script>
            ";
            exit;
        }

    $register = $userModel->register($_POST);

    if ($register) {

        echo "
        <script>
            alert('Registrasi berhasil!');
            window.location='index.php?page=login';
        </script>
        ";
        exit;

    } else {

        echo "
        <script>
            alert('Registrasi gagal!');
            window.location='index.php?page=register';
        </script>
        ";
        exit;
    }
}

include 'views/auth/registrasi_pengguna.php';
?>
