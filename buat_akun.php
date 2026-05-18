<?php

include 'koneksi.php';

$passwordAdmin = password_hash('admin123', PASSWORD_DEFAULT);
$passwordKader = password_hash('kader123', PASSWORD_DEFAULT);

mysqli_query($koneksi, "
    INSERT INTO users
    (nik, nama, email, alamat, nohp, password, role)
    VALUES
    (
        '1802010101010001',
        'Admin Utama',
        'admin@gmail.com',
        'Bandar Lampung',
        '081111111111',
        '$passwordAdmin',
        'admin'
    )
");

mysqli_query($koneksi, "
    INSERT INTO users
    (nik, nama, email, alamat, nohp, password, role)
    VALUES
    (
        '1802010101010002',
        'Kader Posyandu',
        'kader@gmail.com',
        'Bandar Lampung',
        '082222222222',
        '$passwordKader',
        'kader'
    )
");

echo "Akun admin dan kader berhasil dibuat";

?>