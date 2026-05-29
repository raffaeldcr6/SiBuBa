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
    <title>Daftar Booking Posyandu</title>

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
                <h1>Daftar Booking Posyandu</h1>
                <p>Pilih anak yang akan didaftarkan ke posyandu.</p>
            </div>

        </div>

        <form method="POST" class="booking-card">

            <?php if (mysqli_num_rows($queryAnak) > 0): ?>

                <div class="grid-anak">

                    <?php while ($anak = mysqli_fetch_assoc($queryAnak)): ?>

                        <label class="kartu-anak">

                            <input
                            type="radio"
                            name="anak_id"
                            value="<?= $anak['id']; ?>"
                            required>

                            <div class="avatar-anak">
                                <?= strtoupper(substr($anak['nama_anak'], 0, 2)); ?>
                            </div>

                            <div>
                                <h3><?= htmlspecialchars($anak['nama_anak']); ?></h3>
                                <p><?= htmlspecialchars($anak['jenis_kelamin']); ?></p>
                            </div>

                        </label>

                    <?php endwhile; ?>

                </div>

                <div class="booking-submit">
                    <button type="submit" name="daftar" class="btn-primary">
                        Daftar Booking
                    </button>
                </div>

            <?php else: ?>

                <div class="empty-state">
                    <p>Belum ada data anak. Tambahkan data anak terlebih dahulu.</p>

                    <a href="index.php?page=tambah_anak">
                        Tambah Anak
                    </a>
                </div>

            <?php endif; ?>

        </form>

    </main>

</div>

</body>
</html>