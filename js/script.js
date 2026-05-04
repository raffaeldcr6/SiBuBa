document.addEventListener("DOMContentLoaded", function() {

    window.addEventListener("scroll", function() {
        const nav = document.querySelector(".navigasi");
        if (nav) {
            if (window.scrollY > 50) {
                nav.classList.add("scrolled");
            } else {
                nav.classList.remove("scrolled");
            }
        }
    });

    const hamburger = document.getElementById("hamburger");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    if (hamburger && sidebar) {
        hamburger.addEventListener("click", function() {
            sidebar.classList.toggle("terbuka");
            if (overlay) {
                overlay.classList.toggle("aktif");
            }
            if (sidebar.classList.contains("terbuka")) {
                hamburger.innerHTML = '<i class="fa-solid fa-xmark"></i>';
            } else {
                hamburger.innerHTML = '<i class="fa-solid fa-bars"></i>';
            }
        });
    }

    if (overlay) {
        overlay.addEventListener("click", function() {
            sidebar.classList.remove("terbuka");
            overlay.classList.remove("aktif");
            hamburger.innerHTML = '<i class="fa-solid fa-bars"></i>';
        });
    }

    var overlayModal = document.getElementById("overlayModal");
    if (overlayModal) {
        overlayModal.addEventListener("click", function(e) {
            if (e.target === this) this.classList.remove("aktif");
        });
    }

});

function register() {
    let nik = document.getElementById("nik");
    let nama = document.getElementById("nama");
    let email = document.getElementById("email");
    let nohp = document.getElementById("nohp");
    let password = document.getElementById("password");
    let confirm = document.getElementById("confirm");

    if (!nik || !nama || !email || !nohp || !password || !confirm) {
        alert("Form tidak lengkap!");
        return false;
    }

    let nikRegex = /^[0-9]{16}$/;
    if (!nikRegex.test(nik.value)) {
        alert("NIK harus 16 digit angka!");
        return false;
    }

    if (nama.value.trim() === "") {
        alert("Nama tidak boleh kosong!");
        return false;
    }

    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        alert("Email tidak valid!");
        return false;
    }

    let hpRegex = /^[0-9]{10,13}$/;
    if (!hpRegex.test(nohp.value)) {
        alert("No HP harus 10-13 digit angka!");
        return false;
    }

    if (password.value.length < 6) {
        alert("Password minimal 6 karakter!");
        return false;
    }

    if (password.value !== confirm.value) {
        alert("Password tidak sama!");
        return false;
    }

    alert("Registrasi berhasil!");
    window.location.href = "login.html";
    return false;
}

function login() {
    let email = document.getElementById("email");
    let password = document.getElementById("password");

    if (!email || !password) {
        alert("Form tidak lengkap!");
        return false;
    }

    if (email.value === "" || password.value === "") {
        alert("Email dan password wajib diisi!");
        return false;
    }

    alert("Login berhasil!");
    window.location.href = "dashboard.html";
    return false;
}

