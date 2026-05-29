<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiBuba - Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>

<?php include 'views/components/navbar_landingpage.php'; ?>

<section class="login-section">

    <div class="form-container">

        <div class="header-content">
            <img src="assets/images/bumil.png" alt="Logo" class="logo">
            <h2>Selamat Datang</h2>
            <p class="subtitle">
                Silahkan masukkan data untuk masuk
            </p>
        </div>

        <form method="POST">

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" minlength="6" required>
            </div>

            <div class="lupa-password">
                <a href="index.php?page=lupa_password">
                    Lupa Password?
                </a>
            </div>

            <button type="submit" name="login" class="btn-submit">
                Masuk
            </button>
            
            <p class="registrasi-link">
                Belum punya akun?
                <a href="index.php?page=register" class="aksen-merah">
                    Registrasi
                </a>
            </p>

        </form>

    </div>

</section>

</body>
</html>
