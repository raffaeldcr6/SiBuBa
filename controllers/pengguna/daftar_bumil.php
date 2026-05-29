<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'user') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/jadwalmodel.php';

$jadwalModel = new JadwalModel($koneksi);

$user_id = isset($_SESSION['user']['id'])
    ? (int)$_SESSION['user']['id']
    : (int)$_SESSION['user_id'];

$jadwal_id = isset($_GET['jadwal_id'])
    ? (int)$_GET['jadwal_id']
    : 0;

$queryUser = mysqli_query(
    $koneksi,
    "SELECT *
    FROM users
    WHERE id='$user_id'
    AND role='user'"
);

$dataUser = mysqli_fetch_assoc($queryUser);

if (!$dataUser) {
    header("Location: index.php?page=login");
    exit;
}

if ($dataUser['status_hamil'] != 'ya') {
    echo "
    <script>
        alert('Anda belum terdaftar sebagai ibu hamil di profil.');
        window.location='index.php?page=profile';
    </script>
    ";
    exit;
}

$dataJadwal = $jadwalModel->getJadwalById($jadwal_id);

if (!$dataJadwal || !in_array($dataJadwal['kategori'], ['bumil', 'semua'])) {
    echo "
    <script>
        alert('Jadwal ibu hamil tidak ditemukan.');
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

if (isset($_POST['daftar'])) {

    $cekBooking = mysqli_query(
        $koneksi,
        "SELECT *
        FROM booking_posyandu
        WHERE user_id='$user_id'
        AND jadwal_id='$jadwal_id'
        AND anak_id IS NULL"
    );

    if (mysqli_num_rows($cekBooking) > 0) {
        echo "
        <script>
            alert('Anda sudah mendaftar pada jadwal ini.');
            window.location='index.php?page=jadwal_posyandu';
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

    mysqli_query(
        $koneksi,
        "INSERT INTO booking_posyandu
        (
            user_id,
            anak_id,
            jadwal_id,
            status
        )
        VALUES
        (
            '$user_id',
            NULL,
            '$jadwal_id',
            'terdaftar'
        )"
    );

    echo "
    <script>
        alert('Booking ibu hamil berhasil dilakukan!');
        window.location='index.php?page=histori_booking';
    </script>
    ";
    exit;
}

include 'views/pengguna/daftar_bumil.php';

?>