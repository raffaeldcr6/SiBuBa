<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php?page=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiBuba - Data Peserta</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="admin-wrapper">

    <?php
    $halamanAktif = 'data_peserta';
    include 'views/components/sidebar_admin.php';
    ?>

    <main class="admin-main">
        <section class="content">

            <!-- Judul halaman -->
            <div class="header">
                <div class="header-info">
                    <h1>Data Peserta</h1>
                    <p>Kelola informasi balita dan ibu hamil yang terdaftar di sistem.</p>
                </div>
            </div>

            <div class="peserta-card">

                
                <div class="tabs">
                    <button class="tab aktif" id="tabBalita">Data Balita</button>
                    <button class="tab" id="tabIbu">Data Ibu Hamil</button>
                </div>

                
                <div class="table-wrap" id="panelBalita">
                    <table id="tabelBalita">
                        <thead>
                            <tr>
                                <th>Nama Balita</th>
                                <th>Tanggal Lahir</th>
                                <th>Nama Orang Tua</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($queryBalita) > 0): ?>
                                <?php while ($anak = mysqli_fetch_assoc($queryBalita)): ?>
                                    <tr>
                                        <td>
                                            <div class="peserta-info">
                                            <?php if (!empty($anak['foto']) && file_exists('assets/uploads/' . $anak['foto'])): ?>
                                                <img
                                                    src="assets/uploads/<?= htmlspecialchars($anak['foto']); ?>"
                                                    alt="<?= htmlspecialchars($anak['nama_anak']); ?>"
                                                    class="foto-anak">
                                            <?php else: ?>
                                                <div class="user-avatar">
                                                    <?= strtoupper(substr($anak['nama_anak'], 0, 2)); ?>
                                                </div>
                                            <?php endif; ?>
                                                <strong><?= htmlspecialchars($anak['nama_anak']); ?></strong>
                                            </div>
                                        </td>
                                        <td><?= date('d M Y', strtotime($anak['tanggal_lahir'])); ?></td>
                                        <td><?= htmlspecialchars($anak['nama_orang_tua'] ?: '-'); ?></td>
                                        <td>
                                            <?php $jk = strtolower($anak['jenis_kelamin']); ?>
                                            <span class="badge-jk <?= $jk === 'perempuan' ? 'perempuan' : 'laki'; ?>">
                                                <?= htmlspecialchars($anak['jenis_kelamin']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            
                                        <a href="index.php?page=edit_peserta_admin&id=<?= (int)$anak['id']; ?>&tipe=anak"
                                               class="aksi-btn btn-edit"
                                               title="Edit">
                                                <img src="assets/icons/pencil.svg" class="icon-aksi" alt="Edit">
                                        </a>

                                        <a
                                        href="index.php?page=hapus_user&id=<?= (int)$anak['id']; ?>"
                                        class="aksi-btn btn-hapus"
                                        title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus data balita ini?')">

                                            <img
                                            src="assets/icons/delete.svg"
                                            class="icon-aksi"
                                            alt="Hapus">
                                        </a>
                                        </td>           
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="empty-data">Belum ada data balita.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="table-wrap hidden" id="panelIbu">
                    <table id="tabelIbu">
                        <thead>
                            <tr>
                                <th>Nama Ibu</th>
                                <th>NIK</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dataIbu)): ?>
                                <?php foreach ($dataIbu as $ibu): ?>
                                    <tr>
                                        <td>
                                            <div class="peserta-info">
                                            <?php if (!empty($ibu['foto']) && file_exists('assets/uploads/' . $ibu['foto'])): ?>
                                                <img
                                                    src="assets/uploads/<?= htmlspecialchars($ibu['foto']); ?>"
                                                    alt="<?= htmlspecialchars($ibu['nama']); ?>"
                                                    class="foto-anak">
                                            <?php else: ?>
                                                <div class="user-avatar">
                                                    <?= strtoupper(substr($ibu['nama'], 0, 2)); ?>
                                                </div>
                                            <?php endif; ?>
                                                <strong><?= htmlspecialchars($ibu['nama']); ?></strong>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($ibu['nik'] ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($ibu['email']); ?></td>
                                        <td><?= htmlspecialchars($ibu['nohp'] ?? '-'); ?></td>
                                        <td>

                                        <a href="index.php?page=edit_peserta_admin&id=<?= (int)$ibu['id']; ?>&tipe=ibu"
                                               class="aksi-btn btn-edit"
                                               title="Edit">
                                                <img src="assets/icons/pencil.svg" class="icon-aksi" alt="Edit">
                                        </a>

                                        <a
                                        href="index.php?page=hapus_user&id=<?= (int)$ibu['id']; ?>"
                                        class="aksi-btn btn-hapus"
                                        title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus akun ibu ini? Akun tidak bisa login lagi.')">

                                            <img
                                            src="assets/icons/delete.svg"
                                            class="icon-aksi"
                                            alt="Hapus">
                                        </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="empty-data">Belum ada data ibu hamil.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </section>

    </main>

</div>

<script src="js/script.js"></script>

</body>
</html>