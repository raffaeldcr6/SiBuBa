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
    <title>SiBuba - Jadwal Posyandu</title>

    <link rel="stylesheet" href="css/sidebar_admin.css">
    <link rel="stylesheet" href="css/jadwal_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<div class="admin-wrapper">

    <?php include 'views/components/sidebar_admin.php'; ?>

    <main class="admin-main">

        <header class="topbar">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <form method="GET" action="index.php" style="display:flex;flex:1;">
                    <input type="hidden" name="page" value="jadwal_admin">
                    <input
                        type="text"
                        name="cari"
                        id="cariJadwal"
                        placeholder="Cari nama kegiatan, lokasi, atau kader..."
                        value="<?= htmlspecialchars($cari); ?>"
                        autocomplete="off"
                    >
                </form>
            </div>

            <div class="admin-profile">
                <div>
                    <strong><?= htmlspecialchars($_SESSION['user']['nama']); ?></strong>
                    <p>Administrator</p>
                </div>
                <div class="avatar">
                    <?= strtoupper(substr($_SESSION['user']['nama'], 0, 1)); ?>
                </div>
            </div>
        </header>

        <section class="content">

            <div class="title-row">
                <div>
                    <h1>Jadwal Posyandu</h1>
                    <p>Pantau seluruh jadwal kegiatan posyandu yang dibuat oleh kader.</p>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="summary-grid">

                <div class="summary-card">
                    <div class="summary-ikon si-teal">
                        <i class="fa-regular fa-calendar"></i>
                    </div>
                    <div>
                        <div class="summary-val"><?= $totalItem; ?></div>
                        <div class="summary-label">Total Jadwal</div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-ikon si-hijau">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                    <div>
                        <div class="summary-val"><?= $totalMendatang; ?></div>
                        <div class="summary-label">Jadwal Mendatang</div>
                    </div>
                </div>

            </div>

            <!-- Tabel Jadwal -->
            <div class="table-card">

                <table>
                    <thead>
                        <tr>
                            <th style="width:4%">#</th>
                            <th style="width:28%">Nama Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Lokasi</th>
                            <th>Kader</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (empty($dataHalaman)): ?>
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fa-regular fa-calendar-xmark"></i>
                                    <p>
                                        <?php if ($cari): ?>
                                            Tidak ada jadwal yang cocok dengan pencarian "<?= htmlspecialchars($cari); ?>".
                                        <?php else: ?>
                                            Belum ada jadwal posyandu yang dibuat oleh kader.
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php
                        $nomor = $offset + 1;
                        foreach ($dataHalaman as $jadwal):
                            $sudahLewat = $jadwal['tanggal'] < date('Y-m-d');
                            $hariIni    = $jadwal['tanggal'] === date('Y-m-d');
                        ?>
                        <tr>
                            <td class="td-nomor"><?= $nomor++; ?></td>

                            <td>
                                <div class="nama-kegiatan"><?= htmlspecialchars($jadwal['nama_kegiatan']); ?></div>
                                <?php if (!empty($jadwal['keterangan'])): ?>
                                    <div class="ket-kegiatan"><?= htmlspecialchars(mb_substr($jadwal['keterangan'], 0, 60)) . (mb_strlen($jadwal['keterangan']) > 60 ? '...' : ''); ?></div>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="tgl-wrap">
                                    <i class="fa-regular fa-calendar"></i>
                                    <?= date('d M Y', strtotime($jadwal['tanggal'])); ?>
                                </div>
                            </td>

                            <td>
                                <div class="jam-wrap">
                                    <i class="fa-regular fa-clock"></i>
                                    <?= substr($jadwal['jam_mulai'], 0, 5); ?> – <?= substr($jadwal['jam_selesai'], 0, 5); ?>
                                </div>
                            </td>

                            <td>
                                <div class="lokasi-wrap">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <?= htmlspecialchars($jadwal['lokasi']); ?>
                                </div>
                            </td>

                            <td>
                                <div class="kader-wrap">
                                    <div class="kader-avatar">
                                        <?= strtoupper(substr($jadwal['nama_kader'] ?? 'K', 0, 1)); ?>
                                    </div>
                                    <?= htmlspecialchars($jadwal['nama_kader'] ?? '-'); ?>
                                </div>
                            </td>

                            <td>
                                <?php if ($hariIni): ?>
                                    <span class="badge-status badge-hari-ini">Hari Ini</span>
                                <?php elseif ($sudahLewat): ?>
                                    <span class="badge-status badge-lewat">Selesai</span>
                                <?php else: ?>
                                    <span class="badge-status badge-mendatang">Mendatang</span>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    </tbody>
                </table>

                <!-- Footer tabel -->
                <div class="table-footer">
                    <p>Menampilkan <?= count($dataHalaman); ?> dari <?= $totalItem; ?> jadwal</p>

                    <div class="pagination">

                        <?php if ($halamanNow > 1): ?>
                            <a href="index.php?page=jadwal_admin&hal=<?= $halamanNow - 1; ?>&cari=<?= urlencode($cari); ?>">
                                <i class="fa-solid fa-chevron-left" style="font-size:11px;"></i>
                            </a>
                        <?php else: ?>
                            <span class="disabled">
                                <i class="fa-solid fa-chevron-left" style="font-size:11px;"></i>
                            </span>
                        <?php endif; ?>

                        <?php
                        $mulai = max(1, $halamanNow - 1);
                        $akhir = min($totalHalaman, $mulai + 2);
                        for ($p = $mulai; $p <= $akhir; $p++):
                        ?>
                            <a
                                href="index.php?page=jadwal_admin&hal=<?= $p; ?>&cari=<?= urlencode($cari); ?>"
                                class="<?= $p === $halamanNow ? 'aktif' : ''; ?>"
                            >
                                <?= $p; ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($halamanNow < $totalHalaman): ?>
                            <a href="index.php?page=jadwal_admin&hal=<?= $halamanNow + 1; ?>&cari=<?= urlencode($cari); ?>">
                                <i class="fa-solid fa-chevron-right" style="font-size:11px;"></i>
                            </a>
                        <?php else: ?>
                            <span class="disabled">
                                <i class="fa-solid fa-chevron-right" style="font-size:11px;"></i>
                            </span>
                        <?php endif; ?>

                    </div>
                </div>

            </div>

        </section>

    </main>

</div>

<script>
(function () {
    var input = document.getElementById('cariJadwal');
    if (!input) return;
    var timer;
    input.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(function () {
            input.closest('form').submit();
        }, 400);
    });
})();
</script>

<script src="js/script.js"></script>

</body>
</html>