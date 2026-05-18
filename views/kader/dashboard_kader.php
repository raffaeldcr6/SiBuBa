<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'kader') {
    header("Location: index.php?page=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiBuba - Dashboard Kader</title>

    <link rel="stylesheet" href="css/sidebar_kader.css">
    <link rel="stylesheet" href="css/dashboard_kader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<div class="kader-wrapper">

    <?php
    $halamanAktif = 'dashboard_kader';
    include 'views/components/sidebar_kader.php';
    ?>

    <main class="kader-main">

        <header class="topbar">
            <span class="topbar-title">Dashboard</span>
            <div class="topbar-right">
                <div class="topbar-notif">
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div class="topbar-user">
                    Halo, <?= htmlspecialchars($_SESSION['user']['nama']); ?>!
                    <div class="avatar">
                        <?= strtoupper(substr($_SESSION['user']['nama'], 0, 1)); ?>
                    </div>
                </div>
            </div>
        </header>

        <section class="content">

            <p class="breadcrumb">Dashboard / <b>Kader</b></p>

            <div class="title-row">
                <h1>Dashboard Kader</h1>
                <p>Pantau data balita, ibu hamil, dan kegiatan posyandu di wilayah Anda.</p>
            </div>

            <div class="stat-grid">

                <div class="stat-card">
                    <span class="stat-badge">+12%</span>
                    <div class="stat-ikon">
                        <i class="fa-solid fa-face-smile"></i>
                    </div>
                    <p class="stat-label">Total Balita</p>
                    <div class="stat-nilai"><?= (int)$totalBalita; ?></div>
                </div>

                <div class="stat-card">
                    <div class="stat-ikon" style="background:#fff7ed;color:#ea580c;">
                        <i class="fa-solid fa-person-pregnant"></i>
                    </div>
                    <p class="stat-label">Total Ibu Hamil</p>
                    <div class="stat-nilai"><?= (int)$totalBumil; ?></div>
                </div>

                <div class="stat-card">
                    <div class="stat-ikon" style="background:#f0fdf4;color:#16a34a;">
                        <i class="fa-solid fa-briefcase-medical"></i>
                    </div>
                    <p class="stat-label">Pemeriksaan Hari Ini</p>
                    <div class="stat-nilai"><?= (int)$periksaHariIni; ?></div>
                </div>

                <div class="stat-card teal-solid">
                    <div class="stat-ikon">
                        <i class="fa-regular fa-calendar"></i>
                    </div>
                    <p class="stat-label">Hari Ini</p>
                    <div class="stat-nilai"><?= date('D, d M'); ?></div>
                    <div class="stat-sub">Jadwal Posyandu Melati</div>
                </div>

            </div>

            <div class="grid-tengah">

                <div class="kartu">
                    <div class="kartu-judul">Status Gizi Balita</div>
                    <?php $pctGizi = $totalBalita > 0 ? round($giziBaik / $totalBalita * 100) : 0; ?>
                    <div class="progress-row">
                        <span class="progress-label">Gizi Baik</span>
                        <span class="progress-val"><?= (int)$giziBaik; ?> Anak</span>
                    </div>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar-fill" style="width:<?= $pctGizi; ?>%"></div>
                    </div>
                </div>

                <div class="kartu">
                    <div class="kartu-judul">Cakupan Imunisasi</div>
                    <div class="progress-row">
                        <span class="progress-label">Lengkap</span>
                        <span class="progress-val"><?= (int)$imunisasiLengkap; ?>%</span>
                    </div>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar-fill" style="width:<?= (int)$imunisasiLengkap; ?>%"></div>
                    </div>
                    <div class="progress-row">
                        <span class="progress-label">Belum Lengkap</span>
                        <span class="progress-val"><?= (int)$imunisasiBelum; ?>%</span>
                    </div>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar-fill abu" style="width:<?= (int)$imunisasiBelum; ?>%"></div>
                    </div>
                </div>

                <div class="kartu">
                    <div class="jadwal-header">
                        <span class="jadwal-header-judul">Jadwal Mendatang</span>
                        <a href="index.php?page=jadwal_kegiatan">Lihat Semua</a>
                    </div>
                    <?php foreach ($jadwalMendatang as $j): ?>
                    <div class="jadwal-item">
                        <div class="jadwal-tgl">
                            <div class="jadwal-tgl-angka"><?= htmlspecialchars($j['tgl']); ?></div>
                            <div class="jadwal-tgl-bln"><?= htmlspecialchars($j['bln']); ?></div>
                        </div>
                        <div>
                            <div class="jadwal-info-judul"><?= htmlspecialchars($j['judul']); ?></div>
                            <div class="jadwal-info-waktu"><?= htmlspecialchars($j['waktu']); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <div class="tips-banner">
                <div class="tips-label">Tips Kesehatan Hari Ini</div>
                <div class="tips-judul"><?= htmlspecialchars($tips['judul']); ?></div>
                <div class="tips-isi"><?= htmlspecialchars($tips['isi']); ?></div>
                <a href="#" class="tips-btn">
                    Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </section>

    </main>

</div>

<script src="js/script.js"></script>

</body>
</html>