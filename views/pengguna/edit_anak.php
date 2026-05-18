<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Anak</title>

    <link rel="stylesheet" href="css/edit_anak.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
</head>

<body>

<section class="halaman-tengah">

    <section class="card-tambah">

        <div class="header-form">

            <a href="index.php?page=data_kesehatan" class="tombol-kembali">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>

            <h2>Edit Data Anak</h2>

            <p>Perbarui informasi anak untuk pemantauan kesehatan</p>

        </div>

        <div class="form-wrapper">

            <article class="preview-card">

                <div class="preview-avatar">

                    <?php if (!empty($data['foto'])): ?>

                        <img src="uploads/<?= $data['foto']; ?>" class="preview-foto">

                    <?php else: ?>

                        <span id="previewInisial">
                            <?= strtoupper(substr($data['nama_anak'], 0, 2)); ?>
                        </span>

                    <?php endif; ?>

                </div>

                <h3 id="previewNama">
                    <?= $data['nama_anak']; ?>
                </h3>

                <p>
                    Data Anak
                </p>

                <div class="preview-info">

                    <div class="preview-badge">
                        <i class="fa-solid fa-venus-mars"></i>
                        <span id="previewJK">
                            <?= $data['jenis_kelamin']; ?>
                        </span>
                    </div>

                    <div class="preview-badge">
                        <i class="fa-solid fa-droplet"></i>
                        <span id="previewGolDar">
                            <?= $data['golongan_darah'] ?: '-'; ?>
                        </span>
                    </div>

                </div>

            </article>

            <article class="form-card">

                <form action="index.php?page=update_anak" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $data['id']; ?>">

                    <div class="grup-input">
                        <label>Upload Foto Anak</label>
                        <input type="file" name="foto" class="input-field">
                    </div>

                    <div class="grup-input">
                        <label>NIK Anak</label>
                        <input type="text" name="nik_anak" value="<?= $data['nik_anak']; ?>" class="input-field" required>
                    </div>

                    <div class="grup-input">
                        <label>Nama Anak</label>
                        <input type="text" name="nama_anak" value="<?= $data['nama_anak']; ?>" class="input-field" required>
                    </div>

                    <div class="baris-dua-kolom">

                        <div class="grup-input">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir']; ?>" class="input-field" required>
                        </div>

                        <div class="grup-input">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="input-field" required>
                                <option value="Laki-laki" <?= $data['jenis_kelamin'] == "Laki-laki" ? 'selected' : ''; ?>>Laki-laki</option>
                                <option value="Perempuan" <?= $data['jenis_kelamin'] == "Perempuan" ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>

                    </div>

                    <div class="baris-dua-kolom">

                        <div class="grup-input">
                            <label>Berat Badan (kg)</label>
                            <input type="number" name="berat_badan" value="<?= $data['berat_badan']; ?>" class="input-field" step="0.1" required>
                        </div>

                        <div class="grup-input">
                            <label>Tinggi Badan (cm)</label>
                            <input type="number" name="tinggi_badan" value="<?= $data['tinggi_badan']; ?>" class="input-field" required>
                        </div>

                    </div>

                    <div class="grup-input">
                        <label>Golongan Darah</label>
                        <select name="golongan_darah" class="input-field">
                            <option value="">Tidak tahu / belum diketahui</option>
                            <option value="A" <?= $data['golongan_darah'] == "A" ? 'selected' : ''; ?>>A</option>
                            <option value="B" <?= $data['golongan_darah'] == "B" ? 'selected' : ''; ?>>B</option>
                            <option value="AB" <?= $data['golongan_darah'] == "AB" ? 'selected' : ''; ?>>AB</option>
                            <option value="O" <?= $data['golongan_darah'] == "O" ? 'selected' : ''; ?>>O</option>
                        </select>
                    </div>

                    <div class="grup-input">
                        <label>Catatan Tambahan</label>
                        <textarea name="catatan" class="input-field"><?= $data['catatan']; ?></textarea>
                    </div>

                    <div class="aksi-form">

                        <a href="index.php?page=data_kesehatan" class="tombol-batal">
                            Batal
                        </a>

                        <button type="submit" class="tombol-simpan">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Update Data
                        </button>

                        <a href="javascript:void(0)"
                           onclick="confirmDelete('index.php?page=hapus_anak&id=<?= $data['id']; ?>')"
                           class="tombol-hapus">
                            <i class="fa-solid fa-trash"></i>
                            Hapus
                        </a>

                    </div>

                </form>

            </article>

        </div>

    </section>

</section>

<script src="js/script.js"></script>

</body>
</html>