const semuaData = [
    { tanggal:'12 Okt 2024', nama:'Budi jr', inisial:'BR', berat:'8.5 kg', tinggi:'70 cm', catatan:'Perkembangan motorik sangat baik, disarankan untuk terus melakukan stimulasi tumbuh kembang secara rutin. Jadwalkan kunjungan berikutnya dalam 1 bulan' },
    { tanggal:'05 Sep 2024', nama:'Ani Putri', inisial:'A', berat:'12.2 kg', tinggi:'70 cm', catatan:'Imunisasi booster Campak telah diberikan dengan baik. Kondisi suhu tubuh normal setelah imunisasi, disarankan untuk memantau kemungkinan demam ringan dalam 1-2 hari ke depan serta memastikan asupan cairan cukup.' },
    { tanggal:'20 Agt 2024', nama:'Budi jr', inisial:'BR', berat:'8.2 kg', tinggi:'70 cm', catatan:'Pemeriksaan rutin bulanan menunjukkan pertumbuhan sesuai dengan usia. Disarankan untuk tetap menjaga pola makan seimbang dan rutin melakukan stimulasi perkembangan motorik anak di rumah.' },
    { tanggal:'15 Jul 2024', nama:'Ani Putri', inisial:'A', berat:'11.8 kg', tinggi:'93 cm', catatan:'Konsultasi gizi dilakukan, anak terlihat aktif dan memiliki nafsu makan yang cukup baik. Disarankan untuk mempertahankan pola makan sehat dan variasi nutrisi agar pertumbuhan tetap optimal.' },
    { tanggal:'10 Jun 2024', nama:'Budi jr', inisial:'BR', berat:'7.9 kg', tinggi:'68 cm', catatan:'Tumbuh kembang anak dalam kondisi normal dan sesuai dengan tahap usia. Vaksinasi telah lengkap, disarankan untuk tetap menjaga kebersihan lingkungan dan pola hidup sehat.' },
    { tanggal:'20 Mei 2024', nama:'Ani Putri', inisial:'A', berat:'11.4 kg', tinggi:'91 cm', catatan:'Pemeriksaan gigi dan mulut menunjukkan kondisi yang baik tanpa adanya masalah serius. Disarankan untuk mulai membiasakan anak menjaga kebersihan gigi secara rutin setiap hari.' },
    { tanggal:'15 Apr 2024', nama:'Budi jr', inisial:'BR', berat:'7.6 kg', tinggi:'66 cm', catatan:'Pemeriksaan rutin menunjukkan refleks dan kemampuan motorik anak berkembang dengan baik. Disarankan untuk terus memberikan stimulasi melalui permainan edukatif.' },
    { tanggal:'10 Mar 2024', nama:'Ani Putri', inisial:'A', berat:'11.0 kg', tinggi:'89 cm', catatan:'Konsultasi tumbuh kembang menunjukkan status gizi dalam kondisi baik. Orang tua disarankan untuk terus memperhatikan asupan nutrisi dan aktivitas fisik anak setiap hari.' },
    { tanggal:'05 Feb 2024', nama:'Budi jr', inisial:'BR', berat:'7.2 kg', tinggi:'64 cm', catatan:'Pemeriksaan pendengaran menunjukkan hasil normal dan tidak ditemukan gangguan. Anak dalam kondisi sehat dan aktif, disarankan untuk tetap melakukan pemeriksaan rutin.' },
    { tanggal:'15 Jan 2024', nama:'Ani Putri', inisial:'A', berat:'10.7 kg', tinggi:'70 cm', catatan:'Imunisasi DPT booster telah diberikan dengan baik. Reaksi pasca imunisasi ringan dan masih dalam batas normal, disarankan untuk tetap memantau kondisi anak selama beberapa hari.' }
];

const perHalaman = 4;
let halamanAktif = 1;
let dataFiltered = [...semuaData];

function bukaFilterLanjut() {
    document.getElementById('modalFilterLanjut').classList.add('aktif');
    document.getElementById('overlayFilterLanjut').classList.add('aktif');
    document.body.style.overflow = 'hidden';
}

function tutupFilterLanjut() {
    document.getElementById('modalFilterLanjut').classList.remove('aktif');
    document.getElementById('overlayFilterLanjut').classList.remove('aktif');
    document.body.style.overflow = '';
}

function resetFilter() {
    document.querySelectorAll('.input-modal').forEach(el => el.value = '');
    document.querySelectorAll('.select-modal').forEach(el => el.selectedIndex = 0);
    document.querySelectorAll('.item-checkbox input').forEach(el => el.checked = false);
}

function terapkanFilter() {
    const beratMin = parseFloat(document.getElementById('beratMin').value) || 0;
    const beratMax = parseFloat(document.getElementById('beratMax').value) || Infinity;
    const tinggiMin = parseFloat(document.getElementById('tinggiMin').value) || 0;
    const tinggiMax = parseFloat(document.getElementById('tinggiMax').value) || Infinity;

    dataFiltered = semuaData.filter(d => {
        const berat = parseFloat(d.berat);
        const tinggi = parseFloat(d.tinggi);
        const cocokBerat = berat >= beratMin && berat <= beratMax;
        const cocokTinggi = tinggi >= tinggiMin && tinggi <= tinggiMax;
        return cocokBerat && cocokTinggi;
    });

    halamanAktif = 1;
    renderTabel();
    tutupFilterLanjut();
}

function filterTabel() {
    const kata = document.getElementById('inputCari').value.toLowerCase();
    const anak = document.getElementById('selectAnak').value;

    dataFiltered = semuaData.filter(d => {
        const cocokKata = d.nama.toLowerCase().includes(kata) || d.catatan.toLowerCase().includes(kata);
        const cocokAnak = anak === '' || d.nama === anak;
        return cocokKata && cocokAnak;
    });

    halamanAktif = 1;
    renderTabel();
}

