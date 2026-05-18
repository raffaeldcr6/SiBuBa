<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
        <title>Sibuba - Kelompok 6</title>
        <link rel="stylesheet" href="css/landing_page.css">
        <link rel="stylesheet" href="css/navbar_landingpage.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap"
        rel="stylesheet">
    </head>
<body>

    <?php include 'views/components/navbar_landingpage.php'; ?>
    <section class="bagian-beranda" id="beranda">
        <div class="konten-beranda muncul">
            <h1 class="judul-beranda">
                Pantau Kesehatan<br>
                <span class="aksen-hijau">
                    Ibu Hamil
                </span>
                &amp;
                <span class="aksen-merah">
                    Balita
                </span>
                Bersama
            </h1>
            <p class="deskripsi-beranda">
                Sejalan dengan SDGs
                <em>Good Health and Well-Being</em>,
                SiBuba hadir sebagai solusi digital
                posyandu untuk mempermudah pencatatan,
                monitoring pertumbuhan, dan pelaporan
                data kesehatan ibu dan anak secara efektif.
            </p>
        </div>

        <div class="visual-beranda">
            <img src="image/bumil.png"
            alt="Ilustrasi Keluarga Sehat">
        </div>
    </section>

    <section class="section-fitur" id="fitur">
        <h2 class="judul-fitur">
            Fitur <span>SiBuba</span>
        </h2>

        <div class="container-card">
            <div class="card">
                <h3>Data Kesehatan</h3>
                <p>
                    User dapat melihat informasi
                    kesehatan ibu hamil dan balita
                    secara lengkap.
                </p>
            </div>

            <div class="card">
                <h3>Riwayat Pemeriksaan</h3>
                <p>
                    Semua hasil pemeriksaan dapat
                    diakses kapan saja dengan mudah.
                </p>
            </div>

            <div class="card">
                <h3>Jadwal Posyandu</h3>
                <p>
                    Mengetahui jadwal posyandu
                    agar tidak ketinggalan layanan.
                </p>
            </div>

            <div class="card">
                <h3>Edukasi Kesehatan</h3>
                <p>
                    Informasi kesehatan untuk
                    meningkatkan pengetahuan user.
                </p>
            </div>
        </div>
    </section>

    <footer class="bagian-footer">
        <p class="deskripsi-footer">
            © 2026 SiBuba. All Rights Reserved.
        </p>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>