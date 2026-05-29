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

    <title>SiBuba - Artikel Edukasi</title>

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
    $halamanAktif = 'artikel_edukasi';
    include 'views/components/sidebar_kader.php';
    ?>

    <main class="kader-main">

        <section class="content">

            <div class="header-dashboard">
                <div>
                    <h1>Manajemen Artikel Edukasi</h1>
                    <p>Tambah, edit, dan hapus artikel edukasi kesehatan untuk pengguna.</p>
                </div>
            </div>

            <div class="summary-grid">

                <div class="summary-card">
                    <div>
                        <div class="summary-val">
                            <?= (int)$totalItem; ?>
                        </div>

                        <div class="summary-label">
                            Total Artikel
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-card jadwal-form-card">

                <div class="form-card-header">
                    <?= $dataEdit ? 'Edit Artikel' : 'Tambah Artikel Baru'; ?>
                </div>

                <form
                method="POST"
                enctype="multipart/form-data"
                action="index.php?page=artikel_edukasi">

                    <?php if ($dataEdit): ?>
                        <input
                        type="hidden"
                        name="edit_id"
                        value="<?= (int)$dataEdit['id']; ?>">
                    <?php endif; ?>

                    <div class="form-grid-jadwal">

                        <div class="form-group form-full">
                            <label>Judul Artikel <span class="wajib">*</span></label>

                            <input
                            type="text"
                            name="judul"
                            placeholder="Contoh: Pentingnya ASI Eksklusif"
                            value="<?= htmlspecialchars($dataEdit['judul'] ?? ''); ?>"
                            required>
                        </div>

                        <div class="form-group form-full">
                            <label>Foto Artikel</label>

                            <input
                            type="file"
                            name="foto"
                            accept="image/*">
                        </div>

                        <?php if (!empty($dataEdit['foto'])): ?>

                            <div class="form-group form-full">
                                <label>Foto Saat Ini</label>

                                <img
                                src="assets/uploads/<?= htmlspecialchars($dataEdit['foto']); ?>"
                                class="preview-artikel">
                            </div>

                        <?php endif; ?>

                        <div class="form-group form-full">
                            <label>Isi Artikel <span class="wajib">*</span></label>

                            <textarea
                            name="isi_artikel"
                            rows="7"
                            placeholder="Tulis isi artikel edukasi di sini..."
                            required><?= htmlspecialchars($dataEdit['isi_artikel'] ?? ''); ?></textarea>
                        </div>

                    </div>

                    <div class="form-aksi">

                        <?php if ($dataEdit): ?>

                            <a
                            href="index.php?page=artikel_edukasi"
                            class="btn-batal">
                                Batal
                            </a>

                        <?php endif; ?>

                        <button
                        type="submit"
                        name="simpan"
                        class="btn-simpan">

                            <?= $dataEdit ? 'Simpan Perubahan' : 'Tambah Artikel'; ?>

                        </button>

                    </div>

                </form>

            </div>

            <div class="aksi-bar">

                <form
                method="GET"
                action="index.php"
                class="form-cari">

                    <input
                    type="hidden"
                    name="page"
                    value="artikel_edukasi">

                    <div class="cari-wrap">

                        <div class="cari-label">
                            Cari Artikel
                        </div>

                        <div class="cari-input-row">

                            <input
                            type="text"
                            name="cari"
                            class="cari-input"
                            placeholder="Cari judul artikel..."
                            value="<?= htmlspecialchars($cari); ?>">

                        </div>

                    </div>

                </form>

            </div>

            <div class="table-card artikel-table">

                <table>

                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Isi Singkat</th>
                            <th>Tanggal</th>
                            <th class="kolom-aksi">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if (empty($dataArtikel)): ?>

                        <tr>
                            <td colspan="5">

                                <div class="empty-state">
                                    <p>
                                        Belum ada artikel edukasi.
                                    </p>
                                </div>

                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($dataArtikel as $artikel): ?>

                            <tr>

                                <td>

                                    <?php if (!empty($artikel['foto']) && file_exists('assets/uploads/' . $artikel['foto'])): ?>

                                        <img
                                        src="assets/uploads/<?= htmlspecialchars($artikel['foto']); ?>"
                                        class="foto-artikel-kader">

                                    <?php else: ?>

                                        <div class="foto-artikel-placeholder">
                                            Artikel
                                        </div>

                                    <?php endif; ?>

                                </td>

                                <td>
                                    <div class="nama-kegiatan">
                                        <?= htmlspecialchars($artikel['judul']); ?>
                                    </div>
                                </td>

                                <td>
                                    <span class="isi-artikel-singkat">
                                        <?= htmlspecialchars(mb_substr($artikel['isi_artikel'], 0, 90)); ?>
                                        <?= mb_strlen($artikel['isi_artikel']) > 90 ? '...' : ''; ?>
                                    </span>
                                </td>

                                <td>
                                    <?= date('d M Y', strtotime($artikel['tanggal'])); ?>
                                </td>

                                <td>

                                    <div class="aksi">

                                        <a
                                        href="index.php?page=artikel_edukasi&edit=<?= (int)$artikel['id']; ?>"
                                        class="aksi-btn btn-edit">
                                          
                                            <img
                                            src="assets/icons/pencil.svg"
                                            class="icon-aksi"
                                            alt="Edit">

                                        </a>

                                        <a
                                        href="index.php?page=artikel_edukasi&hapus=<?= (int)$artikel['id']; ?>"
                                        class="aksi-btn btn-hapus"
                                        onclick="return confirm('Hapus artikel <?= htmlspecialchars(addslashes($artikel['judul'])); ?>?')">
                                            
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

            </div>


        </section>

    </main>

</div>

<script src="js/script.js"></script>

</body>
</html>