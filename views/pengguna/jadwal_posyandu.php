<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiBuba - Jadwal Posyandu</title>
    <link rel="stylesheet" href="css/jadwal_posyandu.css">
    <link rel="stylesheet" href="css/sidebar_navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="overlay" id="overlay"></div>

<div class="jadwal-wrapper">

    <?php include 'views/components/sidebar_navbar.php'; ?>

    <section class="konten-utama">

        <div class="header-jadwal">
            <div>
                <h1>Jadwal Posyandu</h1>
                <p>Pantau jadwal kegiatan posyandu di wilayah Anda.</p>
            </div>
        </div>

        <div class="layout-jadwal">

            <?php if (empty($dataJadwal)): ?>

                <div style="background:white;border-radius:16px;border:1px solid #c8e6ea;padding:48px 24px;text-align:center;color:#94a3b8;">
                    <i class="fa-regular fa-calendar-xmark" style="font-size:2rem;display:block;margin-bottom:12px;"></i>
                    <p style="font-size:14px;">Belum ada jadwal posyandu yang tersedia.</p>
                </div>

            <?php else: ?>

                <?php foreach ($dataJadwal as $row): ?>

                    <div class="kartu">

                        <div class="badge badge-teal">
                            <i class="fa-regular fa-calendar"></i>
                            JADWAL
                        </div>

                        <h3 class="kartu-judul">
                            <?= htmlspecialchars($row['nama_kegiatan']); ?>
                        </h3>

                        <ul class="detail-jadwal">

                            <li>
                                <i class="fa-regular fa-calendar"></i>
                                <?= date('d F Y', strtotime($row['tanggal'])); ?>
                            </li>

                            <li>
                                <i class="fa-solid fa-location-dot"></i>
                                <?= htmlspecialchars($row['lokasi']); ?>
                            </li>

                            <li>
                                <i class="fa-regular fa-clock"></i>
                                <?= substr($row['jam_mulai'], 0, 5); ?> - <?= substr($row['jam_selesai'], 0, 5); ?> WIB
                            </li>

                            <?php if (!empty($row['nama_kader'])): ?>
                            <li>
                                <i class="fa-solid fa-user-nurse"></i>
                                Kader: <?= htmlspecialchars($row['nama_kader']); ?>
                            </li>
                            <?php endif; ?>

                            <?php if (!empty($row['keterangan'])): ?>
                            <li>
                                <i class="fa-regular fa-note-sticky"></i>
                                <?= htmlspecialchars($row['keterangan']); ?>
                            </li>
                            <?php endif; ?>

                        </ul>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </section>

</div>

<script src="js/script.js"></script>

</body>
</html>