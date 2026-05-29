<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/anakmodel.php';

$id   = isset($_POST['id'])   ? (int)$_POST['id']   : 0;
$tipe = isset($_POST['tipe']) ? $_POST['tipe']       : '';

if (!$id || !in_array($tipe, ['anak', 'ibu'])) {
    echo "<script>alert('Parameter tidak valid!'); window.history.back();</script>";
    exit;
}

// ===== UPDATE BALITA =====
if ($tipe === 'anak') {

    $anakModel = new AnakModel($koneksi);

    $cekNik = $anakModel->cekNikAnakUpdate($_POST['nik_anak'], $id);
    if ($cekNik > 0) {
        echo "<script>alert('NIK Anak sudah digunakan oleh data lain!'); window.history.back();</script>";
        exit;
    }

    $dataFoto = $anakModel->getFotoAnak($id);
    $foto = $dataFoto['foto'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $ext      = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $namaBaru = uniqid() . '.' . $ext;
        $folder   = "assets/uploads/";
        move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $namaBaru);
        if (!empty($foto) && file_exists($folder . $foto)) unlink($folder . $foto);
        $foto = $namaBaru;
    }

    $nik_anak       = mysqli_real_escape_string($koneksi, $_POST['nik_anak']);
    $nama_anak      = mysqli_real_escape_string($koneksi, $_POST['nama_anak']);
    $tanggal_lahir  = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $jenis_kelamin  = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $berat_badan    = mysqli_real_escape_string($koneksi, $_POST['berat_badan']);
    $tinggi_badan   = mysqli_real_escape_string($koneksi, $_POST['tinggi_badan']);
    $golongan_darah = mysqli_real_escape_string($koneksi, $_POST['golongan_darah'] ?? '');
    $catatan        = mysqli_real_escape_string($koneksi, $_POST['catatan'] ?? '');
    $foto_esc       = mysqli_real_escape_string($koneksi, $foto);

    $result = mysqli_query($koneksi, "
        UPDATE anak SET
            nik_anak='$nik_anak', foto='$foto_esc', nama_anak='$nama_anak',
            tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin',
            berat_badan='$berat_badan', tinggi_badan='$tinggi_badan',
            golongan_darah='$golongan_darah', catatan='$catatan'
        WHERE id='$id'
    ");

    if ($result) {
        header("Location: index.php?page=data_peserta");
    } else {
        echo "<script>alert('Gagal mengupdate data balita!'); window.history.back();</script>";
    }

// ===== UPDATE IBU HAMIL =====
} else {

    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $nik    = mysqli_real_escape_string($koneksi, $_POST['nik'] ?? '');
    $email  = mysqli_real_escape_string($koneksi, $_POST['email']);
    $nohp   = mysqli_real_escape_string($koneksi, $_POST['nohp'] ?? '');
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat'] ?? '');

    $cekEmail = mysqli_query($koneksi, "SELECT id FROM users WHERE email='$email' AND id != '$id'");
    if (mysqli_num_rows($cekEmail) > 0) {
        echo "<script>alert('Email sudah digunakan oleh pengguna lain!'); window.history.back();</script>";
        exit;
    }

    $result = mysqli_query($koneksi, "
        UPDATE users SET
            nama='$nama', nik='$nik', email='$email',
            nohp='$nohp', alamat='$alamat'
        WHERE id='$id' AND role='user'
    ");

    if ($result) {
        header("Location: index.php?page=data_peserta");
    } else {
        echo "<script>alert('Gagal mengupdate data ibu!'); window.history.back();</script>";
    }
}