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
        <title>SiBuba - Pemeriksaan Balita</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
<body>
<div class="kader-wrapper">
    <main class="kader-main">

        <section class="content">

            <div class="header">
                    <a href="index.php?page=data_balita" class="tombol-kembali">
                    Kembali
                    </a>
                <div class="header-info">
                    <h2>Hasil Pemeriksaan Balita</h2>
                    <p>Isi catatan pemeriksaan dan status gizi balita.</p>
                </div>
            </div>

            <div class="form-pemeriksaan-card">

                <div class="info-balita-card">

                    <?php if (!empty($dataAnak['foto']) && file_exists('assets/uploads/' . $dataAnak['foto'])): ?>

                        <img
                        src="assets/uploads/<?= htmlspecialchars($dataAnak['foto']); ?>"
                        class="foto-anak"
                        alt="<?= htmlspecialchars($dataAnak['nama_anak']); ?>">

                    <?php else: ?>

                        <div class="foto-placeholder">
                            <?= strtoupper(substr($dataAnak['nama_anak'], 0, 1)); ?>
                        </div>

                    <?php endif; ?>

                    <div>
                        <h3><?= htmlspecialchars($dataAnak['nama_anak']); ?></h3>
                        <p>NIK: <?= htmlspecialchars($dataAnak['nik_anak']); ?></p>
                        <p>Nama Ibu: <?= htmlspecialchars($dataAnak['nama_ibu'] ?? '-'); ?></p>
                    </div>

                </div>

                <form method="POST">

                    <div class="grup-input">
                        <label>Hasil Pemeriksaan / Catatan</label>

                        <textarea
                        name="hasil_pemeriksaan"
                        class="input-field"
                        placeholder="Contoh: Berat badan naik, nafsu makan baik, tidak ada keluhan..."
                        required><?= htmlspecialchars($dataAnak['hasil_pemeriksaan'] ?? ''); ?></textarea>
                    </div>

                    <div class="grup-input">
                        <label>Status Gizi</label>

                        <select name="status_gizi" class="input-field" required>
                            <option value="Baik" <?= ($dataAnak['status_gizi'] ?? '') == 'Baik' ? 'selected' : ''; ?>>
                                Baik
                            </option>

                            <option value="Tidak Baik" <?= ($dataAnak['status_gizi'] ?? '') == 'Tidak Baik' ? 'selected' : ''; ?>>
                                Tidak Baik
                            </option>
                        </select>
                    </div>

                    <div class="grup-input">
                        <label>Status Imunisasi</label>

                        <select name="status_imunisasi" class="input-field" required>
                            <option value="Sudah" <?= ($dataAnak['status_imunisasi'] ?? '') == 'Sudah' ? 'selected' : ''; ?>>
                                Sudah
                            </option>

                            <option value="Belum" <?= ($dataAnak['status_imunisasi'] ?? '') == 'Belum' ? 'selected' : ''; ?>>
                                Belum
                            </option>
                        </select>
                    </div>

                    <div class="grup-input">
                        <label>Keterangan Imunisasi</label>

                        <input
                        type="text"
                        name="keterangan_imunisasi"
                        class="input-field"
                        placeholder="Contoh: BCG, Polio, Campak"
                        value="<?= htmlspecialchars($dataAnak['keterangan_imunisasi'] ?? ''); ?>">
                    </div>

                    <div class="aksi-form">
                        <a href="index.php?page=data_balita" class="tombol-batal">
                            Kembali
                        </a>

                        <button type="submit" name="simpan" class="tombol-simpan">
                            Simpan Pemeriksaan
                        </button>
                    </div>

                </form>

            </div>

        </section>

    </main>

</div>

<script src="js/script.js"></script>

</body>
</html>