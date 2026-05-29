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
    <title>SiBuba - Artikel Kesehatan</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="dashboard-wrapper">

    <?php include 'views/components/sidebar_pengguna.php'; ?>

    <section class="konten-utama">

        <div class="header-dashboard">
            <div>
                <h1>Artikel Kesehatan</h1>
                <p>Informasi dan tips seputar kesehatan ibu dan anak.</p>
            </div>
        </div>

        <div class="grid-artikel">

            <?php if (mysqli_num_rows($queryArtikel) > 0): ?>

                <?php while ($artikel = mysqli_fetch_assoc($queryArtikel)): ?>

                    <div class="kartu-artikel">

                        <?php if (!empty($artikel['foto'])): ?>

                            <img
                            src="assets/uploads/<?= $artikel['foto']; ?>"
                            class="foto-artikel"
                            alt="<?= $artikel['judul']; ?>">

                        <?php else: ?>

                            <div class="foto-artikel placeholder-artikel">
                                Artikel
                            </div>

                        <?php endif; ?>

                        <span class="tanggal-artikel">
                            <?= date('d M Y', strtotime($artikel['tanggal'])); ?>
                        </span>

                        <h3 class="judul-artikel">
                            <?= $artikel['judul']; ?>
                        </h3>

                        <p class="isi-singkat">
                            <?= substr($artikel['isi_artikel'], 0, 100); ?>...
                        </p>

                        <a href="index.php?page=detail_artikel&id=<?= $artikel['id']; ?>"
                        class="btn-baca-artikel">
                            Baca Selengkapnya
                        </a>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="artikel-kosong">
                    <p>Belum ada artikel yang tersedia saat ini.</p>
                </div>

            <?php endif; ?>

        </div>

    </section>

</div>

<script src="js/script.js"></script>

</body>
</html>