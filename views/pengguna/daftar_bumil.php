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
    <title>Daftar Booking Ibu Hamil</title>

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
                <h1>Daftar Booking Ibu Hamil</h1>
                <p>Konfirmasi pendaftaran jadwal posyandu untuk pemeriksaan ibu hamil.</p>
            </div>

        </div>

        <form method="POST" class="booking-card">

            <div class="grid-anak">

                <label class="kartu-anak">

                    <input
                    type="radio"
                    name="bumil_id"
                    value="<?= (int)$dataUser['id']; ?>"
                    checked
                    required>

                    <div class="avatar-anak">
                        <?= strtoupper(substr($dataUser['nama'], 0, 2)); ?>
                    </div>

                    <div>
                        <h3><?= htmlspecialchars($dataUser['nama']); ?></h3>
                        <p>Ibu Hamil</p>
                    </div>

                </label>

            </div>

            <div class="history-info">

                <div class="history-item">
                    <span class="history-label">Nama Kegiatan</span>
                    <span class="history-value">
                        <?= htmlspecialchars($dataJadwal['nama_kegiatan']); ?>
                    </span>
                </div>

                <div class="history-item">
                    <span class="history-label">Tanggal</span>
                    <span class="history-value">
                        <?= date('d M Y', strtotime($dataJadwal['tanggal'])); ?>
                    </span>
                </div>

                <div class="history-item">
                    <span class="history-label">Jam</span>
                    <span class="history-value">
                        <?= substr($dataJadwal['jam_mulai'], 0, 5); ?>
                        -
                        <?= substr($dataJadwal['jam_selesai'], 0, 5); ?>
                    </span>
                </div>

                <div class="history-item">
                    <span class="history-label">Lokasi</span>
                    <span class="history-value">
                        <?= htmlspecialchars($dataJadwal['lokasi']); ?>
                    </span>
                </div>

            </div>

            <div class="booking-submit">
                <button type="submit" name="daftar" class="btn-primary">
                    Daftar Booking
                </button>
            </div>

        </form>

    </main>

</div>

</body>
</html>