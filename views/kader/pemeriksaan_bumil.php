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

    <main class="kader-main">

        <section class="content">

             <div class="header">
                    <a href="index.php?page=data_bumil" class="tombol-kembali">
                    Kembali
                    </a>
                <div class="header-info">
                    <h2>Hasil Pemeriksaan Ibu Hamil</h2>
                    <p>Isi catatan pemeriksaan dan status kesehatan ibu hamil.</p>
                </div>
            </div>

            <div class="form-pemeriksaan-card">

                <div class="info-balita-card">

                    <?php if (!empty($dataBumil['foto']) && file_exists('assets/uploads/' . $dataBumil['foto'])): ?>

                        <img
                        src="assets/uploads/<?= htmlspecialchars($dataBumil['foto']); ?>"
                        class="foto-anak"
                        alt="<?= htmlspecialchars($dataBumil['nama']); ?>">

                    <?php else: ?>

                        <div class="foto-placeholder">
                            <?= strtoupper(substr($dataBumil['nama'], 0, 1)); ?>
                        </div>

                    <?php endif; ?>

                    <div>
                        <h3>
                            <?= htmlspecialchars($dataBumil['nama']); ?>
                        </h3>

                        <p>
                            NIK: <?= htmlspecialchars($dataBumil['nik'] ?? '-'); ?>
                        </p>

                        <p>
                            Usia Kehamilan: <?= htmlspecialchars($dataBumil['usia_kehamilan'] ?? '-'); ?>
                        </p>
                    </div>

                </div>

                <form method="POST">

                    <div class="grup-input">

                        <label>
                            Hasil Pemeriksaan / Catatan
                        </label>

                        <textarea
                        name="hasil_pemeriksaan"
                        class="input-field"
                        placeholder="Contoh: Tekanan darah normal, kondisi ibu stabil, tidak ada keluhan..."
                        required><?= htmlspecialchars($dataBumil['hasil_pemeriksaan'] ?? ''); ?></textarea>

                    </div>

                    <div class="grup-input">

                        <label>
                            Status Kesehatan
                        </label>

                        <select
                        name="status_kesehatan"
                        class="input-field"
                        required>

                            <option
                            value="Sehat"
                            <?= ($dataBumil['status_kesehatan'] ?? '') == 'Sehat' ? 'selected' : ''; ?>>

                                Sehat

                            </option>

                            <option
                            value="Perlu Pemeriksaan"
                            <?= ($dataBumil['status_kesehatan'] ?? '') == 'Perlu Pemeriksaan' ? 'selected' : ''; ?>>

                                Perlu Pemeriksaan

                            </option>

                        </select>

                    </div>

                    <div class="aksi-form">

                        <a
                        href="index.php?page=data_bumil"
                        class="tombol-batal">

                            Kembali

                        </a>

                        <button
                        type="submit"
                        name="simpan"
                        class="tombol-simpan">

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