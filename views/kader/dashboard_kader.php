<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SiBuba - Dashboard Kader</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
<body>

<div class="kader-wrapper">

    <?php
    $halamanAktif = 'dashboard_kader';
    include 'views/components/sidebar_kader.php';
    ?>

    <main class="kader-main">
        <section class="content">

            <div class="header">
                <div class="header-info">
                    <h1>Dashboard Kader</h1>
                    <p>Pantau data balita, ibu hamil, dan kegiatan posyandu di wilayah Anda.</p>
                </div>
            </div>

            <div class="stat-grid">

                <div class="stat-card">
                    <span class="stat-badge">DATA</span>
                    <p class="stat-label">Total Balita</p>
                    <div class="stat-nilai"><?= (int)$totalBalita; ?></div>
                </div>

                <div class="stat-card">
                    <span class="stat-badge orange">BUMIL</span>
                    <p class="stat-label">Total Ibu Hamil</p>
                    <div class="stat-nilai"><?= (int)$totalBumil; ?></div>
                </div>

                <div class="stat-card">
                    <span class="stat-badge green">CEK</span>
                    <p class="stat-label">Pemeriksaan Hari Ini</p>
                    <div class="stat-nilai"><?= (int)$periksaHariIni; ?></div>
                </div>

                <div class="stat-card">
                    <span class="stat-badge">JADWAL</span>
                    <p class="stat-label">Hari Ini</p>
                    <div class="stat-nilai"><?= date('D, d M'); ?></div>
                    <div class="stat-sub">Jadwal Posyandu Melati</div>
                </div>

            </div>

            <div class="grid-tengah">

                <div class="kartu">
                    <div class="kartu-judul">Status Gizi Balita</div>

                    <div class="progress-row">
                        <span class="progress-label">Gizi Baik</span>
                        <span class="progress-val"><?= (int)$giziBaik; ?> Anak</span>
                    </div>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar-fill" style="width:<?= $pctGiziBaik; ?>%"></div>
                    </div>

                    <div class="progress-row">
                        <span class="progress-label">Gizi Buruk</span>
                        <span class="progress-val"><?= (int)$giziBuruk; ?> Anak</span>
                    </div>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar-fill abu" style="width:<?= $pctGiziBuruk; ?>%"></div>
                    </div>
                </div>

                <div class="kartu">
                    <div class="kartu-judul">Status Ibu Hamil</div>

                    <div class="progress-row">
                        <span class="progress-label">Sehat</span>
                        <span class="progress-val"><?= (int)$bumilSehat; ?> Ibu</span>
                    </div>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar-fill" style="width:<?= $pctBumilSehat; ?>%"></div>
                    </div>

                    <div class="progress-row">
                        <span class="progress-label">Perlu Pemeriksaan</span>
                        <span class="progress-val"><?= (int)$bumilPerlu; ?> Ibu</span>
                    </div>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar-fill abu" style="width:<?= $pctBumilPerlu; ?>%"></div>
                    </div>
                </div>

                <div class="kartu">
                    <div class="jadwal-header">
                        <span class="jadwal-header-judul">Jadwal Mendatang</span>
                        <a href="index.php?page=jadwal_kader">Lihat Semua</a>
                    </div>

                    <?php if (!empty($jadwalMendatang)): ?>
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
                    <?php else: ?>
                        <p class="jadwal-kosong">Belum ada jadwal mendatang.</p>
                    <?php endif; ?>
                </div>

            </div>

        </section>
    </main>
</div>

<script src="js/script.js"></script>
</body>
</html>