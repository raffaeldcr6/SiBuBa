<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || !isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/anakmodel.php';
include 'models/bookingmodel.php';
include 'models/jadwalmodel.php';

$user_id = isset($_SESSION['user']['id'])
    ? (int)$_SESSION['user']['id']
    : (int)$_SESSION['user_id'];

$jadwal_id = isset($_GET['jadwal_id'])
    ? (int)$_GET['jadwal_id']
    : 0;

if ($jadwal_id == 0) {
    header("Location: index.php?page=jadwal_posyandu");
    exit;
}

$anakModel = new AnakModel($koneksi);
$bookingModel = new BookingModel($koneksi);
$jadwalModel = new JadwalModel($koneksi);

$dataJadwal = $jadwalModel->getJadwalById($jadwal_id);

if (!$dataJadwal) {
    echo "
    <script>
        alert('Jadwal tidak ditemukan!');
        window.location='index.php?page=jadwal_posyandu';
    </script>
    ";
    exit;
}

if (!in_array($dataJadwal['kategori'], ['balita', 'semua'])) {
    echo "
    <script>
        alert('Jadwal ini bukan untuk balita.');
        window.location='index.php?page=jadwal_posyandu';
    </script>
    ";
    exit;
}

if (strtotime($dataJadwal['tanggal']) < strtotime(date('Y-m-d'))) {
    echo "
    <script>
        alert('Pendaftaran sudah ditutup karena jadwal sudah selesai!');
        window.location='index.php?page=jadwal_posyandu';
    </script>
    ";
    exit;
}

$totalBooking = $jadwalModel->hitungBookingJadwal($jadwal_id);
$kapasitas = (int)($dataJadwal['kapasitas'] ?? 0);
$sisaKuota = $kapasitas > 0 ? $kapasitas - $totalBooking : null;

if ($kapasitas > 0 && $totalBooking >= $kapasitas) {
    echo "
    <script>
        alert('Maaf, kapasitas jadwal ini sudah penuh.');
        window.location='index.php?page=jadwal_posyandu';
    </script>
    ";
    exit;
}

$queryAnak = $anakModel->getDataAnak($user_id);

if (isset($_POST['daftar'])) {

    $anak_id = (int)$_POST['anak_id'];

    if ($bookingModel->cekBooking($user_id, $anak_id, $jadwal_id) > 0) {
        echo "
        <script>
            alert('Anak ini sudah terdaftar pada jadwal tersebut!');
            window.location='index.php?page=histori_booking';
        </script>
        ";
        exit;
    }

    $totalBookingTerbaru = $jadwalModel->hitungBookingJadwal($jadwal_id);

    if ($kapasitas > 0 && $totalBookingTerbaru >= $kapasitas) {
        echo "
        <script>
            alert('Maaf, kapasitas jadwal ini sudah penuh.');
            window.location='index.php?page=jadwal_posyandu';
        </script>
        ";
        exit;
    }

    $simpan = $bookingModel->tambahBooking($user_id, $anak_id, $jadwal_id);

    if ($simpan) {
        echo "
        <script>
            alert('Pendaftaran berhasil!');
            window.location='index.php?page=histori_booking';
        </script>
        ";
        exit;
    }
}

include 'views/pengguna/daftar_balita.php';

?>