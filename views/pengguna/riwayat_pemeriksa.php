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
    <title>SiBuba - Riwayat Pemeriksaan</title>

    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="riwayat-wrapper">

    <?php include 'views/components/sidebar_pengguna.php'; ?>

    <main class="konten-utama">

        <div class="header">
            <div class="header-info">
                <h1>Riwayat Pemeriksaan</h1>
                <p>Lihat riwayat pemeriksaan balita dan ibu hamil.</p>
            </div>
        </div>

        <div class="filter-card">

            <a href="index.php?page=riwayat_pemeriksa"
            class="filter-link <?= $kategori == '' ? 'aktif' : ''; ?>">
                Semua
            </a>

            <a href="index.php?page=riwayat_pemeriksa&kategori=balita"
            class="filter-link <?= $kategori == 'balita' ? 'aktif' : ''; ?>">
                Balita
            </a>

            <a href="index.php?page=riwayat_pemeriksa&kategori=bumil"
            class="filter-link <?= $kategori == 'bumil' ? 'aktif' : ''; ?>">
                Ibu Hamil
            </a>

        </div>

        <div class="riwayat-list">

            <?php if (!empty($dataRiwayat)): ?>

                <?php foreach ($dataRiwayat as $row): ?>

                    <article class="riwayat-item">

                        <div class="riwayat-top">

                            <div class="nama-riwayat">
                                <div class="inisial-riwayat">
                                    <?= strtoupper(substr($row['nama'], 0, 2)); ?>
                                </div>

                                <div>
                                    <h3><?= htmlspecialchars($row['nama']); ?></h3>
                                    <p>
                                        <?= $row['kategori'] == 'balita' ? 'Balita' : 'Ibu Hamil'; ?>
                                    </p>
                                </div>
                            </div>

                            <span class="badge-riwayat <?= $row['kategori']; ?>">
                                <?= $row['kategori'] == 'balita' ? 'Balita' : 'Ibu Hamil'; ?>
                            </span>

                        </div>

                        <div class="riwayat-grid">

                            <div class="riwayat-box">
                                <span>Status</span>
                                <strong><?= htmlspecialchars($row['status'] ?: '-'); ?></strong>
                            </div>

                            <?php if ($row['kategori'] == 'balita'): ?>

                                <div class="riwayat-box">
                                    <span>Berat Badan</span>
                                    <strong><?= $row['berat_badan'] ? htmlspecialchars($row['berat_badan']) . ' kg' : '-'; ?></strong>
                                </div>

                                <div class="riwayat-box">
                                    <span>Tinggi Badan</span>
                                    <strong><?= $row['tinggi_badan'] ? htmlspecialchars($row['tinggi_badan']) . ' cm' : '-'; ?></strong>
                                </div>

                                <div class="riwayat-box">
                                    <span>Imunisasi</span>
                                    <strong>
                                        <?= ($row['status_imunisasi'] ?? 'belum') == 'sudah' ? 'Sudah' : 'Belum'; ?>
                                    </strong>
                                    <small><?= htmlspecialchars($row['keterangan_imunisasi'] ?: '-'); ?></small>
                                </div>

                            <?php else: ?>

                                <div class="riwayat-box">
                                    <span>Usia Kehamilan</span>
                                    <strong><?= htmlspecialchars($row['usia_kehamilan'] ?: '-'); ?></strong>
                                </div>

                            <?php endif; ?>

                        </div>

                        <div class="catatan-riwayat">
                            <span>Catatan Pemeriksaan</span>
                            <p><?= htmlspecialchars($row['hasil_pemeriksaan']); ?></p>
                        </div>

                    </article>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="riwayat-kosong">
                    <h3>Belum ada riwayat pemeriksaan</h3>
                    <p>Riwayat akan tampil setelah kader mengirim data pemeriksaan.</p>
                </div>

            <?php endif; ?>

        </div>

    </main>

</div>

<script src="js/script.js"></script>

</body>
</html>
