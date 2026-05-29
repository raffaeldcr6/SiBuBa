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
        <title>SiBuba - Data Ibu Hamil</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
<body>
<div class="kader-wrapper">
    <?php
    $halamanAktif = 'data_bumil';
    include 'views/components/sidebar_kader.php';
    ?>

    <main class="kader-main">

        <section class="content">

            <div class="header">
                <div class="header-info">
                    <h1>Manajemen Ibu Hamil</h1>

                    <p>
                        Pantau data ibu hamil dan input hasil pemeriksaan kesehatan.
                    </p>
                </div>

            </div>

             <div class="summary-grid">

                <div class="summary-card">

                    <div>
                        <div class="summary-val">
                            <?= (int)$totalBumil; ?>
                        </div>

                        <div class="summary-label">
                            Total Ibu Hamil
                        </div>
                    </div>

                </div>

                <div class="summary-card">

                    <div>
                        <div class="summary-val">
                            <?= (int)$bumilSehatCount; ?>
                        </div>

                        <div class="summary-label">
                            Ibu Hamil Sehat
                        </div>
                    </div>

                </div>

            </div>

            <div class="aksi-bar">

                <form
                method="GET"
                action="index.php"
                class="form-cari">

                    <input
                    type="hidden"
                    name="page"
                    value="data_bumil">

                    <div class="cari-wrap">

                        <div class="cari-label">
                            Cari Data
                        </div>

                        <div class="cari-input-row">

                            <input
                            type="text"
                            name="cari"
                            class="cari-input"
                            placeholder="Masukkan nama ibu atau NIK..."
                            value="<?= htmlspecialchars($cari); ?>"
                            autocomplete="off"
                            id="inputCari">

                        </div>

                    </div>

                </form>

            </div>

            <div class="table-card data-balita">

                <table>

                    <thead>

                        <tr>
                            <th>Nama Ibu</th>
                            <th>NIK</th>
                            <th>No HP</th>
                            <th>Usia Kehamilan</th>
                            <th>Hasil Pemeriksaan</th>
                            <th>Status Kesehatan</th>
                            <th class="kolom-aksi">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php if (empty($dataHalaman)): ?>

                        <tr>
                            <td colspan="7">

                                <div class="empty-state">

                                    <p>
                                        <?php if ($cari): ?>
                                            Tidak ada data yang cocok dengan pencarian "<?= htmlspecialchars($cari); ?>".
                                        <?php else: ?>
                                            Belum ada data ibu hamil.
                                        <?php endif; ?>
                                    </p>

                                </div>

                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($dataHalaman as $bumil): ?>

                            <?php

                            $inisial = strtoupper(
                                substr(
                                    $bumil['nama'] ?? 'I',
                                    0,
                                    1
                                )
                            );

                            $status = $bumil['status_kesehatan'] ?? 'Perlu Pemeriksaan';

                            if (strtolower($status) == 'sehat') {
                                $dotKelas = 'dot-hijau';
                                $teksKelas = 'gizi-baik';
                            } else {
                                $dotKelas = 'dot-merah';
                                $teksKelas = 'gizi-buruk';
                            }

                            ?>

                            <tr>

                                <td>

                                    <div class="cell-anak">

                                        <?php if (!empty($bumil['foto']) && file_exists('assets/uploads/' . $bumil['foto'])): ?>

                                            <img
                                            src="assets/uploads/<?= htmlspecialchars($bumil['foto']); ?>"
                                            alt="<?= htmlspecialchars($bumil['nama']); ?>"
                                            class="foto-anak">

                                        <?php else: ?>

                                            <div class="foto-placeholder">
                                                <?= $inisial; ?>
                                            </div>

                                        <?php endif; ?>

                                        <div>

                                            <div class="nama-anak">
                                                <?= htmlspecialchars($bumil['nama']); ?>
                                            </div>

                                            <div class="nik-anak">
                                                <?= htmlspecialchars($bumil['email'] ?? '-'); ?>
                                            </div>

                                        </div>

                                    </div>

                                </td>

                                <td>
                                    <?= htmlspecialchars($bumil['nik'] ?? '-'); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($bumil['nohp'] ?? '-'); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($bumil['usia_kehamilan'] ?? '-'); ?>
                                </td>

                                <td>

                                    <span class="hasil-pemeriksaan">
                                        <?= !empty($bumil['hasil_pemeriksaan'])
                                        ? htmlspecialchars($bumil['hasil_pemeriksaan'])
                                        : '-'; ?>
                                    </span>

                                </td>

                                <td>

                                    <div class="status-gizi">

                                        <span class="dot <?= $dotKelas; ?>"></span>

                                        <span class="<?= $teksKelas; ?>">
                                            <?= htmlspecialchars($status); ?>
                                        </span>

                                    </div>

                                </td>

                                <td>

                                    <div class="aksi">

                                        <a
                                        href="index.php?page=pemeriksaan_bumil&id=<?= (int)$bumil['id']; ?>"
                                        class="aksi-btn btn-edit"
                                        title="Input Hasil Pemeriksaan">

                                            <img
                                            src="assets/icons/pencil.svg"
                                            class="icon-aksi"
                                            alt="Edit">

                                        </a>

                                        <a
                                        href="index.php?page=data_bumil&hapus=<?= (int)$bumil['id']; ?>"
                                        class="aksi-btn btn-hapus"
                                        title="Hapus"
                                        onclick="return confirm('Hapus data <?= htmlspecialchars(addslashes($bumil['nama'])); ?>?')">

                                            <img
                                            src="assets/icons/delete.svg"
                                            class="icon-aksi"
                                            alt="Hapus">

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    </tbody>

                </table>

                <div class="table-footer">
                    <div class="pagination">

                        <?php if ($halamanNow > 1): ?>

                            <a href="index.php?page=data_bumil&hal=<?= $halamanNow - 1; ?>&cari=<?= urlencode($cari); ?>">
                                ‹
                            </a>

                        <?php else: ?>

                            <span class="disabled">
                                ‹
                            </span>

                        <?php endif; ?>

                        <?php
                        $mulai = max(1, $halamanNow - 1);
                        $akhir = min($totalHalaman, $mulai + 2);

                        for ($p = $mulai; $p <= $akhir; $p++):
                        ?>

                            <a
                            href="index.php?page=data_bumil&hal=<?= $p; ?>&cari=<?= urlencode($cari); ?>"
                            class="<?= $p === $halamanNow ? 'aktif' : ''; ?>">

                                <?= $p; ?>

                            </a>

                        <?php endfor; ?>

                        <?php if ($halamanNow < $totalHalaman): ?>

                            <a href="index.php?page=data_bumil&hal=<?= $halamanNow + 1; ?>&cari=<?= urlencode($cari); ?>">
                                ›
                            </a>

                        <?php else: ?>

                            <span class="disabled">
                                ›
                            </span>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </section>

    </main>

</div>

<script src="js/script.js"></script>

</body>
</html>