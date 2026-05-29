<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || !isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';
include 'models/bookingmodel.php';

$user_id = $_SESSION['user_id'];

$bookingModel = new BookingModel($koneksi);
$queryBooking = $bookingModel->getHistoriBooking($user_id);

include 'views/pengguna/histori_booking.php';
?>