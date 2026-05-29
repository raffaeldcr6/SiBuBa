<?php

session_set_cookie_params([
    'lifetime' => 300,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

include 'session_timeout.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'landing';

$current = $page;

switch($page){

    case 'landing':
        include 'views/landing_page.php';
        break;

    case 'detail_artikel':
        include 'controllers/pengguna/detail_artikel.php';
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

    case 'edit_peserta_admin':
        include 'controllers/admin/edit_peserta_admin.php';
        break;

    case 'update_peserta_admin':
        include 'controllers/admin/update_peserta_admin.php';
        break;

    case 'hapus_user':
        include 'controllers/admin/hapus_user.php';
        break;

    case 'riwayat_pemeriksa':
         include 'controllers/pengguna/riwayat_pemeriksa.php';
         break;

    case 'profile':
        include 'controllers/pengguna/profile.php';
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

    case 'data_bumil':
        include 'controllers/kader/data_bumil.php'; 
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

    case 'daftar_balita':
        include 'controllers/pengguna/daftar_balita.php';
    break;

    case 'daftar_bumil':
        include 'controllers/pengguna/daftar_bumil.php';
    break;

    case 'histori_booking':
        include 'controllers/pengguna/histori_booking.php';
    break;

    case 'lupa_password':
        include 'controllers/auth/lupa_password.php';
    break;
    
    case 'edukasi_kesehatan':
        include 'controllers/pengguna/artikel.php';
    break;

    case 'pemeriksaan_balita':
        include 'controllers/kader/pemeriksaan_balita.php';
    break;

    case 'pemeriksaan_bumil':
        include 'controllers/kader/pemeriksaan_bumil.php';
    break;

    case 'logout':
        include 'controllers/auth/logout.php';
    break;

    case 'artikel_edukasi':
        include 'controllers/kader/artikel_edukasi.php';
    break;
    
    default:
        include 'views/landing_page.php';
    break;
}
?>