function gantiHalaman(hal) {
    const totalHal = Math.ceil(dataFiltered.length / perHalaman);

    if (hal === 'prev') {
        if (halamanAktif > 1) halamanAktif--;
    } else if (hal === 'next') {
        if (halamanAktif < totalHal) halamanAktif++;
    } else {
        halamanAktif = hal;
    }

    renderTabel();
}

function bukaDetailRiwayat(idx) {
    const d = dataFiltered[idx];
    document.getElementById('detailAvatar').textContent = d.inisial;
    document.getElementById('detailNama').textContent = d.nama;
    document.getElementById('detailBerat').textContent = d.berat;
    document.getElementById('detailTinggi').textContent = d.tinggi;
    document.getElementById('detailCatatan').textContent = d.catatan;
    document.getElementById('modalDetail').classList.add('aktif');
    document.getElementById('overlayDetail').classList.add('aktif');
}

function tutupDetail() {
    document.getElementById('modalDetail').classList.remove('aktif');
    document.getElementById('overlayDetail').classList.remove('aktif');
    document.body.style.overflow = '';
}

function renderTabel() {
    const body = document.getElementById('bodyTabel');
    const mulai = (halamanAktif - 1) * perHalaman;
    const akhir = mulai + perHalaman;
    const slice = dataFiltered.slice(mulai, akhir);

    body.innerHTML = slice.map((d, i) => `
        <tr>
            <td class="td-tanggal">${d.tanggal}</td>
            <td>
                <div class="sel-nama-anak">
                    <div class="avatar-anak ${d.kelas}">${d.inisial}</div>
                    <span class="nama-anak-teks">${d.nama}</span>
                </div>
            </td>
            <td><span class="badge-berat">${d.berat}</span></td>
            <td><span class="badge-tinggi">${d.tinggi}</span></td>
            <td class="td-catatan">${d.catatan}</td>
            <td class="td-aksi">
                <button class="tombol-lihat" onclick="bukaDetailRiwayat(${mulai + i})">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </td>
        </tr>
    `).join('');

    const total = dataFiltered.length;
    const tMulai = total === 0 ? 0 : mulai + 1;
    const tAkhir = Math.min(akhir, total);

    document.getElementById('infoMenampilkan').textContent =
        `Menampilkan ${tMulai}-${tAkhir} dari ${total} data pemeriksaan`;

    renderPaginasi(total);
}

function renderPaginasi(total) {
    const totalHal = Math.ceil(total / perHalaman);
    const p = document.getElementById('paginasi');

    let h = `<button class="hal-btn panah" onclick="gantiHalaman('prev')"><i class="fa-solid fa-chevron-left"></i></button>`;
    for (let i = 1; i <= totalHal; i++) {
        h += `<button class="hal-btn ${i === halamanAktif ? 'aktif' : ''}" onclick="gantiHalaman(${i})">${i}</button>`;
    }
    h += `<button class="hal-btn panah" onclick="gantiHalaman('next')"><i class="fa-solid fa-chevron-right"></i></button>`;

    p.innerHTML = h;
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        tutupFilterLanjut();
        tutupDetail();
    }
});

if (document.getElementById('bodyTabel')) {
    renderTabel();
}

function hitungUsia(tanggalLahirStr) {
    if (!tanggalLahirStr) return "Usia akan tampil di sini";
    var lahir = new Date(tanggalLahirStr);
    var sekarang = new Date();
    if (lahir > sekarang) return "Tanggal tidak valid";
    var tahun = sekarang.getFullYear() - lahir.getFullYear();
    var bulan = sekarang.getMonth() - lahir.getMonth();
    if (bulan < 0) { tahun--; bulan += 12; }
    if (tahun === 0 && bulan === 0) return "Baru Lahir";
    if (tahun === 0) return bulan + " Bulan";
    if (bulan === 0) return tahun + " Tahun";
    return tahun + " Tahun " + bulan + " Bulan";
}

function ambilInisial(nama) {
    var bagian = nama.trim().split(/\s+/);
    if (bagian.length === 1) return bagian[0].substring(0, 2).toUpperCase();
    return (bagian[0][0] + bagian[1][0]).toUpperCase();
}

