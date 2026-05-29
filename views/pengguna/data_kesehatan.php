<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiBuba - Data Kesehatan</title>

    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="kesehatan-wrapper">

    <?php include 'views/components/sidebar_pengguna.php'; ?>

    <main class="konten-utama">

        <article class="banner">
            <div class="banner-teks">
                <h2>Pantau Tumbuh Kembang Buah Hati</h2>
                <p>Pastikan setiap milestone pertumbuhan tercatat dengan akurat untuk masa depan yang lebih cerah.</p>
            </div>

            <div class="banner-gambar">
                <img src="assets/images/bumil.png" alt="Ibu dan Anak">
            </div>
        </article>

        <section class="grid-anak">

            <?php if(mysqli_num_rows($queryAnak) > 0): ?>

                <?php while($anak = mysqli_fetch_assoc($queryAnak)): ?>

                    <?php
                        if ($anak['umur_tahun'] > 0) {
                            $umur = $anak['umur_tahun'] . " Tahun";
                        } else {
                            $umur = $anak['umur_bulan'] . " Bulan";
                        }
                    ?>

                    <article class="kartu-anak">

                        <header class="kartu-header">

                            <?php if(!empty($anak['foto'])): ?>

                                <img 
                                src="assets/uploads/<?= $anak['foto']; ?>" 
                                alt="<?= $anak['nama_anak']; ?>"
                                class="foto-anak">

                            <?php else: ?>

                                <div class="avatar-anak">
                                    <?= strtoupper(substr($anak['nama_anak'], 0, 2)); ?>
                                </div>

                            <?php endif; ?>

                            <div>
                                <h3 class="nama-anak">
                                    <?= $anak['nama_anak']; ?>
                                </h3>

                                <span class="usia-anak">

                                    <img
                                    src="assets/icons/child.svg"
                                    class="icon-detail">

                                    <?= $umur; ?>

                                </span>
                            </div>

                        </header>

                        <div class="kartu-stats">

                            <div class="stat-item">
                                <span class="stat-label">JENIS KELAMIN</span>

                                <span class="stat-nilai">
                                    <?= $anak['jenis_kelamin']; ?>
                                </span>
                            </div>

                            <div class="stat-item">
                                <span class="stat-label">GOL. DARAH</span>

                                <span class="stat-nilai">
                                    <?= $anak['golongan_darah'] ?: '-'; ?>
                                </span>
                            </div>

                        </div>

                        <div class="kartu-aksi">

                            <a href="index.php?page=edit_anak&id=<?= $anak['id']; ?>" class="tombol-detail">
                                Detail
                            </a>

                        </div>

                    </article>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="kartu-anak kosong">
                    <p>Belum ada data anak</p>
                </div>

            <?php endif; ?>

            <a href="index.php?page=tambah_anak" class="kartu-tambah">

            <div class="tombol-tambah-ikon">

                <img
                src="assets/icons/plus.svg"
                class="icon-tambah">

            </div>

                <p class="tambah-judul">
                    Tambah Data Anak
                </p>

                <p class="tambah-sub">
                    Lengkapi profil kesehatan keluarga
                </p>

            </a>

        </section>

    </main>

</div>

<script src="js/script.js"></script>

</body>
</html>
