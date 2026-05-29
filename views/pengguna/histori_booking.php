<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Booking</title>

    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="booking-wrapper">

    <main class="konten-utama">

        <div class="header">
            <a href="index.php?page=jadwal_posyandu" class="tombol-kembali">
                Kembali
            </a>
            <div class="header-info">
                <h1>Histori Booking</h1>
                <p>Riwayat pendaftaran posyandu yang sudah dilakukan.</p>
            </div>

        </div>

        <section class="history-list">

            <?php if (mysqli_num_rows($queryBooking) > 0): ?>

                <?php while ($booking = mysqli_fetch_assoc($queryBooking)): ?>

                    <article class="history-card">

                        <div class="history-top">
                            <span class="badge-status">
                                <?= htmlspecialchars($booking['status']); ?>
                            </span>

                            <span class="history-date">
                                <?= date('d M Y', strtotime($booking['tanggal'])); ?>
                            </span>
                        </div>

                        <h3 class="history-title">
                            <?= htmlspecialchars($booking['nama_kegiatan']); ?>
                        </h3>

                        <p class="anak-booking">
                            Anak:
                            <strong><?= htmlspecialchars($booking['nama_anak']); ?></strong>
                        </p>

                        <div class="history-info">

                            <div class="history-item">
                                <span class="history-label">Jam</span>
                                <span class="history-value">
                                    <?= substr($booking['jam_mulai'], 0, 5); ?>
                                    -
                                    <?= substr($booking['jam_selesai'], 0, 5); ?>
                                </span>
                            </div>

                            <div class="history-item">
                                <span class="history-label">Lokasi</span>
                                <span class="history-value">
                                    <?= htmlspecialchars($booking['lokasi']); ?>
                                </span>
                            </div>

                        </div>

                    </article>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="empty-state">
                    <p>Belum ada histori booking.</p>

                    <a href="index.php?page=jadwal_posyandu">
                        Lihat Jadwal Posyandu
                    </a>
                </div>

            <?php endif; ?>

        </section>

    </main>

</div>

</body>
</html>