function perbaruiPratinjau() {
    var nama = document.getElementById("namaAnak").value.trim();
    var tanggal = document.getElementById("tanggalLahir").value;
    var jk = document.getElementById("jenisKelamin").value;
    var golDar = document.getElementById("golonganDarah").value;
    var elNama = document.getElementById("previewNama");
    var elInisial = document.getElementById("previewInisial");
    var elUsia = document.getElementById("previewUsia");
    var elJK = document.getElementById("previewJK");
    var elGolDar = document.getElementById("previewGolDar");
    var elAvatar = document.getElementById("previewAvatar");

    if (nama !== "") {
        elNama.textContent = nama;
        elInisial.textContent = ambilInisial(nama);
    } else {
        elNama.textContent = "Nama Anak";
        elInisial.textContent = "?";
    }

    elUsia.textContent = hitungUsia(tanggal);

    if (jk === "Perempuan") {
        elJK.textContent = "Perempuan";
        elAvatar.classList.add("perempuan");
    } else if (jk === "Laki-laki") {
        elJK.textContent = "Laki-laki";
        elAvatar.classList.remove("perempuan");
    } else {
        elJK.textContent = "—";
        elAvatar.classList.remove("perempuan");
    }

    elGolDar.textContent = golDar !== "" ? golDar : "—";
}

(function pasangHitungKarakter() {
    var textarea = document.getElementById("catatan");
    var elHitung = document.getElementById("hitungKarakter");
    if (textarea && elHitung) {
        textarea.addEventListener("input", function () {
            elHitung.textContent = textarea.value.length + " / 300 karakter";
        });
    }
})();

function tampilkanError(idError, pesan) {
    var el = document.getElementById(idError);
    if (el) el.textContent = pesan;
}

function bersihkanError() {
    document.querySelectorAll(".pesan-error").forEach(function(el) {
        el.textContent = "";
    });
    document.querySelectorAll(".input-field").forEach(function(el) {
        el.classList.remove("input-error", "input-valid");
    });
}

function tandaiInput(idInput, valid) {
    var el = document.getElementById(idInput);
    if (!el) return;
    if (valid) {
        el.classList.remove("input-error");
        el.classList.add("input-valid");
    } else {
        el.classList.remove("input-valid");
        el.classList.add("input-error");
    }
}

