<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || !isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/usermodel.php';

$userModel = new UserModel($koneksi);

$user_id = $_SESSION['user_id'];

$dataUser = $userModel->getUserById($user_id);

if (isset($_POST['simpan'])) {

    $foto = $dataUser['foto'];

    if (!empty($_FILES['foto']['name'])) {

        $foto = time() . '_' . $_FILES['foto']['name'];

        move_uploaded_file(
            $_FILES['foto']['tmp_name'],
            'assets/uploads/' . $foto
        );
    }

    $update = $userModel->updateProfil(
        $user_id,
        $_POST,
        $foto
    );

    if ($update) {

        $dataUser = $userModel->getUserById($user_id);

        $_SESSION['user'] = $dataUser;
        $_SESSION['user_id'] = $dataUser['id'];
        $_SESSION['nama'] = $dataUser['nama'];
        $_SESSION['role'] = $dataUser['role'];

        echo "
        <script>
            alert('Profil berhasil diperbarui!');
            window.location='index.php?page=profile';
        </script>
        ";
        exit;
    }
}

include 'views/pengguna/profile.php';

?>