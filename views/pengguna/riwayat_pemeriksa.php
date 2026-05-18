<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

include 'koneksi.php';

$dummyRiwayat = [
    [
        "id"          => 1,
        "nama_anak"   => "Rafael Ramadhani",
        "tanggal"     => "2024-11-01",
        "berat"       => 7.8,
        "tinggi"      => 68.5,
        "catatan"     => "Tumbuh kembang normal, imunisasi DPT ke-2 selesai."
    ],
    [
        "id"          => 2,
        "nama_anak"   => "Rafael Ramadhani",
        "tanggal"     => "2024-10-05",
        "berat"       => 7.5,
        "tinggi"      => 67.0,
        "catatan"     => "Pemeriksaan rutin bulanan, kondisi baik."
    ],
    [
        "id"          => 3,
        "nama_anak"   => "Rafael Ramadhani",
        "tanggal"     => "2024-09-02",
        "berat"       => 7.1,
        "tinggi"      => 65.5,
        "catatan"     => "Kelas MPASI diikuti, nafsu makan meningkat."
    ],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI BUBA - Riwayat Pemeriksaan</title>
    <link rel="stylesheet" href="css/sidebar_navbar.css">
    <link rel="stylesheet" href="css/riwayat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="overlay" id="overlay"></div>

<div class="riwayat-wrapper">

    <?php include 'views/components/sidebar_navbar.php'; ?>

    <section class="konten-utama">

        <div class="header-riwayat">
            <h1>Riwayat Pemeriksaan</h1>
            <p>Pantau perkembangan kesehatan si kecil dari waktu ke waktu.</p>
        </div>

        <div class="panel-riwayat">

            <div class="baris-cari-filter">
                <div class="grup-cari">
                    <label>Cari Nama atau Catatan</label>
                    <div class="kotak-cari">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="inputCari" placeholder="Ketik nama anak atau catatan...">
                    </div>
                </div>
            </div>

            <table class="tabel-riwayat" id="tabelRiwayat">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Anak</th>
                        <th>Berat</th>
                        <th>Tinggi</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dummyRiwayat as $row):
                        $inisial = strtoupper(implode('', array_map(fn($w) => $w[0], explode(' ', $row['nama_anak']))));
                        $warna   = ($row['nama_anak'] === 'Rafael Ramadhani') ? 'teal' : 'salmon';
                        $tanggal = date('d M Y', strtotime($row['tanggal']));
                    ?>
                    <tr>
                        <td class="td-tanggal"><?= $tanggal ?></td>
                        <td>
                            <div class="sel-nama-anak">
                                <div class="avatar-anak <?= $warna ?>"><?= $inisial ?></div>
                                <span class="nama-anak-teks"><?= htmlspecialchars($row['nama_anak']) ?></span>
                            </div>
                        </td>
                        <td><span class="badge-berat"><?= $row['berat'] ?> kg</span></td>
                        <td><span class="badge-tinggi"><?= $row['tinggi'] ?> cm</span></td>
                        <td class="td-catatan"><?= htmlspecialchars($row['catatan']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="baris-bawah-tabel">
                <span class="info-menampilkan">Menampilkan <?= count($dummyRiwayat) ?> data</span>
            </div>

        </div>

    </section>

</div>

<script src="js/script.js"></script>

</body>
</html>