function validasiForm() {
    var valid = true;

    var nama = document.getElementById("namaAnak").value.trim();
    if (nama === "") {
        tampilkanError("errorNama", "Nama anak tidak boleh kosong.");
        tandaiInput("namaAnak", false);
        valid = false;
    } else if (nama.length < 2) {
        tampilkanError("errorNama", "Nama terlalu pendek (minimal 2 karakter).");
        tandaiInput("namaAnak", false);
        valid = false;
    } else if (!/^[a-zA-Z\s'.\-]+$/.test(nama)) {
        tampilkanError("errorNama", "Nama hanya boleh mengandung huruf dan spasi.");
        tandaiInput("namaAnak", false);
        valid = false;
    } else {
        tandaiInput("namaAnak", true);
    }

    var tanggal = document.getElementById("tanggalLahir").value;
    if (tanggal === "") {
        tampilkanError("errorTanggal", "Tanggal lahir wajib diisi.");
        tandaiInput("tanggalLahir", false);
        valid = false;
    } else {
        var tgl = new Date(tanggal);
        var sekarang = new Date();
        if (tgl > sekarang) {
            tampilkanError("errorTanggal", "Tanggal lahir tidak boleh di masa depan.");
            tandaiInput("tanggalLahir", false);
            valid = false;
        } else {
            var batasTahun = new Date();
            batasTahun.setFullYear(batasTahun.getFullYear() - 18);
            if (tgl < batasTahun) {
                tampilkanError("errorTanggal", "Usia anak tidak boleh lebih dari 18 tahun.");
                tandaiInput("tanggalLahir", false);
                valid = false;
            } else {
                tandaiInput("tanggalLahir", true);
            }
        }
    }

    var jk = document.getElementById("jenisKelamin").value;
    if (jk === "") {
        tampilkanError("errorJK", "Jenis kelamin wajib dipilih.");
        tandaiInput("jenisKelamin", false);
        valid = false;
    } else {
        tandaiInput("jenisKelamin", true);
    }

    var berat = document.getElementById("beratLahir").value;
    if (berat === "") {
        tampilkanError("errorBerat", "Berat lahir wajib diisi.");
        tandaiInput("beratLahir", false);
        valid = false;
    } else if (parseInt(berat) < 500 || parseInt(berat) > 6000) {
        tampilkanError("errorBerat", "Berat lahir harus antara 500–6000 gram.");
        tandaiInput("beratLahir", false);
        valid = false;
    } else {
        tandaiInput("beratLahir", true);
    }

    var tinggi = document.getElementById("tinggiLahir").value;
    if (tinggi === "") {
        tampilkanError("errorTinggi", "Panjang lahir wajib diisi.");
        tandaiInput("tinggiLahir", false);
        valid = false;
    } else if (parseFloat(tinggi) < 30 || parseFloat(tinggi) > 70) {
        tampilkanError("errorTinggi", "Panjang lahir harus antara 30–70 cm.");
        tandaiInput("tinggiLahir", false);
        valid = false;
    } else {
        tandaiInput("tinggiLahir", true);
    }

    return valid;
}

function simpanDataAnak() {
    bersihkanError();
    if (!validasiForm()) {
        var fieldError = document.querySelector(".input-error");
        if (fieldError) fieldError.scrollIntoView({ behavior: "smooth", block: "center" });
        return;
    }

    var nama = document.getElementById("namaAnak").value.trim();
    var jk = document.getElementById("jenisKelamin").value;
    var berat = document.getElementById("beratLahir").value;
    var tinggi = document.getElementById("tinggiLahir").value;
    var golDar = document.getElementById("golonganDarah").value;

    var labelGolDar = golDar !== "" ? ", golongan darah " + golDar : "";
    var deskripsi = nama + " (" + jk + ") berhasil didaftarkan. Berat lahir " + berat + " gram, panjang " + tinggi + " cm" + labelGolDar + ".";

    document.getElementById("modalDeskripsi").textContent = deskripsi;
    document.getElementById("overlayModal").classList.add("aktif");
}

function tambahAnakLagi() {
    document.getElementById("formTambahAnak").reset();
    bersihkanError();
    document.getElementById("previewNama").textContent = "Nama Anak";
    document.getElementById("previewInisial").textContent = "?";
    document.getElementById("previewUsia").textContent = "Usia akan tampil di sini";
    document.getElementById("previewJK").textContent = "—";
    document.getElementById("previewGolDar").textContent = "—";
    document.getElementById("previewAvatar").classList.remove("perempuan");
    document.getElementById("hitungKarakter").textContent = "0 / 300 karakter";
    document.getElementById("overlayModal").classList.remove("aktif");
}

var formBooking = document.getElementById("formBooking");
if (formBooking) {
    formBooking.addEventListener("submit", function(e) {
        e.preventDefault();
        let valid = true;
        const anak = document.getElementById("anak").value;
        const tanggal = document.getElementById("tanggal").value;
        const konfirmasi = document.getElementById("konfirmasi").checked;

        document.getElementById("errorAnak").textContent = "";
        document.getElementById("errorTanggal").textContent = "";
        document.getElementById("errorKonfirmasi").textContent = "";

        if (anak === "") { document.getElementById("errorAnak").textContent = "Pilih anak"; valid = false; }
        if (tanggal === "") { document.getElementById("errorTanggal").textContent = "Isi tanggal"; valid = false; }
        if (!konfirmasi) { document.getElementById("errorKonfirmasi").textContent = "Harus dicentang"; valid = false; }
        if (!valid) return;

        document.getElementById("hasilText").textContent = anak + " berhasil didaftarkan";
        document.getElementById("overlay").classList.add("aktif");
    });
}

function tutupModal() {
    document.getElementById("overlay").classList.remove("aktif");
}

document.querySelectorAll(".kartu-anak").forEach(card => {
    const nama = card.querySelector(".nama-anak").textContent;
    const avatar = card.querySelector(".avatar-anak");
    const inisial = nama.split(" ").map(n => n[0]).join("").toUpperCase();
    avatar.textContent = inisial;
    if (nama.toLowerCase().includes("ani")) {
        avatar.classList.add("perempuan");
        avatar.classList.remove("laki");
    } else {
        avatar.classList.add("laki");
        avatar.classList.remove("perempuan");
    }
});
