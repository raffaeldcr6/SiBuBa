<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiBuba - Lupa Password</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap"
    rel="stylesheet">
</head>

<body>

<?php include 'views/components/navbar_landingpage.php'; ?>

<section class="login-section">

    <div class="form-container">

        <div class="header-content">

            <img src="assets/images/bumil.png"
            alt="Logo"
            class="logo">

            <h2>Lupa Password</h2>

            <p class="subtitle">
                Masukkan email dan password baru
            </p>

        </div>

        <form method="POST">

            <div class="input-group">
                <label>Email</label>

                <input
                type="email"
                name="email"
                required>
            </div>

            <div class="input-group">
                <label>Password Baru</label>

                <input
                type="password"
                name="password"
                minlength="6"
                required>
            </div>

            <div class="input-group">
                <label>Konfirmasi Password</label>

                <input
                type="password"
                name="confirm"
                required>
            </div>

            <button
            type="submit"
            name="reset"
            class="btn-submit">

            Ganti Password

            </button>

            <p class="registrasi-link">

                Sudah ingat password?

                <a href="index.php?page=login"
                class="aksen-merah">

                    Login

                </a>

            </p>

        </form>

    </div>

</section>

</body>
</html>