<?php $current = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; ?>

<button class="hamburger" id="hamburger">
    <i class="fa-solid fa-bars" id="iconHamburger"></i>
</button>

<div class="overlay" id="overlay"></div>

<aside class="sidebar" id="sidebar">

    <div class="sidebar-logo">
        <p class="logo-besar">SI BUBA</p>
        <p class="logo-kecil">Sistem Ibu Hamil & Balita</p>
    </div>

    <nav>

        <a href="index.php?page=dashboard_pengguna"
           class="menu-item <?= $current == 'dashboard_pengguna' ? 'aktif' : '' ?>">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="index.php?page=data_kesehatan"
           class="menu-item <?= $current == 'data_kesehatan' ? 'aktif' : '' ?>">
            <i class="fa-solid fa-users"></i>
            Data Kesehatan
        </a>

        <a href="index.php?page=jadwal"
           class="menu-item <?= $current == 'jadwal' ? 'aktif' : '' ?>">
            <i class="fa-regular fa-calendar"></i>
            Jadwal Posyandu
        </a>

        <a href="index.php?page=riwayat"
           class="menu-item <?= $current == 'riwayat' ? 'aktif' : '' ?>">
            <i class="fa-solid fa-clock-rotate-left"></i>
            Riwayat Pemeriksaan
        </a>

        <a href="index.php?page=edukasi"
           class="menu-item <?= $current == 'edukasi' ? 'aktif' : '' ?>">
            <i class="fa-solid fa-book-open"></i>
            Edukasi Kesehatan
        </a>

        <hr class="garis-menu">

        <a href="index.php?page=pengaturan"
           class="menu-item <?= $current == 'pengaturan' ? 'aktif' : '' ?>">
            <i class="fa-solid fa-gear"></i>
            Pengaturan
        </a>

        <a href="controllers/logout.php" class="menu-item keluar">
            <i class="fa-solid fa-right-from-bracket"></i>
            Keluar
        </a>

    </nav>

</aside>