<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiBuba - Data Balita</title>

    <link rel="stylesheet" href="css/sidebar_kader.css">
    <link rel="stylesheet" href="css/data_balita.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<div class="kader-wrapper">

    <?php
    $halamanAktif = 'data_balita';
    include 'views/components/sidebar_kader.php';
    ?>

    <main class="kader-main">

        <header class="topbar">
            <span class="topbar-title">Data Balita</span>
            <div class="topbar-right">
                <div class="topbar-notif">
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div class="topbar-user">
                    Halo, <?= htmlspecialchars($_SESSION['user']['nama']); ?>!
                    <div class="avatar">
                        <?= strtoupper(substr($_SESSION['user']['nama'], 0, 1)); ?>
                    </div>
                </div>
            </div>
        </header>

        <section class="content">

            <p class="breadcrumb">Dashboard / <b>Data Balita</b></p>

            <div class="title-row">
                <h1>Manajemen Pertumbuhan Balita</h1>
                <p>Pantau dan kelola data kesehatan balita di wilayah pelayanan Anda secara real-time.</p>
            </div>

            <div class="aksi-bar">

                <form method="GET" action="index.php" style="flex:1;display:flex;">
                    <input type="hidden" name="page" value="data_balita">
                    <div class="cari-wrap" style="flex:1;">
                        <div class="cari-label">Cari Data</div>
                        <div class="cari-input-row">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input
                                type="text"
                                name="cari"
                                class="cari-input"
                                placeholder="Masukkan nama balita atau NIK..."
                                value="<?= htmlspecialchars($cari); ?>"
                                autocomplete="off"
                                id="inputCari"
                            >
                        </div>
                    </div>
                </form>

                <a href="index.php?page=tambah_balita" class="btn-tambah">
                    <i class="fa-solid fa-plus"></i> Tambah Data Balita
                </a>

            </div>

            <div class="table-card">

                <table>
                    <thead>
                        <tr>
                            <th style="width:28%">Foto &amp; Nama</th>
                            <th>Nama Ibu</th>
                            <th>Usia</th>
                            <th>Gender</th>
                            <th>Status Gizi</th>
                            <th style="text-align:right;padding-right:22px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (empty($dataHalaman)): ?>
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fa-solid fa-box-open"></i>
                                    <p>
                                        <?php if ($cari): ?>
                                            Tidak ada data yang cocok dengan pencarian "<?= htmlspecialchars($cari); ?>".
                                        <?php else: ?>
                                            Belum ada data balita.
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($dataHalaman as $anak):

                            $inisial = strtoupper(substr($anak['nama_anak'] ?? 'A', 0, 1));

                            $gender      = strtolower($anak['jenis_kelamin'] ?? '');
                            $genderLabel = $gender === 'perempuan' ? 'Perempuan' : 'Laki-laki';
                            $genderKelas = $gender === 'perempuan' ? 'badge-perempuan' : 'badge-laki';

                            $gizi = $anak['status_gizi'] ?? 'Normal';
                            switch (strtolower($gizi)) {
                                case 'sangat baik':    $dotKelas = 'dot-hijau';  $teksKelas = 'gizi-sangat-baik'; break;
                                case 'baik':           $dotKelas = 'dot-teal';   $teksKelas = 'gizi-baik';        break;
                                case 'normal':         $dotKelas = 'dot-biru';   $teksKelas = 'gizi-normal';      break;
                                case 'butuh pantauan': $dotKelas = 'dot-oranye'; $teksKelas = 'gizi-pantau';      break;
                                case 'gizi buruk':     $dotKelas = 'dot-merah';  $teksKelas = 'gizi-buruk';       break;
                                default:               $dotKelas = 'dot-abu';    $teksKelas = '';
                            }

                            $usia = isset($anak['umur_bulan'])
                                ? (int)$anak['umur_bulan'] . ' Bulan'
                                : '-';

                        ?>
                        <tr>
                            <td>
                                <div class="cell-anak">
                                    <?php if (!empty($anak['foto']) && file_exists('uploads/' . $anak['foto'])): ?>
                                        <img
                                            src="uploads/<?= htmlspecialchars($anak['foto']); ?>"
                                            alt="Foto <?= htmlspecialchars($anak['nama_anak']); ?>"
                                            class="foto-anak"
                                        >
                                    <?php else: ?>
                                        <div class="foto-placeholder"><?= $inisial; ?></div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="nama-anak"><?= htmlspecialchars($anak['nama_anak']); ?></div>
                                        <div class="nik-anak">NIK: <?= htmlspecialchars($anak['nik_anak'] ?? '-'); ?></div>
                                    </div>
                                </div>
                            </td>

                            <td><?= htmlspecialchars($anak['nama_ibu'] ?? '-'); ?></td>

                            <td><?= $usia; ?></td>

                            <td>
                                <span class="badge-gender <?= $genderKelas; ?>"><?= $genderLabel; ?></span>
                            </td>

                            <td>
                                <div class="status-gizi">
                                    <span class="dot <?= $dotKelas; ?>"></span>
                                    <span class="<?= $teksKelas; ?>"><?= htmlspecialchars($gizi); ?></span>
                                </div>
                            </td>

                            <td>
                                <div class="aksi">
                                    <a
                                        href="index.php?page=data_balita&edit=<?= (int)$anak['id']; ?>"
                                        class="aksi-btn btn-edit"
                                        title="Edit / Input Pemeriksaan"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a
                                        href="index.php?page=data_balita&hapus=<?= (int)$anak['id']; ?>"
                                        class="aksi-btn btn-hapus"
                                        title="Hapus"
                                        onclick="return confirm('Hapus data <?= htmlspecialchars(addslashes($anak['nama_anak'])); ?>? Tindakan ini tidak dapat dibatalkan.')"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    </tbody>
                </table>

                <!-- Footer: Info + Pagination -->
                <div class="table-footer">
                    <p>Menampilkan <?= count($dataHalaman); ?> dari <?= (int)$totalItem; ?> balita</p>

                    <div class="pagination">

                        <?php if ($halamanNow > 1): ?>
                            <a href="index.php?page=data_balita&hal=<?= $halamanNow - 1; ?>&cari=<?= urlencode($cari); ?>">
                                <i class="fa-solid fa-chevron-left" style="font-size:11px;"></i>
                            </a>
                        <?php else: ?>
                            <span class="disabled">
                                <i class="fa-solid fa-chevron-left" style="font-size:11px;"></i>
                            </span>
                        <?php endif; ?>

                        <?php
                        $mulai = max(1, $halamanNow - 1);
                        $akhir = min($totalHalaman, $mulai + 2);
                        for ($p = $mulai; $p <= $akhir; $p++):
                        ?>
                            <a
                                href="index.php?page=data_balita&hal=<?= $p; ?>&cari=<?= urlencode($cari); ?>"
                                class="<?= $p === $halamanNow ? 'aktif' : ''; ?>"
                            >
                                <?= $p; ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($halamanNow < $totalHalaman): ?>
                            <a href="index.php?page=data_balita&hal=<?= $halamanNow + 1; ?>&cari=<?= urlencode($cari); ?>">
                                <i class="fa-solid fa-chevron-right" style="font-size:11px;"></i>
                            </a>
                        <?php else: ?>
                            <span class="disabled">
                                <i class="fa-solid fa-chevron-right" style="font-size:11px;"></i>
                            </span>
                        <?php endif; ?>

                    </div>

                </div>

            </div>

            <!-- Summary Cards -->
            <div class="summary-grid">

                <div class="summary-card">
                    <div class="summary-ikon si-teal">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                    <div>
                        <div class="summary-val"><?= (int)$totalBalita; ?></div>
                        <div class="summary-label">Total Balita</div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-ikon si-hijau">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <div class="summary-val"><?= (int)$giziBaikCount; ?></div>
                        <div class="summary-label">Gizi Baik</div>
                    </div>
                </div>

            </div>

        </section>

    </main>

</div>

<script>
(function () {
    var input = document.getElementById('inputCari');
    if (!input) return;
    var timer;
    input.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(function () {
            input.closest('form').submit();
        }, 400);
    });
})();
</script>

<script src="js/script.js"></script>

</body>
</html>