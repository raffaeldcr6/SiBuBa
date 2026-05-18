<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'kader') {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';

$kader_id   = (int)$_SESSION['user']['id'];
$pesan      = '';
$tipepesan  = '';


if (isset($_GET['hapus'])) {
    $hapus_id = (int)$_GET['hapus'];
    $cek = mysqli_query($koneksi,
        "SELECT id FROM jadwal_posyandu WHERE id = $hapus_id AND kader_id = $kader_id"
    );
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($koneksi, "DELETE FROM jadwal_posyandu WHERE id = $hapus_id");
        $pesan     = 'Jadwal berhasil dihapus.';
        $tipepesan = 'sukses';
    } else {
        $pesan     = 'Jadwal tidak ditemukan atau Anda tidak berhak menghapusnya.';
        $tipepesan = 'gagal';
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama_kegiatan = trim(mysqli_real_escape_string($koneksi, $_POST['nama_kegiatan'] ?? ''));
    $tanggal       = trim($_POST['tanggal']    ?? '');
    $jam_mulai     = trim($_POST['jam_mulai']  ?? '');
    $jam_selesai   = trim($_POST['jam_selesai'] ?? '');
    $lokasi        = trim(mysqli_real_escape_string($koneksi, $_POST['lokasi']       ?? ''));
    $keterangan    = trim(mysqli_real_escape_string($koneksi, $_POST['keterangan']   ?? ''));
    $edit_id       = (int)($_POST['edit_id'] ?? 0);

    if ($nama_kegiatan && $tanggal && $jam_mulai && $jam_selesai && $lokasi) {

        if ($edit_id > 0) {
           
            $cek = mysqli_query($koneksi,
                "SELECT id FROM jadwal_posyandu WHERE id = $edit_id AND kader_id = $kader_id"
            );
            if (mysqli_num_rows($cek) > 0) {
                mysqli_query($koneksi,
                    "UPDATE jadwal_posyandu SET
                        nama_kegiatan = '$nama_kegiatan',
                        tanggal       = '$tanggal',
                        jam_mulai     = '$jam_mulai',
                        jam_selesai   = '$jam_selesai',
                        lokasi        = '$lokasi',
                        keterangan    = '$keterangan'
                     WHERE id = $edit_id AND kader_id = $kader_id"
                );
                $pesan     = 'Jadwal berhasil diperbarui.';
                $tipepesan = 'sukses';
            } else {
                $pesan     = 'Data jadwal tidak ditemukan.';
                $tipepesan = 'gagal';
            }
        } else {
            
            mysqli_query($koneksi,
                "INSERT INTO jadwal_posyandu
                    (kader_id, nama_kegiatan, tanggal, jam_mulai, jam_selesai, lokasi, keterangan)
                 VALUES
                    ($kader_id, '$nama_kegiatan', '$tanggal', '$jam_mulai', '$jam_selesai', '$lokasi', '$keterangan')"
            );
            $pesan     = 'Jadwal berhasil ditambahkan.';
            $tipepesan = 'sukses';
        }
    } else {
        $pesan     = 'Harap lengkapi semua kolom yang wajib diisi.';
        $tipepesan = 'gagal';
    }
}


$dataEdit = null;
if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $res = mysqli_query($koneksi,
        "SELECT * FROM jadwal_posyandu WHERE id = $edit_id AND kader_id = $kader_id"
    );
    $dataEdit = mysqli_fetch_assoc($res);
}


$cari = trim($_GET['cari'] ?? '');

$where = "WHERE kader_id = $kader_id";
if ($cari !== '') {
    $cariEsc = mysqli_real_escape_string($koneksi, $cari);
    $where  .= " AND (nama_kegiatan LIKE '%$cariEsc%' OR lokasi LIKE '%$cariEsc%')";
}

$resJadwal   = mysqli_query($koneksi,
    "SELECT * FROM jadwal_posyandu $where ORDER BY tanggal ASC"
);
$dataJadwal  = [];
while ($row = mysqli_fetch_assoc($resJadwal)) {
    $dataJadwal[] = $row;
}

$totalItem    = count($dataJadwal);
$perHalaman   = 10;
$halamanNow   = max(1, (int)($_GET['hal'] ?? 1));
$totalHalaman = max(1, (int)ceil($totalItem / $perHalaman));
$halamanNow   = min($halamanNow, $totalHalaman);
$offset       = ($halamanNow - 1) * $perHalaman;
$dataHalaman  = array_slice($dataJadwal, $offset, $perHalaman);


$totalMendatang = 0;
foreach ($dataJadwal as $j) {
    if ($j['tanggal'] >= date('Y-m-d')) $totalMendatang++;
}

include 'views/kader/jadwal_kader.php';
