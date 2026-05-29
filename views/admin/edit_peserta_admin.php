<?php
if (session_status() == PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php?page=login"); exit;
}

$isAnak  = ($tipe === 'anak');
$judul   = $isAnak ? 'Edit Data Balita' : 'Edit Data Ibu Hamil';
$subjudul = $isAnak ? 'Perbarui informasi balita yang terdaftar di sistem.'
                    : 'Perbarui informasi ibu hamil yang terdaftar di sistem.';
$namaField = $isAnak ? $data['nama_anak'] : $data['nama'];
$fotoField  = $data['foto'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiBuba - <?= $judul ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<div class="admin-wrapper">

    <?php $halamanAktif = 'data_peserta'; include 'views/components/sidebar_admin.php'; ?>

    <main class="admin-main">
        <section class="content">

            <div class="header">
                <div class="header-info">
                    <a href="index.php?page=data_peserta" class="tombol-kembali" style="display:inline-block;margin-bottom:8px;">
                        &larr; Kembali
                    </a>
                    <h1><?= $judul ?></h1>
                    <p><?= $subjudul ?></p>
                </div>
            </div>

            <div class="peserta-card">
                <div class="form-wrapper">

                    
                    <article class="preview-card">
                        <div class="preview-avatar">
                            <?php if (!empty($fotoField) && file_exists('assets/uploads/' . $fotoField)): ?>
                                <img src="assets/uploads/<?= htmlspecialchars($fotoField) ?>" class="foto-profil" alt="Foto">
                            <?php else: ?>
                                <span id="previewInisial"><?= strtoupper(substr($namaField, 0, 2)) ?></span>
                            <?php endif; ?>
                        </div>
                        <h3 id="previewNama"><?= htmlspecialchars($namaField) ?></h3>
                        <p><?= $isAnak ? 'Data Balita' : 'Ibu Hamil' ?></p>

                        <?php if ($isAnak): ?>
                        <div class="preview-info">
                            <div class="preview-badge">
                                <span>Jenis:</span>
                                <span id="previewJK"><?= htmlspecialchars($data['jenis_kelamin']) ?></span>
                            </div>
                            <div class="preview-badge">
                                <span>Gol:</span>
                                <span id="previewGolDar"><?= htmlspecialchars($data['golongan_darah'] ?: '-') ?></span>
                            </div>
                        </div>
                        <?php if (!empty($data['nama_ibu'])): ?>
                        <div class="preview-badge" style="margin-top:8px;">
                            <span>Orang Tua:</span>
                            <span><?= htmlspecialchars($data['nama_ibu']) ?></span>
                        </div>
                        <?php endif; ?>

                        <?php else: ?>
                        <div class="preview-info">
                            <div class="preview-badge">
                                <span>NIK:</span>
                                <span><?= htmlspecialchars($data['nik'] ?: '-') ?></span>
                            </div>
                        </div>
                        <?php endif; ?>
                    </article>

                    
                    <article class="form-card">
                        <form action="index.php?page=update_peserta_admin" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="id"   value="<?= (int)$data['id'] ?>">
                            <input type="hidden" name="tipe" value="<?= htmlspecialchars($tipe) ?>">

                            <?php if ($isAnak): ?>
                           

                            <div class="grup-input">
                                <label>Upload Foto Balita</label>
                                <input type="file" name="foto" class="input-field" accept="image/*">
                            </div>

                            <div class="grup-input">
                                <label>NIK Anak</label>
                                <input type="text" name="nik_anak"
                                    value="<?= htmlspecialchars($data['nik_anak'] ?? '') ?>"
                                    class="input-field" required>
                            </div>

                            <div class="grup-input">
                                <label>Nama Anak</label>
                                <input type="text" name="nama_anak"
                                    value="<?= htmlspecialchars($data['nama_anak']) ?>"
                                    class="input-field" required
                                    oninput="document.getElementById('previewNama').textContent=this.value">
                            </div>

                            <div class="baris-dua-kolom">
                                <div class="grup-input">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir"
                                        value="<?= htmlspecialchars($data['tanggal_lahir']) ?>"
                                        class="input-field" required>
                                </div>
                                <div class="grup-input">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="input-field" required
                                        onchange="document.getElementById('previewJK').textContent=this.value">
                                        <option value="Laki-laki"  <?= $data['jenis_kelamin'] == 'Laki-laki'  ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Perempuan"  <?= $data['jenis_kelamin'] == 'Perempuan'  ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="baris-dua-kolom">
                                <div class="grup-input">
                                    <label>Berat Badan (kg)</label>
                                    <input type="number" name="berat_badan"
                                        value="<?= htmlspecialchars($data['berat_badan'] ?? '') ?>"
                                        class="input-field" step="0.1" required>
                                </div>
                                <div class="grup-input">
                                    <label>Tinggi Badan (cm)</label>
                                    <input type="number" name="tinggi_badan"
                                        value="<?= htmlspecialchars($data['tinggi_badan'] ?? '') ?>"
                                        class="input-field" required>
                                </div>
                            </div>

                            <div class="grup-input">
                                <label>Golongan Darah</label>
                                <select name="golongan_darah" class="input-field"
                                    onchange="document.getElementById('previewGolDar').textContent=this.value||'-'">
                                    <option value="">Tidak tahu / belum diketahui</option>
                                    <option value="A"  <?= ($data['golongan_darah'] ?? '') == 'A'  ? 'selected' : '' ?>>A</option>
                                    <option value="B"  <?= ($data['golongan_darah'] ?? '') == 'B'  ? 'selected' : '' ?>>B</option>
                                    <option value="AB" <?= ($data['golongan_darah'] ?? '') == 'AB' ? 'selected' : '' ?>>AB</option>
                                    <option value="O"  <?= ($data['golongan_darah'] ?? '') == 'O'  ? 'selected' : '' ?>>O</option>
                                </select>
                            </div>

                            <div class="grup-input">
                                <label>Catatan Tambahan</label>
                                <textarea name="catatan" class="input-field"><?= htmlspecialchars($data['catatan'] ?? '') ?></textarea>
                            </div>

                            <?php else: ?>
                            

                            <div class="grup-input">
                                <label>NIK</label>
                                <input type="text" name="nik"
                                    value="<?= htmlspecialchars($data['nik'] ?? '') ?>"
                                    class="input-field">
                            </div>

                            <div class="grup-input">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama"
                                    value="<?= htmlspecialchars($data['nama']) ?>"
                                    class="input-field" required
                                    oninput="document.getElementById('previewNama').textContent=this.value">
                            </div>

                            <div class="grup-input">
                                <label>Email</label>
                                <input type="email" name="email"
                                    value="<?= htmlspecialchars($data['email']) ?>"
                                    class="input-field" required>
                            </div>

                            <div class="grup-input">
                                <label>No. HP</label>
                                <input type="text" name="nohp"
                                    value="<?= htmlspecialchars($data['nohp'] ?? '') ?>"
                                    class="input-field">
                            </div>

                            <div class="grup-input">
                                <label>Alamat</label>
                                <textarea name="alamat" class="input-field"><?= htmlspecialchars($data['alamat'] ?? '') ?></textarea>
                            </div>

                            <?php endif; ?>

                            <div class="aksi-form">
                                <a href="index.php?page=data_peserta" class="tombol-batal">Batal</a>
                                <button type="submit" class="tombol-simpan">Update Data</button>
                            </div>

                        </form>
                    </article>

                </div>
            </div>

        </section>
    </main>
</div>

<script src="js/script.js"></script>
</body>
</html>