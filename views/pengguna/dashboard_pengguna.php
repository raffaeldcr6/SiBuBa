<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {

    header("Location: index.php?page=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiBuba - Dashboard</title>

    <link rel="stylesheet" href="css/dashboard_pengguna.css">
    <link rel="stylesheet" href="css/sidebar_pengguna.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="dashboard-wrapper">

    <?php include 'views/components/sidebar_pengguna.php'; ?>

    <section class="konten-utama">

        <div class="header-dashboard">

            <div>
                <h1>Halo, <?= $_SESSION['user']['nama']; ?>!</h1>
                <p>Selamat datang di SiBuba, pantau kesehatan ibu dan anak dengan mudah.</p>
            </div>

            <div class="profil-pengguna">

                <div class="avatar-inisial">
                    <?= strtoupper(substr($_SESSION['user']['nama'], 0, 2)); ?>
                </div>

                <div>
                    <p class="nama-pengguna"><?= $_SESSION['user']['nama']; ?></p>
                    <p class="status-pengguna">Aktif</p>
                </div>

            </div>

        </div>

        <div class="grid-statistik">

            <div class="kartu">

                <div class="kartu-atas">
                    <i class="fa-solid fa-child ikon-teal"></i>
                    <span class="badge badge-teal">DATA</span>
                </div>

                <p class="kartu-judul">Jumlah Anak</p>

                <p class="kartu-nilai">
                    <?= $totalAnak; ?> <span>Anak</span>
                </p>

            </div>

            <div class="kartu">

                <div class="kartu-atas">
                    <i class="fa-regular fa-calendar ikon-oranye"></i>
                    <span class="badge badge-oranye">JADWAL</span>
                </div>

                <p class="kartu-judul">Jadwal Terdekat</p>
                <p class="kartu-nilai-teks">Belum ada jadwal</p>

            </div>

            <div class="kartu">

                <div class="kartu-atas">
                    <i class="fa-solid fa-heart ikon-hijau"></i>
                    <span class="badge badge-hijau">SEHAT</span>
                </div>

                <p class="kartu-judul">Status Kesehatan</p>
                <p class="kartu-nilai-teks">Belum ada data</p>

            </div>

        </div>

        <div class="grid-bawah">

            <div class="kartu kartu-tips">

                <h3>Tips Hari Ini</h3>

                <p>
                    Pastikan anak mendapatkan nutrisi seimbang seperti protein, vitamin, dan ASI/MPASI sesuai usia.
                </p>

            </div>

            <div class="kartu">

                <h3 class="kartu-judul">Aktivitas Terbaru</h3>

                <ul class="daftar-aktivitas">
                    <li>
                        <span class="titik merah"></span>
                        Belum ada aktivitas
                    </li>
                </ul>

            </div>

            <div class="kartu">

                <h3 class="kartu-judul">Anak Saya</h3>

                <?php if ($totalAnak > 0): ?>

                    <?php while ($anak = mysqli_fetch_assoc($queryAnak)): ?>

                        <div class="item-anak">

                            <?php if (!empty($anak['foto'])): ?>

                                <img 
                                    src="uploads/<?= $anak['foto']; ?>" 
                                    class="foto-anak"
                                >

                            <?php else: ?>

                                <div class="avatar-anak teal">
                                    <?= strtoupper(substr($anak['nama_anak'], 0, 2)); ?>
                                </div>

                            <?php endif; ?>

                            <div>

                                <p class="nama-anak">
                                    <?= $anak['nama_anak']; ?>
                                </p>

                                <p class="usia-anak">
                                    <?= $anak['jenis_kelamin']; ?>
                                </p>

                            </div>

                        </div>

                    <?php endwhile; ?>

                <?php else: ?>

                    <p class="belum-anak">
                        Belum ada data anak
                    </p>

                <?php endif; ?>

            </div>

        </div>

    </section>

</div>

<script src="js/script.js"></script>

</body>
</html>