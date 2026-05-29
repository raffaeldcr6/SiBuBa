<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>SiBuba - Profil</title>

    <link rel="stylesheet" href="css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
</head>

<body>

<div class="profil-wrapper">

    <?php include 'views/components/sidebar_pengguna.php'; ?>

    <main class="konten-utama">

        <div class="header-profil">

            <div>
                <h1>Profil Pengguna</h1>

                <p>
                    Kelola informasi akun dan status kehamilan.
                </p>
            </div>

        </div>

        <div class="profil-layout">
            <aside class="profil-card">
                 <div class="foto-preview-box">
                        <?php if(!empty($dataUser['foto'])): ?>

                            <img
                            src="assets/uploads/<?= $dataUser['foto']; ?>"
                            class="foto-profil"
                            id="previewFotoProfil">

                            <div
                            class="profil-avatar"
                            id="previewInisialProfil"
                            style="display:none;">

                                <?= strtoupper(substr($dataUser['nama'],0,2)); ?>

                            </div>

                        <?php else: ?>

                            <img
                            src=""
                            class="foto-profil"
                            id="previewFotoProfil"
                            style="display:none;">

                            <div
                            class="profil-avatar"
                            id="previewInisialProfil">

                                <?= strtoupper(substr($dataUser['nama'],0,2)); ?>

                            </div>

                        <?php endif; ?>

                    </div>

                    <h3>
                        <?= $dataUser['nama']; ?>
                    </h3>

                    <p>
                        <?= $dataUser['email']; ?>
                    </p>

                    <div class="status-kehamilan-box">

                        <span>Status Kehamilan</span>

                        <strong>
                            <?= $dataUser['status_hamil'] == 'ya'
                            ? 'Sedang Hamil'
                            : 'Tidak Hamil'; ?>
                        </strong>

                    </div>

            </aside>

            <section class="form-profil-card">

                <form method="POST"
                enctype="multipart/form-data">

                    <div class="grup-input">
                        <label>Foto Profil</label>

                        <input
                        type="file"
                        name="foto"
                        id="inputFotoProfil"
                        class="input-field"
                        accept="image/*">
                    </div>

                    <div class="baris-dua-kolom">

                        <div class="grup-input">
                            <label>NIK</label>

                            <input
                            type="text"
                            name="nik"
                            class="input-field"
                            value="<?= $dataUser['nik']; ?>"
                            required>
                        </div>

                        <div class="grup-input">
                            <label>Nama Lengkap</label>

                            <input
                            type="text"
                            name="nama"
                            class="input-field"
                            value="<?= $dataUser['nama']; ?>"
                            required>
                        </div>

                    </div>

                    <div class="baris-dua-kolom">

                        <div class="grup-input">
                            <label>Email</label>

                            <input
                            type="email"
                            name="email"
                            class="input-field"
                            value="<?= $dataUser['email']; ?>"
                            required>
                        </div>

                        <div class="grup-input">
                            <label>No HP</label>

                            <input
                            type="text"
                            name="nohp"
                            class="input-field"
                            value="<?= $dataUser['nohp']; ?>"
                            required>
                        </div>

                    </div>

                    <div class="grup-input">

                        <label>Alamat</label>

                        <textarea
                        name="alamat"
                        class="input-field"
                        required><?= $dataUser['alamat']; ?></textarea>

                    </div>

                    <div class="baris-dua-kolom">

                        <div class="grup-input">

                            <label>Apakah sedang hamil?</label>

                            <select
                            name="status_hamil"
                            id="statusHamil"
                            class="input-field">

                                <option value="tidak"
                                <?= $dataUser['status_hamil'] == 'tidak' ? 'selected' : ''; ?>>
                                    Tidak
                                </option>

                                <option value="ya"
                                <?= $dataUser['status_hamil'] == 'ya' ? 'selected' : ''; ?>>
                                    Ya
                                </option>

                            </select>

                        </div>

                        <div class="grup-input"
                        id="usiaKehamilanGroup">

                            <label>Usia Kehamilan</label>

                            <input
                            type="text"
                            name="usia_kehamilan"
                            class="input-field"
                            placeholder="Contoh: 20 minggu"
                            value="<?= $dataUser['usia_kehamilan']; ?>">

                        </div>

                    </div>

                    <div class="info-profil">

                        Jika status kehamilan aktif,
                        Anda dapat melakukan booking
                        jadwal kategori ibu hamil.

                    </div>

                    <div class="aksi-form">

                        <button
                        type="submit"
                        name="simpan"
                        class="tombol-simpan">

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </section>

        </div>

    </main>

</div>

<script src="js/script.js"></script>

</body>
</html>