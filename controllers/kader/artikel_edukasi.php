<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'kader') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/artikelmodel.php';

$artikelModel = new ArtikelModel($koneksi);

$pesan = '';
$tipepesan = '';

if (isset($_GET['hapus'])) {

    $hapus_id = (int)$_GET['hapus'];

    $dataHapus = $artikelModel->getArtikelByIdArray($hapus_id);

    if ($dataHapus && !empty($dataHapus['foto'])) {
        $pathFoto = 'assets/uploads/' . $dataHapus['foto'];

        if (file_exists($pathFoto)) {
            unlink($pathFoto);
        }
    }

    $artikelModel->hapusArtikel($hapus_id);

    echo "
    <script>
        alert('Artikel berhasil dihapus!');
        window.location='index.php?page=artikel_edukasi';
    </script>
    ";
    exit;
}

$dataEdit = null;

if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $dataEdit = $artikelModel->getArtikelByIdArray($edit_id);
}

if (isset($_POST['simpan'])) {

    $foto = $dataEdit['foto'] ?? '';

    if (!empty($_FILES['foto']['name'])) {

        if (!empty($foto) && file_exists('assets/uploads/' . $foto)) {
            unlink('assets/uploads/' . $foto);
        }

        $foto = time() . '_' . $_FILES['foto']['name'];

        move_uploaded_file(
            $_FILES['foto']['tmp_name'],
            'assets/uploads/' . $foto
        );
    }

    if (!empty($_POST['edit_id'])) {

        $artikelModel->updateArtikel(
            $_POST['edit_id'],
            $_POST,
            $foto
        );

        echo "
        <script>
            alert('Artikel berhasil diperbarui!');
            window.location='index.php?page=artikel_edukasi';
        </script>
        ";
        exit;

    } else {

        $artikelModel->tambahArtikel(
            $_POST,
            $foto
        );

        echo "
        <script>
            alert('Artikel berhasil ditambahkan!');
            window.location='index.php?page=artikel_edukasi';
        </script>
        ";
        exit;
    }
}

$cari = $_GET['cari'] ?? '';

$queryArtikel = $artikelModel->getAllArtikel($cari);

$dataArtikel = [];

while ($row = mysqli_fetch_assoc($queryArtikel)) {
    $dataArtikel[] = $row;
}

$totalItem = count($dataArtikel);

include 'views/kader/artikel_edukasi.php';

?>