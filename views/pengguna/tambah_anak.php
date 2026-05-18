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
    <title>SiBuba - Tambah Anak</title>
    <link rel="stylesheet" href="css/tambah_anak.css">
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

            <h2>Tambah Data Anak</h2>

            <p>
                Lengkapi informasi anak untuk pemantauan kesehatan
            </p>

        </div>

        <div class="form-wrapper">

            <article class="preview-card">

                <div class="preview-avatar" id="previewAvatar">

                    <img
                        src=""
                        alt="Preview Foto Anak"
                        id="previewFoto"
                        class="preview-foto"
                    >

                    <span id="previewInisial">?</span>

                </div>

                <h3 id="previewNama">
                    Nama Anak
                </h3>

                <p id="previewUsia">
                    Data anak akan tampil di sini
                </p>

                <div class="preview-info">

                    <div class="preview-badge">
                        <i class="fa-solid fa-venus-mars"></i>
                        <span id="previewJK">—</span>
                    </div>

                    <div class="preview-badge">
                        <i class="fa-solid fa-droplet"></i>
                        <span id="previewGolDar">—</span>
                    </div>

                </div>

            </article>

            <article class="form-card">

                <form
                    action="controllers/tambah_anak.php"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    <div class="grup-input">

                        <label>Upload Foto Anak</label>

                        <input
                            type="file"
                            name="foto"
                            id="fotoAnak"
                            class="input-field"
                            accept="image/*"
                        >

                    </div>

                    <div class="grup-input">

                        <label>NIK Anak</label>

                        <input
                            type="text"
                            name="nik_anak"
                            class="input-field"
                            placeholder="Masukkan NIK Anak"
                            maxlength="20"
                            required
                        >

                    </div>

                    <div class="grup-input">

                        <label>Nama Anak</label>

                        <input
                            type="text"
                            name="nama_anak"
                            id="namaAnak"
                            class="input-field"
                            placeholder="Masukkan nama lengkap"
                            required
                        >

                    </div>

                    <div class="baris-dua-kolom">

                        <div class="grup-input">

                            <label>Tanggal Lahir</label>

                            <input
                                type="date"
                                name="tanggal_lahir"
                                id="tanggalLahir"
                                class="input-field"
                                required
                            >

                        </div>

                        <div class="grup-input">

                            <label>Jenis Kelamin</label>

                            <select
                                name="jenis_kelamin"
                                id="jenisKelamin"
                                class="input-field"
                                required
                            >
                                <option value="">Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>

                        </div>

                    </div>

                    <div class="baris-dua-kolom">

                        <div class="grup-input">

                            <label>Berat Badan (kg)</label>

                            <input
                                type="number"
                                name="berat_badan"
                                class="input-field"
                                placeholder="Contoh: 3.5"
                                step="0.1"
                                min="0"
                                required
                            >

                        </div>

                        <div class="grup-input">

                            <label>Tinggi Badan (cm)</label>

                            <input
                                type="number"
                                name="tinggi_badan"
                                class="input-field"
                                placeholder="cth: 50"
                                required
                            >

                        </div>

                    </div>

                    <div class="grup-input">

                        <label>Golongan Darah</label>

                        <select
                            name="golongan_darah"
                            id="golonganDarah"
                            class="input-field"
                        >
                            <option value="">Tidak tahu / belum diketahui</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>

                    </div>

                    <div class="grup-input">

                        <label>Catatan Tambahan</label>

                        <textarea
                            name="catatan"
                            class="input-field"
                            placeholder="Catatan kondisi kesehatan, alergi, dll..."
                        ></textarea>

                    </div>

                    <div class="aksi-form">

                        <a
                            href="index.php?page=data_kesehatan"
                            class="tombol-batal"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="tombol-simpan"
                        >
                            <i class="fa-solid fa-floppy-disk"></i>
                            Simpan Data
                        </button>

                    </div>

                </form>

            </article>

        </div>

    </section>

</section>

<script src="js/script.js"></script>

</body>
</html>