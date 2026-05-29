<?php $current = isset($_GET['page']) ? $_GET['page'] : 'dashboard_kader'; ?>

<button class="sidebar-toggle" id="hamburger" type="button">
    <img
    src="assets/icons/menu.svg"
    class="icon-toggle-sidebar"
    id="iconHamburger"
    alt="Menu">
</button>

<div class="overlay" id="overlay"></div>

<aside class="sidebar" id="sidebar">

    <div class="sidebar-logo">
        <h2 class="logo-besar">SI BUBA</h2>
        <p class="logo-kecil">Sistem Ibu Hamil & Balita</p>
    </div>

    <nav>
        <a href="index.php?page=dashboard_kader"
           class="menu-item <?= $current == 'dashboard_kader' ? 'aktif' : '' ?>">
            <img src="assets/icons/dashboard.svg" class="icon-sidebar">
            Dashboard
        </a>

        <a href="index.php?page=data_balita"
           class="menu-item <?= $current == 'data_balita' ? 'aktif' : '' ?>">
            <img src="assets/icons/child.svg" class="icon-sidebar">
            Data Balita
        </a>

        <a href="index.php?page=data_bumil"
           class="menu-item <?= $current == 'data_bumil' ? 'aktif' : '' ?>">
            <img src="assets/icons/pregnant.svg" class="icon-sidebar">
            Data Bumil
        </a>

        <a href="index.php?page=jadwal_kader"
           class="menu-item <?= $current == 'jadwal_kader' ? 'aktif' : '' ?>">
            <img src="assets/icons/calendar.svg" class="icon-sidebar">
            Jadwal Posyandu
        </a>

        <a href="index.php?page=artikel_edukasi"
           class="menu-item <?= $current == 'artikel_edukasi' ? 'aktif' : '' ?>">
            <img src="assets/icons/article.svg" class="icon-sidebar">
            Artikel Edukasi
        </a>

        
        <hr class="garis-menu">

        <a href="index.php?page=login_pengguna.php"
        class="menu-item keluar">
        <img src="assets/icons/logout.svg" class="icon-sidebar">
        Keluar
        </a>
    </nav>

</aside>
