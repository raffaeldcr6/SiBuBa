<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SiBuba - Registrasi</title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>

<?php include 'views/components/navbar_landingpage.php'; ?>

<section class="registrasi-section">

    <div class="form-container">

        <div class="header-content">
            <img src="assets/images/bumil.png" alt="Logo" class="logo">
            <h2>Registrasi Akun</h2>
            <p class="subtitle">Silahkan isi data diri Anda</p>
        </div>

        <form method="POST">

            <div class="input-group">
                <label>NIK</label>
                <input type="text" name="nik" required>
            </div>

            <div class="input-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" required>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Alamat</label>
                <input type="text" name="alamat" required>
            </div>

            <div class="input-group">
                <label>No HP</label>
                <input type="text" name="nohp" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" minlength="6" required>
            </div>

            <div class="input-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="confirm" minlength="6" required>
            </div>

            <button type="submit" name="register" class="btn-submit">
                Daftar
            </button>

            <p class="registrasi-link">
                Sudah punya akun?
                <a href="index.php?page=login" class="aksen-merah">
                    Login
                </a>
            </p>

        </form>

    </div>

</section>

</body>
</html>
