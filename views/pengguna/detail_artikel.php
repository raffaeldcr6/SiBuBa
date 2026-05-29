<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiBuba - <?= $artikel['judul']; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body>

<div class="dashboard-wrapper">
    <?php include 'views/components/sidebar_pengguna.php'; ?>

    <section class="konten-utama">
        <a href="index.php?page=edukasi_kesehatan" class="btn-kembali">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Artikel
        </a>

        <div class="wadah-detail">
            <h1 class="judul-detail"><?= $artikel['judul']; ?></h1>
            <span class="tanggal-detail"><i class="fa-regular fa-calendar"></i> <?= date('d M Y', strtotime($artikel['tanggal'])); ?></span>
            
            <?php if (!empty($artikel['foto'])): ?>
                <img src="assets/uploads/<?= $artikel['foto']; ?>" class="foto-detail" alt="<?= $artikel['judul']; ?>">
            <?php endif; ?>
            
            <div class="isi-detail">
                <?= nl2br($artikel['isi_artikel']); ?>
            </div>
        </div>
    </section>
</div>

<script src="js/script.js"></script>
</body>
</html>