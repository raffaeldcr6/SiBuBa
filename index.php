<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'landing';

$current = $page;

switch($page){

    case 'landing':
        include 'views/landing_page.php';
        break;

    case 'login':
        include 'controllers/auth/login.php';
        break;

    case 'register':
        include 'controllers/auth/register.php';
        break;

    case 'dashboard_pengguna':
        include 'controllers/pengguna/dashboard_pengguna.php';
        break;

    case 'dashboard_admin':
        include 'controllers/admin/dashboard_admin.php';
        break;

    case 'dashboard_kader':
        include 'controllers/kader/dashboard_kader.php';
        break;

    case 'data_kesehatan':
        include 'controllers/pengguna/data_kesehatan.php';
        break;
    
    case 'tambah_anak':
        include 'controllers/pengguna/tambah_anak.php';
        break;

     case 'edit_anak':
        include 'controllers/pengguna/edit_anak.php';
        break;

    case 'hapus_user':
        include 'controllers/admin/hapus_user.php';
        break;

    case 'jadwal':
        include 'views/jadwal_posyandu.php';
        break;

    case 'riwayat':
        include 'views/riwayat_pemeriksa.php';
        break;

    case 'data_anak':
        include 'views/data_anak.php';
        break;
    
    case 'data_peserta':
        include 'controllers/admin/data_peserta.php';
    break;

    case 'data_balita':
        include 'controllers/kader/data_balita.php';
    break;

    case 'jadwal_kader':
        include 'controllers/kader/jadwal_kader.php';
    break;

    case 'jadwal_posyandu':
        include 'controllers/pengguna/jadwal_posyandu.php';
    break;

    case 'jadwal_admin':
        include 'controllers/admin/jadwal_admin.php';
    break;

    default:
        include 'views/landing_page.php';
        break;
}
?>