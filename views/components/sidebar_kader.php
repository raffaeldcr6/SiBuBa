<?php $current = isset($_GET['page']) ? $_GET['page'] : 'dashboard_kader'; ?>

<button class="hamburger" id="adminHamburger">
    <i class="fa-solid fa-bars" id="adminHamburgerIcon"></i>
</button>

<div class="overlay" id="adminOverlay"></div>

<aside class="sidebar" id="adminSidebar">

    <div class="sidebar-logo">
        <h2 class="logo-besar">SI BUBA</h2>
        <p class="logo-kecil">Sistem Ibu Hamil & Balita</p>
    </div>

    <nav>
        <a href="index.php?page=dashboard_kader"
           class="menu-item <?= $current == 'dashboard_kader' ? 'aktif' : '' ?>">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="index.php?page=data_balita"
           class="menu-item <?= $current == 'data_balita' ? 'aktif' : '' ?>">
            <i class="fa-solid fa-users"></i>
            Data Balita
        </a>

        <a href="index.php?page=data_bumil"
           class="menu-item <?= $current == 'data_bumil' ? 'aktif' : '' ?>">
            <i class="fa-solid fa-users"></i>
            Data Ibu Hamil
        </a>

        <a href="index.php?page=jadwal_kader"
           class="menu-item <?= $current == 'jadwal_kader' ? 'aktif' : '' ?>">
            <i class="fa-regular fa-calendar"></i>
            Jadwal
        </a>

        <a href="index.php?page=artikel_edukasi"
           class="menu-item <?= $current == 'artikel_edukasi' ? 'aktif' : '' ?>">
            <i class="fa-regular fa-calendar"></i>
            Artikel Edukasi
        </a>

        
        <hr class="garis-menu">

        <a href="controllers/logout.php" class="menu-item keluar">
            <i class="fa-solid fa-right-from-bracket"></i>
            Keluar
        </a>
    </nav>

</aside>