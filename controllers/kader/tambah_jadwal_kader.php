
<link rel="stylesheet" href="assets/css/tambah_jadwal_kader.css">
<?php
include 'config/koneksi.php';

if(isset($_POST['simpan'])){

    $judul   = $_POST['judul'];
    $tanggal = $_POST['tanggal'];
    $waktu   = $_POST['waktu'];
    $lokasi  = $_POST['lokasi'];

    $query = mysqli_query($conn, "INSERT INTO jadwal 
        (judul, tanggal, waktu, lokasi)
        VALUES
        ('$judul', '$tanggal', '$waktu', '$lokasi')
    ");

    if($query){

        header("Location: index.php?page=jadwal_kader");
        exit;

    } else {

        echo mysqli_error($conn);

    }
}
?>

<?php include 'views/kader/tambah_jadwal.php'; ?>
