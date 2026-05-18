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
    <title>SiBuba - Jadwal Posyandu</title>

    <link rel="stylesheet" href="css/sidebar_kader.css">
    <link rel="stylesheet" href="css/jadwal_kader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<div class="kader-wrapper">

    <?php
    $halamanAktif = 'jadwal_kader';
    include 'views/components/sidebar_kader.php';
    ?>

    <main class="kader-main">

        <header class="topbar">
            <span class="topbar-title">Jadwal Posyandu</span>
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

            <p class="breadcrumb">Dashboard / <b>Jadwal Posyandu</b></p>

            <div class="title-row">
                <h1>Manajemen Jadwal Posyandu</h1>
                <p>Tambah dan kelola jadwal kegiatan posyandu yang akan diselenggarakan.</p>
            </div>

            
            <?php if ($pesan): ?>
                <div class="alert alert-<?= $tipepesan ?>">
                    <i class="fa-solid <?= $tipepesan === 'sukses' ? 'fa-circle-check' : 'fa-circle-xmark' ?>"></i>
                    <?= htmlspecialchars($pesan); ?>
                </div>
            <?php endif; ?>

            
            <div class="form-card">
                <div class="form-card-header">
                    <i class="fa-regular fa-calendar-plus"></i>
                    <?= $dataEdit ? 'Edit Jadwal' : 'Tambah Jadwal Baru'; ?>
                </div>

                <form method="POST" action="index.php?page=jadwal_kader">

                    <?php if ($dataEdit): ?>
                        <input type="hidden" name="edit_id" value="<?= (int)$dataEdit['id']; ?>">
                    <?php endif; ?>

                    <div class="form-grid">

                        <div class="form-group form-full">
                            <label>Nama Kegiatan <span class="wajib">*</span></label>
                            <input
                                type="text"
                                name="nama_kegiatan"
                                placeholder="Contoh: Penimbangan Balita Bulanan"
                                value="<?= htmlspecialchars($dataEdit['nama_kegiatan'] ?? ''); ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Tanggal <span class="wajib">*</span></label>
                            <input
                                type="date"
                                name="tanggal"
                                value="<?= htmlspecialchars($dataEdit['tanggal'] ?? ''); ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Lokasi <span class="wajib">*</span></label>
                            <input
                                type="text"
                                name="lokasi"
                                placeholder="Contoh: Posyandu Mawar RT 03"
                                value="<?= htmlspecialchars($dataEdit['lokasi'] ?? ''); ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Jam Mulai <span class="wajib">*</span></label>
                            <input
                                type="time"
                                name="jam_mulai"
                                value="<?= htmlspecialchars($dataEdit['jam_mulai'] ?? ''); ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Jam Selesai <span class="wajib">*</span></label>
                            <input
                                type="time"
                                name="jam_selesai"
                                value="<?= htmlspecialchars($dataEdit['jam_selesai'] ?? ''); ?>"
                                required
                            >
                        </div>

                        <div class="form-group form-full">
                            <label>Keterangan <span class="opsional">(opsional)</span></label>
                            <textarea
                                name="keterangan"
                                rows="3"
                                placeholder="Informasi tambahan tentang kegiatan ini..."
                            ><?= htmlspecialchars($dataEdit['keterangan'] ?? ''); ?></textarea>
                        </div>

                    </div>

                    <div class="form-aksi">
                        <?php if ($dataEdit): ?>
                            <a href="index.php?page=jadwal_kader" class="btn-batal">
                                <i class="fa-solid fa-xmark"></i> Batal
                            </a>
                        <?php endif; ?>
                        <button type="submit" class="btn-simpan">
                            <i class="fa-solid <?= $dataEdit ? 'fa-floppy-disk' : 'fa-plus' ?>"></i>
                            <?= $dataEdit ? 'Simpan Perubahan' : 'Tambah Jadwal'; ?>
                        </button>
                    </div>

                </form>
            </div>

           
            <div class="aksi-bar">
                <form method="GET" action="index.php" style="flex:1;display:flex;">
                    <input type="hidden" name="page" value="jadwal_kader">
                    <div class="cari-wrap" style="flex:1;">
                        <div class="cari-label">Cari Jadwal</div>
                        <div class="cari-input-row">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input
                                type="text"
                                name="cari"
                                class="cari-input"
                                placeholder="Cari nama kegiatan atau lokasi..."
                                value="<?= htmlspecialchars($cari); ?>"
                                autocomplete="off"
                                id="inputCari"
                            >
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-card">

                <table>
                    <thead>
                        <tr>
                            <th style="width:5%">#</th>
                            <th style="width:28%">Nama Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th style="text-align:right;padding-right:22px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (empty($dataHalaman)): ?>
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fa-regular fa-calendar-xmark"></i>
                                    <p>
                                        <?php if ($cari): ?>
                                            Tidak ada jadwal yang cocok dengan pencarian "<?= htmlspecialchars($cari); ?>".
                                        <?php else: ?>
                                            Belum ada jadwal posyandu. Tambahkan jadwal di atas.
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php
                        $nomor = $offset + 1;
                        foreach ($dataHalaman as $jadwal):
                            $sudahLewat = $jadwal['tanggal'] < date('Y-m-d');
                            $hariIni    = $jadwal['tanggal'] === date('Y-m-d');
                        ?>
                        <tr>
                            <td class="td-nomor"><?= $nomor++; ?></td>

                            <td>
                                <div class="nama-kegiatan"><?= htmlspecialchars($jadwal['nama_kegiatan']); ?></div>
                                <?php if (!empty($jadwal['keterangan'])): ?>
                                    <div class="ket-kegiatan"><?= htmlspecialchars(mb_substr($jadwal['keterangan'], 0, 60)) . (mb_strlen($jadwal['keterangan']) > 60 ? '...' : ''); ?></div>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="tgl-wrap">
                                    <i class="fa-regular fa-calendar"></i>
                                    <?= date('d M Y', strtotime($jadwal['tanggal'])); ?>
                                </div>
                            </td>

                            <td>
                                <div class="jam-wrap">
                                    <i class="fa-regular fa-clock"></i>
                                    <?= substr($jadwal['jam_mulai'], 0, 5); ?> – <?= substr($jadwal['jam_selesai'], 0, 5); ?>
                                </div>
                            </td>

                            <td>
                                <div class="lokasi-wrap">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <?= htmlspecialchars($jadwal['lokasi']); ?>
                                </div>
                            </td>

                            <td>
                                <?php if ($hariIni): ?>
                                    <span class="badge-status badge-hari-ini">Hari Ini</span>
                                <?php elseif ($sudahLewat): ?>
                                    <span class="badge-status badge-lewat">Selesai</span>
                                <?php else: ?>
                                    <span class="badge-status badge-mendatang">Mendatang</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="aksi">
                                    <a
                                        href="index.php?page=jadwal_kader&edit=<?= (int)$jadwal['id']; ?>"
                                        class="aksi-btn btn-edit"
                                        title="Edit Jadwal"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a
                                        href="index.php?page=jadwal_kader&hapus=<?= (int)$jadwal['id']; ?>"
                                        class="aksi-btn btn-hapus"
                                        title="Hapus"
                                        onclick="return confirm('Hapus jadwal <?= htmlspecialchars(addslashes($jadwal['nama_kegiatan'])); ?>?')"
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

                
                <div class="table-footer">
                    <p>Menampilkan <?= count($dataHalaman); ?> dari <?= $totalItem; ?> jadwal</p>

                    <div class="pagination">

                        <?php if ($halamanNow > 1): ?>
                            <a href="index.php?page=jadwal_kader&hal=<?= $halamanNow - 1; ?>&cari=<?= urlencode($cari); ?>">
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
                                href="index.php?page=jadwal_kader&hal=<?= $p; ?>&cari=<?= urlencode($cari); ?>"
                                class="<?= $p === $halamanNow ? 'aktif' : ''; ?>"
                            >
                                <?= $p; ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($halamanNow < $totalHalaman): ?>
                            <a href="index.php?page=jadwal_kader&hal=<?= $halamanNow + 1; ?>&cari=<?= urlencode($cari); ?>">
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

           
            <div class="summary-grid">

                <div class="summary-card">
                    <div class="summary-ikon si-teal">
                        <i class="fa-regular fa-calendar"></i>
                    </div>
                    <div>
                        <div class="summary-val"><?= $totalItem; ?></div>
                        <div class="summary-label">Total Jadwal</div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-ikon si-hijau">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                    <div>
                        <div class="summary-val"><?= $totalMendatang; ?></div>
                        <div class="summary-label">Jadwal Mendatang</div>
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