<?php $current = isset($_GET['page']) ? $_GET['page'] : 'dashboard_admin'; ?>

<button class="admin-hamburger" id="adminHamburger">
    <i class="fa-solid fa-bars" id="adminHamburgerIcon"></i>
</button>

<div class="admin-overlay" id="adminOverlay"></div>

<aside class="admin-sidebar" id="adminSidebar">

    <div class="logo">
        <h2>SI BUBA</h2>
        <p>Sistem Ibu Hamil & Balita</p>
    </div>

    <nav>
        <a href="index.php?page=dashboard_admin"
           class="<?= $current == 'dashboard_admin' ? 'aktif' : '' ?>">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="index.php?page=data_peserta"
           class="<?= $current == 'data_peserta' ? 'aktif' : '' ?>">
            <i class="fa-solid fa-users"></i>
            Data Peserta
        </a>

        <a href="index.php?page=jadwal_admin"
           class="<?= $current == 'jadwal_admin' ? 'aktif' : '' ?>">
            <i class="fa-regular fa-calendar"></i>
            Jadwal
        </a>

        <a href="index.php?page=login_pengguna.php" class="menu-item keluar">
            <img src="assets/icons/logout.svg" class="icon-sidebar">
            Keluar
        </a>
    </nav>

</aside>
