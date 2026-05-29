<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>SiBuba - Data Balita</title>

    <link
    rel="stylesheet"
    href="css/style.css">

    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
</head>

<body>

<div class="kader-wrapper">

    <?php
    $halamanAktif = 'data_balita';
    include 'views/components/sidebar_kader.php';
    ?>

    <main class="kader-main">

        <section class="content">

            <div class="header">
                <div class="header-info">
                    <h1>Manajemen Balita</h1>
                    <p>Pantau data balita dan input hasil pemeriksaan kesehatan.</p>
                </div>
            </div>

            <div class="summary-grid">

                <div class="summary-card">
                    <div>
                        <div class="summary-val">
                            <?= (int)$totalBalita; ?>
                        </div>

                        <div class="summary-label">
                            Total Balita
                        </div>
                    </div>
                </div>

                <div class="summary-card">
                    <div>
                        <div class="summary-val">
                            <?= (int)$giziBaikCount; ?>
                        </div>

                        <div class="summary-label">
                            Gizi Baik
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
                    value="data_balita">

                    <div class="cari-wrap">

                        <div class="cari-label">
                            Cari Data
                        </div>

                        <div class="cari-input-row">

                            <input
                            type="text"
                            name="cari"
                            class="cari-input"
                            placeholder="Masukkan nama balita atau NIK..."
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
                            <th>Foto & Nama</th>
                            <th>Nama Ibu</th>
                            <th>Usia</th>
                            <th>Gender</th>
                            <th>Hasil Pemeriksaan</th>
                            <th>Status Gizi</th>
                            <th>Imunisasi</th>
                            <th class="kolom-aksi">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if (empty($dataHalaman)): ?>

                        <tr>
                            <td colspan="8">

                                <div class="empty-state">
                                    <p>
                                        <?php if ($cari): ?>
                                            Tidak ada data yang cocok dengan pencarian "<?= htmlspecialchars($cari); ?>".
                                        <?php else: ?>
                                            Belum ada data balita.
                                        <?php endif; ?>
                                    </p>
                                </div>

                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($dataHalaman as $anak): ?>

                            <?php

                            $inisial = strtoupper(substr($anak['nama_anak'] ?? 'A', 0, 1));

                            $gender = strtolower(trim($anak['jenis_kelamin'] ?? ''));

                            $genderLabel = $gender === 'perempuan'
                                ? 'Perempuan'
                                : 'Laki-laki';

                            $genderKelas = $gender === 'perempuan'
                                ? 'badge-perempuan'
                                : 'badge-laki';

                            $gizi = trim($anak['status_gizi'] ?? '');

                            if ($gizi == '') {
                                $gizi = 'Tidak Baik';
                            }

                            $giziLower = strtolower($gizi);

                            if ($giziLower == 'baik') {
                                $dotKelas = 'dot-hijau';
                                $teksKelas = 'gizi-baik';
                            } else {
                                $dotKelas = 'dot-merah';
                                $teksKelas = 'gizi-buruk';
                            }

                            $imunisasi = trim($anak['status_imunisasi'] ?? '');

                            if ($imunisasi == '') {
                                $imunisasi = 'Belum';
                            }

                            $imunisasiLower = strtolower($imunisasi);

                            if ($imunisasiLower == 'sudah') {
                                $dotImunisasi = 'dot-hijau';
                                $teksImunisasi = 'gizi-baik';
                            } else {
                                $dotImunisasi = 'dot-merah';
                                $teksImunisasi = 'gizi-buruk';
                            }

                            if (isset($anak['umur_bulan'])) {

                                if ((int)$anak['umur_tahun'] > 0) {
                                    $usia = (int)$anak['umur_tahun'] . ' Tahun';
                                } else {
                                    $usia = (int)$anak['umur_bulan'] . ' Bulan';
                                }

                            } else {
                                $usia = '-';
                            }

                            ?>

                            <tr>

                                <td>

                                    <div class="cell-anak">

                                        <?php if (!empty($anak['foto']) && file_exists('assets/uploads/' . $anak['foto'])): ?>

                                            <img
                                            src="assets/uploads/<?= htmlspecialchars($anak['foto']); ?>"
                                            alt="<?= htmlspecialchars($anak['nama_anak']); ?>"
                                            class="foto-anak">

                                        <?php else: ?>

                                            <div class="foto-placeholder">
                                                <?= $inisial; ?>
                                            </div>

                                        <?php endif; ?>

                                        <div>
                                            <div class="nama-anak">
                                                <?= htmlspecialchars($anak['nama_anak']); ?>
                                            </div>

                                            <div class="nik-anak">
                                                NIK: <?= htmlspecialchars($anak['nik_anak'] ?? '-'); ?>
                                            </div>
                                        </div>

                                    </div>

                                </td>

                                <td>
                                    <?= htmlspecialchars($anak['nama_ibu'] ?? '-'); ?>
                                </td>

                                <td>
                                    <?= $usia; ?>
                                </td>

                                <td>
                                    <span class="badge-gender <?= $genderKelas; ?>">
                                        <?= $genderLabel; ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="hasil-pemeriksaan">
                                        <?= !empty($anak['hasil_pemeriksaan'])
                                            ? htmlspecialchars($anak['hasil_pemeriksaan'])
                                            : '-'; ?>
                                    </span>
                                </td>

                                <td>

                                    <div class="status-gizi">
                                        <span class="dot <?= $dotKelas; ?>"></span>

                                        <span class="<?= $teksKelas; ?>">
                                            <?= htmlspecialchars($gizi); ?>
                                        </span>
                                    </div>

                                </td>

                                <td>

                                    <div class="status-gizi">
                                        <span class="dot <?= $dotImunisasi; ?>"></span>

                                        <span class="<?= $teksImunisasi; ?>">
                                            <?= htmlspecialchars($imunisasi); ?>
                                        </span>
                                    </div>

                                </td>

                                <td>

                                    <div class="aksi">

                                        <a
                                        href="index.php?page=pemeriksaan_balita&id=<?= (int)$anak['id']; ?>"
                                        class="aksi-btn btn-edit"
                                        title="Input Hasil Pemeriksaan">

                                            <img
                                            src="assets/icons/pencil.svg"
                                            class="icon-aksi"
                                            alt="Edit">

                                        </a>

                                        <a
                                        href="index.php?page=data_balita&hapus=<?= (int)$anak['id']; ?>"
                                        class="aksi-btn btn-hapus"
                                        title="Hapus"
                                        onclick="return confirm('Hapus data <?= htmlspecialchars(addslashes($anak['nama_anak'])); ?>?')">

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

                            <a href="index.php?page=data_balita&hal=<?= $halamanNow - 1; ?>&cari=<?= urlencode($cari); ?>">
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
                            href="index.php?page=data_balita&hal=<?= $p; ?>&cari=<?= urlencode($cari); ?>"
                            class="<?= $p === $halamanNow ? 'aktif' : ''; ?>">

                                <?= $p; ?>

                            </a>

                        <?php endfor; ?>

                        <?php if ($halamanNow < $totalHalaman): ?>

                            <a href="index.php?page=data_balita&hal=<?= $halamanNow + 1; ?>&cari=<?= urlencode($cari); ?>">
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
